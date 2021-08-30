<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {

        $data = array(
            'titulo' => 'Categorias cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css'
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'categorias' => $this->core_model->get_all('categorias'),
        );

        /* echo '<pre>';
          print_r($data['vendedores']);
          exit();
         */

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');
    }

    public function add() {
        
        $this->form_validation->set_rules('categoria_nome', '', 'trim|required|min_length[2]|max_length[45]|callback_check_categoria_nome');

        $validado = $this->form_validation->run();
        if ($validado) {

            $data = elements(
                    array(
                        'categoria_nome',
                        'categoria_ativa',
                    ),
                    $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('categorias', $data);

            redirect('categorias');
        } else {

            //Erro de validação
            $data = array(
                'titulo' => 'Cadastrar categoria',
                'scripts' => array(
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js'
                ),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('categorias/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($categoria_id = NULL) {
        if (!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
            $this->session->set_flashdata('error', 'servico não encontrado');
            redirect('categorias');
        } else {

            $this->form_validation->set_rules('categoria_nome', '', 'trim|required|min_length[2]|max_length[45]|callback_check_categoria_nome');

            $validado = $this->form_validation->run();
            if ($validado) {

                $categoria_ativa = $this->input->post('categoria_ativa');

                if ($this->db->table_exists('produtos')) {
                    if ($categoria_ativa == 0 && $this->core_model->get_by_id('produtos', array('produto_categoria_id' => $categoria_id, 'produto_ativo' => 1))) {
                        $this->session->set_flashdata('error', 'Esta categoria não pode ser desativada, pois está sendo utilizada em Produtos');
                        redirect('categorias');
                    }
                }

                $data = elements(
                        array(
                            'categoria_nome',
                            'categoria_ativa',
                        ),
                        $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));

                redirect('categorias');
            } else {

                //Erro de validação
                $data = array(
                    'titulo' => 'Atualizar categoria',
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                    'categoria' => $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('categorias/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function check_categoria_nome($categoria_nome) {
        $categoria_id = $this->input->post('categoria_id');

        if ($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome, 'categoria_id !=' => $categoria_id))) {
            $this->form_validation->set_message('check_categoria_nome', 'Este categoria já existe');
            return false;
        } else {
            return true;
        }
    }

    public function del($categoria_id = NULL) {
        if (!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
            $this->session->set_flashdata('error', 'categoria não encontrado');
            redirect('categorias');
        } else {
            $this->core_model->delete('categorias', array('categoria_id' => $categoria_id));
            $this->session->set_flashdata('sucesso', 'categoria excluído com sucesso');
            redirect('categorias');
        }
    }

}
