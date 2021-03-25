<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Relatorios extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function os() {

        $data = array(
            'titulo' => 'Relatórios de orden de serviços'
        );

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

}
