<?php include "admin_header.php"; ?>
	
	
	
	<section class="content-header">
		<h1>Tax<small>List</small></h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Tax</a></li>
			<li class="active">list</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
				
					<a href="<?php echo base_url(); ?>index.php/Home/addTax">
						<input class="btn btn-primary" type="button" value="Add New Tax"/>
					</a>
					<hr/>
					
					<table class="table table-bordered" id="data_list">
						<thead>
							<th>Tax Name</th>
							<th>CGST</th>
							<th>SGST</th>
							<th>IGST</th>
						</thead>
						<tbody>
							<?php foreach($records as $row) { ?>
							<tr>
								<td><?php echo $row["name"]?></td>
								<td><?php echo $row["cgst"]?></td>
								<td><?php echo $row["sgst"]?></td>
								<td><?php echo $row["igst"]?></td>
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