<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_usuario");
		$this->load->model("Model_chat");
		$this->load->model("Model_album");
		$this->load->model("Model_perfiles");
		$this->load->model("Model_notificaciones");
		$this->load->model("Model_amigos");
		$this->load->model("Model_grupo");
		$this->load->library('encrypt');
		$this->load->helper('string');
	}

	public function setChat(){
		$id_usuarioChat = $this->input->post("id_usuarioChat");
		$comentarioChat = $this->input->post("comentarioChat");
		$resultado = $this->Model_chat->set_chat($this->session->userdata("id"),$id_usuarioChat,$comentarioChat);
		if (empty($resultado)) {
			$data[0]['busqueda'] = "<p style='text-align: right;'>$comentarioChat</p>";
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}else{
			$i = 0;
			$data = array();
			$data[$i]['busqueda'] = "<p style='text-align: right;'>$comentarioChat</p>";
			$i++;
			foreach ($resultado as $busqueda){
				if ($busqueda->id_usuario1 == $this->session->userdata("id")) {
					$data[$i]['busqueda'] = "<p style='text-align: right;'>$busqueda->texto</p>";
				}else{
					$data[$i]['busqueda'] = "<p style='text-align: left;'>$busqueda->texto</p>";
				}
			    $escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
	    		$replacements = array("", "", "",  "",  "");
	    		$data[$i]['busqueda'] = str_replace($escapers, $replacements, $data[$i]['busqueda']);
	    		$i++;
	    		$this->Model_chat->update_estado($busqueda->id_chat,$this->session->userdata("id"));   
			}
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
	}

	public function getChat(){
		$id_usuarioChat = $this->input->post("id_usuarioChat");
		$resultado = $this->Model_chat->get_chat($this->session->userdata("id"),$id_usuarioChat);
		if (empty($resultado)) {
			$data['estado'] = 'vacio';
			echo json_encode($data);
		}else{
			$i = 0;
			$data = array();
			foreach ($resultado as $busqueda){
				if ($busqueda->id_usuario1 == $this->session->userdata("id")) {
					$data[$i]['busqueda'] = "<p style='text-align: right;'>$busqueda->texto</p>";
				}else{
					$data[$i]['busqueda'] = "<p style='text-align: left;'>$busqueda->texto</p>";
				}
			    $escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
	    		$replacements = array("", "", "",  "",  "");
	    		$data[$i]['busqueda'] = str_replace($escapers, $replacements, $data[$i]['busqueda']);
	    		$i++;
	    		$this->Model_chat->update_estado($busqueda->id_chat,$this->session->userdata("id"));    
			}
			echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
	}

}


