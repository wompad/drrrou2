<div class="row">

	<div class="col-md-8">
		<div>
			<label style="background-color:#169F85; color:#fff; width:100%; padding:10px; text-align:center">Latest Weather Animated Image</label>
		</div>
		<div>
			<center><object data="http://121.58.193.148/repo/mtsat-colored/24hour/latest-him-colored.gif" id="weatherobj" style="width:100%"></object></center>
		</div>
		<div style="font-size:15px" class="col-md-6">
			Source: <a href="http://www1.pagasa.dost.gov.ph/" target="_blank">http://www1.pagasa.dost.gov.ph/</a>
		</div>
		<div style="font-size:15px; text-align:right" class="col-md-6">
			<label class="switch">
			  <input type="checkbox" checked id="animate">
			  <div class="slider round" title="Click to stop animation of weather image and view latest weather image." data-toggle="tooltip" id="toanimate"></div>
			</label>
		</div>
	</div>
	<div class="col-md-4">
		<div>
			<label style="background-color:#169F85; color:#fff; width:100%; padding:10px; text-align:center" id="issuedat">Public Weather Forecast Issued: </label>
		</div>
		<div id="weathertextforecast" style="font-weight:lighter; text-align:justify; font-size:15px"></div>
	</div>

</div>