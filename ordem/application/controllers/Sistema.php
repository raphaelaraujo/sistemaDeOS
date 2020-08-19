<?php

defined('BASEPATH') or exit('Ação não permitida');

class Sistema extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index()
    {

        $data = array(
            'titulo' => 'Editar informações do sistema',

            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js'
            ),

            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
        );

        $this->form_validation->set_rules('sistema_razao_social', '', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('sistema_nome_fantasia', '', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('sistema_cnpj', '', 'required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', '', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo', '', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_movel', '', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_email', '', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_site_url', '', 'required|valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_cep', '', 'required|exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco', '', 'required|max_length[145]');
        $this->form_validation->set_rules('sistema_numero', '', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_cidade', '', 'required|max_length[45]');
        $this->form_validation->set_rules('sistema_estado', '', 'required|max_length[2]');
        $this->form_validation->set_rules('sistema_txt_ordem_servico', '', 'max_length[500]');

        
        $validou = $this->form_validation->run();

        if ($validou) {

        /* [sistema_id] => 1
        [sistema_razao_social] => System Ordem Inc.
        [sistema_nome_fantasia] => Sistema de Ordem Now
        [sistema_cnpj] => 05.702.439/0001-80
        [sistema_ie] => 
        [sistema_telefone_fixo] => 
        [sistema_telefone_movel] => 
        [sistema_email] => ordemnow@contato.com.br
        [sistema_site_url] => http://localhost/ordem/
        [sistema_cep] => 66690935
        [sistema_endereco] => Rua Oswaldo Cruz
        [sistema_numero] => 600
        [sistema_cidade] => Belém
        [sistema_estado] => PA
        [sistema_txt_ordem_servico] => 
        [sistema_data_alteracao] => 2020-08-19 09:29:06 
        */
            
        $data = elements(
            array(
                'sistema_razao_social',
                'sistema_nome_fantasia',
                'sistema_cnpj',
                'sistema_ie',
                'sistema_ie',
                'sistema_telefone_fixo',
                'sistema_telefone_movel',
                'sistema_email',
                'sistema_site_url',
                'sistema_cep',
                'sistema_endereco',
                'sistema_numero',
                'sistema_cidade',
                'sistema_estado',
                'sistema_txt_ordem_servico',
            ), $this->input->post()
        );

        $data = html_escape($data);

        //update($tabela = NULL, $data = NULL, $condicao = NULL)
        $this->core_model->update('sistema', $data, array('sistema_id' => 1));

        redirect('sistema');

        } else {

            //Erro de validação 

            $this->load->view('layout/header');
            $this->load->view('sistema/index', $data);
            $this->load->view('layout/footer');
        }
    }
}
