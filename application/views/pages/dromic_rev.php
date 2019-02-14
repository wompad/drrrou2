

<div class="row">
	<ul class="nav nav-tabs">
		<!-- <iframe class="doc" src="https://docs.google.com/gview?url=http://writing.engr.psu.edu/workbooks/formal_report_template.doc&embedded=true"></iframe> -->
	  <!-- <li class="active"><a data-toggle="tab" class="btn btn-sm btn-success tabpill" href="#narrative" style="border-radius:0px; color:#272822">Narrative Report</a></li> -->
	  
	  <li class="active"><a data-toggle="tab" class="btn btn-sm btn-danger tabpill" href="#home" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px" id="toexcel1">Form 1 (Main Report - F1)</a></li>
	  <li><a data-toggle="tab" href="#home2" class="btn btn-sm btn-danger tabpill" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px" id="toexcel2">Form 1.2 (Damages and Assistance - F2)</a></li>
	  <li class="dropdown">
	  		<a class="dropdown-toggle btn btn-sm btn-danger" data-toggle="dropdown" href="#" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px">  Status of Displacement <b class="caret"></b></a>
	  		<ul class="dropdown-menu">
	            	 <li ><a data-toggle="tab" href="#evacuation_stats" id="toexcel3">Form 2 - (Evacuations - F3)</a></li>
	            	 <li ><a data-toggle="tab" href="#evacuation_stats_outside" id="toexcel4">Form 3 (Outside Evacuations - F4)</a></li>
				     <li><a id="viewcharts" data-toggle="tab">EC Sex Disaggregated Data </a></li>
				     <li><a data-toggle="tab"> EC Facilities </a></li>
	        </ul>
	  </li>
	  <!-- <li><a data-toggle="tab" href="#evacuation_stats" class="btn btn-sm btn-danger tabpill" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px" >Form 2 (Evacuations - F3)</a></li> -->
	  
	  <!-- <li><a data-toggle="tab" href="#evacuation_stats_outside" class="btn btn-sm btn-danger tabpill" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px" id="toexcel4">Form 3 (Outside Evacuations - F4)</a></li> -->
	  <li><a data-toggle="tab" href="#casualties" class="btn btn-sm btn-danger tabpill" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px" id="toexcel5">Form 4 (Casualties - F5)</a></li>
	  <li><a data-toggle="tab" href="#sex_disaggregation" class="btn btn-sm btn-danger tabpill" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px" id="toexcel8">Form 5 (EC Sex Disaggregation - F3)</a></li>
	  <li><a data-toggle="tab" href="#damagesperbrgy" class="btn btn-sm btn-danger tabpill" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px" id="toexcel7">Damages and Assistance per Barangay - F7</a></li>

	  <?php if($_SESSION['isdswd'] == 't'){ ?>
	  	<li><a data-toggle="tab" href="#assistance" class="btn btn-sm btn-danger tabpill" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px" id="toexcel6">Food and Non-Food Assistance - F6</a></li>
	  <?php } ?>

	  <li class="dropdown">
	  		<a class="dropdown-toggle btn btn-sm btn-danger" data-toggle="dropdown" href="#" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px"> <span class="fa fa-wrench"></span> Chart and Tools <b class="caret"></b></a>
	  		<ul class="dropdown-menu">
	            <?php if($_SESSION['can_create_report'] == 't'){ ?> <li ><a id="addnarrativebtn"> <span class="fa fa-file-word-o"></span> Attach Narrative Report</a></li> <?php } ?>
				     <li><a id="viewcharts" data-toggle="tab" href="#viewchart"> <span class="fa fa-bar-chart"></span> Chart of Affected LGUs </a></li>
				     <li><a data-toggle="tab" href="#narrative"> <span class="fa fa-newspaper-o"></span> View Narrative Report </a></li>
				     <li><a id="disaster_map" data-toggle="tab" href="#disastermap"> <span class="fa fa-map"></span> Disaster Map</a></li>
	        </ul>
	  </li>
	  <!-- <li><a data-toggle="tab" href="#viewchart" class="btn btn-sm btn-danger tabpill" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px"><i class="fa fa-bar-chart"></i> Chart</a></li> -->
	  <!-- <li><a data-toggle="tab" class="btn btn-sm btn-danger tabpill" href="#narrative" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px"> <span class="fa fa-file-word-o"></span> View Narrative Report</a></li> -->

	  <!-- <li><a data-toggle="tab" href="#disastermap" class="btn btn-sm btn-danger tabpill" style="border-radius:0px; color:#fff; border-radius: 5px; padding: 5px; font-size: 11px" id="disaster_map">Disaster Map</a></li> -->
	  
	</ul>
	<!-- <div class="pull-right" style="margin-top:-50px;" id="loader">
		<img src="<?php echo base_url();?>assets/images/spin.gif" style='width:45px; height:45px'> <b>Please wait while loading data...</b>
		<div class="loader"></div>
	</div> -->
	<div style="left:50%; top:45%; position:fixed; z-index:99999; background-color:#304456; padding-top:20px; padding-bottom:20px; padding-left:50px; padding-right:45px; border-radius:5px; color:#fff" id="loader">
    <center><div class="loader"></div></center>
    Loading data...
  	</div>
	<div class="tab-content">
		<br>
		<div class="form-group col-md-12" style="margin-left: -10px">
			<div class="btn-group" style="border-radius: 5px">
			  	<button style="border-radius: 5px; margin-right: 5px" type="button" class="btn btn-success btn-xs" id="saveasnewrecord"><i class="fa fa-plus-circle"></i> Save as new Record and Update Data (Ctrl+S)</button>
			  	<div class="btn-group" style="margin-right: 5px" id="addfamiecs">
				   <button style="border-radius: 5px" type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
				   <span class="fa fa-plus-circle"></span> Add Affected Families Inside EC<span class="caret"></span></button>
				   <ul class="dropdown-menu" role="menu" style="margin-top:7px">
				     
				     <li><a id="addfamiec"> Add Affected Families Inside EC (Ctrl+I)  </a></li>
				     <li><a id="addfamiecprofile" onclick="msgbox('Currently under development :-)')"> Add Sex Disaggregation to EC Data  </a></li>
				     <li><a id="addfamiecprofile" onclick="msgbox('Currently under development :-)')"> Add Facilities to EC Data  </a></li>
				     <!-- <li><a id="printbtn"> <span class="fa fa-print"></span> Print (Ctrl+P) </a></li> -->
				   </ul>
				</div>
				<button style="border-radius: 5px; margin-right: 5px" type="button" class="btn btn-primary btn-xs" id="adddamass"><i class="fa fa-plus-circle"></i> Add Damages and Cost of Assistance [P/MLGU] (Ctrl+D)</button>
				<button style="border-radius: 5px; margin-right: 5px" type="button" class="btn btn-primary btn-xs" id="addfamoec"><i class="fa fa-plus-circle"></i> Add Affected Families Outside EC (Ctrl+Q)</button>
				<button style="border-radius: 5px; margin-right: 5px" type="button" class="btn btn-danger btn-xs" id="addcasualtybtn"><i class="fa fa-plus-circle"></i> Add Casualties (Ctrl+X)</button>
				<button style="border-radius: 5px; margin-right: 5px" type="button" class="btn btn-default btn-xs" id="exporttoexcel"><label style="border-radius: 5px; border:1px solid #006400; position:absolute; width:30px; height:37px; margin-top:-9px; margin-left:-3px; background-color:#006400; color:#fff;"><i class="fa fa-file-excel-o" style="margin-top:11px; margin-left:3px; cursor:pointer"></i></label>          Export to Excel (Ctrl+E)
				</button>
				<button style="border-radius: 5px; margin-right: 5px" type="button" class="btn btn-primary btn-xs" id="addCommentsbtn"><i class="fa fa-sticky-note"></i> Discussions <span class="badge badge-primary" id="commentcounter"></span> </button>
				<!-- <div class="btn-group">
				   <button style="border-radius: 5px" type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
				   <span class="fa fa-wrench"></span> Tools and Discussions <span class="caret"></span></button>
				   <ul class="dropdown-menu" role="menu">
				     
				     <li><a id="addCommentsbtn"> <span class="fa fa-sticky-note"></span> Discussions <span class="badge badge-primary" id="commentcounter"></span> </a></li> -->
				     <!-- <li><a id="printbtn"> <span class="fa fa-print"></span> Print (Ctrl+P) </a></li> -->
				   <!-- </ul>
				</div> -->
			</div>
		</div>

