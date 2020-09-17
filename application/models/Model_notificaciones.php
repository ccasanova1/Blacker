<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notificaciones extends CI_Model {

	public function get_notificaciones_usuarios_cont($data){
		$this->db->select('count(*) AS count_notf');
		$this->db->from('amigo_recibe_notificacion');
		$this->db->where('id_usuario2', $data);
		$this->db->where('estado', 'pendiente');
		$resultado = $this->db->get();
		$resultado = $resultado->row();
		$this->db->select('count(*) AS count_notf');
		$this->db->from('seguidor_recibe_notificacion');
		$this->db->where('id_usuario', $data);
		$this->db->where('estado', 'pendiente');
		$resultado2 = $this->db->get();
		$resultado2 = $resultado2->row();
		$total = $resultado->count_notf + $resultado2->count_notf;
		return $total;
		
	}
	public function set_notificacion($data){
		$this->db->insert('amigo_recibe_notificacion', $data);
	}

	public function get_notificaciones($data){
		$this->db->select('b.* , c.nombre, c.apellido, d.*');
		$this->db->from('cuenta_frontend as a');
		$this->db->join('amigo_recibe_notificacion as b', 'a.id_cuenta = b.id_usuario2');
		$this->db->join('perfil_usuario as c', 'b.id_usuario1 = c.id_cuenta');
		$this->db->join('cuenta_frontend as d', 'b.id_usuario1 = d.id_cuenta');
		$this->db->where('a.id_cuenta', $data);
		$this->db->where('b.estado', 'pendiente');
		$resultado = $this->db->get();
		$resultado = $resultado->result();
		$this->db->select('b.* , c.nombre_entidad, d.*');
		$this->db->from('cuenta_frontend as a');
		$this->db->join('seguidor_recibe_notificacion as b', 'a.id_cuenta = b.id_usuario');
		$this->db->join('perfil_pagina as c', 'b.id_pagina = c.id_cuenta');
		$this->db->join('cuenta_frontend as d', 'b.id_pagina = d.id_cuenta');
		$this->db->where('a.id_cuenta', $data);
		$this->db->where('b.estado', 'pendiente');
		$resultado2 = $this->db->get('seguidor_recibe_notificacion');
		$resultado2 = $resultado2->result();
		return $total = array(
			'parte1' => $resultado,
			'parte2' => $resultado2,
		);
	}

	public function finalizar_notificacion($data){
		$this->db->set('estado', 'visto');
		$this->db->where('id_notificacion', $data);
		$this->db->update('amigo_recibe_notificacion');
		$this->db->where('id_notificacion', $data);
		$resultado = $this->db->get('amigo_recibe_notificacion');
		return $resultado->row();
	}

	public function finalizar_notificacion_pagina($data){
		$this->db->set('estado', 'visto');
		$this->db->where('id_notificacion', $data);
		$this->db->update('seguidor_recibe_notificacion');
		$this->db->where('id_notificacion', $data);
		$resultado = $this->db->get('seguidor_recibe_notificacion');
		return $resultado->row();
	}

	public function set_notificacion_publicacion($data){
		$this->db->group_start();
		$this->db->where('id_usuario1', $data);
		$this->db->or_where('id_usuario2', $data);
		$this->db->group_end();
		$this->db->where('estado', 'amigos');
		$resultado = $this->db->get('amigo');
		$resultado = $resultado->result();
			if (!empty($resultado)) {
			foreach ($resultado as $resultados) {
			if ($resultados->id_usuario1 != $data) {
				$data = array(
					'id_usuario1' => $data,
					'id_usuario2' => $resultados->id_usuario1,
					'fecha' => date('Y-m-d'),
					'contenido' => 'A publicado algo',
					'estado' => 'pendiente',
					'tipo_notificacion' => 'publicacion'
					);
				$this->db->insert('amigo_recibe_notificacion', $data);
			}else{
				$data = array(
					'id_usuario1' => $data,
					'id_usuario2' => $resultados->id_usuario2,
					'fecha' => date('Y-m-d'),
					'contenido' => 'A publicado algo',
					'estado' => 'pendiente',
					'tipo_notificacion' => 'publicacion'
					);
				$this->db->insert('amigo_recibe_notificacion', $data);
			}
		}
		}
	}
}
