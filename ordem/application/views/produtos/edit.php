<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('layout/navbar.php') ?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('produtos') ?>">Produtos</a></li>
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
            <?php echo formata_data_banco_com_hora($produto->produto_data_alteracao); ?>
          </p>

          <fieldset class="mt-4 border p-2 mb-3">
            <legend>
              <i class="fab fa-product-hunt"></i>
              Dados do Produto
            </legend>

            <div class="form-group row mb-3">
              <div class="col-md-2">
                <label for="exampleInputEmail1">Cód. do produto</label>
                <input type="text" class="form-control" name="produto_codigo" value="<?php echo $produto->produto_codigo; ?>" readonly="">
                <?php echo form_error('produto_codigo', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-10">
                <label for="exampleInputEmail1">Descrição do produto</label>
                <input type="text" class="form-control" name="produto_descricao" placeholder="Descrição do produto" value="<?php echo $produto->produto_descricao; ?>">
                <?php echo form_error('produto_descricao', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-3">
                <label for="exampleInputEmail1">Marca</label>
                <select class="custom-select" name="produto_marca_id">
                  <?php foreach ($marcas as $marca) : ?>
                    <option value="<?php echo $marca->marca_id ?>" <?php echo ($marca->marca_id == $produto->produto_marca_id ? 'selected' : '') ?>>
                      <?php echo $marca->marca_nome ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Categoria</label>
                <select class="custom-select" name="produto_categoria_id">
                  <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?php echo $categoria->categoria_id ?>" <?php echo ($categoria->categoria_id == $produto->produto_categoria_id ? 'selected' : '') ?> <?php echo ($categoria->categoria_ativa == 0 ? 'disabled' : '') ?>>
                      <?php echo $categoria->categoria_nome ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Fornecedor</label>
                <select class="custom-select" name="produto_fornecedor_id">
                  <?php foreach ($fornecedores as $fornecedor) : ?>
                    <option value="<?php echo $fornecedor->fornecedor_id ?>" <?php echo ($fornecedor->fornecedor_id == $produto->produto_fornecedor_id ? 'selected' : '') ?> <?php echo ($fornecedor->fornecedor_ativo == 0 ? 'disabled' : '') ?>>
                      <?php echo $fornecedor->fornecedor_nome_fantasia ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Produto unidade</label>
                <input type="text" class="form-control" name="produto_unidade" placeholder="UN" value="<?php echo $produto->produto_unidade; ?>">
                <?php echo form_error('produto_unidade', '<small class="form-text text-danger">', '</small>'); ?>
              </div>

            </div>

          </fieldset>

          <fieldset class="mt-4 border p-2 mb-3">
            <legend>
              <i class="fas fa-funnel-dollar"></i>
              Precificação e estoque
            </legend>

            <div class="form-group row mb-3">
              <div class="col-md-3">
                <label for="exampleInputEmail1">Preço de custo</label>
                <input type="text" class="form-control money" name="produto_preco_custo" placeholder="Preço de custo" value="<?php echo $produto->produto_preco_custo; ?>">
                <?php echo form_error('produto_preco_custo', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Preço de venda</label>
                <input type="text" class="form-control money" name="produto_preco_venda" placeholder="Preço de venda" value="<?php echo $produto->produto_preco_venda; ?>">
                <?php echo form_error('produto_preco_venda', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Estoque mínimo</label>
                <input type="number" class="form-control" name="produto_estoque_minimo" placeholder="Estoque mínimo" value="<?php echo $produto->produto_estoque_minimo; ?>">
                <?php echo form_error('produto_estoque_minimo', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Quantidade em estoque</label>
                <input type="number" class="form-control" name="produto_qtde_estoque" placeholder="Quantidade em estoque" value="<?php echo $produto->produto_qtde_estoque; ?>">
                <?php echo form_error('produto_qtde_estoque', '<small class="form-text text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-3 mb-3">
                <label for="exampleInputEmail1">Produto ativo</label>
                <select class="custom-select" name="produto_ativo">
                    <option value="0" <?php echo ($produto->produto_ativo == 0 ? 'selected' : '') ?>>
                    Não
                    </option>
                    <option value="1" <?php echo ($produto->produto_ativo == 1 ? 'selected' : '') ?>>
                    Sim
                    </option>
                </select>
              </div>
              <div class="col-md-9 mb-3">
                <label for="exampleInputEmail1">Observações do produto</label>
                <textarea class="form-control" name="produto_obs">
                    <?php echo $produto->produto_obs ?>
                </textarea>
              </div>
            </div>

          </fieldset>

          <input type="hidden" name="produto_id" value="<?php echo $produto->produto_id ?>">

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