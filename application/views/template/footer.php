
<script src="<?php echo base_url();?>assets/js/ip.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url();?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo base_url();?>vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?php echo base_url();?>vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?php echo base_url();?>vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo base_url();?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?php echo base_url();?>vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?php echo base_url();?>vendors/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url();?>vendors/Flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url();?>vendors/Flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url();?>vendors/Flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url();?>vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?php echo base_url();?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo base_url();?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?php echo base_url();?>vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?php echo base_url();?>vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url();?>vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="<?php echo base_url();?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo base_url();?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url();?>vendors/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url();?>vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="<?php echo base_url();?>vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="<?php echo base_url();?>vendors/google-code-prettify/src/prettify.js"></script>

<script src="<?php echo base_url();?>vendors/datatables.net/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>vendors/datatables.net-bs/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-confirm.js"></script>
<script src="<?php echo base_url();?>assets/js/tabletoexcel.js"></script>
<script src="<?php echo base_url();?>assets/js/mask.js"></script>

<script src="<?php echo base_url();?>assets/js/Highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/Highcharts/highcharts-3d.js"></script>
<script src="<?php echo base_url();?>assets/js/Highcharts/modules/data.js"></script>
<script src="<?php echo base_url();?>assets/js/Highcharts/modules/drilldown.js"></script>
<script src="<?php echo base_url();?>assets/js/Highcharts/exporting.js"></script>

<script src="<?php echo base_url();?>assets/js/monthpicker/MonthPicker.min.js"></script>
<script src="<?php echo base_url();?>assets/js/Chosen/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/Chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>assets/js/Chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>assets/js/Hotkeys/jquery.hotkeys.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>assets/js/select.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo base_url();?>assets/js/leaflet/leaflet.js"></script>

<script src="<?php echo base_url();?>assets/js/contextmenu2.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo base_url();?>assets/js/contextmenu.js" type="text/javascript" charset="utf-8"></script>



<script src="<?php echo base_url();?>assets/autocomplete/jquery.auto-complete.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo base_url();?>assets/introjs/introjs.js"></script>

<script src="<?php echo base_url();?>assets/js/custom_user.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo base_url();?>build/js/custom.min.js"></script>

<script>

var tbl_masterquery = $('#tbl_masterquery_revs');

