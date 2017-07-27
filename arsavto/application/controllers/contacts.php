<?php
class Contacts extends CI_Controller{

       public function __construct()
       {
            parent::__construct();
			$this->load->library('table');
			$this->load->library('parser');
			$this->load->helper('Url');
			$this->data['base_url'] = base_url();
			$this->data['email'] = $this->config->item('email');
			$this->data['icq'] = $this->config->item('icq');
			$this->data['skype'] = $this->config->item('skype');
			$this->data['phone'] = $this->config->item('phone');
			$this->data['fax'] = $this->config->item('fax');
			$this->data['actCon'] = "act";
			$this->data['title'] = $this->config->item('site_title');
			$this->data['keyword'] = $this->config->item('keyword');
			$this->data['description'] = $this->config->item('description');
			$this->data['menu'] = $this->parser->parse('menuview',$this->data, TRUE);
			$this->data['bottom'] = $this->parser->parse('bottomview',$this->data, TRUE);
			$this->data['head'] = $this->parser->parse('headview',$this->data, TRUE);
			$this->data['jscript'] = '';
			
		}
		function index()
		{
			$this->data['content'] = $this->parser->parse('contactsview',$this->data,true);
			$this->parser->parse('mainview',$this->data);
		}
}