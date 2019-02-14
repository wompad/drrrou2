<?php

    session_start();

    if(isset($_SESSION['username'])){
    ?>
        <script>
          window.location.href = window.location.protocol + "//" + document.location.host + "/drrrou2/login";
        </script>
    <?php }

?>

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
              <h1>Login Form</h1>
              <div class='alert alert-danger' style="padding:8px; font-weight:lighter; font-size:12px" id="alertrequired">
                <span class="close" style='font-size:15px' id="closealert">&times</span>
                <span id="alertrequiredmsg">
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Username"  name="username" id="username"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password"  id="password" />
              </div>
              <div>
                <button type="button" class="btn form-control btn-success" id="btnlogin">Log in</button>
              </div>

              <div>
                <button type="button" class="btn form-control btn-warning" id="btnsignup">Don't have an account? <u>Sign up</u></button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="<?php echo base_url();?>images/dreamblogoweb.png" style="width:45px; height:40px"> DSWD DRMD - Caraga</h1>
                  <h5>Contact DSWD Caraga: 342-5619 local 238</h5>
                  <h5>Email Address: drrroufocaraga@gmail.com</h5>
                  <p>Copyright ©<?= date("Y") ?> DSWD DRMD - Caraga. All Rights Reserved. Privacy Policy.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>

      <div class="login_wrapper" id="signup_wrapper" style="margin-top:0px">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="formsignup">
              <h1>Singup Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="* Firstname" id="firstname"/>
              </div>
              <div class="form-signup">
                <input type="text" class="form-control" placeholder="Middlename" id="middlename"/>
              </div>
              <div class="form-signup">
                <input type="text" class="form-control" placeholder="* Lastname" id="lastname"/>
              </div>
              <div class="form-group form-signup">
                <select class="form-control" id="region">
                  <option value="">-- Select Region --</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" id="province">
                  <option value="">-- Select Province --</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" id="municipality">
                  <option value="">-- Select City/Municipality --</option>
                </select>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="* Address" id="address"/>
              </div>
              <div class="form-signup">
                <input type="text" class="form-control" placeholder="* Agency" id="agency"/>
              </div>
              <div class="form-signup">
                <input type="text" class="form-control" placeholder="* Position/Designation" id="position"/>
              </div>
              <div class="form-signup">
                <input type="text" class="form-control" placeholder="* Email Address" id="emailaddress"/>
              </div>
              <div class="form-signup">
                <input type="text" class="form-control" placeholder="* Mobile #" id="mobile"/>
              </div>
              <div class="form-signup">
                <input type="text" class="form-control" placeholder="* Username" id="xusername"/>
              </div>
              <div class="form-signup">
                <input type="password" class="form-control" placeholder="* Password" id="xpassword"/>
              </div>
              <div class="form-signup">
                <input type="password" class="form-control" placeholder="* Confirm Password" id="xcpassword"/>
              </div>
              <div>
                <button type="button" class="btn form-control btn-success" id="signup">Signup</button>
              </div>
              <div>
                <button type="button" class="btn form-control btn-warning" id="backlogin">Back to Login Form</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="<?php echo base_url();?>images/dreamblogoweb.png" style="width:40px; height:40px"> DSWD DRMD - Caraga</h1>
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

      get_region();

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

      $('#username,#password').keydown(function(e){
          if(e.keyCode == 13){
            $('#btnlogin').trigger("click");
          }
      });

      $('#btnlogin').click(function(){

          var datas = {
            username  : $('#username').val(),
            password  : $('#password').val()
          }

          if(datas.username == "" || datas.password == ""){
            message("Username and password are required!");
          }else{
            $.getJSON(serverip+"login?callback=?",datas,function(a){
              if(a == 0){

               // message("")
               msgbox("Username and password not recognized, or your account has not been activated. Kindly contact the administrator.");

              }else{
                window.location.href = base_url+"dashboard";
              }
            })
          }

      })

      $('#signup_wrapper').hide();

      $('#btnsignup').click(function(){

        $('#login_wrapper').hide();
        $('#signup_wrapper').show();

      })

      $('#backlogin').click(function(){

        $('#login_wrapper').show();
        $('#signup_wrapper').hide();

      })

      function get_region(){

        $('#region').empty();
        $('#region').append(
            "<option value=''>-- Select Region --</option>"
        );  

        $.getJSON(serverip+"get_region",function(a){  

            for(var i in a){
              $('#region').append(
                  "<option value='"+a[i].id+"'>"+a[i].region_name+"</option>"
              )

            }

        });

      }

      $('#region').change(function(){

        $('#province').empty();
        $('#province').append(
            "<option value=''>-- Select Province --</option>"
        );  

        var datas = {

          id : $(this).val()

       }

        $.getJSON(serverip+"get_province_per_region",datas,function(a){  

            console.log(a);

            for(var i in a){
              $('#province').append(
                  "<option value='"+a[i].id+"'>"+a[i].province_name+"</option>"
              )

            }

        });

      })

      $('#province').change(function(){

        var pid = $('#province').val(); 

        $('#municipality').empty();
        $('#municipality').append(
            "<option value=''>-- Select City/Municipality --</option>"
        );

        $.getJSON(serverip+"get_municipality_per_region",function(a){  
            for(var i in a){
              if(pid == a[i].provinceid){
                $('#municipality').append(
                    "<option value='"+a[i].id+"'>"+a[i].municipality_name+"</option>"
                )
              }
            }
        });

      })

      $('#signup').click(function(){



        var datas = {
          data : {
            firstname       : $('#firstname').val(),
            middlename      : $('#middlename').val(),
            lastname        : $('#lastname').val(),
            regionid        : $('#region').val(),
            provinceid      : $('#province').val(),
            municipality_id : $('#municipality').val(),
            address         : $('#address').val(),
            agency          : $('#agency').val(),
            position        : $('#position').val(),
            emailaddress    : $('#emailaddress').val(),
            mobile          : $('#mobile').val(),
            username        : $('#xusername').val(),
            password        : $('#xpassword').val()
          }
        }

        if($('#region').val() == "" || $('#province').val() == "" || $('#municipality').val() == ""){

            msgbox("Kindly fill province and municipality to continue!");

        }else{

          if($('#firstname').val() == "" || $('#lastname').val() == "" || $('#address').val() == "" || $('#address').val() == "" || $('#agency').val() == "" || $('#position').val() == "" || $('#emailaddress').val() == "" || $('#mobile').val() == "" || $('#xusername').val() == "" || $('#xpassword').val() == "" || $('#xcpassword').val() == ""){

            msgbox("Fields with asterisk are required!");

          }else{

            if($('#xpassword').val() != $('#xcpassword').val()){

              msgbox("Password and confirm password does not match!");

            }else{

              $.getJSON(serverip+"signup_user",datas,function(a){  
                  if(a == 1){

                    msgboxsuccess("User account successfully created. Wait for the administrator to activate your account before logging in. Thanks!");

                    $('#firstname').val("");
                    $('#middlename').val("");
                    $('#lastname').val("");
                    $('#province').val("");
                    $('#municipality').val("");
                    $('#address').val("");
                    $('#agency').val("");
                    $('#position').val("");
                    $('#emailaddress').val("");
                    $('#mobile').val("");
                    $('#xusername').val("");
                    $('#xpassword').val("");
                    $('#xcpassword').val("");

                  }else if(a == 2){

                    msgbox("Username already exist!");

                  }else{

                    msgbox("Ooops! Something went wrong while trying to save your account.");

                  }
              });

            }

          }

        }


      })

      </script>

  </body>
</html>
