<?php include "admin_header.php"; ?>
	
	
	
	<section class="content-header">
		<h1>Purchase<small>List</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllPurchase"; ?>">Purchase</a></li>
			<li class="active">list</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
				
					<a href="<?php echo base_url(); ?>index.php/Home/addPurchase">
						<input class="btn btn-primary" type="button" value="Add New Purchase"/>
					</a>
					<hr/>
					
					<table class="table table-bordered" id="data_list">
						<thead>
							<th>S.No</th>
							<th>PO No</th>
							<th>PO Date</th>
							<th>To</th>
							<th>Final Total</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach($records as $row) { ?>
							<tr>
								<td><?php echo $row["purchase_id"]?></td>
								<td><?php echo $row["invoice_no"]?></td>
								<td><?php echo date("d-m-Y",strtotime($row["invoice_date"])); ?></td>
								<td><?php echo $row["company_name"]?></td>
								<td><?php echo $row["grand_total"]?></td>
								<td>
								<!--
									<a href="<?php echo base_url(); ?>index.php/Home/PurchasePrint?id=<?php echo $row["purchase_id"];?>" target="_blank">
										<button type="button" class="btn btn-success">PRINT</button>
									</a> -->
									
									
									<a href="<?php echo base_url(); ?>index.php/Home/updatePurchase?id=<?php echo $row["purchase_id"];?>">
										<button type="button" class="btn btn-primary">EDIT</button>
									</a>
									
									
									<!--
									<a href="<?php echo base_url(); ?>index.php/Home/removePurchase?id=<?php echo $row["purchase_id"];?>">
										<button type="button" class="btn btn-danger">REMOVE</button>
									</a>
									-->
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