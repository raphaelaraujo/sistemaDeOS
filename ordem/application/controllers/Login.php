<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	
    public function index()
    {
        $data = array(
            'titulo' => 'Login',
        );

            $this->load->view('layout/header', $data);
            $this->load->view('login/index');
            $this->load->view('layout/footer');
        
    }
 
    public function auth()
    {

        /*
        [email] => raphaelaraujo075@gmail.com
        [password] => 123456
        */

        $identity = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $remember = FALSE; // lembrar o usuário

        if ($this->ion_auth->login($identity, $password, $remember)) {

            redirect('home');

        } else {

            $this->session->set_flashdata('error', 'Verifique seu E-mail ou Senha');
            redirect('login');
        }
    }

    public function logout(){

        $this->ion_auth->logout();
        redirect('login');
    }
}