<!-- 		<div class="form-group col-md-12" style="margin-left: -10px">
			<button style="border-radius: 5px" type="button" class="btn btn-success btn-xs" id="saveasnewrecord"><i class="fa fa-plus-circle"></i> Save as new Record and Update Data (Ctrl+S)</button>
			<button style="border-radius: 5px" type="button" class="btn btn-primary btn-xs" id="addfamiec"><i class="fa fa-plus-circle"></i> Add Affected Families Inside EC (Ctrl+I)</button>
			<button style="border-radius: 5px" type="button" class="btn btn-primary btn-xs" id="adddamass"><i class="fa fa-plus-circle"></i> Add Damages and Cost of Assistance [P/MLGU] (Ctrl+D)</button>
			<button style="border-radius: 5px" type="button" class="btn btn-primary btn-xs" id="addfamoec"><i class="fa fa-plus-circle"></i> Add Affected Families Outside EC (Ctrl+Q)</button>
			<button style="border-radius: 5px" type="button" class="btn btn-danger btn-xs" id="addcasualtybtn"><i class="fa fa-plus-circle"></i> Add Casualties (Ctrl+X)</button>
			<button style="border-radius: 5px" type="button" class="btn btn-default btn-xs" id="exporttoexcel"><label style="border-radius: 5px; border:1px solid #006400; position:absolute; width:30px; height:37px; margin-top:-9px; margin-left:-3px; background-color:#006400; color:#fff;"><i class="fa fa-file-excel-o" style="margin-top:11px; margin-left:3px; cursor:pointer"></i></label>          Export to Excel (Ctrl+E)
			</button>
			<button style="border-radius: 5px" type="button" class="btn btn-danger btn-xs" id="addCommentsbtn"><i class="fa fa-sticky-note"></i> Discussions <span class="badge badge-primary" id="commentcounter"> </span></button>
			<div class="dropdown pull-right">
			  <button class="btn btn-xs btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="border-radius: 5px"> <span class="fa fa-wrench"></span> Tools
			  <span class="caret"></span></button>
			  <ul class="dropdown-menu">
			    <li><a href="#"> <span class="fa fa-file-word-o"></span> Attach Narrative Report</a></li>
			  </ul>
			</div>
			<div class="dropdown pull-right"> -->
				<!-- <div class="nav_menu" style="background-color:#F7F7F7; color:#F7F7F7; padding:0px; height:40px">
		            <nav>
		              <ul class="nav navbar-nav navbar-right" style="margin-top:-10px;">
		                <li role="presentation" class="dropdown" style="height:50px">
		                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="height:50px; color:gray">
		                    <i class="fa fa-warning" style="color:gray"></i> <span class="badge bg-red" id="bub_count_issues">0</span>
		                    Issues Found
		                  </a>
		                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" id="issuesfound">
		                  </ul>
		                </li>
		              </ul>
		            </nav>
	            </div> -->
			<!-- </div> -->
	  <div id="sex_disaggregation" class="tab-pane fade">
	  	<div class="col-sm-12" id="dmap" style="font-size:30px">
	  		CURRENTLY UNDER DEVELOPMENT :-)
	  	</div>
	  </div>
	  <div id="disastermap" class="tab-pane fade">
	  	<center>
		  	<div class="col-sm-12" id="dmap" style="font-size:30px">
		  		<div id="mapid" style="width:100%; height: 1000px"></div>
		  	</div>
		</center>
	  </div>
	  <div id="narrative" class="tab-pane fade">
	  	<iframe src="" style="width: 100%; height: 1500px; border: 0px; background-color: #F7F7F7; margin-top: 20px" id="frame_narrative_report"></iframe>
	  </div>
	  <div id="home" class="tab-pane fade in active">
	  		<!-- <div class="col-md-8" style="color:#000; font-weight: bold; margin-top: 10px; font-size: 15px">
	  			<label class="green">Report notes:</label> <br>
	  			<label class="red" style="font-size:13px">
	  				1.) The number of reported totally damaged houses in the municipality of Gigaquit, Surigao del Norte increased from 63 to 64 since one of the
	  				households was mistakenly counted as partially damaged, this results to the decrease in the number of partially damaged houses from 211 to 210. <br>
	  				2.) The number of reported totally damaged houses in the municipality of Alegria, Surigao del Norte decrease from 50 to 49 since the MSWDO of Alegria, Surigao del Norte
	  				forwarded and submitted their final masterlist of the totally and partially damaged houses.<br>
	  				3.) The number of reported totally damaged houses in the municipality of Cantilan, Surigao del Sur decrease from 4 to 3 since the MSWDO of Cantilan, Surigao del Sur
	  				forwarded and submitted their final masterlist of the totally and partially damaged houses.
	  			</label>
	  		</div> -->
	  		<div class="col-md-4 pull-right" style="color:#000; font-weight: bold; margin-top: 10px; font-size: 15px">
	  				Number of affected municipalities: <label id="count_allmunis"></label><br>
	  				Number of affected cities: <label id="count_allcity"></label>
	  		</div>
	    	<div class="col-md-12" style="border:1px solid gray;" id="tbl_masterquery_rev">
		    	<table style="width:100%;" id="tbl_masterquery_revs">
		    		<thead>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:center; font-weight:lighter; color: #000" colspan="26">Department of Social Welfare and Development</th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:center; color: #000" colspan="26"><b>DISASTER RESPONSE, OPERATIONS, MONITORING AND INFORMATION CENTER</b></th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:center; font-weight:lighter; color: #000" colspan="26">Batasan Pambansa Complex, Constitution Hills</th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:center; font-weight:lighter; color: #000" colspan="26">Quezon City</th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:center; font-weight:lighter; color: #000" colspan="26"><br></th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:center; color: #000" colspan="26"><b>STATUS OF DISASTER OPERATIONS</b></th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:center; font-weight:lighter; color: #000" id="asofdate" colspan="26">As of: </th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:center; font-weight:lighter; color: #000" id="asoftime" colspan="26">Time: </th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:left; font-weight:lighter; color: #000" colspan="26">Region:<b> CARAGA </b> </th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:left; font-weight:lighter; color: #000" id="disastertype" colspan="26"></th>
		    			</tr>
		    			<tr>
		    				<th style="vertical-align: middle; text-align:left; font-weight:lighter; color: #000" id="disasterdate" colspan="26"></th>
		    			</tr>
		    			<tr>
							<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000">
								<b>AFFECTED AREAS</b>
							</td>
							<td rowspan="5" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000;">
								<b>EVACUATION CENTERS</b>
							</td>
							<td rowspan="4" colspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000">
								<b>NUMBER OF AFFECTED</b>
							</td>
							<td rowspan="4" colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000">
								<b>NUMBER OF ECs</b>
							</td>
						</tr>
						<tr>
							<td colspan="12" rowspan="1" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000">
								<b>TOTAL NUMBER SERVED</b>
							</td>
							<td rowspan="3" colspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000; padding:0px">
								<b>NO. OF DAMAGED HOUSES</b>
							</td>
							<td rowspan="3" colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000">
								<b>TOTAL COST OF ASSISTANCE (PhP)</b>
							</td>
						</tr>
						<tr>
							<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000">
								<b>INSIDE EC</b>
							</td>
							<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000">
								<b>OUTSIDE EC</b>
							</td>
							<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #808080; color: #000">
								<b>TOTAL SERVED</b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="vertical-align: middle; text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Families </td>
							<td colspan="2" style="vertical-align: middle; text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Persons </td>
							<td colspan="2" style="vertical-align: middle; text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Families </td>
							<td colspan="2" style="vertical-align: middle; text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Persons </td>
							<td colspan="2" style="vertical-align: middle; text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Families </td>
							<td colspan="2" style="vertical-align: middle; text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Persons </td>
						</tr>
						
						<tr>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> (Province/City/Municipality) </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Brgys. </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Families </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Persons </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Cum </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Now </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Cum </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Now </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Cum </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Now </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Cum </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Now </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Cum </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Now </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Cum </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Now </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Cum </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Now </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Total </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Totally </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> Partially </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> DSWD </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> LGU </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> NGOs/OTHERS </td>
							<td style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> GRAND TOTAL </td>
						</tr>
						<tr>
							<td style="background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000">
							   <b>CARAGA</b>
							</td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000"></td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalbrgy"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalfamily"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalperson"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalec_cum"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalec_now"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalinsideec_fam_cum"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalinsideec_fam_now"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalinsideec_person_cum"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalinsideec_person_now"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totaloutisideec_fam_cum"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totaloutisideec_fam_now"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totaloutsideec_person_cum"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totaloutsideec_person_now"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalserved_fam_cum"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalserved_fam_now"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalserved_person_cum"> </td>
							<td style="text-align:center; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="totalserved_person_now"> </td>
							<td style="text-align: right; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="tott_damaged"> </td>
							<td style="text-align: right; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="tot_damaged"> </td>
							<td style="text-align: right; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="part_damaged"> </td>
							<td style="text-align: right; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="tdswd_asst"> </td>
							<td style="text-align: right; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="tlgu_asst"> </td>
							<td style="text-align: right; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="tngo_asst"> </td>
							<td style="text-align: right; font-weight:bold; background-color:red; color:#fff; border:1px solid #000; background-color: #A6A6A6; color: #000" id="ttotal_asst"> </td>
						</tr>
						<tr>
							<td colspan="26" style="border: 1px solid #000"> 
							</td>
						</tr>
		    		</thead>
		    		<tbody>
		    		</tbody>
		    		<tfoot>
						<tr>
							<td colspan="26" style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> *** NOTHING FOLLOWS ***</td>
						</tr>
						<tr>
		    				<th style="text-align:center; font-weight:lighter" colspan="26"> </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="6">Prepared by: </th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="10">Noted by: </th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="10">Approved by: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter" colspan="26"> </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="6" id="spreparedby"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="10" id="srecommendedby"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="10" id="sapprovedby"></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="6" id="spreparedbypos"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="10" id="srecommendedbypos"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="10" id="sapprovedbypos"></th>
		    			</tr>
					</tfoot>
		    	</table>
		    </div>
	  </div>
	  <div id="menu1" class="tab-pane fade">
	    <h3>Menu 1</h3>
	    <p>Some content in menu 1.</p>
	  </div>
	  <div id="evacuation_stats" class="tab-pane fade">
	  	<div class="col-md-12" style="margin-top:10px"><label><i class="fa fa-info-circle"></i> Reminders: Double click each entry to update/edit.</label></div>
	  	<div class="col-md-3 pull-right" id="count_ec" style="font-weight:bold; font-size: 15px">

	  	</div>
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	<div class="col-md-12" id="tbl_evac_stats" style="border:1px solid gray">
	    		<table style="width:100%;">
		    		<thead>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" colspan="11">Department of Social Welfare and Development</th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; color: #000" colspan="11"><b>DISASTER RESPONSE, OPERATIONS, MONITORING AND INFORMATION CENTER</b></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" colspan="11">Batasan Pambansa Complex, Constitution Hills</th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" colspan="11">Quezon City</th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" colspan="11"><br></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; color: #000" colspan="11"><b>STATUS OF EVACUATION CENTERS</b></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" id="asofdate_IEC" colspan="11">As of: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" id="asoftime_IEC" colspan="11">Time: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:left; font-weight:lighter; color: #000" colspan="11">Region:<b> CARAGA </b> </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:left; font-weight:lighter; color: #000" id="disastertype_IEC" colspan="11"></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:left; font-weight:lighter; color: #000" id="disasterdate_IEC" colspan="11"></th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    		</tbody>
		    	</table>
		  		<table style="width:100%" id="evac_stats">
		  			<thead>
		  				<tr>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000" rowspan="3">PLACE OF EVACUATION CENTER<br>Province/City/Municipality</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000" rowspan="2" colspan="2">No of ECs'</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000" rowspan="3">BRGY LOCATED (EC)</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000" rowspan="3">NAME OF EVACUATION CENTER</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000" colspan="4">NUMBER SERVED</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000" rowspan="3">BRGY LOCATED (EVACUEES)</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000" rowspan="3">STATUS OF EC<br>(Newly-Opened/Re-opened/<br>Activated/Existing/Closed)</th>
		  				</tr>
		  				<tr>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000" colspan="2">Families</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000" colspan="2">Persons</th>
		  				</tr>
		  				<tr>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000">Cum</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000">Now</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000">Cum</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000">Now</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000">Cum</th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px; background-color: #808080; color: #000">Now</th>
		  				</tr>		
		  			</thead>
		  			<tbody>
		  				<tr style="background-color:red; color:#fff">
		  					<th style="border: 1px solid #000; text-align:left; padding:2px;"><b>CARAGA</b></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px" id="caraga_ec_cum"></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px" id="caraga_ec_now"></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px"></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px" id="caraga_fam_cum"></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px" id="caraga_fam_now"></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px" id="caraga_per_cum"></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px" id="caraga_per_now"></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px"></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px"></th>
		  					<th style="border: 1px solid #000; text-align:center; padding:2px"></th>
		  				</tr>
		  			</tbody>
		  			<tfoot>
						<tr>
							<td colspan="11" style="color: #000"><center><strong>**** NOTHING FOLLOWS ****</strong></center></td>
						</tr>
						<tr>
		    				<th style="text-align:center; font-weight:lighter" colspan="11"> </th>
		    			</tr>
						<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3">Prepared by: </th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3">Noted by: </th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="5">Approved by: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" colspan="11"> </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3" id="spreparedby2"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3" id="srecommendedby2"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="5" id="sapprovedby2"></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3" id="spreparedbypos2"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3" id="srecommendedbypos2"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="5" id="sapprovedbypos2"></th>
		    			</tr>
					</tfoot>
		  		</table>
		  	</div>	
	  	</div>
	  </div>
	  <div id="evacuation_stats_outside" class="tab-pane fade">
	  	<br>
	  	<div class="col-md-12" style="margin-top:10px"><label><i class="fa fa-info-circle"></i> Reminders: Double click each entry to update/edit.</label></div>
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:1px solid gray;" id="tbl_evacuation_stats_outside">
		    <table style="width:100%;">
	    		<thead>
	    			<tr>
	    				<th colspan="7" style="text-align:center; font-weight:lighter">Department of Social Welfare and Development</th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:center;"><b>DISASTER RESPONSE, OPERATIONS, MONITORING AND INFORMATION CENTER</b></th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:center; font-weight:lighter">Batasan Pambansa Complex, Constitution Hills</th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:center; font-weight:lighter">Quezon City</th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:center; font-weight:lighter"><br></th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:center;"><b>STATUS OF OUTSIDE EVACUATION CENTERS</b></th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:center; font-weight:lighter" id="asofdate_OEC">As of: </th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:center; font-weight:lighter" id="asoftime_OEC">Time: </th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:left; font-weight:lighter">Region:<b> CARAGA </b> </th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:left; font-weight:lighter" id="disastertype_OEC"></th>
	    			</tr>
	    			<tr>
	    				<th colspan="7" style="text-align:left; font-weight:lighter" id="disasterdate_OEC"></th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    		</tbody>
	    	</table>
	  		<table style="width:100%" id="evac_stats_outside">
	  			<thead>
	  				<tr>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px; width:30%" rowspan="3">HOST LGU<br>Province/City/Municipality</th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" rowspan="3">BARANGAY</th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" colspan="4">NUMBER SERVED</th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" rowspan="3">PLACE OF ORIGIN</th>
	  				</tr>
	  				<tr>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" colspan="2">Families</th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" colspan="2">Persons</th>
	  				</tr>
	  				<tr>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px">Cum</th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px">Now</th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px">Cum</th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px">Now</th>
	  				</tr>		
	  			</thead>
	  			<tbody>
	  				<tr style="background-color:red; color:#fff">
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:left; padding:2px;"><b>CARAGA</b></th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" id="caraga_brgy_num_o"></th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" id="caraga_fam_cum_o"></th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" id="caraga_fam_now_o"></th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" id="caraga_per_cum_o"></th>
	  					<th style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px" id="caraga_per_now_o"></th>
	  				</tr>
	  			</tbody>
	  			<tfoot>
					<tr>
						<th colspan="7" style="background-color: #808080; color: #000; border:1px solid #000; text-align:center; padding:2px;"> <center>*** NOTHING FOLLOWS ***</center></th>
					</tr>
		    		<tr>
	    				<th style="text-align:center; font-weight:lighter" colspan="7"> </th>
	    			</tr>
					<tr>
	    				<th style="text-align:center; font-weight:bolder" colspan="1">Prepared by: </th>
	    				<th style="text-align:center; font-weight:bolder" colspan="3">Noted by: </th>
	    				<th style="text-align:center; font-weight:bolder" colspan="3">Approved by: </th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center; font-weight:lighter" colspan="7"> </th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center; font-weight:bolder" colspan="1" id="spreparedby3"></th>
	    				<th style="text-align:center; font-weight:bolder" colspan="3" id="srecommendedby3"></th>
	    				<th style="text-align:center; font-weight:bolder" colspan="3" id="sapprovedby3"></th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center; font-weight:bolder" colspan="1" id="spreparedbypos3"></th>
	    				<th style="text-align:center; font-weight:bolder" colspan="3" id="srecommendedbypos3"></th>
	    				<th style="text-align:center; font-weight:bolder" colspan="3" id="sapprovedbypos3"></th>
	    			</tr>
				</tfoot>
	  		</table>	
	  	</div>
	  </div>
	  <div id="casualties" class="tab-pane fade">
	  	<br>
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:40px">
	  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:1px solid gray;" id="tbl_ccasualties">
			    <table style="width:100%;">
		    		<thead>
		    			<tr>
		    				<th colspan="13" style="text-align:center; font-weight:lighter; color: #000">Department of Social Welfare and Development</th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:center; color: #000"><b>DISASTER RESPONSE, OPERATIONS, MONITORING AND INFORMATION CENTER</b></th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:center; font-weight:lighter; color: #000">Batasan Pambansa Complex, Constitution Hills</th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:center; font-weight:lighter; color: #000">Quezon City</th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:center; font-weight:lighter; color: #000"><br></th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:center; color: #000"><b>MASTERLIST OF CASUALTIES</b></th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:center; font-weight:lighter; color: #000" id="asofdate_CEC">As of: </th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:center; font-weight:lighter; color: #000" id="asoftime_CEC">Time: </th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:left; font-weight:lighter; color: #000">Region:<b> CARAGA </b> </th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:left; font-weight:lighter; color: #000" id="disastertype_CEC"></th>
		    			</tr>
		    			<tr>
		    				<th colspan="13" style="text-align:left; font-weight:lighter; color: #000" id="disasterdate_CEC"></th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    		</tbody>
		    	</table>
		    	<table style="width:100%;" id="tbl_casualties">
		    		<thead>
		    			<tr>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000" rowspan="2">No.</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000" colspan="3">NAME</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000" rowspan="2">AGE</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000" rowspan="2">SEX</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000" colspan="3">ADDRESS</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000" colspan="3">CASUALTIES</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000" rowspan="2">REMARKS</th>
		    			</tr>
		    			<tr>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">LASTNAME</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">FIRSTNAME</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">M.I.</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">PROVINCE</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">CITY/MUNICIPALITY</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">BARANGAY</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">DEAD</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">MISSING</th>
		    				<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">INJURED</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    		</tbody>
		    		<tfoot>
						<tr>
							<th colspan="13" style="border: 1px solid #000; background-color: #808080; color: #000"> <center>*** NOTHING FOLLOWS ***</center></th>
						</tr>
			    		<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" colspan="13"> </th>
		    			</tr>
						<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="4">Prepared by: </th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="4">Noted by: </th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="5">Approved by: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" colspan="13"> </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="4" id="spreparedby4"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="4" id="srecommendedby4"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="5" id="sapprovedby4"></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="4" id="spreparedbypos4"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="4" id="srecommendedbypos4"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="5" id="sapprovedbypos4"></th>
		    			</tr>
					</tfoot>
		    	</table>
	    	</div>	
	  	</div>
	  </div>
	 <div id="home2" class="tab-pane fade">
	 		<div class="col-md-12" style="margin-top:10px"><label><i class="fa fa-info-circle"></i> Reminders: Double click each entry to update/edit.</label></div>
	    	<div class="col-md-12" style="border:1px solid gray;" id="tbl_damage_assistance">
		    	<table style="width:100%;">
		    		<thead>
		    			<tr>
		    				<th colspan="10" style="text-align:center; font-weight:lighter; color: #000">Department of Social Welfare and Development</th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:center; color: #000"><b>DISASTER RESPONSE, OPERATIONS, MONITORING AND INFORMATION CENTER</b></th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:center; font-weight:lighter; color: #000">Batasan Pambansa Complex, Constitution Hills</th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:center; font-weight:lighter; color: #000">Quezon City</th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:center; font-weight:lighter; color: #000"><br></th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:center; color: #000"><b>STATUS OF DAMAGES AND COST OF ASSISTANCE</b></th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:center; font-weight:lighter; color: #000" id="asofdate2">As of: </th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:center; font-weight:lighter; color: #000" id="asoftime2">Time: </th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:left; font-weight:lighter; color: #000">Region:<b> CARAGA </b> </th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:left; font-weight:lighter; color: #000" id="disastertype2"></th>
		    			</tr>
		    			<tr>
		    				<th colspan="10" style="text-align:left; font-weight:lighter; color: #000" id="disasterdate2"></th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<table style="width:100%;" id="tbl_casualty_asst">
		    				<thead>
		    					<tr>
		    						<th rowspan="3" style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">AFFECTED AREAS <br>(Province/City/Municipality/Barangay)</th>
		    						<th colspan="5" style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">NUMBER OF</th>
		    						<th rowspan="2" colspan="4" style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">COST OF ASSISTANCE</th>
		    					</tr>
		    					<tr>
		    						<th colspan="2" style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">DAMAGED HOUSES</th>
		    						<th colspan="3" style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">CASUALTIES</th>
		    					</tr>
		    					<tr>
		    						<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">TOTALLY</th>
		    						<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">PARTIALLY</th>
		    						<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">DEAD</th>
		    						<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">INJURED</th>
		    						<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">MISSING</th>
		    						<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">TOTAL</th>
		    						<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">DSWD</th>
		    						<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">LGUs</th>
		    						<th style="border:1px solid #000; text-align:center; background-color: #808080; color: #000">NGOs/OTHER GOs</th>
		    					</tr>
		    				</thead>
		    				<tbody>
		    				</tbody>
		    				<tfoot>
								<tr>
									<th colspan="10" style="border:1px solid #000; background-color: #808080; color: #000"> <center>*** NOTHING FOLLOWS ***</center></th>
								</tr>
					    		<tr>
				    				<th style="text-align:center; font-weight:lighter; color: #000" colspan="10"> </th>
				    			</tr>
								<tr>
				    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3">Prepared by: </th>
				    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3">Noted by: </th>
				    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="4">Approved by: </th>
				    			</tr>
				    			<tr>
				    				<th style="text-align:center; font-weight:lighter; color: #000" colspan="10"> </th>
				    			</tr>
				    			<tr>
				    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3" id="spreparedby5"></th>
				    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3" id="srecommendedby5"></th>
				    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="4" id="sapprovedby5"></th>
				    			</tr>
				    			<tr>
				    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3" id="spreparedbypos5"></th>
				    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="3" id="srecommendedbypos5"></th>
				    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="4" id="sapprovedbypos5"></th>
				    			</tr>
							</tfoot>
		    			</table>
		    		</tbody>
		    	</table>
		    </div>
	 </div>
	 <div id="assistance" class="tab-pane fade">
	 		<div class="col-md-12" style="margin-top:10px"><label><i class="fa fa-info-circle"></i> Reminders: Double click each entry to update/edit.</label></div>
	    	<div class="col-md-12">
		    	<div class="col-md-5 bg-white">
		    		<div class="x_panel">
		    			<div class="x-title green"><h2><strong>DSWD Food and Non-Food Assistance to LGU</strong></h2></div>
		                <div class="clearfix"></div>
		                <div class="x-content">
		                  <div class="dashboard-widget-content" style="text-align:justify">
		                    <div class="col-md-12 form-group">
	                    		<select class="form-control" id="provinceAssistance">
			              			<option value="">--- Select Province ---</option>
			              		</select>
		                    </div>
		                    <div class="form-group col-md-12">
			              		<select class="form-control" id="cityAssistance">
			              			<option value="">-- Select City/Municipality --</option>
			              		</select>
			              	</div>
			              	<div class="col-md-6 xdisplay_inputx form-group has-feedback">
		      					<label> Augmentation Date </label>
                                <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="Augmentation Date" aria-describedby="inputSuccess2Status3">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                            </div>
                            <div class="col-md-6">
                            	<label> Number of families served </label>
                            	<input type="number" class="form-control" id="families_served" min="1" placeholder="Number of families served">
                            </div>
			              	<table class="table table-responsive col-md-12" id="tbl_ch_assistance">
		      					<tbody>
		      						<tr>
		      							<td colspan="4">
		      								<center><strong>---- Select Food and Non-Food Assistance ----</strong></center>
		      							</td>
		      						</tr>
		      						<tr>
		      							<td style="width:50%">
		      								<div class="form-group col-md-12">
							              		<input type="text" class="form-control" id="fnfiassistance" name="fnfiassistance" placeholder="Food and Non-Food">
							              	</div>
		      							</td>
		      							<td>
		      								<div class="form-group col-md-12">
							              		<input type="number" id="fnficost" class="form-control" placeholder="Cost" min="1">
							              	</div>
		      							</td>
		      							<td>
		      								<div class="form-group col-md-12">
							              		<input type="number" id="fnfiquantity" class="form-control" placeholder="Quantity" min="1">
							              	</div>
		      							</td>
		      							<td style="vertical-align:middle"> <button type="button" class="btn btn-primary btn-xs" id="addasstfnfi"><span class="fa fa-plus-circle"></button> </td>
		      						</tr> 
		      					</tbody>
		      				</table>
		      				<table class="table table-responsive col-md-12" id="tbl_assistance_list" style="margin-top:-35px">
		      					<thead>
		      						<tr>
		      							<td colspan="4">
		      								<center><strong>List of Food and Non-Food Assistance to be provided...</strong></center>
		      							</td>
		      						</tr>
		      						<tr>
		      							<th style="width:50%">
		      								Item
		      							</th>
		      							<th style="width:15%">
		      								Cost
		      							</th>
		      							<th style="width:15%; text-align:right">
		      								Quantity
		      							</th>
		      							<th style="width:15%; text-align:right">
		      								Sub-total
		      							</th>
		      							<td style="width:5%"> </td>
		      						</tr>
		      					</thead>
		      					<tbody>
		      					</tbody>
		      					<tfoot>
		      						<tr>
		      							<th style="width:50%; font-size:20px; text-align:left"> Total </th> 
		      							<th colspan="3" style="font-size:20px; text-align:right">
		      								₱ <span id="fnfi_running_total">0</span>
		      							</th>
		      							<th> </th>
		      						</tr>
		      					</tfoot>
		      				</table>
		      				<div class="form-group col-md-12">
		      					<textarea class="form-control" placeholder="Remarks" id="fnfi_remarks"></textarea>
		      				</div>
		      				<!-- <div class="form-group col-md-12">
		      					<input type="radio" class="flat" name="isfoaugmentation"> FO-Caraga Augmentation
		      					<input type="radio" class="flat" name="isfoaugmentation"> Other Region Augmentation
		      				</div> -->
		      				<div class="form-group col-md-12">
		      					<button type="button" class="btn btn-success pull-right btn-sm" id="saveassistance"> <i class="fa fa-plus-circle"></i> Save Assistance </button>
		      				</div>
		                  </div>
		                </div>
		    		</div>
		    	</div>
		    	<div class="col-md-7 bg-white">
		    		<br>
		    		<div class="pull-right">
		    				<label style="font-size:15px">Total Number of Family Food Packs Augmented: <span id="totffps"> </span> </label><br>
		    				<label style="font-size:15px">Total Amount of Family Food Packs Augmented: <span id="amtffps"> </span> </label><br>
		    				<label style="font-size:15px">Total Amount of Other Food and Non-Food Items: <span id="amtnfi"> </span> </label>
		    		</div>
		    		<br>
		    		<div class="x_panel">
		    			<div class="x-title green"><h2><strong>LGUs Provided with Food and Non-Food Asssitance</strong></h2></div>
		                <div class="clearfix"></div>
		                <div class="x-content">
		                  <div class="dashboard-widget-content" style="text-align:justify">
		                  		<table class="table table-responsive table-hover table-striped" id="lgu_list_assistance">
		                  			<thead>
		                  				<tr>
			                  				<th> Province/City/Municipality </th>
			                  				<th> Food and Non-Food Assistance </th>
			                  				<th style="text-align:right"> Quantity</th>
			                  				<th> Date Augmented </th>
			                  				<th style="text-align:right"> Amount </th>
			                  				<th style="text-align:center"></th>
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
	 <div id="damagesperbrgy" class="tab-pane fade">
	 		
	 		<div class="col-md-4" style="margin-top:20px">
	 			<div class="col-md-12 bg-white">
	 			<h4 class="red">Damages and Assistance per Barangay</h4>
		 			<div class="form-group col-md-12">
		 				<select class="form-control" id="province_dam_per_brgy">
		 					<option value="">-- Select Province --</option>
				        </select>
		 			</div>
		 			<div class="form-group col-md-12">
		 				<select class="form-control" id="city_dam_per_brgy">
		 					<option value="">-- Select City/Municipality --</option>
				        </select>
		 			</div>
		 			<div class="form-group col-md-12">
		 				<select class="form-control" id="brgy_dam_per_brgy">
		 					<option value="">-- Select Barangay --</option>
				        </select>
		 			</div>
		 			<div class="form-group col-md-12">
		 				<label>Cost of Assistance Provided</label>
		 				<input type="number" class="form-control" placeholder="Cost of Assistance Provided" min="0" id="costasst_brgy">
		 			</div>
		 			<div class="form-group col-md-6">
		 				<label>Totally Damaged</label>
		 				<input type="number" class="form-control" placeholder="Totally Damaged" min="0" id="damperbrgy_totally">
		 			</div>
		 			<div class="form-group col-md-6">
		 				<label>Partially Damaged</label>
		 				<input type="number" class="form-control" placeholder="Partially Damaged" min="0" id="damperbrgy_partially">
		 			</div>
		 			<div class="form-group col-md-4">
		 				<label>Dead</label>
		 				<input type="number" class="form-control" placeholder="Dead" min="0" id="damperbrgy_dead">
		 			</div>
		 			<div class="form-group col-md-4">
		 				<label>Injured</label>
		 				<input type="number" class="form-control" placeholder="Injured" min="0" id="damperbrgy_injured">
		 			</div>
		 			<div class="form-group col-md-4">
		 				<label>Missing</label>
		 				<input type="number" class="form-control" placeholder="Missing" min="0" id="damperbrgy_missing">
		 			</div>
		 			<div class="col-md-12">
			 			<div class="pull-right">
			 				<button type="button" class="btn btn-success btn-sm" id="savedata_dam_per_brgy"><i class='fa fa-plus-circle'></i> Save Data</button>	
			 				<button type="button" class="btn btn-warning btn-sm" id="updatedata_dam_per_brgy"><i class='fa fa-edit'></i> Update Data</button>	
			 				<!-- <button type="button" class="btn btn-danger btn-sm" id="deldata_dam_per_brgy"><i class='fa fa-times-circle'></i> Remove Data</button> -->	
			 			</div>
			 		</div>
		 		</div>
	 		</div>
	 		<div class="col-md-8" style="margin-top:20px">
	 			<div class="col-md-12 bg-white">
		 			<div class="col-md-12" style="margin-top:10px"><label><i class="fa fa-info-circle"></i> Reminders: Double click each entry to update/edit.</label></div>
			    	<div class="col-md-12" id="tbl_damage_assistance">
				    	<table style="width:100%;">
				    		<tbody>
				    			<table style="width:100%;" id="tbl_damages_per_brgy">
				    				<thead>
				    					<tr>
				    						<th rowspan="3" style="border:1px solid #000; text-align:center">AFFECTED AREAS <br>(Province/City/Municipality)</th>
				    						<th rowspan="3" style="border:1px solid #000; text-align:center">COST OF ASSISTANCE PROVIDED</th>
				    						<th colspan="5" style="border:1px solid #000; text-align:center">NUMBER OF</th>
				    					</tr>
				    					<tr>
				    						<th colspan="2" style="border:1px solid #000; text-align:center">DAMAGED HOUSES</th>
				    						<th colspan="3" style="border:1px solid #000; text-align:center">CASUALTIES</th>
				    					</tr>
				    					<tr>
				    						<th style="border:1px solid #000; text-align:center">TOTALLY</th>
				    						<th style="border:1px solid #000; text-align:center">PARTIALLY</th>
				    						<th style="border:1px solid #000; text-align:center">DEAD</th>
				    						<th style="border:1px solid #000; text-align:center">INJURED</th>
				    						<th style="border:1px solid #000; text-align:center">MISSING</th>
				    					</tr>
				    				</thead>
				    				<tbody>
				    				</tbody>
				    			</table>
				    		</tbody>
				    	</table>
				    </div>
				</div>
			</div>
	 </div>
	 <div id="viewchart" class="tab-pane fade">
	 		
 		<div class="col-md-12" style="margin-top:20px; width:100%;"">
 			<div class="col-md-12 bg-white" id="dromic_chart" style="height: 600px"">
	 		</div>
 		</div>
 		<div class="col-md-12" style="margin-top:20px; width:100%;"">
 			<div class="col-md-12 bg-white" id="dromic_chart_2" style="height: 600px"">
	 		</div>
 		</div>
	 </div>
	</div>

	<ul class='custom-menu'>
	  <li data-action = "first">First thing</li>
	  <li data-action = "second">Second thing</li>
	  <li data-action = "third">Third thing</li>
	</ul>

	<div id="addfaminsideEC" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:50%">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"> <label id="headertitle">Add</label> <strong>Affected Families Inside Evacuation Center</strong></h4>
            </div>
            <div class="modal-body">
	            <div class="row">
	              	<div class="form-group col-md-12">
	              		<label>
	              		Reminders: Kindly fill fields correctly. Fields marked with (<i style="color:red">*</i>) are required.
	              			However, if the evacuation center already exist you can leave the (EC CUM, EC NOW and EC Status) as blank.
	              		</label>
	              	</div>
	            </div>
              <div class="row">
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Select Province </label>
              		<select class="form-control" id="addfaminsideECprov">
              			<option value="">--- Select Province ---</option>
              		</select>
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Select City/Municipality </label>
              		<select class="form-control" id="addfaminsideECcity">
              			<option value="">-- Select City/Municipality --</option>
              		</select>
              	</div>
              	<div class="form-group col-md-12">
              		<label> <i style="color:red">*</i>  Barangay Located (EC) </label>
              		<select id="brgylocated_ec" style="width: 100%">
              			<option value="">Select Barangay</option>
              		</select>
              	</div>
              	<div class="form-group col-md-12">
              		<label> <i style="color:red">*</i>  Name of Evacuation Center </label>
              		<input type="text" class="form-control" id="ecname">
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  EC CUM </label>
              		<input type="number" class="form-control" id="ecicum" min="0">
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  EC NOW </label>
              		<input type="number" class="form-control" id="ecinow" min="0">
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Family CUM </label>
              		<input type="number" class="form-control" id="ecfamcum">
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Family NOW </label>
              		<input type="number" class="form-control" id="ecfamnow">
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Persons CUM </label>
              		<input type="number" class="form-control" id="ecpercum">
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Persons NOW </label>
              		<input type="number" class="form-control" id="ecpernow">
              	</div>
              	<div class="form-group col-md-12">
              		<label> <i style="color:red">*</i>  Place of Origin (Evacuees) </label>
              		<select id="ecplaceorigin" style="width: 100%" multiple>
              		</select>
              	</div>
              	<!-- <div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Specific Location/Place of Origin (Evacuees)</label>
              		<input type="text" class="form-control" id="ecplaceorigin1" disabled>
              	</div> -->
              	<div class="form-group col-md-12">
              		<label> EC Status </label>
              		<select class="form-control" id="ecistatus">
              			<option value="">-- Select EC Status --</option>
              			<option value="Newly-Opened">Newly-Opened</option>
              			<option value="Existing">Existing</option>
              			<option value="Closed">Closed</option>
              			<option value="Re-activated">Re-activated</option>
              		</select>
              	</div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-sm" onclick="addFamIEC()" id="addECS"><i class="fa fa-plus-circle"></i> Save and Close</button>
              <button type="button" class="btn btn-warning btn-sm" onclick="addFamAECS()" id="addAECS"><i class="fa fa-plus-circle"></i> Save Data and Add New EC</button>
              <button type="button" class="btn btn-primary btn-sm" onclick="addFamCECS()" id="addCECS"><i class="fa fa-plus-circle"></i> Save Data and continue current EC</button>
              <button type="button" class="btn btn-success btn-sm" onclick="addFamIECS()" id="addMECS"><i class="fa fa-plus-circle"></i> Save Data and continue with this municipality</button>
              <!-- <button type="button" class="btn btn-primary btn-sm" id="addCOECS"><i class="fa fa-pencil"></i> Clear Fields and Add Evacuees from Other Barangay with this EC</button> -->

              <button type="button" class="btn btn-warning btn-sm" id="updateECS"><i class="fa fa-pencil"></i> Update Data</button>
              <button type="button" class="btn btn-danger btn-sm" id="deleteECS"><i class="fa fa-remove"></i> Delete Data</button>
              <button type="button" class="btn btn-primary pull-left btn-sm" id="clearECS" title="Clear other fields except EC and add evacuees from other barangay in this EC"><i class="fa fa-eraser"></i> Clear field and add evacuees in this EC</button>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div id="addnewReport" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm" style="width:35%">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-12">
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
	                  <label style="margin-top:8px">Noted by: </label>
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
	                  <input type="text" class="form-control" id="approvedbypos" value="OIC - Regional  Director">
	                </div>
	            </div>
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="alert alert-danger col-md-12" id="errmsgnewdromicec">
	              	</div>
	            </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" onclick="savenewDromicEC()"><i class="fa fa-mail-forward"></i> Continue</button>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div id="adddamageasst" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm" style="width:35%">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><strong>Cost of Assistance Provided (LGU)</strong></h4>
            </div>
            <div class="modal-body">
              <div class="row">
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Select Province </label>
              		<select class="form-control" id="addDamprov">
              			<option value="">--- Select Province ---</option>
              		</select>
              	</div>
				<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Select City/Municipality </label>
              		<select class="form-control" id="addDamcity">
              			<option value="">-- Select City/Municipality --</option>
              		</select>
              	</div>
              	<div class="form-group col-md-12">
                  <center><label style="font-size:15px; display:none" class="green">Number of Damaged Houses</label></center>
                </div>
                <div class="form-group col-md-6" style="margin-top:-15px; display:none">
                  <center><label>Totally Damaged</label></center>
                  <input type="number" class="form-control" style="text-align:center" id="ntotally">
                </div>
                <div class="form-group col-md-6" style="margin-top:-15px; display:none">
                  <center><label>Partially Damaged</label></center>
                  <input type="number" class="form-control" style="text-align:center" id="npartially">
                </div>
                <div class="form-group col-md-12">
                  <center><label style="font-size:15px; display:none" class="green">Number of Casualties</label></center>
                </div>
                <div class="form-group col-md-4" style="margin-top:-15px; display:none">
                  <center><label>Dead</label></center>
                  <input type="number" class="form-control" style="text-align:center" id="ndead">
                </div>
                <div class="form-group col-md-4" style="margin-top:-15px; display:none">
                  <center><label>Missing</label></center>
                  <input type="number" class="form-control" style="text-align:center" id="nmising">
                </div>
                <div class="form-group col-md-4" style="margin-top:-15px; display:none">
                  <center><label>Injured</label></center>
                  <input type="number" class="form-control" style="text-align:center" id="ninjured">
                </div>
                <div class="form-group col-md-12">
                  <center><label style="font-size:15px; margin-top:-15px" class="green">Cost of Assistance</label></center>
                </div>
                <div class="form-group col-md-4" style="margin-top:-10px; display:none">
                  <center><label>DSWD</label></center>
                  <input type="number" class="form-control" style="text-align:center" id="ndswd">
                </div>
                <div class="form-group col-md-6" style="margin-top:-10px">
                  <center><label>Cost of Assistance (LGU)</label></center>
                  <input type="number" class="form-control" style="text-align:center" id="nlgu">
                </div>
                <div class="form-group col-md-6" style="margin-top:-10px;">
                  <center><label>NGO/Other GOs</label></center>
                  <input type="number" class="form-control" style="text-align:center" id="nngo">
                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" onclick="savenewDamAss()" id="saveDamAss"><i class="fa fa-plus-circle"></i> Save Data</button>
              <button type="button" class="btn btn-warning btn-sm" id="upDamAss"><i class="fa fa-pencil"></i> Update Data</button>
              <button type="button" class="btn btn-danger btn-sm" id="deleteDamAss"><i class="fa fa-remove"></i> Delete Data</button>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div id="addfamOEC" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm" style="width:35%">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><strong>Families Outside EC</strong></h4>
            </div>
            <div class="modal-body">
              <div class="row">
          		<h4 style="font-weight:bold" class="green">  HOST LGU (Temporary Displacement of Evacuees) </h4>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Select Province </label>
              		<select class="form-control" id="addfamOECprov">
              			<option value="">--- Select Province ---</option>
              		</select>
              	</div>
				<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Select City/Municipality </label>
              		<select class="form-control" id="addfamOECcity">
              			<option value="">-- Select City/Municipality --</option>
              		</select>
              	</div>
              	<div class="form-group col-md-12">
              		<label> <i style="color:red">*</i> Select Barangay </label>
              		<select class="form-control" id="addfamOECbrgy">
              			<option value="">-- Select Barangay --</option>
              		</select>
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Family CUM </label>
              		<input type="number"  class="form-control" id="famcumO" style="text-align:center">
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Family NOW </label>
              		<input type="number"  class="form-control" id="famnowO" style="text-align:center">
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Person CUM </label>
              		<input type="number"  class="form-control" id="personcumO" style="text-align:center">
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Person NOW </label>
              		<input type="number"  class="form-control" id="personnowO" style="text-align:center">
              	</div>

              	<h4 style="font-weight:bold" class="green">  PLACE OF ORIGIN (Evacuees) </h4>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Select Province </label>
              		<select class="form-control" id="addfamOECprovO">
              			<option value="">--- Select Province ---</option>
              		</select>
              	</div>
				<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Select City/Municipality </label>
              		<select class="form-control" id="addfamOECcityO">
              			<option value="">-- Select City/Municipality --</option>
              		</select>
              	</div>
              	<div class="form-group col-md-12">
              		<label> <i style="color:red">*</i> Select Barangay </label>
              		<select class="form-control" id="addfamOECbrgyO">
              			<option value="">-- Select Barangay --</option>
              		</select>
              	</div>

              	<div class="form-group col-md-12">
              		<label> <i style="color:red">*</i> Please Specify if Others</label>
              		<input class="form-control" id="addfamOECbrgyOothers" disabled>
              	</div>

              </div>

              	<!-- <div class="form-group col-md-12">
              		<label> <i style="color:red">*</i> Number of Affected Barangays </label>
              		<input type="number"  class="form-control" id="numbrgyO" style="text-align:center">
              		<label style="color:red"> <sup>Exclude counting of affected barangay if baragangay already exist in list on affected evacuation center</sup></label>
              	</div>
              </div> -->
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" onclick="savenewfamOEC()" id="saveFamOEC"><i class="fa fa-plus-circle"></i> Save Data</button>
              <button type="button" class="btn btn-warning btn-sm" onclick="updateFamOEC()" id="upFamOEC"><i class="fa fa-pencil"></i> Update Data</button>
              <button type="button" class="btn btn-danger btn-sm" id="delFamOEC"><i class="fa fa-remove"></i> Delete Data</button>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div id="addCasualtyModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm" style="width:35%">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><strong>Casualties</strong></h4>
            </div>
            <div class="modal-body">
              <div class="row">
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Select Province </label>
              		<select class="form-control" id="addcasualtyprov">
              			<option value="">--- Select Province ---</option>
              		</select>
              	</div>
				<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Select City/Municipality </label>
              		<select class="form-control" id="addcasualtycity">
              			<option value="">-- Select City/Municipality --</option>
              		</select>
              	</div>
              	<div class="form-group col-md-12">
              		<label> <i style="color:red">*</i> Place of Origin </label>
              		<input type="text"  class="form-control" id="addcasualtybrgy" style="text-align:center">
              	</div>
              	<div class="form-group col-md-5">
              		<label> <i style="color:red">*</i> Lastname </label>
              		<input type="text"  class="form-control" id="addcasualtylname" style="text-align:center">
              	</div>
              	<div class="form-group col-md-5">
              		<label> <i style="color:red">*</i> Firstname </label>
              		<input type="text"  class="form-control" id="addcasualtyfname" style="text-align:center">
              	</div>
              	<div class="form-group col-md-2">
              		<label> M.I. </label>
              		<input type="text"  class="form-control" id="addcasualtymi" style="text-align:center">
              	</div>
              	<div class="form-group col-md-6">
              		<label> Age </label>
              		<input type="number"  class="form-control" id="addcasualtyage" style="text-align:center">
              	</div>
              	<div class="form-group col-md-6">
              		<label> Sex </label>
              		<select class="form-control" id="addcasualtysex">
              			<option value="Male">Male</option>
              			<option value="Female">Female</option>
              		</select>
              	</div>
              	<center>
	              	<div class="form-group col-md-4">
	              		<label class="custom-control custom-checkbox">
						  <input type="radio" class="custom-control-input flat" name="iscasualty" value="dead">
						  <span class="custom-control-description">Dead</span>
						</label>
					</div>
					<div class="form-group col-md-4">
	              		<label class="custom-control custom-checkbox">
						  <input type="radio" class="custom-control-input flat" name="iscasualty" value="missing">
						  <span class="custom-control-description">Missing</span>
						</label>
					</div>
					<div class="form-group col-md-4">
	              		<label class="custom-control custom-checkbox">
						  <input type="radio" class="custom-control-input flat" name="iscasualty" value="injured">
						  <span class="custom-control-description">Injured</span>
						</label>
					</div>
				</center>
              	<div class="form-group col-md-12">
              		<label> Remarks </label>
              		<textarea class="form-control" rows="5" id="addcasualtyremarks"></textarea>
              	</div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" onclick="savenewCAS()" id="addcasualty"><i class="fa fa-plus-circle"></i> Save Data</button>
              <button type="button" class="btn btn-warning btn-sm" onclick="updateCAS()" id="updatecasualty"><i class="fa fa-pencil"></i> Update Data</button>
              <button type="button" class="btn btn-danger btn-sm" onclick="deleteCAS()" id="deletecasualty"><i class="fa fa-remove"></i> Delete Data</button>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div id="addCommentsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:75%">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><strong>Comments and Discussions</strong></h4>
            </div>
            <div class="modal-body">
            <div class="row">
	              <div class="col-sm-10">
	 					<textarea class="form-control" id="txt_comment" data-autoresize placeholder="Enter discussions here..." style="resize: none; overflow: hidden; border-radius: 5px"></textarea>
	              </div>
	              <div class="col-sm-2">
	              	  <button type="button" class="btn btn-primary btn-sm pull-right" onclick="saveComment()" style="margin-top: 10px; border-radius: 100px"><i class="fa fa-comment"></i> Save Comment</button>
	              </div>
          	</div>
            <div class="row" style="height:750px; overflow: auto; border: 3px solid #EB4C3C; margin-top: 10px; padding: 10px">
              	<div class="col-sm-12" id="div_comment"></div>

              	<!-- <div class="panel panel-danger">
			      <div class="panel-heading" id="by">Panel with panel-primary class</div>
			      <div class="panel-body">Panel Content</div>
			    </div> -->

            </div>
          </div>

        </div>
      </div>
    </div>

    <div id="addNarrativeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><strong>Attach a Narrative Report</strong></h4>
            </div>
            <div class="modal-body">
	            <div class="row">
		              <div class="col-sm-9">
		 					<input type="file" class="form-control" id="txt_file" accept=".doc, .docx"/>
		              </div>
		              <div class="col-sm-3">
		              	  <button type="button" class="btn btn-primary btn-sm pull-right" onclick="uploadFile()" style="border-radius: 100px"><i class="fa fa-save"></i> Upload File</button>
		              </div>
	          	</div>
	          	<br>
	          	<div class="row">
	          		<div class="col-sm-12" id="dropbox">
			             <!-- <div class="alert alert-info" >
			             </div> -->
		            </div>
	          	</div>
          </div>

        </div>
      </div>
    </div>
	
</div>
	