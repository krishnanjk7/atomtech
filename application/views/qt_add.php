<?php include "admin_header.php"; ?>
	
	<style>
		td input{
			width: 77px;
		}
		th,td{
			font-size: 12px;
		}
		.small_a{
			text-decoration: underline;
			color: blue;
			cursor: pointer;
		}
		input[readonly]
{
    background-color:rgb(235, 235, 228);
}

.newproduct{
	padding: 1px;
    FONT-SIZE: 11px;
}
	</style>
	
	<section class="content-header">
		<h1>Quotation<small>Create</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllQt"; ?>">Quotation</a></li>
			<li class="active">Create</li>
		</ol>
	</section>
	
	
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Productd Add</h4>
				</div>
				<div class="modal-body">
					<form id="product_form">
						<div class="box-body">
						<div class="form-group col-lg-12">	
							<label class="control-label col-lg-3">Name</label>
							<div class="col-lg-8">
								<input type="text" id="pname" name="name[]" class="form-control" value=""/>
							</div>
						</div>
						<div class="form-group col-lg-12">	
							<label class="control-label col-lg-3">Tax Id</label>
							<div class="col-lg-8">
								<select class="ptax_id" name="tax_id[]">
									<option value="">--Select Tax--</option>
									<?php foreach($tax_list as $row) { ?>
										<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group col-lg-12">	
							<label class="control-label col-lg-3">Description </label>
							<div class="col-lg-8">
								<textarea class="form-control" id="pdescription" name="description[]"></textarea>
							</div>
						</div>
						<button type="submit" name="submit" id="product_submit" class="btn btn-primary">Submit</button>
							
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" id="modal_close">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					
					<form role="form" action="<?php echo base_url()."index.php/Home/addQt"; ?>" method="POST" id="purchase_form">
						<div class="box-body">
						
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Company Name</th>
										<th colspan="3">
											<select class="addcompany" name="company_id" required >
												<option value="">--Select To Address--</option>
												<?php foreach($company as $row) { 
													if(($row["type"]=="CUSTOMER")||($row["type"]=="BOTH")){
												?>
													<option value="<?php echo $row["id"];?>"><?php echo $row["company_name"];?></option>
												<?php } } ?>
											</select>
										</th>
									</tr>
									<tr>
										<th>Invoice Date</th>
										<th><input type="date" name="invoice_date" value="" required /></th>
									</tr>
									<tr>
										<th style="vertical-align:middle">Remarks</th>
										<th colspan="3"><textarea cols="50" rows="5" name="remarks"></textarea></th>
									</tr>
								</thead>
								
							</table>
							<hr/>
						
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Item</th>
										<th>Description</th>
										<th>Qty</th>
										<th>Rate</th>
										<th style="display:none">Discount</th>
										<th style="display:none">Tax</th>
										<th>Total</th>
									</tr>
									
								</thead>
								<tbody id="main_body">
									<tr>
										<td>
											<select class="addproduct" name="product_id[]">
												<option value="">--Select Product--</option>
												<?php foreach($product as $row) { ?>
													<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
												<?php } ?>
											</select>
											<br/>
											or
											<button type="button" class="btn btn-success newproduct" onClick="addNewProduct(this)">New Product</button>
										</td>
										<td>
											<textarea class="description" name="description" cols="50" rows="5"></textarea>
										</td>
										<td>
											<input type="number" class="qty" name="qty[]" onkeyup="calculateByQty(this)" />
										</td>
										<td>
											<input type="number" class="rate" name="rate[]" onkeyup="calculateByRate(this)" />
										</td>
										<td style="display:none">
											<input type="number" class="discount_per" name="discount[]" onkeyup="calculateByDiscount(this)" />
											<input type="hidden" name="discount_amount[]" class="discount"/>
										</td>
										<td  style="display:none">
											<input type="number" class="taxable_amount" name="taxable_amount[]" readonly />  <br/>
											<select class="idv_tax" name="idv_tax[]">
												<option value="">--Select Tax--</option>
												<?php foreach($tax_list as $row) { ?>
													<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
												<?php } ?>
											</select>
											<input type="hidden" class="cgst_per" name="cgst_per[]"/>
											<input type="hidden" class="sgst_per" name="sgst_per[]"/>
											<input type="hidden" class="igst_per" name="igst_per[]"/>
											
											<input type="hidden" class="cgst_amount" name="cgst_amount[]"/>
											<input type="hidden" class="sgst_amount" name="sgst_amount[]"/>
											<input type="hidden" class="igst_amount" name="igst_amount[]"/>
										</td>
										
										<td><input type="number" class="final_total" name="final_total[]" readonly />
											<br/><span class="small_a" onclick="removeEntry(this)">Remove</span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="box-footer">
						
							<button type="button" class="btn btn-success" id="add_more">Add More</button>
							<hr/>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Sub Total - I</th>
										<th><input type="text" id="sub_total1" name="sub_total1" readonly />
										</th>
									</tr>
									<tr style="display:none">
										<th>Discount</th>
										<th><input type="number" id="total_discount" name="total_discount" readonly /></th>
									</tr>
									<tr style="display:none">
										<th>Sub Total - II</th>
										<th><input type="number" id="sub_total2" name="sub_total2" readonly /></th>
									</tr>
									<tr style="display:none">
										<th>Total CGST </th>
										<th><input type="text" id="total_cgst" name="total_cgst" readonly /></th>
									</tr>
									<tr style="display:none">
										<th>Total SGST </th>
										<th><input type="text" id="total_sgst" name="total_sgst" readonly /></th>
									</tr>
									<tr style="display:none">
										<th>Total IGST </th>
										<th><input type="text" id="total_igst" name="total_igst" readonly /></th>
									</tr>
									<tr style="display:none">
										<th>Sub Total - III</th>
										<th><input type="text" id="sub_total3" name="sub_total3" readonly /></th>
									</tr>
									<tr>
										<th>Roundoff</th>
										<th><input type="text" id="roundoff" name="roundoff" readonly /></th>
									</tr>
									<tr>
										<th>Grand Total</th>
										<th><input type="text" id="grand_total" name="grand_total" readonly /></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	
	
	<script>
		
		
		function calculateIndivTax(select_tax){
			
			if($(select_tax).val()!=""){
				$.ajax({
					url:"<?php echo base_url()?>index.php/Home/searchTax",
					data:{
						id : $(select_tax).val()
					},
					type:"POST",
					dataType:"json",
					success:function(res){
						var taxable_amount=parseFloat(getValidValue($(select_tax).parent().parent().find(".taxable_amount").val()));
						var cgst=parseFloat(parseFloat(getValidValue(res["cgst"])/100)*taxable_amount).toFixed(2);
						var sgst=parseFloat(parseFloat(getValidValue(res["sgst"])/100)*taxable_amount).toFixed(2);
						var igst=parseFloat(parseFloat(getValidValue(res["igst"])/100)*taxable_amount).toFixed(2);
						
						$(select_tax).parent().parent().find(".cgst_per").val(res["cgst"]);
						$(select_tax).parent().parent().find(".sgst_per").val(res["sgst"]);
						$(select_tax).parent().parent().find(".igst_per").val(res["igst"]);
						
						$(select_tax).parent().parent().find(".cgst_amount").val(cgst);
						$(select_tax).parent().parent().find(".sgst_amount").val(sgst);
						$(select_tax).parent().parent().find(".igst_amount").val(igst);
						
						var final_total=parseFloat(taxable_amount)+parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst);
							final_total=parseFloat(final_total).toFixed(2);
						
						$(select_tax).parent().parent().find(".final_total").val(final_total);
						
					},
					complete:function(){
						calculateGrandTotal();
					}
				});
			}else{
				
				$(select_tax).parent().parent().find(".cgst_per").val(0);
				$(select_tax).parent().parent().find(".sgst_per").val(0);
				$(select_tax).parent().parent().find(".igst_per").val(0);
				
				$(select_tax).parent().parent().find(".cgst_amount").val(0);
				$(select_tax).parent().parent().find(".sgst_amount").val(0);
				$(select_tax).parent().parent().find(".igst_amount").val(0);
				
				var taxable_amount=parseFloat(getValidValue($(select_tax).parent().parent().find(".taxable_amount").val())).toFixed(2);
				$(select_tax).parent().parent().find(".final_total").val(taxable_amount);
				
				calculateGrandTotal();
			}
			
		}
		
		function getProduct(select_product){
			
			if($(select_product).val()!=""){
				$.ajax({
					url:"<?php echo base_url()?>index.php/Home/searchProduct",
					data:{
						id : $(select_product).val()
					},
					type:"POST",
					dataType:"json",
					success:function(res){
						$(select_product).parent().parent().find(".description").focus();
					}
				});
			}else{
				
			}
			
		}
		
		function TaxCalculate(select_tax){
			
			var taxable_amount=parseFloat(getValidValue($(select_tax).parent().parent().find(".taxable_amount").val())).toFixed(2);
			
			var cgst=parseFloat(getValidValue($(select_tax).parent().parent().find(".cgst_per").val())/100).toFixed(2);
			var sgst=parseFloat(getValidValue($(select_tax).parent().parent().find(".sgst_per").val())/100).toFixed(2);
			var igst=parseFloat(getValidValue($(select_tax).parent().parent().find(".igst_per").val())/100).toFixed(2);
			
			var cgst_amount=parseFloat(getValidValue(cgst*taxable_amount)).toFixed(2);
			var sgst_amount=parseFloat(getValidValue(sgst*taxable_amount)).toFixed(2);
			var igst_amount=parseFloat(getValidValue(igst*taxable_amount)).toFixed(2);
			
			$(select_tax).parent().parent().find(".cgst_amount").val(cgst_amount);
			$(select_tax).parent().parent().find(".sgst_amount").val(sgst_amount);
			$(select_tax).parent().parent().find(".igst_amount").val(igst_amount);
			
		}
		
		function calculateByQty(entered_qty){
			var qty=getValidValue($(entered_qty).val());
			var rate=getValidValue($(entered_qty).parent().parent().find(".rate").val());
			var total=parseFloat(qty)*parseFloat(rate);
				total=parseFloat(total).toFixed(2);
			var discount=getValidValue($(entered_qty).parent().parent().find(".discount_per").val());
				discount=parseFloat((parseFloat(discount)/100)*total).toFixed(2);
				$(entered_qty).parent().parent().find(".discount").val(discount); 
				//console.log(total);
				//console.log(discount);
			var	taxable_amount=total-(discount);
				taxable_amount=parseFloat(taxable_amount).toFixed(2);
				$(entered_qty).parent().parent().find(".taxable_amount").val(taxable_amount);
				
			var select_tax=$(entered_qty).parent().parent().find(".idv_tax");
			TaxCalculate(select_tax);
			
			var cgst=getValidValue($(entered_qty).parent().parent().find(".cgst_amount").val());
			var sgst=getValidValue($(entered_qty).parent().parent().find(".sgst_amount").val());
			var igst=getValidValue($(entered_qty).parent().parent().find(".igst_amount").val());
			
			var final_total=parseFloat(taxable_amount)+parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst);
				final_total=parseFloat(final_total).toFixed(2);
				$(entered_qty).parent().parent().find(".final_total").val(final_total);
				
				calculateGrandTotal();
		}
		
		function calculateByRate(entered_rate){
			var qty=getValidValue($(entered_rate).parent().parent().find(".qty").val());
			var rate=getValidValue($(entered_rate).val());
			var total=parseFloat(qty)*parseFloat(rate);
				total=parseFloat(total).toFixed(2);
			var discount=getValidValue($(entered_rate).parent().parent().find(".discount_per").val());
				discount=parseFloat((parseFloat(discount)/100)*total).toFixed(2);
				$(entered_rate).parent().parent().find(".discount").val(discount);
			var	taxable_amount=total-(discount);
				taxable_amount=parseFloat(taxable_amount).toFixed(2);
				$(entered_rate).parent().parent().find(".taxable_amount").val(taxable_amount);
			
			var select_tax=$(entered_rate).parent().parent().find(".idv_tax");
			TaxCalculate(select_tax);
			
			var cgst=getValidValue($(entered_rate).parent().parent().find(".cgst_amount").val());
			var sgst=getValidValue($(entered_rate).parent().parent().find(".sgst_amount").val());
			var igst=getValidValue($(entered_rate).parent().parent().find(".igst_amount").val());
			
			var final_total=parseFloat(taxable_amount)+parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst);
				final_total=parseFloat(final_total).toFixed(2);
			$(entered_rate).parent().parent().find(".final_total").val(final_total);
			
			calculateGrandTotal();
		}
		
		function calculateByDiscount(entered_discount){
			var qty=getValidValue($(entered_discount).parent().parent().find(".qty").val());
			var rate=getValidValue($(entered_discount).parent().parent().find(".rate").val());
			var total=parseFloat(qty)*parseFloat(rate);
				total=parseFloat(total).toFixed(2);
			var discount=getValidValue($(entered_discount).val());
				discount=parseFloat((parseFloat(discount)/100)*total).toFixed(2);
				$(entered_discount).next(".discount").val(discount);
			var	taxable_amount=total-(discount);
				taxable_amount=parseFloat(taxable_amount).toFixed(2);
				$(entered_discount).parent().parent().find(".taxable_amount").val(taxable_amount);
			
			var select_tax=$(entered_discount).parent().parent().find(".idv_tax");
			TaxCalculate(select_tax);
			
			var cgst=getValidValue($(entered_discount).parent().parent().find(".cgst_amount").val());
			var sgst=getValidValue($(entered_discount).parent().parent().find(".sgst_amount").val());
			var igst=getValidValue($(entered_discount).parent().parent().find(".igst_amount").val());
			
			var final_total=parseFloat(taxable_amount)+parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst);
				final_total=parseFloat(final_total).toFixed(2);
			$(entered_discount).parent().parent().find(".final_total").val(final_total);
			
			calculateGrandTotal();
		}
		
		function calculateGrandTotal(){
			var taxable_amount=0;
			$(".taxable_amount").each(function(){
				taxable_amount+=parseFloat(getValidValue($(this).val()));
			});
			taxable_amount=parseFloat(taxable_amount).toFixed(2);
			
			var discount=0;
			$(".discount").each(function(){
				discount+=parseFloat(getValidValue($(this).val()));
			});
			discount=parseFloat(discount).toFixed(2);
			
			var cgst=0;
			$(".cgst_amount").each(function(){
				cgst+=parseFloat(getValidValue($(this).val()));
			});
			cgst=parseFloat(cgst).toFixed(2);
			
			var sgst=0;
			$(".sgst_amount").each(function(){
				sgst+=parseFloat(getValidValue($(this).val()));
			});
			sgst=parseFloat(sgst).toFixed(2);
			
			var igst=0;
			$(".igst_amount").each(function(){
				igst+=parseFloat(getValidValue($(this).val()));
			});
			igst=parseFloat(igst).toFixed(2);
			
			var sub_total1=parseFloat(taxable_amount)+parseFloat(discount);
				sub_total1=parseFloat(sub_total1).toFixed(2);
				
				$("#sub_total1").val(sub_total1);
				$("#total_discount").val(discount);
				$("#sub_total2").val(taxable_amount);
				$("#total_cgst").val(cgst);
				$("#total_sgst").val(sgst);
				$("#total_igst").val(igst);
				
			var sub_total3=parseFloat(taxable_amount)+parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst);
				sub_total3=parseFloat(sub_total3).toFixed(2);
				
			var grand_total=Math.round(sub_total3).toFixed(2);
			var roundoff=parseFloat(grand_total-sub_total3).toFixed(2);
			$("#roundoff").val(roundoff);
			
			$("#sub_total3").val(sub_total3);
			
			grand_total=parseFloat(grand_total).toFixed(2);
			$("#grand_total").val(grand_total);
				
				
		}
		
		$(".addcompany").chosen();
		$(".addproduct").chosen().change(function(){
			getProduct(this);
		});
		$(".idv_tax").chosen().change(function(){
			calculateIndivTax(this);
		});
		
		$(".datepicker").datepicker({
			format:"dd-mm-yyyy"
		});
		
				
		function getValidValue(value){
			value=(value<0||value=="NaN"||value==""||$.isNumeric(value)==false)?0.00:value;
			return value;
		}
		
		
		$("#add_more").on("click",function(){
				
			var product="";
					
			$.ajax({
				url:"<?php echo base_url()?>index.php/Home/getJsonProducts",
				dataType:"json",
				success:function(res){
					//console.log(res);
					
					$(res).each(function(i,val){
						product+='<option value="'+val["id"]+'">'+val["name"]+'</option>';
					});
					
				},
				complete:function(){
					
					
					var html ='<tr>';
						html+='<td>';
						html+='<select class="addproduct" name="product_id[]">';
						html+='<option value="">--Select Product--</option>';
						html+=product;		
						html+='</select>';
						html+='<br/>';
						html+='or';
						html+='<button type="button" class="btn btn-success newproduct" onClick="addNewProduct(this)">New Product</button>';
						html+='</td>';
						html+='<td>';
						html+='<textarea class="description" name="description" cols="50" rows="5"></textarea>';
						html+='</td>';
						html+='<td>';
						html+='<input type="number" class="qty" name="qty[]" onkeyup="calculateByQty(this)" />';
						html+='</td>';
						html+='<td>';
						html+='<input type="number" class="rate" name="rate[]" onkeyup="calculateByRate(this)" />';
						html+='</td>';
						html+='<td style="display:none"><input type="number" class="discount_per" name="discount[]" onkeyup="calculateByDiscount(this)" />';
						html+='<input type="hidden" name="discount_amount[]" class="discount"/>';
						html+='</td>';
						html+='<td style="display:none">';
						html+='<input type="number" class="taxable_amount" name="taxable_amount[]" readonly />  <br/>';
						html+='<select class="idv_tax" name="idv_tax[]">';
						html+='<option value="">--Select Tax--</option>';
						<?php foreach($tax_list as $row) { ?>
						html+='<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>';
						<?php } ?>
						html+='</select>';
						html+='<input type="hidden" class="cgst_per" name="cgst_per[]"/>';
						html+='<input type="hidden" class="sgst_per" name="sgst_per[]"/>';
						html+='<input type="hidden" class="igst_per" name="igst_per[]"/>';
						html+='<input type="hidden" class="cgst_amount" name="cgst_amount[]"/>';
						html+='<input type="hidden" class="sgst_amount" name="sgst_amount[]"/>';
						html+='<input type="hidden" class="igst_amount" name="igst_amount[]"/>';
						html+='</td>';
						html+='<td><input type="number" class="final_total" name="final_total[]" readonly />';
						html+='<br/><span class="small_a" onclick="removeEntry(this)">Remove</span>';
						html+='</td>';
						html+='</tr>';
					
						$("#main_body").append(html);
						
						$(".datepicker").datepicker({
							format:"dd-mm-yyyy"
						});
						
						$(".addproduct").chosen().change(function(){
							getProduct(this);
						});
						
						var last_product="";
						$(".addproduct").each(function(){
							last_product=this;
						});
						
						$(last_product).trigger("chosen:activate");
						
						$(".idv_tax").chosen().change(function(){
							calculateIndivTax(this);
						});
				}
			});
	
		});
		function removeEntry(btn){
			$(btn).parent().parent("tr").remove();
			calculateGrandTotal();
		}
		
		
	</script>
	
	<script>
	
		
		function addNewProduct(selected){
			$(".newproduct").each(function(){
				if(selected==this){
					$(this).addClass("active_product");
				}else{
					$(this).removeClass("active_product");
				}
			});
			
			$("#myModal").modal("show");
		}
		
		$("#myModal").on("shown.bs.modal",function(){
				$("#pname").focus();
		});
	
		$("#product_submit").on("click",function(){
			
			$("#product_form").validate({
				rules:{
					"name[]":"required"
				},
				messages:{
					
				},
				submitHandler:function(form){
					
					if($("#pname").val()!=""){
					
						$.ajax({
							url:"<?php echo base_url(); ?>index.php/Home/addAjaxProduct",
							type:"POST",
							data:$("#product_form").serialize(),
							dataType:"json",
							success:function(res){
								var las_insert_id=res;
								
								newOption='<option value="'+las_insert_id+'">'+$("#pname").val()+'</option>';
										
								$(".addproduct").append(newOption);
								$(".addproduct").trigger("chosen:updated");
								
								$("#myModal").modal("hide");
								
								$(".newproduct").each(function(){
									if($(this).hasClass("active_product")){
										$(this).parent().parent().find(".addproduct").val(las_insert_id).trigger("chosen:updated");
										$(this).parent().parent().find(".idv_tax").val($("#ptax_id").val()).trigger("chosen:updated");
										
										$("#pname,#ptax_id,#pdescription").val("");
										
										$(this).parent().parent().find(".description").focus();
									}
								});
								
							}
						});
					}else{
						alert("Please Enter Product Details");
					}
				}
			});
		});
		
	
	</script>
	
	<script>
		
		$("#submit").on("click",function(){
			$("#purchase_form").validate({
				rules:{
					company_id:"required",
					invoice_date:"required"
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