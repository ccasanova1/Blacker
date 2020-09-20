<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_usuario");
		$this->load->model("Model_perfiles");
		$this->load->model("Model_album");
		$this->load->model("Model_publicacion");
		$this->load->model("Model_notificaciones");
		$this->load->model("Model_grupo");
		$this->load->model("Model_comentarios");
		$this->load->model("Model_megusta");
		$this->load->model("Model_amigos");
		$this->load->library('form_validation');
		$this->load->helper(array('publicar_rules','string'));
		$this->form_validation->set_error_delimiters('', '');
		$this->load->library('encrypt');
	}

	public function publicar(){
		$rules = getpublicarules();
		$this->form_validation->set_rules($rules);
		$errors = NULL;
		if ($this->form_validation->run() === FALSE) {
			$errors = array(
				'publicarTexto' => form_error('publicarTexto'),
				'publicarVideo' => form_error('publicarVideo'),
				'foto' => '',
				'publicarSelectAlbum' => '',
				'publicar' => '',
				);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			exit();
		}else{
			if($this->session->userdata("seleccion") == "pagina"){
				$controlPremium = $this->Model_usuario->get_premium($this->session->userdata("id"));
				if(!$controlPremium){
					$control = $this->Model_publicacion->control_publicacion_pagina($this->session->userdata("id"));
					if ($control === FALSE) {
						$data['estado'] = 'limitada';
						echo json_encode($data);
						exit();
					}
				}
			}
			$album = $this->Model_album->get_album_id($this->input->post('publicarSelectAlbum'),$this->session->userdata("id"));
			if (empty($album)) {
				$errors = array(
				'publicarTexto' => '',
				'publicarVideo' => '',
				'foto' => '',
				'publicarSelectAlbum' => 'Album seleccion incorrecto',
				'publicar' => '',
				);
				echo json_encode($errors);
				$this->output->set_status_header(400);
				exit();
			}
			$config = [
			"upload_path" => "./assets/albumes/".$album->nombre."/".$album->ruta."/",
			'allowed_types' => "png|jpg|jpeg",
			"max_size" => "20480",
			"remove_spaces" => TRUE,
			"detect_mime" => TRUE,
			];
			$this->load->library("upload", $config);
			$comentario = $this->input->post('publicarTexto');
			$video = $this->input->post('publicarVideo');
			if($this->upload->do_upload('foto')){
				$file_name = array('upload_data' => $this->upload->data());
				$data = array(
					'id_usuario' => $this->session->userdata("id"),
					'texto' => $comentario,
					'fecha' => date('Y-m-d H:i:s'),
				);
				$respuesta = $this->Model_publicacion->set_publicacion($data);
				$this->Model_album->set_foto($file_name['upload_data']['file_name'], $album->id_album, $respuesta);
				if (!empty($video)) {
						$this->Model_publicacion->set_video($respuesta,$video);
				}
				if ($this->session->userdata("seleccion") == 'usuario') {
					$this->Model_notificaciones->set_notificacion_publicacion_usuario($this->session->userdata("id"));
				}else{
					$controlPremium = $this->Model_usuario->get_premium($this->session->userdata("id"));
					if($controlPremium){
						$this->Model_notificaciones->set_notificacion_publicacion_pagina($this->session->userdata("id"));
					}
				}
			}elseif($this->upload->display_errors('','') == "You did not select a file to upload.") {
				if (empty($comentario) AND empty($video)) {
					$errors = array(
						'publicarTexto' => '',
						'publicarVideo' => '',
						'foto' => '',
						'publicarSelectAlbum' => '',
						'publicar' => 'No a ingresado nada',
					);
					echo json_encode($errors);
					$this->output->set_status_header(400);
					exit();
				}else{
					$data = array(
						'id_usuario' => $this->session->userdata("id"),
						'texto' => $comentario,
						'fecha' => date('Y-m-d H:i:s'),
					);
					$respuesta = $this->Model_publicacion->set_publicacion($data);
					if (!empty($video)) {
						$this->Model_publicacion->set_video($respuesta,$video);
					}
					if ($this->session->userdata("seleccion") == 'usuario') {
						$this->Model_notificaciones->set_notificacion_publicacion_usuario($this->session->userdata("id"));
					}else{
						$controlPremium = $this->Model_usuario->get_premium($this->session->userdata("id"));
						if($controlPremium){
							$this->Model_notificaciones->set_notificacion_publicacion_pagina($this->session->userdata("id"));
						}
					}
				}
			}else{
				$errors = array(
				'publicarTexto' => '',
				'publicarVideo' => '',
				'foto' => $this->upload->display_errors('',''),
				'publicarSelectAlbum' => '',
				'publicar' => '',
				);
				echo json_encode($errors);
				$this->output->set_status_header(400);
				exit();
			}
		}
		//redirect(base_url());
	}

		public function publicarGrupo(){
		$rules = getpublicarules();
		$this->form_validation->set_rules($rules);
		$errors = NULL;
		$id_grupo = $this->encrypt->decode(strtr(rawurldecode($this->input->post('id_grupo')),array('.' => '+', '-' => '=', '~' => '/')));
		if ($this->form_validation->run() === FALSE) {
			$errors = array(
				'publicarTexto' => form_error('publicarTexto'),
				'publicarVideo' => form_error('publicarVideo'),
				'foto' => '',
				'publicar' => '',
				);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			exit();
		}else{
			$album = $this->Model_album->get_album_grupo($id_grupo);
			$config = [
			"upload_path" => "./assets/albumes/".$album->nombre."/".$album->ruta."/",
			'allowed_types' => "png|jpg|jpeg",
			"max_size" => "20480",
			"remove_spaces" => TRUE,
			"detect_mime" => TRUE,
			];
			$this->load->library("upload", $config);
			$comentario = $this->input->post('publicarTexto');
			$video = $this->input->post('publicarVideo');
			if($this->upload->do_upload('foto')){
				$file_name = array('upload_data' => $this->upload->data());
				$data = array(
					'id_usuario' => $this->session->userdata("id"),
					'texto' => $comentario,
					'fecha' => date('Y-m-d H:i:s'),
				);
				$respuesta = $this->Model_publicacion->set_publicacion_grupo($data, $id_grupo);
				/*$data = array(
					'id_publicacion' => $respuesta->id_publicacion,
					'id_usuario' => $this->session->userdata("id"),
				);*/
				$this->Model_album->set_foto($file_name['upload_data']['file_name'], $album->id_album, $respuesta);
				if (!empty($video)) {
						$this->Model_publicacion->set_video($respuesta,$video);
				}
				//$this->Model_notificaciones->set_notificacion_publicacion($this->session->userdata("id"));
			}elseif($this->upload->display_errors('','') == "You did not select a file to upload.") {
				if (empty($comentario) AND empty($video)) {
					$errors = array(
						'publicarTexto' => '',
						'publicarVideo' => '',
						'foto' => '',
						'publicarSelectAlbum' => '',
						'publicar' => 'No a ingresado nada',
					);
					echo json_encode($errors);
					$this->output->set_status_header(400);
					exit();
				}else{
					$data = array(
						'id_usuario' => $this->session->userdata("id"),
						'texto' => $comentario,
						'fecha' => date('Y-m-d H:i:s'),
					);
					$respuesta = $this->Model_publicacion->set_publicacion_grupo($data, $id_grupo);
					if (!empty($video)) {
						$this->Model_publicacion->set_video($respuesta,$video);
					}
				}
			}else{
				$errors = array(
				'publicarTexto' => '',
				'publicarVideo' => '',
				'foto' => $this->upload->display_errors('',''),
				'publicarSelectAlbum' => '',
				'publicar' => '',
				'algo' => "./assets/albumes/".$album->nombre."/".$album->ruta."/",
				);
				echo json_encode($errors);
				$this->output->set_status_header(400);
				exit();
			}
		}
	}

	public function obtenerPuclicaciones(){
		$limite = $this->input->post('limite');
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		$publicaciones = $this->Model_publicacion->get_publicacion($this->session->userdata("id"),$limite,$this->session->userdata("seleccion"));
		if (empty($publicaciones)) {
			$data['estado'] = 'vacio';
			$data['publicacion'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentran mas publicaciones. Publica algo o agrega a mas Amigos</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
			foreach ($publicaciones as $value) {
				$date1 = new DateTime($value->fecha);
				$date2 = new DateTime(date("Y-m-d H:m:s"));
				$diff = $date1->diff($date2);
				$dateTotal = $this->Model_publicacion->get_format_time($diff);
				if (empty($value->nombrePerfilPagina)) {
					$data[$i]['publicacion'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' style='padding-top:0px' id='publi_$value->id_publicacion'><br>";
					if ($value->id_cuenta == $this->session->userdata("id")) {
						$data[$i]['publicacion'] .= "<span class='w3-right' ><button id='btn-eliminar' type='button' value='$value->id_publicacion' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></span>";
					}
					$data[$i]['publicacion'] .="
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
				}else{
					$data[$i]['publicacion'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' style='padding-top:0px' id='publi_$value->id_publicacion'><br>";
					if ($value->id_cuenta == $this->session->userdata("id")) {
						$data[$i]['publicacion'] .= "<span class='w3-right' ><button id='btn-eliminar' type='button' value='$value->id_publicacion' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></span>";
					}
					$data[$i]['publicacion'] .="
						<div class='w3-row'>
						<div class='w3-mobile w3-col' style='width:90%'>
        				<a href='".base_url('inicio/pagina')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value->foto_perfil")."' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'></a>
        				<a href='".base_url('inicio/pagina')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))."'><h4>$value->nombrePerfilPagina</h4></a>
        				</div>
        				<!--<div class='w3-mobile w3-col' style='width:10%'>
        				<span class='w3-right w3-opacity'>$dateTotal</span>
        				</div>-->
        				</div>
        				<hr class='w3-clear'>
        				<p>$value->texto</p>
        			";
				}
				
        		if (!empty($value->nombreAlbum)){
        			$data[$i]['publicacion'] .= "
            				<img src='".base_url("assets/albumes/$value->nombreAlbum/$value->ruta/$value->titulo")."' style='width:100%' alt='.$value->titulo.' class='w3-margin-bottom'>
            			";
        		}
        		if (!empty($value->enlace)) {
        			$data[$i]['publicacion'] .= "
        					<iframe width='100%' height='415' src='https://www.youtube.com/embed/$value->enlace' frameborder='0' allow='accelerometer; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
            			";
        		}
        		$meGusta = $this->Model_megusta->get_megusta_publicacion($value->id_publicacion,$this->session->userdata("id"));
        		if ($meGusta->estado == 'like') {
        			$colorLike = 'w3-green';
        		}else{
        			$colorLike = 'w3-theme-d1';
        		}
          		$data[$i]['publicacion'] .="
          				<div style='margin-top: 10px' class='w3-row'>
          				<div id='Megusta' class='w3-mobile w3-col ' style='width:70%'>
        					<button id='btn-megusta$i' type='button' value='$value->id_publicacion' class='w3-button $colorLike w3-left'><i class='fa fa-thumbs-up'></i></button>
        					<span class='w3-left' style='margin: 10px; margin-top: 10px' id='MegustaCant' >$meGusta->countMegusta</span>	
        				</div>";
        		if ($value->id_cuenta != $this->session->userdata("id")) {
        				$data[$i]['publicacion'] .="<div id='Compartir' class='w3-mobile w3-col ' style='width:30%'>
        				<button id='btn-compartir$i' type='button' value='$value->id_publicacion' class='w3-button w3-right'>Compartir</button>
        				</div>";
        		}		
        		$data[$i]['publicacion'] .="		
        				</div> 
      					<div class='w3-row w3-border-top' id='comentarios'>";
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
					if (empty($value2->nombrePerfilPagina)) {
						$data[$i]['publicacion'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        					<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            				<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        					<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfil $value2->apellido </a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
                			<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
					}else{
						$data[$i]['publicacion'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        					<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            				<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        					<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfilPagina </a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='id_comentario' class='w3-button $colorLikeComent' style='height=15px; padding:5px; margin: 5px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
                			<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
					}    				
      			}
      			$data[$i]['publicacion'] .="</div>";
      			$data[$i]['publicacion'] .= "
      						<div id='contenerComentario'>
      							<textarea id='contComentario' name='publicarComentario; class='w3-border w3-padding' style='width: 100%'' rows='1' placeholder='Comentar algo'></textarea>
      							<button class='w3-button w3-theme-d2 w3-margin-bottom w3-margin-top w3-mobile' id='btn-comentar$i' value='$value->id_publicacion'><i class='fa fa-comment'></i> 	 Comment</button> 
				        	</div>
				        	
      					";
      			$data[$i]['publicacion'] .="</div>";
    			$data[$i]['idc'] = "#publi_$value->id_publicacion #contComentario";
    			$i++;
			}
			$escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
    		$replacements = array("", "", "",  "",  "");
			$data[$i]['publicacion'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' id='Publicidad'><br>
      			<img src='".base_url("assets/Publicidad/Publicidad.jpg")."' style='width:100%' alt='Publicidad' class='w3-margin-bottom'>
      			</div>";
    		$data[$i]['publicacion'] = str_replace($escapers, $replacements, $data[$i]['publicacion']);
			$data['limite'] = $limite+3;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	
		}
	}

	public function obtenerPuclicacionesUnico(){
		$limite = $this->input->post('limite');
		$estado = $this->input->post('estado');
		$id_cuenta = $this->encrypt->decode(strtr(rawurldecode($this->input->post('id_cuenta')),array('.' => '+', '-' => '=', '~' => '/')));
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		$publicaciones = $this->Model_publicacion->get_publicacion_unico($id_cuenta,$this->session->userdata('id'),$limite,$estado);
		if (empty($publicaciones)) {
			$data['estado'] = 'vacio';
			$data['publicacion'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentran mas publicaciones de este usuario</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;		
			$data = array();
			foreach ($publicaciones as $value) {
				$date1 = new DateTime($value->fecha);
				$date2 = new DateTime(date("Y-m-d H:m:s"));
				$diff = $date1->diff($date2);
				$dateTotal = $this->Model_publicacion->get_format_time($diff);
				if (empty($value->nombrePerfilPagina)) {
					$data[$i]['publicacion'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' style='padding-top:0px' id='publi_$value->id_publicacion'><br>";
					if ($value->id_cuenta == $this->session->userdata("id")) {
						$data[$i]['publicacion'] .= "<span class='w3-right' ><button id='btn-eliminar' type='button' value='$value->id_publicacion' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></span>";
					}
					$data[$i]['publicacion'] .="
						<div class='w3-row'>";
					if (!empty($value->id_compartida) AND $value->id_cuenta_comparte == $id_cuenta) {
						$data[$i]['publicacion'] .="
							<div class='w3-mobile w3-col' style='width:100%; margin-bottom:5px'>
	        				<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta_comparte),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value->foto_perfil_comparte")."' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'></a>
	        				<h6><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta_comparte),array('+' => '.', '=' => '-', '/' => '~')))."'>$value->nombrePerfilComparte $value->apellidoComparte</a> Comparte</h6>
	        				</div>";
					}
					$data[$i]['publicacion'] .="
						<div class='w3-mobile w3-col' style='width:100%'>
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
				}else{
					$data[$i]['publicacion'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' style='padding-top:0px' id='publi_$value->id_publicacion'><br>";
					if ($value->id_cuenta == $this->session->userdata("id")) {
						$data[$i]['publicacion'] .= "<span class='w3-right' ><button id='btn-eliminar' type='button' value='$value->id_publicacion' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></span>";
					}
					$data[$i]['publicacion'] .="
						<div class='w3-row'>";
					if (!empty($value->id_compartida) AND $value->id_cuenta_comparte == $id_cuenta) {
						$data[$i]['publicacion'] .="
							<div class='w3-mobile w3-col' style='width:100%; margin-bottom:5px'>
	        				<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta_comparte),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value->foto_perfil_comparte")."' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'></a>
	        				<h6><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta_comparte),array('+' => '.', '=' => '-', '/' => '~')))."'>$value->nombrePerfilComparte $value->apellidoComparte</a> Comparte</h6>
	        				</div>";
					}
					$data[$i]['publicacion'] .="
						<div class='w3-mobile w3-col' style='width:90%'>
        				<a href='".base_url('inicio/pagina')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value->foto_perfil")."' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'></a>
        				<a href='".base_url('inicio/pagina')."/".urlencode(strtr($this->encrypt->encode($value->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))."'><h4>$value->nombrePerfilPagina</h4></a>
        				</div>
        				<!--<div class='w3-mobile w3-col' style='width:10%'>
        				<span class='w3-right w3-opacity'>$dateTotal</span>
        				</div>-->
        				</div>
        				<hr class='w3-clear'>
        				<p>$value->texto</p>
        			";
				}
        		if (!empty($value->nombreAlbum)){
        			$data[$i]['publicacion'] .= "
            				<img src='".base_url("assets/albumes/$value->nombreAlbum/$value->ruta/$value->titulo")."' style='width:100%' alt='.$value->titulo.' class='w3-margin-bottom'>
            			";
        		}
        		if (!empty($value->enlace)) {
        			$data[$i]['publicacion'] .= "
        					<iframe width='100%' height='415' src='https://www.youtube.com/embed/$value->enlace' frameborder='0' allow='accelerometer; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
            			";
        		}
          		$meGusta = $this->Model_megusta->get_megusta_publicacion($value->id_publicacion,$this->session->userdata("id"));
        		if ($meGusta->estado == 'like') {
        			$colorLike = 'w3-green';
        		}else{
        			$colorLike = 'w3-theme-d1';
        		}
          		$data[$i]['publicacion'] .="
          				<div style='margin-top: 10px' class='w3-row'>
          				<div id='Megusta' class='w3-mobile w3-col ' style='width:70%'>
        					<button id='btn-megusta$i' type='button' value='$value->id_publicacion' class='w3-button $colorLike w3-left'><i class='fa fa-thumbs-up'></i></button>
        					<span class='w3-left' style='margin: 10px; margin-top: 10px' id='MegustaCant' >$meGusta->countMegusta</span>	
        				</div>";
        		$amigos = $this->Model_amigos->get_amigo_especifico($value->id_cuenta,$this->session->userdata("id"));
        		if (!empty($amigos)) {
        			if ($value->id_cuenta !=  $this->session->userdata("id") AND $amigos->estado == 'amigos') {
        				$data[$i]['publicacion'] .="<div id='Compartir' class='w3-mobile w3-col ' style='width:30%'>
        				<button id='btn-compartir$i' type='button' value='$value->id_publicacion' class='w3-button w3-right'>Compartir</button>
        				</div>";
        			}
        		}		
        		$data[$i]['publicacion'] .="		
        				</div> 
      					<div class='w3-row w3-border-top' id='comentarios'>";
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
      				if (empty($value2->nombrePerfilPagina)) {
						$data[$i]['publicacion'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        					<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            				<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        					<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfil $value2->apellido</a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
                			<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
					}else{
						$data[$i]['publicacion'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        					<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            				<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        					<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfilPagina</a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span>
                			<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
					}
      			}
      			$data[$i]['publicacion'] .="</div>";
      			$data[$i]['publicacion'] .= "
      						<div id='contenerComentario'>
      							<textarea id='contComentario' name='publicarComentario; class='w3-border w3-padding' style='width: 100%'' rows='1' placeholder='Comentar algo'></textarea>
      							<button class='w3-button w3-theme-d2 w3-margin-bottom' id='btn-comentar$i' value='$value->id_publicacion'><i class='fa fa-comment'></i> 	 Comment</button> 
				        	</div>				        	
      					";
      			$data[$i]['publicacion'] .="</div>";
      			$escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
    			$replacements = array("", "", "",  "",  "");
    			$data[$i]['publicacion'] = str_replace($escapers, $replacements, $data[$i]['publicacion']);
    			$data[$i]['idc'] = "#publi_$value->id_publicacion #contComentario";
    			$i++;
			}
			$data['limite'] = $limite+3;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	
		}
	}

	public function obtenerPuclicacionesGrupo(){
		$limite = $this->input->post('limite');
		$id_grupo = $this->encrypt->decode(strtr(rawurldecode($this->input->post('id_grupo')),array('.' => '+', '-' => '=', '~' => '/')));
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		$publicaciones = $this->Model_publicacion->get_publicacion_grupo($id_grupo,$limite);
		if (empty($publicaciones)) {
			$data['publicacion'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentran mas publicaciones en este grupo</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
			foreach ($publicaciones as $value) {
				$date1 = new DateTime($value->fecha);
				$date2 = new DateTime(date("Y-m-d H:m:s"));
				$diff = $date1->diff($date2);
				$dateTotal = $this->Model_publicacion->get_format_time($diff);
				$data[$i]['publicacion'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' id='publi_$value->id_publicacion'><br>";
					if ($value->id_cuenta == $this->session->userdata("id") OR $value->id_administrador == $this->session->userdata("id")) {
						$data[$i]['publicacion'] .= "<span class='w3-right' ><button id='btn-eliminar' type='button' value='$value->id_publicacion' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></span>";
					}
					$data[$i]['publicacion'] .="
						<div class='w3-row'>
						<div class='w3-mobile w3-col' style='width:90%'>
        				<img src='".base_url("assets/$value->foto_perfil")."' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'>
        				<a href=''><h4>$value->nombrePerfil $value->apellido</h4><br></a>
        				</div>
        				<!--<div class='w3-mobile w3-col' style='width:10%'>
        				<span class='w3-right w3-opacity'>$dateTotal</span>
        				</div>-->
        				</div>
        				<hr class='w3-clear'>
        				<p>$value->texto</p>
        			";
        		if (!empty($value->nombreAlbum)){
        			$data[$i]['publicacion'] .= "
            				<img src='".base_url("assets/albumes/$value->nombreAlbum/$value->ruta/$value->titulo")."' style='width:100%' alt='.$value->titulo.' class='w3-margin-bottom'>
            			";
        		}
        		if (!empty($value->enlace)) {
        			$data[$i]['publicacion'] .= "
        					<iframe width='100%' height='415' src='https://www.youtube.com/embed/$value->enlace' frameborder='0' allow='accelerometer; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
            			";
        		}
          		$meGusta = $this->Model_megusta->get_megusta_publicacion($value->id_publicacion,$this->session->userdata("id"));
        		if ($meGusta->estado == 'like') {
        			$colorLike = 'w3-green';
        		}else{
        			$colorLike = 'w3-theme-d1';
        		}
          		$data[$i]['publicacion'] .="
          				<div style='margin-top: 10px' class='w3-row'>
          				<div id='Megusta' class='w3-mobile w3-col ' style='width:70%'>
        					<button id='btn-megusta$i' type='button' value='$value->id_publicacion' class='w3-button $colorLike w3-left'><i class='fa fa-thumbs-up'></i></button>
        					<span class='w3-left' style='margin: 10px; margin-top: 10px' id='MegustaCant' >$meGusta->countMegusta</span>	
        				</div>";	
        		$data[$i]['publicacion'] .="		
        				</div> 
      					<div class='w3-row w3-border-top' id='comentarios'>";
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
      				if (empty($value2->nombrePerfilPagina)) {
						$data[$i]['publicacion'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        					<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            				<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        					<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfil $value2->apellido</a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
                			<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
					}else{
						$data[$i]['publicacion'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        					<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            				<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        					<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfilPagina</a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
                			<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
					}
      			}
      			$data[$i]['publicacion'] .="</div>";
      			$data[$i]['publicacion'] .= "
      						<div id='contenerComentario'>
      							<textarea id='contComentario' name='publicarComentario; class='w3-border w3-padding' style='width: 100%'' rows='1' placeholder='Comentar algo'></textarea>
      							<button class='w3-button w3-theme-d2 w3-margin-bottom' id='btn-comentar$i' value='$value->id_publicacion'><i class='fa fa-comment'></i> 	 Comment</button> 
				        	</div>
				        	
      					";
      			$data[$i]['publicacion'] .="</div>";
      			$escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
    			$replacements = array("", "", "",  "",  "");
    			$data[$i]['publicacion'] = str_replace($escapers, $replacements, $data[$i]['publicacion']);
    			$data[$i]['idc'] = "#publi_$value->id_publicacion #contComentario";
    			$i++;
			}
			$data['limite'] = $limite+3;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	
		}
	}

	public function obtenerPuclicacionesPagina(){
		$limite = $this->input->post('limite');
		$estado = $this->input->post('estado');
		$id_cuenta = $this->encrypt->decode(strtr(rawurldecode($this->input->post('id_cuenta')),array('.' => '+', '-' => '=', '~' => '/')));
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		$publicaciones = $this->Model_publicacion->get_publicacion_pagina($id_cuenta,$this->session->userdata('id'),$limite,$estado);
		if (empty($publicaciones)) {
			$data['estado'] = 'vacio';
			$data['publicacion'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentran mas publicaciones de esta pagina</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
			foreach ($publicaciones as $value) {
				$date1 = new DateTime($value->fecha);
				$date2 = new DateTime(date("Y-m-d H:m:s"));
				$diff = $date1->diff($date2);
				$dateTotal = $this->Model_publicacion->get_format_time($diff);
				$data[$i]['publicacion'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' style='padding-top:0px' id='publi_$value->id_publicacion'><br>";
					if ($value->id_cuenta == $this->session->userdata("id")) {
						$data[$i]['publicacion'] .= "<span class='w3-right' ><button id='btn-eliminar' type='button' value='$value->id_publicacion' class='w3-button' style='height=20px; padding:0px; margin: 0px'><i class='fa fa fa-close'></i></button></span>";
					}
					$data[$i]['publicacion'] .="
						<div class='w3-row'>
						<div class='w3-mobile w3-col' style='width:90%'>
        				<img src='".base_url("assets/$value->foto_perfil")."' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'>
        				<a href=''><h4>$value->nombrePerfil</h4><br></a>
        				</div>
        				<!--<div class='w3-mobile w3-col' style='width:10%'>
        				<span class='w3-right w3-opacity'>$dateTotal</span>
        				</div>-->
        				</div>
        				<hr class='w3-clear'>
        				<p>$value->texto</p>
        			";
        		if (!empty($value->nombreAlbum)){
        			$data[$i]['publicacion'] .= "
            				<img src='".base_url("assets/albumes/$value->nombreAlbum/$value->ruta/$value->titulo")."' style='width:100%' alt='.$value->titulo.' class='w3-margin-bottom'>
            			";
        		}
        		if (!empty($value->enlace)) {
        			$data[$i]['publicacion'] .= "
        					<iframe width='100%' height='415' src='https://www.youtube.com/embed/$value->enlace' frameborder='0' allow='accelerometer; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
            			";
        		}
          		$meGusta = $this->Model_megusta->get_megusta_publicacion($value->id_publicacion,$this->session->userdata("id"));
        		if ($meGusta->estado == 'like') {
        			$colorLike = 'w3-green';
        		}else{
        			$colorLike = 'w3-theme-d1';
        		}
          		$data[$i]['publicacion'] .="
          				<div style='margin-top: 10px' class='w3-row'>
          				<div id='Megusta' class='w3-mobile w3-col ' style='width:70%'>
        					<button id='btn-megusta$i' type='button' value='$value->id_publicacion' class='w3-button $colorLike w3-left'><i class='fa fa-thumbs-up'></i></button>
        					<span class='w3-left' style='margin: 10px; margin-top: 10px' id='MegustaCant' >$meGusta->countMegusta</span>	
        				</div>";
        		if ($value->id_cuenta !=  $this->session->userdata("id")) {
        				$data[$i]['publicacion'] .="<div id='Compartir' class='w3-mobile w3-col ' style='width:30%'>
        				<button id='btn-compartir$i' type='button' value='$value->id_publicacion' class='w3-button w3-right'>Compartir</button>
        				</div>";
        		}		
        		$data[$i]['publicacion'] .="		
        				</div> 
      					<div class='w3-row w3-border-top' id='comentarios'>";
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
      				if (empty($value2->nombrePerfilPagina)) {
						$data[$i]['publicacion'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        					<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            				<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        					<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfil $value2->apellido</a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
                			<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
					}else{
						$data[$i]['publicacion'] .= "
      						<div class='w3-col'style='width:40px; padding-top:10px'>
        					<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        					</div>
        					<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            				<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        					<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfilPagina</a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
                			<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				        	</div>
      					";
					}
      			}
      			$data[$i]['publicacion'] .="</div>";
      			$data[$i]['publicacion'] .= "
      						<div id='contenerComentario'>
      							<textarea id='contComentario' name='publicarComentario; class='w3-border w3-padding' style='width: 100%'' rows='1' placeholder='Comentar algo'></textarea>
      							<button class='w3-button w3-theme-d2 w3-margin-bottom' id='btn-comentar$i' value='$value->id_publicacion'><i class='fa fa-comment'></i> 	 Comment</button> 
				        	</div>
				        	
      					";
      			$data[$i]['publicacion'] .="</div>";
      			$escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
    			$replacements = array("", "", "",  "",  "");
    			$data[$i]['publicacion'] = str_replace($escapers, $replacements, $data[$i]['publicacion']);
    			$data[$i]['idc'] = "#publi_$value->id_publicacion #contComentario";
    			$i++;
			}
			$data['limite'] = $limite+3;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	
		}
	}

	public function algo(){
		
		echo $this->input->post('comentario');
		var_dump($this->input->post('comentario'));
	}
}

