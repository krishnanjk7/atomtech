<?php include "admin_header.php"; ?>
	
	
	<section class="content-header">
		<h1>Customer<small>Edit</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllCustomer"; ?>">Customer</a></li>
			<li class="active">Edit</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					
					<form role="form" action="<?php echo base_url()."index.php/Home/updateCustomer"; ?>" method="POST">
						<div class="box-body">
							
							<input name="id" type="hidden" class="form-control" value="<?php echo $id; ?>"/>
							
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Customer Name</label>
								<div class="col-lg-5">
									<input name="name" class="form-control" value="<?php echo $name; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Company Name</label>
								<div class="col-lg-5">
									<input name="company_name" class="form-control" value="<?php echo $company_name; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Email Id</label>
								<div class="col-lg-5">
									<input name="email" class="form-control" value="<?php echo $email; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Mobile No</label>
								<div class="col-lg-5">
									<input name="mobile" class="form-control" value="<?php echo $mobile; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Land Line</label>
								<div class="col-lg-5">
									<input name="land_line" class="form-control" value="<?php echo $land_line; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Address</label>
								<div class="col-lg-5">
									<textarea type="text" class="form-control" name="address"><?php echo $address; ?></textarea>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">City</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" name="city" value="<?php echo $city; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">State</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" name="state" value="<?php echo $state; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Pincode</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" name="pincode" value="<?php echo $pincode; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">GST No</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" name="gst_no" value="<?php echo $gst_no; ?>"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Type</label>
								<div class="col-lg-5">
									<select name="type" class="form-control">
										<option value="">---Select Customer Type---</option>
										<option value="CUSTOMER" <?php if($type=="CUSTOMER"){ echo "selected"; }?>>CUSTOMER</option>
										<option value="DEALER" <?php if($type=="DEALER"){ echo "selected"; }?>>DEALER</option>
										<option value="BOTH" <?php if($type=="BOTH"){ echo "selected"; }?>>BOTH</option>
									</select>
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
	
		
		$("#submit").on("click",function(){
			$("form").validate({
				rules:{
					
					name:"required",
					address:"required",
					pincode:"required"
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