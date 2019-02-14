<div class="row" id="webusers">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-plus-circle"></i> Activate Web Users</div>
      			<div class="panel-body">
              <button type="button" class="btn btn-success btn-sm" id="btnactivateuser"><span class="fa fa-plug"></span> Activate Users</button>
              <button type="button" class="btn btn-danger btn-sm" id="btndeactivateuser"><span class="fa fa-power-off"></span> De-activate Users</button>
              <button type="button" class="btn btn-primary btn-sm pull-right" id="btnsavewebactivation"><span class="fa fa-save"></span> Continue </button>
              <table class="table table-bordered" id="web_users_list">
                <thead>
                  <tr>
                    <th>Fullname</th>
                    <th style="text-align:center">Position</th>
                    <th style="text-align:center">Agency</th>
                    <th style="text-align:center">Username</th>
                    <th style="text-align:center">Is Activated?</th>
                    <th style="text-align:center">Activate/Deactivate</th>
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

<div id="addPrivilegesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><strong>Add User Priviliges</strong></h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                  <i> *You can set privileges when activating users. If no privileges were selected the user/s can only view the reports.</i>
                </div>
                <div class="col-sm-12">
                    <br>
                    <input type="checkbox" id="isadminpriv"/> Is Administrator?
                </div>
                <div class="col-sm-12">
                    <input type="checkbox" id="iscancreatepriv"/> Can Create Report?
                </div>
                <div class="col-sm-12">
                    <input type="checkbox" id="isdswd"/> Can add/update DSWD Assistance?
                </div>
                <div class="col-sm-12">
                  <br>
                  <button type="button" class="btn btn-primary btn-sm pull-right" id="btnsaveswebactivation" onclick="continueWebActivation();"><span class="fa fa-save"></span> Save </button>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
</div>