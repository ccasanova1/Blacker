<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_compartir extends CI_Model {

	public function set_comparte($data, $data2){
			$this->db->set('id_publicacion', $data);
			$this->db->set('id_usuario', $data2);
			$this->db->set('fecha', date("Y-m-d H-i-s"));
			$this->db->insert('comparte');
	}

	public function control_comparte($data, $data2){
		$this->db->select('id_compartida');
		$this->db->from('comparte');
		$this->db->where('id_publicacion', $data);
		$this->db->where('id_usuario',$data2);
		$resultado = $this->db->get();
		if (!empty($resultado->row())){
			return FALSE;
		}else{
			return TRUE;
		}
	}
}