<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_usuario");
		$this->load->model("Model_album");
		$this->load->model("Model_buscar");
		$this->load->model("Model_perfiles");
		$this->load->model("Model_publicacion");
		$this->load->model("Model_amigos");
		$this->load->model("Model_notificaciones");
		$this->load->model("Model_grupo");
		$this->load->model("Model_configuracion");
		$this->load->helper(array('crear_grupo_rules','configuracion_rules','file'));
		$this->form_validation->set_error_delimiters('', '');
		$this->load->library('encrypt');
	}

	public function index()
	{
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
        if($this->session->userdata("seleccion") == "usuario"){
            $respuesta2 = $this->Model_perfiles->get_perfil_usuario($this->session->userdata("id"));
            //$respuesta3 = $this->Model_notificaciones->get_notificaciones_usuarios_cont($this->session->userdata('id'));

            $datos = array(
                'nombre' => $respuesta2->nombre,
                'apellido' => $respuesta2->apellido,
                "foto_perfil" => $respuesta->foto_perfil,
                'seleccion' => $this->session->userdata("seleccion"),
                'buscar' => 'Buscar',
                'ocupacion' => $respuesta2->ocupacion,
                'pais' => $respuesta->pais,
                'fecha_nac' => $respuesta2->fecha_nacimiento,
                'id_cuenta' => urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~'))),
                //'notificaciones' => $respuesta3,
            );
            $resultado = $this->Model_perfiles->get_perfil($this->session->userdata("id"));
			$datos['perfil'] = $resultado;
			$albums = $this->Model_album->get_album($this->session->userdata("id"));
			$datos['albums'] = $albums;
			$grupos = $this->Model_grupo->get_grupos($this->session->userdata("id"));
			$datos['grupos'] = $grupos;
			$pendienteAmigos = $this->Model_amigos->get_pendiente($this->session->userdata("id"));
			$datos['amigoPendiente'] = $pendienteAmigos;
        }else{
            $respuesta2 = $this->Model_perfiles->get_perfil_pagina($this->session->userdata("id"));
            $datos = array(
                'nombre_pagina' => $respuesta2->nombre_entidad,
                "foto_perfil" => $respuesta->foto_perfil,
                'seleccion' => $this->session->userdata("seleccion"),
                'pais' => $respuesta->pais,
                'buscar' => 'Buscar',
  				'calle' => $respuesta2->calle,
  				'numero' => $respuesta2->numero,
  				'esquina' => $respuesta2->esquina,
  				'descripcion' => $respuesta2->descripcion,
                'id_cuenta' => urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~'))),
            );
                $resultado = $this->Model_perfiles->get_perfil($this->session->userdata("id"));
				$datos['perfil'] = $resultado;
				$albums = $this->Model_album->get_album($this->session->userdata("id"));
				$datos['albums'] = $albums;
        }
        
		$this->load->view('inicio', $datos);
	}

	public function buscar(){

		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
		if($this->session->userdata("seleccion") == "usuario"){
			$respuesta2 = $this->Model_perfiles->get_perfil_usuario($this->session->userdata("id"));
            //$respuesta3 = $this->Model_notificaciones->get_notificaciones_usuarios_cont($this->session->userdata('id'));
            //$respuesta4 = $this->Model_grupo->get_grupos_ingresados($this->session->userdata("id"));
            $datos = array(
                'nombre' => $respuesta2->nombre,
                'apellido' => $respuesta2->apellido,
                "foto_perfil" => $respuesta->foto_perfil,
                'seleccion' => $this->session->userdata("seleccion"),
                'buscar' => 'Buscar',
                'ocupacion' => $respuesta2->ocupacion,
                'pais' => $respuesta->pais,
                'fecha_nac' => $respuesta2->fecha_nacimiento,
                'id_cuenta' => urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~'))),
                //'notificaciones' => $respuesta3,
                //'grupo_ingresado' => $respuesta4,
            );
            $resultado= $this->Model_perfiles->get_perfil($this->session->userdata("id"));
            $datos['perfil'] = $resultado;  
           	$albums = $this->Model_album->get_album($this->session->userdata("id"));
			$datos['albums'] = $albums;	
			$grupos = $this->Model_grupo->get_grupos($this->session->userdata("id"));
			$datos['grupos'] = $grupos;
			$pendienteAmigos = $this->Model_amigos->get_pendiente($this->session->userdata("id"));
			$datos['amigoPendiente'] = $pendienteAmigos;   			
		}else{
			redirect(base_url());
		}

		$datos['buscar'] = $this->input->post("publicarBusqueda");
		$datos['usuario'] = $this->input->post("busquedaUsuario");
		$datos['pagina'] = $this->input->post("busquedaPagina");
		$datos['grupo'] = $this->input->post("busquedaGrupo");
		//$datos['resultado'] = $this->Model_buscar->get_busqueda($this->input->post("buscar"));
		/*$datos['resultado2'] = $this->Model_grupo->get_buscar_grupos($this->input->post("buscar"));*/
		//$this->load->view('layouts/header', $datos);
		$this->load->view('buscar', $datos);
	}

	public function perfil($id){
		$id = $this->encrypt->decode(strtr(rawurldecode($id),array('.' => '+', '-' => '=', '~' => '/')));
		if ($id == null OR $id == '') {
			redirect(base_url("?error=IdFail"));
		}
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
		if($this->session->userdata("seleccion") == "usuario"){
			$respuesta2 = $this->Model_perfiles->get_perfil_usuario($this->session->userdata("id"));
            //$respuesta3 = $this->Model_notificaciones->get_notificaciones_usuarios_cont($this->session->userdata('id'));
            $datos = array(
                'nombre' => $respuesta2->nombre,
                'apellido' => $respuesta2->apellido,
                "foto_perfil" => $respuesta->foto_perfil,
                'seleccion' => $this->session->userdata("seleccion"),
                'buscar' => 'Buscar',
                //'notificaciones' => $respuesta3,
            ); 			
		}else{
			redirect(base_url());
		}
		$this->Model_perfiles->increment_visit($id);
		$resultado = $this->Model_perfiles->get_perfil($id);
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
		$this->load->view('perfil', $datos);
	}

	public function pagina($id){
		$id = $this->encrypt->decode(strtr(rawurldecode($id),array('.' => '+', '-' => '=', '~' => '/')));
		$bloqueado = $this->Model_amigos->get_sigue_pagina($id, $this->session->userdata('id'));
		if ($bloqueado != null AND $bloqueado != '') {
			if ($bloqueado->estado == 'Bloqueado') {
				redirect(base_url('?error=BlockPage'));
			}
		}
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
		if($this->session->userdata("seleccion") == "usuario"){
			$respuesta2 = $this->Model_perfiles->get_perfil_usuario($this->session->userdata("id"));
            //$respuesta3 = $this->Model_notificaciones->get_notificaciones_usuarios_cont($this->session->userdata('id'));
            $datos = array(
                'nombre' => $respuesta2->nombre,
                'apellido' => $respuesta2->apellido,
                "foto_perfil" => $respuesta->foto_perfil,
                'seleccion' => $this->session->userdata("seleccion"),
                'buscar' => 'Buscar',
                //'notificaciones' => $respuesta3,
            ); 			
		}else{
			redirect(base_url());
		}
		$this->Model_perfiles->increment_visit($id);
		$resultado = $this->Model_perfiles->get_perfil($id);
		//$respuesta2 = $this->Model_publicacion->get_publicacion($id);
		//$respuesta3 = $this->Model_album->get_foto_publicada($id);
		$respuesta4 = $this->Model_usuario->get_usuario($id);
		$respuesta5 = $this->Model_amigos->get_sigue_pagina($id, $this->session->userdata('id'));
		$datos['perfil'] = $resultado;
		$datos['perfil']->id_cuenta = urlencode(strtr($this->encrypt->encode($datos['perfil']->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
		$datos['cuenta'] = $respuesta4;
		$datos['sigue'] = $respuesta5;
		if (empty($datos['sigue'])) {
			$datos['sigue'] = new \stdClass(); 
			$datos['sigue']->estado = '';
		}
		/*$datos .= array(
			'perfil' => $resultado,
			//'publicacion' => $respuesta2,
			//'foto_publicacion' => $respuesta3,
			'cuenta' => $respuesta4,
			'amigo'	=> $respuesta5,
		);*/
		$this->load->view('pagina', $datos);
	}

	public function add_amigo(){
		$data = array(
			'id_usuario1' => $this->session->userdata('id'),
			'id_usuario2' => $this->encrypt->decode(strtr(rawurldecode($this->input->post('amigo')),array('.' => '+', '-' => '=', '~' => '/'))),
			'estado' => 'pendiente',
			'fecha' => date("Y-m-d"),
		);
		$this->Model_amigos->set_addamigo($data);
		/*$data = array(
			'id_usuario1' => $this->session->userdata('id'),
			'id_usuario2' => $this->input->post('amigo'),
			'fecha' => date("Y-m-d"),
			'contenido' => 'Quiero ser tu amigo',
			'estado' => 'pendiente',
			'tipo_notificacion' => 'amistad',
		);
		$this->Model_notificaciones->set_notificacion($data);*/
	}

	public function busqueda(){
		$usuario = $this->input->post("usuario");
		$pagina = $this->input->post("pagina");
		$grupo = $this->input->post("grupo");
		$buscar = $this->input->post("buscar");
		$limite = $this->input->post("limite");
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		if (empty($usuario) AND empty($pagina) AND empty($grupo)) {
			$usuario ="Usuario";
			$pagina = "Pagina";
			$grupo = "Grupo";
		}
		$resultado = $this->Model_buscar->get_busqueda($buscar,$usuario,$pagina,$grupo,$limite);
		if (empty($resultado)) {
			$data['estado'] = 'vacio';
			$data['busqueda'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentra resultado</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
			foreach ($resultado as $busqueda){
			    $data[$i]['busqueda'] = "<div class='w3-container w3-card w3-white w3-round w3-margin'><br><a href='"; 
			    if($busqueda->tipo == 'usuario'){
			      $data[$i]['busqueda'] .= base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			    }elseif($busqueda->tipo == 'pagina'){
			      $data[$i]['busqueda'] .= base_url('inicio/pagina')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			    }else{
			      $data[$i]['busqueda'] .= base_url('Grupos/verGrupo')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_grupo),array('+' => '.', '=' => '-', '/' => '~')));
			    }
			    $data[$i]['busqueda'] .= "'><img src='";
			    if($busqueda->tipo == 'usuario'){
			      $data[$i]['busqueda'] .= base_url('assets/'.$busqueda->foto_perfil);
			    }elseif($busqueda->tipo == 'pagina'){
			      $data[$i]['busqueda'] .= base_url('assets/'.$busqueda->foto_perfil);
			    }else{
			      $data[$i]['busqueda'] .= base_url('assets/grupos/fotos/'.$busqueda->foto_perfil);
			    }
			    $data[$i]['busqueda'] .= "' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'></a><a href='";
			    if($busqueda->tipo == 'usuario'){
			      $data[$i]['busqueda'] .= base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			    }elseif($busqueda->tipo == 'pagina'){
			      $data[$i]['busqueda'] .= base_url('inicio/pagina')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			    }else{
			      $data[$i]['busqueda'] .= base_url('Grupos/verGrupo')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_grupo),array('+' => '.', '=' => '-', '/' => '~')));
			    } 
			    $data[$i]['busqueda'] .= "'><h5>";
			    if($busqueda->tipo == 'pagina'){
			      $data[$i]['busqueda'] .= $busqueda->nombre."</a> | Es una pagina";       
			    }elseif($busqueda->tipo == 'usuario'){
			      $data[$i]['busqueda'] .= $busqueda->nombre." ".$busqueda->apellido."</a><p>Edad:";
			      list($Y,$m,$d) = explode("-",$busqueda->fecha_nacimiento);
			      $data[$i]['busqueda'] .= ( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
			      $data[$i]['busqueda'] .= "| Telefono: ".$busqueda->telefono."</p>";
			    }else{
			      $data[$i]['busqueda'] .= $busqueda->nombre."</a> | Es un grupo <p> ".$busqueda->fecha_creacion."</p>";
			    }
			    $data[$i]['busqueda'] .= "<hr class='w3-clear'>";
			    if($busqueda->tipo == 'pagina' OR $busqueda->tipo == 'grupo'){ 
			      $data[$i]['busqueda'] .="<p>".$busqueda->descripcion."</p>";
			    }
			    $data[$i]['busqueda'] .= "<a href='";
			    if($busqueda->tipo == 'usuario'){
			      $data[$i]['busqueda'] .= base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			    }elseif($busqueda->tipo == 'pagina'){
			      $data[$i]['busqueda'] .= base_url('inicio/pagina')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			    }else{
			      $data[$i]['busqueda'] .= base_url('Grupos/verGrupo')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_grupo),array('+' => '.', '=' => '-', '/' => '~')));
			    } 
			    $data[$i]['busqueda'] .= "'><button type='submit' class='w3-button w3-theme-d1 w3-margin-bottom' id='visitar'>Visitar</button></a></div>";
			    $escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
	    		$replacements = array("", "", "",  "",  "");
	    		$data[$i]['busqueda'] = str_replace($escapers, $replacements, $data[$i]['busqueda']);
	    		$i++;   
			}
			$data['limite'] = $limite+10;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
	}

	public function aceptar_amigo(){
		$id = $this->input->post("id");
		$id = $this->encrypt->decode(strtr(rawurldecode($id),array('.' => '+', '-' => '=', '~' => '/')));
		$this->Model_amigos->update_amigo_ok($id, $this->session->userdata('id'));
	}

	public function rechazar_amigo(){
		$id = $this->input->post("id");
		$id = $this->encrypt->decode(strtr(rawurldecode($id),array('.' => '+', '-' => '=', '~' => '/')));
		$this->Model_amigos->update_amigo_fail($id, $this->session->userdata('id'));
	}

	public function configuracion(){
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
		if($this->session->userdata("seleccion") == "usuario"){
			$respuesta2 = $this->Model_perfiles->get_perfil_usuario($this->session->userdata("id"));
            //$respuesta3 = $this->Model_notificaciones->get_notificaciones_usuarios_cont($this->session->userdata('id'));
            //$respuesta4 = $this->Model_grupo->get_grupos_ingresados($this->session->userdata("id"));
            $datos = array(
                'nombre' => $respuesta2->nombre,
                'apellido' => $respuesta2->apellido,
                "foto_perfil" => $respuesta->foto_perfil,
                'seleccion' => $this->session->userdata("seleccion"),
                'buscar' => 'Buscar',
                'ocupacion' => $respuesta2->ocupacion,
                'pais' => $respuesta->pais,
                'fecha_nac' => $respuesta2->fecha_nacimiento,
                'id_cuenta' => urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~'))),
                //'notificaciones' => $respuesta3,
                //'grupo_ingresado' => $respuesta4,
            );
            $resultado= $this->Model_perfiles->get_perfil($this->session->userdata("id"));
            $datos['perfil'] = $resultado;  
           	$albums = $this->Model_album->get_album($this->session->userdata("id"));
			$datos['albums'] = $albums;	
			$grupos = $this->Model_grupo->get_grupos($this->session->userdata("id"));
			$datos['grupos'] = $grupos;
			$pendienteAmigos = $this->Model_amigos->get_pendiente($this->session->userdata("id"));
			$datos['amigoPendiente'] = $pendienteAmigos;    			
		}else{
            $respuesta2 = $this->Model_perfiles->get_perfil_pagina($this->session->userdata("id"));
            $datos = array(
                'nombre_pagina' => $respuesta2->nombre_entidad,
                "foto_perfil" => $respuesta->foto_perfil,
                'seleccion' => $this->session->userdata("seleccion"),
                'pais' => $respuesta->pais,
                'buscar' => 'Buscar',
  				'calle' => $respuesta2->calle,
  				'numero' => $respuesta2->numero,
  				'esquina' => $respuesta2->esquina,
  				'descripcion' => $respuesta2->descripcion,
                'id_cuenta' => urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~'))),
            );
                $resultado = $this->Model_perfiles->get_perfil($this->session->userdata("id"));
				$datos['perfil'] = $resultado;
				$albums = $this->Model_album->get_album($this->session->userdata("id"));
				$datos['albums'] = $albums;
		}
		$configuracion = $this->Model_configuracion->get_configuracion($this->session->userdata("id"));
		$datos['configuracion'] = $configuracion;
		$this->load->view('configuracion', $datos);
	}

	public function configurar(){
		$seleccion = $this->session->userdata("seleccion");
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
		if ($seleccion == 'usuario') {
			$rules = getregistroRulesConfig1();
		  	$this->form_validation->set_rules($rules);
		  	$date = $this->input->post('fechaNacUsuario');
		  	$fecha_nac = '';
		  	if($date > date("Y-m-d") or $date < '1900-01-01'){
		  		$fecha_nac = "Ingrese una fecha valida";
		  	}
			if ($this->form_validation->run() === FALSE or !empty($fecha_nac)) {
				$errors = array(
					'nombreUsuario' => form_error('nombreUsuario'),
					'apellidoUsuario' => form_error('apellidoUsuario'),
					'telefonoUsuario' => form_error('telefonoUsuario'),
					'estadoSentimentalUsuario' => form_error('estadoSentimentalUsuario'),
					'ocupacionUsuario' => form_error('ocupacionUsuario'),
					'generoUsuario' => form_error('generoUsuario'),
                	'paisUsuario' => form_error('paisUsuario'),
                	'fechaNacUsuario' => form_error('fechaNacUsuario'),
                    'fechaNacUsuario' => $fecha_nac,
                    'seleccion' => $seleccion,
					);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			exit();
        	}
            $config = [
			"upload_path" => "./assets/imagenes/",
			'allowed_types' => "png|jpg",
			"remove_spaces" => TRUE,
			"detect_mime" => TRUE,
			'encrypt_name' => TRUE,
            ];
            $this->load->library("upload", $config);
		    $pais = $this->input->post('paisUsuario');
		    $telefono = $this->input->post('telefonoUsuario');
            $nombre = $this->input->post('nombreUsuario');
			$apellido = $this->input->post('apellidoUsuario');
			$fecha_nac = $this->input->post('fechaNacUsuario');+
			$estado_sentimental = $this->input->post('estadoSentimentalUsuario');
			$ocupacion = $this->input->post('ocupacionUsuario');
			$genero = $this->input->post('generoUsuario');
            if(!$this->upload->do_upload('fotoUsuario') ){
                $data = array(
                'pais' => $pais,
                'telefono' => $telefono,
            );
            }else{
            	$foto_perfil = array('upload_data' => $this->upload->data());
            	delete_files('./assets/'.$respuesta->foto_perfil);
            	$data = array(
                'pais' => $pais,
                'telefono' => $telefono,
                'foto_perfil' => 'imagenes/'.$foto_perfil['upload_data']['file_name'],
            	);
            	$respuestaFoto = $this->Model_usuario->get_fotoPerfil($this->session->userdata("id"));
            	$pos = strpos($respuestaFoto->foto_perfil, "predeterminado1");
            	if ($pos === FALSE) {            		
            		unlink('/var/www/html/frontend/assets/'.$respuestaFoto->foto_perfil) or die("Failed to <strong class='highlight'>delete</strong> file");
            	}
            }
            $config = array(
            	'not_publicacion' => ($this->input->post('mostrarPublicaciones') == 'si') ? 'si' : 'no',
            	'not_comentario' => ($this->input->post('permitirComentarios') == 'si') ? 'si' : 'no',
            	'not_megusta' => ($this->input->post('permitirMeGustas') == 'si') ? 'si' : 'no',
            );
            $this->Model_configuracion->update_configuracion($config,$this->session->userdata("id"));
            $this->Model_configuracion->update_usuario($data,$this->session->userdata("id"));
            $data2 = array(
                'nombre' => $nombre,
                'apellido' => $apellido,
                'fecha_nacimiento' => $fecha_nac,
                'estado_sentimental' => $estado_sentimental,
                'ocupacion' => $ocupacion,
                'genero' => $genero,
            );		
			$this->Model_configuracion->update_perfil_usuario($data2,$this->session->userdata("id"));
		}elseif ($seleccion == 'Pagina') {
			$rules = getregistroRulesConfig2();
		  	$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() === FALSE or !empty($fecha_nac)) {
				$errors = array(
					'nombreEntidad' => form_error('nombreEntidad'),
					'paisPagina' => form_error('paisPagina'),
					'callePagina' => form_error('callePagina'),
                	'numeroPagina' => form_error('numeroPagina'),
                	'esquinaPagina' => form_error('esquinaPagina'),
                	'telefonoPagina' => form_error('telefonoPagina'),
                	'descripcionPagina' => form_error('descripcionPagina'),
                	'seleccion' => $seleccion,
					);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			exit();
        	}
            $config = [
			"upload_path" => "./assets/imagenes/",
			'allowed_types' => "png|jpg",
			"remove_spaces" => TRUE,
			"detect_mime" => TRUE,
			'encrypt_name' => TRUE,
			];
            $this->load->library("upload", $config);
            $nombreEntidad = $this->input->post('nombreEntidad');
            $paisPagina = $this->input->post('paisPagina');
			$callePagina = $this->input->post('callePagina');
			$numeroPagina = $this->input->post('numeroPagina');
			$esquinaPagina = $this->input->post('esquinaPagina');
			$telefonoPagina = $this->input->post('telefonoPagina');
			$descripcionPagina = $this->input->post('descripcionPagina');
            if(!$this->upload->do_upload('foto_perfil') ){
                $data = array(
                	'pais' => $paisPagina,
                	'telefono' => $telefonoPagina,
            	);
            }else{
            	$foto_perfil = array('upload_data' => $this->upload->data());
				delete_files('./assets/'.$respuesta->foto_perfil);
            	$data = array(
                	'pais' => $paisPagina,
                	'telefono' => $telefonoPagina,
                	'foto_perfil' => 'imagenes/'.$foto_perfil['upload_data']['file_name'],
            	);
            	$respuestaFoto = $this->Model_usuario->get_fotoPerfil($this->session->userdata("id"));
            	$pos = strpos($respuestaFoto->foto_perfil, "predeterminado1");
            	if ($pos === FALSE) {            		
            		unlink('/var/www/html/frontend/assets/'.$respuestaFoto->foto_perfil) or die("Failed to <strong class='highlight'>delete</strong> file");
            	}
            }
            $this->Model_configuracion->update_usuario($data,$this->session->userdata("id"));
            $data2 = array(
						'nombre_entidad' => $nombreEntidad,
						'calle' => $callePagina,
						'numero' => $numeroPagina,
						'esquina' => $esquinaPagina,
						'descripcion' => $descripcionPagina,
					);	
			$this->Model_configuracion->update_perfil_pagina($data2,$this->session->userdata("id"));
		}
	}

	public function redirect(){

		redirect(base_url());
		
	}
}