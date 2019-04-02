<?php include "admin_header.php"; ?>
	
	
	<section class="content-header">
		<h1>Customer<small>Create</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllCustomer"; ?>">Customer</a></li>
			<li class="active">Create</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					
					<form role="form" action="<?php echo base_url()."index.php/Home/addCustomer"; ?>" method="POST">
						<div class="box-body">
						
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Customer Name</label>
								<div class="col-lg-5">
									<input type="text" name="name" class="form-control"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Company Name</label>
								<div class="col-lg-5">
									<input type="text" name="company_name" class="form-control"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Email Id</label>
								<div class="col-lg-5">
									<input type="text" name="email" class="form-control"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Mobile No</label>
								<div class="col-lg-5">
									<input type="number" name="mobile" class="form-control"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Land Line</label>
								<div class="col-lg-5">
									<input type="text" name="land_line" class="form-control"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Address</label>
								<div class="col-lg-5">
									<textarea type="text" class="form-control" name="address"></textarea>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">City</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" name="city"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">State</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" name="state"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Pincode</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" name="pincode"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">GST No</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" name="gst_no"/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-3 control-label">Type</label>
								<div class="col-lg-5">
									<select name="type" class="form-control">
										<option value="">---Select Customer Type---</option>
										<option value="CUSTOMER">CUSTOMER</option>
										<option value="DEALER">DEALER</option>
										<option value="BOTH">BOTH</option>
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