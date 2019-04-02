<?php include "admin_header.php"; ?>
	
	
	
	<section class="content-header">
		<h1>Purchase Payment<small>List</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllPurchasePayment"; ?>">Purchase Payment</a></li>
			<li class="active">list</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
				
					<a href="<?php echo base_url(); ?>index.php/Home/addPurchasePayment">
						<input class="btn btn-primary" type="button" value="Add Purchase Payment"/>
					</a>
					<hr/>
					
					<table class="table table-bordered" id="data_list">
						<thead>
							<th>Dealer Name</th>
							<th>Paid Amount</th>
							<th>Payment Mode</th>
							<th>Payment Date</th>
							<th>Remarks</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach($records as $row) { ?>
							<tr>
								<td><?php echo $row["company_name"]?></td>
								<td><?php echo $row["paid_amount"]?></td>
								<td><?php echo $row["payment_mode"]?></td>
								<td><?php echo date("d-m-Y",strtotime($row["payment_date"])); ?></td>
								<td><?php echo $row["remarks"]?></td>
								<td>
									<a href="<?php echo base_url(); ?>index.php/Home/updatePurchasePayment?id=<?php echo $row["id"];?>">
										<button type="button" class="btn btn-primary">EDIT</button>
									</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	
	<script>
		$("#data_list").DataTable();
	</script>
	
<?php include "admin_footer.php"; ?>