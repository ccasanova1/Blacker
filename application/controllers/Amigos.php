<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amigos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_usuario");
		$this->load->model("Model_album");
		$this->load->model("Model_perfiles");
		$this->load->model("Model_amigos");
		$this->load->model("Model_grupo");
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
            redirect(base_url());
        }
        $datos['buscar'] = $this->input->post("publicarBusqueda");
        
		$this->load->view('amigos', $datos);
	}

	public function busqueda(){
		$buscar = $this->input->post("buscar");
		$limite = $this->input->post("limite");
		if ($limite == null or $limite == '') {
			$limite = 0;
		}
		$resultado = $this->Model_amigos->get_busqueda($buscar,$this->session->userdata("id"),$limite);
		if (empty($resultado)) {
			$data['estado'] = 'vacio';
			$data['busqueda'] = "<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>No se encuentran mas amigos</p></div>";
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
			foreach ($resultado as $busqueda){
			    $data[$i]['busqueda'] = "<div class='w3-container w3-card w3-white w3-round w3-margin'><br><a href='"; 
			    $data[$i]['busqueda'] .= base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			    $data[$i]['busqueda'] .= "'><img src='";
			    $data[$i]['busqueda'] .= base_url('assets/'.$busqueda->foto_perfil);
			    $data[$i]['busqueda'] .= "' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px'></a><a href='";
			    $data[$i]['busqueda'] .= base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			    $data[$i]['busqueda'] .= "'><h5>";     
			    $data[$i]['busqueda'] .= $busqueda->nombre." ".$busqueda->apellido."</a><p>Edad:";
			    list($Y,$m,$d) = explode("-",$busqueda->fecha_nacimiento);
			    $data[$i]['busqueda'] .= ( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
			    $data[$i]['busqueda'] .= "| Telefono: ".$busqueda->telefono."</p>";
			    $data[$i]['busqueda'] .= "Correo: ".$busqueda->email."";
			    $data[$i]['busqueda'] .= "<hr class='w3-clear'>";
			    $data[$i]['busqueda'] .= "<a href='";
			    $data[$i]['busqueda'] .= base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')));
			    $data[$i]['busqueda'] .= "'><button type='submit' class='w3-button w3-theme-d1 w3-margin-bottom' id='visitar'>Visitar</button></a>";
			    $data[$i]['busqueda'] .= "<button type='submit' class='w3-button w3-red w3-margin-bottom' id='eliminar' value = '".urlencode(strtr($this->encrypt->encode($busqueda->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))."' style='margin-left: 8px'>Eliminar</button></div>";
			    $escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
	    		$replacements = array("", "", "",  "",  "");
	    		$data[$i]['busqueda'] = str_replace($escapers, $replacements, $data[$i]['busqueda']);
	    		$i++;   
			}
			$data['limite'] = $limite+10;
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
	}
}


