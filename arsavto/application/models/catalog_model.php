<?php

class Catalog_model extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
	function get_type_parts($catalog_id)
	{
		$query = $this->db->query('SELECT id, name, default_part FROM type_parts WHERE catalogid='.$catalog_id);
			$id_array = array();
			
			foreach($query->result_array() as $v)
			{
				$id_array[$v['id']] = $v['name'];
			}
	return $id_array;
}

function get_default_type_parts($catalog_id)
{
	$query = $this->db->query('SELECT id FROM type_parts WHERE catalogid='.$catalog_id.' AND default_part = 1');
	$query = $query->row_array();
	return $query['id'];
}
}