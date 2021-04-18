<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Relatorios extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Você não tem permissão para acessar o menu Relatórios');
            redirect('/');
        }
    }

    public function os() {

        $data = array(
            'titulo' => 'Relatórios de ordens de serviços'
        );

        $data_inicial = $this->input->post('data_inicial');
        $data_final = $this->input->post('data_final');

        if ($data_inicial) {
            $this->load->model('ordem_servicos_model');

            if ($this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final)) {
                //monta o PDF

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                $ordens_servicos = $this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final);

                $file_name = 'Relatório de ordens de serviços';

                $html = '<html>';
                $html .= '<head>';

                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de ordens de serviços </title>';
                $html .= '</head>';

                $html .= '<body style="font-size: 14px">';

                $html .= '<h4 align="center">
                        ' . $empresa->sistema_razao_social . '<br/>
                        ' . 'CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                        ' . $empresa->sistema_endereco . ',&nbsp;' . $empresa->sistema_numero . '<br/>
                        ' . 'CEP: ' . $empresa->sistema_cep . ',&nbsp;' . $empresa->sistema_cidade . ',&nbsp;' . $empresa->sistema_estado . '<br/>    
                        ' . 'Telefone: ' . $empresa->sistema_telefone_fixo . '<br/>
                        ' . 'E-mail: ' . $empresa->sistema_email . '<br/>    
                    </h4>';

                $html .= '<hr>';


                if ($data_inicial && $data_final) {
                    $html .= '<p align="center" style="font-size: 12px">Relatório de ordens de serviços realizadas entre as seguintes datas:</p>';
                    $html .= '<p align="center" style="font-size: 12px">' . formata_data_banco_sem_hora($data_inicial) . ' - ' . formata_data_banco_sem_hora($data_final) . '</p>';
                } else {
                    $html .= '<p align="center" style="font-size: 12px">Relatório de ordens de serviços realizadas a partir da data:</p>';
                    $html .= '<p align="center" style="font-size: 12px">' . formata_data_banco_sem_hora($data_inicial) . '</p>';
                }

                //DADOS DA ORDEM
                $html .= '<table width="100%" border: solid #ddd 1px>';
                $html .= '<tr>';
                $html .= '<th>Ordem</th>';
                $html .= '<th>Data</th>';
                $html .= '<th>Cliente</th>';
                $html .= '<th>Forma de pagamento</th>';
                $html .= '<th>Valor total</th>';
                $html .= '</tr>';

                $ordem_servico_valor_total = $this->ordem_servicos_model->get_valor_final_relatorio_os($data_inicial, $data_final);

                foreach ($ordens_servicos as $os):
                    $html .= '<tr>';
                    $html .= '<td>' . $os->ordem_servico_id . '</td>';
                    $html .= '<td>' . formata_data_banco_com_hora($os->ordem_servico_data_emissao) . '</td>';
                    $html .= '<td>' . $os->cliente_nome_completo . '</td>';
                    $html .= '<td>' . $os->forma_pagamento . '</td>';
                    $html .= '<td>' . 'R$&nbsp;' . $os->ordem_servico_valor_total . '</td>';
                    $html .= '</tr>';
                endforeach;

                $html .= '<th colspan="3">';

                $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . $ordem_servico_valor_total->ordem_servico_valor_total . '</td>';

                $html .= '</th>';

                $html .= '</table>';

                $html .= '</body>';
                $html .= '</html>';



                //false abre PDF no navegador 
                //true faz o download
                $this->pdf->createPDF($html, $file_name, false);


//                echo '<pre>';
//                print_r($html);
//                exit();
            } else {
                if (!empty($data_inicial) && !empty($data_final)) {
                    $this->session->set_flashdata('info', 'Não foram encontradas Ordens de serviço abertas entre as datas ' . formata_data_banco_sem_hora($data_inicial) . ' e ' . formata_data_banco_sem_hora($data_final));
                } else {
                    $this->session->set_flashdata('info', 'Não foram encontradas Ordens de serviço abertas a partir da data ' . formata_data_banco_sem_hora($data_inicial));
                }

                redirect('relatorios/os');
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/os');
        $this->load->view('layout/footer');
    }

    public function receber() {

        $data = array(
            'titulo' => 'Relatório de contas a receber'
        );

        $contas = $this->input->post('contas');

        if ($contas == 'vencidas' || $contas == 'pagas' || $contas == 'receber') {

            $this->load->model('financeiro_model');

            if ($contas == 'vencidas') {
                $conta_receber_status = 0;
                $data_vencimento = true;

                if ($this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento)) {

                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                    $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento);

                    $file_name = 'Relatório de contas a receber vencidas';

                    $html = '<html>';
                    $html .= '<head>';

                    $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas a receber vencidas </title>';
                    $html .= '</head>';

                    $html .= '<body style="font-size: 14px">';

                    $html .= '<h4 align="center">
                        ' . $empresa->sistema_razao_social . '<br/>
                        ' . 'CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                        ' . $empresa->sistema_endereco . ',&nbsp;' . $empresa->sistema_numero . '<br/>
                        ' . 'CEP: ' . $empresa->sistema_cep . ',&nbsp;' . $empresa->sistema_cidade . ',&nbsp;' . $empresa->sistema_estado . '<br/>    
                        ' . 'Telefone: ' . $empresa->sistema_telefone_fixo . '<br/>
                        ' . 'E-mail: ' . $empresa->sistema_email . '<br/>    
                    </h4>';

                    $html .= '<hr>';

                    //DADOS DA ORDEM
                    $html .= '<table width="100%" border: solid #ddd 1px>';
                    $html .= '<tr>';
                    $html .= '<th>Conta ID </th>';
                    $html .= '<th>Data vencimento</th>';
                    $html .= '<th>Cliente</th>';
                    $html .= '<th>Situação</th>';
                    $html .= '<th>Valor total</th>';
                    $html .= '</tr>';

                    foreach ($contas as $conta):
                        $html .= '<tr>';
                        $html .= '<td>' . $conta->conta_receber_id . '</td>';
                        $html .= '<td>' . formata_data_banco_sem_hora($conta->conta_receber_data_vencimento) . '</td>';
                        $html .= '<td>' . $conta->cliente_nome_completo . '</td>';
                        $html .= '<td> Vencida </td>';
                        $html .= '<td>' . 'R$&nbsp;' . $conta->conta_receber_valor . '</td>';
                        $html .= '</tr>';
                    endforeach;

                    $valor_final_conta_vencida = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status, $data_vencimento);

                    $html .= '<th colspan="3">';

                    $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                    $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . $valor_final_conta_vencida->conta_receber_valor_total . '</td>';

                    $html .= '</th>';

                    $html .= '</table>';

                    $html .= '</body>';
                    $html .= '</html>';


//                echo '<pre>';
//                print_r($html);
//                exit();
                    //false abre PDF no navegador 
                    //true faz o download
                    $this->pdf->createPDF($html, $file_name, false);
                } else {
                    $this->session->set_flashdata('info', 'Não Existem contas vencidas na base de dados');
                    redirect('relatorios/receber');
                }
            }

            if ($contas == 'pagas') {

                $conta_receber_status = 1;

                if ($this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)) {

                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                    $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);

                    $file_name = 'Relatório de contas a receber pagas';

                    $html = '<html>';
                    $html .= '<head>';

                    $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas a receber pagas </title>';
                    $html .= '</head>';

                    $html .= '<body style="font-size: 14px">';

                    $html .= '<h4 align="center">
                        ' . $empresa->sistema_razao_social . '<br/>
                        ' . 'CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                        ' . $empresa->sistema_endereco . ',&nbsp;' . $empresa->sistema_numero . '<br/>
                        ' . 'CEP: ' . $empresa->sistema_cep . ',&nbsp;' . $empresa->sistema_cidade . ',&nbsp;' . $empresa->sistema_estado . '<br/>    
                        ' . 'Telefone: ' . $empresa->sistema_telefone_fixo . '<br/>
                        ' . 'E-mail: ' . $empresa->sistema_email . '<br/>    
                    </h4>';

                    $html .= '<hr>';

                    //DADOS DA ORDEM
                    $html .= '<table width="100%" border: solid #ddd 1px>';
                    $html .= '<tr>';
                    $html .= '<th>Conta ID </th>';
                    $html .= '<th>Data pagamento</th>';
                    $html .= '<th>Cliente</th>';
                    $html .= '<th>Situação</th>';
                    $html .= '<th>Valor total</th>';
                    $html .= '</tr>';

                    foreach ($contas as $conta):
                        $html .= '<tr>';
                        $html .= '<td>' . $conta->conta_receber_id . '</td>';
                        $html .= '<td>' . formata_data_banco_sem_hora($conta->conta_receber_data_pagamento) . '</td>';
                        $html .= '<td>' . $conta->cliente_nome_completo . '</td>';
                        $html .= '<td> Paga </td>';
                        $html .= '<td>' . 'R$&nbsp;' . $conta->conta_receber_valor . '</td>';
                        $html .= '</tr>';
                    endforeach;

                    $valor_final_conta_vencida = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);

                    $html .= '<th colspan="3">';

                    $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                    $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . $valor_final_conta_vencida->conta_receber_valor_total . '</td>';

                    $html .= '</th>';

                    $html .= '</table>';

                    $html .= '</body>';
                    $html .= '</html>';


