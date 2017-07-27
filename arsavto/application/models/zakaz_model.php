<?php

class Zakaz_model extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function getRequestVars()
	{
		$result_array = array();
		if (is_array($_REQUEST)) foreach ($_REQUEST as $k => $v) $result_array[$k]=$v;
		return $result_array;
	}
	
	function getPostVar()
	{
		$result_array = array();
		if (is_array($_POST)) foreach ($_POST as $k => $v) $result_array[$k]=$v;
		return $result_array;
	}
	
	function getField($input,$alt_out='')
	{
		$out_array = array();
		foreach($input as $v)
		if(isset($this->request[$v]) && $this->request[$v]!='') $out_array[$v] = htmlspecialchars($this->request[$v]);
			else $out_array[$v] = $alt_out;
		return $out_array;
	}
	
	function getCheck($input)
	{
		$out_array = array();
		foreach($input as $k => $v)
		{
			if(isset($this->request[$k]) && $this->request[$k]!='') $type_checked = array_search($this->request[$k],$v['array']);
			else $type_checked = $v['default'];
			$count = 0;
			foreach($v['array'] as $type)
			{
				$out_array[$k][$count]['value'] = $type;
				$out_array[$k][$count]['check'] = ($count == $type_checked?" checked":"");
				$count++;
			}
		}
		return $out_array;
	}
}