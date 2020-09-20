<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_usuario extends CI_Model {

	public function get_usuario($data){
		$this->db->where("id_cuenta", $data);
		$resultado = $this->db->get("cuenta_frontend");
		return $resultado->row();
	}

	public function set_usuario($data){
		$this->db->insert("cuenta_frontend", $data);
	}

	public function get_usuario_comp($data){
		$this->db->where("email", $data);
		$resultado = $this->db->get("cuenta_frontend");
		return $resultado->row();
	}

	public function get_busca_usuarios($data, $data2){
		$this->db->select('*, cuenta_frontend.id_cuenta AS id');
		$this->db->from('cuenta_frontend');
		$this->db->join('perfil_usuario', 'cuenta_frontend.id_cuenta = perfil_usuario.id_cuenta', 'left');
		$this->db->join('perfil_pagina', 'cuenta_frontend.id_cuenta = perfil_pagina.id_cuenta', 'left');
		$this->db->group_start();
		$this->db->like('email', $data); 
		$this->db->or_like('telefono', $data);
		$this->db->or_like('nombre', $data);
		$this->db->or_like('apellido', $data);
		$this->db->or_like('nombre_entidad', $data);
		$this->db->group_end();
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function get_fotoPerfil($data){
		$this->db->select('foto_perfil');
		$this->db->from('cuenta_frontend');
		$this->db->where('id_cuenta', $data);
		$resultado = $this->db->get();
		return $resultado->row();
		
	}

	public function get_premium($data){
		$this->db->select('*');
		$this->db->from('perfil_pagina');
		$this->db->join('compra', 'compra.id_pagina = perfil_pagina.id_cuenta', 'INNER');
		$this->db->where('NOW() >= compra.fecha_inicio');
		$this->db->where('NOW() <= compra.fecha_fin');
		$this->db->where('perfil_pagina.id_cuenta', $data);
		$resultado = $this->db->get();
		if (empty($resultado->row())) {
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function get_premium_datos($data){
		$this->db->select('*');
		$this->db->from('perfil_pagina');
		$this->db->join('compra', 'compra.id_pagina = perfil_pagina.id_cuenta', 'INNER');
		$this->db->where('perfil_pagina.id_cuenta', $data);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function get_suscripciones(){
		$resultado = $this->db->get("suscripcion");
		return $resultado->result();
	}

	public function setupdate_premium_pagina($data,$data2){
		$this->db->where('id_pagina', $data);
		$resultado = $this->db->get("compra");
		if(!empty($resultado->row())){
			$sql = "UPDATE compra INNER JOIN suscripcion ON suscripcion.duracion = '".$data2."' SET compra.id_suscripcion = suscripcion.id_suscripcion, fecha_inicio = CURRENT_DATE(),
			fecha_fin = DATE_ADD(CURRENT_DATE(), INTERVAL ".$data2." DAY) compra.precio = suscripcion.precio WHERE id_pagina = ".$data;
		}else{
			$sql = "INSERT INTO compra SELECT ".$data." AS id_pagina, suscripcion.id_suscripcion, CURRENT_DATE() AS fecha_inicio ,DATE_ADD(CURRENT_DATE(), INTERVAL ".$data2." DAY) AS fecha_fin, suscripcion.precio FROM suscripcion WHERE duracion = '".$data2."'";
		} 
		$this->db->query($sql);
	}

	public function activacion($data){
		$this->db->where('activador', $data);
		$respuesta = $this->db->get('cuenta_frontend');
		$resultado = $respuesta->row();
		if (!empty($resultado)) {
			if (empty($resultado->activador)) {
				return 'inactivo';
			}else{
				$this->db->set('activador', 'activo');
				$this->db->where('id_cuenta', $resultado->id_cuenta);
				$this->db->update('cuenta_frontend');
				return 'activada';
			}
		}else{
			$this->db->where('activador', 'activo');
			$respuesta = $this->db->get('cuenta_frontend');
			$resultado = $respuesta->row();
			if (!empty($resultado)) {
				return 'activo';
			}else{
				return NULL;
			}
			
		}

	}
}