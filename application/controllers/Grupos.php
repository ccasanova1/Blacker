<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos  extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}elseif (!$this->session->userdata("seleccion") == "usuario"){
			redirect(base_url());
		}
		$this->load->model("Model_usuario");
		$this->load->model("Model_album");
		$this->load->model("Model_perfiles");
		$this->load->model("Model_notificaciones");
		$this->load->model("Model_grupo");
		$this->load->helper(array('crear_grupo_rules'));
		$this->form_validation->set_error_delimiters('', '');
		$this->load->library('encrypt');
	}

	public function crearGrupo()
	{
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
        $respuesta2 = $this->Model_perfiles->get_perfil_usuario($this->session->userdata("id"));
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
        );
        $resultado = $this->Model_perfiles->get_perfil($this->session->userdata("id"));
		$datos['perfil'] = $resultado;
		$albums = $this->Model_album->get_album($this->session->userdata("id"));
		$datos['albums'] = $albums;
		$grupos = $this->Model_grupo->get_grupos($this->session->userdata("id"));
		$datos['grupos'] = $grupos;
       
		$this->load->view('crearGrupos', $datos);
	}

	public function verGrupo($id_grupo)
	{	
		$id_grupo = $this->encrypt->decode(strtr(rawurldecode($id_grupo),array('.' => '+', '-' => '=', '~' => '/')));
		if(!$this->Model_grupo->control_grupo($id_grupo,$this->session->userdata("id"))){
			redirect(base_url()."?error=15");
		}
		$respuesta = $this->Model_usuario->get_usuario($this->session->userdata("id"));
        $respuesta2 = $this->Model_perfiles->get_perfil_usuario($this->session->userdata("id"));
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
        );
        $resultado = $this->Model_perfiles->get_perfil($this->session->userdata("id"));
		$datos['perfil'] = $resultado;
		$albums = $this->Model_album->get_album($this->session->userdata("id"));
		$datos['albums'] = $albums;
		$grupos = $this->Model_grupo->get_grupos($this->session->userdata("id"));
		$datos['grupos'] = $grupos;
		$grupo = $this->Model_grupo->get_grupo($id_grupo);
		$datos['grupo'] = $grupo;
       
		$this->load->view('verGrupos', $datos);
	}
	
	public function ingresarGrupo(){
		$rules = getcreargruporules();
		$this->form_validation->set_rules($rules);
		$errors = NULL;
		if ($this->form_validation->run() === FALSE) {
			$errors = array(
				'nombreGrupo' => form_error('nombreGrupo'),
				'descripcionGrupo' => form_error('descripcionGrupo'),
				'foto' => '',
				);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			exit();
		}else{
			$config = [
			"upload_path" => "./assets/grupos/fotos/",
			'allowed_types' => "png|jpg|jpeg",
			"max_size" => "20480",
			"remove_spaces" => TRUE,
			"detect_mime" => TRUE,
			];
			$this->load->library("upload", $config);
			$nombreGrupo = $this->input->post('nombreGrupo');
			$descripcionGrupo = $this->input->post('descripcionGrupo');
			$ruta = $this->Model_album->get_rutaAlbum($this->session->userdata('id'));
			$id_album = $this->Model_album->set_album($ruta->nombre, $nombreGrupo, $this->session->userdata('id'));
			$dir = "/var/www/html/frontend/assets/albumes/$ruta->nombre/$nombreGrupo";
			mkdir($dir, 777, TRUE);
			if($this->upload->do_upload('foto')){
				$file_name = array('upload_data' => $this->upload->data());
				$data = array(
					'id_administrador' => $this->session->userdata("id"),
					'descripcion' => $descripcionGrupo,
					'fecha_creacion' => date('Y-m-d H:i:s'),
					'nombre' => $nombreGrupo,
					'ruta_foto' => $file_name['upload_data']['file_name'],
					'id_album' => $id_album,
				);
				$respuesta = $this->Model_grupo->set_grupo($data, $this->session->userdata("id"));
				echo urlencode(strtr($this->encrypt->encode($respuesta),array('+' => '.', '=' => '-', '/' => '~')));
			}elseif($this->upload->display_errors('','') == "You did not select a file to upload.") {
				$data = array(
					'id_administrador' => $this->session->userdata("id"),
					'descripcion' => $descripcionGrupo,
					'fecha_creacion' => date('Y-m-d H:i:s'),
					'nombre' => $nombreGrupo,
					'ruta_foto' => "Predeterminado.svg",
					'id_album' => $id_album,
				);
				$respuesta = $this->Model_grupo->set_grupo($data, $this->session->userdata("id"));
				echo urlencode(strtr($this->encrypt->encode($respuesta),array('+' => '.', '=' => '-', '/' => '~')));
			}else{
				$errors = array(
					'foto' => $this->upload->display_errors('',''),
					'nombreGrupo' => form_error('nombreGrupo'),
					'descripcionGrupo' => form_error('descripcionGrupo'),
				);
				echo json_encode($errors);
				$this->output->set_status_header(400);
				exit();
			}
		}
	}
}