<?php
class Index extends CI_Controller{

       public function __construct()
       {
            parent::__construct();
			$this->load->library('table');
			$this->load->model('Top_model');
			$this->load->library('parser');
			$this->load->helper('Url');
			$this->data['base_url'] = base_url();
			$this->data['email'] = $this->config->item('email');
			$this->data['icq'] = $this->config->item('icq');
			$this->data['skype'] = $this->config->item('skype');
			$this->data['phone'] = $this->config->item('phone');
			$this->data['fax'] = $this->config->item('fax');
			$this->data['title'] = $this->config->item('site_title');
			$this->data['keyword'] = $this->config->item('keyword');
			$this->data['description'] = $this->config->item('description');
			$this->data['actInd'] = "act";
			$this->data['menu'] = $this->parser->parse('menuview',$this->data, TRUE);
			$this->data['bottom'] = $this->parser->parse('bottomview',$this->data, TRUE);
			$this->data['head'] = $this->parser->parse('headview',$this->data, TRUE);
			$this->data['jscript'] = '';
			// Ğàçìåğ ÒÎÏ ğàçäåëà
			$this->data['top_size'] = 3;
		}
		
		function index ()
		{
			$query = $this->db->query("SELECT img,name,firm,price FROM catalog WHERE sale = '1'");
			$count = $query->num_rows();
			if($this->data['top_size']>=$count)
			$this->data['top_size']=$count;
			
			$this->data['table_top'] = $this->Top_model->get_top($query,$this->data['top_size']);
			$this->data['content'] = $this->parser->parse('indexview',$this->data,true);
			$this->parser->parse('mainview',$this->data);			
		}

}