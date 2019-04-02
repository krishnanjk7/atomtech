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
				font-size: 19px;
			}
			
			tfoot tr th{
				font-size:17px;
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
				font-size:17px
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
				.container {page-break-after: always;}
			}
			@media (min-width: 1200px){
				.container {
					width: 1330px !important;
				}
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
	<?php for($j=0;$j<1;$j++) { ?>
		<div class="container pagebreak">
			
				<?php if($j==0) { ?>
				<p style="text-align:right;border:none;font-family:Montserrat-Light">Original Copy</p>
				<?php } ?>
				<?php if($j==1) { ?>
				<p style="text-align:right;border:none;font-family:Montserrat-Light">Duplicate Copy</p>
				<?php } ?>

<!--<div style="height:261.734px;width:100%;"></div> -->
			
			
			<table class="table" style="margin:0px">
				<thead>
					<tr>
						<th colspan="12" style="text-align:center;font-size: 34px;">INVOICE</th>
					</tr>
					<tr>
						<th colspan="6" style="text-align:left;font-size: 16px;">
							No.23A, M.G.R. Nagar,8th Street,<br/>
							P.N. Road, Tirupur - 641 602.<br/>
							State : Tamilnadu State Code : 33<br/>
							Mobile : 9600965676<br/>
							Email : icemantex@ymail.com<br/>
							<span style="font-size:20px;font-weight:bold">GSTIN:33APIPG8088D1ZV</span>
						</th>
						<th colspan="6" style="text-align:left;font-size:16px;vertical-align:top">
								<span style="font-size:20px;">Billed to : </span><br/><br/>
							<?php  echo $sale["company_name"];  ?>	<br/>
							<?php if($sale["address"]!=""){  echo $sale["address"].",";  }?>
							<br/>
							<?php if($sale["city"]!=""){  echo $sale["city"].",";  }?>
							<?php if($sale["state"]!=""){  echo $sale["state"]." - ";  }?>
							<?php if($sale["pincode"]!=""){  echo $sale["pincode"].".<br/>";  }?>
							<?php if($sale["email"]!=""){  echo "Email : ".$sale["email"]."<br/>";  }?>
							<?php if($sale["mobile"]!=""){  echo "Mobile : ".$sale["mobile"]."<br/>";  }?>
							<?php if($sale["land_line"]!=""){  echo "Land Line : ".$sale["land_line"]."<br/>";  }?>
							<?php if($sale["gst_no"]!=""){  echo "GST : ".$sale["gst_no"];  }?>
						</th>
					</tr>
					<tr style="height:40px">
						<th colspan="6" style="vertical-align: middle;font-size:17px;width: 50%;">
							<?php  echo "INVOICE NO";  ?><?php  echo ": ".$sale["invoice_no"];  ?>
						</th>
						<th colspan="6" style="vertical-align: middle;font-size:17px;width: 50%;">
							<?php  echo "DATE";  ?><?php  echo ": ".date("d-m-Y",strtotime($sale["invoice_date"]));  ?>
						</th>
					</tr>
				<!-- </thead>
			</table>
			<table class="table" style="margin:0px">
				<thead> -->
					<tr>
						<th class="text-center bg-shade" style="vertical-align: middle;" rowspan="2">S.NO</th>
						<th class="text-center bg-shade" style="vertical-align: middle;width: 471px !important;" rowspan="2">PRODUCT</th>
						<th class="text-center bg-shade" style="vertical-align: middle;" rowspan="2">QTY</th>
						<th class="text-center bg-shade" style="vertical-align: middle;" rowspan="2">UNIT PRICE</th>
						<th class="text-center bg-shade" style="vertical-align: middle;" rowspan="2">TAXABLE AMOUNT</th>
						<th class="text-center bg-shade" style="" colspan="2">SGST</th>
						<th class="text-center bg-shade" style="" colspan="2">CGST</th>
						<th class="text-center bg-shade" style="" colspan="2">IGST</th>
						<th class="text-center bg-shade" style="vertical-align: middle;" rowspan="2" >TOTAL</th>
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
				<tbody class="main_body">
					<?php $i=1;  $qty_total=0; $box_total=0; foreach($sale_group as $row) {  ?>
					<tr class="border_top_none border_bottom_none">
						<td class="text-center border_top_none border_bottom_none"><?php echo $i;?></td>
						<td class="border_top_none border_bottom_none"><?php echo $row["name"]." - ".$row["description"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["qty"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["rate"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["taxable_amount"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["sgst_per"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["sgst_amount"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["cgst_per"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["cgst_amount"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["igst_per"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo $row["igst_amount"];?></td>
						<td class="text-right border_top_none border_bottom_none"><?php echo rupeeformat($row["final_total"]);?></td>
					</tr>
					<?php $i++; $qty_total+=floatval($row["qty"]);    } ?>
					<?php //while($i<=18){ ?>
					<tr class="border_top_none border_bottom_none fixed_row">
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
					<?php //$i++; }?>
				</tbody>
				<!--
			</table>
			<table class='table' id='test'>
			-->
				<tfoot>
					<tr>
						<th colspan="2" class="text-right"> <p style="float:left"></p> Total </th>
						<th class="text-right"> <?php echo $qty_total; ?></th>
						<th colspan=""> </th>
						<th class="text-right"> <?php echo rupeeformat($sale["subtotal1"]); ?></th>
						<th class="text-right" colspan="2"><?php echo $sale["total_sgst"]; ?></th>
						<th class="text-right" colspan="2"><?php echo $sale["total_cgst"]; ?></th>
						<th class="text-right" colspan="2"><?php echo $sale["total_igst"]; ?></th>
						<th class="text-right"> <?php echo rupeeformat($sale["subtotal2"]); ?></th>
					</tr>
					<tr>
						<th rowspan="2" colspan="3"></th>
						<th colspan="8" style="text-align:right">TOTAL TAXABLE AMOUNT</th>
						<th class="text-right"><?php echo rupeeformat($sale["subtotal1"]); ?></th>
					</tr>
					<tr>
						<th colspan="8" style="text-align:right">TOTAL GST</th>
						<th class="text-right"><?php echo rupeeformat($sale["total_sgst"]+$sale["total_cgst"]+$sale["total_igst"]); ?></th>
					</tr> 
					<tr>
						<th rowspan="3" colspan="3" style="font-size: 14px;"> <?php echo getIndianCurrency(floatval($sale["grand_total"])); ?> </th>
						<th colspan="8" style="text-align:right">SUB TOTAL</th>
						<th class="text-right " style=""><?php echo rupeeformat($sale["subtotal2"]); ?></th>
					</tr>
					<tr>
						<th colspan="8" style="text-align:right">ROUND OFF</th>
						<th class="text-right " style=""><?php echo rupeeformat($sale["roundoff"]); ?></th>
					</tr>
					<tr>
						<th colspan="8" style="text-align:right">GRAND TOTAL</th>
						<th class="text-right bg-shade" style=""><?php echo rupeeformat($sale["grand_total"]); ?></th>
					</tr>
					<tr>
						<th colspan="12" style="text-align:center;">
							For ATOM TECH<br/><br/><br/><br/>
							Authorised Signature
						</th>
					</tr>
						
				</tfoot>
			</table>
		</div>
		<?php } ?>
		
		<script>
			$(document).ready(function(){
				
				var height=$(".main_body").css("height");
					height=710-(parseInt(height.replace("px","")));
				$(".fixed_row").css("height",height);
				//window.print();
			});
		</script>
	</body>
</html>
