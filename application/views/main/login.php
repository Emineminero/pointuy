<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Hotel Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url(); ?>assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">
	<div class="container">
		<form class="form-signin" method="POST" action="<?php echo site_url('MainController/login'); ?>">
			<?php
				if ($this->session->flashdata('errors'))
		  		{
		  			echo '<div class="alert alert-warning fade in">';
                    echo '<button data-dismiss="alert" class="close close-sm" type="button">';
                    echo '<i class="icon-remove"></i>';
                    echo '</button>';
                    echo '<strong>'.$this->session->flashdata('errors').'</strong>';
                    echo '</div>';
                }
            ?>
            <h2 class="form-signin-heading">HMS</h2>
            <div class="login-wrap">
            	<input type="text" class="form-control" name="user_name" placeholder="User ID" autofocus>
            	<input type="password" class="form-control" name="password" placeholder="Password">
            	<button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
        	</div>
      	</form>
    </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

</body>
</html>
