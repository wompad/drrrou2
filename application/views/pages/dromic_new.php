<div class="row">

	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-plus-circle"></i> Add New <b>Disaster Type <label class="pull-right"><a style="color: #fff" href="javascript:void(0);" onclick="javascript:introJs().start();">Show Tutorial!</a></label></b></div>
      			<div class="panel-body" data-step="1" data-intro="To add a DROMIC Disaster Statistical Report. Kindly fill in all the details and then click <span class='green'><b>green button</b></span> tagged as <span class='green'><b>(Save Data)</b></span> to save the report!">
      				<div class="form-group">
      					<label>Disaster Name:</label>
      					<input type="text" class="form-control input-sm" placeholder="Type of Disaster" id="disaster_name">
      				</div>
      				<div class="form-group">
      					<label>Date of Occurence:</label>
      					<input type="date" class="form-control input-sm" id="disaster_date">
      				</div>
      				<div class="form-group pull-right">
      					<button type="button" class="btn btn-success btn-sm" id="addDromic"><span class="fa fa-plus-circle"></span> Save Data</button>
                <button type="button" class="btn btn-warning btn-sm" id="editDromic"><span class="fa fa-edit"></span> Update Data</button>
      				</div>
      			</div>
      		</div>
      	</div>
	</div>

	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-table"></i> <b>Disaster Reports</b></div>
      			<div class="panel-body" data-step="2" data-intro="Once the report is saved, it will automatically appear in this table at the <b>topmost</b> entry. Click on the <span class='red'><b>red button</b></span> tagged as <span class='red'><b>(Create new Report)</b></span>. Please note that other buttons are disabled since this will be the first instance on creating a report for the specific disaster event. After clicking the button, a popup window will appear, kindly fill in the details indicated in order for you to continue and then click save!" data-position="left">
      				<table class="table table-bordered table-striped table-hover" id="tbl_disaster" style="font-size:11px">
      					<thead>
      						<tr>
      							<th>Disaster Type</th>
      							<th style="text-align:center">Date of Occurence</th>
      							<th>Action</th>
      						</tr>
      					</thead>
      					<tbody>
      					</tbody>
      				</table>
      			</div>
      		</div>
      	</div>
	</div>

            <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg"  style="width:62%">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><label id="disaster_name_modal"></label></h4>
            </div>
            <div class="modal-body">
              
                  <table class="table table-bordered tabl-hover table-striped" id="tbl_previous_reports"  style="overflow:hidden">
                        <thead>
                              <tr>
                                    <th style="text-align:center">#</th>
                                    <th> Disaster Title</th>
                                    <th style="text-align:center"> Action </th>
                              </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
            </div>
          </div>

        </div>
      </div>

      <div id="addnewReport" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm" style="width:35%">
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <label>Would you like to continue to following details before saving?</label>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-3">
                    <label style="margin-top:8px">Disaster Title</label>
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="newreporttitle">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-3">
                    <label style="margin-top:8px">As of Date</label>
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" class="form-control" value="<?php echo date('Y-m-d') ?>" id="newreportdate">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-3">
                    <label style="margin-top:8px">As of Time</label>
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" class="form-control" value="<?php echo date('H:i:s') ?>" id="newreporttime">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-3">
                    <label style="margin-top:8px">Prepared by: </label>
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="preparedby">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-3">
                    <label style="margin-top:8px">Position: </label>
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="preparedbypos">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-3">
                    <label style="margin-top:8px">Recommended by: </label>
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="recommendedby">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-3">
                    <label style="margin-top:8px">Position: </label>
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="recommendedbypos">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-3">
                    <label style="margin-top:8px">Approved by: </label>
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="approvedby" value="MITA CHUCHI GUPANA - LIM">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-3">
                    <label style="margin-top:8px">Position: </label>
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="approvedbypos" value="Regional  Director">
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="alert alert-danger col-md-12" id="errmsgnewdromic">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" onclick="savenewDromic()"><i class="fa fa-mail-forward"></i> Continue</button>
            </div>
          </div>
        </div>
      </div>
</div>