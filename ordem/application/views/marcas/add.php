<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('layout/navbar.php') ?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('marcas') ?>">Marcas</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
      </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <form class="user" method="POST" name="form_add">

          <fieldset class="mt-4 border p-2 mb-3">
            <legend>
              <i class="fas fa-cubes"></i>
              Dados da Marca
            </legend>

            <div class="form-group row mb-3">
              <div class="col-md-8">
                <label for="exampleInputEmail1">Nome da marca</label>
                <input type="text" class="form-control" name="marca_nome" placeholder="Nome da marca" value="<?php echo set_value('marca_nome'); ?>">
                <?php echo form_error('marca_nome', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Marca ativa</label>
                <select name="marca_ativa" class="form-control custom-select">
                  <option value="0">Não</option>
                  <option value="1">Sim</option>
                </select>
              </div>
            </div>

          </fieldset>

          <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
          <a title="Cadastrar novo vendedor" href="<?php echo base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2">
            Voltar
          </a>
        </form>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->