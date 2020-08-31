<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('layout/navbar.php') ?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('clientes') ?>">Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
      </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <form class="user" method="POST" name="form_edit">

          <fieldset class="mt-4 border p-2 mb-3">
            <legend>
              <i class="fas fa-user-tie"></i>
              Dados Pessoais
            </legend>

            <div class="form-group row mb-3">
              <div class="col-md-4">
                <label for="exampleInputEmail1">Nome</label>
                <input type="text" class="form-control" name="cliente_nome" placeholder="Nome do cliente" value="<?php echo $cliente->cliente_nome ?>">
                <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-5">
                <label for="exampleInputEmail1">Sobrenome</label>
                <input type="text" class="form-control" name="cliente_sobrenome" placeholder="Sobrenome do cliente" value="<?php echo $cliente->cliente_sobrenome ?>">
                <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>'); ?>
              </div>

              <div class="col-md-3">
                <label for="exampleInputEmail1">Data de nascimento</label>
                <input type="date" class="form-control" name="cliente_data_nascimento" value="<?php echo $cliente->cliente_data_nascimento ?>">
                <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-3">
                <label for="exampleInputEmail1">CPF ou CNPJ</label>
                <input type="text" class="form-control cnpj" name="cliente_cpf_cnpj" placeholder="CPF/CNPJ do cliente" value="<?php echo $cliente->cliente_cpf_cnpj ?>">
                <?php echo form_error('cliente_cpf_cnpj', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">RG ou I.E.</label>
                <input type="text" class="form-control" name="cliente_rg_ie" placeholder="RG ou I.E." value="<?php echo $cliente->cliente_rg_ie ?>">
                <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">E-mail</label>
                <input type="email" class="form-control" name="cliente_email" placeholder="E-mail do cliente" value="<?php echo $cliente->cliente_email ?>">
                <?php echo form_error('cliente_email', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-6">
                <label for="exampleInputEmail1">Telefone fixo</label>
                <input type="text" class="form-control sp_celphones" name="cliente_telefone" placeholder="Telefone do cliente" value="<?php echo $cliente->cliente_telefone ?>">
                <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">Telefone celular</label>
                <input type="text" class="form-control sp_celphones" name="cliente_celular" placeholder="Celular do cliente" value="<?php echo $cliente->cliente_celular ?>">
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
                <input type="text" class="form-control" name="cliente_endereco" value="<?php echo $cliente->cliente_endereco ?>">
                <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-2">
                <label for="exampleInputEmail1">Número</label>
                <input type="text" class="form-control" name="cliente_numero_endereco" value="<?php echo $cliente->cliente_numero_endereco ?>">
                <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Complemento</label>
                <input type="text" class="form-control" name="cliente_complemento" value="<?php echo $cliente->cliente_complemento ?>">
                <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-4">
                <label for="exampleInputEmail1">Bairro</label>
                <input type="text" class="form-control" name="cliente_bairro" value="<?php echo $cliente->cliente_bairro ?>">
                <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-2">
                <label for="exampleInputEmail1">CEP</label>
                <input type="text" class="form-control cep" name="cliente_cep" value="<?php echo $cliente->cliente_cep ?>">
                <?php echo form_error('cliente_cep', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-5">
                <label for="exampleInputEmail1">Cidade</label>
                <input type="text" class="form-control cep" name="cliente_cidade" value="<?php echo $cliente->cliente_cidade ?>">
                <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-1">
                <label for="exampleInputEmail1">UF</label>
                <input type="text" class="form-control uf" name="cliente_estado" value="<?php echo $cliente->cliente_estado ?>">
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
                <select name="cliente_ativo" class="form-control">
                  <option value="0" <?php echo ($cliente->cliente_ativo == 0 ? 'selected' : '')?>>Não</option>
                  <option value="1" <?php echo ($cliente->cliente_ativo == 1 ? 'selected' : '')?>>Sim</option>
                </select>
              </div>
              <div class="col-md-8">
                <label for="exampleInputEmail1">Observação</label>
                <textarea class="form-control" name="cliente_obs">
              <?php echo $cliente->cliente_obs ?>
              </textarea>
                <?php echo form_error('cliente_obs', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>
          </fieldset>

          <input type="hidden" name="cliente_id" value="<?php echo $cliente->cliente_id ?>">
          <input type="hidden" name="cliente_tipo" value="<?php echo $cliente->cliente_tipo ?>">

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