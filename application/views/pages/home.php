<div class="row">
	<!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-plus-circle"></i> Add New Contact > <b>C/MSWDO</b></div>
      			<div class="panel-body">
      				<div class="form-group">
      					<input type="text" class="form-control input-sm" placeholder="C/MSWDO Fullname" id="fullname">
      				</div>
      				<div class="form-group">
      					<input type="text" class="form-control input-sm" placeholder="Municipal/City Mayor" id="mayor">
      				</div>
      				<div class="form-group">
      					<input type="text" class="form-control input-sm" placeholder="Municipal/City Vice Mayor" id="vmayor">
      				</div>
      				<div class="form-group">
      					<select class="form-control input-sm" id="province">
      					</select>
      				</div>
      				<div class="form-group">
      					<select class="form-control input-sm" id="city">
                  <option value=''>-- Select City/Municipality --</option>
      					</select>
      				</div>
      				<div class="form-group">
      					<input type="text" class="form-control input-sm" placeholder="Mobile Number" id="mobile">
      				</div>
      				<div class="form-group">
      					<input type="text" class="form-control input-sm" placeholder="Telephone Number" id="telephone">
      				</div>
              <div class="form-group">
                <input type="text" class="form-control input-sm" placeholder="Email Address" id="emailadd">
              </div>
              <div class="form-group pull-right">
                <button type="button" class="btn btn-success btn-sm" id="savedata_mswd"> <i class="fa fa-plus-circle"></i></button>
                <button type="button" class="btn btn-info btn-sm" disabled id="updatedata_mswd"> <i class="fa fa-edit "></i></button>
                <button type="button" class="btn btn-danger btn-sm" disabled id="deletedata_mswd"> <i class="fa fa-times-circle"></i></button>
                <button type="button" class="btn btn-primary btn-sm" onclick="resetAll()" id="resetdata_mswd"><i class="fa fa-refresh"></i></button>
              </div>
      			</div>
    		</div>
  		</div>
	</div> -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px;">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-table"></i> Contact List > <b>C/MSWDO</b></div>
      			<div class="panel-body">
      				<table class="table table-bordered table-hover table-striped" id="tbl_mswdo">
      					<thead>
      						<tr>
      							<th style="font-size:12px; text-align:left">C/MSWDO</th>
      							<th style="font-size:12px; text-align:center">Mayor</th>
      							<th style="font-size:12px; text-align:center">Vice Mayor</th>
      							<th style="font-size:12px; text-align:center">Province</th>
      							<th style="font-size:12px; text-align:center">City/Municipality</th>
      							<th style="font-size:12px; text-align:center">Mobile #</th>
      							<th style="font-size:12px; text-align:center">Telephone #</th>
                    <th style="font-size:12px; text-align:center">Email Address</th>
      						</tr>
      					</thead>
                <thead class="mswd_filters">
                  <tr>
                    <td style="font-size:12px; text-align:left">C/MSWDO</td>
                    <td style="font-size:12px; text-align:center">Mayor</td>
                    <td style="font-size:12px; text-align:center">Vice Mayor</td>
                    <td style="font-size:12px; text-align:center">Province</td>
                    <td style="font-size:12px; text-align:center">City/Municipality</td>
                    <td style="font-size:12px; text-align:center">Mobile #</td>
                    <td style="font-size:12px; text-align:center">Telephone #</td>
                    <td style="font-size:12px; text-align:center">Email Address</td>
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