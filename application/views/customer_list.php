<?php include "admin_header.php"; ?>
	
	
	
	<section class="content-header">
		<h1>Customer<small>List</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllCustomer"; ?>">Customer</a></li>
			<li class="active">list</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
				
					<a href="<?php echo base_url(); ?>index.php/Home/addCustomer">
						<input class="btn btn-primary" type="button" value="Add New Customer"/>
					</a>
					<hr/>
					
					<table class="table table-bordered" id="data_list">
						<thead>
							<th>Customer Name</th>
							<th>Contact</th>
							<th>Address</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach($records as $row) { ?>
							<tr>
								<td><?php echo $row["name"]?></td>
								<td>Email : <?php echo $row["email"]?>,<br/>
									Mobile : <?php echo $row["mobile"]?>,<br/>
									Land Line : <?php echo $row["land_line"]?>
								</td>
								<td>
									<?php echo $row["address"]?>
									<?php echo $row["city"]?>,
									<?php echo $row["pincode"]?>
								</td>
								<td>
									<a href="<?php echo base_url(); ?>index.php/Home/updateCustomer?id=<?php echo $row["id"];?>">
										<button type="button" class="btn btn-success">EDIT</button>
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