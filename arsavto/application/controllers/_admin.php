<?php
class _Admin extends CI_Controller{

		public function __construct()
		{
            parent::__construct();
			$this->load->helper('my_preg','url');
			$this->load->library('uri');
			$this->data['base_url'] = base_url();
			$this->load->model('_Admin_model');
			$this->data['succes'] = '';
			
			$this->config_form = array(
							array('field'   => 'part[name]', 'field_name' => 'name', 'label'   => 'asd',	'rules'   => 'required'),
							array('field'   => 'part[price]','field_name' => 'price','rules'   => 'required|numeric')
									);
			$this->part_key = array('name','firm','price','ncat','des','sale');
			session_start();
			$this->_auth = $this->_Admin_model->getAuth();
			foreach($this->config_form as $v)
					$this->data['error_'.$v['field_name']]='';
			if($this->_auth!=1 && $this->uri->segment(2,'') != '')
				redirect($this->data['base_url'].'_admin/');
		}
		
		public function index()
		{

			
			if($this->_auth!=1)
			{
			
				if($this->_auth == -1) $this->data['message'] = '<table  style="width:100%; height:80px; border: none;"><tr><td align="center"><font style="color: #FF0000;">Не верно набран логин либо пароль</font></td></tr></table>';
				else $this->data['message'] = '';
				$this->data['menu'] =  $this->parser->parse('_adminformview',$this->data,true);
				$this->data['content'] = '';
				$this->parser->parse('_adminmainview',$this->data);
			}
			else
			{
				$this->data['content'] = '';
				$this->data['menu_div'] =  $this->_Admin_model->createMenu();
				$this->data['menu'] = $this->parser->parse('_adminmenuview',$this->data,true);
				$this->parser->parse('_adminmainview',$this->data);
			}
		}
		public function catalog()
		{
			//$this->_auth = $this->_Admin_model->getAuth();
			$this->data['model'] = $this->uri->segment(3,'');
			$this->data['cat'] = $this->uri->segment(4,'');
			
			
			if($this->_auth==1 && $this->data['model'] != '' && $this->data['cat'] !='')
			{	

				$this->data['catalog'] = array();
				$query = $this->db->query("SELECT id, name, price, firm, img, ncat, sale FROM catalog WHERE model='".$this->data['model']."' AND  cat='".$this->data['cat']."' ORDER BY id DESC");
				$count = 0;
				foreach($query->result_array() as $result)
				{
					$this->data['catalog'][$count]['name'] = $result['name'];
					$this->data['catalog'][$count]['price'] = $result['price'];
					$this->data['catalog'][$count]['firm'] = $result['firm'];
					$this->data['catalog'][$count]['ncat'] = $result['ncat'];
					$this->data['catalog'][$count]['sale'] = ($result['sale'] == 1?'checked':'');
					$this->data['catalog'][$count]['model'] = $this->data['model'];
					$this->data['catalog'][$count]['base_url'] = $this->data['base_url'];
					$this->data['catalog'][$count]['cat'] = $this->data['cat'];
					$this->data['catalog'][$count]['id'] = $result['id'];
					$this->data['catalog'][$count]['img'] = (file_exists('./img/cat/'.$result['img'])?$this->data['base_url'].'img/cat/'.$result['img']:$this->data['base_url'].'img/cat/no_image.jpg');
					$count++;					
				}
			
				$this->data['content'] = $this->parser->parse('_admincatalogview',$this->data,true);
			}
			else
				$this->data['content'] = '';
			$this->data['menu_div'] =  $this->_Admin_model->createMenu();
			$this->data['menu'] = $this->parser->parse('_adminmenuview',$this->data,true);
			$this->parser->parse('_adminmainview',$this->data);
			//echo $_SERVER['HTTP_REFERER'];//phpinfo();
			
		}
		public function part()
		{
				if(isset($_REQUEST['part']))
				{
					$part = $_REQUEST['part'];
					foreach($part as $k => $v)
						$this->data[$k] = ($k=='sale'?($v == 1?"checked":""):$v);
					
					$config_upload['upload_path'] = './uploads/';
					$config_upload['allowed_types'] = 'gif|jpg|png';
					$config_upload['max_size']	= '100';
					$config_upload['max_width']  = '1024';
					$config_upload['max_height']  = '768';

					if(!$this->form_validation->run())
					{
						foreach($config as $v)
							$this->data['error_'.$v['field_name']]=form_error('part['.$v['field_name'].']','<div>','</div>');
						
					}
					else
					{
						$fields = array( 'model','cat','name','firm','ncat','price','img','des','sale');
						$values = array();
						$this->data['succes'] = "close();";
						foreach($fields as $v)
							if(isset($part[$v]))
								$values[] = "'".$part[$v]."'";
							else
								$values[] = "''";
						$this->db->query("INSERT INTO catalog (".implode(",",$fields).") VALUES (".implode(",",$values).")");
					}
					
				}
				//phpinfo();
				$this->parser->parse($view, $this->data);
			
			
		}
		
