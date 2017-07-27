<?php
class Catalog_menu extends CI_Controller{

       public function __construct()
       {
            parent::__construct();
			$this->load->library('table');
			$this->load->model('Catalog_model');
			$this->load->library('parser');
			$this->load->helper('Url');
			$this->data['base_url'] = base_url();
			$this->data['email'] = $this->config->item('email');
			$this->data['icq'] = $this->config->item('icq');
			$this->data['skype'] = $this->config->item('skype');
			$this->data['phone'] = $this->config->item('phone');
			$this->data['actCat'] = "act";
			$this->data['fax'] = $this->config->item('fax');
			$this->data['title'] = $this->config->item('site_title');
			$this->data['keyword'] = $this->config->item('keyword');
			$this->data['description'] = $this->config->item('description');
			$this->data['menu'] = $this->parser->parse('menuview',$this->data, TRUE);
			$this->data['bottom'] = $this->parser->parse('bottomview',$this->data, TRUE);
			$this->data['head'] = $this->parser->parse('headview',$this->data, TRUE);
			
		}
		function index()
		{
			$this->data['content'] = $this->parser->parse('catalogmenuview',$this->data,true);
			$this->parser->parse('mainview',$this->data);
		}
		
		function search()
		{
			$this->data['content'] = $this->parser->parse('catalogmenuview',$this->data,true);
			$this->parser->parse('mainview',$this->data);
		}
		function commission()
		{
			$this->data['content'] = $this->parser->parse('catalogmenuview',$this->data,true);
			$this->parser->parse('mainview',$this->data);
		}
		function model()
		{
			$this->data['content'] = $this->parser->parse('catalogmenuview',$this->data,true);
			$this->parser->parse('mainview',$this->data);
		}
		function main($model = 0)
		{
			$this->data['current_url']="catalog/main";
			$this->data['model']=$model;
			$query = $this->db->query("SELECT id,name FROM type_parts");
			$count = 0;
			foreach($query->result_array() as $v)
			{
			
				$this->data['all_type_parts'][$count]['category_id'] = $v['id'];
				$this->data['all_type_parts'][$count]['category_name'] = $v['name'];
				$count++;
			}
			$this->data['content'] = $this->parser->parse('catalogmainview',$this->data,true);
			$this->parser->parse('mainview',$this->data);
		}
}