//                echo '<pre>';
//                print_r($html);
//                exit();
                    //false abre PDF no navegador 
                    //true faz o download
                    $this->pdf->createPDF($html, $file_name, false);
                } else {
                    $this->session->set_flashdata('info', 'Não Existem contas recebidas na base de dados');
                    redirect('relatorios/receber');
                }
            }

            if ($contas == 'receber') {

                $conta_receber_status = 0;
                $data_vencimento = false;
                $data_receber = true;

                if ($this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento, $data_receber)) {

                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                    $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento, $data_receber);

                    $file_name = 'Relatório de contas a receber';

                    $html = '<html>';
                    $html .= '<head>';

                    $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas a receber </title>';
                    $html .= '</head>';

                    $html .= '<body style="font-size: 14px">';

                    $html .= '<h4 align="center">
                        ' . $empresa->sistema_razao_social . '<br/>
                        ' . 'CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                        ' . $empresa->sistema_endereco . ',&nbsp;' . $empresa->sistema_numero . '<br/>
                        ' . 'CEP: ' . $empresa->sistema_cep . ',&nbsp;' . $empresa->sistema_cidade . ',&nbsp;' . $empresa->sistema_estado . '<br/>    
                        ' . 'Telefone: ' . $empresa->sistema_telefone_fixo . '<br/>
                        ' . 'E-mail: ' . $empresa->sistema_email . '<br/>    
                    </h4>';

                    $html .= '<hr>';

                    //DADOS DA ORDEM
                    $html .= '<table width="100%" border: solid #ddd 1px>';
                    $html .= '<tr>';
                    $html .= '<th>Conta ID </th>';
                    $html .= '<th>Data vencimento</th>';
                    $html .= '<th>Cliente</th>';
                    $html .= '<th>Situação</th>';
                    $html .= '<th>Valor total</th>';
                    $html .= '</tr>';

                    foreach ($contas as $conta):
                        $html .= '<tr>';
                        $html .= '<td>' . $conta->conta_receber_id . '</td>';
                        $html .= '<td>' . formata_data_banco_sem_hora($conta->conta_receber_data_vencimento) . '</td>';
                        $html .= '<td>' . $conta->cliente_nome_completo . '</td>';
                        $html .= '<td> A receber </td>';
                        $html .= '<td>' . 'R$&nbsp;' . $conta->conta_receber_valor . '</td>';
                        $html .= '</tr>';
                    endforeach;

                    $valor_final_conta_vencida = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);

                    $html .= '<th colspan="3">';

                    $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                    $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . $valor_final_conta_vencida->conta_receber_valor_total . '</td>';

                    $html .= '</th>';

                    $html .= '</table>';

                    $html .= '</body>';
                    $html .= '</html>';


