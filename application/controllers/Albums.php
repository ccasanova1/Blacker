<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_usuario");
		$this->load->model("Model_album");
		$this->load->model("Model_perfiles");
		$this->load->model("Model_publicacion");
		$this->load->model("Model_amigos");
		$this->load->model("Model_megusta");
		$this->load->model("Model_notificaciones");
		$this->load->model("Model_grupo");
		$this->load->model("Model_comentarios");
		$this->load->library('encrypt');
		$this->load->helper('string');
	}

	public function vistaAlbums($id)
	{
		$id = $this->encrypt->decode(strtr(rawurldecode($id),array('.' => '+', '-' => '=', '~' => '/')));
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
		if($this->session->userdata("seleccion") == "usuario"){
			$respuesta2 = $this->Model_perfiles->get_perfil_usuario($this->session->userdata("id"));
	           $respuesta3 = $this->Model_notificaciones->get_notificacion_count($this->session->userdata('id'));
	           $datos = array(
	               'nombre' => $respuesta2->nombre,
	               'apellido' => $respuesta2->apellido,
	               "foto_perfil" => $respuesta->foto_perfil,
	               'seleccion' => $this->session->userdata("seleccion"),
	               'buscar' => 'Buscar',
	               'notificaciones' => $respuesta3,
	           ); 			
		}else{
			redirect(base_url());
		}
		$resultado = $this->Model_perfiles->get_perfil($id);
		if (empty($resultado)) {
			redirect(base_url());
		}else{
			$respuesta4 = $this->Model_usuario->get_usuario($id);
			$respuesta5 = $this->Model_amigos->get_amigo_especifico($id, $this->session->userdata('id'));
			$datos['perfil'] = $resultado;
			$datos['perfil']->id_cuenta = urlencode(strtr($this->encrypt->encode($datos['perfil']->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			$datos['cuenta'] = $respuesta4;
			$datos['amigo'] = $respuesta5;
			if (empty($datos['amigo'])) {
				$datos['amigo'] = new \stdClass(); 
				$datos['amigo']->estado = '';
			}
			$datos['amigoEstado'] = new \stdClass(); 
			$datos['amigoEstado']->banderaPerfil = "OK"; 
			if ($id == $this->session->userdata("id")){
				$datos['amigoEstado']->banderaPerfil = "NO";
			}
			$grupos = $this->Model_grupo->get_grupos($this->session->userdata("id"));
			$datos['grupos'] = $grupos;
			$pendienteAmigos = $this->Model_amigos->get_pendiente($this->session->userdata("id"));
			$datos['amigoPendiente'] = $pendienteAmigos; 
			$datos['visitas'] = $respuesta->visitas;
			$this->load->view('albums', $datos);
		}
	}

	public function obtenerAlbum()
	{
		$id = $this->encrypt->decode(strtr(rawurldecode($this->input->post('id_cuenta')),array('.' => '+', '-' => '=', '~' => '/')));
		//echo "$id";
		$limite = $this->input->post('limite');
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		$albums = $this->Model_album->get_album_view($id, $limite);
		if (empty($albums)) {
			$data['estado'] = 'vacio';
			$data['publicacion'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encontraron mas albums</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
		foreach ($albums as $value) {
				$date1 = new DateTime($value->fecha);
				$date2 = new DateTime(date("Y-m-d H:m:s"));
				$diff = $date1->diff($date2);
				$dateTotal = $this->Model_publicacion->get_format_time($diff);
				$data[$i]['albums'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' id='album_$value->id_album'><br>";
				if ($id == $this->session->userdata("id")) {
						$data[$i]['albums'] .= "<span class='w3-right' ><div id='Eliminar'><button id='btn-eliminar".random_string('alnum', 11)."' type='button' value='$value->id_album' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></div></span>";
				}
                $data[$i]['albums'] .="
						<div class='w3-row'>
						<div class='w3-mobile w3-col' style='width:90%'>
        				<a href='".base_url('albums/fotos/'.$value->id_album.'/'.urlencode(strtr($this->encrypt->encode($id),array('+' => '.', '=' => '-', '/' => '~'))))."'><h4>$value->ruta<h4></a>
						</div>
        				<!--<div class='w3-mobile w3-col' style='width:10%'>
        				<span class='w3-right w3-opacity'>$dateTotal</span>
        				</div>-->
        				</div>
        				<hr class='w3-clear'>
        		";
                $meGusta = $this->Model_megusta->get_megusta_album($value->id_album,$this->session->userdata("id"));
        		if ($meGusta->estado == 'like') {
        			$colorLike = 'w3-green';
        		}else{
        			$colorLike = 'w3-theme-d1';
        		}
      			$data[$i]['albums'] .="
          				<div id='Megusta' style='margin-top: 10px' class='w3-row'>
          				<div class='w3-mobile w3-col ' style='width:100%'>
        					<button id='btn-megusta$i' type='button' value='$value->id_album' class='w3-button $colorLike w3-left'><i class='fa fa-thumbs-up'></i></button>
        					<span class='w3-left' style='margin: 10px; margin-top: 10px' id='MegustaCant' >$meGusta->countMegusta</span>	
        				</div>
        				</div> 
      					<div class='w3-row w3-border-top' id='comentarios'>
      				";
      			$comentarios = $this->Model_comentarios->get_comentarios_albums($value->id_album);
      			foreach ($comentarios as $value2) {
      				$date1 = new DateTime($value2->fecha);
					$date2 = new DateTime(date("Y-m-d H:m:s"));
					$diff = $date1->diff($date2);
					$dateTotal = $this->Model_publicacion->get_format_time($diff);
					$meGustaComent = $this->Model_megusta->get_megusta_comentario($value2->id_comentario,$this->session->userdata("id"));
					if ($meGustaComent->estado == 'like') {
	        			$colorLikeComent = 'w3-green';
	        		}else{
	        			$colorLikeComent = 'w3-theme-d1';
	        		}
      				$data[$i]['albums'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        						<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>
        							<img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'>
        						</a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            					<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        						<h6 style='margin:0px; margin-top:10px'>
        							<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfil $value2->apellido
        							</a>
        							<div id='meGusta' style='display: inline;'><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></div>";
        		if ($value2->id_usuario == $this->session->userdata("id")) {
        			$data[$i]['albums'] .= "<span class='w3-right' ><div id='EliminarComent' style='display: inline'><button id='btn-eliminar".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></div></span>";
        		}
        		$data[$i]['albums'] .= "</h6>
                				<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
      			}
      			$data[$i]['albums'] .="</div>";
      			$data[$i]['albums'] .= "
      						<div id='contenerComentario'>
                    			<textarea id='contComentario' name='publicarComentario; class='w3-border w3-padding' style='width: 100%'' rows='1' placeholder='Comentar algo'></textarea>
                    			<button class='w3-button w3-theme-d2 w3-margin-bottom' id='btn-comentar$i' value='$value->id_album'><i class='fa fa-comment'></i>    Comment</button> 
                  			</div>
				        	
      					";
      			$data[$i]['albums'] .="</div>";
      			$escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
    			$replacements = array("", "", "",  "",  "");
    			$data[$i]['albums'] = str_replace($escapers, $replacements, $data[$i]['albums']);
    			$data[$i]['idc'] = "#album_$value->id_album #contComentario";
    			$i++;
			}
			$data['limite'] = $limite+6;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	
		}
	}

	public function nuevoAlbum(){
		$albumNuevo = $this->input->post('albumNuevo');
		if (!empty($albumNuevo)) {
			$ruta = $this->Model_album->get_rutaAlbum($this->session->userdata('id'));
			$this->Model_album->set_album($ruta->nombre, $albumNuevo, $this->session->userdata('id'));
			$this->Model_notificaciones->set_notificacion_album_usuario($this->session->userdata("id"));
			$dir = "/var/www/html/frontend/assets/albumes/$ruta->nombre/$albumNuevo";
			mkdir($dir, 0777, TRUE);
		}	
	}

	public function fotos($id_album,$id_cuenta){
		$id = $this->encrypt->decode(strtr(rawurldecode($id_cuenta),array('.' => '+', '-' => '=', '~' => '/')));
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
		if($this->session->userdata("seleccion") == "usuario"){
			$respuesta2 = $this->Model_perfiles->get_perfil_usuario($this->session->userdata("id"));
            $respuesta3 = $this->Model_notificaciones->get_notificacion_count($this->session->userdata('id'));
            $datos = array(
                'nombre' => $respuesta2->nombre,
                'apellido' => $respuesta2->apellido,
                "foto_perfil" => $respuesta->foto_perfil,
                'seleccion' => $this->session->userdata("seleccion"),
                'buscar' => 'Buscar',
                'notificaciones' => $respuesta3,
            ); 			
		}else{
			redirect(base_url());
		}
		$resultado = $this->Model_perfiles->get_perfil($id);
		if (empty($resultado)) {
			redirect(base_url());
		}else{
			$respuesta4 = $this->Model_usuario->get_usuario($id);
			$respuesta5 = $this->Model_amigos->get_amigo_especifico($id, $this->session->userdata('id'));
			$datos['perfil'] = $resultado;
			$datos['perfil']->id_cuenta = urlencode(strtr($this->encrypt->encode($datos['perfil']->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			$datos['cuenta'] = $respuesta4;
			$datos['amigo'] = $respuesta5;
			if (empty($datos['amigo'])) {
				$datos['amigo'] = new \stdClass(); 
				$datos['amigo']->estado = '';
			}
			$datos['amigoEstado'] = new \stdClass(); 
			$datos['amigoEstado']->banderaPerfil = "OK"; 
			if ($id == $this->session->userdata("id")){
				$datos['amigoEstado']->banderaPerfil = "NO";
			}
			$datos['album'] = new \stdClass();
			$datos['album']->id_album = $id_album;
			$grupos = $this->Model_grupo->get_grupos($this->session->userdata("id"));
			$datos['grupos'] = $grupos;
			$pendienteAmigos = $this->Model_amigos->get_pendiente($this->session->userdata("id"));
			$datos['amigoPendiente'] = $pendienteAmigos; 
			$datos['visitas'] = $respuesta->visitas;
			$this->load->view('Fotos', $datos);
		}
	}

	public function obtenerFotos()
	{
		$id = $this->encrypt->decode(strtr(rawurldecode($this->input->post('id_cuenta')),array('.' => '+', '-' => '=', '~' => '/')));
		$limite = $this->input->post('limite');
		$id_album = $this->input->post('id_album');
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		$fotos = $this->Model_album->get_fotos($id, $limite, $id_album, $this->session->userdata('id'));
		if (empty($fotos)) {
			$data['estado'] = 'vacio';
			$data['publicacion'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentran mas fotos en este album</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
		foreach ($fotos as $value) {
				$date1 = new DateTime($value->fecha);
				$date2 = new DateTime(date("Y-m-d H:m:s"));
				$diff = $date1->diff($date2);
				$dateTotal = $this->Model_publicacion->get_format_time($diff);
				$data[$i]['fotos'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' id='fotos_$value->id_publicacion'><br>";
				if ($value->id_cuenta == $this->session->userdata("id")) {
						$data[$i]['fotos'] .= "<span class='w3-right' ><div id='Eliminar'><button id='btn-eliminar".random_string('alnum', 11)."' type='button' value='$value->id_publicacion' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></div></span>";
				}
        		$data[$i]['fotos'] .="
						<div class='w3-row'>
						<div class='w3-mobile w3-col' style='width:90%'>
        				<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value->foto_perfil")."' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'></a>
        				<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))."'><h4>$value->nombrePerfil $value->apellido</h4></a>
        				</div>
        				<!--<div class='w3-mobile w3-col' style='width:10%'>
        				<span class='w3-right w3-opacity'>$dateTotal</span>
        				</div>-->
        				</div>
        				<hr class='w3-clear'>
        				<p>$value->texto</p>
        		";
        		if (!empty($value->nombreAlbum)){
        			$data[$i]['fotos'] .= "
            				<img src='".base_url("assets/albumes/$value->nombreAlbum/$value->ruta/$value->titulo")."' style='width:100%' alt='.$value->titulo.' class='w3-margin-bottom'>
            			";
        		}
          		$meGusta = $this->Model_megusta->get_megusta_publicacion($value->id_publicacion,$this->session->userdata("id"));
        		if ($meGusta->estado == 'like') {
        			$colorLike = 'w3-green';
        		}else{
        			$colorLike = 'w3-theme-d1';
        		}
          		$data[$i]['fotos'] .="
          				<div id='Megusta' style='margin-top: 10px' class='w3-row'>
          				<div class='w3-mobile w3-col ' style='width:100%'>
        					<button id='btn-megusta$i' type='button' value='$value->id_publicacion' class='w3-button $colorLike w3-left'><i class='fa fa-thumbs-up'></i></button>
        					<span class='w3-left' style='margin: 10px; margin-top: 10px' id='MegustaCant' >$meGusta->countMegusta</span>	
        				</div>
        				</div> 
      					<div class='w3-row w3-border-top' id='comentarios'>
      				";
      			$comentarios = $this->Model_comentarios->get_comentarios($value->id_publicacion);
      			foreach ($comentarios as $value2) {
      				$date1 = new DateTime($value2->fecha);
					$date2 = new DateTime(date("Y-m-d H:m:s"));
					$diff = $date1->diff($date2);
					$dateTotal = $this->Model_publicacion->get_format_time($diff);
					$meGustaComent = $this->Model_megusta->get_megusta_comentario($value2->id_comentario,$this->session->userdata("id"));
					if ($meGustaComent->estado == 'like') {
	        			$colorLikeComent = 'w3-green';
	        		}else{
	        			$colorLikeComent = 'w3-theme-d1';
	        		}
      				$data[$i]['fotos'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        					<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            				<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        					<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfil $value2->apellido</a><div id='meGusta' style='display: inline;'><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></div>";
	        		if ($value2->id_usuario == $this->session->userdata("id")) {
	        			$data[$i]['fotos'] .= "<span class='w3-right' ><div id='EliminarComent' style='display: inline'><button id='btn-eliminar".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></div></span>";
	        		}
	        		$data[$i]['fotos'] .= "</h6>
                			<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
	      			}
	      			$data[$i]['fotos'] .="</div>";
	      			$data[$i]['fotos'] .= "
      						<div id='contenerComentario'>
      							<textarea id='contComentario' name='publicarComentario; class='w3-border w3-padding' style='width: 100%'' rows='1' placeholder='Comentar algo'></textarea>
      							<button class='w3-button w3-theme-d2 w3-margin-bottom' id='btn-comentar$i' value='$value->id_publicacion'><i class='fa fa-comment'></i> 	 Comment</button> 
				        	</div>
				        	
      					";
      			$data[$i]['fotos'] .="</div>";
      			$escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
    			$replacements = array("", "", "",  "",  "");
    			$data[$i]['fotos'] = str_replace($escapers, $replacements, $data[$i]['fotos']);
    			$data[$i]['idc'] = "#fotos_$value->id_publicacion #contComentario";
    			$i++;
    		}
			$data['limite'] = $limite+3;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	
		}
	}
	
}