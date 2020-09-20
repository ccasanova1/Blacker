<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notificaciones extends CI_Model {

	public function set_notificacion_publicacion_usuario($data){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'A publicado algo', 'publicacion_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				INNER JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_publicacion = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data."
				AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function set_notificacion_publicacion_pagina($data){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'A publicado algo', 'publicacion_pagina'
				FROM cuenta_frontend
				INNER JOIN sigue ON sigue.id_pagina = ".$data." AND sigue.id_usuario = cuenta_frontend.id_cuenta
				INNER  JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_publicacion = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data."
				AND sigue.estado != 'bloqueado'";
		$this->db->query($sql);	
	}

	public function set_notificacion_megusta_usuario($data, $data2){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'Le a dado Like a tu publicacion', 'megusta_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				INNER JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_megusta = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data." AND cuenta_frontend.id_cuenta = ".$data2." AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function set_notificacion_megustaAlbum_usuario($data, $data2){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'Le a dado Like a tu album', 'megusta_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				INNER JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_megusta = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data." AND cuenta_frontend.id_cuenta = ".$data2." AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function set_notificacion_megustaComentario_usuario($data, $data2){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'Le a dado Like a tu comentario', 'megusta_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				INNER JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_megusta = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data." AND cuenta_frontend.id_cuenta = ".$data2." AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function set_notificacion_comentario_usuario($data, $data2){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'A comentado tu publicacion', 'comentario_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				INNER JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_comentario = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data." AND cuenta_frontend.id_cuenta = ".$data2." AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function set_notificacion_comentarioAlbum_usuario($data, $data2){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'A comentado tu album', 'comentario_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				INNER JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_comentario = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data." AND cuenta_frontend.id_cuenta = ".$data2." AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function set_notificacion_perfil_usuario($data){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'A editado su perfil', 'perfil_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				INNER JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_perfil = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data."
				AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function set_notificacion_comparte_usuario($data, $data2){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'A compartido tu publicacion', 'comparte_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				INNER JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_comparte = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data." AND cuenta_frontend.id_cuenta = ".$data2." AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function set_notificacion_album_usuario($data){
		$sql = "INSERT INTO notifica (id_usuario1, id_usuario2, fecha, estado, contenido, tipo_notificacion)
				SELECT cuenta_frontend.id_cuenta, ".$data.", '".date("Y-m-d")."', 'pendiente', 'A creado un album', 'comparte_usuario'
				FROM cuenta_frontend
				INNER JOIN amigo ON (amigo.id_usuario1 = cuenta_frontend.id_cuenta AND amigo.id_usuario2 = ".$data.") OR (amigo.id_usuario2 = cuenta_frontend.id_cuenta AND amigo.id_usuario1 = ".$data.")
				INNER JOIN establece ON establece.id_cuenta = cuenta_frontend.id_cuenta
				INNER JOIN configuracion ON configuracion.id_configuracion = establece.id_configuracion AND configuracion.not_publicacion = 'si'
				WHERE cuenta_frontend.id_cuenta != ".$data."
				AND amigo.estado = 'amigos'";
		$this->db->query($sql);	
	}

	public function get_notificacion_count($data){
		$this->db->select('COUNT(id_notificacion) AS CantNotificaciones');
		$this->db->from('notifica');
		$this->db->where('id_usuario1', $data);
		$this->db->where('estado', 'pendiente');
		$this->db->limit(3);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function get_notificaciones($data,$limite){
		$this->db->select('cuenta_frontend.id_cuenta, notifica.id_notificacion, perfil_usuario.nombre, perfil_usuario.apellido, perfil_pagina.nombre_entidad, notifica.contenido');
		$this->db->from('notifica');
		$this->db->join('cuenta_frontend', 'cuenta_frontend.id_cuenta = notifica.id_usuario2', 'INNER');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'LEFT');
		$this->db->join('perfil_pagina', 'cuenta_frontend.id_cuenta = perfil_pagina.id_cuenta', 'LEFT');
		$this->db->where('notifica.id_usuario1', $data);
		$this->db->where('notifica.estado', 'pendiente');
		if ($limite == 0) {
			$this->db->limit(10);
		}else{
			$this->db->limit(10,$limite);
		}
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function update_notificaciones($data){
		$this->db->set('estado', 'visto');
		$this->db->where('id_notificacion', $data);
		$this->db->update('notifica');
	}
}
