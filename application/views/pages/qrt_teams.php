<div class="row">
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-plus-circle"></i> QRT Team Composition</div>
      			<div class="panel-body">
      			<form>
      				<div class="form-group col-md-12">
      					<select class="form-control input-sm" id="qrtteamnumber">
	      					<option value="">--- Select QRT Team Number --</option>
	      					<option value="1">Team 1</option>
	      					<option value="2">Team 2</option>
	      					<option value="3">Team 3</option>
	      					<option value="4">Team 4</option>
	      					<option value="5">Team 5</option>
                  <option value="6">Team 6</option>
                  <option value="7">Team 7</option>
                  <option value="8">Team 8</option>
                  <option value="9">Team 9</option>
                  <option value="10">Team 10</option>
	      				</select>
      				</div>
      				<div class="form-group col-md-12">
      					<input type="text" class="form-control input-sm" placeholder="QRT Team Leader" id="qrtleader">
      				</div>
      				<div class="form-group col-md-12">
      					<input type="text" class="form-control input-sm" placeholder="QRT Team Statistician" id="qrtstatistician">
      				</div>
      				<div class="form-group col-md-12">
      					<input type="text" class="form-control input-sm" placeholder="QRT Team SMU" id="qrtsmu">
      				</div>
      				<div class="form-group col-md-12">
      					<input type="text" class="form-control input-sm" placeholder="QRT Team AA" id="qrtaa">
      				</div>
      				<table class="table table-responsive col-md-12" id="tbl_qrtsstaff">
      					<tbody>
      						<tr>
      							<td style="width:99%"> <input type="text" class="form-control input-sm" placeholder="QRT Team Support Staff" name="qrtsstaff"> </td>
      							<td> <button type="button" class="btn btn-primary btn-sm removeSStaff"><span class="fa fa-minus"></button> </td>
      						</tr> 
      					</tbody>
      				</table>
      				<table class="table table-responsive col-md-12" style="margin-top:-25px" id="tbl_qrtdriver">
      					<tbody>
      						<tr>
      							<td style="width:99%"> <input type="text" class="form-control input-sm" placeholder="QRT Team Driver" name="qrtdriver"> </td>
      							<td> <button type="button" class="btn btn-warning btn-sm removeDriver"><span class="fa fa-minus"></button> </td>
      						</tr>
      					</tbody>
      				</table>
      				<div class="form-group pull-left">
		                <button type="button" class="btn btn-primary btn-sm" id="addnew_qrtsstaff"><span class="fa fa-plus-circle"></span> Add new Support Staff</button>
		                <button type="button" class="btn btn-warning btn-sm" id="addnew_qrtdriver"><span class="fa fa-plus-circle"></span> Add new Driver</button>
		            </div>
		            <div class="form-group pull-right">
		                <button type="button" class="btn btn-success btn-sm" id="savedata_qrt"> <i class="fa fa-plus-circle"></i></button>
		                <button type="button" class="btn btn-info btn-sm" disabled id="updatedata_qrt"> <i class="fa fa-edit "></i></button>
		                <button type="button" class="btn btn-danger btn-sm" disabled id="deletedata_qrt"> <i class="fa fa-times-circle"></i></button>
		                <button type="reset" class="btn btn-primary btn-sm" id="resetdata_qrt"><i class="fa fa-refresh"></i></button>
		            </div>
		         </form>
      			</div>
    		</div>
  		</div>
	</div>
	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-plus-circle"></i> QRT Team Details</div>
      			<div class="panel-body">
      				<div class="panel-group" id="qrtteamspanel">
					 </div>
      			</div>
    		</div>
  		</div>
	</div>
</div>