//                echo '<pre>';
//                print_r($html);
//                exit();
                    //false abre PDF no navegador 
                    //true faz o download
                    $this->pdf->createPDF($html, $file_name, false);
                } else {
                    $this->session->set_flashdata('info', 'Não Existem contas a receber na base de dados');
                    redirect('relatorios/receber');
                }
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/receber');
        $this->load->view('layout/footer');
    }

    public function pagar() {

        $data = array(
            'titulo' => 'Relatório de contas a pagar'
        );

        $contas = $this->input->post('contas');

        if ($contas == 'pagas' || $contas == 'vencidas' || $contas == 'a_pagar') {

            $this->load->model('financeiro_model');

            if ($contas == 'vencidas') {
                $conta_pagar_status = 0;
                $data_vencimento = true;

                if ($this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)) {

                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                    $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $file_name = 'Relatório de contas a pagar vencidas';

                    $html = '<html>';
                    $html .= '<head>';

                    $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas a pagar vencidas </title>';
                    $html .= '</head>';

                    $html .= '<body style="font-size: 14px">';

                    $html .= '<h4 align="center">
                        ' . $empresa->sistema_razao_social . '<br/>
                        ' . 'CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                        ' . $empresa->sistema_endereco . ',&nbsp;' . $empresa->sistema_numero . '<br/>
                        ' . 'CEP: ' . $empresa->sistema_cep . ',&nbsp;' . $empresa->sistema_cidade . ',&nbsp;' . $empresa->sistema_estado . '<br/>    
                        ' . 'Telefone: ' . $empresa->sistema_telefone_fixo . '<br/>
                        ' . 'E-mail: ' . $empresa->sistema_email . '<br/>    
                    </h4>';

                    $html .= '<hr>';

                    //DADOS DA ORDEM
                    $html .= '<table width="100%" border: solid #ddd 1px>';
                    $html .= '<tr>';
                    $html .= '<th>Conta ID </th>';
                    $html .= '<th>Data vencimento</th>';
                    $html .= '<th>CNPJ</th>';
                    $html .= '<th>Fornecedor</th>';
                    $html .= '<th>Situação</th>';
                    $html .= '<th>Valor total</th>';
                    $html .= '</tr>';

                    foreach ($contas as $conta):
                        $html .= '<tr>';
                        $html .= '<td>' . $conta->conta_pagar_id . '</td>';
                        $html .= '<td>' . formata_data_banco_sem_hora($conta->conta_pagar_data_vencimento) . '</td>';
                        $html .= '<td>' . $conta->cnpj . '</td>';
                        $html .= '<td>' . $conta->fantasia . '</td>';
                        $html .= '<td> Vencida </td>';
                        $html .= '<td>' . 'R$&nbsp;' . $conta->conta_pagar_valor . '</td>';
                        $html .= '</tr>';
                    endforeach;

                    $valor_final_conta_vencida = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $html .= '<th colspan="4">';

                    $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                    $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . $valor_final_conta_vencida->conta_pagar_valor_total . '</td>';

                    $html .= '</th>';

                    $html .= '</table>';

                    $html .= '</body>';
                    $html .= '</html>';


//                echo '<pre>';
//                print_r($html);
//                exit();
                    //false abre PDF no navegador 
                    //true faz o download
                    $this->pdf->createPDF($html, $file_name, false);
                } else {
                    $this->session->set_flashdata('info', 'Não Existem contas vencidas na base de dados');
                    redirect('relatorios/pagar');
                }
            }

            if ($contas == 'pagas') {
                $conta_pagar_status = 1;
                $data_vencimento = false;

                if ($this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)) {

                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                    $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $file_name = 'Relatório de contas pagas';

                    $html = '<html>';
                    $html .= '<head>';

                    $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas pagas </title>';
                    $html .= '</head>';

                    $html .= '<body style="font-size: 14px">';

                    $html .= '<h4 align="center">
                        ' . $empresa->sistema_razao_social . '<br/>
                        ' . 'CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                        ' . $empresa->sistema_endereco . ',&nbsp;' . $empresa->sistema_numero . '<br/>
                        ' . 'CEP: ' . $empresa->sistema_cep . ',&nbsp;' . $empresa->sistema_cidade . ',&nbsp;' . $empresa->sistema_estado . '<br/>    
                        ' . 'Telefone: ' . $empresa->sistema_telefone_fixo . '<br/>
                        ' . 'E-mail: ' . $empresa->sistema_email . '<br/>    
                    </h4>';

                    $html .= '<hr>';

                    //DADOS DA ORDEM
                    $html .= '<table width="100%" border: solid #ddd 1px>';
                    $html .= '<tr>';
                    $html .= '<th>Conta ID </th>';
                    $html .= '<th>Data pagamento</th>';
                    $html .= '<th>CNPJ</th>';
                    $html .= '<th>Fornecedor</th>';
                    $html .= '<th>Situação</th>';
                    $html .= '<th>Valor total</th>';
                    $html .= '</tr>';

                    foreach ($contas as $conta):
                        $html .= '<tr>';
                        $html .= '<td>' . $conta->conta_pagar_id . '</td>';
                        $html .= '<td>' . formata_data_banco_com_hora($conta->conta_pagar_data_pagamento) . '</td>';
                        $html .= '<td>' . $conta->cnpj . '</td>';
                        $html .= '<td>' . $conta->fantasia . '</td>';
                        $html .= '<td> Paga </td>';
                        $html .= '<td>' . 'R$&nbsp;' . $conta->conta_pagar_valor . '</td>';
                        $html .= '</tr>';
                    endforeach;

                    $valor_final_conta_vencida = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $html .= '<th colspan="4">';

                    $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                    $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . $valor_final_conta_vencida->conta_pagar_valor_total . '</td>';

                    $html .= '</th>';

                    $html .= '</table>';

                    $html .= '</body>';
                    $html .= '</html>';


//                echo '<pre>';
//                print_r($html);
//                exit();
                    //false abre PDF no navegador 
                    //true faz o download
                    $this->pdf->createPDF($html, $file_name, false);
                } else {
                    $this->session->set_flashdata('info', 'Não Existem contas pagas na base de dados');
                    redirect('relatorios/pagar');
                }
            }

            if ($contas == 'a_pagar') {
                $conta_pagar_status = 0;
                $data_vencimento = false;
                $data_pagar = true;

                if ($this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento, $data_pagar)) {

                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                    $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento, $data_pagar);

                    $file_name = 'Relatório de contas a pagar';

                    $html = '<html>';
                    $html .= '<head>';

                    $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas a pagar</title>';
                    $html .= '</head>';

                    $html .= '<body style="font-size: 14px">';

                    $html .= '<h4 align="center">
                        ' . $empresa->sistema_razao_social . '<br/>
                        ' . 'CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                        ' . $empresa->sistema_endereco . ',&nbsp;' . $empresa->sistema_numero . '<br/>
                        ' . 'CEP: ' . $empresa->sistema_cep . ',&nbsp;' . $empresa->sistema_cidade . ',&nbsp;' . $empresa->sistema_estado . '<br/>    
                        ' . 'Telefone: ' . $empresa->sistema_telefone_fixo . '<br/>
                        ' . 'E-mail: ' . $empresa->sistema_email . '<br/>    
                    </h4>';

                    $html .= '<hr>';

                    //DADOS DA ORDEM
                    $html .= '<table width="100%" border: solid #ddd 1px>';
                    $html .= '<tr>';
                    $html .= '<th>Conta ID </th>';
                    $html .= '<th>Data vencimento</th>';
                    $html .= '<th>CNPJ</th>';
                    $html .= '<th>Fornecedor</th>';
                    $html .= '<th>Situação</th>';
                    $html .= '<th>Valor total</th>';
                    $html .= '</tr>';

                    foreach ($contas as $conta):
                        $html .= '<tr>';
                        $html .= '<td>' . $conta->conta_pagar_id . '</td>';
                        $html .= '<td>' . formata_data_banco_sem_hora($conta->conta_pagar_data_vencimento) . '</td>';
                        $html .= '<td>' . $conta->cnpj . '</td>';
                        $html .= '<td>' . $conta->fantasia . '</td>';
                        $html .= '<td> A pagar </td>';
                        $html .= '<td>' . 'R$&nbsp;' . $conta->conta_pagar_valor . '</td>';
                        $html .= '</tr>';
                    endforeach;

                    $valor_final_conta_vencida = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $html .= '<th colspan="4">';

                    $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                    $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . $valor_final_conta_vencida->conta_pagar_valor_total . '</td>';

                    $html .= '</th>';

                    $html .= '</table>';

                    $html .= '</body>';
                    $html .= '</html>';


//                    echo '<pre>';
//                    print_r($html);
//                    exit();
                    //false abre PDF no navegador 
                    //true faz o download
                    $this->pdf->createPDF($html, $file_name, false);
                } else {
                    $this->session->set_flashdata('info', 'Não Existem contas a pagar na base de dados');
                    redirect('relatorios/pagar');
                }
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/pagar');
        $this->load->view('layout/footer');
    }

}
