<?php include "admin_header.php"; ?>
	
	
	<section class="content-header">
		<h1>Product<small>Create</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllProduct"; ?>">Product</a></li>
			<li class="active">Create</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					
					<form role="form" action="<?php echo base_url()."index.php/Home/addProduct"; ?>" method="POST">
						<div class="box-body">
							
							<table class="table table-bordered">
								<thead>
									<th>Name</th>
									<th>Tax</th>
									<th>Description</th>
									<th></th>
								</thead>
								<tbody>
									<tr class="data">
										<td><input type="text" name="name[]" class="form-control" value=""/></td>
										<td>
											<select class="tax_id" name="tax_id[]">
												<option value="">--Select Tax--</option>
												<?php foreach($tax_list as $row) { ?>
													<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
												<?php } ?>
											</select>
										</td>
										<td><textarea class="form-control" name="description[]"></textarea></td>
										<td><button class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
									</tr>
								</tbody>
							</table>
							
							<button type="button" id="add_more" class="btn btn-success">Add More</button>
							<br/>
							<br/>
							<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	
	<script>
		
		$(".tax_id").chosen();
		
		$("#add_more").on("click",function(){
			var table='<tr class="data">';
				table+='<td><input type="text" name="name[]" class="form-control" value=""/></td>';
				table+='<td>';
				table+='<select class="tax_id" name="tax_id[]">';
				table+='<option value="">--Select Tax--</option>';
				<?php foreach($tax_list as $row) { ?>
				table+='<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>';
				<?php } ?>
				table+='</select>';
				table+='</td>';
				table+='<td><textarea class="form-control" name="description[]"></textarea></td>';
				table+='<td><button class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>';
				table+='</tr>';
				
				$("tbody").append(table);
				
				$(".tax_id").chosen();
		});
		
		function removeRow(btn){
			var sum=0;
			$(".data").each(function(){
				sum++;
			});
			if(sum==1){
				alert("Can't Delete");
			}else{
				$(btn).parent("td").parent("tr").remove();
			}
		}
		
		$("#submit").on("click",function(){
			$("form").validate({
				rules:{
					name:"required"
				},
				messages:{
					
				},
				submitHandler:function(form){
					form.submit();
				}
			});
		});
	</script>
	
<?php include "admin_footer.php"; ?>