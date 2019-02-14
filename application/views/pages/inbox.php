<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
	      <div class="x_title">
	        <h2>Inbox (Disaster Response)<small>drrroufocaraga@gmail.com (09296193510)</small></h2>
	      	<div class="clearfix"></div>
	      </div>
	      <div class="x_content">
	        <div class="row">
	          <div class="col-sm-12 mail_list_column">

	          	<button class="btn btn-sm btn-success btn-block" type="button"> </button>

	          	<br>
	          	<div class="col-sm-12" id="div_inbox">
	          		<table class="table table-bordered" id="msg_ecstatus">
	          			<thead>
	          				<tr>
	          					<th colspan="12" class="text-danger">Evacuation Center Status</th>
	          				</tr>
	          				<tr>
	          					<th>Disaster Name</th>
	          					<th>Province Name</th>
	          					<th>Municipality Name</th>
	          					<th>Brgy. Located (EC)</th>
	          					<th>Evacuation Center</th>
	          					<th>EC Status</th>
	          					<th>Affected Families</th>
	          					<th>Affected Persons</th>
	          					<th>Place of Origin (Evacuees)</th>
	          					<th>Sent Date</th>
	          					<th>Ref. Code</th>
	          					<th></th>
	          				</tr>
	          			</thead>
	          			<tbody>
	          			</tbody>
	          		</table>
	          		<table class="table table-bordered" id="msg_castatus">
	          			<thead>
	          				<tr>
	          					<th colspan="13" class="text-danger">Casualty Status</th>
	          				</tr>
	          				<tr>
	          					<th>Disaster Name</th>
	          					<th>Province Name</th>
	          					<th>Municipality Name</th>
	          					<th>Lastname</th>
	          					<th>Firstname</th>
	          					<th>M.I.</th>
	          					<th>Age</th>
	          					<th>Sex</th>
	          					<th>Place of Origin</th>
	          					<th>Status</th>
	          					<th>Sent Date</th>
	          					<th>Ref. Code</th>
	          					<th></th>
	          				</tr>
	          			</thead>
	          			<tbody>
	          			</tbody>
	          		</table>
	          		<table class="table table-bordered" id="msg_coststatus">
	          			<thead>
	          				<tr>
	          					<th colspan="13" class="text-danger">Cost of Assistance Status</th>
	          				</tr>
	          				<tr>
	          					<th>Disaster Name</th>
	          					<th>Province Name</th>
	          					<th>Municipality Name</th>
	          					<th>Cost of Assistance from LGU</th>
	          					<th>Cost of Assistance from NGO/NGA Other GO.</th>
	          					<th>Sent Date</th>
	          					<th>Ref. Code</th>
	          					<th></th>
	          				</tr>
	          			</thead>
	          			<tbody>
	          			</tbody>
	          		</table>
	          		<table class="table table-bordered" id="msg_outecstatus">
	          			<thead>
	          				<tr>
	          					<th colspan="12" class="text-danger">Outside Evacuation Center Status</th>
	          				</tr>
	          				<tr>
	          					<th>Disaster Name</th>
	          					<th>Host Province</th>
	          					<th>Host Municipality</th>
	          					<th>Host Brgy.</th>
	          					<th>No. of Families Affected</th>
	          					<th>No. of Persons Affected</th>
	          					<th>Sent Date</th>
	          					<th>Origin Province</th>
	          					<th>Origin Municipality</th>
	          					<th>Origin Brgy.</th>
	          					<th>Ref. Code</th>
	          					<th></th>
	          				</tr>
	          			</thead>
	          			<tbody>
	          			</tbody>
	          		</table>
	          		<table class="table table-bordered" id="msg_damstatus">
	          			<thead>
	          				<tr>
	          					<th colspan="12" class="text-danger">Damages Status</th>
	          				</tr>
	          				<tr>
	          					<th>Disaster Name</th>
	          					<th>Province Name</th>
	          					<th>Municipality Name</th>
	          					<th>Brgy. Name</th>
	          					<th>Partially Damage</th>
	          					<th>Totally Damage</th>
	          					<th>Dead</th>
	          					<th>Missing</th>
	          					<th>Injured</th>
	          					<th>Sent Date</th>
	          					<th>Ref. Code</th>
	          					<th></th>
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

<div id="AddtoDisasterReport" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="width:35%">

      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> <label id="headertitle">Export Message to Disaster Report</h4>
        </div>
        <div class="modal-body">
            <div class="row">
              	<div class="form-group col-md-12">
              		<label>
              		Reminders: 
              		</label>
              		<ul class="list-unstyled timeline widget">
              			<li>
				            <div class='block'>
				              <div class='block_content'>
				                <h2 class='title' style="font-size:12px">
				                    <a>This message will be exported to latest disaster report. All changes made cannot be undone.</a>
				                </h2>
				              </div>
				            </div>
				        </li>
				        <li>
				            <div class='block'>
				              <div class='block_content'>
				                <h2 class='title' style="font-size:12px">
				                    <a>If there is no disaster report created yet, click this link to continue. <a href="https://crg-web-svr/drrrou/dromic_new"><u>Create Disaster Report.</u></a> </a>
				                </h2>
				              </div>
				            </div>
				        </li>
                    </ul>
              	</div>
            </div>
          <div class="row">
          	<div class="form-group col-md-12">
          		<label> <i style="color:red">*</i>  Select Disaster Report </label>
          		<select class="form-control" id="disasterreportstitle">
          			<option value="">--- Select Disaster Report ---</option>
          		</select>
          		<i class="text-danger" id="disasterreportstitlelabel">*Kindly select disaster report to continue!</i>
          	</div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success btn-sm" id="savetodisasterreport"><i class="fa fa-plus-circle"></i> Save Data</button>
        </div>
      </div>

    </div>
  </div>
</div>