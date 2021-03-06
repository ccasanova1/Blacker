<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_publicacion extends CI_Model {

	public function set_publicacion($data){
		$this->db->insert("publicacion", $data);
		return $this->db->insert_id();
	}

	public function set_publicacion_grupo($data, $data2){
		$this->db->insert("publicacion", $data);
		$id_publicacion = $this->db->insert_id();
		$this->db->set('id_publicacion', $id_publicacion);
		$this->db->set('id_grupo', $data2);
		$this->db->insert("hecha");
		return $id_publicacion;
	}

	public function set_video($data, $data2){
		$this->db->set('id_video', $data);
		$this->db->set('enlace', $data2);
		$this->db->insert('video');
	}

	public function get_publicacion($data, $limite, $data2){
		$resultado = $this->db->query("CALL `PublicacionesSP`('".$data."', '".$limite."','".$data2."')");
		$resultadoTotal = $resultado->result();
		$resultado->next_result(); 
		$resultado->free_result();
		return $resultadoTotal;
	}

	public function get_publicidad(){
		$this->db->order_by('id_publicidad', 'RANDOM');
		$this->db->limit(1);
		$resultado = $this->db->get("publicidad");
		$resultadoTotal = $resultado->row();
		return $resultadoTotal;
	}

	public function get_publicacion_unico($data, $data2, $limite, $estado){
		$this->db->select('publicacion.id_publicacion, publicacion.texto, publicacion.fecha, foto.titulo, album.nombre AS nombreAlbum, album.ruta, video.enlace, cuenta_frontend.foto_perfil, cuenta_frontend.id_cuenta, perfil_usuario.nombre AS nombrePerfil, perfil_usuario.apellido, count(gusta1.id_publicacion) as countMegusta, perfil_pagina.nombre_entidad AS nombrePerfilPagina, comparte.id_compartida, cuenta_frontend_comparte.foto_perfil as foto_perfil_comparte, cuenta_frontend_comparte.id_cuenta as id_cuenta_comparte, perfil_usuario_comparte.nombre AS nombrePerfilComparte, perfil_usuario_comparte.apellido AS apellidoComparte');
		$this->db->from('publicacion');
		$this->db->join('hecha', 'publicacion.id_publicacion = hecha.id_publicacion', 'LEFT');
		$this->db->join('foto', 'publicacion.id_publicacion = foto.id_foto', 'left');
		$this->db->join('album', 'foto.id_album = album.id_album', 'left');
		$this->db->join('video', 'publicacion.id_publicacion = video.id_video', 'left');
		$this->db->join('gusta1', 'publicacion.id_publicacion = gusta1.id_publicacion', 'left');
		$this->db->join('cuenta_frontend', 'publicacion.id_usuario = cuenta_frontend.id_cuenta', 'inner');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'left');
		$this->db->join('perfil_pagina', 'cuenta_frontend.id_cuenta = perfil_pagina.id_cuenta', 'left');
		$this->db->join('comparte', 'publicacion.id_publicacion = comparte.id_publicacion', 'left');
		$this->db->join('cuenta_frontend AS cuenta_frontend_comparte', 'comparte.id_usuario = cuenta_frontend_comparte.id_cuenta', 'left');
		$this->db->join('perfil_usuario AS perfil_usuario_comparte', 'cuenta_frontend_comparte.id_cuenta = perfil_usuario_comparte.id_cuenta', 'left');
		$this->db->group_start();
		$this->db->where('publicacion.id_usuario', $data);
		$this->db->or_where('comparte.id_usuario', $data);
		$this->db->group_end();
		$this->db->group_start();
		$this->db->where('hecha.id_grupo IS NULL');
		$this->db->or_where('hecha.id_grupo', '');
		$this->db->group_end();
		$this->db->group_by('publicacion.id_publicacion');
		$this->db->order_by("if(comparte.Fecha IS NOT NULL AND comparte.Fecha != '', comparte.Fecha, publicacion.fecha) DESC");
		if ($limite == 0) {
			$this->db->limit(3);
		}else{
			$this->db->limit(3,$limite);
		}
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function get_publicacion_pagina($data, $data2, $limite, $estado){
		$this->db->select('publicacion.id_publicacion, publicacion.texto, publicacion.fecha, foto.titulo, album.nombre AS nombreAlbum, album.ruta, video.enlace, cuenta_frontend.foto_perfil,cuenta_frontend.id_cuenta , perfil_pagina.nombre_entidad AS nombrePerfil, count(gusta1.id_publicacion) as countMegusta');
		$this->db->from('publicacion');
		$this->db->join('foto', 'publicacion.id_publicacion = foto.id_foto', 'left');
		$this->db->join('album', 'foto.id_album = album.id_album', 'left');
		$this->db->join('video', 'publicacion.id_publicacion = video.id_video', 'left');
		$this->db->join('gusta1', 'publicacion.id_publicacion = gusta1.id_publicacion', 'left');
		$this->db->join('cuenta_frontend', 'publicacion.id_usuario = cuenta_frontend.id_cuenta', 'inner');
		$this->db->join('perfil_pagina', 'cuenta_frontend.id_cuenta = perfil_pagina.id_cuenta', 'inner');
		$this->db->where('publicacion.id_usuario', $data);
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

	public function get_publicacion_grupo($data, $limite){
		$this->db->select('publicacion.id_publicacion, publicacion.texto, publicacion.fecha, foto.titulo, album.nombre AS nombreAlbum, album.ruta, video.enlace, cuenta_frontend.foto_perfil,cuenta_frontend.id_cuenta , perfil_usuario.nombre AS nombrePerfil, perfil_usuario.apellido, count(gusta1.id_publicacion) as countMegusta, grupo.id_administrador');
		$this->db->from('publicacion');
		$this->db->join('foto', 'publicacion.id_publicacion = foto.id_foto', 'left');
		$this->db->join('album', 'foto.id_album = album.id_album', 'left');
		$this->db->join('video', 'publicacion.id_publicacion = video.id_video', 'left');
		$this->db->join('gusta1', 'publicacion.id_publicacion = gusta1.id_publicacion', 'left');
		$this->db->join('cuenta_frontend', 'publicacion.id_usuario = cuenta_frontend.id_cuenta', 'inner');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'inner');
		$this->db->join('hecha', 'hecha.id_publicacion = publicacion.id_publicacion', 'inner');
		$this->db->join('grupo', 'grupo.id_grupo = hecha.id_grupo', 'inner');
		$this->db->where('hecha.id_grupo', $data);
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

	public function control_publicacion_pagina($data){
		$this->db->select('MAX(Fecha) AS Fecha');
		$this->db->from('publicacion');
		$resultado = $this->db->get();
		$resultado = $resultado->row();
		$d1 = new DateTime($resultado->Fecha);
		$d2 = new DateTime(date('Y-m-d H:i:s'));
		$d1->modify('+1 day');
		if ($d1 <= $d2) {
			$resultado = TRUE;
		}else{
			$resultado = FALSE;
		}
		return $resultado;
	}

	public function get_datos_publicacion($data){
		$this->db->where('id_publicacion', $data);
		$resultado = $this->db->get('publicacion');
		return $resultado->row();
	}

	public function control_publicacion($data, $data2){
		$this->db->where('id_publicacion', $data);
		$this->db->where('id_usuario', $data2);
		$resultado = $this->db->get('publicacion');
		return $resultado->row();
	}

	public function delete_publicacion($data){
		$this->db->select("foto.*, nombre, ruta");
		$this->db->from('foto');
		$this->db->join('album', 'album.id_album = foto.id_album', 'inner');
		$this->db->where('id_foto', $data);
		$resultado = $this->db->get();
		$resultado = $resultado->row();
		if (!empty($resultado)) {
			unlink("/mnt/assets/albumes/".$resultado->nombre."/".$resultado->ruta."/".$resultado->titulo) or die("Failed to <strong class='highlight'>delete</strong> file");
			$this->db->where('id_foto', $resultado->id_foto);
			$this->db->delete('foto');
		}
		$this->db->where('id_video', $data);
		$this->db->delete('video');
		$this->db->where('id_publicacion', $data);
		$resultado2 = $this->db->get('recibe1');
		$resultado2 = $resultado2->result();
		if (!empty($resultado2)) {
			foreach ($resultado2 as $value) {
				$this->db->where('id_comentario', $value->id_comentario);
				$this->db->delete('recibe1');
				$this->db->where('id_comentario', $value->id_comentario);
				$this->db->delete('recibe2');
				$this->db->where('id_comentario', $value->id_comentario);
				$this->db->delete('gusta2');
				$this->db->where('id_comentario', $value->id_comentario);
				$this->db->delete('comentario');
			}
		}
		$this->db->where('id_publicacion', $data);
		$this->db->delete('gusta1');
		$this->db->where('id_publicacion', $data);
		$this->db->delete('hecha');
		$this->db->where('id_publicacion', $data);
		$this->db->delete('comparte');
		$this->db->where('id_publicacion', $data);
		$this->db->delete('publicacion');
	}

	public function get_format_time($df) {

		    $str = '';
		    $str .= ($df->invert == 1) ? ' - ' : '';
		    if ($df->y > 0) {
		        // years
		        $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' año ';
		    }else if ($df->m > 0) {
		        // month
		        $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
		    }else if ($df->d > 0) {
		        // days
		        $str .= ($df->d > 1) ? $df->d . ' Dias ' : $df->d . ' dia ';
		    }else if ($df->h > 0) {
		        // hours
		        $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Horas ';
		    }else if ($df->i > 0) {
		        // minutes
		        $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
		    }else if ($df->s > 0) {
		        // seconds
		        $str .= ($df->s > 1) ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
		    }

		    return $str;
		}

	
}