


<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar.php') ?>


    <!-- Begin Page Content -->
    <div class="container-fluid">       

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Home</h1>

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

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

