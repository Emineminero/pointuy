<?php
	if (empty($this->session->userdata['user_name']))
	{
		header("location:".site_url('MainController')."");
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico');?>">

    <title>Hotel Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/hmsCSS/select2/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.css" type="text/css">
   <!-- <link rel="stylesheet" type="text/css" href="<?php// echo base_url(); ?>assets/assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php //echo base_url(); ?>assets/assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php //echo base_url(); ?>assets/assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php //echo base_url(); ?>assets/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="<?php //echo base_url(); ?>assets/assets/bootstrap-datetimepicker/css/datetimepicker.css" />-->
    
    
 
   
 

    <link href="<?php echo base_url(); ?>assets/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet" />


        <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet" />

    <link href="<?php echo base_url(); ?>assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet" />


    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/hmsCSS/generalCSS.css"></script>
	
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
		.country_dropdown, .country_dropdown_2{
			z-index: 999999999999;
			position: absolute;
			background-color: #fff;
			height: auto;
			max-width: 400px;
			width: 100%;
		}

		.country_dropdown li:hover, .country_dropdown_2 li:hover{
			background-color: #7e7c7c;
			color: #fff;
			padding: 5px 5px;
		}
    </style>

  </head>

  <body>
<input type="hidden" name="sitebaseurl" id="sitebaseurl" value="<?php echo base_url().index_page(); ?>" />
  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <!--<a href="index.html" class="logo">Flat<span>lab</span></a>-->
            <a href="<?php echo base_url(); ?>/index.php/user/UserController" class="logo">Hotel <span>Management</span> System</a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                           </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="<?php echo base_url('assets/img/avatar1_small.jpg');?>">
                            <span class="username">Welcome <b><?php echo ucfirst($this->session->userdata['user_name']); ?></b></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a  href="<?php echo site_url('MainController/logout') ?>"><i class="icon-key"></i> Log Out</a></li>
                              <div class="log-arrow-up"></div>
                            <li><a  href="<?php echo site_url('MainController/logout') ?>"><i class="icon-key"></i>Creation of employee profile</a></li>
                        </ul>
                        
                         
                       
                    </li>

                   
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="<?php echo base_url(); ?>index.php/user/UserController">
                          <i class="icon-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <?php
				  // echo"<pre>";
				  // print_r($this->session->userdata['hotel_id']);
				  // exit;
				  if($this->session->userdata['isSuperAdmin'] == 1) { ?>
					   <li class="sub-menu">
						  <a href="javascript:;" >
							  <i class="icon-home"></i>
							  <span>Hotels</span>
						  </a>
						  <ul class="sub">
							  <li><a  href="<?php echo base_url(); ?>hotels/HotelsController/add_hotel">Add hotel</a></li>
							  <li><a  href="<?php echo base_url(); ?>hotels/HotelsController">View hotel</a></li>
						  </ul>
					  </li>
					  <li class="sub-menu">
						  <a href="javascript:;" >
							  <i class="icon-user-md"></i>
							  <span>Users</span>
						  </a>
						  <ul class="sub">
							  <li><a  href="<?php echo base_url(); ?>user/UserController/add_user">Add user</a></li>
							  <li><a  href="<?php echo base_url(); ?>/user/UserController">View user</a></li>
						  </ul>
					  </li>
					  
					  <li class="sub-menu">
						  <a href="javascript:;" >
							  <i class="icon-group"></i>
							  <span>Groups</span>
						  </a>
						  <ul class="sub">
							  <li><a  href="<?php echo base_url(); ?>group/GroupController/add_group">Add group</a></li>
							  <li><a  href="<?php echo base_url(); ?>group/GroupController/">View group</a></li>
						  </ul>
					  </li>
					  
				  <?php } else{
                  		$this->session->userdata['user_name'];
				  if(!empty($this->session->userdata['permissions']))
				  {
				  		$permissions = $this->session->userdata['permissions'];
				  		$user_permssions = !empty($this->session->userdata['group_perms']) ? explode(",", $this->session->userdata['group_perms']) : array();
						// $permissions = array_diff($permissions, array(3));
						// unset($permissions[array_search(3, $permissions)]);
						// echo"<pre>";
						// print_r($permissions);
						// exit;
				  		foreach($permissions as $perm)
				  		{
				  			if($perm["id"] != 9){
				  			if(in_array($perm["id"], $user_permssions)){
				  				$title = !empty($perm["title"]) ? $perm["title"] : "";
				  				//if($title == "group" && $this->session->userdata['role'] != "Admin") continue;
								$icon = !empty($perm["icon"]) ? $perm["icon"] : "";
								$add_url = !empty($perm["add_link"]) ? $perm["add_link"] : "";
								$view_url = !empty($perm["view_link"]) ? $perm["view_link"] : "";
				  ?>
				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="<?php  echo $icon; ?>"></i>
                          <span><?php echo $title.'s'; ?></span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo site_url($add_url); ?>">Add <?php echo $title; ?></a></li>
                          <li><a  href="<?php echo site_url($view_url); ?>">View <?php echo $title; ?></a></li>

                      </ul>
                  </li>
				  <?php
							}
							}
				  		}
				  }
                  ?>
				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-file-text"></i>
                          <span><?php echo 'Reports'; ?></span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url(); ?>employee/EmployeeController/view_reports">View <?php echo 'Reports'; ?></a></li>
                      </ul>
                  </li>
				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-wrench"></i>
                          <span><?php echo 'Maintenance'; ?></span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url(); ?>maintenance/MaintenanceController/add_task">Add <?php echo 'Task'; ?></a></li>
                          <li><a  href="<?php echo base_url(); ?>maintenance/MaintenanceController/view_task">View <?php echo 'Tasks'; ?></a></li>
                      </ul>
                  </li>
				  <?php }?>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
