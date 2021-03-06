<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_amigos extends CI_Model {

	Public function get_amigos($data){
		$this->db->group_start();
		$this->db->where('id_usuario1', $data);
		$this->db->or_where('id_usuario2', $data);
		$this->db->group_end();
		$this->db->where('estado', 'aceptado');
		$resultado = $this->db->get('amigo');
		return $resultado->result();
	}

	Public function get_amigos_datos($data){
		$this->db->select('cuenta_frontend.id_cuenta, cuenta_frontend.foto_perfil, perfil_usuario.nombre, perfil_usuario.apellido');
		$this->db->from('cuenta_frontend');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'inner');
		$this->db->join('amigo', "(amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = $data AND amigo.estado = 'amigos') OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = $data AND amigo.estado = 'amigos')", 'inner');
		$this->db->where('cuenta_frontend.id_cuenta !=', $data);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	Public function get_pendiente($data){
		$this->db->select('cuenta_frontend.id_cuenta, cuenta_frontend.foto_perfil, perfil_usuario.nombre, perfil_usuario.apellido, amigo.estado');
		$this->db->join('cuenta_frontend', 'cuenta_frontend.id_cuenta = amigo.id_usuario1', 'inner');
		$this->db->join('perfil_usuario', 'perfil_usuario.id_cuenta = cuenta_frontend.id_cuenta', 'inner');
		$this->db->where('id_usuario2', $data);
		$this->db->where('amigo.estado', 'pendiente');
		$resultado = $this->db->get('amigo');
		return $resultado->result();
	}

	Public function get_sigue_pagina($data, $data2){
		$this->db->where('id_pagina', $data);
		$this->db->where('id_usuario', $data2);
		$resultado = $this->db->get('sigue');
		return $resultado->row();
	}

	Public function get_amigo_especifico($data, $data2){
		$this->db->group_start();
		$this->db->group_start();
		$this->db->where('id_usuario1', $data);
		$this->db->or_where('id_usuario2', $data);
		$this->db->group_end();
		$this->db->group_start();
		$this->db->where('id_usuario1', $data2);
		$this->db->or_where('id_usuario2', $data2);
		$this->db->group_end();
		$this->db->group_end();
		$this->db->group_start();
		$this->db->where('estado', 'amigos');
		$this->db->or_where('estado', 'pendiente');
		$this->db->or_where('estado', 'rechazado');
		$this->db->group_end();
		$this->db->where($data2." !=", $data);
		$resultado = $this->db->get('amigo');
		$resultado = $resultado->row();
		return $resultado;
	}

	public function set_addamigo($data){
		$this->db->insert("amigo", $data);
	}

	public function add_sigue($data){
		$this->db->insert("sigue", $data);
	}

	public function delete_sigue($data){
		$this->db->delete("sigue", $data);
	}

	public function delete_amigo($data){
		$this->db->group_start();
		$this->db->where('id_usuario1', $data['id_usuario1']);
		$this->db->where('id_usuario2', $data['id_usuario2']);
		$this->db->group_end();
		$this->db->or_group_start();
		$this->db->where('id_usuario1', $data['id_usuario2']);
		$this->db->where('id_usuario2', $data['id_usuario1']);
		$this->db->group_end();
		$this->db->delete("amigo");
	}

	public function update_sigue($data){
		$this->db->set('estado', 'bloqueado');
		$this->db->where($data);
		$this->db->update('sigue');
	}

	public function update_amigo_ok($data, $data2){
		$this->db->set('estado', 'amigos');
		$this->db->where('id_usuario1', $data);
		$this->db->where('id_usuario2', $data2);
		$this->db->update('amigo');
	}
	public function update_amigo_fail($data, $data2){
		$this->db->set('estado', 'rechazado');
		$this->db->where('id_usuario1', $data);
		$this->db->where('id_usuario2', $data2);
		$this->db->update('amigo');
	}

	public function get_busqueda($data, $data2, $data3){
		$resultado = $this->db->query("CALL `BuscarAmigoSP`('".$data."', '".$data2."','".$data3."')");
		$resultadoTotal = $resultado->result();
		$resultado->next_result(); 
		$resultado->free_result();
		return $resultadoTotal;
	}

	public function get_busqueda_sigue($data, $data2, $data3){
		$resultado = $this->db->query("CALL `BuscarSigueSP`('".$data."', '".$data2."','".$data3."')");
		$resultadoTotal = $resultado->result();
		$resultado->next_result(); 
		$resultado->free_result();
		return $resultadoTotal;
	}
}