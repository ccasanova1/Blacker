<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Model_usuario");
		$this->load->model("Model_perfiles");
		$this->load->model("Model_album");
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->helper(array('login_rules', 'registro_rules', 'registro_random'));
		$this->form_validation->set_error_delimiters('', '');
	}

	public function index()
	{	

		if ($this->session->userdata("login")) {
			redirect(base_url()."inicio");
		}
		$this->load->view('login');
	}

	public function loguear(){
		$rules = getloginrules();
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === FALSE) {
			$errors = array(
				'email' => form_error('email'),
				'password' => form_error('password'),
				);
			echo json_encode($errors);
			$this->output->set_status_header(400);
		}else{
			$email = $this->input->post('email');
			$pass = $this->input->post('password');
			$respuesta = $this->Model_usuario->get_usuario_comp($email);
			if (!empty($respuesta)) {
				if (password_verify($pass , $respuesta->pass)) {
					if ($respuesta->activador == 'activo') {
						$chequear = $this->Model_perfiles->get_perfil_usuario($respuesta->id_cuenta);
						if (!$chequear){
							$data = array(
								'id' => $respuesta->id_cuenta,
								'login' => TRUE,
								'seleccion' => "pagina",
							);
						}else{
							$data = array(
								'id' => $respuesta->id_cuenta,
								'login' => TRUE,
								'seleccion' => "usuario",
							);
						}
						$this->session->set_userdata($data);
					}else{
						echo json_encode(array('msg' => 'El usuario no esta activo'));
						$this->output->set_status_header(401);
					}
				}else{
					echo json_encode(array('msg' => 'Email y/o Contraseña incorrecto'));
					$this->output->set_status_header(401);
				}
			}else{
				echo json_encode(array('msg' => 'Email y/o Contraseña incorrecto'));
				$this->output->set_status_header(401);
			}
		}			
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function registrar(){
		if ($this->session->userdata("login")) {
			redirect(base_url()."inicio");
		}
		$this->load->view('registro');
	}

	public function registro(){
		$seleccion = $this->input->post('seleccion',TRUE);
		if ($seleccion == 'Usuario') {
			$rules = getregistroRules1();
		  	$this->form_validation->set_rules($rules);
		  	$date = $this->input->post('fecha_nac');
		  	$fecha_nac = '';
		  	if($date > date("Y-m-d") or $date < '1900-01-01'){
		  		$fecha_nac = "Ingrese una fecha valida";
		  	}
			if ($this->form_validation->run() === FALSE or !empty($fecha_nac)) {
				$errors = array(
					'email' => form_error('email'),
					'password' => form_error('password'),
					'rep_password' => form_error('rep_password'),
					'telefono' => form_error('telefono'),
                	'pais' => form_error('pais'),
                	'nombre' => form_error('nombre'),
					'apellido' => form_error('apellido'),
                	'fecha_nac' => form_error('fecha_nac'),
                    'fecha_nac' => $fecha_nac,
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
            $email = $this->input->post('email');
		    $password = $this->input->post('password');
		    $hash = password_hash($password, PASSWORD_BCRYPT);
		    $hash2 = randomString();
		    $fechacreacion = date("Y-m-d");
		    $pais = $this->input->post('pais');
		    $telefono = $this->input->post('telefono');
            $nombre = $this->input->post('nombre');
			$apellido = $this->input->post('apellido');
			$fecha_nac = $this->input->post('fecha_nac');
            if(!$this->upload->do_upload('foto_perfil') ){
                $foto_perfil = "imagenes/predeterminado1.svg";
                $data = array(
                'email' => $email,
                'pass' => $hash,
                'fecha_creacion' => $fechacreacion,
                'pais' => $pais,
                'telefono' => $telefono,
                'foto_perfil' => $foto_perfil,
                'activador' => $hash2,
            );
            }else{
            	$foto_perfil = array('upload_data' => $this->upload->data());
            	//chmod("/var/www/html/frontend/assets/imagenes/".$foto_perfil['upload_data']['file_name'], 0777);
            	$data = array(
                'email' => $email,
                'pass' => $hash,
                'fecha_creacion' => $fechacreacion,
                'pais' => $pais,
                'telefono' => $telefono,
                'foto_perfil' =>  "imagenes/".$foto_perfil['upload_data']['file_name'],
                'activador' => $hash2,
            );
            }
            //$respuesta = $this->Model_perfiles->get_configuracion_especifica();
            $this->Model_usuario->set_usuario($data);
            $id = $this->Model_usuario->get_usuario_comp($email);
            $data2 = array(
            	'id_cuenta' => $id->id_cuenta,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'fecha_nacimiento' => $fecha_nac,
                //'id_configuracion' => $respuesta->id_configuracion,
            );
            $config = array(
            	'not_publicacion' => 'si',
            	'not_comentario' => 'si',
            	'not_megusta' => 'si',
            	'not_comparte' => 'si',
            	'not_perfil' => 'si',
            );
			$this->Model_perfiles->set_perfil_usuario($data2);
            $this->Model_perfiles->set_configuracion($config,$id->id_cuenta);
            $dato = "Mi albun".$id->id_cuenta;
            $this->Model_album->set_album($dato, "Predeterminado", $id->id_cuenta);
			$respuesta = $this->Model_album->get_album_especifico($dato);
			$data3 = array(
				'id_cuenta' => $id->id_cuenta,
				'id_album' => $respuesta->id_album,
			);
			$dir = "/var/www/html/frontend/assets/albumes/".$dato;
			mkdir($dir, 0777, TRUE);
			$dir2 = "/var/www/html/frontend/assets/albumes/".$dato."/Predeterminado";
			mkdir($dir2, 0777, TRUE);
			$conf['protocol'] = 'smtp';
			$conf['smtp_host'] = 'blacker.com.uy';
			$conf['smtp_port'] = 465;
			$conf['smtp_user'] = 'dragon2@blacker.com.uy';
			$conf['smtp_pass'] = '3ntradA..';
			$conf['smtp_crypto'] = 'ssl';
			$conf['charset'] = 'utf-8';
			$conf['mailtype'] = 'html';
			$conf['wordwrap'] = TRUE;
			$conf['validate'] = TRUE;
			$this->email->initialize($conf);
			$this->email->set_newline("\r\n"); 
			$this->email->from('dragon2@blacker.com.uy');
			$this->email->to($email);
			$this->email->subject('Activacion de cuenta Blacker');
			$this->email->message('<h2>Active su cuenta Blacker</h2>
				<hr><br>
				Bienvenido a Blacker, este mensage esta destinado para poder activar su cuenta en nuestra Red Social
				<br>
				Ingrese al enlace que se le ortogo y podra ingresar a nuestra comunidad
				<br>
				<a href="'.base_url('login/activacion').'/'.$hash2.'">'.base_url('login/activacion').'/'.$hash2.'</a>
				<br>');
			for ($i=1; $i <=1 ; $i++) { 
				if (!$this->email->send()) {
					show_error($this->email->print_debugger());
				}
				sleep(1);
			}
			$this->session->set_flashdata('info','Se a enviado un correo para poder activar la cuenta');
			$this->session->set_flashdata('estado','esperando');
		}elseif ($seleccion == 'Pagina') {
			$rules = getregistroRules2();
		  	$this->form_validation->set_rules($rules);
		  	$date = $this->input->post('fecha_nac');
			if ($this->form_validation->run() === FALSE or !empty($fecha_nac)) {
				$errors = array(
					'email' => form_error('email'),
					'password' => form_error('password'),
					'rep_password' => form_error('rep_password'),
                	'telefono' => form_error('telefono'),
                	'pais' => form_error('pais'),
                	'nombre_pag' => form_error('nombre_pag'),
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
            $email = $this->input->post('email');
			$password = $this->input->post('password');
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$hash2 = randomString();
			$fechacreacion = date("Y-m-d");
			$pais = $this->input->post('pais');
			$telefono = $this->input->post('telefono');
			$nombre_pag = $this->input->post('nombre_pag');
            if(!$this->upload->do_upload('foto_perfil') ){
                $foto_perfil = "imagenes/predeterminado1.svg";
                $data = array(
                'email' => $email,
                'pass' => $hash,
                'fecha_creacion' => $fechacreacion,
                'pais' => $pais,
                'telefono' => $telefono,
                'foto_perfil' => $foto_perfil,
                'activador' => $hash2,
            );
            }else{
            	$foto_perfil = array('upload_data' => $this->upload->data());
            	//chmod("/var/www/html/frontend/assets/imagenes/".$foto_perfil['upload_data']['file_name'], 0777);
            	$data = array(
                'email' => $email,
                'pass' => $hash,
                'fecha_creacion' => $fechacreacion,
                'pais' => $pais,
                'telefono' => $telefono,
                'foto_perfil' => "imagenes/".$foto_perfil['upload_data']['file_name'],
                'activador' => $hash2,
            );
            }
            $this->Model_usuario->set_usuario($data);
            $id = $this->Model_usuario->get_usuario_comp($email);
            $data2 = array(
						'id_cuenta' => $id->id_cuenta,
						'nombre_entidad' => $nombre_pag,
					);
            $dato = "Mi albun".$id->id_cuenta;
            $this->Model_album->set_album($dato, "Predeterminado", $id->id_cuenta);
			$respuesta = $this->Model_album->get_album_especifico($dato);
			$data3 = array(
				'id_cuenta' => $id->id_cuenta,
				'id_album' => $respuesta->id_album,
			);
			$dir = "/var/www/html/frontend/assets/albumes/".$dato;
			mkdir($dir, 0777, TRUE);
			$dir2 = "/var/www/html/frontend/assets/albumes/".$dato."/Predeterminado";
			mkdir($dir2, 0777, TRUE);		
			$this->Model_perfiles->set_perfil_pagina($data2);
			$conf['protocol'] = 'smtp';
			$conf['smtp_host'] = 'blacker.com.uy';
			$conf['smtp_port'] = 465;
			$conf['smtp_user'] = 'dragon2@blacker.com.uy';
			$conf['smtp_pass'] = '3ntradA..';
			$conf['smtp_crypto'] = 'ssl';
			$conf['charset'] = 'utf-8';
			$conf['mailtype'] = 'html';
			$conf['wordwrap'] = TRUE;
			$conf['validate'] = TRUE;
			$this->email->initialize($conf);
			$this->email->set_newline("\r\n"); 
			$this->email->from('dragon2@blacker.com.uy');
			$this->email->to($email);
			$this->email->subject('Avticacion de cuenta Blacker');
			$this->email->message('<h2>Active su cuenta Blacker</h2>
				<hr><br>
				Bienvenido a Blacker, este mensage esta destinado para poder activar su cuenta en nuestra Red Social
				<br>
				ingrese al enlace que se le ortogo y podra ingresar a nuestra comunidad
				<br>
				<a href="'.base_url('login/activacion').'/'.$hash2.'">'.base_url('login/activacion').'/'.$hash2.'</a>
				<br>');
			for ($i=1; $i <=1 ; $i++) { 
				if (!$this->email->send()) {
					show_error($this->email->print_debugger());
				}
				sleep(1);
			}
			$this->session->set_flashdata('info','Se a enviado un correo para poder activar la cuenta');
			$this->session->set_flashdata('estado','esperando');
		}
	}

	public function activacion($data){
		$respuesta = $this->Model_usuario->activacion($data);
		if ($respuesta == 'activada') {
			$this->session->set_flashdata('info','El usuario se a activado');
			$this->session->set_flashdata('estado','activado');
		}elseif($respuesta == 'activo'){
			$this->session->set_flashdata('info','El usuario ya esta activo');
			$this->session->set_flashdata('estado','activo');
		}else{
			$this->session->set_flashdata('info','No existe el usuario');
			$this->session->set_flashdata('estado','inactivo');
		}
		redirect(base_url());
	}
}
