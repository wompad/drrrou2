<div class="row">

  <div style="left:50%; top:45%; position:fixed; z-index:99999; background-color:#304456; padding-top:20px; padding-bottom:20px; padding-left:50px; padding-right:45px; border-radius:5px; color:#fff" id="loader">
  <center><div class="loader"></div></center>
  Loading data...
  </div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel-group">
  		<div class="panel panel-default" style="border-radius:0px">
    			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-table"></i> <b>Disaster Reports Assignment</b></div>
    			<div class="panel-body">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h5 class="red"><strong>Assign Reports to Users</strong></h5>
              <br>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="panel-group">
                <div class="panel panel-default" style="border-radius:0px">
                    <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-table"></i> <b>Reports List</b></div>
                      <div class="panel-body">

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="overflow-x:hidden">
                    				<table class="table table-bordered table-striped table-hover" id="my_tbl_disaster" style="font-size:11px; overflow:hidden">
                    					<thead>
                    						<tr>
                                  <th></th>
                    							<th>Disaster Type</th>
                    							<th style="text-align:center">Date of Occurence</th>
                    							<th style="text-align:center">Select Reports</th>
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

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="panel-group">
                <div class="panel panel-default" style="border-radius:0px">
                    <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-table"></i> <b>Users List</b></div>
                      <div class="panel-body">

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control" id="reportpriv">
                              <option value=''>Select Privileges</option>
                              <option value='f'>Can view only</option>
                              <option value='t'>Can view and edit</option>
                            </select>
                            <br>
                            <table class="table table-bordered table-striped table-hover" id="tbl_users_list" style="font-size:11px">
                              <thead>
                                <tr>
                                  <th>Fullname</th>
                                  <th style="text-align:center">Province</th>
                                  <th style="text-align:center">Municipality</th>
                                  <th style="text-align:center">Agency</th>
                                  <th style="text-align:center">Position</th>
                                  <th style="text-align:center">Select Users</th>
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

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="button" class="btn btn-success pull-right" id="btn_reportassignment"> Continue and Save Report Assignment </button>
            </div>

    			</div>
    		</div>
    	</div>
	</div>

</div>