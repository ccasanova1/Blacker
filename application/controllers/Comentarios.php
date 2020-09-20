<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comentarios extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Model_comentarios");
		$this->load->model("Model_publicacion");
		$this->load->model("Model_megusta");
		$this->load->model("Model_notificaciones");
		$this->load->model("Model_album");
		$this->load->helper('string');
		$this->load->library('encrypt');
	}

	public function obtenerComentarios(){
		$id_publicacion = $this->input->post('id_publicacion');
		$publicaciones = $this->Model_comentarios->get_comentarios($id_publicacion);
		$i = 0;
		$data = array();
      	foreach ($comentarios as $value2) {
      		$date1 = new DateTime($value2->fecha);
			$date2 = new DateTime(date("Y-m-d H:m:s"));
			$diff = $date1->diff($date2);
			$dateTotal = $this->Model_publicacion->get_format_time($diff);
			$meGustaComent = $this->Model_megusta->get_megusta_comentario($value2->id_comentario,$this->session->userdata("id"));
			if ($meGustaComent->estado == 'like') {
		    	$colorLikeComent = 'w3-green';
		    }else{
		    	$colorLikeComent = 'w3-theme-d1';
		    }
      		if (empty($value2->nombrePerfilPagina)) {
				$data[$i]['publicacion'] .= "
      			<div class='w3-col'style='width:40px; padding-top:10px'>
        		<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        		</div>
        		<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            	<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        		<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfil $value2->apellido </a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
            	<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
			  	</div>
      			";
			}else{
				$data[$i]['publicacion'] .= "
      			<div class='w3-col'style='width:40px; padding-top:10px'>
        		<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        		</div>
        		<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            	<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        		<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfilPagina </a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='id_comentario' class='w3-button $colorLikeComent' style='height=15px; padding:5px; margin: 5px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
            	<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
			   	</div>
      			";
			}
      		$i++;
      	}
      	$escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
    	$replacements = array("", "", "",  "",  "");
    	$data[$i]['publicacion'] = str_replace($escapers, $replacements, $data[$i]['publicacion']);
    	//$data[$i]['idc'] = "#publicarComentario$value->id_publicacion";
    	$i++;
		//$data['script'] = "$('#contenerComentario button').click(function(){console.log('algo');console.log($(this).val());alert($(this).val());});";
		//header('Content-Type: application/json ; charset=utf-8');
		echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	
	}
	
	public function comentar(){
		$id_publicacion = $this->input->post('id_publicacion');
		$comentario = $this->input->post('comentario');
		$data = array(
			'contenido' => $comentario,
			'fecha' => date('Y-m-d H:m:s'),
			'id_usuario' => $this->session->userdata("id"),
		);
		$resultado = $this->Model_publicacion->get_datos_publicacion($id_publicacion);
		$this->Model_notificaciones->set_notificacion_comentario_usuario($this->session->userdata("id"),$resultado->id_usuario);
		$this->Model_comentarios->set_comentario($data, $this->session->userdata("id"), $id_publicacion);
		$comentarios = $this->Model_comentarios->get_comentarios($id_publicacion);
		$i = 0;
		$data = array();
    	foreach ($comentarios as $value2) {
    		$date1 = new DateTime($value2->fecha);
			$date2 = new DateTime(date("Y-m-d H:m:s"));
			$diff = $date1->diff($date2);
			$dateTotal = $this->Model_publicacion->get_format_time($diff);
    		$meGustaComent = $this->Model_megusta->get_megusta_comentario($value2->id_comentario,$this->session->userdata("id"));
			if ($meGustaComent->estado == 'like') {
		    	$colorLikeComent = 'w3-green';
		    }else{
		    	$colorLikeComent = 'w3-theme-d1';
		    }
      		if (empty($value2->nombrePerfilPagina)) {
				$data[$i]['comentarios'] = "
      			<div class='w3-col'style='width:40px; padding-top:10px'>
        		<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        		</div>
        		<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            	<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        		<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfil $value2->apellido </a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
            	<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
			  	</div>
      			";
			}else{
				$data[$i]['comentarios'] = "
      			<div class='w3-col'style='width:40px; padding-top:10px'>
        		<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'><img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'></a>
        		</div>
        		<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            	<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        		<h6 style='margin:0px; margin-top:10px'><a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfilPagina </a><button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='id_comentario' class='w3-button $colorLikeComent' style='height=15px; padding:5px; margin: 5px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span></h6>
            	<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
			   	</div>
      			";
			}
    		$escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
    		$replacements = array("", "", "",  "",  "");
    		$data[$i]['comentarios'] = str_replace($escapers, $replacements, $data[$i]['comentarios']);
    		$i++;
    	}
		echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	
	}

	public function comentarAlbum(){
		$id_album = $this->input->post('id_album');
		$comentario = $this->input->post('comentario');
		$data = array(
			'contenido' => $comentario,
			'fecha' => date('Y-m-d H:m:s'),
			'id_usuario' => $this->session->userdata("id"),
		);
		$resultado = $this->Model_album->get_datos_album($id_album);
		$this->Model_notificaciones->set_notificacion_comentarioAlbum_usuario($this->session->userdata("id"),$resultado->id_cuenta);
		$this->Model_comentarios->set_comentario_album($data, $this->session->userdata("id"), $id_album);
		$comentarios = $this->Model_comentarios->get_comentarios_albums($id_album);
		$i = 0;
		$data = array();
    	foreach ($comentarios as $value2) {
    		$date1 = new DateTime($value2->fecha);
			$date2 = new DateTime(date("Y-m-d H:m:s"));
			$diff = $date1->diff($date2);
			$dateTotal = $this->Model_publicacion->get_format_time($diff);
    		$meGustaComent = $this->Model_megusta->get_megusta_comentario($value2->id_comentario,$this->session->userdata("id"));
			if ($meGustaComent->estado == 'like') {
	        	$colorLikeComent = 'w3-green';
	        }else{
	        	$colorLikeComent = 'w3-theme-d1';
	        }
      		$data[$i]['comentarios'] = "
      			<div class='w3-col'style='width:40px; padding-top:10px'>
        			<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>
        				<img src='".base_url("assets/$value2->foto_perfil")."' style='width:30px; height:30px' alt='Avatar' class='w3-circle w3-margin-right'>
        			</a>
        		</div>
        		<div class='w3-rest Comentario_pers' id='Comentario_pers$value2->id_comentario'>
            		<!--<span class='w3-right w3-opacity' style='margin-top:10px'>$dateTotal</span>-->
        			<h6 style='margin:0px; margin-top:10px'>
        				<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($value2->id_usuario),array('+' => '.', '=' => '-', '/' => '~')))."'>$value2->nombrePerfil $value2->apellido
        				</a>
        				<button id='btn-megustaComent".random_string('alnum', 11)."' type='button' value='$value2->id_comentario' class='w3-button $colorLikeComent' style='height=10px; padding:3px; margin: 5px;padding-right:10px;padding-left:10px'><i class='fa fa-thumbs-up'></i></button><span class='' style='margin: 10px; margin-top: 10px' id='MegustaComentCant' >$value2->countMegustaComent</span>
        			</h6>
                	<p style='margin:0px; margin-bottom:10px'>$value2->contenido</p>
				</div>
      					";
    		$escapers = array("\n",  "\r",  "\t", "\x08", "\x0c");
    		$replacements = array("", "", "",  "",  "");
    		$data[$i]['comentarios'] = str_replace($escapers, $replacements, $data[$i]['comentarios']);
    		$i++;
    	}
		echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	
	}
}


