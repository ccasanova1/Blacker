<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_grupo extends CI_Model {

	public function get_buscar_grupos($data){
		$this->db->select('*, cuenta_frontend.id_cuenta AS id, grupo.nombre AS nombre_grupo, grupo.descripcion as grupo_descripcion');
		$this->db->from('grupo');
		$this->db->join('cuenta_frontend', 'grupo.id_administrador = cuenta_frontend.id_cuenta', 'left');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'left');
		$this->db->join('perfil_pagina', 'cuenta_frontend.id_cuenta = perfil_pagina.id_cuenta', 'left');
		$this->db->group_start();
		$this->db->like('grupo.nombre', $data); 
		$this->db->group_end();
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function get_grupo($data){
		$this->db->where('id_grupo', $data);
		$resultado = $this->db->get('grupo');
		return $resultado->row();
	}

	public function get_grupos($data){
		$this->db->select('grupo.id_grupo, grupo.nombre');
		$this->db->from('grupo');
		$this->db->join('forma', 'forma.id_grupo = grupo.id_grupo', 'inner');
		$this->db->join('perfil_usuario', 'perfil_usuario.id_cuenta = forma.id_usuario', 'inner');
		$this->db->where('perfil_usuario.id_cuenta', $data);
		$this->db->order_by('grupo.fecha_creacion');
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function set_grupo($data, $data2){
		$this->db->insert('grupo', $data);
		$forma = array(
			'id_grupo' => $this->db->insert_id(), 
			'id_usuario' => $data2,
			'fecha' => date('Y-m-d'),
		);
		$this->db->insert('forma', $forma);
		return $forma['id_grupo'];
	}

	public function control_grupo($data, $data2){
		$this->db->where('id_grupo', $data);
		$this->db->where('id_usuario', $data2);
		$resultado = $this->db->get('forma');
		return (empty($resultado)) ? FALSE : TRUE;
	}

	public function add_unirme($data){
		$this->db->insert("forma", $data);
	}

	public function delete_unirme($data){
		$this->db->delete("forma", $data);
	}

	public function get_forma($data,$data2){
		$this->db->where('id_grupo', $data);
		$this->db->where('id_usuario', $data2);
		$resultado = $this->db->get('forma');
		return $resultado->row();
	}
}