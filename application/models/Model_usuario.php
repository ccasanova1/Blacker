<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_usuario extends CI_Model {

	public function get_usuario($data){
		$this->db->where("id_cuenta", $data);
		$resultado = $this->db->get("cuenta_frontend");
		return $resultado->row();
	}

	public function set_usuario($data){
		$this->db->insert("cuenta_frontend", $data);
	}

	public function get_usuario_comp($data){
		$this->db->where("email", $data);
		$resultado = $this->db->get("cuenta_frontend");
		return $resultado->row();
	}

	public function get_busca_usuarios($data, $data2){
		$this->db->select('*, cuenta_frontend.id_cuenta AS id');
		$this->db->from('cuenta_frontend');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'left');
		$this->db->join('perfil_pagina', 'cuenta_frontend.id_cuenta = perfil_pagina.id_cuenta', 'left');
		$this->db->group_start();
		$this->db->like('email', $data); 
		$this->db->or_like('telefono', $data);
		$this->db->or_like('nombre', $data);
		$this->db->or_like('apellido', $data);
		$this->db->or_like('nombre_entidad', $data);
		$this->db->group_end();
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function activacion($data){
		$this->db->where('activador', $data);
		$respuesta = $this->db->get('cuenta_frontend');
		$resultado = $respuesta->row();
		if (!empty($resultado)) {
			if (empty($resultado->activador)) {
				return 'inactivo';
			}else{
				$this->db->set('activador', 'activo');
				$this->db->where('id_cuenta', $resultado->id_cuenta);
				$this->db->update('cuenta_frontend');
				return 'activada';
			}
		}else{
			$this->db->where('activador', 'activo');
			$respuesta = $this->db->get('cuenta_frontend');
			$resultado = $respuesta->row();
			if (!empty($resultado)) {
				return 'activo';
			}else{
				return NULL;
			}
			
		}

	}
}