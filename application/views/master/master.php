<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PARCIAL 2020</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('content/_all-skins.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('content/AdminLTE.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('content/bootstrap.css.map') ?>">
    <link rel="stylesheet" href="<?php echo base_url('content/bootstrap.min.css') ?>">
    <script src="<?php echo base_url('content/jQuery-2.1.4.min.js') ?>"></script>
    <script src="<?php echo base_url('content/jquery.slimscroll.js') ?>"></script>
    <script src="<?php echo base_url('content/app.min.js') ?>"></script>
    <script src="<?php echo base_url('content/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('content/fastclick.min.js') ?>"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    
    <header class="main-header">
        <?php $this->load->view($header); ?>
    </header>

    <aside class="main-sidebar">
    <?php $this->load->view($sidebar); ?>
    </aside>

    <div class="content-wrapper">
    <section class="content">
    <?php $this->load->view($content); ?>
    </section>  
    </div>
    </div><!-- ./wrapper -->
</body>
</html>