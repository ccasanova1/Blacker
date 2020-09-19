<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_megusta extends CI_Model {

	public function setget_megusta_publicacion($data, $data2){
		$this->db->select('id_publicacion');
		$this->db->from('gusta1');
		$this->db->where('id_publicacion', $data);
		$this->db->where('id_usuario', $data2);
		$resultado = $this->db->get();
		if (empty($resultado->row())) {
			$this->db->set('id_publicacion', $data);
			$this->db->set('id_usuario', $data2);
			$this->db->insert('gusta1');
			$this->db->select("count(id_publicacion) as countMegusta, 'like' AS estado");
			$this->db->from('gusta1');
			$this->db->where('id_publicacion', $data);
			$resultado2 = $this->db->get();
			return $resultado2->row();
		}else{
			$this->db->where('id_publicacion', $data);
			$this->db->where('id_usuario', $data2);
			$this->db->delete('gusta1');
			$this->db->select("count(id_publicacion) as countMegusta, 'notlike' AS estado");
			$this->db->from('gusta1');
			$this->db->where('id_publicacion', $data);
			$resultado2 = $this->db->get();
			return $resultado2->row();
		}
	}

	public function get_megusta_publicacion($data, $data2){
		$this->db->select("count(id_publicacion) as countMegusta, 'like' AS estado");
		$this->db->from('gusta1');
		$this->db->where('id_publicacion', $data);
		$resultado = $this->db->get();
		$resultado = $resultado->row();
		$this->db->select('id_publicacion');
		$this->db->from('gusta1');
		$this->db->where('id_publicacion', $data);
		$this->db->where('id_usuario', $data2);
		$resultado2 = $this->db->get();
		$resultado->estado = '';
		if (!empty($resultado2->row())) {
			$resultado->estado = 'like';
		}
		return $resultado;
	}

	public function get_megusta_comentario($data, $data2){
		$this->db->select("count(id_comentario) as countMegustaComent, 'like' AS estado");
		$this->db->from('gusta2');
		$this->db->where('id_comentario', $data);
		$resultado = $this->db->get();
		$resultado = $resultado->row();
		$this->db->select('id_comentario');
		$this->db->from('gusta2');
		$this->db->where('id_comentario', $data);
		$this->db->where('id_usuario', $data2);
		$resultado2 = $this->db->get();
		$resultado->estado = '';
		if (!empty($resultado2->row())) {
			$resultado->estado = 'like';
		}
		return $resultado;
	}

	public function setget_megusta_comentario($data, $data2){
		$this->db->select('id_comentario');
		$this->db->from('gusta2');
		$this->db->where('id_comentario', $data);
		$this->db->where('id_usuario', $data2);
		$resultado = $this->db->get();
		if (empty($resultado->row())) {
			$this->db->set('id_comentario', $data);
			$this->db->set('id_usuario', $data2);
			$this->db->insert('gusta2');
			$this->db->select("count(id_comentario) as countMegustaComent, 'like' AS estado");
			$this->db->from('gusta2');
			$this->db->where('id_comentario', $data);
			$resultado2 = $this->db->get();
			return $resultado2->row();
		}else{
			$this->db->where('id_comentario', $data);
			$this->db->where('id_usuario', $data2);
			$this->db->delete('gusta2');
			$this->db->select("count(id_comentario) as countMegustaComent, 'notlike' AS estado");
			$this->db->from('gusta2');
			$this->db->where('id_comentario', $data);
			$resultado2 = $this->db->get();
			return $resultado2->row();
		}
	}

	public function setget_megusta_album($data, $data2){
		$this->db->select('id_album');
		$this->db->from('gusta3');
		$this->db->where('id_album', $data);
		$this->db->where('id_usuario', $data2);
		$resultado = $this->db->get();
		if (empty($resultado->row())) {
			$this->db->set('id_album', $data);
			$this->db->set('id_usuario', $data2);
			$this->db->insert('gusta3');
			$this->db->select("count(id_album) as countMegusta, 'like' AS estado");
			$this->db->from('gusta3');
			$this->db->where('id_album', $data);
			$resultado2 = $this->db->get();
			return $resultado2->row();
		}else{
			$this->db->where('id_album', $data);
			$this->db->where('id_usuario', $data2);
			$this->db->delete('gusta3');
			$this->db->select("count(id_album) as countMegusta, 'notlike' AS estado");
			$this->db->from('gusta3');
			$this->db->where('id_album', $data);
			$resultado2 = $this->db->get();
			return $resultado2->row();
		}
	}

	public function get_megusta_album($data, $data2){
		$this->db->select("count(id_album) as countMegusta, 'like' AS estado");
		$this->db->from('gusta3');
		$this->db->where('id_album', $data);
		$resultado = $this->db->get();
		$resultado = $resultado->row();
		$this->db->select('id_album');
		$this->db->from('gusta3');
		$this->db->where('id_album', $data);
		$this->db->where('id_usuario', $data2);
		$resultado2 = $this->db->get();
		$resultado->estado = '';
		if (!empty($resultado2->row())) {
			$resultado->estado = 'like';
		}
		return $resultado;
	}
}