		public function add()
		{
			$this->load->library('form_validation');
			$this->data['cat'] = PregMatchInt($this->uri->segment(4,0),0);
			$this->data['model'] = PregMatchInt($this->uri->segment(3,0),0);
			$this->data['id'] = '';
			$this->form_validation->set_message('required', 'Поле обязательно для заполнения.');
			$this->form_validation->set_message('numeric', 'Не является числом.');
		
			$this->form_validation->set_rules($this->config_form);
			
			
					
			if(!$this->form_validation->run())
			{
				foreach($this->config_form as $v)
					$this->data['error_'.$v['field_name']]=form_error('part['.$v['field_name'].']','<div>','</div>');
				$this->data['error_myfile'] = '';
			}
			else
			{
				$values = array('model' => $this->data['model'],'cat' => $this->data['cat']);
				foreach($this->part_key as $v)
					if(isset($_REQUEST['part'][$v]))
						$values[$v] = "'".$_REQUEST['part'][$v]."'";
					else
						$values[$v] = "''";
				$this->db->query("INSERT INTO catalog (".implode(",",array_keys($values)).") VALUES (".implode(",",$values).")");
				$last_insert_id = mysql_insert_id();
				
				$config_upload['upload_path'] = './img/cat/';
				$config_upload['allowed_types'] = 'gif|jpg|png';
				$config_upload['max_size']	= '500';
				$config_upload['file_name']	= $last_insert_id;
				$config_upload['max_width']  = '1500';
				$config_upload['max_height']  = '1200';	
				$config_upload['min_width']  = '300';
				$config_upload['min_height']  = '300';	
				$this->load->library('upload', $config_upload);
				if (!$this->upload->do_upload('myfile'))
				{
					
					$this->data['error_myfile'] = $this->upload->display_errors('<div>', '</div>');
					//echo $this->upload->display_errors();
				}
				else
				{
					$upload_data = $this->upload->data();
					$this->db->query("UPDATE catalog SET img='".$upload_data['file_name']."' WHERE id=".$last_insert_id);
					$upload_data = $this->upload->data();
					$config_image['source_image'] = './img/cat/'.$upload_data['file_name'];
					$config_image['image_library'] = 'gd2';
					//if($upload_data['image_width']-$upload_data['image_height'] > $upload_data['image_height'])
					$config_image['width']	 = 300;
					$config_image['height']	= 300;
					$this->load->library('image_lib', $config_image);
					$this->image_lib->resize();
					//print_r($upload_data );
					$this->data['succes'] = "opener.window.location.reload();close();";
				}
				
			}
			if(isset($_REQUEST['part']))
				foreach($_REQUEST['part'] as $k => $v)
					$this->data[$k] = ($k=='sale'?($v == 1?"checked":""):$v);	
			else
				foreach($this->part_key as $v)
					$this->data[$v] = '';
			$this->parser->parse('_adminpartaddview', $this->data);
		}
		
		public function edit()
		{
			$this->load->library('form_validation');
			$this->data['cat'] = '';
			$this->data['model'] = '';
			$this->data['id'] = PregMatchInt($this->uri->segment(3,0),0);
			
			if($this->data['id'] != 0)
			{
				$this->form_validation->set_message('required', 'Поле обязательно для заполнения.');
				$this->form_validation->set_message('numeric', 'Не является числом.');
				$this->form_validation->set_rules($this->config_form); 
				if(!isset($_REQUEST['first_time']))
				{
					$result = $this->db->query("SELECT ".implode(',',$this->part_key)." FROM catalog WHERE id=".$this->data['id']);
					$result = $result->row_array();
					foreach($result as $k => $v)
					$this->data[$k] = ($k=='sale'?($v == 1?"checked":""):$v);
				}
				elseif(isset($_REQUEST['part']))
					foreach($_REQUEST['part'] as $k => $v)
						$this->data[$k] = ($k=='sale'?($v == 1?"checked":""):$v);
						
				if(!$this->form_validation->run())
				{
					foreach($this->config_form as $v)
						$this->data['error_'.$v['field_name']]=form_error('part['.$v['field_name'].']','<div>','</div>');
				}
				else
				{
					$values = array();
					foreach($this->part_key as $v)
						$values[] = $v."='".$_REQUEST['part'][$v]."'";
					$this->db->query("UPDATE catalog SET ".implode(',',$values)." WHERE id=".$this->data['id']);
					$this->data['succes'] = "opener.window.location.reload();close();";
					
				}
			}
			else
			{
				$this->data['succes'] = 'close();';
			}
			$this->parser->parse('_adminparteditview', $this->data);
		}
		
		public function del()
		{
			$this->data['del'] = PregMatchInt($this->uri->segment(3,0),0);
			if($this->data['del']>0)
				$this->db->query("DELETE FROM catalog WHERE id=".$this->data['del']);
			redirect($_SERVER['HTTP_REFERER'],'location');
		}
	}?>