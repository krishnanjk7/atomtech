<?php include "admin_header.php"; ?>
	
	<?php 
		
		$cid=isset($_GET["id"])?$_GET["id"]:"";
		$from_date=isset($_GET["from_date"])?$_GET["from_date"]:"";
		$to_date=isset($_GET["to_date"])?$_GET["to_date"]:"";
		$from_invoice_no=isset($_GET["from_invoice_no"])?$_GET["from_invoice_no"]:"";
		$to_invoice_no=isset($_GET["to_invoice_no"])?$_GET["to_invoice_no"]:"";
		
	?>
	
	<section class="content-header">
		<h1>Sales Account Statement<small>Report</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home" ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Report/getSalesReportOverview" ?>">Report</a></li>
			<li class="active">Sales Payment</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					
					<form action="<?php echo base_url()."index.php/Report/printSalesReport" ?>" method="GET" target="_blank">
					
						<div class="col-lg-12" style="margin-top:5px;border:2px solid grey;padding:3px;border-radius:4px">
							<div class="col-lg-6">
								<label class="col-lg-12">Customer Name</label>
								<div class="col-lg-12">
									<select class="addcompany form-control" name="cid">
										<option value="">All Customer</option>
										<?php foreach($company as $row) { ?>
											<option value="<?php echo $row["id"];?>" <?php if($cid==$row["id"]){ echo "selected"; } ?>>
												<?php echo $row["name"];?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="col-lg-3">
								<label class="col-lg-12">From Date</label>
								<div class="col-lg-12">
									<input class="datepicker" type="text" name="from_date" value="<?php echo $from_date; ?>"/>
								</div>
							</div>
							
							<div class="col-lg-3">
								<label class="col-lg-12">To Date</label>
								<div class="col-lg-12">
									<input class="datepicker" type="text" name="to_date" value="<?php echo $to_date; ?>"/>
								</div>
							</div>
							
							<div class="col-lg-3">
								<label class="col-lg-12">Invoice Start No</label>
								<div class="col-lg-12">
									<input class="form-control" type="number" name="from_invoice_no" value="<?php echo $from_invoice_no; ?>"/>
								</div>
							</div>
							
							<div class="col-lg-3">
								<label class="col-lg-12">Invoice End No</label>
								<div class="col-lg-12">
									<input class="form-control" type="number" name="to_invoice_no" value="<?php echo $to_invoice_no; ?>"/>
								</div>
							</div>
							
							<div class="col-lg-3" style="margin-top:23px;">
								<input class="btn btn-primary" type="submit"  value="Submit"/>
							</div>
							
						</div>
					
					</form>
					
				</div>
			</div>
		</div>
	</section>
	
	<script>
		$(document).ready(function(){
			
			$(".addcompany").chosen();
			
			$("title").empty();
			$("title").append("Account Statement - "+$(".addcompany option:selected").text());
			
			$(".datepicker").datepicker({
				format:"dd-mm-yyyy"
			});
			
		});
	</script>
	
<?php include "admin_footer.php"; ?>