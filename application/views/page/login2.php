<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Selamat datang IFN-SYSTEM V3</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?= base_url().'assets/images/favicon.png' ?>">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url().'assets/plugins/bootstrapX/dist/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url().'assets/plugins/font-awesome/css/font-awesome.min.css' ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url().'assets/plugins/Ionicons/css/ionicons.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url().'assets/css/AdminLTE.min.css' ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url().'assets/plugins/iCheck/square/blue.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/mystyle.css' ?>"> 
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-color: white;">
<div class="login-box" style="background-color: #DC2422; box-shadow: 5px 5px 25px; ">
  <div class="login-logo" style="padding-top: 15px;">
    <a href="<?= base_url() ?>" style="color: white !important;"><b>IFN</b> System</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p><?php echo $this->session->flashdata('msg');?></p>
    <p class="login-box-msg">Sign In untuk Memulai Aplikasi</p>

    <form action="<?= $formAction ?>" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="pass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <hr>
    <div style="text-align: center;">
      <img src="<?= base_url().'assets/images/latarcoba.png' ?>" style="width: 75px; height: auto; padding-bottom: 15px;">
      <p style="font-size: 12px;">powered with <span class="glyphicon glyphicon-heart fa-beat text-red"></span> by Bootstrap 2.3.5</p>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="<?= base_url().'assets/plugins/jquery/jquery-3.3.1.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/bootstrap/js/bootstrap.min.js' ?>"></script>  
<!-- iCheck -->
<script src="<?= base_url().'assets/plugins/iCheck/icheck.min.js' ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
