<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar.php') ?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios') ?>">Usuários</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a title="Cadastrar novo usuário" href="<?php echo base_url('usuarios') ?>" class="btn btn-success btn-sm float-right">
                    <i class="fas fa-arrow-left">&nbsp;</i>
                    Voltar
                </a>
            </div>
            <div class="card-body">
                <form method="POST" name="form_add">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Seu nome" value="<?php echo set_value('first_name'); ?>">
                            <?php echo form_error('first_name', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Sobrenome</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Seu sobrenome" value="<?php echo set_value('last_name'); ?>">
                            <?php echo form_error('last_name', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">E-mail (Login)</label>
                            <input type="email" class="form-control" name="email" placeholder="Seu e-mail" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Usuário</label>
                            <input type="text" class="form-control" name="username" placeholder="Seu usuário" value="<?php echo set_value('username'); ?>">
                            <?php echo form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label>Ativo</label>
                            <select class="form-control" name="active">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>                                
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Perfil de acesso</label>
                            <select class="form-control" name="perfil_usuario">
                                <?php foreach ($grupos as $group) : ?> 
                                    <option value="<?php echo $group->id ?>"><?php echo $group->name ?></option>                                    
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Sua senha" value="">
                            <?php echo form_error('password', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Confirme</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirme sua senha" value="">
                            <?php echo form_error('confirm_password', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->