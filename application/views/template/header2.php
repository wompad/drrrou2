<?php

    session_start();

    if(!isset($_SESSION['username'])){

      header("Location: /drrrou2/login");

    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DSWD DRMD | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/css/jquery-te-1.4.0.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="<?php echo base_url();?>vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url();?>vendors/datatables.net-bs/css/dataTables.bootstrap.css">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>build/css/custom.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/autocomplete.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/select.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/jquery-confirm.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/js/monthpicker/MonthPicker.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/js/Chosen/docsupport/prism.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/js/Chosen/chosen.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/js/leaflet/leaflet.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/contextmenu.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/introjs/introjs.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/autocomplete/jquery.auto-complete.css" rel="stylesheet">

    <link href="<?php echo base_url();?>images/dromic.png" rel="icon" type="image/png"/>

    <style>
      .btn {
        border-radius: 0px;
      }
      .modal-content {
        border-radius: 0px;
      }
      .ui-autocomplete { z-index:2147483647; }
      #map {
        height: 100%;
        width:100%;
      }
      .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
      }

      .switch input {display:none;}

      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }

      .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }

      input:checked + .slider {
        background-color: #2196F3;
      }

      input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      /* Rounded sliders */
      .slider.round {
        border-radius: 34px;
      }

      .slider.round:before {
        border-radius: 50%;
      }
      .legends {
        padding: 10px;
        border-radius: 5px;
        position: absolute;
        right: 20px;
        top: 10px;
        background-color: white;
        width:350px;
        z-index:10000;
        font-size:15px
      }
      .loader {
        border: 9px solid #f3f3f3;
        border-radius: 50%;
        border-top: 9px solid #3498db;
        width: 45px;
        height: 45px;
        -webkit-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
      }

      @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      a.tabpill:hover{
        color: #000;
        background-color: #fff !important;
      }

      a.tabpill2:hover{
        color: #000 !important;
        background-color: #fff !important;
      }

      a.tabpill:focus{
        color: #000 !important;
        background-color: #fff !important;
      }

      .rightclickmenu:hover {
        color: #000 !important;
        background-color: #fff !important;
      }

      .custom-menu {
          display: none;
          z-index: 1000;
          position: absolute;
          overflow: hidden;
          border: 1px solid #CCC;
          white-space: nowrap;
          font-family: sans-serif;
          background: #FFF;
          color: #333;
          border-radius: 5px;
      }

      .custom-menu li {
          padding: 8px 12px;
          cursor: pointer;
      }

      .custom-menu li:hover {
          background-color: #DEF;
      }

      .hoveredit:hover{
        background-color: yellow;
        font-weight:bold;
        cursor:pointer;
      }

      .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
      }

      .inputfile + label {
          font-size: 1.25em;
          font-weight: 700;
          color: white;
          background-color: black;
          display: inline-block;
      }

      .inputfile:focus + label,
      .inputfile + label:hover {
          background-color: red;
      }

      .inputfile + label {
        cursor: pointer; /* "hand" cursor */
      }

      .info {
          padding: 6px 8px;
          font: 14px/16px Arial, Helvetica, sans-serif;
          background: white;
          background: rgba(255,255,255,0.8);
          box-shadow: 0 0 15px rgba(0,0,0,0.2);
          border-radius: 5px;
          background-color: #272822;
          color: #fff;
      }
      .info h4 {
          margin: 0 0 5px;
          color: #fff;
      }

      .legend {
          line-height: 18px;
          color: #555;
          border: 1px solid gray;
          padding: 10px;
          border-radius: 5px;
          font-size:15px;
          text-align:left;
          background-color: #272822;
          color: #fff;
      }
      .legend i {
          width: 18px;
          height: 18px;
          float: left;
          margin-right: 8px;
          opacity: 0.7;
          text-align:left;
      }

      .tbl_masterquery_revs td {
        font-size: 10px;
      }

      #items{
        list-style:none;
        margin:0px;
        margin-top:2px;
        font-size:13px;
        color: #333333;
        padding: 10px;
      }
      #items :hover{
        background-color: #284570;
        color: #fff;
        border-radius: 3px;
        cursor: pointer;
      }
      #cntnr{
        display:none;
        position:absolute;
        border:1px solid #B2B2B2;
        width:auto;      
        background:#F9F9F9;
        box-shadow: 3px 3px 2px #E9E9E9;
        border-radius:4px;
      }

      .ui-dialog-titlebar {
        background-color: #394D5F;
        color: #fff;
      }

      .introjs-tooltip {
          min-width: 800px; // change to desired
          max-width: 800px; // change to desired
      }

    </style>

    <!-- jQuery -->
  <script src="<?php echo base_url();?>vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>

  <script src="<?php echo base_url();?>assets/js/dynamics.js"></script>

  </head>

	<body class="nav-md" style="background-color: #fff">

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0; margin-top:5px">
              <a href="" class="site_title"><img src="<?php echo base_url();?>images/dreamblogoweb.png" style="width:50px; height:50px;" class="img img-circle"> <span style="font-size:15px">DSWD DRMD</span></a>
            </div>

            <div class="clearfix"></div>
            <label id="usernameid" style="display :none"><?= $_SESSION['username']?></label>
            <label id="user_level_access_session" style="display :none"><?= $_SESSION['user_level_access']?></label>
            <label id="provinceid_session" style="display :none"><?= $_SESSION['provinceid']?></label>
            <label id="municipality_id_session" style="display :none"><?= $_SESSION['municipality_id']?></label>
            <label id="region_name_session" style="display :none"><?= $_SESSION['region_name']?></label>
            <label id="region_id_session" style="display :none"><?= $_SESSION['regionid']?></label>
            <label id="xcoordinates" style="display :none"><?= $_SESSION['xcoordinates']?></label>
            <label id="ycoordinates" style="display :none"><?= $_SESSION['ycoordinates']?></label>
            <label id="region_id_session" style="display :none"><?= $_SESSION['regionid']?></label>
            <label id="can_edit" style="display :none"></label>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li class="active"><a href="<?php echo base_url(); ?>dashboard"> <i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-chevron-right"></span></a></li>
                </ul>
                <ul class="nav side-menu">
                  <li class="active"><a href="javascript:void(0);" onclick="javascript:introJs().start();"> <i class="fa fa-car"></i> Tutorial/Getting Started <span class="fa fa-chevron-right"></span></a></li>
                </ul>
                <ul class="nav side-menu" id="panelmenu">
                  <?php 
                      if($_SESSION['isadmin'] == "reports"){?>
                      <li class='active'><a><i class='fa fa-th'></i> Reports <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu' style='display:block'>
                          <li><a href='<?php echo base_url(); ?>congressional'>Congressional Report</a></li>
                          <li><a href='<?php echo base_url(); ?>reliefassistance'>Augmentation Assistance Report</a></li>
                        </ul>
                      </li>
                  <?php }else{ ?>
                  <li class="active"><a><i class="fa fa-table"></i> Operation Center<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display:block">
                      <?php if($_SESSION['can_create_report'] == 't'){ ?> <li><a href="<?php echo base_url(); ?>dromic_new">Add New | View DROMIC Report</a></li> <?php } ?>
                      <?php if($_SESSION['regionid'] == '160000000' && $_SESSION['issuperadmin'] == "t" && ($_SESSION['user_level_access'] == "region")) { ?>
                        <!-- <li><a href="<?php echo base_url(); ?>eopcen">Virtual OpCen <span class="badge" style="background-color:#D9534F" id="counteopcen"> </span> </a></li>
                        <li><a href="<?php echo base_url(); ?>inbox2">Messages (Inbox) </a></li> -->
                      <?php } ?>
                      <li><a href="<?php echo base_url(); ?>weatherimage">Latest Weather Forecast</a></li>
                      <li><a href="<?php echo base_url(); ?>weatherradar">Weather Radar Image</a></li>
                      <!-- <li><a href="<?php echo base_url(); ?>earthquake">Earthquake Bulletin</a></li> -->
                    </ul>
                  </li>
                  <?php 
                      if($_SESSION['regionid'] == "160000000" && $_SESSION['issuperadmin'] == "t" && ($_SESSION['user_level_access'] == "region")){?>
                        <!-- <li class="active"><a><i class="fa fa-phone"></i> My Contact List <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display:block">
                            <li><a href="<?php echo base_url(); ?>home">C/MSWDO Contacts</a></li>
                            <li><a href="<?php echo base_url(); ?>cmatleaders">CMAT/PAT Contacts</a></li>
                          </ul>
                        </li> -->
                     <?php } ?>
                  <?php 
                      if($_SESSION['issuperadmin'] == "t" && $_SESSION['regionid'] == "160000000" && ($_SESSION['user_level_access'] == "region")){?>
                  <!-- <li class="active"><a><i class="fa fa-map-o"></i> Web Map Application <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display:block">
                      <li><a href="<?php echo base_url(); ?>webmap">View Map</a></li>
                    </ul>
                  </li> -->
                  <li class='active'><a><i class='fa fa-th'></i> Reports <span class='fa fa-chevron-down'></span></a>
                    <ul class='nav child_menu' style='display:block'>
                      <li><a href='<?php echo base_url(); ?>addreliefassistance'>Add Relief Assistance</a></li>
                      <li><a href='<?php echo base_url(); ?>reliefassistance'>Augmentation Assistance Report</a></li>
                      <li><a href='<?php echo base_url(); ?>congressional'>Congressional Report</a></li>
                    </ul>
                  </li>
                  <!-- <li class='active'><a><i class='fa fa-users'></i> User Management <span class='fa fa-chevron-down'></span></a>
                    <ul class='nav child_menu' style='display:block'>
                      <li><a href='<?php echo base_url(); ?>qrt_teams'>QRT Teams</a></li>
                    </ul>
                  </li> -->
                  <?php } } ?>
                  <li class='active'><a><i class='fa fa-users'></i> Tools <span class='fa fa-chevron-down'></span></a>
                    <ul class='nav child_menu' style='display:block'>
                      <?php 
                      if($_SESSION['regionid'] == "160000000" && $_SESSION['issuperadmin'] == "t" && ($_SESSION['user_level_access'] == "region")){?>
                      <!-- <li><a href='<?php echo base_url(); ?>mobile_user_activation'>Activate Mobile Users</a></li> -->
                      <?php } ?>
                      <?php 
                      if($_SESSION['issuperadmin'] == "t"){?>
                      <li><a href='<?php echo base_url(); ?>activate_webusers'>Activate Web Users</a></li>
                      <?php } ?>
                      <?php 
                      if($_SESSION['can_create_report'] == "t"){?> <li><a href='<?php echo base_url(); ?>reportsmanagement'>Reports Management</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                  <!-- <li class="active"><a><i class="fa fa-envelope"></i> My Messages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display:block">
                      <li><a href="<?php echo base_url(); ?>send_sms">Send Message</a></li>
                    </ul>
                  </li>  -->
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu" style="background-color:#304456; color:#fff; padding:0px; height:40px; border-left:3px solid #fff">
            <nav>
              <div class="nav toggle" style="margin-top:-10px;">
                <a id="menu_toggle"><i class="fa fa-bars" style="color:#fff"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right" style="margin-top:-10px;">
                <li style="height:50px">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="height:50px">
                    <span class="fa fa-user" style="color:#fff"></span> <span style="color:#fff; text-transform:capitalize"><?php echo $_SESSION['fullname'] ?></span>
                    <span class=" fa fa-angle-down" style="color:#fff"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    <!-- <li><a href="<?php echo base_url(); ?>changepassword"><i class="fa fa-key pull-right"></i> Change Password</a></li> -->
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="right_col" role="main" style="background-color: #fff">
      