<div class="row">
      <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" class="btn btn-xs btn-success" href="#aug" style="border-radius:0px; cursor:pointer">Augmentation Assistance</a>
        </li>
        <li>
            <a data-toggle="tab" class="btn btn-xs btn-success" href="#aug_ffw" style="border-radius:0px; cursor:pointer">Food-for-Work (FFW) Assistance</a>
        </li>
        <li>
            <a data-toggle="tab" class="btn btn-xs btn-success" href="#esa" style="border-radius:0px; cursor:pointer">Emergency Shelter Assistance (ESA)</a>
        </li>
        <li>
            <a data-toggle="tab" class="btn btn-xs btn-success" href="#cfw" style="border-radius:0px; cursor:pointer">Cash-for-Work (CFW) Assistance</a>
        </li>
        <li>
            <a data-toggle="tab" class="btn btn-xs btn-success" href="#perdisaster" style="border-radius:0px; cursor:pointer">Per Disaster Event</a>
        </li>
        <li>
            <a data-toggle="tab" class="btn btn-xs btn-success" href="#summary" style="border-radius:0px; cursor:pointer">Summary</a>
        </li>
      </ul>
      <div style="left:50%; top:50%; position:absolute; z-index:99999; background-color:#304456; padding-top:20px; padding-bottom:20px; padding-left:50px; padding-right:45px; border-radius:5px; color:#fff" id="asstloader">
          <center><div class="loader"></div></center>
          Loading data...
      </div>
      <div class="tab-content">
      <br>
            <div class="col-md-12" style="margin-bottom: 10px">
                  <div class="pull-right col-md-3">
                        <div class="input-group">
                            <div class="input-group-addon">
                              Search Year
                            </div>
                            <input class="form-control" type="number" id="get_augmentation_assistanceyear"/>
                            <div class="input-group-addon">
                              <span class="fa fa-search"></span>
                            </div>
                        </div>
                  </div>
            </div>
            <div id="perdisaster" class="tab-pane fade">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel-group">
                              <div class="panel panel-default" style="border-radius:0px">
                                    <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-th"></i> Assistance Report 2018 (Per Disaster Event)</div>
                                    <div class="panel-body">
                                          <div class="row">
                                                <ul class="nav nav-tabs">
                                                  <li class="active">
                                                      <a data-toggle="tab" class="btn btn-xs btn-success" href="#perdisasteritem" style="border-radius:0px; cursor:pointer">Per Municipality with Items Released</a>
                                                  </li>
                                                  <li>
                                                      <a data-toggle="tab" class="btn btn-xs btn-success" href="#perdisastercons" style="border-radius:0px; cursor:pointer">Total per Municipality</a>
                                                  </li>
                                                </ul>
                                          </div>
                                          <div class="tab-content">
                                                <div id="perdisasteritem" class="tab-pane fade in active">
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <table class="table table-bordered table-hover" id="tbl_assistanceperdisaster" border='1' style='border: 1px solid #000'>
                                                                  <thead>
                                                                        <tr style='background-color:#008080; color:#fff'>
                                                                              <th style='border: 1px solid #000'>Disaster Event</th>
                                                                              <th style="text-align:center; border: 1px solid #000">Assistance Type</th>
                                                                              <th style="text-align:center; border: 1px solid #000">City/Municipality</th>
                                                                              <th style="text-align:center; border: 1px solid #000">Families Served</th>
                                                                              <th style="text-align:center; border: 1px solid #000">Assistance Provided</th>
                                                                              <th style="text-align:center; border: 1px solid #000">Quantity</th>
                                                                              <th style="text-align:center; border: 1px solid #000">Date Augmented</th>
                                                                              <th style="text-align:center; border: 1px solid #000">Amount (PhP)</th>
                                                                        </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                  </tbody>
                                                            </table>
                                                      </div>
                                                </div>

                                                <div id="perdisastercons" class="tab-pane fade">
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <table class="table table-bordered table-hover" id="tbl_assistanceperdisastercons" border='1' style='border: 1px solid #000;'>
                                                                  <thead>
                                                                        <tr style='background-color:#008080; color:#fff'>
                                                                              <th style='border: 1px solid #000'>Disaster Event</th>
                                                                              <!-- <th style="text-align:center; border: 1px solid #000">Assistance Type</th> -->
                                                                              <th style="text-align:center; border: 1px solid #000">City/Municipality</th>
                                                                              <th style="text-align:center; border: 1px solid #000">Families Served</th>
                                                                              <!-- <th style="text-align:center; border: 1px solid #000">Assistance Provided</th>
                                                                              <th style="text-align:center; border: 1px solid #000">Quantity</th> -->
                                                                              <!-- <th style="text-align:center; border: 1px solid #000">Date Augmented</th> -->
                                                                              <th style="text-align:center; border: 1px solid #000">Amount (PhP)</th>
                                                                        </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                  </tbody>
                                                            </table>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <div id="aug" class="tab-pane fade in active">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel-group">
                        <div class="panel panel-default" style="border-radius:0px">
                                    <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-th"></i> Relief Assistance Report</div>
                                    <div class="panel-body">
                                          <table class="table table-bordered table-hover" id="tbl_reliefassistance" border='1'>
                                                <thead>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th>Province/City/Municipality</th>
                                                            <th style="text-align:right">Number Served (Family)</th>
                                                            <th style="text-align:right">Amount (₱) </th>
                                                            <th style="text-align:center">Items Augmented</th>
                                                            <th style="text-align:right">Quantity</th>
                                                            <th style="text-align:center">Date Augmented</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th> Total Number of LGUs Served: <span id="lguserved" class="pull-right"></span> </th>
                                                            <th style="text-align:right"> Total Number Served (Families): <span id="famserved"></span> </th>
                                                            <th style="text-align:right"> Total Amount: <span id="amountserved"></span> </th>
                                                            <th style="text-align:right" colspan="2"> Total Family Food Packs: <span id="fpackserved"></span> </th>
                                                            <th style="text-align:right"> </th>
                                                      </tr>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th> Other Region: <span id="lguservedo" class="pull-right"></span> </th>
                                                            <th style="text-align:right"> Families Served (Other Region): <span id="famservedo"></span> </th>
                                                            <th style="text-align:right"> Total Amount (Other Region): <span id="amountservedo"></span> </th>
                                                            <th style="text-align:right" colspan="2"> Total FFPs (Other Region): <span id="fpackservedo"></span> </th>
                                                            <th style="text-align:right"> </th>
                                                      </tr>
                                                </tfoot>
                                          </table>
                                    </div>
                        </div>
                        </div>
                  </div>
            </div>
            <div id="aug_ffw" class="tab-pane fade">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel-group">
                        <div class="panel panel-default" style="border-radius:0px">
                                    <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-th"></i> Food-for-Work Assistance Report</div>
                                    <div class="panel-body">
                                          <table class="table table-bordered table-hover" id="tbl_ffwassistance" border='1'>
                                                <thead>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th>Province/City/Municipality</th>
                                                            <th style="text-align:right">Number Served (Family)</th>
                                                            <th style="text-align:right">Amount (₱) </th>
                                                            <th style="text-align:center">Items Augmented</th>
                                                            <th style="text-align:right">Quantity</th>
                                                            <th style="text-align:center">Date Augmented</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th> Total Number of LGUs Served: <span id="ffwlguserved" class="pull-right"></span> </th>
                                                            <th style="text-align:right"> Total Number Served (Families): <span id="ffwfamserved"></span> </th>
                                                            <th style="text-align:right"> Total Amount: <span id="ffwamountserved"></span> </th>
                                                            <th style="text-align:right" colspan="2"> Total Family Food Packs: <span id="ffwfpackserved"></span> </th>
                                                            <th style="text-align:right"> </th>
                                                      </tr>
                                                </tfoot>
                                          </table>
                                    </div>
                        </div>
                        </div>
                  </div>
            </div>
            <div id="esa" class="tab-pane fade">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel-group">
                        <div class="panel panel-default" style="border-radius:0px">
                                    <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-th"></i> Emergency Shelter Assistance (ESA) Report</div>
                                    <div class="panel-body">
                                          <table class="table table-bordered table-hover" id="tbl_esaassistance" border='1'>
                                                <thead>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th>Province/City/Municipality</th>
                                                            <th style="text-align:right">Number Served (Family)</th>
                                                            <th style="text-align:right">Amount (₱) </th>
                                                            <th style="text-align:center">Items Augmented</th>
                                                            <th style="text-align:center">Date Augmented</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th> Total Number of LGUs Served: <span id="esalguserved" class="pull-right"></span> </th>
                                                            <th style="text-align:right"> Total Number Served (Families): <span id="esafamserved"></span> </th>
                                                            <th style="text-align:right" colspan="2"> Total Amount: <span id="esaamountserved"></span> </th>
                                                            <th style="text-align:right"> </th>
                                                      </tr>
                                                </tfoot>
                                          </table>
                                    </div>
                        </div>
                        </div>
                  </div>
            </div>
            <div id="cfw" class="tab-pane fade">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel-group">
                        <div class="panel panel-default" style="border-radius:0px">
                                    <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-th"></i> Cash-for-Work (CFW) Assistance Report</div>
                                    <div class="panel-body">
                                          <table class="table table-bordered table-hover" id="tbl_cfwassistance" border='1'>
                                                <thead>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th>Province/City/Municipality</th>
                                                            <th style="text-align:right">Number Served (Family)</th>
                                                            <th style="text-align:right">Amount (₱) </th>
                                                            <th style="text-align:center">Items Augmented</th>
                                                            <th style="text-align:center">Date Augmented</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th> Total Number of LGUs Served: <span id="cfwlguserved" class="pull-right"></span> </th>
                                                            <th style="text-align:right"> Total Number Served (Families): <span id="cfwfamserved"></span> </th>
                                                            <th style="text-align:right" colspan="2"> Total Amount: <span id="cfwamountserved"></span> </th>
                                                            <th style="text-align:right"> </th>
                                                      </tr>
                                                </tfoot>
                                          </table>
                                    </div>
                        </div>
                        </div>
                  </div>
            </div>
            <div id="summary" class="tab-pane fade">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel-group">
                        <div class="panel panel-default" style="border-radius:0px">
                                    <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-th"></i> Summary of Assistance </div>
                                    <div class="panel-body">
                                          <table class="table table-bordered table-hover" id="tbl_summaryassistance" border='1'>
                                                <thead>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th>Assistance Type</th>
                                                            <th style="text-align:right">Number Served (Family)</th>
                                                            <th style="text-align:right">Number of LGUs Served</th>
                                                            <th style="text-align:right">Total Amount (₱) </th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <tr>
                                                            <th>     Relief Assistance (Inside Region)</th>
                                                            <th style="text-align:right"><span id="sum_famserved_aug"></span></th>
                                                            <th style="text-align:right"><span id="sum_lguserved_aug"></span></th>
                                                            <th style="text-align:right"><span id="sum_amount_aug"></span></th>
                                                      </tr>
                                                      <tr>
                                                            <th>     Relief Assistance (Outside Region)</th>
                                                            <th style="text-align:right"><span id="sum_famserved_aug_o"></span>-</th>
                                                            <th style="text-align:right"><span id="sum_lguserved_aug_o"></span></th>
                                                            <th style="text-align:right"><span id="sum_amount_aug_o"></span></th>
                                                      </tr>
                                                      <tr>
                                                            <th>     Food-for-Work (FFW) Assistance</th>
                                                            <th style="text-align:right"><span id="sum_famserved_ffw"></span></th>
                                                            <th style="text-align:right"><span id="sum_lguserved_ffw"></span></th>
                                                            <th style="text-align:right"><span id="sum_amount_ffw"></span></th>
                                                      </tr>
                                                      <tr>
                                                            <th>     Emergency Shelter Assistance (ESA)</th>
                                                            <th style="text-align:right"><span id="sum_famserved_esa"></span></th>
                                                            <th style="text-align:right"><span id="sum_lguserved_esa"></span></th>
                                                            <th style="text-align:right"><span id="sum_amount_esa"></span></th>
                                                      </tr>
                                                      <tr>
                                                            <th>     Cash-for-Work (CFW) Assistance</th>
                                                            <th style="text-align:right"><span id="sum_famserved_cfw"></span></th>
                                                            <th style="text-align:right"><span id="sum_lguserved_cfw"></span></th>
                                                            <th style="text-align:right"><span id="sum_amount_cfw"></span></th>
                                                      </tr>
                                                </tbody>
                                                <tfoot>
                                                      <tr style='background-color:#008080; color:#fff'>
                                                            <th style="vertical-align:middle"> GRAND-TOTAL </th>
                                                            <th style="text-align:right; vertical-align:middle"> <span id="gfamserved"></span> </th>
                                                            <th style="text-align:right; vertical-align:middle"> Total Number of LGUs Served (Inside Region): <span id="glguserved"></span> <br>
                                                            Total Number of Unique LGUs Served (Inside Region): <span id="glguservedu"> - </span>
                                                            </th>
                                                            <th style="text-align:right; vertical-align:middle"> <span id="gtotalamount"></span> </th>
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