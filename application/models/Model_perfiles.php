<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_perfiles extends CI_Model {

	public function get_perfil_usuario($data){
		$this->db->where("id_cuenta", $data);
		$resultado = $this->db->get("perfil_usuario");
		return $resultado->row();
	}

	public function set_perfil_usuario($data){
		$this->db->insert("perfil_usuario", $data);
	}

	/*public function get_configuracion_especifica(){
		$this->db->select_max('id_configuracion');
		$resultado = $this->db->get('configuracion');
		return $resultado->row();
	}*/

	public function set_configuracion($data,$data2){
		$this->db->insert('configuracion', $data);
		$insert_id = $this->db->insert_id();
		$data = array(
			'id_configuracion' => $insert_id,
			'id_cuenta' => $data2, 
		);
		$this->db->insert('establece', $data);
	}

	public function get_perfil_pagina($data){
		$this->db->where("id_cuenta", $data);
		$resultado = $this->db->get("perfil_pagina");
		return $resultado->row();
	}

	public function set_perfil_pagina($data){
		$this->db->insert("perfil_pagina", $data);
	}

	public function get_perfil($data){
		$this->db->where('id_cuenta', $data);
		$resultado = $this->db->get("perfil_pagina");
		$resultado = $resultado->row();
		if (empty($resultado)) {
			$this->db->where('id_cuenta', $data);
			$resultado = $this->db->get("perfil_usuario");
			return $resultado->row();
		}
		else{
			return $resultado;
		}
	}

	public function increment_visit($id){
		$sql = "UPDATE cuenta_frontend SET visitas = visitas + 1 WHERE id_cuenta = ".$id;
		$this->db->query($sql);
	}
}