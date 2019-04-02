<?php include "admin_header.php"; ?>
	
	<style>
		#form_table input{
			width:100px;
		}
		
			input[readonly]
{
    background-color:rgb(235, 235, 228);
}
	</style>
	
	<section class="content-header">
		<h1>Sales Payment<small>Edit</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllSalesPayment"; ?>">Sales Payment</a></li>
			<li class="active">Edit</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					
					
					
					<form role="form" action="<?php echo base_url()."index.php/Home/updateSalesPayment"; ?>" method="POST">
					
						<input type="hidden" name='id' value="<?php echo $_GET["id"];?>">
					
						<div class="box-body" id="form_body">
							<div class="form-group col-lg-12">
								<label class="col-lg-4">Customer Name</label>
								<div class="col-lg-8">
									<select id="addcompany" name="customer_id">
										<option value="">--Select Customer--</option>
										<?php foreach($customer as $row) { ?>
											<option  <?php if($records["customer_id"]==$row["id"]){ echo "selected"; } ?> value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group col-lg-12">
								<label class="col-lg-4">Amount</label>
								<div class="col-lg-8">
									<input type="number" name='paid_amount' value="<?php echo $records["paid_amount"];?>">
								</div>
							</div>
							
							<div class="form-group col-lg-12">
								<label class="col-lg-4">Payment Date</label>
								<div class="col-lg-8">
									<input type="text" class="datepicker" name='payment_date'  value="<?php echo date("d-m-Y",strtotime($records["payment_date"]));?>">
								</div>
							</div>
							
							<div class="form-group col-lg-12">
								<label class="col-lg-4">Payment Mode</label>
								<div class="col-lg-8">
									<select id="payment_mode" name='payment_mode'>
										<option value=''>--Payment Mode--</option>
										<option value='Cash' <?php if($records["payment_mode"]=="Cash"){ echo "selected"; } ?>>Cash</option>
										<option value='Cheque' <?php if($records["payment_mode"]=="Cheque"){ echo "selected"; } ?>>Cheque</option>
										<option value='Online' <?php if($records["payment_mode"]=="Online"){ echo "selected"; } ?>>Online</option>
									</select>
								</div>
							</div>
							
							<div class="form-group col-lg-12">
								<label class="col-lg-4">Remarks</label>
								<div class="col-lg-8">
									<textarea rows="5" cols="50" name='remarks'><?php echo $records["remarks"];?></textarea>
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
		$(document).ready(function(){
			
			$("#addcompany").chosen();
			$("#payment_mode").chosen();
			
			$(".datepicker").datepicker({
				format:"dd-mm-yyyy"
			});
			
			$("#submit").on("click",function(){
				$("form").validate({
					rules:{
						customer_id:"required",
						amount:"required",
						date:"required"
					},
					messages:{
						
					},
					submitHandler:function(form){
						form.submit();
					}
				});
			});
		});
	</script>
	
<?php include "admin_footer.php"; ?>