if(tbl_masterquery.length){
    function domo(){
        jQuery('#platform-details').html('<code>' + navigator.userAgent + '</code>');
        
        var elements = [
            // "esc","tab","space","return","backspace","scroll","capslock","numlock","insert","home","del","end","pageup","pagedown",
            // "left","up","right","down",
            // "f1","f2","f3","f4","f5","f6","f7","f8","f9","f10","f11","f12",
            // "1","2","3","4","5","6","7","8","9","0",
            // "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
            // "Ctrl+a","Ctrl+b","Ctrl+c","Ctrl+d","Ctrl+e","Ctrl+f","Ctrl+g","Ctrl+h","Ctrl+i","Ctrl+j","Ctrl+k","Ctrl+l","Ctrl+m",
            // "Ctrl+n","Ctrl+o","Ctrl+p","Ctrl+q","Ctrl+r","Ctrl+s","Ctrl+t","Ctrl+u","Ctrl+v","Ctrl+w","Ctrl+x","Ctrl+y","Ctrl+z",
            // "Shift+a","Shift+b","Shift+c","Shift+d","Shift+e","Shift+f","Shift+g","Shift+h","Shift+i","Shift+j","Shift+k","Shift+l",
            // "Shift+m","Shift+n","Shift+o","Shift+p","Shift+q","Shift+r","Shift+s","Shift+t","Shift+u","Shift+v","Shift+w","Shift+x",
            // "Shift+y","Shift+z",
            // "Alt+a","Alt+b","Alt+c","Alt+d","Alt+e","Alt+f","Alt+g","Alt+h","Alt+i","Alt+j","Alt+k","Alt+l",
            // "Alt+m","Alt+n","Alt+o","Alt+p","Alt+q","Alt+r","Alt+s","Alt+t","Alt+u","Alt+v","Alt+w","Alt+x","Alt+y","Alt+z",
            // "Ctrl+esc","Ctrl+tab","Ctrl+space","Ctrl+return","Ctrl+backspace","Ctrl+scroll","Ctrl+capslock","Ctrl+numlock",
            // "Ctrl+insert","Ctrl+home","Ctrl+del","Ctrl+end","Ctrl+pageup","Ctrl+pagedown","Ctrl+left","Ctrl+up","Ctrl+right",
            // "Ctrl+down",
            // "Ctrl+f1","Ctrl+f2","Ctrl+f3","Ctrl+f4","Ctrl+f5","Ctrl+f6","Ctrl+f7","Ctrl+f8","Ctrl+f9","Ctrl+f10","Ctrl+f11","Ctrl+f12",
            // "Shift+esc","Shift+tab","Shift+space","Shift+return","Shift+backspace","Shift+scroll","Shift+capslock","Shift+numlock",
            // "Shift+insert","Shift+home","Shift+del","Shift+end","Shift+pageup","Shift+pagedown","Shift+left","Shift+up",
            // "Shift+right","Shift+down",
            // "Shift+f1","Shift+f2","Shift+f3","Shift+f4","Shift+f5","Shift+f6","Shift+f7","Shift+f8","Shift+f9","Shift+f10","Shift+f11","Shift+f12",
            // "Alt+esc","Alt+tab","Alt+space","Alt+return","Alt+backspace","Alt+scroll","Alt+capslock","Alt+numlock",
            // "Alt+insert","Alt+home","Alt+del","Alt+end","Alt+pageup","Alt+pagedown","Alt+left","Alt+up","Alt+right","Alt+down",
            // "Alt+f1","Alt+f2","Alt+f3","Alt+f4","Alt+f5","Alt+f6","Alt+f7","Alt+f8","Alt+f9","Alt+f10","Alt+f11","Alt+f12"
            "Ctrl+s","f1","f2","f3","f4","f5","f6","f7","Ctrl+x","Ctrl+i","Ctrl+d","Ctrl+e","Ctrl+q"
        ];
        
        // the fetching...
        $.each(elements, function(i, e) { // i is element index. e is element as text.
           var newElement = ( /[\+]+/.test(elements[i]) ) ? elements[i].replace("+","_") : elements[i];
           
           // Binding keys
           $(document).bind('keydown', elements[i], function assets() {
               //$('#_'+ newElement).addClass("dirty");
               if(newElement == "Ctrl_s"){
                  $('#saveasnewrecord').trigger('click');
               }
               if(newElement == "f1"){
                  $('#toexcel1').trigger('click');
               }
               if(newElement == "f2"){
                  $('#toexcel2').trigger('click');
               }
               if(newElement == "f3"){
                  $('#toexcel3').trigger('click');
               }
               if(newElement == "f4"){
                  $('#toexcel4').trigger('click');
               }
               if(newElement == "f5"){
                  $('#toexcel5').trigger('click');
               }
               if(newElement == "f6"){
                  $('#toexcel6').trigger('click');
               }
               if(newElement == "f7"){
                  $('#toexcel7').trigger('click');
               }
               if(newElement == "Ctrl_e"){
                  $('#exporttoexcel').trigger('click');
               }
               if(newElement == "Ctrl_i"){
                  $('#addfamiec').trigger('click');
               }
               if(newElement == "Ctrl_d"){
                  $('#adddamass').trigger('click');
               }
               if(newElement == "Ctrl_x"){
                  $('#addcasualtybtn').trigger('click');
               }
               if(newElement == "Ctrl_q"){
                  $('#addfamoec').trigger('click');
               }

               return false;
           });
        });
        
    }
    
    jQuery(document).ready(domo);
}

    
</script>

	    	</div>
    	</div>
    </div>
    <footer>
      <div class="pull-right">
        DSWD DRMD - All Rights Reserved <?= date("Y"); ?>
      </div>
      <div class="clearfix"></div>
    </footer>
   </body>

</html>