<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_comentarios extends CI_Model {

	public function set_comentario($data, $data2, $data3){
		$this->db->insert("comentario", $data);
		$data = array(
			'id_publicacion' => $data3,
			'id_comentario' => $this->db->insert_id(),
		);
		$this->db->insert("recibe1", $data);
	}

	public function set_comentario_album($data, $data2, $data3){
		$this->db->insert("comentario", $data);
		$data = array(
			'id_album' => $data3,
			'id_comentario' => $this->db->insert_id(),
		);
		$this->db->insert("recibe2", $data);
	}
	
	public function get_comentarios($data){
		$this->db->select('comentario.id_comentario, comentario.contenido, comentario.fecha, comentario.id_usuario, comentario.fecha, cuenta_frontend.foto_perfil, perfil_usuario.nombre AS nombrePerfil, perfil_usuario.apellido, perfil_pagina.nombre_entidad  AS nombrePerfilPagina, count(gusta2.id_comentario) as countMegustaComent');
		$this->db->from('comentario');
		$this->db->join('recibe1', 'recibe1.id_comentario = comentario.id_comentario', 'inner');
		$this->db->join('publicacion', 'publicacion.id_publicacion = recibe1.id_publicacion', 'inner');
		$this->db->join('cuenta_frontend', 'cuenta_frontend.id_cuenta = comentario.id_usuario', 'inner');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'left');
		$this->db->join('perfil_pagina', 'cuenta_frontend.id_cuenta = perfil_pagina.id_cuenta', 'left');
		$this->db->join('gusta2', 'gusta2.id_comentario = comentario.id_comentario', 'left');
		$this->db->where('publicacion.id_publicacion', $data);
		$this->db->order_by('comentario.fecha', 'DESC');
		$this->db->group_by("comentario.id_comentario");
		$this->db->limit(3);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function get_comentarios_albums($data){
		$this->db->select('comentario.id_comentario, comentario.contenido, comentario.fecha, comentario.id_usuario, comentario.fecha, cuenta_frontend.foto_perfil, perfil_usuario.nombre AS nombrePerfil, perfil_usuario.apellido, count(gusta2.id_comentario) as countMegustaComent');
		$this->db->from('comentario');
		$this->db->join('recibe2', 'recibe2.id_comentario = comentario.id_comentario', 'inner');
		$this->db->join('album', 'album.id_album = recibe2.id_album', 'inner');
		$this->db->join('cuenta_frontend', 'cuenta_frontend.id_cuenta = comentario.id_usuario', 'inner');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'inner');
		$this->db->join('gusta2', 'gusta2.id_comentario = comentario.id_comentario', 'left');
		$this->db->where('album.id_album', $data);
		$this->db->order_by('comentario.fecha', 'DESC');
		$this->db->group_by("comentario.id_comentario");
		$this->db->limit(3);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function get_id_publicacion_comentario($data){
		$this->db->select('recibe1.id_publicacion');
		$this->db->from('recibe1');
		$this->db->where('recibe1.id_comentario', $data);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function get_id_album_comentario($data){
		$this->db->select('recibe2.id_album');
		$this->db->from('recibe2');
		$this->db->where('recibe2.id_comentario', $data);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function delete_comentario($data){
		$this->db->where('id_comentario', $data);
		$this->db->delete('recibe1');
		$this->db->where('id_comentario', $data);
		$this->db->delete('recibe2');
		$this->db->where('id_comentario', $data);
		$this->db->delete('gusta2');
		$this->db->where('id_comentario', $data);
		$this->db->delete('comentario');
	}

	public function get_datos_comentario($data){
		$this->db->where('id_comentario', $data);
		$resultado = $this->db->get('comentario');
		return $resultado->row();
	}

	public function control_comentario($data, $data2){
		$this->db->where('id_usuario', $data2);
		$this->db->where('id_comentario', $data);
		$resultado = $this->db->get('comentario');
		if (empty($resultado->row())) {
			return FALSE;
		}else{
			return TRUE;
		}
	}
}