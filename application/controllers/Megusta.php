<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Megusta extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_megusta");
		$this->load->model("Model_notificaciones");
		$this->load->model("Model_publicacion");
		$this->load->model("Model_album");
		$this->load->model("Model_comentarios");
	}

	public function setMegustaPublicacion(){
		$id_publicacion = $this->input->post('id_publicacion');
		$resultado = $this->Model_publicacion->get_datos_publicacion($id_publicacion);
		$this->Model_notificaciones->set_notificacion_megusta_usuario($this->session->userdata("id"),$resultado->id_usuario);
		$megusta = $this->Model_megusta->setget_megusta_publicacion($id_publicacion, $this->session->userdata("id"));
		echo json_encode($megusta);	
	}

	public function setMegustaAlbum(){
		$id_album = $this->input->post('id_album');
		$resultado = $this->Model_album->get_datos_album($id_album);
		$this->Model_notificaciones->set_notificacion_megustaAlbum_usuario($this->session->userdata("id"),$resultado->id_cuenta);
		$megusta = $this->Model_megusta->setget_megusta_album($id_album, $this->session->userdata("id"));
		echo json_encode($megusta);	
	}

	public function setMegustaComentario(){
		$id_comentario = $this->input->post('id_comentario');
		$resultado = $this->Model_comentarios->get_datos_comentario($id_comentario);
		$this->Model_notificaciones->set_notificacion_megustaComentario_usuario($this->session->userdata("id"),$resultado->id_usuario);
		$megusta = $this->Model_megusta->setget_megusta_comentario($id_comentario, $this->session->userdata("id"));
		echo json_encode($megusta);	
	}
	
}


