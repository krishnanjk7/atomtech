<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ionicons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker/bootstrap-datepicker.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font_load.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/chosen.css"/>	
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/datatable.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css"/>
  
	<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/fastclick/fastclick.js"></script>
	<script src="<?php echo base_url();?>assets/js/adminlte.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/pages/dashboard.js"></script>
	<script src="<?php echo base_url();?>assets/js/demo.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
	<script src="<?php echo base_url();?>assets/js/chosen.jquery.js"></script> 
	<script src="<?php echo base_url();?>assets/js/datatable.js"></script> 
	<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script> 
	<script src="<?php echo base_url();?>assets/js/buttons.flash.min.js"></script> 
	<script src="<?php echo base_url();?>assets/js/jszip.min.js"></script> 
	<script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script> 
	<script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script> 
	<script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script> 
	<script src="<?php echo base_url();?>assets/js/buttons.print.min.js"></script> 
	
	<script>
		$.validator.setDefaults({ ignore: ":hidden:not(select)" });
	</script>
	
	
	<style>
		body{
			font-family:Montserrat-Light;
		}
		.content-wrapper .content-header h1{
			font-family:Montserrat-Light;
			font-weight:500;
		}
		.logo-lg,.logo-mini,.user-panel .info p{
			font-family:Montserrat-Light;
			font-weight:500;
		}
		.box-primary a input{
			background-color:#75053f;
			border: 1px solid #ecf1f1;
			border-radius: 4px;
		}
		input[type=search]{
			color:red;
		}
	</style>
	
	
  </head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" style="background-color:white">

  <header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><b>A</b>T</span>
      <span class="logo-lg"><b>ATOM TECH</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                 <?php echo $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name;?> - <?php echo $this->ion_auth->user()->row()->company;?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url(); ?>index.php/auth/edit_user/<?php echo $this->ion_auth->user()->row()->id;?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>index.php/auth/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  
  <div class="content-wrapper" style="margin-left:0px;">
