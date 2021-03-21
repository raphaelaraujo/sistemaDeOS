<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Formas_pagamentos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {

        $data = array(
            'titulo' => 'Formas de pagamentos cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css'
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos'),
        );

        /*
          echo '<pre>';
          print_r($data['formas_pagamentos']);
          exit();
         */


        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/index');
        $this->load->view('layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('forma_pagamento_nome', 'Nome da forma de pagamento', 'trim|required|min_length[3]|max_length[45]|is_unique[formas_pagamentos.forma_pagamento_nome]');

        if ($this->form_validation->run()) {

            $data = elements(
                    array(
                        'forma_pagamento_nome',
                        'forma_pagamento_ativa',
                        'forma_pagamento_aceita_parc',
                    ),
                    $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('formas_pagamentos', $data);
            redirect('modulo');
        } else {
            //erro de validação
            $data = array(
                'titulo' => 'Cadastrar forma de pagamento',
            );

            /*
              echo '<pre>';
              print_r($data['formas_pagamentos']);
              exit();
             */


            $this->load->view('layout/header', $data);
            $this->load->view('formas_pagamentos/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($forma_pagamento_id = null) {
        if (!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))) {
            $this->session->set_flashdata('error', 'Forma de pagamento não encontrada');
            redirect('modulo');
        } else {


            $this->form_validation->set_rules('forma_pagamento_nome', 'Nome da forma de pagamento', 'trim|required|min_length[4]|max_length[45]|callback_check_pagamento_nome');


            if ($this->form_validation->run()) {

                $forma_pagamento_ativa = $this->input->post('forma_pagamento_ativa');

                //para ordem de serviço
                if ($this->db->table_exists('ordens_servicos')) {
                    if ($forma_pagamento_ativa == 0 && $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_forma_pagamento_id' => $forma_pagamento_id, 'ordem_servico_status' => 0))) {
                        $this->session->set_flashdata('info', 'Forma de pagamento não pode ser desativada pois esta sendo utilizada em ordem de serviço');
                        redirect('modulos');
                    }
                }

                $data = elements(
                        array(
                            'forma_pagamento_nome',
                            'forma_pagamento_ativa',
                            'forma_pagamento_aceita_parc',
                        ),
                        $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('formas_pagamentos', $data, array('forma_pagamento_id' => $forma_pagamento_id));
                redirect('modulo');
            } else {
                //erro de validação

                $data = array(
                    'titulo' => 'Editar forma de pagamento',
                    'forma_pagamento' => $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id)),
                );

                /*
                  echo '<pre>';
                  print_r($data['formas_pagamentos']);
                  exit();
                 */


                $this->load->view('layout/header', $data);
                $this->load->view('formas_pagamentos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function check_pagamento_nome($forma_pagamento_nome = null) {
        $forma_pagamento_id = $this->input->post('forma_pagamento_id');

        if ($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_nome' => $forma_pagamento_nome, 'forma_pagamento_id != ' => $forma_pagamento_id))) {
            $this->form_validation->set_message('check_pagamento_nome', 'Essa forma de pagamento ja existe');
            return false;
        } else {
            return true;
        }
    }

    public function del($forma_pagamento_id = null) {

        if (!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))) {
            $this->session->set_flashdata('error', 'Forma de pagamenro não encontrada.');
            redirect('modulo');
        }

        if (!$forma_pagamento_id || $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id, 'forma_pagamento_ativa' => 1))) {
            $this->session->set_flashdata('info', 'Não é possivel excluir uma forma de pagamento que está ativa.');
            redirect('modulo');
        }

        $this->core_model->delete('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id));
        redirect('modulo');
    }

}
