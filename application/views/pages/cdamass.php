<table class="table table-responsive table-striped">
	<thead>
		<tr>
			<th>Disaster Name</th>
			<th>Province Name</th>
			<th>Municipality Name</th>
			<!-- <th>Totally Damaged</th>
			<th>Partially Damaged</th> -->
			<!-- <th>Dead</th>
			<th>Missing</th>
			<th>Injured</th> -->
			<!-- <th>DSWD Assistance</th> -->
			<th>LGU Assistance</th>
			<th>NGO Assistance</th>
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
				<!-- <td><?php echo $r['tot_damaged']; ?></td>
				<td><?php echo $r['part_damaged']; ?></td> -->
				<!-- <td><?php echo $r['dead']; ?></td> -->
				<!-- <td><?php echo $r['missing']; ?></td> -->
				<!-- <td><?php echo $r['injured']; ?></td> -->
				<!-- <td><?php echo $r['dswd_asst']; ?></td> -->
				<td><?php echo $r['lgu_asst']; ?></td>
				<td><?php echo $r['ngo_asst']; ?></td>
				<td><?php echo $r['ddate']; ?></td>
				<td><?php echo $r['dtime']; ?></td>
				<td><?php echo $r['username']; ?></td>
				<td><?php echo $r['ref_code']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>