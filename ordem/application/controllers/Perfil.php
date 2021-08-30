<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perfil extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {

        $data = array(
            'titulo' => 'Perfis cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css'
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'perfis' => $this->core_model->get_all('groups'),
        );

        /* echo '<pre>';
          print_r($data['vendedores']);
          exit();
         */

        $this->load->view('layout/header', $data);
        $this->load->view('perfil/index');
        $this->load->view('layout/footer');
    }

    public function add() {

        $this->form_validation->set_rules('name', '', 'trim|required|min_length[2]|max_length[45]|callback_check_perfil_nome');
        $this->form_validation->set_rules('description', '', 'trim|required|min_length[2]|max_length[45]');

        $validado = $this->form_validation->run();
        if ($validado) {

            $data = elements(
                    array(
                        'name',
                        'description',
                    ),
                    $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('groups', $data);

            redirect('perfil');
        } else {

            //Erro de validação
            $data = array(
                'titulo' => 'Cadastrar Perfil',
                'scripts' => array(
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js'
                ),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('perfil/add');
            $this->load->view('layout/footer');
        }
    }

    public function inativar($perfil_id) {
        if ($this->db->table_exists('users_groups')) {
            if ($this->core_model->get_by_id('users_groups', array('user_id' => $perfil_id))) {
                $this->session->set_flashdata('error', 'Este perfil não pode ser desativado, pois existem usuários cadastrados nele');
                redirect('perfil');
            }
        }

        $data = array('ativo' => 1,);

        $data = html_escape($data);

        $this->core_model->update('groups', $data, array('id' => $perfil_id));
        redirect('perfil');
    }

    public function ativar($perfil_id) {

        $data = array('ativo' => 0,);
        $data = html_escape($data);
        $this->core_model->update('groups', $data, array('id' => $perfil_id));
        redirect('perfil');
    }

    public function check_perfil_nome($perfil_nome) {
        $perfil_id = $this->input->post('id');

        if ($this->core_model->get_by_id('groups', array('name' => $perfil_nome, 'id !=' => $perfil_id))) {
            $this->form_validation->set_message('check_perfil_nome', 'Este perfil já existe');
            return false;
        } else {
            return true;
        }
    }

}
