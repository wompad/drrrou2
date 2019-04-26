<div class="row" style="background-color: #fff">
	<label id="pageid" style="display :none"><?= $_SESSION['regionid']."-".$_SESSION['username']?></label>
	<label id="usernameid" style="display :none"><?= $_SESSION['regionid']?></label>
	<ul class="nav nav-tabs" id='step1'>
	  <li class="active"><a data-toggle="tab" class="btn btn-sm btn-danger tabpill" href="#home" style="border-radius:0px; border-radius: 5px 5px 0px 0px; padding: 5px; font-size: 15px" id="toexcel1">Form 1 (Main Report - F1)</a></li>
	  <li class="dropdown" id="step4">
	  		<a class="dropdown-toggle btn btn-sm btn-danger tabpill" data-toggle="dropdown" href="#" style="border-radius:0px; border-radius: 5px 5px 0px 0px; padding: 5px; font-size: 15px; background-color: #7AB900">  
	  			Status of Damages and Assistance Provided <b class="caret"></b></a>
	  		<ul class="dropdown-menu">
	            	 <li style="background-color: #7AB900; color: #000 !important"><a data-toggle="tab" class="tabpill2" href="#home2" id="toexcel2" style="font-size: 15px; color: #000">
	            	 Form 1.2 (Damages and Assistance per P/C/MLGU and NGOs - F2)</a></li>
	            	 <li style="background-color: #7AB900; color: #000 !important"><a data-toggle="tab" class="tabpill2" href="#damagesperbrgy" id="toexcel7" style="font-size: 15px; color: #000">Damages and Assistance per Barangay - F7</a></li>
	        </ul>
	  </li>
	  <li class="dropdown">
	  		<a class="dropdown-toggle btn btn-sm btn-danger tabpill" data-toggle="dropdown" href="#" style="border-radius:0px; border-radius: 5px 5px 0px 0px; padding: 5px; font-size: 15px; background-color: #006400" id="step5">  
	  			Status of Displacement <b class="caret"></b></a>
	  		<ul class="dropdown-menu">
	            	 <li style="background-color: #006400"><a class="tabpill2" data-toggle="tab" href="#evacuation_stats" id="toexcel3" style="font-size: 15px; color: #fff">Form 2 - (EC Evacuations - F3)</a></li>
	            	 <li style="background-color: #006400"><a class="tabpill2" data-toggle="tab" href="#evacuation_stats_outside" id="toexcel4" style="font-size: 15px; color: #fff">Form 3 (Outside EC Evacuations - F4)</a></li>
	            	 <li style="background-color: #FBBC05"><a class="tabpill2" data-toggle="tab" href="#sexandageinsideec" style="font-size: 15px; color: #fff">Sex and Age Distribution Data Inside EC</a></li>
	            	 <li style="background-color: #3EC2EB"><a class="tabpill2" data-toggle="tab" href="#evacuationfacility" style="font-size: 15px; color: #fff">Evacuation Center Facilities</a></li>
	        </ul>
	  </li>
	  <?php if($_SESSION['isdswd'] == 't'){ ?>
	  	<li><a data-toggle="tab" href="#assistance" class="btn btn-md btn-danger tabpill" style="border-radius:0px; border-radius: 5px 5px 0px 0px; padding: 5px; font-size: 15px; background-color: #EA8825" id="toexcel6">DSWD Cost of Assistance - F6</a></li>
	  <?php } ?>
	  <li>
		  <button style="border-radius: 5px 5px 0px 0px; margin-right: 5px; font-size: 15px" type="button" class="btn btn-dark btn-sm" id="exporttoexcel">
		  	<label style="border-radius: 5px; border:1px solid #006400; position:absolute; width:30px; height:40px; margin-top:-9px; margin-left:-3px; background-color:#006400; color:#fff;">
		  		<i class="fa fa-file-excel-o" style="margin-top:11px; margin-left:3px; cursor:pointer"></i>
		  	</label>          Export to Excel (Ctrl+E)
		  </button>
	  </li>
	  <li class="dropdown">
	  		<a class="dropdown-toggle btn btn-sm btn-danger tabpill" data-toggle="dropdown" href="#" style="border-radius:0px; border-radius: 5px 5px 0px 0px; padding: 5px; font-size: 15px"> <span class="fa fa-wrench"></span> Chart and Tools <b class="caret"></b></a>
	  		<ul class="dropdown-menu">
	            <?php if($_SESSION['can_create_report'] == 't'){ ?> <li ><a id="addnarrativebtn" style="font-size: 15px"> <span class="fa fa-file-word-o"></span> Attach Narrative Report</a></li> <?php } ?>
	            	 <li><a id="viewchartsexs" data-toggle="tab" href="#viewchartsex" style="font-size: 15px"> <span class="fa fa-bar-chart"></span> Chart of Sex Disaggregated Data </a></li>
				     <li><a id="viewcharts" data-toggle="tab" href="#viewchart" style="font-size: 15px"> <span class="fa fa-bar-chart"></span> Chart of Affected LGUs </a></li>
				     <li><a data-toggle="tab" href="#narrative" style="font-size: 15px"> <span class="fa fa-newspaper-o"></span> View Narrative Report </a></li>
				     <li><a id="disaster_map" data-toggle="tab" href="#disastermap" style="font-size: 15px"> <span class="fa fa-map"></span> Disaster Map</a></li>
				     <li><a id="addCommentsbtn" data-toggle="tab" style="font-size: 15px"> <i class="fa fa-sticky-note"></i> Discussions <span class="badge badge-primary" id="commentcounter"></span></a></li>
	        </ul>
	  </li>
	  <li><a href="javascript:void(0);" onclick="javascript:startIntro()" id="startButton" class="btn btn-sm btn-primary tabpill" style="border-radius:0px; border-radius: 5px 5px 0px 0px; padding: 5px; font-size: 15px">Launch Tutorial!</a></li>
	</ul>
	<div style="left:50%; top:45%; position:fixed; z-index:99999; background-color:#304456; padding-top:20px; padding-bottom:20px; padding-left:50px; padding-right:45px; border-radius:5px; color:#fff" id="loader">
    <center><div class="loader"></div></center>
    Loading data...
  	</div>
	<div class="tab-content">
		<br>
	  <div id="sex_disaggregation" class="tab-pane fade">
	  	<div class="col-sm-12" id="dmap" style="font-size:30px">
	  		CURRENTLY UNDER DEVELOPMENT :-)
	  	</div>
	  </div>
	  <div id="disastermap" class="tab-pane fade">
	  	<center>
		  	<div class="col-sm-12" id="dmap" style="font-size:30px">

		  		<div class="col-sm-12" id="map_per_region">
		  			<div class="col-sm-1 pull-right">
		  				<button type="button" class="btn btn-dark col-sm-12" id="show_map_per_region"> <i class="fa fa-globe"></i> Show Map </button>
		  			</div>
		  			<div class="col-sm-3 pull-right">
			  			<select id="sel_regions" class="form-control">
			  			</select>
			  		</div>
		  		</div>

		  		<div id="mapid" style="width:100%; height: 1000px"></div>
		  	</div>
		</center>
	  </div>
	  <div id="narrative" class="tab-pane fade">
	  	<iframe src="" style="width: 100%; height: 1500px; border: 0px; background-color: #F7F7F7; margin-top: 20px" id="frame_narrative_report"></iframe>
	  </div>
	  <div id="home" class="tab-pane fade in active">
		  	<div class="form-group col-md-12" id="step2" style="margin-left: -10px">
				<div class="btn-group" style="border-radius: 5px">
				  	<button style="border-radius: 5px; margin-right: 5px; font-size: 15px; border-radius: 5px" type="button" class="btn btn-success btn-sm" id="saveasnewrecord"><i class="fa fa-plus-circle"></i> 
				  	Save as new Record and Update Data (Ctrl+S)</button>
				</div>
				<div class="btn-group" style="border-radius: 5px" id="step3">
				  	<button style="border-radius: 5px; margin-right: 5px; font-size: 15px; border-radius: 5px; background-color: #006400" type="button" class="btn btn-success btn-sm" id="addfamaffected"><i class="fa fa-users"></i> 
				  	Add Total Affected Families and Persons</button>
				</div>
			</div>
			<div class="col-sm-12">
				<label class="red">
					Note: Right click each entry to toggle menu and update data.
				</label>
			</div>
			
	  		<div class="col-md-4 pull-right" style="color:#000; font-weight: bold; margin-top: 10px; font-size: 15px">
	  			<?php if($_SESSION['user_level_access'] == 'national'){ ?>
	  				Number of affected municipalities: <label id="count_allmunis"></label><br>
	  				Number of affected cities: <label id="count_allcity"></label>
	  			<?php } ?>
	  		</div>
	  		
	    	<div class="col-md-12" style="padding: 0px; width: 2000px" id="tbl_masterquery_revs">
		    	<table style="width:100%; font-size: 11px" id="tbl_masterquery_revss" class="tbl_masterquery_revs">
		    		<thead>

		    			<tr>
		    				<td rowspan="5" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #AA83CB; color: #000; padding: 2px; font-weight: bold">REGION/<br>PROVINCE/MUNICIPALITY</td>
		    				<td colspan="5" rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #8DC63F; color: #000; padding: 2px; font-weight: bold">NUMBER OF AFFECTED</td>
		    				<td colspan="16" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">DISPLACEMENT DATA</td>
		    				<td colspan="12" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">SERVED</td>
		    				<td colspan="32" rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">SEX AND AGE DISTRIBUTION OF IDPs INSIDE EVACUATION CENTERS</td>
		    				<td colspan="12" rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">VULNERABLE SECTOR</td>
		    				<td colspan="18" rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">EVACUATION CENTER FACILITIES</td>
		    				<td colspan="3" rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #7AB900; color: #000; padding: 2px; font-weight: bold">NO. OF DAMAGED HOUSES</td>
		    				<td colspan="23" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">TOTAL COST OF ASSISTANCE (PHP)</td>
		    			</tr>

		    			<tr>
		    				<td rowspan="3" colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NUMBER OF ECs</td>
		    				<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NAME OF EC</td>
		    				<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">ADDRESS</td>
		    				<td colspan="2" rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">ORIGIN OF IDPs</td>
		    				<td colspan="10" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NUMBER OF DISPLACED </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">TOTAL DISPLACED SERVED </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">TOTAL NOT DISPLACED SERVED </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">TOTAL SERVED </td>
		    				<td colspan="19" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">DSWD </td>
		    				<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">LGU </td>
		    				<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">NGOs </td>
		    				<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">OTHERS </td>
		    				<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">GRAND TOTAL </td>
		    			</tr>

		    			<tr>
		    				<td colspan="6" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">INSIDE ECs </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">OUTSIDE ECs </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">FAMILIES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">PERSONS </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">FAMILIES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">PERSONS </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">FAMILIES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">PERSONS </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">INFANT <br> >1 y/o (0-11mos) </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">TODDLERS <br> 1-3 y/o </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">PRESCHOOLERS <br> 4-5 y/o </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">SCHOOL AGE <br> 6-12 y/o </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">TEENAGE <br> 13-19 y/o</td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">ADULT <br> 20-59 y/o </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">SENIOR CITIZEN <br> 60 and above </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">TOTAL IDPs INSIDE EC </td>
		    				<td rowspan="2" colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">PREGNANT </td>
		    				<td rowspan="2" colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">LACTATING MOTHERS </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">PERSONS W/ DISABILITY </td>
		    				<td rowspan="2" colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">SOLO PARENTS </td>
		    				<td rowspan="2" colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">IPs </td>
		    				<td colspan="8" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">LATRINES </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">CHILD FRIENDLY SPACE </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">WOMEN FRIENDLY SPACE </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COUPLE ROOM </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">PRAYER ROOM </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COMMUNITY KITCHEN </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">WASH </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">RAMPS </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">HELP DESK </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">CAPACITY </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">NO. OF ROOMS </td>
		    				<td colspan="6" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">FOOD </td>
		    				<td colspan="13" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">NON FOOD ITEMS </td>
		    			</tr>

		    			<tr>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #8DC63F; color: #000; padding: 2px; font-weight: bold">BRGYS. </td>
		    				<td rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #8DC63F; color: #000; padding: 2px; font-weight: bold">FAMILIES </td>
		    				<td rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #8DC63F; color: #000; padding: 2px; font-weight: bold">PERSONS </td>
		    				<td rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #8DC63F; color: #000; padding: 2px; font-weight: bold">4Ps FAMILIES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">FAMILIES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">PERSONS (ACTUAL) </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">PERSONS (ESTIMATE) </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">FAMILIES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">PERSONS </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">TOTAL FAMILIES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">TOTAL PERSONS </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">TOTAL FAMILIES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">TOTAL PERSONS </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">TOTAL FAMILIES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">TOTAL PERSONS </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">MALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">FEMALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">MALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">FEMALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">MALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">FEMALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">MALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">FEMALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">MALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">FEMALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">MALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">FEMALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">MALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">FEMALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">MALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">FEMALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">MALE </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">FEMALE </td>
		    				<td rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COMPOST PIT </td>
		    				<td rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">SEALED </td>
		    				<td colspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">PORTALETS </td>
		    				<td colspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">BATHING CUBICLES </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">FFP</td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">HEB</td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">RTEF</td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">SHELTER KITS</td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">HYGIENE KITS</td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">SLEEPING KITS</td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">KITCHEN KITS</td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">FAMILY KITS</td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">POTABLE WATER</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">OTHER NFIs</td>
		    			</tr>

		    			<tr>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #8DC63F; color: #000; padding: 2px; font-weight: bold">NAME</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #8DC63F; color: #000; padding: 2px; font-weight: bold">COUNT</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NAME</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">COUNT</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFD965; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">MALE</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">FEMALE</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COMMON</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">MALE</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">FEMALE</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COMMON</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #7AB900; color: #000; padding: 2px; font-weight: bold">TOTAL</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #7AB900; color: #000; padding: 2px; font-weight: bold">TOTALLY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #7AB900; color: #000; padding: 2px; font-weight: bold">PARTIALLY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">QUANTITY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">QUANTITY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">QUANTITY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">QUANTITY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">QUANTITY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">QUANTITY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">QUANTITY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">QUANTITY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">QUANTITY</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #EA8825; color: #000; padding: 2px; font-weight: bold">COST</td>
		    			</tr>

		    		</thead>
		    		<tbody>
		    		</tbody>
		    		<tfoot>
						<!-- <tr>
							<td colspan="29" style="text-align:center; font-weight:bold; border:1px solid #000; background-color: #808080; color: #000"> *** NOTHING FOLLOWS ***</td>
						</tr>
						<tr>
		    				<th style="text-align:center; font-weight:lighter" colspan="29"> </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="8">Prepared by: </th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="10">Noted by: </th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="11">Approved by: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter" colspan="29"> </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="8" id="spreparedby"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="10" id="srecommendedby"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="11" id="sapprovedby"></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="8" id="spreparedbypos"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="10" id="srecommendedbypos"></th>
		    				<th style="text-align:center; font-weight:bolder; color: #000" colspan="11" id="sapprovedbypos"></th>
		    			</tr> -->
					</tfoot>
		    	</table>
		    </div>
	  </div>
	  <div id="menu1" class="tab-pane fade">
	    <h3>Menu 1</h3>
	    <p>Some content in menu 1.</p>
	  </div>
	  <div id="evacuation_stats" class="tab-pane fade">

		   <button style="border-radius: 5px; font-size: 15px; background-color: #006400;" type="button" class="btn btn-sm btn-primary dropdown-toggle tabpill" id="addfamiec">
		   		<span class="fa fa-plus-circle"></span> Add Affected Families Inside EC (Ctrl+I)
		   </button>

	  	<div class="col-md-12" style="margin-top:10px"><label class="red"><i class="fa fa-info-circle"></i> Reminders: Right click each entry to update/edit.</label></div>
	  	<div class="col-md-3 pull-right" id="count_ec" style="font-weight:bold; font-size: 15px">

	  	</div>
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	<div class="col-md-12" id="tbl_evac_stats" style="border:1px solid gray">	
	    		<table style="width:100%;" id="tbl_evac_statss">
		    		<thead>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000">Department of Social Welfare and Development</th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; color: #000"><b>DISASTER RESPONSE, OPERATIONS, MONITORING AND INFORMATION CENTER</b></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000">Batasan Pambansa Complex, Constitution Hills</th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000">Quezon City</th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000"><br></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; color: #000"><b>STATUS OF EVACUATION CENTERS</b></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" id="asofdate_IEC">As of: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" id="asoftime_IEC">Time: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:left; font-weight:lighter; color: #000">Region:<b> CARAGA </b> </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:left; font-weight:lighter; color: #000" id="disastertype_IEC"></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:left; font-weight:lighter; color: #000" id="disasterdate_IEC"></th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td>
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
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
		  		
		  	</div>	
	  	</div>
	  </div>
	  <div id="evacuation_stats_outside" class="tab-pane fade">
		<button style="border-radius: 5px; font-size: 15px; background-color: #006400;" type="button" class="btn btn-sm btn-primary dropdown-toggle tabpill" id="addfamoec">
	   		<span class="fa fa-plus-circle"></span> Add Affected Families Outside EC (Ctrl+Q)
	   </button>
	  	<div class="col-md-12" style="margin-top:10px"><label class="red"><i class="fa fa-info-circle"></i> Reminders: Double click each entry to update/edit.</label></div>
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:1px solid gray;" id="tbl_evacuation_stats_outside">
		    <table style="width:100%;" id="tbl_evacuation_stats_outsides">
	    		<thead>
	    			<tr>
	    				<th style="text-align:center; font-weight:lighter">Department of Social Welfare and Development</th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center;"><b>DISASTER RESPONSE, OPERATIONS, MONITORING AND INFORMATION CENTER</b></th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center; font-weight:lighter">Batasan Pambansa Complex, Constitution Hills</th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center; font-weight:lighter">Quezon City</th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center; font-weight:lighter"><br></th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center;"><b>STATUS OF OUTSIDE EVACUATION CENTERS</b></th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center; font-weight:lighter" id="asofdate_OEC">As of: </th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:center; font-weight:lighter" id="asoftime_OEC">Time: </th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:left; font-weight:lighter">Region:<b> CARAGA </b> </th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:left; font-weight:lighter" id="disastertype_OEC"></th>
	    			</tr>
	    			<tr>
	    				<th style="text-align:left; font-weight:lighter" id="disasterdate_OEC"></th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<tr>
	    				<td>
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
	    				</td>
	    			</tr>
	    		</tbody>
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

			<button style="border-radius: 5px; margin-right: 5px; font-size: 15px; background-color: #EA8825" type="button" class="btn btn-warning btn-sm" id="adddamass"><i class="fa fa-plus-circle"></i> 
				Add Cost of Assistance [P/MLGU] (Ctrl+D)
			</button>

	 		<div class="col-md-12" style="margin-top:10px"><label class="red"><i class="fa fa-info-circle"></i> Reminders: Double click each entry to update/edit.</label></div>
	    	<div class="col-md-12" style="border:1px solid gray;" id="tbl_damage_assistance">
		    	<table style="width:100%;" id="tbl_damage_assistances">
		    		<thead>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000">Department of Social Welfare and Development</th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; color: #000"><b>DISASTER RESPONSE, OPERATIONS, MONITORING AND INFORMATION CENTER</b></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000">Batasan Pambansa Complex, Constitution Hills</th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000">Quezon City</th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000"><br></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; color: #000"><b>STATUS OF DAMAGES AND COST OF ASSISTANCE</b></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" id="asofdate2">As of: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:center; font-weight:lighter; color: #000" id="asoftime2">Time: </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:left; font-weight:lighter; color: #000">Region:<b> CARAGA </b> </th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:left; font-weight:lighter; color: #000" id="disastertype2"></th>
		    			</tr>
		    			<tr>
		    				<th style="text-align:left; font-weight:lighter; color: #000" id="disasterdate2"></th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td>
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
				    		</td>
				    	</tr>
		    		</tbody>
		    	</table>
		    </div>
	 </div>
	 <div id="assistance" class="tab-pane fade">
	 		<div class="col-md-12" style="margin-top:10px"><label class="red"><i class="fa fa-info-circle"></i> Reminders: Double click each entry to update/edit.</label></div>
	    	<div class="col-md-12">
		    	<div class="col-md-6 bg-white" style="font-size: 12px">
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
			              	<table class="table table-responsive col-md-12 table-bordered" id="tbl_ch_assistance">
		      					<tbody>
		      						<tr>
		      							<td colspan="5">
		      								<center><strong>---- Select Food and Non-Food Assistance ----</strong></center>
		      							</td>
		      						</tr>
		      						<tr>
		      							<td colspan="4">
		      								<div class="form-group col-md-12">
							              		<input type="text" class="form-control" id="fnfiassistance" name="fnfiassistance" placeholder="Food and Non-Food" style="font-size: 12px">
							              	</div>
		      							</td>
		      							<td style="vertical-align:middle; text-align:center" rowspan="2"> 
		      								<button type="button" class="btn btn-primary" id="addasstfnfi"><span class="fa fa-plus-circle"></button>
		      								<button type="button" class="btn btn-warning" id="editasstfnfi"><span class="fa fa-edit"></button>
		      							 </td>
		      						</tr>
		      						<tr>
		      							<td>
		      								<div class="form-group col-md-12">
							              		<input type="number" id="fnficost" class="form-control" placeholder="Cost" min="1" style="font-size: 12px">
							              	</div>
		      							</td>
		      							<td>
		      								<div class="form-group col-md-12">
							              		<input type="number" id="fnfiquantity" class="form-control" placeholder="Quantity" min="1" style="font-size: 12px">
							              	</div>
		      							</td>
		      							<td>
		      								<div class="form-group col-md-12">
							              		<select class="form-control" style="font-size: 12px" id="fnfistype">
							              			<option value=""></option>
							              			<option value="ffp">FFP</option>
							              			<option value="heb">HEB</option>
							              			<option value="rtef">RTEF</option>
							              			<option value="shelter">Shelter Kit</option>
							              			<option value="hygiene">Hygiene Kit</option>
							              			<option value="sleeping">Sleeping Kit</option>
							              			<option value="kitchen">Kitchen Kit</option>
							              			<option value="family">Family Kit</option>
							              			<option value="potable">Potable Water</option>
							              			<option value="other">Other</option>
							              		</select>
							              	</div>
		      							</td>
		      							
		      						</tr> 
		      					</tbody>
		      				</table>
		      				<br>
		      				<table class="table table-responsive col-md-12" id="tbl_assistance_list" style="margin-top:-15px">
		      					<thead>
		      						<tr>
		      							<td colspan="4">
		      								<center><strong>List of Food and Non-Food Assistance to be provided...</strong></center>
		      							</td>
		      						</tr>
		      						<tr>
		      							<th style="width:40%">
		      								Item
		      							</th>
		      							<th style="width:15%">
		      								Cost
		      							</th>
		      							<th style="width:15%; text-align:right">
		      								Quantity
		      							</th>
		      							<th style="width:15%; text-align:center">
		      								Type
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
		      							<th colspan="4" style="font-size:20px; text-align:right">
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
		      					<button type="button" class="btn btn-warning pull-right btn-sm" id="updateassistance_spec"> <i class="fa fa-plus-circle"></i> Update Assistance </button>
		      					<button type="button" class="btn btn-success pull-right btn-sm" id="saveassistance"> <i class="fa fa-plus-circle"></i> Save Assistance </button>
		      				</div>
		                  </div>
		                </div>
		    		</div>
		    	</div>
		    	<div class="col-md-6 bg-white">
		    		<br>
		    		<div class="pull-right">
		    				<label style="font-size:12px">Total Number of Family Food Packs Augmented: <span id="totffps"> </span> </label><br>
		    				<label style="font-size:12px">Total Amount of Family Food Packs Augmented: <span id="amtffps"> </span> </label><br>
		    				<label style="font-size:12px">Total Amount of Other Food and Non-Food Items: <span id="amtnfi"> </span> </label>
		    		</div>
		    		<br>
		    		<div class="x_panel" style="font-size: 11px">
		    			<div class="x-title green"><h4><strong>LGUs Provided with Food and Non-Food Asssitance</strong></h4></div>
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
		 				<label>Barangay Cost of Assistance Provided</label>
		 				<input type="number" class="form-control" placeholder="Cost of Assistance Provided" min="0" id="costasst_brgy">
		 				<label class="red"><i>* If there is any</i></label>
		 			</div>
		 			<div class="form-group col-md-6">
		 				<label>Totally Damaged</label>
		 				<input type="number" class="form-control" placeholder="Totally Damaged" min="0" id="damperbrgy_totally">
		 				<label class="red"><i>* If there is any</i></label>
		 			</div>
		 			<div class="form-group col-md-6">
		 				<label>Partially Damaged</label>
		 				<input type="number" class="form-control" placeholder="Partially Damaged" min="0" id="damperbrgy_partially">
		 				<label class="red"><i>* If there is any</i></label>
		 			</div>
		 			<!-- <div class="form-group col-md-4">
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
		 			</div> -->
		 			<div class="col-md-12">
			 			<div class="pull-right">
			 				<button type="button" class="btn btn-success btn-sm" id="savedata_dam_per_brgy"><i class='fa fa-plus-circle'></i> Save Data</button>	
			 				<button type="button" class="btn btn-warning btn-sm" id="updatedata_dam_per_brgy"><i class='fa fa-edit'></i> Update Data</button>	
			 				<button type="button" class="btn btn-danger btn-sm" id="deldata_dam_per_brgy"><i class='fa fa-times-circle'></i> Remove Data</button>	
			 			</div>
			 		</div>
		 		</div>
	 		</div>
	 		<div class="col-md-8" style="margin-top:20px">
	 			<div class="col-md-12 bg-white">
		 			<div class="col-md-12" style="margin-top:10px"><label class="red"><i class="fa fa-info-circle"></i> Reminders: Double click each entry to update/edit.</label></div>
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
 		<div class="col-md-12" style="margin-top:20px; width:100%;">
 			<div class="col-md-12 bg-white" id="dromic_chart" style="height: 600px">
	 		</div>
 		</div>
 		<div class="col-md-12" style="margin-top:20px; width:100%;">
 			<div class="col-md-12 bg-white" id="dromic_chart_2" style="height: 600px">
	 		</div>
 		</div>
	 </div>

	 <div id="viewchartsex" class="tab-pane fade">
 		<div class="col-md-12" style="margin-top:20px;">
 			<div class="col-md-12 bg-white" id="dromic_chartsex" style="height: 500px; border: 1px solid gray">
	 		</div>
 		</div>
 		<div class="col-md-12" style="margin-top:20px;">
 			<div class="col-md-12 bg-white" id="dromic_chart_sex2" style="height: 500px">
	 		</div>
 		</div>
	 </div>

	 <div id="sexandageinsideec" class="tab-pane fade">
		  	<div class="form-group col-md-12" style="margin-left: -10px">
				<div class="btn-group" style="border-radius: 5px">
				  	<!-- <button style="border-radius: 5px; margin-right: 5px; font-size: 15px; border-radius: 5px" type="button" class="btn btn-success btn-sm" id="saveasnewrecord"><i class="fa fa-plus-circle"></i> 
				  	Save as new Record and Update Data (Ctrl+S)</button> -->
				</div>
			</div>

	    	<div class="col-md-12" style="padding: 0px;" id="tbl_sex_age_distribution">

	    		<br>

	    		<label class="red"> *Reminder: Kindly double click on the highlighted evacuation center to update each entries </label>

	    		<table style="width:100%; font-size: 11px" id="tbl_sex_age_distribution_list">
	    			<thead>
		    			<tr>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #AA83CB; color: #000; padding: 2px; font-weight: bold">
		    					REGION/<br>PROVINCE/MUNICIPALITY
		    				</td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #8DC63F; color: #000; padding: 2px; font-weight: bold">BRGY NAME</td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NAME OF EC</td>
		    				<td colspan="32" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">
			    				SEX AND AGE DISTRIBUTION OF IDPs INSIDE EVACUATION CENTERS
			    			</td>
		    				<td colspan="12" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">
			    				VULNERABLE SECTOR
			    			</td>
		    			</tr>
		    			<tr>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">INFANT <br> >1 y/o (0-11mos) </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">TODDLERS <br> 1-3 y/o </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">PRESCHOOLERS <br> 4-5 y/o </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">SCHOOL AGE <br> 6-12 y/o </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">TEENAGE <br> 13-19 y/o</td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">ADULT <br> 20-59 y/o </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">SENIOR CITIZEN <br> 60 and above </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">TOTAL IDPs INSIDE EC </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">PREGNANT </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">LACTATING MOTHERS </td>
		    				<td colspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">PERSONS W/ DISABILITY </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">SOLO PARENTS </td>
		    				<td colspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">IPs </td>
		    			</tr>
		    			<tr>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FBBC05; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">CUM</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #FFE599; color: #000; padding: 2px; font-weight: bold">NOW</td>
		    			</tr>
		    		</thead>
		    		<tbody>
		    		</tbody>
	    		</table>
	    	</div>
	</div>

	<div id="evacuationfacility" class="tab-pane fade">
		  	<div class="form-group col-md-12" style="margin-left: -10px">
				<div class="btn-group" style="border-radius: 5px">
				  	<!-- <button style="border-radius: 5px; margin-right: 5px; font-size: 15px; border-radius: 5px" type="button" class="btn btn-success btn-sm" id="saveasnewrecord"><i class="fa fa-plus-circle"></i> 
				  	Save as new Record and Update Data (Ctrl+S)</button> -->
				</div>
			</div>

	    	<div class="col-md-12" style="padding: 0px;" id="tbl_evauation_facility">

	    		<br>

	    		<label class="red"> *Reminder: Kindly double click on the highlighted evacuation center to update each entries </label>

	    		<table style="width:100%; font-size: 11px" id="tbl_evauation_facility_list">
	    			<thead>
		    			<tr>
		    				<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #AA83CB; color: #000; padding: 2px; font-weight: bold">
		    					REGION/<br>PROVINCE/MUNICIPALITY
		    				</td>
		    				<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #8DC63F; color: #000; padding: 2px; font-weight: bold">BRGY NAME</td>
		    				<td rowspan="4" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #006400; color: #000; padding: 2px; font-weight: bold">NAME OF EC</td>
		    				<td colspan="18" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">
			    				EVACUATION CENTER FACILITIES
			    			</td>
		    			</tr>
		    			<tr>
		    				<td colspan="8" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">LATRINES </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">CHILD FRIENDLY SPACE </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">WOMEN FRIENDLY SPACE </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COUPLE ROOM </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">PRAYER ROOM </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COMMUNITY KITCHEN </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">WASH </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">RAMPS </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">HELP DESK </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">CAPACITY </td>
		    				<td rowspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">NO. OF ROOMS </td>
		    			</tr>
		    			<tr>
		    				<td rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COMPOST PIT </td>
		    				<td rowspan="2" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">SEALED </td>
		    				<td colspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">PORTALETS </td>
		    				<td colspan="3" style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">BATHING CUBICLES </td>
		    			</tr>
		    			<tr>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">MALE</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">FEMALE</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COMMON</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">MALE</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">FEMALE</td>
		    				<td style="vertical-align: middle; text-align:center; border:1px solid #000; background-color: #277DB8; color: #000; padding: 2px; font-weight: bold">COMMON</td>
		    			</tr>
		    		</thead>
		    		<tbody>
		    		</tbody>
	    		</table>
	    	</div>
	</div>

	</div>

	<ul class='custom-menu'>
	  <li data-action = "first">First thing</li>
	  <li data-action = "second">Second thing</li>
	  <li data-action = "third">Third thing</li>
	</ul>

	<div id="addfamnInside" title="Total Affected Families and Persons">
		<div class="modal-body">
	            <div class="row">
	              	<div class="form-group col-md-12">
	              		<label class="red">
	              		Reminders: Kindly fill fields correctly. Fields marked with (<i style="color:red">*</i>) are required.
	              		</label>
	              	</div>
	            </div>
              <div class="row">
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Select Province </label>
              		<select class="form-control" id="addfamNinsideECprov">
              			<option value="">--- Select Province ---</option>
              		</select>
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Select City/Municipality </label>
              		<select class="form-control" id="addfamNinsideECcity">
              			<option value="">-- Select City/Municipality --</option>
              		</select>
              	</div>
              	<div class="form-group col-md-4">
              		<label> <i style="color:red">*</i>  No. of Affected Barangay </label>
              		<input type="number" class="form-control" id="ecnbrgy" style="text-align: center">
              	</div>
              	<div class="form-group col-md-4">
              		<label> <i style="color:red">*</i>  No. of Affected Family </label>
              		<input type="number" class="form-control" id="ecnfamcum" style="text-align: center">
              	</div>
              	<div class="form-group col-md-4">
              		<label> <i style="color:red">*</i>  No. of Affected Persons </label>
              		<input type="number" class="form-control" id="ecnpercum" style="text-align: center">
              	</div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-sm" onclick="addnFamIEC()" id="addnECS"><i class="fa fa-plus-circle"></i> Save and Close</button>
              <button type="button" class="btn btn-warning btn-sm" onclick="addnFamAECS()" id="addnAECS"><i class="fa fa-plus-circle"></i> Save and Add New Data</button>
              <button type="button" class="btn btn-danger btn-sm" onclick="delnFamAECS()" id="delnAECS"><i class="fa fa-trash"></i> Delete Data</button>
            </div>
	</div>

	<div id="addfaminsideEC" title="Affected Families Inside Evacuation Center">
		<div class="modal-body">
            <div class="row">
              	<div class="form-group col-md-12">
              		<label class="red">
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
          		</select>
          	</div>
          	<div class="form-group col-md-12">
          		<label> <i style="color:red">*</i>  Name of Evacuation Center </label>
          		<input type="text" class="form-control" id="ecname" 
          			onkeyup="var start = this.selectionStart;
				  		var end = this.selectionEnd;
				  		this.value = this.value.toUpperCase();
				  		this.setSelectionRange(start, end);">
          	</div>
          	<div class="form-group col-md-12">
          		<label> <i style="color:red">*</i>  Barangay Located (Evacuation Center) </label>
          		<select id="brgylocated_ec" style="width: 100%;">
          			<option value="">Select Barangay</option>
          		</select>
          	</div>
          	<div class="form-group col-md-6" id="eccum">
          		<label> <i style="color:red">*</i>  EC CUM </label>
          		<input type="number" class="form-control" id="ecicum" min="0" max="1" disabled>
          	</div>
          	<div class="form-group col-md-6" id="ecnow">
          		<label> <i style="color:red">*</i>  EC NOW </label>
          		<input type="number" class="form-control" id="ecinow" min="0" max="1" disabled>
          	</div>
          	<div class="form-group col-md-6">
          		<label> <i style="color:red">*</i>  Family CUM </label>
          		<input type="number" class="form-control" id="ecfamcum">
          	</div>
          	<div class="form-group col-md-6">
          		<label> <i style="color:red">*</i>  Family NOW </label>
          		<input type="number" class="form-control" id="ecfamnow">
          	</div>
          	<div class="form-group col-md-12">
          		<label> <i style="color:red">*</i>  Number of 4Ps Families </label>
          		<input type="number" class="form-control" id="ec4ps">
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
          	<div class="form-group col-md-12" id="ecstatus">
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

	<!-- <div id="addfaminsideEC" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:50%">
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"> <label id="headertitle">Add</label> <strong>Affected Families Inside Evacuation Center</strong></h4>
            </div>
        </div>
      </div>
    </div> -->

    <!-- div id="addnewReport" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm" style="width:35%">
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
	                <div class="alert alert-danger col-md-12" id="errmsgnewdromicecs">
	              	</div>
	            </div>
              </div>
	        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" onclick="savenewDromicEC()"><i class="fa fa-mail-forward"></i> Continue</button>
            </div>
          </div>

        </div>
    </div> -->

    <div id="dialog" title="Save as New Record and Update Data">
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<br>
                <button type="button" class="btn btn-primary btn-sm pull-right" onclick="savenewDromicEC()"><i class="fa fa-mail-forward"></i> Continue</button>
            </div>
          </div>
      </div>
	</div>

	<div id="adddamageasst" title="Cost of Assistance Provided (LGU)">
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
                <div class="form-group col-md-4" style="margin-top:-10px">
                  <center><label>Cost of Assistance (LGU)</label></center>
                  <input type="number" min="1" class="form-control" style="text-align:center" id="nlgu">
                </div>
                <div class="form-group col-md-4" style="margin-top:-10px;">
                  <center><label>NGOs</label></center>
                  <input type="number" min="1" class="form-control" style="text-align:center" id="nngo">
                </div>
                <div class="form-group col-md-4" style="margin-top:-10px;">
                  <center><label>Other GOs</label></center>
                  <input type="number" min="1" class="form-control" style="text-align:center" id="ngo">
                </div>
              </div>
	          <div class="modal-footer">
	             <button type="button" class="btn btn-primary btn-sm" onclick="savenewDamAss()" id="saveDamAss"><i class="fa fa-plus-circle"></i> Save Data</button>
	             <button type="button" class="btn btn-warning btn-sm" id="upDamAss"><i class="fa fa-pencil"></i> Update Data</button>
	             <button type="button" class="btn btn-danger btn-sm" id="deleteDamAss"><i class="fa fa-remove"></i> Delete Data</button>
	          </div>
          </div>
	</div>
    <!-- <div id="adddamageasst" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm" style="width:35%">
      </div>
    </div> -->

    <div id="addfamOEC" title="Families Outside EC">
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
	        <div class="modal-footer">
	          <button type="button" class="btn btn-primary btn-sm" onclick="savenewfamOEC()" id="saveFamOEC"><i class="fa fa-plus-circle"></i> Save Data</button>
	          <button type="button" class="btn btn-warning btn-sm" onclick="updateFamOEC()" id="upFamOEC"><i class="fa fa-pencil"></i> Update Data</button>
	          <button type="button" class="btn btn-danger btn-sm" id="delFamOEC"><i class="fa fa-remove"></i> Delete Data</button>
	        </div>
	    </div>
    </div>

    <!-- <div id="addfamOEC" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm" style="width:35%">
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><strong>Families Outside EC</strong></h4>
            </div>
        </div>
      </div>
    </div> -->

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

    <div id="addCommentsModal" title="Comments and Discussions">
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
        </div>
      </div>
    </div>

    <div id="addNarrativeModal" title="Attach a Narrative Report">
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
	            </div>
          	</div>
      </div>
    </div>

    <div id="addfaminsideECProfile" title="Add/Update Sex and Age Distribution Data Inside Evacuation Center">
    	<div class="modal-body">
          <div class="row">
          	<div class="form-group col-md-12">
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i>  Select Province </label>
              		<select class="form-control" id="addfaminsideECprovprofile" disabled="disabled">
              			<option value="">--- Select Province ---</option>
              		</select>
              	</div>
              	<div class="form-group col-md-6">
              		<label> <i style="color:red">*</i> Select City/Municipality </label>
              		<select class="form-control" id="addfaminsideECcityprofile" disabled="disabled">
              			<option value="">-- Select City/Municipality --</option>
              		</select>
              	</div>
              	<div class="form-group col-md-12">
              		<label> <i style="color:red">*</i>  Name of Evacuation Center </label>
              		<input type="text" class="form-control" id="ecnameprofile" disabled="disabled">
              	</div>
              </div>
            </div>
          <div class="row">
          	<div class="col-sm-12">
          		<table class="table table-bordered table-condensed">
          			<tr>
          				<th style="text-align: center; vertical-align: middle" colspan="2"><label class="red"> PREGNANT </label></th>
          				<th style="text-align: center; vertical-align: middle" colspan="2"><label class="red"> LACTATING MOTHER </label></th>
          				<th style="text-align: center; vertical-align: middle" colspan="2"><label class="red"> SOLO PARENTS </label></th>
          				<th style="text-align: center; vertical-align: middle" colspan="2"><label class="red"> IPs </label></th>
          			</tr>
          			<tr>
          				<th style="text-align: center; vertical-align: middle" class="green">CUM</th>
          				<th style="text-align: center; vertical-align: middle" class="green">NOW</th>
          				<th style="text-align: center; vertical-align: middle" class="green">CUM</th>
          				<th style="text-align: center; vertical-align: middle" class="green">NOW</th>
          				<th style="text-align: center; vertical-align: middle" class="green">CUM</th>
          				<th style="text-align: center; vertical-align: middle" class="green">NOW</th>
          				<th style="text-align: center; vertical-align: middle" class="green">CUM</th>
          				<th style="text-align: center; vertical-align: middle" class="green">NOW</th>
          			</tr>
          			<tr>
          				<th style="text-align: center; vertical-align: middle" class="green"><input style="text-align:center" type="number" class="form-control" id="pregnant_cum"></th>
          				<th style="text-align: center; vertical-align: middle" class="green"><input style="text-align:center" type="number" class="form-control" id="pregnant_now"></th>
          				<th style="text-align: center; vertical-align: middle" class="green"><input style="text-align:center" type="number" class="form-control" id="lactating_cum"></th>
          				<th style="text-align: center; vertical-align: middle" class="green"><input style="text-align:center" type="number" class="form-control" id="lactating_now"></th>
          				<th style="text-align: center; vertical-align: middle" class="green"><input style="text-align:center" type="number" class="form-control" id="solo_cum"></th>
          				<th style="text-align: center; vertical-align: middle" class="green"><input style="text-align:center" type="number" class="form-control" id="solo_now"></th>
          				<th style="text-align: center; vertical-align: middle" class="green"><input style="text-align:center" type="number" class="form-control" id="ip_cum"></th>
          				<th style="text-align: center; vertical-align: middle" class="green"><input style="text-align:center" type="number" class="form-control" id="ip_now"></th>
          			</tr>
          		</table>
          		<table class="table table-bordered table-condensed">
          			<tr>
          				<th style="text-align: center; vertical-align: middle" class="green">Age Bracket/Range</th>
          				<th style="text-align: center; vertical-align: middle" class="green">MALE CUM</th>
          				<th style="text-align: center; vertical-align: middle" class="green">MALE NOW</th>
          				<th style="text-align: center; vertical-align: middle" class="green">FEMALE CUM</th>
          				<th style="text-align: center; vertical-align: middle" class="green">FEMALE NOW</th>
          			</tr>
          			<tr>
          				<td style="text-align: center; vertical-align: middle"><label class="red"> INFANT <br> >1 y/o (0-11mos) </label></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="infant_male_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="infant_male_now"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="infant_female_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="infant_female_now"></td>
          			</tr>
          			<tr>
          				<td style="text-align: center; vertical-align: middle"><label class="red"> TODDLERS <br> 1-3 y/o </label></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="toddler_male_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="toddler_male_now"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="toddler_female_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="toddler_female_now"></td>
          			</tr>
          			<tr>
          				<td style="text-align: center; vertical-align: middle"><label class="red"> PRESCHOOLERS <br> 4-5 y/o </label></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="preschooler_male_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="preschooler_male_now"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="preschooler_female_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="preschooler_female_now"></td>
          			</tr>
          			<tr>
          				<td style="text-align: center; vertical-align: middle"><label class="red"> SCHOOL AGE <br> 6-12 y/o </label></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="schoolage_male_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="schoolage_male_now"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="schoolage_female_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="schoolage_female_now"></td>
          			</tr>
          			<tr>
          				<td style="text-align: center; vertical-align: middle"><label class="red"> TEENAGE <br> 13-19 y/o </label></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="teenage_male_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="teenage_male_now"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="teenage_female_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="teenage_female_now"></td>
          			</tr>
          			<tr>
          				<td style="text-align: center; vertical-align: middle"><label class="red"> ADULT <br> 20-59 y/o </label></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="adult_male_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="adult_male_now"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="adult_female_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="adult_female_now"></td>
          			</tr>
          			<tr>
          				<td style="text-align: center; vertical-align: middle"><label class="red"> SENIOR CITIZEN <br> 60 and above </label></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="senior_male_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="senior_male_now"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="senior_female_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="senior_female_now"></td>
          			</tr>
          			<tr>
          				<td style="text-align: center; vertical-align: middle"><label class="red"> PERSONS <br> WITH DISABILITY </label></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="disable_male_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="disable_male_now"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="disable_female_cum"></td>
          				<td style="text-align: center; vertical-align: middle"><input style="text-align:center" type="number" class="form-control" id="disable_female_now"></td>
          			</tr>
          		</table>
          	</div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" onclick="addFamIECProfile()"><i class="fa fa-plus-circle"></i> Save and Close</button>
              <button type="button" class="btn btn-danger btn-sm" id="deleteECSexData"><i class="fa fa-trash"></i> Delete Sex Disaggregated Data</button>
            </div>
        </div>
    </div>

    <!-- <div id="addfaminsideECProfile" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:55%">
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"> <strong>Add/Update Sex and Age Distribution Data Inside Evacuation Center</strong></h4>
            </div>
            

        </div>
      </div>
    </div> -->

    <div id="addfaminsideECFacilities" title="Add/Update Evacuation Center Facilities">
    	<div class="modal-body">
          <div class="row" style="border-bottom: 3px solid gray;">
              	<div class="form-group col-md-12">
	              	<div class="form-group col-md-6">
	              		<label> <i style="color:red">*</i>  Select Province </label>
	              		<select class="form-control" id="addfaminsideECprovfacility" disabled="disabled">
	              			<option value="">--- Select Province ---</option>
	              		</select>
	              	</div>
	              	<div class="form-group col-md-6">
	              		<label> <i style="color:red">*</i> Select City/Municipality </label>
	              		<select class="form-control" id="addfaminsideECcityfacility" disabled="disabled">
	              			<option value="">-- Select City/Municipality --</option>
	              		</select>
	              	</div>
	              	<div class="form-group col-md-12">
	              		<label> <i style="color:red">*</i>  Name of Evacuation Center </label>
	              		<input type="text" class="form-control" id="ecnamefacility" disabled="disabled">
	              	</div>
	            </div>
          </div>
          <div class="row">
          	<center>
              	<div class="col-sm-12" style="margin-bottom: 10px; border-bottom: 3px solid gray; padding:10px">
              		<center><label class="red"> Latrines </label></center>
              		<div class="col-sm-6">
              			<label> Compost Pit Type </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="compostpit">
              		</div>
              		<div class="col-sm-6">
              			<label> Sealed Type </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="sealedtype">
              		</div>
              	</div>
              	<div class="col-sm-6" style="margin-bottom: 10px; border-bottom: 3px solid gray; padding:10px; border-right: 3px solid gray">
              		<center><label class="red"> Portalets </label></center>
              		<div class="col-sm-4">
              			<label> Male </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="portaletmale">
              		</div>
              		<div class="col-sm-4">
              			<label> Female </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="portaletfemale">
              		</div>
              		<div class="col-sm-4">
              			<label> Common </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="portaletcommon">
              		</div>
              	</div>
              	<div class="col-sm-6" style="margin-bottom: 10px; border-bottom: 3px solid gray; padding:10px">
              		<center><label class="red"> Bathing Cubicles </label></center>
              		<div class="col-sm-4">
              			<label> Male </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="bathingmale">
              		</div>
              		<div class="col-sm-4">
              			<label> Female </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="bathingfemale">
              		</div>
              		<div class="col-sm-4">
              			<label> Common </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="bathingcommon">
              		</div>
              	</div>

              	<div class="col-sm-12" style="margin-bottom: 10px; border-bottom: 3px solid gray; padding:10px">
              		<div class="col-sm-3">
              			<label> Child Friendly Space </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="childfriendly">
              		</div>
              		<div class="col-sm-3">
              			<label> Women Friendly Space </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="womenfriendly">
              		</div>
              		<div class="col-sm-3">
              			<label> Couple Room </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="coupleroom">
              		</div>
              		<div class="col-sm-3">
              			<label> Prayer Room </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="prayerroom">
              		</div>
              	</div>
              	<div class="col-sm-12" style="margin-bottom: 10px; border-bottom: 3px solid gray; padding:10px">
              		<div class="col-sm-3">
              			<label> Community Kitchen </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="communitykitchen">
              		</div>
              		<div class="col-sm-3">
              			<label> WASH </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="wash">
              		</div>
              		<div class="col-sm-3">
              			<label> Ramps </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="ramps">
              		</div>
              		<div class="col-sm-3">
              			<label> Help Desk </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="helpdesk">
              		</div>
              	</div>
              	<div class="col-sm-12" style="margin-bottom: 10px; border-bottom: 3px solid gray; padding:10px">
              		<div class="col-sm-6">
              			<label> Capacity </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="capacity">
              		</div>
              		<div class="col-sm-6">
              			<label> No. of Rooms </label>
		              	<input type="number" min="0" class="form-control" style="text-align:center" id="norooms">
              		</div>
              	</div>

            </center>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" onclick="addFamIECFacilities()"><i class="fa fa-plus-circle"></i> Save and Close</button>
            </div>
        </div>
    </div>

    <!-- <div id="addfaminsideECFacilities" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:52%">
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"> <strong>Add/Update Evacuation Center Facilities</strong></h4>
            </div>
        </div>
      </div>
    </div> -->

    <div id='cntnr'>
		<ul id='items'>
		  <li id="openModalEC" style="border-bottom: 1px solid #A6A6A6; padding: 3px; background-color: #006400; color: #fff" class="rightclickmenu">Update/Delete Evacuation Center Data</li>
		  <li id="openModalEC_clear" style="border-bottom: 1px solid #A6A6A6; padding: 3px; background-color: #006400; color: #fff" class="rightclickmenu">Clear field and add evacuees in this EC</li>
		  <li id="openModalProfile" style="border-bottom: 1px solid #A6A6A6; padding: 3px; background-color: #FBBC05; color: #fff" class="rightclickmenu">Add/Update Sex and Age Distribution Data</li>
		  <li id="openModalFacilities" style="border-bottom: 1px solid #A6A6A6; padding: 3px; background-color: #277DB8; color: #fff" class="rightclickmenu">Add/Update Evacuation Center Facility</li>  
		</ul>
	</div>

</div>
	