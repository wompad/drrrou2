<div class="row">
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" class="btn btn-sm btn-success tabpill" href="#monthlycong" style="border-radius:0px; color:#272822" id="congressionalmonth">Monthly Congressional Report</a></li>
    <li><a data-toggle="tab" class="btn btn-sm btn-success tabpill" href="#quarterlycong" style="border-radius:0px; color:#272822" id="congressionalquarter">Quarterly Congressional Report</a></li>
     <li><a data-toggle="tab" class="btn btn-sm btn-success tabpill" href="#yearlycong" style="border-radius:0px; color:#272822" id="congressionalquarter">Yearly Congressional Report</a></li>
  </ul>
  <div style="left:50%; top:50%; position:absolute; z-index:99999; background-color:#304456; padding-top:20px; padding-bottom:20px; padding-left:50px; padding-right:45px; border-radius:5px; color:#fff" id="congreloader">
    <center><div class="loader"></div></center>
    Loading data...
  </div>
  <div class="tab-content">
    <br>
    <div id="monthlycong" class="tab-pane fade in active">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel-group">
            <div class="panel panel-default" style="border-radius:0px">
                <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-table"></i> Monthly Congressional Report
                   

                  <button type="button" class="pull-right" id="exporttoexcelcong" style="color: #000; margin-right: 20px; margin-top:-3px;">
                  <label style="border:1px solid #006400; position:absolute; width:30px; height:38px; margin-top:-10px; margin-left:-3px; background-color:#006400; color:#fff;">
                    <i class="fa fa-file-excel-o" style="margin-top:11px; margin-left:3px; cursor:pointer"></i>
                  </label>
                            Export to Excel
                  </button>

                  <button type="button" class="pull-right" style="color: #000; margin-right: 50px; margin-top:-3px;" id="monthsearch" tabindex="2"> Search</button>
                  <input type="text" class="pull-right"  style="color: #000; margin-right: 5px; margin-top:-3px; width:250px" id="monthpicker" placeholder="Search Month (Format 00-0000)" tabindex="1">


                </div>
                <div class="panel-body">
                  <table style="width:100%;" id="tbl_congressional">
                    <thead>
                        <tr>
                          <th colspan="12">
                            <center>DEPARTMENT OF SOCIAL WELFARE AND DEVELOPMENT</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center>FIELD OFFICE CARAGA</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                           <center>BUTUAN CITY</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12"> </th>
                        </tr>
                        <tr>
                          <th colspan="12"> </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center>CONGRESSIONAL ACCOMPLISHMENT REPORT</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center>FOR CY <span id="cyimplement"><?php echo date("Y"); ?></span> IMPLEMENTATION</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center><span id="asofimplement"><?php echo date("F"); ?> <?php echo date("Y"); ?></span></center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12"> </th>
                        </tr>
                        <tr>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> PPA </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Brief Description </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Province </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> District </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Location </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Details of Target </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Budget </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Physical Accomplishment </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Financial Accomplishment </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> <?php echo date("Y"); ?> Budget </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> TOTAL </th>
                          <th style="text-align:center; padding: 3px; background-color: yellow; color: #000; border: 1px solid #000"> Remarks </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="12" style="border:1px solid #000; padding: 3px"><center>------- NOTHING FOLLOWS ---------</center></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
          </div>
      </div>
    </div>
    <div id="quarterlycong" class="tab-pane fade">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel-group">
            <div class="panel panel-default" style="border-radius:0px">
                <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-table"></i> Quarterly Congressional Report
                   

                  <button type="button" class="pull-right" id="exporttoexcelcongq" style="color: #000; margin-right: 20px; margin-top:-3px;">
                  <label style="border:1px solid #006400; position:absolute; width:30px; height:38px; margin-top:-10px; margin-left:-3px; background-color:#006400; color:#fff;">
                    <i class="fa fa-file-excel-o" style="margin-top:11px; margin-left:3px; cursor:pointer"></i>
                  </label>
                            Export to Excel
                  </button>

                  <button type="button" class="pull-right" style="color: #000; margin-right: 50px; margin-top:-3px;" id="quartersearch" tabindex="2"> Search</button>
                  <input type="text" class="pull-right"  style="color: #000; margin-right: 5px; margin-top:-3px; width:250px" id="quarterpicker" placeholder="Search Quarter (Format 00-0000)" tabindex="1">


                </div>
                <div class="panel-body">
                  <table style="width:100%;" id="tbl_congressional_quarter">
                    <thead>
                        <tr>
                          <th colspan="12">
                            <center>DEPARTMENT OF SOCIAL WELFARE AND DEVELOPMENT</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center>FIELD OFFICE CARAGA</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                           <center>BUTUAN CITY</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12"> </th>
                        </tr>
                        <tr>
                          <th colspan="12"> </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center>CONGRESSIONAL ACCOMPLISHMENT REPORT</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center>FOR CY <span id="cyimplementq"><?php echo date("Y"); ?></span> IMPLEMENTATION</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center><span id="asofimplementq"><?php 
                              $curMonth = date("m", time());
                              $curQuarter = ceil($curMonth/3); 
                              if($curQuarter == 1){
                                echo $curQuarter ."<sup>st</sup>"." Quarter";
                              }else if($curQuarter == 2){
                                echo $curQuarter ."<sup>nd</sup>"." Quarter";
                              }else if($curQuarter == 3){
                                echo $curQuarter ."<sup>rd</sup>"." Quarter";
                              }else if($curQuarter == 4){
                                echo $curQuarter ."<sup>th</sup>"." Quarter";
                              }
                            ?> <?php echo date("Y"); ?></span></center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12"> </th>
                        </tr>
                        <tr>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> PPA </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Brief Description </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Province </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> District </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Location </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Details of Target </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Budget </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Physical Accomplishment </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Financial Accomplishment </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> <?php echo date("Y"); ?> Budget </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> TOTAL </th>
                          <th style="text-align:center; padding: 3px; background-color: yellow; color: #000; border: 1px solid #000"> Remarks </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="12" style="border:1px solid #000; padding: 3px"><center>------- NOTHING FOLLOWS ---------</center></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
          </div>
      </div>
    </div>
    <div id="yearlycong" class="tab-pane fade">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel-group">
            <div class="panel panel-default" style="border-radius:0px">
                <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-table"></i> Yearly Congressional Report
                   

                  <button type="button" class="pull-right" id="exporttoexcelcongy" style="color: #000; margin-right: 20px; margin-top:-3px;">
                  <label style="border:1px solid #006400; position:absolute; width:30px; height:38px; margin-top:-10px; margin-left:-3px; background-color:#006400; color:#fff;">
                    <i class="fa fa-file-excel-o" style="margin-top:11px; margin-left:3px; cursor:pointer"></i>
                  </label>
                            Export to Excel
                  </button>

                  <button type="button" class="pull-right" style="color: #000; margin-right: 50px; margin-top:-3px;" id="yearsearch" tabindex="2"> Search</button>
                  <input type="text" class="pull-right"  style="color: #000; margin-right: 5px; margin-top:-3px; width:250px" id="yearpicker" placeholder="Search Year (Format 0000)" tabindex="1">
                  
                </div>
                <div class="panel-body">
                  <table style="width:100%;" id="tbl_congressional_year">
                    <thead>
                        <tr>
                          <th colspan="12">
                            <center>DEPARTMENT OF SOCIAL WELFARE AND DEVELOPMENT</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center>FIELD OFFICE CARAGA</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                           <center>BUTUAN CITY</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12"> </th>
                        </tr>
                        <tr>
                          <th colspan="12"> </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center>CONGRESSIONAL ACCOMPLISHMENT REPORT</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12">
                            <center>FOR CY <span id="cyimplementy"><?php echo date("Y"); ?></span> IMPLEMENTATION</center>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="12"> </th>
                        </tr>
                        <tr>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> PPA </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Brief Description </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Province </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> District </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Location </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Details of Target </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Budget </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Physical Accomplishment </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> Financial Accomplishment </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> <?php echo date("Y"); ?> Budget </th>
                          <th style="text-align:center; padding: 3px; background-color: gray; color: #000; border: 1px solid #000"> TOTAL </th>
                          <th style="text-align:center; padding: 3px; background-color: yellow; color: #000; border: 1px solid #000"> Remarks </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="12" style="border:1px solid #000; padding: 3px"><center>------- NOTHING FOLLOWS ---------</center></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>