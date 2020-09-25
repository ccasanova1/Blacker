<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_chat extends CI_Model {

	Public function set_chat($data,$data2,$data3){
		$this->db->set('id_usuario1',$data);
		$this->db->set('id_usuario2',$data2);
		$this->db->set('texto',$data3);
		$this->db->set('fecha',date('Y-m-d'));
		$this->db->set('estado','pendiente');
		$this->db->insert("chatea");
		/*$this->db->group_start();
		$this->db->where('id_usuario1',$data);
		$this->db->where('id_usuario2',$data2);
		$this->db->where('estado','pendiente');
		$this->db->group_end();
		$this->db->or_group_start();*/
		$this->db->where('id_usuario2',$data);
		$this->db->where('id_usuario1',$data2);
		$this->db->where('estado','pendiente');
		//$this->db->group_end();
		$this->db->order_by('fecha');
		$resultado = $this->db->get('chatea');
		return $resultado->result();
	}

	Public function get_chat($data,$data2){
		/*$this->db->group_start();
		$this->db->where('id_usuario1',$data);
		$this->db->where('id_usuario2',$data2);
		$this->db->where('estado','pendiente');
		$this->db->group_end();
		$this->db->or_group_start();*/
		$this->db->where('id_usuario2',$data);
		$this->db->where('id_usuario1',$data2);
		$this->db->where('estado','pendiente');
		//$this->db->group_end();
		$this->db->order_by('fecha');
		$resultado = $this->db->get('chatea');
		return $resultado->result();
	}

	Public function update_estado($data,$data2){
		$this->db->set('estado', 'visto');
		$this->db->where('id_chat',$data);
		$this->db->where('id_usuario2',$data2);
		$this->db->update('chatea');
	}
}