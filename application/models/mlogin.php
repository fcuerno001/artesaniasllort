<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends My_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->id='id_usuario';
		$this->table='arte_usuario';
	}
//valida que exista un usuario desde login antes de llegar al controlador.

	public function login($user){
	$this->db->where('usuario',$user);
	$result=$this->db->get($this->table);
	return $result->row();
}

function get_all()
{
	$query=$this->db->get('arte_usuario');
	return $query->result();
	}
	
}//Fin de Model




