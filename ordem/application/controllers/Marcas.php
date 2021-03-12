<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marcas extends CI_Controller
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
            'titulo' => 'Marcas cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css'
            ),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),

            'marcas' => $this->core_model->get_all('marcas'),
        );

        /*echo '<pre>';
        print_r($data['vendedores']);
        exit();
        */

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/index');
        $this->load->view('layout/footer');
    }
}