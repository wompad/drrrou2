<table class="table table-responsive table-striped" id="tbl_cinec">
		<thead>
			<tr>
				<th>Disaster Name</th>
				<th>Province Name</th>
				<th>Municipality Name</th>
				<th>Evacuation Name</th>
				<th>Barangay Located</th>
				<th>Affected Families</th>
				<th>Affected Persons</th>
				<th>Place of Origin</th>
				<th>Evacuation Status</th>
				<th>Captured Date</th>
				<th>Captured Time</th>
				<th>Sender</th>
				<th>Ref. Code</th>
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
					<td><?php echo $r['disaster_name']; ?></td>
					<td><?php echo $r['province_name']; ?></td>
					<td><?php echo $r['municipality_name']; ?></td>
					<td><?php echo $r['evacuation_name']; ?></td>
					<td><?php echo $r['brgy_located']; ?></td>
					<td><?php echo $r['fam_no']; ?></td>
					<td><?php echo $r['person_no']; ?></td>
					<td><?php echo $r['place_of_origin']; ?></td>
					<td><?php echo $r['ecstatus']; ?></td>
					<td><?php echo $r['ddate']; ?></td>
					<td><?php echo $r['dtime']; ?></td>
					<td><?php echo $r['username']; ?></td>
					<td><?php echo $r['ref_code']; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
