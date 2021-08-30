<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar.php') ?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('clientes') ?>">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="POST" name="form_add">

                    <div class="custom-control custom-radio custom-control-inline mt-2">
                        <input type="radio" id="pessoa_fisica" name="cliente_tipo" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_tipo', '1') ?> checked="">
                        <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa física</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="pessoa_juridica" name="cliente_tipo" class="custom-control-input" value="2" <?php echo set_checkbox('cliente_tipo', '2') ?>>
                        <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa jurídica</label>
                    </div>

                    <fieldset class="mt-5 border p-2 mb-3">
                        <legend>
                            <i class="fas fa-user-tie"></i>
                            Dados Pessoais
                        </legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" class="form-control" name="cliente_nome" placeholder="Nome do cliente" value="<?php echo set_value('cliente_nome') ?>">
                                <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-5">
                                <label for="exampleInputEmail1">Sobrenome</label>
                                <input type="text" class="form-control" name="cliente_sobrenome" placeholder="Sobrenome do cliente" value="<?php echo set_value('cliente_sobrenome') ?>">
                                <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Data de nascimento</label>
                                <input type="date" class="form-control" name="cliente_data_nascimento" value="<?php echo set_value('cliente_data_nascimento') ?>">
                                <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-3">

                                <div class="pessoa_fisica">
                                    <label for="exampleInputEmail1">CPF</label>
                                    <input type="text" class="form-control cpf" name="cliente_cpf" placeholder="CPF do cliente" value="<?php echo set_value('cliente_cpf') ?>">
                                    <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                                <div class="pessoa_juridica">
                                    <label for="exampleInputEmail1">CNPJ</label>
                                    <input type="text" class="form-control cnpj" name="cliente_cnpj" placeholder="CNPJ do cliente" value="<?php echo set_value('cliente_cnpj') ?>">
                                    <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="pessoa_fisica" for="exampleInputEmail1">RG</label>
                                <label class="pessoa_juridica" for="exampleInputEmail1">Inscrição Estadual</label>
                                <input type="text" class="form-control" name="cliente_rg_ie" value="<?php echo set_value('cliente_rg_ie') ?>">
                                <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" class="form-control" name="cliente_email" placeholder="E-mail do cliente" value="<?php echo set_value('cliente_email') ?>">
                                <?php echo form_error('cliente_email', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Telefone fixo</label>
                                <input type="text" class="form-control sp_celphones" name="cliente_telefone" placeholder="Telefone do cliente" value="<?php echo set_value('cliente_telefone') ?>">
                                <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Telefone celular</label>
                                <input type="text" class="form-control sp_celphones" name="cliente_celular" placeholder="Celular do cliente" value="<?php echo set_value('cliente_celular') ?>">
                                <?php echo form_error('cliente_celular', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="mt-4 border p-2 mb-3">
                        <legend>
                            <i class="fas fa-map-marker-alt"></i>
                            Dados de endereço
                        </legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Endereço</label>
                                <input type="text" class="form-control" name="cliente_endereco" value="<?php echo set_value('cliente_endereco') ?>">
                                <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="exampleInputEmail1">Número</label>
                                <input type="text" class="form-control" name="cliente_numero_endereco" value="<?php echo set_value('cliente_numero_endereco') ?>">
                                <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Complemento</label>
                                <input type="text" class="form-control" name="cliente_complemento" value="<?php echo set_value('cliente_complemento') ?>">
                                <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Bairro</label>
                                <input type="text" class="form-control" name="cliente_bairro" value="<?php echo set_value('cliente_bairro') ?>">
                                <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="exampleInputEmail1">CEP</label>
                                <input type="text" class="form-control cep" name="cliente_cep" value="<?php echo set_value('cliente_cep') ?>">
                                <?php echo form_error('cliente_cep', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-5">
                                <label for="exampleInputEmail1">Cidade</label>
                                <input type="text" class="form-control" name="cliente_cidade" value="<?php echo set_value('cliente_cidade') ?>">
                                <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">UF</label>
                                <input type="text" class="form-control uf" name="cliente_estado" value="<?php echo set_value('cliente_estado') ?>">
                                <?php echo form_error('cliente_estado', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mt-4 border p-2">
                        <legend><i class="fas fa-tools"></i>
                            Configurações
                        </legend>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="exampleInputEmail1">Cliente ativo</label>
                                <select name="cliente_ativo" class="form-control custom-select">
                                    <option value="1"> Sim </option>
                                    <option value="0"> Não </option>                                    
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="exampleInputEmail1">Observação</label>
                                <textarea class="form-control" name="cliente_obs"></textarea>
                                <?php echo form_error('cliente_obs', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    <a title="Cadastrar novo cliente" href="<?php echo base_url('clientes') ?>" class="btn btn-success btn-sm ml-2">
                        Voltar
                    </a>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->