<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compartir extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_compartir");
		$this->load->library('encrypt');
	}

	public function comparte(){
		$id_publicacion = $this->input->post('id_publicacion');
		$ControlComparte = $this->Model_compartir->control_comparte($id_publicacion,$this->session->userdata("id"));
		if ($ControlComparte) {
			$ControlComparte = $this->Model_compartir->set_comparte($id_publicacion,$this->session->userdata("id"));
			$resultado['estado'] = 'Bien';
			$resultado['id_cuenta'] = urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~')));
			echo json_encode($resultado);
		}else{
			$resultado['estado'] = 'Coincidencia';
			echo json_encode($resultado);
		}
	}
}


