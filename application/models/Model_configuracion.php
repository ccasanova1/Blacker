<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_configuracion extends CI_Model {

	public function get_configuracion($data){
		$this->db->select('pais, telefono, nombre, apellido, fecha_nacimiento, estado_sentimental, ocupacion, genero, nombre_entidad, calle, numero, esquina, descripcion, not_publicacion, not_comentario, not_megusta, not_comparte, not_perfil');
		$this->db->from('cuenta_frontend');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'left');
		$this->db->join('perfil_pagina', 'cuenta_frontend.id_cuenta = perfil_pagina.id_cuenta', 'left');
		$this->db->join('establece', 'establece.id_cuenta = perfil_usuario.id_cuenta', 'left');
		$this->db->join('configuracion', 'establece.id_configuracion = configuracion.id_configuracion', 'left');
		$this->db->where('cuenta_frontend.id_cuenta', $data);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function update_configuracion($data, $data2){
		$sql = "UPDATE configuracion INNER JOIN establece ON establece.id_configuracion = configuracion.id_configuracion
		SET not_publicacion = '".$data['not_publicacion']."',
		not_comentario = '".$data['not_comentario']."',
		not_megusta = '".$data['not_megusta']."'
		WHERE id_cuenta = ".$data2;
		$this->db->query($sql);
	}

	public function update_usuario($data, $data2){
		$this->db->where('id_cuenta', $data2);
		$this->db->update('cuenta_frontend', $data);
	}

	public function update_perfil_usuario($data, $data2){
		$this->db->where('id_cuenta', $data2);
		$this->db->update('perfil_usuario', $data);
	}

	public function update_perfil_pagina($data, $data2){
		$this->db->where('id_cuenta', $data2);
		$this->db->update('perfil_pagina', $data);
	}
}