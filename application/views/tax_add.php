<?php include "admin_header.php"; ?>
	
	
	
	<section class="content-header">
		<h1>Tax<small>Create</small></h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Tax</a></li>
			<li class="active">Create</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					
					<form role="form" action="<?php echo base_url()."index.php/Home/addTax"; ?>" method="POST">
						<div class="box-body">
							<div class="form-group col-lg-12">
								<label class="col-lg-2">Tax Name</label>
								<div class="col-lg-5">
									<input type="text" name="name" value=""/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-2">CGST</label>
								<div class="col-lg-5">
									<input type="number" name="cgst" value=""/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-2">SGST</label>
								<div class="col-lg-5">
									<input type="number" name="sgst" value=""/>
								</div>
							</div>
							<div class="form-group col-lg-12">
								<label class="col-lg-2">IGST</label>
								<div class="col-lg-5">
									<input type="number" name="igst" value=""/>
								</div>
							</div>
						</div>
						<div class="box-footer">
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