<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('layout/navbar.php') ?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('categorias') ?>">categorias</a></li>
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
            <?php echo formata_data_banco_com_hora($categoria->categoria_data_alteracao); ?>
          </p>

          <fieldset class="mt-4 border p-2 mb-3">
            <legend>
              <i class="fas fa-user-secret"></i>
              Dados Pessoais
            </legend>

            <div class="form-group row mb-3">
              <div class="col-md-6">
                <label for="exampleInputEmail1">Nome completo</label>
                <input type="text" class="form-control" name="categoria_nome_completo" placeholder="Nome completo" value="<?php echo $categoria->categoria_nome_completo; ?>">
                <?php echo form_error('categoria_nome_completo', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">CPF</label>
                <input type="text" class="form-control cpf" name="categoria_cpf" placeholder="CPF do categoria" value="<?php echo $categoria->categoria_cpf; ?>">
                <?php echo form_error('categoria_cpf', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">RG</label>
                <input type="text" class="form-control rg" name="categoria_rg" placeholder="RG do categoria" value="<?php echo $categoria->categoria_rg ?>">
                <?php echo form_error('categoria_rg', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-6">
                <label for="exampleInputEmail1">E-mail</label>
                <input type="text" class="form-control" name="categoria_email" placeholder="E-mail do categoria" value="<?php echo $categoria->categoria_email; ?>">
                <?php echo form_error('categoria_email', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Telefone fixo</label>
                <input type="text" class="form-control sp_celphones" name="categoria_telefone" placeholder="Telefone fixo" value="<?php echo $categoria->categoria_telefone; ?>">
                <?php echo form_error('categoria_telefone', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Celular</label>
                <input type="text" class="form-control sp_celphones" name="categoria_celular" placeholder="Telefone celular" value="<?php echo $categoria->categoria_celular; ?>">
                <?php echo form_error('categoria_celular', '<small class="form-text text-danger">', '</small>'); ?>
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
                <input type="text" class="form-control" name="categoria_endereco" value="<?php echo $categoria->categoria_endereco ?>">
                <?php echo form_error('categoria_endereco', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-2">
                <label for="exampleInputEmail1">Número</label>
                <input type="text" class="form-control" name="categoria_numero_endereco" value="<?php echo $categoria->categoria_numero_endereco ?>">
                <?php echo form_error('categoria_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Complemento</label>
                <input type="text" class="form-control" name="categoria_complemento" value="<?php echo $categoria->categoria_complemento ?>">
                <?php echo form_error('categoria_complemento', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-4">
                <label for="exampleInputEmail1">Bairro</label>
                <input type="text" class="form-control" name="categoria_bairro" value="<?php echo $categoria->categoria_bairro ?>">
                <?php echo form_error('categoria_bairro', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-2">
                <label for="exampleInputEmail1">CEP</label>
                <input type="text" class="form-control cep" name="categoria_cep" value="<?php echo $categoria->categoria_cep ?>">
                <?php echo form_error('categoria_cep', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-5">
                <label for="exampleInputEmail1">Cidade</label>
                <input type="text" class="form-control" name="categoria_cidade" value="<?php echo $categoria->categoria_cidade ?>">
                <?php echo form_error('categoria_cidade', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-1">
                <label for="exampleInputEmail1">UF</label>
                <input type="text" class="form-control uf" name="categoria_estado" value="<?php echo $categoria->categoria_estado ?>">
                <?php echo form_error('categoria_estado', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

          </fieldset>

          <fieldset class="mt-4 border p-2">
            <legend><i class="fas fa-tools"></i>
              Configurações
            </legend>

            <div class="form-group row mb-3">
              <div class="col-md-3">
                <label for="exampleInputEmail1">categoria ativo</label>
                <select name="categoria_ativo" class="form-control custom-select">
                  <option value="0" <?php echo ($categoria->categoria_ativo == 0 ? 'selected' : '') ?>>Não</option>
                  <option value="1" <?php echo ($categoria->categoria_ativo == 1 ? 'selected' : '') ?>>Sim</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Matrícula</label>
                <input readonly type="text" class="form-control" name="categoria_codigo" value="<?php echo $categoria->categoria_codigo ?>">
                <?php echo form_error('categoria_codigo', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">Observação</label>
                <textarea class="form-control" name="categoria_obs">
              <?php echo $categoria->categoria_obs ?>
              </textarea>
                <?php echo form_error('categoria_obs', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

          </fieldset class="">

          <input type="hidden" name="categoria_id" value="<?php echo $categoria->categoria_id ?>">

          <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
          <a title="Cadastrar novo categoria" href="<?php echo base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2">
            Voltar
          </a>
        </form>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->