<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends CI_Controller
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

        /*echo '<pre>';
        print_r($data['vendedores']);
        exit();
        */

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');
    }
}