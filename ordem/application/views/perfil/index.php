<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar.php') ?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <?php if ($message = $this->session->flashdata('error')) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo $message; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($message = $this->session->flashdata('sucesso')) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="far fa-smile-wink" aria-hidden="true"> </i>
                            <?php echo $message; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($message = $this->session->flashdata('info')) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong><i class="far fa-smile-wink" aria-hidden="true"> </i>
                            <?php echo $message; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>  

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a title="Cadastrar novo perfil" href="<?php echo base_url('perfil/add') ?>" class="btn btn-success btn-sm float-right">
                    <i class="fas fa-plus">&nbsp;</i>
                    Novo
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th class="text-center pr-3">Ativo</th>
                                <th class="text-center no-sort">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($perfis as $perfil) : ?>

                                <tr>
                                    <td><?php echo $perfil->id ?></td>
                                    <td><?php echo $perfil->name ?></td>
                                    <td><?php echo $perfil->description ?></td>
                                    <td class="text-center"><?php echo ($perfil->ativo == 0 ? '<span class="badge badge-info btn-sm">Sim</span>' : '<span class="badge badge-warning btn-sm">Não</span>') ?></td>
                                    <?php if ($perfil->ativo == 0) : ?>
                                        <td class="text-center">                                        
                                            <a title="Inativar Perfil" href="<?php echo base_url('perfil/inativar/' . $perfil->id) ?>" class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></a>                                        
                                        </td>
                                    <?php endif; ?>
                                    <?php if ($perfil->ativo == 1) : ?>
                                        <td class="text-center">                                        
                                            <a title="Ativar Perfil" href="<?php echo base_url('perfil/ativar/' . $perfil->id) ?>" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i></a>                                        
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->