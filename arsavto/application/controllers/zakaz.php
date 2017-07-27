<?php
class Zakaz extends CI_Controller
{
   public function __construct()
   {
        parent::__construct();
        $this->load->model('Zakaz_model');
        $this->load->library('parser');
        $this->load->helper('Url');
        $this->data['base_url'] = base_url();
        $this->data['email'] = $this->config->item('email');
        $this->data['icq'] = $this->config->item('icq');
        $this->data['skype'] = $this->config->item('skype');
        $this->data['phone'] = $this->config->item('phone');
        $this->data['fax'] = $this->config->item('fax');
        $this->data['actOrd'] = "act";
        $this->data['title'] = $this->config->item('site_title');
        $this->data['keyword'] = $this->config->item('keyword');
        $this->data['description'] = $this->config->item('description');
        $this->data['menu'] = $this->parser->parse('menuview',$this->data, TRUE);
        $this->data['bottom'] = $this->parser->parse('bottomview',$this->data, TRUE);
        $this->data['head'] = $this->parser->parse('headview',$this->data, TRUE);
        $this->data['jscript'] = '';
        $this->check_array['type_kpp'] = array('key' => 'type_kpp', 'default' => 0, 'array'=> array('��������������', '������', '�����������'));
        $this->check_array['type_privod'] = array('key' => 'type_privod', 'default' => 0, 'array'=> array('��������', '������', '������'));
        $this->check_array['type_wheel'] = array('key' => 'type_wheel', 'default' => 0, 'array'=> array('�����', '������'));
        $this->input_array = array('contact', 'model', 'year', 'body', 'value_engine', 'power', 'text_order', 'vin');
    }

    function index()
    {
        $this->request = $this->Zakaz_model->getRequestVars();
        session_start();

        if(isset($this->request['captcha']) && $this->request['captcha'] == $_SESSION['code'])
        {
            $this->load->library('email');
            $config_email = array('protocol' => 'sendmail', 'mailpath' => '/usr/sbin/sendmail', 'mailtype' => 'html', 'charset' => 'windows-1251', 'useragent' => 'www.arsavto.com');
            $this->email->initialize($config_email);
            $this->email->from('info@arsavto.com', '��� ���-����');
            $this->email->to($this->data['email']);
            $this->email->subject('������ � �����');
            $this->email->message($this->parser->parse('mailview',$this->request, true));	

            if($this->email->send())
            {
                $this->data['message'] = '<tr><td colspan="4" class="ok">���� ������ ������� ����������.<br/>��� �������� �������� � ���� � ��������� �����.</td></tr>';
                $this->request = array();
            }
            else 
            {
                $this->data['message'] = '<tr><td colspan="4" class="error">�� ����� �������� ������ �������� ��������.</br>��������� ��� � �� ������� �� ��� ������ ��������������� ��� ���������� ��������� ������ �������.</td></tr>';
            }
        }
        elseif(isset($this->request['captcha']) && $this->request['captcha'] != $_SESSION['code'])
        {
            $this->data['message'] = '<tr><td colspan="4" class="error">�������� ��� �����. ����������, ��������� ����.</td></tr>';
        }
        else
        {
            $this->data['message'] = "";
        }

        $this->data = array_merge($this->data, $this->Zakaz_model->getField($this->input_array, ''));

        $this->data = array_merge($this->data, $this->Zakaz_model->getCheck($this->check_array));

        $this->data['content'] = $this->parser->parse('zakazview', $this->data, true);
        
        $this->parser->parse('mainview', $this->data);
    }
}