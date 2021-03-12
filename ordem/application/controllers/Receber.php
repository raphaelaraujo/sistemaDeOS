<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receber extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }

        $this->load->model('financeiro_model');
    }

    public function index()
    {

        $data = array(
            'titulo' => 'Contas a receber cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css'
            ),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),

            'contas_receber' => $this->financeiro_model->get_all_receber(),
        );

        /*
        echo '<pre>';
        print_r($data['contas_pagar']);
        exit();
        */
        

        $this->load->view('layout/header', $data);
        $this->load->view('receber/index');
        $this->load->view('layout/footer');
    }
}