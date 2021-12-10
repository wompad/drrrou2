<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DSWD DRMD | </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link rel="stylesheet" href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link rel="stylesheet" href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link rel="stylesheet" href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link rel="stylesheet" href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="vendors/datatables.net-bs/css/dataTables.bootstrap.css">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <link href="assets/css/jquery-ui.css" rel="stylesheet">

    <link href="assets/css/autocomplete.css" rel="stylesheet">

    <link href="assets/css/jquery-confirm.css" rel="stylesheet">

    <link href="images/dromic.png" rel="icon" type="image/png"/>

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
      .form-signup {
        margin-top:-10px;
      }
    </style>

  </head>


  <body class="login">
      <div class="login_wrapper" id="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="formlogin">
              <h1>Change Password</h1>
              <div class='alert alert-danger' style="padding:8px; font-weight:lighter; font-size:12px" id="alertrequired">
                <span class="close" style='font-size:15px' id="closealert">&times</span>
                <span id="alertrequiredmsg">
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Email Address"  name="email_address" id="email_address"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="New Password"  name="newpassword" id="newpassword"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Confirm New Password"  name="newcpassword" id="newcpassword"/>
              </div>
              <div>
                <button type="button" class="btn form-control btn-warning" id="btnsave">Submit and Save</button>
              </div>
              
              <div class="pull-right">
                <label><a href="<?php echo base_url(); ?>login">Back to Login</a></label>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="<?php echo base_url();?>images/dreamblogoweb.png" style="width:45px; height:40px"> DSWD DRMD - Caraga</h1>
                  <h5>Contact DSWD Caraga: 342-5619 local 238</h5>
                  <h5>Email Address: drmd.focrg@dswd.gov.ph</h5>
                  <p>Copyright ©<?= date("Y") ?> DSWD DRMD - Caraga. All Rights Reserved. Privacy Policy.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
        <!-- jQuery -->
      <script src="vendors/jquery/dist/jquery.min.js"></script>
      <script src="assets/js/ip.js"></script>
      <!-- Bootstrap -->
      <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="vendors/nprogress/nprogress.js"></script>
      <!-- Chart.js -->
      <script src="vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- gauge.js -->
      <script src="vendors/gauge.js/dist/gauge.min.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="vendors/iCheck/icheck.min.js"></script>
      <!-- Skycons -->
      <script src="vendors/skycons/skycons.js"></script>
      <!-- Flot -->
      <script src="vendors/Flot/jquery.flot.js"></script>
      <script src="vendors/Flot/jquery.flot.pie.js"></script>
      <script src="vendors/Flot/jquery.flot.time.js"></script>
      <script src="vendors/Flot/jquery.flot.stack.js"></script>
      <script src="vendors/Flot/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
      <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
      <script src="vendors/flot.curvedlines/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="vendors/DateJS/build/date.js"></script>
      <!-- JQVMap -->
      <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
      <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="vendors/moment/min/moment.min.js"></script>
      <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

      <script src="vendors/datatables.net/js/jquery.dataTables.js"></script>
      <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.js"></script>

      <script src="assets/js/jquery-ui.js"></script>
      <script src="assets/js/jquery-confirm.js"></script>
      <script src="build/js/custom.min.js"></script>
      <script>

      function msgbox(message){
        $.confirm({
            title: 'Warning!',
            content: message,
            buttons: {
              confirmAction: {
                text: '<i class="fa fa-check"></i> Okay',
                btnClass: 'btn-danger',
              }
            }
        });
      }

      function msgboxsuccess(message){
        $.confirm({
            title: 'Success!',
            content: message,
            buttons: {
              confirmAction: {
                text: '<i class="fa fa-check"></i> Okay',
                btnClass: 'btn-success',
              }
            }
        });
      }

      var message = function(msg){
        $('#alertrequiredmsg').empty().append("<span class='fa fa-info-circle'></span> "+msg)
        $('#alertrequired').slideDown();
        setTimeout(function(){
          $('#alertrequired').slideUp();
        },5000)
      }

      $('#alertrequired').hide();

      $('#closealert').click(function(){
        $('#alertrequired').slideUp();
      })

      $('#newpassword,#newcpassword,#email_address').keydown(function(e){
          if(e.keyCode == 13){
            $('#btnsave').trigger("click");
          }
      });

      $('#btnsave').click(function(){

          var datas = {
            email_address  : $('#email_address').val(),
            newpassword    : $('#newpassword').val()
          }

          if(datas.email_address == "" || datas.newpassword == "" || $('#newcpassword').val() == ""){
            message("Email and password are required!"); 
          }else{
            if($('#newcpassword').val() != $('#newpassword').val()){
              message("Password and confirm password dows not match!");
            }else{
              $.getJSON(serverip+"login?callback=?",datas,function(a){
                if(a == 0){
                 msgbox("Username and password not recognized, or your account has not been activated. Kindly contact the administrator.");
                }else{
                  window.location.href = base_url+"dashboard";
                }
              })
            }
          }

      })


      </script>

  </body>
</html>
