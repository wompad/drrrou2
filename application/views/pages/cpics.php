<table class="table table-responsive table-striped" id="tbl_cpics">
	<thead>
		<tr>
			<th>Photo</th>
			<th>Photo Description</th>
			<th>Province Name</th>
			<th>Municipality Name</th>
			<th>Barangay Located</th>
			<th>Specific Location</th>
			<th>Captured Date</th>
			<th>Captured Time</th>
			<th>Sender</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($result as $r) : ?>
			<?php 
				if($r['rstatus'] == "NOT READ"){
					$style = "background-color: #D34F42; color:#fff";
				}else{
					$style = "";
				} 
			?>
			<tr style="<?php echo $style; ?>">
				<td onclick="picEnlarge(<?php echo $r['id'] ?>)"><img src="assets/drr_app/upload/<?php echo $r['pics']; ?>" style="width:50px; height:50px; cursor:pointer" class="img img-circle"></td>
				<td style="vertical-align:middle"><?php echo $r['description']; ?></td>
				<td style="vertical-align:middle"><?php echo $r['province_name']; ?></td>
				<td style="vertical-align:middle"><?php echo $r['municipality_name']; ?></td>
				<td style="vertical-align:middle"><?php echo $r['brgy_located']; ?></td>
				<td style="vertical-align:middle"><?php echo $r['spec_location']; ?></td>
				<td style="vertical-align:middle"><?php echo $r['ddate']; ?></td>
				<td style="vertical-align:middle"><?php echo $r['dtime']; ?></td>
				<td style="vertical-align:middle"><?php echo $r['username']; ?></td>
				<td style="vertical-align:middle"><button type="button" class="btn btn-success btn-xs" title="View on Map" onclick="viewMap(<?php echo $r['id']; ?>)"><i class="fa fa-eye"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
