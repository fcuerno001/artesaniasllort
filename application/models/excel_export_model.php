<?php

class Excel_export_model extends MY_Model{

function fetch_data()
{
	$query = $this->db->get("arte_catalogo");
	return $query->result();
}

}//Fin Model

