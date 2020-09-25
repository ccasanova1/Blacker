<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sigue extends CI_Controller {

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
		$this->load->helper('string');
	}

	public function index()
	{
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
        if($this->session->userdata("seleccion") == "pagina"){
            $respuesta2 = $this->Model_perfiles->get_perfil_pagina($this->session->userdata("id"));
            $respuesta3 = $this->Model_notificaciones->get_notificacion_count($this->session->userdata('id'));
            $controlPremium = $this->Model_usuario->get_premium($this->session->userdata("id"));
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
                'premium' => $controlPremium,
            );
                $resultado = $this->Model_perfiles->get_perfil($this->session->userdata("id"));
				$datos['perfil'] = $resultado;
				$albums = $this->Model_album->get_album($this->session->userdata("id"));
				$datos['albums'] = $albums;
        }else{
            redirect(base_url());
        }
        $datos['buscar'] = $this->input->post("publicarBusqueda");
        $datos['visitas'] = $respuesta->visitas;
		$this->load->view('sigue', $datos);
	}

	public function busqueda(){
		$buscar = $this->input->post("buscar");
		$limite = $this->input->post("limite");
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		$resultado = $this->Model_amigos->get_busqueda_sigue($buscar,$this->session->userdata("id"),$limite);
		if (empty($resultado)) {
			$data['estado'] = 'vacio';
			$data['busqueda'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentran mas seguidores</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
			foreach ($resultado as $busqueda){
			    $data[$i]['busqueda'] = "<div class='w3-container w3-card w3-white w3-round w3-margin' id='Sigue'><br>"; 
			    $data[$i]['busqueda'] .= "<img src='";
			    $data[$i]['busqueda'] .= base_url_assets.'assets/'.$busqueda->foto_perfil;
			    $data[$i]['busqueda'] .= "' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'></a>";
			    $data[$i]['busqueda'] .= "<h5>";     
			    $data[$i]['busqueda'] .= $busqueda->nombre." ".$busqueda->apellido."</a><p>Edad:";
			    list($Y,$m,$d) = explode("-",$busqueda->fecha_nacimiento);
			    $data[$i]['busqueda'] .= ( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
			    $data[$i]['busqueda'] .= "| Telefono: ".$busqueda->telefono."</p>";
			    $data[$i]['busqueda'] .= "Correo: ".$busqueda->email."";
			    $data[$i]['busqueda'] .= "<hr class='w3-clear'>";
			    $data[$i]['busqueda'] .= "<div id='eliminar'><button class='w3-button w3-red w3-margin-bottom' id='btn-eliminar".random_string('alnum', 11)."' value = '".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))."' style='margin-left: 8px'>Bloquear</button></div></div>";
			    $escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
	    		$replacements = array("", "", "",  "",  "");
	    		$data[$i]['busqueda'] = str_replace($escapers, $replacements, $data[$i]['busqueda']);
	    		$i++;   
			}
			$data['limite'] = $limite+10;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
	}

	public function add_sigue(){
		$data = array(
			'id_usuario' => $this->session->userdata('id'),
			'id_pagina' => $this->encrypt->decode(strtr(rawurldecode($this->input->post('seguir')),array('.' => '+', '-' => '=', '~' => '/'))),
			'estado' => 'siguiendo',
			'fecha' => date("Y-m-d"),
		);		
		$resultado = $this->Model_usuario->get_usuario($data['id_pagina']);
		if(!empty($resultado)){
			$this->Model_amigos->add_sigue($data);
		}
	}

	public function eliminar_sigue(){
		$data = array(
			'id_usuario' => $this->session->userdata('id'),
			'id_pagina' => $this->encrypt->decode(strtr(rawurldecode($this->input->post('seguir')),array('.' => '+', '-' => '=', '~' => '/'))),
		);	
		$resultado = $this->Model_usuario->get_usuario($data['id_pagina']);
		if(!empty($resultado)){
			$this->Model_amigos->delete_sigue($data);
		}
	}

	public function bloquear_sigue(){
		$data = array(
			'id_pagina' => $this->session->userdata('id'),
			'id_usuario' => $this->encrypt->decode(strtr(rawurldecode($this->input->post('id_usuario')),array('.' => '+', '-' => '=', '~' => '/'))),
		);
		$resultado = $this->Model_usuario->get_usuario($data['id_usuario']);
		if(!empty($resultado)){
			$this->Model_amigos->update_sigue($data);
		}
	}
}


