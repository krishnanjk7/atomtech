<?php include "admin_header.php"; ?>
	
	
	<section class="content-header">
		<h1>Product<small>Edit</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllProduct"; ?>">Product</a></li>
			<li class="active">Edit</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					
					<form role="form" action="<?php echo base_url()."index.php/Home/updateProduct"; ?>" method="POST">
						<div class="box-body">
							
							<input name="id" type="hidden" class="form-control" value="<?php echo $id; ?>"/>
							
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Product Name</label>
								<div class="col-lg-5">
									<input name="name" class="form-control" value="<?php echo $name; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Tax Id</label>
								<div class="col-lg-5">
									<select class="tax_id" name="tax_id">
										<option value="">--Select Tax--</option>
										<?php foreach($tax_list as $row) { ?>
											<option value="<?php echo $row["id"];?>" <?php if($row["id"]==$tax_id){ echo "selected"; } ?>><?php echo $row["name"];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Description</label>
								<div class="col-lg-5">
									<textarea class="form-control" name="description"><?php echo $description; ?></textarea>
								</div>
							</div>
							
							<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	
	<script>
		$(".tax_id").chosen();
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