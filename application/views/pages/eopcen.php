<div class="row">
	<ul class="nav nav-tabs">
	  <li class="active">
	  	<a data-toggle="tab" class="btn btn-xs btn-success" href="#cinec" style="border-radius:0px; cursor:pointer" id="markreadinec">Inside Evacuation Status
	  	 <span class="badge" style="background-color:#D9534F; color:#fff; padding-top:3px; padding-bottom:3px; padding-left:7px; padding-right:7px; cursor:pointer" data-toggle="tooltip" title="Unread" id="countinec">0</span>
	  	</a>
	  </li>
	  <li>
	  	<a data-toggle="tab" href="#cdamass" class="btn btn-xs btn-success" style="border-radius:0px; cursor:pointer" id="markreaddamass">Cost and Assistance
	  	 <span class="badge" style="background-color:#D9534F; color:#fff; padding-top:3px; padding-bottom:3px; padding-left:7px; padding-right:7px; cursor:pointer" data-toggle="tooltip" title="Unread" id="countdammass">0</span>
	  	</a>
	  </li>
	  <li>
	  	<a data-toggle="tab" href="#coutec" class="btn btn-xs btn-success" style="border-radius:0px; cursor:pointer" id="markreadoutec">Outside Evacuation Status
	  	 <span class="badge" style="background-color:#D9534F; color:#fff; padding-top:3px; padding-bottom:3px; padding-left:7px; padding-right:7px; cursor:pointer" data-toggle="tooltip" title="Unread" id="countoutec">0</span>
	  	</a>
	  </li>
	  <li>
	  	<a data-toggle="tab" href="#ccasualty" class="btn btn-xs btn-success" style="border-radius: 0px; cursor:pointer" id="markreadcasualty">Casualty Status
	  	 <span class="badge" style="background-color:#D9534F; color:#fff; padding-top:3px; padding-bottom:3px; padding-left:7px; padding-right:7px; cursor:pointer" data-toggle="tooltip" title="Unread" id="countcasual">0</span>
	  	</a>
	  </li>
	  <li>
	  	<a data-toggle="tab" href="#cdamage" class="btn btn-xs btn-success" style="border-radius:0px; cursor:pointer" id="markreaduploads">Damages and Number of Casualty Status
	  	 <span class="badge" style="background-color:#D9534F; color:#fff; padding-top:3px; padding-bottom:3px; padding-left:7px; padding-right:7px; cursor:pointer" data-toggle="tooltip" title="Unread" id="ddamage">0</span>
	  	</a>
	  </li>
	  <li>
	  	<a data-toggle="tab" href="#cpics" class="btn btn-xs btn-success" style="border-radius:0px; cursor:pointer" id="markreaduploads">Uploaded Pictures
	  	 <span class="badge" style="background-color:#D9534F; color:#fff; padding-top:3px; padding-bottom:3px; padding-left:7px; padding-right:7px; cursor:pointer" data-toggle="tooltip" title="Unread" id="countpics">0</span>
	  	</a>
	  </li>
	  <!-- <li>
	  	<a data-toggle="tab" href="#msginbox" class="btn btn-xs btn-success" style="border-radius:0px; cursor:pointer">
	  	 <span class="fa fa-envelope"></span>
	  	 Messages (Inbox)
	  	 <span class="badge" style="background-color:#D9534F; color:#fff; padding-top:3px; padding-bottom:3px; padding-left:7px; padding-right:7px; cursor:pointer" data-toggle="tooltip" title="Unread" id="countpics">0</span>
	  	</a>
	  </li> -->
	</ul>
	<div class="tab-content">
	<br>
		<div id="cinec" class="tab-pane fade in active">
			<div class="col-md-12" id="div_cinec">
			</div>
		</div>
		<div id="cdamass" class="tab-pane fade">
			<div class="col-md-12" id="div_cdamass">
			</div>
		</div>
		<div id="coutec" class="tab-pane fade">
			<div class="col-md-12" id="div_coutec">
			</div>
		</div>
		<div id="ccasualty" class="tab-pane fade">
			<div class="col-md-12" id="div_ccasualty">
			</div>
		</div>
		<div id="cpics" class="tab-pane fade">
			<div class="col-md-12" id="div_cpics">
			</div>
		</div>
		<div id="cdamage" class="tab-pane fade">
			<div class="col-md-12" id="div_ddamage">
			</div>
		</div>

		<div id="msginbox" class="tab-pane fade">
			<div class="col-md-12" id="div_msginbox">
				dadawdawd
			</div>
		</div>

		<!-- Modal -->
		  <div class="modal fade" id="pictureModal" role="dialog">
		    <div class="modal-dialog modal-sm">
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		        </div>
		        <div class="modal-body">
		          <center><img id="cpictureenlarge" class="img-thumbnail" style="width: 900px;"></center>
		        </div>
		      </div>
		    </div>
		  </div>

		  <div class="modal fade" id="mapModal" role="dialog">
		    <div class="modal-dialog" style="width:50%;">
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		        </div>
		        <div class="modal-body">
		          	<div id="picmap">
		          	</div>
		        </div>
		      </div>
		    </div>
		  </div>

		  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWbvEFC7jCLWK1dheHGWGkqksGaA5JXy0&callback=tmpMap"></script>
			<script>
				function viewMap(i){
					
						$('#mapModal').modal('show');
					
					setTimeout(function(){
						initMaps(i);
					},1000);

				}

				function tmpMap(){
					console.log(1);
				}

				function initMaps(i) {

				  var datas = {
				  	id : i
				  };

				  $.getJSON(serverip+"getPictureCoordinates",datas,function(a){

				  	  var reportedxy = {lat: a[0].xcoordinate, lng: a[0].ycoordinate};
					  var map = new google.maps.Map(document.getElementById('picmap'), {
					    zoom: 16,
					    center: reportedxy
					  });

					  var contentString =   '<div class="col-md-12 col-sm-12 col-xs-12">'+
								              '<div class="x_panel tile">'+
								                '<div class="x_title red"><center><h5><strong>Disaster Report Image</strong></h5></center>'+
								                '</div>'+
								                '<div class="x-content" style="margin-top:-20px">'+
								                  '<div class="dashboard-widget-content" style="text-align:justify;">'+
								                    '<table class="table table-responsive table-hover table-striped">'+
								                    	'<thead>'+
								                    		'<tr>'+
								                    			'<th colspan="2"><center><img src="assets/drr_app/upload/'+a[0].pics+'" class="img img-circle" style="width:150px; height: 150px"></center></th>'+
								                    		'</tr>'+
								                    		'<tr>'+
								                    			'<th>Description</th>'+
								                    			'<th>'+a[0].description+'</th>'+
								                    			'<tr>'+
								                    		'</tr>'+
								                    		'<tr>'+
								                    			'<tr>'+
								                    			'<th>Province</th>'+
								                    			'<th>'+a[0].province_name+'</th>'+
								                    		'</tr>'+
								                    		'<tr>'+
								                    			'<tr>'+
								                    			'<th>City/Municipality</th>'+
								                    			'<th>'+a[0].municipality_name+'</th>'+
								                    		'</tr>'+
								                    		'<tr>'+
								                    			'<tr>'+
								                    			'<th>Barangay Located</th>'+
								                    			'<th>'+a[0].brgy_located+'</th>'+
								                    		'</tr>'+
								                    		'<tr>'+
								                    			'<tr>'+
								                    			'<th>Date/Time</th>'+
								                    			'<th>'+todate(a[0].ddate)+' @ '+a[0].dtime+'</th>'+
								                    		'</tr>'+
								                    	'</thead>'+
								                    '</table>'+
								                  '</div>'+
								                '</div>'+
								              '</div>'+
								            '</div>';

					  var infowindow = new google.maps.InfoWindow({
					    content: contentString
					  });

					  var marker = new google.maps.Marker({
					    position: reportedxy,
					    map: map
					  });

					  marker.addListener('click', function() {
					    infowindow.open(map, marker);
					  });

				  })
				}

			</script>
	</div>
</div>