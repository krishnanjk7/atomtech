<?php include "admin_header.php"; ?>
	
	
	
	<section class="content-header">
		<h1>Purchase<small>Report</small></h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Purchase</a></li>
			<li class="active">Report</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
				
					<hr/>
					
					<table class="table table-bordered" id="data_list">
						<thead>
							<th>S.No</th>
							<th>Invoice No</th>
							<th>Invoice Date</th>
							<th>Dealer</th>
							<th>Invoice Total</th>
							<th>Created Date</th>
						</thead>
						<tbody>
							<?php foreach($records as $row) { ?>
							<tr>
								<td><?php echo $row["purchase_id"]?></td>
								<td><?php echo $row["invoice_no"]?></td>
								<td><?php echo date("d-m-Y",strtotime($row["invoice_date"])); ?></td>
								<td><?php echo $row["company_name"]?></td>
								<td><?php echo $row["grand_total"]?></td>
								<td><?php echo date("d-m-Y",strtotime($row["created_date"]));?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	
	<script>
		function moveFunc(id,product_id){
			
			$.ajax({
				url:"<?php echo base_url(); ?>index.php/Home/setToSalable?id="+product_id,
				dataType:"json",
				success:function(res){
					if(res==1){
						
						var td=$(id).parent();
								$(id).parent().empty();
						
						var html ='<a href="<?php echo base_url(); ?>index.php/Home/updatePurchaseAdvanced?id='+product_id+'">';
							html+='<button type="button" class="btn btn-success">VIEW</button>';
							html+='</a>';
						
						$(td).append(html);
					}
				}
			});
		}
	
		$("#data_list").DataTable();
	</script>
	
<?php include "admin_footer.php"; ?>