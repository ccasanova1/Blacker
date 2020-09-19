<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notificaciones extends CI_Model {

	public function set_notificacion_publicacion_usuario($data){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'a publicado algo', 'publicacion_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				WHERE cuenta_frontend.id_cuenta != ".$data."
				AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function set_notificacion_publicacion_pagina($data){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'a publicado algo', 'publicacion_pagina'
				FROM cuenta_frontend
				INNER JOIN sigue ON sigue.id_pagina = ".$data." AND sigue.id_usuario = cuenta_frontend.id_cuenta
				WHERE cuenta_frontend.id_cuenta != ".$data."
				AND sigue.estado != 'bloqueado'";
		$this->db->query($sql);	
	}

	/*public function set_notificacion_publicacion_usuario($data){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'a publicado algo', 'publicacion_pagina'
				FROM cuenta_frontend
				INNER JOIN sigue ON sigue.id_pagina = ".$data." AND sigue.id_usuario = cuenta_frontend.id_cuenta
				WHERE cuenta_frontend.id_cuenta != ".$data;
		$this->db->query($sql);	
	}*/

	public function get_notificacion_count($data){
		$this->db->select('COUNT(id_notificacion) AS CantNotificaciones');
		$this->db->from('notifica');
		$this->db->where('id_usuario1', $data);
		$this->db->where('estado', 'pendiente');
		$this->db->group_by('id_notificacion');
		$this->db->limit(3);
		$resultado = $this->db->get();
		return $resultado->result();
	}
}
