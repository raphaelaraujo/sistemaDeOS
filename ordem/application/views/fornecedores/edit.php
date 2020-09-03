<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('layout/navbar.php') ?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('fornecedores') ?>">Fornecedores</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
      </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <form class="user" method="POST" name="form_edit">

          <p>
            <strong><i class="far fa-clock"></i>
              Última alteração:
            </strong>
            <?php echo formata_data_banco_com_hora($fornecedor->fornecedor_data_alteracao); ?>
          </p>

          <fieldset class="mt-4 border p-2 mb-3">
            <legend>
              <i class="fas fa-user-tag"></i>
              Dados Principais
            </legend>

            <div class="form-group row mb-3">
              <div class="col-md-6">
                <label for="exampleInputEmail1">Razão social</label>
                <input type="text" class="form-control" name="fornecedor_razao" placeholder="Razão social" value="<?php echo $fornecedor->fornecedor_razao; ?>">
                <?php echo form_error('fornecedor_razao', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">Nome fantasia</label>
                <input type="text" class="form-control" name="fornecedor_nome_fantasia" placeholder="Nome fantasia" value="<?php echo $fornecedor->fornecedor_nome_fantasia; ?>">
                <?php echo form_error('fornecedor_nome_fantasia', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-4">
                <label for="exampleInputEmail1">CNPJ</label>
                <input type="text" class="form-control cnpj" name="fornecedor_cnpj" placeholder="CNPJ do fornecedor" value="<?php echo $fornecedor->fornecedor_cnpj; ?>">
                <?php echo form_error('fornecedor_cnpj', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Inscrição estadual</label>
                <input type="text" class="form-control" name="fornecedor_ie" placeholder="Inscrição estadual" value="<?php echo $fornecedor->fornecedor_ie; ?>">
                <?php echo form_error('fornecedor_ie', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Telefone fixo</label>
                <input type="text" class="form-control sp_celphones" name="fornecedor_telefone" placeholder="Telefone fixo" value="<?php echo $fornecedor->fornecedor_telefone; ?>">
                <?php echo form_error('fornecedor_telefone', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-4">
                <label for="exampleInputEmail1">Celular</label>
                <input type="text" class="form-control sp_celphones" name="fornecedor_celular" placeholder="Celular do fornecedor" value="<?php echo $fornecedor->fornecedor_celular; ?>">
                <?php echo form_error('fornecedor_celular', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">E-email</label>
                <input type="email" class="form-control" name="fornecedor_email" placeholder="E-mail do fornecedor" value="<?php echo $fornecedor->fornecedor_email; ?>">
                <?php echo form_error('fornecedor_email', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Nome do atendente</label>
                <input type="text" class="form-control" name="fornecedor_contato" placeholder="Nome do atendente" value="<?php echo $fornecedor->fornecedor_contato; ?>">
                <?php echo form_error('fornecedor_contato', '<small class="form-text text-danger">', '</small>'); ?>
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
                <input type="text" class="form-control" name="fornecedor_endereco" value="<?php echo $fornecedor->fornecedor_endereco ?>">
                <?php echo form_error('fornecedor_endereco', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-2">
                <label for="exampleInputEmail1">Número</label>
                <input type="text" class="form-control" name="fornecedor_numero_endereco" value="<?php echo $fornecedor->fornecedor_numero_endereco ?>">
                <?php echo form_error('fornecedor_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Complemento</label>
                <input type="text" class="form-control" name="fornecedor_complemento" value="<?php echo $fornecedor->fornecedor_complemento ?>">
                <?php echo form_error('fornecedor_complemento', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-4">
                <label for="exampleInputEmail1">Bairro</label>
                <input type="text" class="form-control" name="fornecedor_bairro" value="<?php echo $fornecedor->fornecedor_bairro ?>">
                <?php echo form_error('fornecedor_bairro', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-2">
                <label for="exampleInputEmail1">CEP</label>
                <input type="text" class="form-control cep" name="fornecedor_cep" value="<?php echo $fornecedor->fornecedor_cep ?>">
                <?php echo form_error('fornecedor_cep', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-5">
                <label for="exampleInputEmail1">Cidade</label>
                <input type="text" class="form-control" name="fornecedor_cidade" value="<?php echo $fornecedor->fornecedor_cidade ?>">
                <?php echo form_error('fornecedor_cidade', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-1">
                <label for="exampleInputEmail1">UF</label>
                <input type="text" class="form-control uf" name="fornecedor_estado" value="<?php echo $fornecedor->fornecedor_estado ?>">
                <?php echo form_error('fornecedor_estado', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

          </fieldset>

          <fieldset class="mt-4 border p-2">
            <legend><i class="fas fa-tools"></i>
              Configurações
            </legend>

            <div class="form-group row mb-3">
              <div class="col-md-2">
                <label for="exampleInputEmail1">Cliente ativo</label>
                <select name="fornecedor_ativo" class="form-control custom-select">
                  <option value="0" <?php echo ($fornecedor->fornecedor_ativo == 0 ? 'selected' : '') ?>>Não</option>
                  <option value="1" <?php echo ($fornecedor->fornecedor_ativo == 1 ? 'selected' : '') ?>>Sim</option>
                </select>
              </div>
              <div class="col-md-8">
                <label for="exampleInputEmail1">Observação</label>
                <textarea class="form-control" name="fornecedor_obs">
              <?php echo $fornecedor->fornecedor_obs ?>
              </textarea>
                <?php echo form_error('fornecedor_obs', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

          </fieldset class="">

          <input type="hidden" name="fornecedor_id" value="<?php echo $fornecedor->fornecedor_id ?>">

          <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
          <a title="Cadastrar novo fornecedor" href="<?php echo base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2">
            Voltar
          </a>
        </form>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->