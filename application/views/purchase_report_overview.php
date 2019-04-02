<?php include "admin_header.php"; ?>
	
	<?php 
	
		function rupeeformat($value){
			
			if (strpos($value, '.') !== false) {
				$pre_decimal=explode(".",$value)[0];
				$after_decimal=explode(".",$value)[1];
			}else{
				$pre_decimal=$value;
				$after_decimal="00";
			}
			
			$ruppee=str_split(strrev($pre_decimal));
			$new_ruppee="";
			foreach($ruppee as $sn){
				
				if(strlen($new_ruppee)==3||strlen($new_ruppee)==6){
					$new_ruppee=",".$new_ruppee;
				}
				$new_ruppee=$sn.$new_ruppee;
			}
			
			return $new_ruppee.'.'.$after_decimal;
		}
		
	?>
	
	<section class="content-header">
		<h1>Purchase<small>Report</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home" ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Report/getPurchaseReportOverview" ?>">Report</a></li>
			<li class="active">Purchase</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
				
					<hr/>
					<table class="table table-bordered" id="data_list">
						<thead>
							<th>Dealer Name</th>
							<th>Total Amount</th>
							<th>Paid Amount</th>
							<th>Due Amount</th>
						</thead>
						<tbody>
							<?php $total_amount=0; $total_received=0; $total_ounstanding=0; foreach($records as $row) { ?>
							<tr>
								<td>
									<a href="<?php echo base_url()."index.php/Report/printPurchaseReport?cid=".$row["dealer_id"]."&from_date=&to_date=&from_invoice_no=&to_invoice_no="; ?>" target="_blank">
									<?php echo $row["company_name"]; ?>
									</a>
								</td>
								<td class="text-right"><?php echo rupeeformat($row["invoice_amount"]);?></td>
								<td class="text-right"><?php echo rupeeformat($row["paid_amount"]);?></td>
								<td class="text-right"><?php echo rupeeformat($row["balance_amount"]);?></td>
							</tr>
							<?php 
								$total_amount+=floatval($row["invoice_amount"]); 
								$total_received+=floatval($row["paid_amount"]); 
								$total_ounstanding+=floatval($row["balance_amount"]);  
							?>
							<?php } ?>
							<tr style="background-color:#350250;color:white;border:2px solid black;font-weight:bold">
								<td></td>
								<td><?php echo rupeeformat($total_amount);?></td>
								<td><?php echo rupeeformat($total_received);?></td>
								<td><?php echo rupeeformat($total_ounstanding);?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	
	<script>
	$(document).ready(function(){
		
		$("title").empty();
		$("title").append("Party Account Statement as on <?php echo date("d-m-Y"); ?>");
		
		$("#data_list").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'excel', 'pageLength'
			]
		});
	});
	</script>
	
<?php include "admin_footer.php"; ?>