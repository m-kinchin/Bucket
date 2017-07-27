<?php
class _Admin_model extends CI_Model {
	
	function __construct()
    {
		        parent::__construct();
		$this->load->database();
	}

	function createMenu()
	{
		$temp = '<ul>';
			$type_parts     =   array('Аксессуары','Кузовные детали','Расходники','Запчасти');
				$type_parts1     =   array(count($type_parts)=>'Кузовные детали','Оптика','Двигатель','Другое');
				
		$query = $this->db->query("SELECT id, name FROM brand;");
        foreach($query->result_array() as $rez)
		{
            $query1=$this->db->query("SELECT * FROM models WHERE brand='".$rez['id']."'");
            if($query->num_rows())
            {
                $temp .= '<li>';
                $temp .= '<a href="#">'.$rez['name'].'</a><ul>';
                foreach($query1->result_array() as $rez1)
                {
                    $temp .= '<li><a href="#" calss="hide" title="">'.$rez1['name'].'</a><ul>';
					$query2 = $this->db->query("SELECT id, name FROM type_parts WHERE catalogid = 1;");
                    foreach($query2->result_array() as $v)
                        $temp .= '<li><a href="'.base_url().'_admin/catalog/'.$rez1['ID'].'/'.$v['id'].'/" title="">'.$v['name'].'</a></li>';
                    $temp .= '</ul></li>';
                }
                $temp .= '</ul></li>';
            }
        }
        $temp .='<li><a href="#">Комиссия</a><ul>';
                    $query = $this->db->query("SELECT id, name FROM type_parts WHERE catalogid = 2;");
                    foreach($query->result_array() as $v)
                        $temp .= '<li><a href="'.base_url().'_admin/catalog/0/'.$v['id'].'/" title="">'.$v['name'].'</a></li>';
						$temp .='</ul></li></ul>';
		return $temp;
	}
		
	function getAuth()
	{
		$admin['login'] =   'arsavto';
		if (is_array($_POST)) foreach ($_POST as $k => $v) $$k=$v;
		$admin['pass']  =   '570551ba60b4beb409866106a6fb8baa'; //fhcavto202
		if(isset($act) && $act==-1)
		{
			session_destroy();
			$_auth=0;
		}
		elseif(@($_SESSION['login']==$admin['login']) && @($_SESSION['pass']==$admin['pass']) && @($_SESSION['auth']==1))
			$_auth=1;
		elseif(isset($pass) && isset($login) && $act==1)
		{
			$_pass_md5=md5($pass);
			if(($login==$admin['login']) && ($_pass_md5==$admin['pass']))
			{
				$_auth=1;
				$_SESSION['login']=$login;
				$_SESSION['pass']=$_pass_md5;
				$_SESSION['auth']=$_auth;
			}
			else
				$_auth=-1;
		}
		else
			$_auth=0;
			
		return $_auth;
	}
}?>