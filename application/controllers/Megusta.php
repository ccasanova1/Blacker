<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Megusta extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_megusta");
	}

	public function setMegustaPublicacion(){
		$id_publicacion = $this->input->post('id_publicacion');
		$megusta = $this->Model_megusta->setget_megusta_publicacion($id_publicacion, $this->session->userdata("id"));
		echo json_encode($megusta);	
	}

	public function setMegustaAlbum(){
		$id_album = $this->input->post('id_album');
		$megusta = $this->Model_megusta->setget_megusta_album($id_album, $this->session->userdata("id"));
		echo json_encode($megusta);	
	}

	public function setMegustaComentario(){
		$id_comentario = $this->input->post('id_comentario');
		$megusta = $this->Model_megusta->setget_megusta_comentario($id_comentario, $this->session->userdata("id"));
		echo json_encode($megusta);	
	}
	
}


