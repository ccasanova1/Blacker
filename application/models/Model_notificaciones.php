<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notificaciones extends CI_Model {

	public function set_notificacion_publicacion_usuario($data){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'a publicado algo', 'publicacion'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data2.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data2.")
				WHERE cuenta_frontend.id_cuenta != ".$data;
		$this->db->query($sql);	
	}

	public function get_notificacion_3($data){
		$this->db->select('*, COUNT(id_notificacion) AS CantNotificaciones');
		$this->db->from('notifica');
		$this->db->where('id_usuario1', $data);
		$this->db->where('estado', 'pendiente');
		$this->db->group_by('id_notificacion');
		$this->db->limit(3);
		$resultado = $this->db->get();
		return $resultado->result();
	}
}
