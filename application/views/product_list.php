<?php include "admin_header.php"; ?>
	
	
	
	<section class="content-header">
		<h1>Product<small>List</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllProduct"; ?>">Product</a></li>
			<li class="active">list</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
				
					<a href="<?php echo base_url(); ?>index.php/Home/addProduct">
						<input class="btn btn-primary" type="button" value="Add New Product"/>
					</a>
					<hr/>
					
					<table class="table table-bordered" id="data_list">
						<thead>
							<th>Product</th>
							<th>Description</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach($records as $row) { ?>
							<tr>
								<td><?php echo $row["name"]?></td>
								<td><?php echo $row["description"]?></td>
								<td>
									<a href="<?php echo base_url(); ?>index.php/Home/updateProduct?id=<?php echo $row["id"];?>">
										<button type="button" class="btn btn-success">UPDATE</button>
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