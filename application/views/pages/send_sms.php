<div class="row">
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-check-square-o"></i> Select Contacts to Send SMS</div>
      			<div class="panel-body">
      				<div class="form-group">
	      				<select class="form-control input-sm" id="selectcontact">
	      					<option value="">--- Select contact to display --</option>
	      					<option value="1">C/MSWDO</option>
	      					<option value="2">MAT Leaders</option>
	      					<option value="3">MAT Member</option>
	      				</select>
	      			</div>
	      			<div class="form-group">
	      				<table class="table table-hover table-striped table-bordered" style="font-size:12px" id="tbl_selectcontact">
	      					<thead>
	      						<tr>
	      							<th style="text-align:center"> <input type="checkbox" id="checkallnumber"> </th>
	      							<th> Name </th>
	      							<th> City/Municipality </th>
	      							<th> Contact Number </th>
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
	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-paper-plane"></i> Compose Message</div>
      			<div class="panel-body">
      				<div class="form-group">
      					<input type="text" class="form-control input-sm" placeholder="Enter number here. Delimit each number with ';' if you wish to enter multiple numbers." style="font-weight:bold" id="allnumbers">
      				</div>
      				<div class="form-group">
      					<textarea class="form-control" rows="10" placeholder="Compose your message here..." id="smsbody"></textarea>
      				</div>
      				<div class="form-group">
      					<input type="text" class="form-control input-sm" id="postsmsbody" style="font-weight:bold" value="From: DSWD - Caraga" disabled="disabled">
      				</div>
      				<div class="form-group">
      					<button type="button" class="form-control btn btn-sm btn-primary" id="sendsms"><i class="fa fa-paper-plane"></i> Send Message</button>
      				</div>
      			</div>
      		</div>
      	</div>
	</div>
	<div class="modal fade" id="sendsmsModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:300px">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-body">
	          <p><span class="fa fa-info-circle"></span> Sending messages... You can review message status in <strong>(Message Status)</strong> option</p>
	        </div>
	      </div>
	    </div>
	</div>
</div>