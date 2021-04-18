<?php

defined('BASEPATH') or exit('Ação não permitida');

class Financeiro_model extends CI_Model {

    public function get_all_pagar() {
        $this->db->select([
            'contas_pagar.*',
            'fornecedor_id',
            'fornecedor_nome_fantasia as fornecedor',
        ]);

        $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'LEFT');
        return $this->db->get('contas_pagar')->result();
    }

    public function get_all_receber() {
        $this->db->select([
            'contas_receber.*',
            'cliente_id',
            'cliente_nome',
        ]);

        $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'LEFT');
        return $this->db->get('contas_receber')->result();
    }

    public function get_contas_receber_relatorio($conta_receber_status = null, $data_vencimento = null, $data_receber = null) {
        $this->db->select([
            'contas_receber.*',
            'cliente_id',
            'CONCAT (clientes.cliente_nome," ",clientes.cliente_sobrenome) as cliente_nome_completo',
        ]);

        $this->db->where('conta_receber_status', $conta_receber_status);
        $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'LEFT');

        if ($data_vencimento) {
            date_default_timezone_set('America/Fortaleza');
            $this->db->where('conta_receber_data_vencimento <', date('Y-m-d'));
        }
        if ($data_receber) {
            date_default_timezone_set('America/Fortaleza');
            $this->db->where('conta_receber_data_vencimento >', date('Y-m-d'));
        }
        return $this->db->get('contas_receber')->result();
    }

    public function get_contas_pagar_relatorio($conta_pagar_status = null, $data_vencimento = null, $data_pagar = null) {
        $this->db->select([
            'contas_pagar.*',
            'fornecedores.fornecedor_id',
            'fornecedores.fornecedor_nome_fantasia as fantasia',
            'fornecedores.fornecedor_cnpj as cnpj',
        ]);

        $this->db->where('conta_pagar_status', $conta_pagar_status);
        $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'LEFT');

        if ($data_vencimento) {
            date_default_timezone_set('America/Fortaleza');
            $this->db->where('conta_pagar_data_vencimento <', date('Y-m-d'));
        }
        if ($data_pagar) {
            date_default_timezone_set('America/Fortaleza');
            $this->db->where('conta_pagar_data_vencimento >', date('Y-m-d'));
        }
        return $this->db->get('contas_pagar')->result();
    }

    public function get_sum_contas_receber_relatorio($conta_receber_status = null, $data_vencimento = null) {
        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_receber_valor,",","")),2) as conta_receber_valor_total',
        ]);

        $this->db->where('conta_receber_status', $conta_receber_status);

        if ($data_vencimento) {
            date_default_timezone_set('America/Fortaleza');
            $this->db->where('conta_receber_data_vencimento <', date('Y-m-d'));
        }
        return $this->db->get('contas_receber')->row();
    }

    public function get_sum_contas_pagar_relatorio($conta_pagar_status = null, $data_vencimento = null) {
        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_pagar_valor,",","")),2) as conta_pagar_valor_total',
        ]);

        $this->db->where('conta_pagar_status', $conta_pagar_status);

        if ($data_vencimento) {
            date_default_timezone_set('America/Fortaleza');
            $this->db->where('conta_pagar_data_vencimento <', date('Y-m-d'));
        }
        return $this->db->get('contas_pagar')->row();
    }

}
