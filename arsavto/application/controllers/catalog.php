<?php
class Catalog extends CI_Controller{

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
			$this->data['keyword'] = $this->config->item('keyword');
			$this->data['description'] = $this->config->item('description');
			$this->data['title'] = $this->config->item('site_title');
			$this->data['menu'] = $this->parser->parse('menuview',$this->data, TRUE);
			$this->data['bottom'] = $this->parser->parse('bottomview',$this->data, TRUE);
			$this->data['head'] = $this->parser->parse('headview',$this->data, TRUE);
			$this->data['table'] = '';
			$this->data['pagination'] = '';
			$this->data['jscript'] = $this->parser->parse('javascriptview',$this->data, TRUE);
//			$this->load->scaffolding('table_name');
		}
		public function index()
		{
//			$this->load->scaffolding('catalog');
			$this->data['content'] = $this->parser->parse('catalogmenuview',$this->data,true);
			$this->parser->parse('mainview',$this->data);
		}
		
		public function main($model = 0,$default_id = 0)
		{
			$catalog_id = 1;
			if($model == 0)
			{
				$this->data['model'] = '';
				$query = $this->db->query("SELECT id, name,img FROM brand WHERE 1=1;");
				$count = 0;
				foreach($query->result_array() as $vb)
				{
					$tmpl = array (
								'table_open' => '<table width="100%">',
								'heading_row_start'   => '<tr align="center">',
								'heading_row_end'     => '</tr>',
								'heading_cell_start' => '<td colspan="3"><center>',
								'heading_cell_end' => '</center></td>',
								'cell_start' => '<td width="160">',
								'row_start'   => '<tr align="center">',
								'cell_alt_start' => '<td width="160">',
								'row_alt_start'   => '<tr align="center">'
							);
					$this->table->set_template($tmpl);
					$this->table->set_heading('<img src="'.base_url().'img/'.$vb['img'].'"><br><font align="absmiddle" style="font: 20px Helvetica;"><b>'.$vb['name'].'<b></font>');
					$query_inside = $this->db->query("SELECT id,name,img FROM models WHERE brand = ".$vb['id']);
					$table_array = array();
					foreach($query_inside->result_array() as $v)
					{
						$table_array[] = '<a href="'.base_url().'catalog/main/'.$v['id'].'"><img src="'.base_url().($v['img']!=''?"img/models/".strtolower($vb['name']."_".$v['img']).".jpg":"img/no_image.jpg").'" style="border:none;"><br><h3>'.$v['name'].'</h3></a>';
					}
					$table_content = $this->table->make_columns($table_array, 3);
					$this->data['table_brand'][$count]['brand'] =  $this->table->generate($table_content);
					$this->table->clear();$count++;
				}
				
				$this->data['content'] = $this->parser->parse('catalogmainview',$this->data,true);
			}
			else
			{
				//Вывод списка запчастей
				$query = $this->db->query("SELECT brand, name FROM models WHERE id='".$model."'");
				$query = $query->row_array();
				$this->data['model'] = $query['name'];
				$query = $this->db->query("SELECT name FROM brand WHERE id='".$query['brand']."'");
				$query = $query->row_array();
				$this->data['brand'] = $query['name'];
			
				$id_array = $this->Catalog_model->get_type_parts($catalog_id);
				$default_id_from_query = $this->Catalog_model->get_default_type_parts($catalog_id);
				if(!in_array($default_id,array_keys($id_array))) $default_id = $default_id_from_query;
			
				$count = 0;
			
				foreach($id_array as $k => $v)
				{
					$this->data['all_type_parts'][$count]['category_id'] = $k;	
					$this->data['all_type_parts'][$count]['category_name'] = $v;
					$this->data['all_type_parts'][$count]['current_url'] = base_url().'catalog/main/'.$model;
				
					if($default_id == $k)
						$this->data['type_parts'] = $v;
					$count++;
				}
				$query = $this->db->query("SELECT id, name,img, price, ncat, firm FROM catalog WHERE cat = '".$default_id."' AND model=".$model." ORDER BY id DESC");
				$table_array=array();
			
			
				$tmpl = array ('table_open' => '<table  width="780">','cell_start' => '<td align="left" valign="top" style="padding:10px 10px 10px 10px;width:'.ceil(100/3).'%;">', 'cell_alt_start' => '<td align="left" valign="top" style="padding:10px 10px 10px 10px;width:'.ceil(100/3).'%;">');
				$this->table->set_template($tmpl);
				if($query->num_rows() > 0)
				{
					foreach($query->result_array() as $v)
					{
						$style = 'width:100px';
						if($v['img']>0 && file_exists('./img/cat/'.$v['img']))
						{
							$img = 'cat/'.$v['img'];
							$img_array = getimagesize('./img/cat/'.$v['img']);
							if($img_array[0]<$img_array[1])
								$style = 'height:100px';
							$class = ' class="zoomi"';
						}
						else
						{
							$img = 'no_image.jpg';
							$class = '';
						}
						$table_array[] = '<img'.$class.' src="'.base_url().'img/'.$img.'" style="border-color: #454545; border-width: 1; padding: 10px 10px 10px 20px;'.$style.'"/><br/><b>'.$v['name'].'</b><br/>Производитель: <b>'.$v['firm'].'</b><br/>Каталожный номер:<br/><b>'.($v['ncat'] != ''?$v['ncat']:'отсутствует').'</b><br/>Цена за шт.: <font color="#ea2a37" style="font-size: 15px; font-color:#F00;"><b>'.$v['price'].'</b></font>';
					}
					$table_list = $this->table->make_columns($table_array, 3);
					$this->data['table'] = $this->table->generate($table_list);
				}
				else $this->data['table'] = '<br/><h2>По Вашему запросу ничего не найдено.</h2>';
				$this->data['content'] = $this->parser->parse('catalogcommissionview',$this->data,true);
			}
			$this->parser->parse('mainview',$this->data);
		}
		
		public function commission($default_id = 0)
		{
			$catalog_id = 2;
			$this->data['model'] = '';
			$this->data['brand'] = 'Комиссионные товары';
			$id_array = $this->Catalog_model->get_type_parts($catalog_id);
			$default_id_from_query = $this->Catalog_model->get_default_type_parts($catalog_id);

			if(!in_array($default_id,array_keys($id_array))) $default_id = $default_id_from_query;
			//else 
			
			$count = 0;
			
			foreach($id_array as $k => $v)
			{
				$this->data['all_type_parts'][$count]['category_id'] = $k;	
				$this->data['all_type_parts'][$count]['category_name'] = $v;
				$this->data['all_type_parts'][$count]['current_url'] = base_url().'catalog/commission';
				
				if($default_id == $k)
					$this->data['type_parts'] = $v;
				$count++;
			}
			
			$query = $this->db->query("SELECT id, name,img, price, des, firm FROM catalog WHERE cat = '".$default_id."' ORDER BY id DESC");
			$table_array=array();
			
			
			$tmpl = array ('table_open' => '<table  width="780">','cell_start' => '<td align="left" valign="top" style="padding:10px 10px 10px 10px;width:'.ceil(100/3).'%;">', 'cell_alt_start' => '<td align="left" valign="top" style="padding:10px 10px 10px 10px;width:'.ceil(100/3).'%;">');
			$this->table->set_template($tmpl);
			if($query->num_rows() > 0)
			{
				foreach($query->result_array() as $v)
				{
					$style = 'width:100px';
					if($v['img']>0 && file_exists('./img/cat/'.$v['img']))
					{
						$img = 'cat/'.$v['img'];
						$img_array = getimagesize('./img/cat/'.$v['img']);
						if($img_array[0]<$img_array[1])
							$style = 'height:100px';
						$class = ' class="zoomi"';
					}
					else
					{
						$img = 'no_image.jpg';
						$class = '';
					}
					$table_array[] = '<div style="width:100px;height:100px;"><img'.$class.' src="'.base_url().'img/'.$img.'" style="border-color: #454545; border-width: 1; padding: 10px 10px 10px 20px;'.$style.'"/></div><br/><b>'.$v['name'].'</b><br/>Производитель: <b>'.$v['firm'].'</b><br/>Состояние:<br/><b>'.$v['des'].'</b><br/>Цена за шт.: <font color="#ea2a37" style="font-size: 15px; font-color:#F00;"><b>'.$v['price'].'</b></font>';
				}
				$table_list = $this->table->make_columns($table_array, 3);
				$this->data['table'] = $this->table->generate($table_list);
			}
			else $this->data['table'] = '<br/><h2>По Вашему запросу ничего не найдено.</h2>';
			$this->data['content'] = $this->parser->parse('catalogcommissionview',$this->data,true);
			$this->parser->parse('mainview',$this->data);
		}
		
		public function search($search = '')
		{	
			if(isset($_REQUEST['search'])) redirect(base_url()."catalog/search/".$_REQUEST['search'], 'location');
			$search = trim(urldecode($search));
			$this->data['search'] = $search;
			$this->load->helper('Form');
			$form['input'] = array('name' => 'search', 'id' => 'search', 'value' => $this->data['search'], 'maxlength'   => '20', 'size' => '20');
			$form['submit'] = array('value' => 'Поиск');
			$this->data['form'] = form_open(base_url().'catalog/search',array('accept-charset'=>'windows-1251','method' => 'post')).form_input($form['input'])." ".form_submit($form['submit']).form_close();
			
			$this->page_config['num_links'] = 2;
			$this->page_config['first_link'] = '<< В начало';
			$this->page_config['next_link'] = 'Далее >';
			$this->page_config['prev_link'] = '< Назад';
			$this->page_config['last_link'] = 'В конец >>';
			$this->page_config['uri_segment'] = 4;
			
			if(!preg_match("/^(\d|\d\d|\d\d\d)$/",$this->uri->segment(4, 0))) $page_jump = 0;
			else $page_jump = $this->uri->segment(4, 0);
			if($search == "") $this->data['message'] = "Введите номер детали для поиска по каталогу.";
			elseif(strlen($search)<3) $this->data['message'] = "Строка поиска не может содержать менее трех символов.";
			else $this->data['message'] = "Результаты поиска по ".$search.".";

			if(strlen($search)>=3)
			{
				$search = str_replace("'","\'",$search);
				$query = $this->db->query('SELECT ncat AS \'Номер по каталогу\',name AS \'Название\',price AS \'Цена\' FROM catalog_new WHERE ncat LIKE \'%'.$search.'%\' ORDER BY ncat LIMIT '.$page_jump.',30');
				if($query->num_rows())
				{
					$tmpl = array ('heading_cell_start' => '<td class="catalog_td_head">', 'cell_start' => '<td class="catalog_td">', 'cell_alt_start' => '<td class="catalog_td">');
					$this->table->set_template($tmpl);
					$this->data['table'] = $this->table->generate($query);
				}
				else
				$this->data['table'] = "<b><h2>По Вашему запросу ничего не найдено.</h2></b>";
				
				$this->load->library('pagination');
				$query_num = $this->db->query('SELECT id AS count FROM catalog_new WHERE ncat LIKE \'%'.$search.'\'');
				
				$this->page_config['base_url'] = base_url().'catalog/search/'.$search;
				$this->page_config['total_rows'] = $query_num->num_rows();
				$this->page_config['per_page'] = '30'; 

				$this->pagination->initialize($this->page_config); 

				$this->data['pagination'] = $this->pagination->create_links();
			}
			$this->data['content'] = $this->parser->parse('catalogsearchview',$this->data,true);
			$this->parser->parse('mainview',$this->data);
		}
	}
