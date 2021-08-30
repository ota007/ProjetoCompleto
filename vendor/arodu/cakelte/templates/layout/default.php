<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?= strip_tags($this->settings['appName']) . ' | ' . $this->fetch('title') ?></title>

  <?= $this->Html->meta('icon') ?>
  <?= $this->fetch('meta') ?>

  <!-- Font Awesome Icons -->
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>
  <!-- icheck bootstrap -->
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>
  <!-- Theme style -->
  <?= $this->Html->css('CakeLte./AdminLTE/dist/css/adminlte.min.css') ?>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <?= $this->Html->css('CakeLte.style') ?>

  <?= $this->element('layout/css') ?>

  <?= $this->fetch('css') ?>

  <style>

.main-header{
  background-color: #6AA4B0 ;
}

.main-sidebar{
  background-color: #6AA4B0 ;
}

.content-header{
  background-color:  #2F6D80 ;
}

.content{
  background-color: #2F6D80 ;
}

.main-footer{
  background-color:  #6AA4B0 ;
}
a {
  color: #E1E7E0;
}


</style>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-info">
      <?= $this->element('header/main') ?>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-secondary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= $this->Url->build('/') ?>" class="brand-link">
        <?= $this->Html->image($this->settings['appLogo'], ['alt' => $this->settings['appName'] . ' logo', 'class' => 'brand-image']) ?>
        <span class="brand-text font-weight-light"><?= $this->settings['appName'] ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar text-info">
        <?= $this->element('sidebar/main') ?>
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <?= $this->element('content/header') ?>
        </div><!-- /.container-fluid -->
      </div>

      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid" style="min-height: 100vh;">
          <?= $this->Flash->render() ?>
          <?= $this->fetch('content') ?>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <?= $this->element('aside/main') ?>
    </aside>
    <!-- /.control-sidebar -->


  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/jquery/jquery.min.js') ?>
  <!-- Bootstrap 4 -->
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>
  <!-- AdminLTE App -->
  <?= $this->Html->script('CakeLte./AdminLTE/dist/js/adminlte.min.js') ?>

  <?= $this->element('layout/script') ?>

  <?= $this->fetch('script') ?>
</body>

</html>
