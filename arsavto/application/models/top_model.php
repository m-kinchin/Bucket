<?php

class Top_model extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
	// Возвращает определенное количество товаров из ТОП-лита (распродажа) и перемещивает их
	function get_top($query, $size)
    {
		foreach($query->result_array() as $v) 	 
				$rezult[]=$v;
		$out = array();
		shuffle($rezult);
		$rezult=array_slice($rezult,0,$size);
		foreach($rezult as $rez)
		{
			$style = 'width:100px';
			if($rez['img']!='' && file_exists('./img/cat/'.$rez['img']))
			{
				$img = 'cat/'.$rez['img'];
				$img_array = getimagesize('./img/cat/'.$rez['img']);
				if($img_array[0]<$img_array[1])
					$style = 'height:100px';
				$class = ' class="zoomi"';
			}
			else
			{
				$img = 'no_image.jpg';
				$class = '';
			}																 
			$out[] = "<td align=\"center\" valign=\"top\"><img src=\"".base_url()."img/".$img."\" style=\"border-color: #454545; border-width: 1; padding: 10px 10px 10px 20px;".$style."\"><br><b>".$rez['name']."</b><br>Производитель: <b>".$rez['firm']."</b><br>Цена за шт.: <font color=\"#ea2a37\" style=\"font-size: 15px; font-color:#F00\"><b>".$rez['price']."</b></font></td>";
		}

        //$query = $this->db->get('catalog',10);
        return $out;
    }
}