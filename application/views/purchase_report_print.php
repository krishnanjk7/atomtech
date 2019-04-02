<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap/bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font_load.css">
		<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.js"></script>
		
		<title>Account Statement</title>
		
		<style>
			
			thead th{
				background: #9a9797;
			}
			td{
				font-size: 11px;
			}
			table,th,td,h4{
				font-family: Montserrat;
				font-weight: 100;
			}
			.bg-shade{
				background: #c7c5c5;
			}
		</style>
		
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
	</head>
	<body>	
	<?php  
		
		/*$sortArray = array(); 

		foreach($records as $person){ 
			foreach($person as $key=>$value){ 
				if(!isset($sortArray[$key])){ 
					$sortArray[$key] = array(); 
				} 
				$sortArray[$key][] = $value; 
			} 
		} 

		$orderby = "company_name"; //change this to whatever key you want from the array 

		array_multisort($sortArray[$orderby],SORT_ASC,$records); */

		//var_dump($records);
	
	?>
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					
					
					<h4 style="text-align:center">
						<?php foreach($company as $row) {  ?>
							<?php if($_GET["cid"]==$row["id"]){  echo $row["company_name"]; } ?>
						<?php } ?>
					</h4>
					<h4 style="text-align:center">Account Statement as on <?php echo date("d-m-Y"); ?></h4>
					<?php $open_balance=0;  if(($_GET["cid"]!="")) { ?>
						<?php if(isset($start_balance[$_GET["cid"]])) { ?>
							<p style="text-align:center"><?php echo "Opening Balance : ".rupeeformat($start_balance[$_GET["cid"]]); ?></p>
						<?php $open_balance=$start_balance[$_GET["cid"]]; } ?>
					<?php } ?>
					<div class="col-lg-12" style="height:10px"></div>
					<?php $old_company=""; $total_amount=0; $total_received=0; $total_ounstanding=0; $old_dealer_id=""; $old_invocie_date=""; ?>
					<table class="table table-bordered" id="data_list">
						<thead>
							<tr>
								<th id="invoice-style">Bill No</th>
								<th id="date-style">Date</th>
								<th>Amount</th>
								<th>Paid Date</th>
								<th>Paid Amount</th>
								<th>Outstanding</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($records as $row) { //var_dump($row); echo "\n"; ?>
								
								<!-- Paid Amount Middle -->
								<?php if($old_invocie_date!=""){ ?>
								
									<?php foreach($sales_payment as $pay) {  ?>
										<?php if(($old_dealer_id==$pay["dealer_id"])&&(($pay["payment_date"]>=$old_invocie_date)&&($pay["payment_date"]<$row["invoice_date"]))){ ?>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td><?php echo date("d-m-Y",strtotime($pay["payment_date"])); ?></td>
												<td class="text-right"><?php echo rupeeformat($pay["paid_amount"]);?></td>
												<td class="text-right"><?php echo rupeeformat($total_ounstanding-$pay["paid_amount"]);?></td>
											</tr>
										<?php $total_ounstanding=$total_ounstanding-$pay["paid_amount"]; $total_received+=floatval($pay["paid_amount"]); } ?>
									<?php } ?>
									
								<?php }else{ ?>
									
									<?php if($_GET["cid"]!="") { ?>
										<?php foreach($sales_payment as $pay) {  ?>
											<?php if(($row["company_id"]==$pay["dealer_id"])&&(($pay["payment_date"]<$row["invoice_date"]))){ ?>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td><?php echo date("d-m-Y",strtotime($pay["payment_date"])); ?></td>
													<td class="text-right"><?php echo rupeeformat($pay["paid_amount"]);?></td>
													<td class="text-right"><?php echo rupeeformat($total_ounstanding-$pay["paid_amount"]);?></td>
												</tr>
											<?php $total_ounstanding=$total_ounstanding-$pay["paid_amount"]; $total_received+=floatval($pay["paid_amount"]); } ?>
										<?php } ?>
									<?php } ?>
									
								<?php } ?>
								
								<?php if(($old_company!="")&&($row["company_name"]!=$old_company)) { ?>
									
									<!--
									<?php foreach($sales_payment as $pay) {  ?>
										<?php if(($old_dealer_id==$pay["dealer_id"])&&($pay["payment_date"]>=$old_invocie_date)){ ?>
											<tr>
												<td>99</td>
												<td></td>
												<td></td>
												<td><?php echo date("d-m-Y",strtotime($pay["payment_date"])); ?></td>
												<td class="text-right"><?php echo rupeeformat($pay["paid_amount"]);?></td>
												<td class="text-right"><?php echo rupeeformat($total_ounstanding-$pay["paid_amount"]);?></td>
											</tr>
										<?php $total_ounstanding=$total_ounstanding-$pay["paid_amount"]; $total_received+=floatval($pay["paid_amount"]); } ?>
									<?php } ?>  -->
									
									<tr>
										<td class="bg-shade" colspan="2"><?php echo "Total"; ?></td>
										<td class="bg-shade text-right"><?php echo rupeeformat($total_amount);?></td>
										<td class="bg-shade"></td>
										<td class="bg-shade text-right"><?php echo rupeeformat($total_received);?></td>
										<td class="bg-shade text-right"><?php echo rupeeformat($total_ounstanding);?></td>
									</tr>
									
									<?php $total_amount=0; $total_received=0; $total_ounstanding=0;  ?>
									
								<?php } ?>
								
								<?php if(($old_company=="")||($row["company_name"]!=$old_company)) { ?>
									<?php if(($_GET["cid"]=="")) { ?>
										<tr>
											<td class="bg-shade" colspan="3"><?php echo $row["company_name"]; ?></td>
											<td class="bg-shade" colspan="2">Opening Balance</td>
											<?php if(isset($start_balance[$row["company_id"]])) { ?>
											<td class="bg-shade text-right" ><?php echo rupeeformat($start_balance[$row["company_id"]]); ?></td>
											<?php }else{ ?>
											<td class="bg-shade text-right" ><?php echo rupeeformat("0.00"); ?></td>
											<?php } ?>
										</tr>
										<?php foreach($sales_payment as $pay) {  ?>
											<?php if(($row["company_id"]==$pay["dealer_id"])&&(($pay["payment_date"]<$row["invoice_date"]))){ ?>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td><?php echo date("d-m-Y",strtotime($pay["payment_date"])); ?></td>
													<td class="text-right"><?php echo rupeeformat($pay["paid_amount"]);?></td>
													<td class="text-right"><?php echo rupeeformat($total_ounstanding-$pay["paid_amount"]);?></td>
												</tr>
											<?php $total_ounstanding=$total_ounstanding-$pay["paid_amount"]; $total_received+=floatval($pay["paid_amount"]); } ?>
										<?php } ?>
									<?php $open_balance=isset($start_balance[$row["company_id"]])?$start_balance[$row["company_id"]]:0;  ?>
									<?php } ?>
								<?php } ?>
								
								<?php	
									$old_dealer_id=$row["company_id"]; 
									$old_company=$row["company_name"]; 
									$total_amount+=(floatval($row["invoice_amount"])+floatval($open_balance)); 
									$total_ounstanding+=($row["invoice_amount"]+floatval($open_balance)); 
									$open_balance=0; 
									$old_invocie_date=$row["invoice_date"];
								?>
								
								<tr>
									<td><?php echo $row["invoice_no"]; ?></td>
									<td><?php echo date("d-m-Y",strtotime($row["invoice_date"])); ?></td>
									<td class="text-right"><?php echo rupeeformat($row["invoice_amount"]);?></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupeeformat($total_ounstanding);?></td>
								</tr>
							
							<?php } ?>
							
							<!-- Paid Amount Last -->
							<?php if($old_invocie_date!=""){ ?>
								<?php foreach($sales_payment as $pay) {  ?>
									<?php if(($old_dealer_id==$pay["dealer_id"])&&($pay["payment_date"]>=$old_invocie_date)){ ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td><?php echo date("d-m-Y",strtotime($pay["payment_date"])); ?></td>
											<td class="text-right"><?php echo rupeeformat($pay["paid_amount"]);?></td>
											<td class="text-right"><?php echo rupeeformat($total_ounstanding-$pay["paid_amount"]);?></td>
										</tr>
									<?php $total_ounstanding=$total_ounstanding-$pay["paid_amount"]; $total_received+=floatval($pay["paid_amount"]); } ?>
								<?php } ?>
							<?php } ?>
							
							<tr style="">
								<td colspan="2" class="bg-shade"><?php echo "Total"; ?></td>
								<td class="bg-shade text-right"><?php echo rupeeformat($total_amount);?></td>
								<td class="bg-shade"></td>
								<td class="bg-shade text-right"><?php echo rupeeformat($total_received);?></td>
								<td class="bg-shade text-right"><?php echo rupeeformat($total_ounstanding);?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	
	<script>
			$(document).ready(function(){
			
				//window.print();
				//history.go(-1); 
			});
		</script>
	</body>
</html>