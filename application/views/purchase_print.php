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
		<style>
			#right_table_head{
				margin:0px;
			}
			table,th,td{
				font-size: 16px;
			}
			
			tfoot tr th{
				font-size:16px;
			}
			
			table,th,td{
				font-family: Montserrat;
				font-weight: 100;
			}
			th,td{
				border:2px solid #000000 !important;
			}
			#right_table_head td{ 
				padding:3px;
				border:none !important;
				font-size:15px
			}
			
			.border_bottom_none{
				border-bottom:none !important;
			}
			.border_top_none{
				border-top:none !important;
			}
			.bg-shade{
			   background-color:#a5a2a2;
			}
			@media print{
				.bg-shade{
				   background-color:#a5a2a2;
				}
			}
			@media print {
				#test{
					page-break-after: always !IMPORTANT;
				}
				.container {page-break-after: always;}
			}
			
		</style>
	</head>
	<body>
	<?php 
	
		function getIndianCurrency($number){
			
			$decimal = round($number - ($no = floor($number)), 2) * 100;
			$hundred = null;
			$digits_length = strlen($no);
			$i = 0;
			$str = array();
			$words = array(0 => '', 1 => 'ONE', 2 => 'TWO',
				3 => 'THREE', 4 => 'FOUR', 5 => 'FIVE', 6 => 'SIX',
				7 => 'SEVEN', 8 => 'EIGHT', 9 => 'NINE',
				10 => 'TEN', 11 => 'ELEVEN', 12 => 'TWELVE',
				13 => 'THIRETEEN', 14 => 'FOURTEEN', 15 => 'FIFTEEN',
				16 => 'SIXTEEN', 17 => 'SEVENTEEN', 18 => 'EIGHTEEN',
				19 => 'NINETEEN', 20 => 'TWENTY', 30 => 'THIRTY',
				40 => 'FOUTRY', 50 => 'FIFTY', 60 => 'SIXTY',
				70 => 'SEVENTY', 80 => 'EIGHTY', 90 => 'NINETY');
			$digits = array('', 'HUNDRED','THOUSAND','LAKH', 'CRORE');
			while( $i < $digits_length ) {
				$divider = ($i == 2) ? 10 : 100;
				$number = floor($no % $divider);
				$no = floor($no / $divider);
				$i += $divider == 10 ? 1 : 2;
				if ($number) {
					$plural = (($counter = count($str)) && $number > 9) ? 'S' : null;
					$hundred = ($counter == 1 && $str[0]) ? ' AND ' : null;
					$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
				} else $str[] = null;
			}
			$Rupees = implode('', array_reverse($str));
			$paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' PAISE' : '';
			return ($Rupees ? $Rupees . 'ONLY ' : '') . $paise ;
		}
	
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
	<?php for($j=0;$j<2;$j++) { ?>
		<div class="container pagebreak" style="">
			
				<?php if($j==0) { ?>
				<p style="text-align:right;border:none;font-family:Montserrat-Light">Original Copy</p>
				<?php } ?>
				<?php if($j==1) { ?>
				<p style="text-align:right;border:none;font-family:Montserrat-Light">Duplicate Copy</p>
				<?php } ?>

			<img src="<?php echo base_url();?>assets/img/amt.png" style="width:100%" />
			<table class="table" style="margin:0px">
				<thead>
					<tr>
						<th colspan="12" style="text-align:center;font-size: 34px;">PURCHASE ORDER</th>
					</tr>
					
					<tr style="">
						<th colspan="6" style="padding: 0px;vertical-align: top;font-size:17px;width: 50%;border-bottom: none !important;">
							Name and address of the deliverer, <br/><br/>
							<?php  echo $purchase["company_name"];  ?>	<br/>
							<?php  echo $purchase["address"];  ?><br/>
							<?php if($purchase["email"]!=""){  echo "Email : ".$purchase["email"]."<br/>";  }?>
							<?php if($purchase["mobile"]!=""){  echo "Mobile : ".$purchase["mobile"]."<br/>";  }?>
							<?php if($purchase["land_line"]!=""){  echo "Land Line : ".$purchase["land_line"]."<br/>";  }?>
							<?php if($purchase["gstin"]!=""){  echo "GSTIN : ".$purchase["gstin"];  }?></br>
							Contact Person : <?php echo $purchase["to_contact_person"];?></br>
							Phone No : <?php echo $purchase["to_phone"];?>
						</th>
						<th colspan="6" style="padding:0px;width: 50%;vertical-align: top;border-bottom: none !important;" id="no_padding">
							<table id="right_table_head" class="table">
								<tbody>
									<tr class="bg-shade" style="border-bottom:2px solid black">
										<td style="width: 50%;">P.O. NO. : <?php echo str_replace(",",", ",$purchase["po_no"]);?></td>
										<td>DATE  : <?php echo date("d-m-Y",strtotime($purchase["po_date"])); ?></td>
									</tr>
									<tr >
										<td>Contact Person</td>
										<td>: <?php echo $purchase["from_contact_person"];?></td>
									</tr>
									<tr >
										<td>Phone No</td>
										<td>: <?php echo $purchase["from_phone"];?></td>
									</tr>
								</tbody>
							</table>
						</th>
					</tr>
				</thead>
			</table>
			<table class="table" style="margin:0px">
				<thead>
					<tr>
						<th rowspan="2" class="text-center bg-shade" style="vertical-align: middle;">S.NO</th>
						<th rowspan="2" class="text-center bg-shade" style="vertical-align: middle;">PARTICULARS</th>
						<th rowspan="2" class="text-center bg-shade" style="">TOTAL QTY <br/> (kg/pieces)</th>
						<th rowspan="2" class="text-center bg-shade" style="">RATE <br/>/UNIT </th>
						<th  rowspan="2" class="text-center bg-shade" style="">TAXABLE <br/> AMOUNT</th>
						<th colspan="2" class="text-center bg-shade" style="">SGST</th>
						<th colspan="2" class="text-center bg-shade" style="">CGST</th>
						<th colspan="2" class="text-center bg-shade" style="">IGST</th>
						<th rowspan="2" class="text-center bg-shade" style="">TOTAL <br/> (Rs.)</th>
					</tr>
					<tr>
						
						<th class="text-center bg-shade" style="">%</th>
						<th class="text-center bg-shade" style="">Amt</th>
						<th class="text-center bg-shade" style="">%</th>
						<th class="text-center bg-shade" style="">Amt</th>
						<th class="text-center bg-shade" style="">%</th>
						<th class="text-center bg-shade" style="">Amt</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1;  $qty_total=0;  foreach($purchase_group as $row) {  ?>
					<tr class="border_top_none border_bottom_none">
						<td class="text-center border_top_none border_bottom_none"><?php echo $i;?></td>
						<td class="border_top_none border_bottom_none"><?php echo $row["product_name"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["qty"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["unit_price"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["taxable_amount"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["sgst_per"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["sgst_amount"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["cgst_per"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["cgst_amount"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["igst_per"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["igst_amount"];?></td>
						
						
						<td class="text-right border_top_none border_bottom_none"><?php echo rupeeformat($row["final_total"]);?></td>
					</tr>
					<?php $i++; $qty_total+=floatval($row["qty"]);   } ?>
					<?php while($i<=11){ ?>
					<tr class="border_top_none border_bottom_none" style="height:43px">
						<td class="text-center border_top_none border_bottom_none"></td>
						<td class="border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
						<td class="text-right border_top_none border_bottom_none"></td>
					</tr>
					<?php $i++; }?>
				</tbody>
			</table>
			<table class='table' id='test'>
				<tfoot>
					
					<tr>
						<th colspan="5" style="text-align:left">Delivery At: <?php echo $purchase["delivery_at"]; ?></th>
						<th colspan="6" style="text-align:right">TOTAL TAXABLE VALUE FOR GOODS</th>
						<th class="text-right"><?php echo rupeeformat($purchase["subtotal1"]); ?></th>
					</tr>
					<!-- <tr>
						
						<th colspan="3" style="text-align:right">DISCOUNT</th>
						<th class="text-right"><?php echo $purchase["discount"]; ?></th>
					</tr> 
					<tr>
						<th colspan="3" style="text-align:right">TOTAL TAXABLE VALUE FOR GOODS & SERVICES</th>
						<th class="text-right"><?php echo rupeeformat($purchase["subtotal2"]); ?></th>
					</tr> -->
					
					<tr>
						<th colspan="5" style="text-align:left">Delivery Date: <?php echo date("d-m-Y",strtotime($purchase["delivery_date"])); ?></th>
						<th colspan="6" style="text-align:right">SGST </th>
						<th class="text-right"><?php echo $purchase["total_sgst"]; ?></th>
					</tr>
					<tr>
						
						<th colspan="11" style="text-align:right">CGST </th>
						<th class="text-right"><?php echo $purchase["total_cgst"]; ?></th>
					</tr>
					<tr>
						<th colspan="11" style="text-align:right">IGST </th>
						<th class="text-right"><?php echo $purchase["total_igst"]; ?></th>
					</tr>
					<tr>
						<th colspan="11" style="text-align:right">ROUNDED OFF</th>
						<th class="text-right"><?php echo $purchase["roundoff"]; ?></th>
					</tr>
					<tr>
						<th colspan="5" style="font-size: 14px;"> <?php echo getIndianCurrency(floatval($purchase["final_total"])); ?> </th>
						<th colspan="6" style="text-align:right">GRAND TOTAL</th>
						<th class="text-right bg-shade" style=""><?php echo rupeeformat($purchase["final_total"]); ?></th>
					</tr>
					<tr>
						<th colspan="5" style="text-align:center;vertical-align:bottom">
							Checked By
						</th>
						<th colspan="7" style="text-align:center;">
							For Sri Amman Tapes<br/><br/><br/><br/>
							Authorised Signature
						</th>
					</tr>
					<tr style="border:none !important">
						<th colspan="13" style="text-align:center;vertical-align:bottom;border:none !important">
							<p style="text-align:center;border:none;font-family:Montserrat-Light">Subject to Tirupur Juristriction</p>
						</th>
					</tr>
				</tfoot>
			</table>
			
		</div>
		<?php } ?>
		
		<script>
			$(document).ready(function(){
				//window.print();
			});
		</script>
	</body>
</html>
