<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_buscar extends CI_Model {

	public function get_busqueda($data,$data2,$data3,$data4,$data5){
		$resultado = $this->db->query("CALL `BuscarSP`('".$data."','".$data2."','".$data3."','".$data4."','".$data5."')");
		$resultadoTotal = $resultado->result();
		$resultado->next_result(); 
		$resultado->free_result();
		return $resultadoTotal;
	}	
}