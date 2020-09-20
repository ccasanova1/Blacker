<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_album extends CI_Model {

	public function set_album($data, $data2, $data3){
		$this->db->set('nombre', $data);
		$this->db->set('ruta', $data2);
		$this->db->set('fecha', date('Y-m-d'));
		$this->db->set('id_cuenta', $data3);
		$this->db->insert("album");
		return $this->db->insert_id();
	}

	public function set_album_guarda($data){
		$this->db->insert("guarda_album", $data);
	}

	public function get_album_especifico($data){
		$this->db->where("nombre", $data);
		$resultado = $this->db->get("album");
		return $resultado->row();
	}

	public function get_album_id($data,$data2){
		$this->db->select('id_album, nombre, ruta');
		$this->db->where("id_album", $data);
		$this->db->where("id_cuenta", $data2);
		$resultado = $this->db->get("album");
		return $resultado->row();
	}

	public function get_album_grupo($data){
		$this->db->select('album.*');
		$this->db->from('album');
		$this->db->join('grupo', 'album.id_album = grupo.id_album', 'inner');
		$this->db->where("id_grupo", $data);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function get_album($data){
		$this->db->where('id_cuenta', $data);
		$resultado = $this->db->get("album");
		return $resultado->result();
	}

	public function get_album_predeterminado($data){
		$this->db->where('id_cuenta', $data);
		$this->db->where('id_cuenta', 'predeterminado');
		$resultado = $this->db->get("album");
		return $resultado->result();
	}

	public function get_rutaAlbum($data){
		$this->db->select('nombre');
		$this->db->where("id_cuenta", $data);
		$this->db->limit(1);
		$resultado = $this->db->get("album");
		return $resultado->row();
	}

	public function get_album_view($data, $limite){
		$this->db->select('album.id_album,album.nombre,album.ruta,album.fecha');
		$this->db->from('album');
		$this->db->join('grupo', 'grupo.id_album = album.id_album', 'left');
		$this->db->where('album.id_cuenta', $data);
		$this->db->group_start();
		$this->db->where('grupo.id_grupo IS NULL');
		$this->db->or_where("grupo.id_grupo = ''");
		$this->db->group_end();
		$this->db->group_by("album.id_album");
		if ($limite == 0) {
			$this->db->limit(6);
		}else{
			$this->db->limit(6,$limite);
		}
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function set_foto($data, $data2, $data3){
		$this->db->set('titulo', $data);
		$this->db->set('id_foto', $data3);
		$this->db->set('id_album', $data2);
		$this->db->insert('foto');
	}

	public function get_fotos($data, $limite, $data2, $data3){
		$this->db->select('publicacion.id_publicacion, publicacion.texto, publicacion.fecha, foto.titulo, album.nombre AS nombreAlbum, album.ruta, video.enlace, cuenta_frontend.foto_perfil,cuenta_frontend.id_cuenta , perfil_usuario.nombre AS nombrePerfil, perfil_usuario.apellido');
		$this->db->from('publicacion');
		$this->db->join('amigo', 'publicacion.id_usuario = amigo.id_usuario1 OR publicacion.id_usuario = amigo.id_usuario2', 'left');
		$this->db->join('foto', 'publicacion.id_publicacion = foto.id_foto', 'INNER');
		$this->db->join('album', 'foto.id_album = album.id_album', 'INNER');
		$this->db->join('video', 'publicacion.id_publicacion = video.id_video', 'left');
		$this->db->join('cuenta_frontend', 'publicacion.id_usuario = cuenta_frontend.id_cuenta', 'inner');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'inner');
		$this->db->group_start();
		$this->db->where('publicacion.id_usuario', $data);
		if ($data != $data3){
			$this->db->group_start();
			$this->db->group_start();
			$this->db->group_start();
			$this->db->where('amigo.id_usuario1', $data3);
			$this->db->or_where('amigo.id_usuario2', $data3);
			$this->db->group_end();
			$this->db->group_start();
			$this->db->where('amigo.id_usuario1', $data);
			$this->db->or_where('amigo.id_usuario2', $data);
			$this->db->group_end();
			$this->db->group_end();
			$this->db->where('amigo.estado', 'amigos');
			$this->db->group_end();
		}
		$this->db->where('album.id_album', $data2);
		$this->db->group_end();
		$this->db->group_by('publicacion.id_publicacion');
		$this->db->order_by('publicacion.fecha', 'DESC');
		if ($limite == 0) {
			$this->db->limit(3);
		}else{
			$this->db->limit(3,$limite);
		}
		$resultado = $this->db->get();
		return $resultado->result();

	}

	public function get_foto_publicada_grupo($data){
		$this->db->select('a.id_publicacion as id_publicacion,c.id_foto as id_foto, c.ruta as ruta_foto, d.nombre_album as nombre_album, d.ruta as ruta_album');
		$this->db->from('publicacion as a');
		$this->db->join('grupo_obtiene_publicacion as e', 'e.id_publicacion = a.id_publicacion','inner');
		$this->db->join('grupo as f', 'f.id_grupo = e.id_grupo','inner');
		$this->db->join('usuario_guarda_foto as b', 'a.id_publicacion = b.id_publicacion', 'inner');
		$this->db->join('foto as c', 'c.id_foto = b.id_foto','inner');
		$this->db->join('album as d', 'd.id_album = b.id_album','inner');
		$this->db->where('f.id_grupo', $data);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function get_datos_album($data){
		$this->db->where('id_album', $data);
		$resultado = $this->db->get('album');
		return $resultado->row();
	}
}