<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_usuario");
		$this->load->model("Model_album");
		$this->load->model("Model_perfiles");
		$this->load->model("Model_notificaciones");
		$this->load->model("Model_amigos");
		$this->load->model("Model_grupo");
		$this->load->library('encrypt');
	}

	public function index()
	{
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
                'ocupacion' => $respuesta2->ocupacion,
                'pais' => $respuesta->pais,
                'telefono' => $respuesta->telefono,
                'fecha_nac' => $respuesta2->fecha_nacimiento,
                'id_cuenta' => urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~'))),
                'notificaciones' => $respuesta3,
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
            $respuesta3 = $this->Model_notificaciones->get_notificacion_count($this->session->userdata('id'));
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
                'notificaciones' => $respuesta3,
            );
                $resultado = $this->Model_perfiles->get_perfil($this->session->userdata("id"));
				$datos['perfil'] = $resultado;
				$albums = $this->Model_album->get_album($this->session->userdata("id"));
				$datos['albums'] = $albums;
        }
		$this->load->view('notificaciones', $datos);
	}

	public function obtenerNotificaciones(){
		$limite = $this->input->post("limite");
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		$resultado = $this->Model_notificaciones->get_notificaciones($this->session->userdata("id"),$limite);
		if (empty($resultado) AND $this->session->userdata("seleccion") != "pagina") {
			$data['estado'] = 'vacio';
			$data['busqueda'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentran mas notificaciones</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
			if ($this->session->userdata("seleccion") == "pagina" AND $limite == 0) {
				$resultado2 = $this->Model_usuario->get_premium($this->session->userdata('id'));
				if ($resultado2) {
					$resultado3 = $this->Model_usuario->get_premium_datos($this->session->userdata('id'));
					$fecha1 = new DateTime($resultado3->fecha_fin);
					$fecha2 = new DateTime(date("Y-m-d"));
					if ($fecha1 >= $fecha2) {
						$interval = $fecha1->diff($fecha2);
						if(intval($interval->format('%a')) <= 7){
							$data[$i]['busqueda'] = "<div class='w3-container w3-card w3-white w3-round w3-margin'><h6>Su suscripcion acabara en ".$interval->format('%a dias')."</h6></div>";
						}elseif (empty($resultado)) {
							$data['estado'] = 'vacio';
							$data['busqueda'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentran mas notificaciones</p></div>";
							echo json_encode($data);
							exit();	
						}
					}else{
						$data[$i]['busqueda'] = "<div class='w3-container w3-card w3-white w3-round w3-margin'><h6>No esperas mas y suscribete para tener beneficios</h6><a href='".base_url('inicio/suscripcion')."'><button class='w3-button w3-theme-d1 w3-margin-bottom' id='visitar'>Visitar</button></a></div>";
					}
				}else{
					$data[$i]['busqueda'] = "<div class='w3-container w3-card w3-white w3-round w3-margin'><h6>No esperas mas y suscribete para tener beneficios</h6><a href='".base_url('inicio/suscripcion')."'><button class='w3-button w3-theme-d1 w3-margin-bottom' id='visitar'>Visitar</button></a></div>";
				}
			}
			if (!empty($resultado)) {
				if ($data[$i]['busqueda'] == '') {
					$data[$i]['busqueda'] = '';
				}
				foreach ($resultado as $busqueda){
					$this->Model_notificaciones->update_notificaciones($busqueda->id_notificacion);
				    $data[$i]['busqueda'] .= "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>";
				    $data[$i]['busqueda'] .= "<a href='";
				   	if (!empty($busqueda->nombre_entidad)) {
				    	$data[$i]['busqueda'] .= base_url('inicio/pagina')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
				    }else{
				    	$data[$i]['busqueda'] .= base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
				    }
				    $data[$i]['busqueda'] .= "'><h6>";
				    if (!empty($busqueda->nombre_entidad)) {
				    	$data[$i]['busqueda'] .= $busqueda->nombre_entidad."</h6></a>";
				    }else{
				    	$data[$i]['busqueda'] .= $busqueda->nombre." ".$busqueda->apellido."</h6></a>";
				    }
				    $data[$i]['busqueda'] .= "<hr class='w3-clear'>";
				    $data[$i]['busqueda'] .= "<p>$busqueda->contenido</p>";
				    $data[$i]['busqueda'] .= "<a href='";
				    if (!empty($busqueda->nombre_entidad)) {
				    	$data[$i]['busqueda'] .= base_url('inicio/pagina')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
				    }else{
				    	$data[$i]['busqueda'] .= base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
				    }
				    $data[$i]['busqueda'] .= "'><button class='w3-button w3-theme-d1 w3-margin-bottom' id='visitar'>Visitar</button></a>";
				    $data[$i]['busqueda'] .= "</div>";
				    $escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
		    		$replacements = array("", "", "",  "",  "");
		    		$data[$i]['busqueda'] = str_replace($escapers, $replacements, $data[$i]['busqueda']);
		    		$i++;   
				}
			}
			$data['limite'] = $limite+10;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
	}
}


