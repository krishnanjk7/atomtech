<?php

class home_model extends CI_Model
{
	function __construct() {  
		parent::__construct();  
		$this->load->database();
		$this->load->model('home_model');
	} 
	
	
	
	//purchase 
	public function addPurchase($company_id,$invoice_no,$invoice_date,$remarks,$subtotal1,$discount,$subtotal2,$total_cgst,$total_sgst,$total_igst,$subtotal3,$roundoff,$grand_total,$created_by,$created_date){
		
		$sql="INSERT INTO `purchase`( `company_id`, `invoice_no`, `invoice_date`, `remarks`, `subtotal1`, `discount`, `subtotal2`, `total_cgst`, `total_sgst`, `total_igst`, `subtotal3`, `roundoff`, `grand_total`, `created_by`, `created_date`) VALUES ('".$company_id."','".$invoice_no."', '".$invoice_date."', '".$remarks."', '".$subtotal1."', '".$discount."', '".$subtotal2."', '".$total_cgst."',  '".$total_sgst."',  '".$total_igst."', '".$subtotal3."', '".$roundoff."',  '".$grand_total."', '".$created_by."', '".$created_date."')";
		$result=$this->db->query($sql);
		
		$sql="select * from `purchase` order by id desc limit 1";
		$result=$this->db->query($sql);
		$invoice_no=0;
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$last_id=$row["id"];
			}
		}
		
		return $last_id;
	}
	
	public function updatePurchase($company_id,$invoice_no,$invoice_date,$remarks,$subtotal1,$discount,$subtotal2,$total_cgst,$total_sgst,$total_igst,$subtotal3,$roundoff,$grand_total,$id){
		
		$sql="UPDATE `purchase` SET `company_id`='".$company_id."', `invoice_no`='".$invoice_no."', `invoice_date`='".$invoice_date."', `remarks`='".$remarks."', `subtotal1`='".$subtotal1."', `discount`='".$discount."', `subtotal2`='".$subtotal2."', `total_cgst`='".$total_cgst."', `total_sgst`='".$total_sgst."', `total_igst`='".$total_igst."', `subtotal3`='".$subtotal3."', `roundoff`='".$roundoff."', `grand_total`='".$grand_total."' WHERE id='".$id."'";
		
		$result=$this->db->query($sql);
		
	}
	
	public function addPurchaseGroup($purchase_id,$product_id,$description,$qty,$rate,$discount_per,$discount_amount,$taxable_amount,$idv_tax,$cgst_per,$sgst_per,$igst_per,$cgst_amount,$sgst_amount,$igst_amount,$final_total){
		
		for($i=0;$i<sizeof($product_id);$i++){
			
			$sql="INSERT INTO `purchase_group`(`purchase_id`, `product_id`, `description`, `qty`, `rate`, `discount_per`, `discount_amount`, `taxable_amount`, `tax_id`, `cgst_per`, `sgst_per`, `igst_per`, `cgst_amount`, `sgst_amount`, `igst_amount`, `final_total`) VALUES ('".$purchase_id."', '".$product_id[$i]."', '".$description."', '".$qty[$i]."', '".$rate[$i]."', '".$discount_per[$i]."', '".$discount_amount[$i]."', '".$taxable_amount[$i]."', '".$idv_tax[$i]."', '".$cgst_per[$i]."', '".$sgst_per[$i]."', '".$igst_per[$i]."', '".$cgst_amount[$i]."', '".$sgst_amount[$i]."', '".$igst_amount[$i]."', '".$final_total[$i]."')";
			$result=$this->db->query($sql);
		}
			
	}
	
	public function getAllPurchase(){
		$sql =" SELECT *,s.id as purchase_id FROM `purchase` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function getPurchase($id){
		$sql =" SELECT s.*,c.company_name FROM `purchase` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		$sql.=" where s.id ='".$id."' "; 
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data=$row;
			}
		}
		return $data;
	}
	
	public function getPurchaseGroup($id){
		$sql =" SELECT s.* FROM `purchase_group` s ";
		$sql.=" where s.purchase_id in ('".$id."') ";
		
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function removePurchase($id){
		
		$sql="DELETE FROM `purchase` WHERE id='".$id."' ";
		$result=$this->db->query($sql);
		
		$sql="DELETE FROM `purchase_group` WHERE purchase_id in ('".$id."') ";
		$result=$this->db->query($sql);
		
	}
	
	public function deletePurchaseGroup($sale_id){
		
		$sql="DELETE FROM `purchase_group` WHERE purchase_id in ('".$sale_id."')";
		$result=$this->db->query($sql);
		
	}
	
	//sale 
	public function addSale($company_id,$invoice_no,$invoice_date,$remarks,$subtotal1,$discount,$subtotal2,$total_cgst,$total_sgst,$total_igst,$subtotal3,$roundoff,$grand_total,$created_by,$created_date){
		
		$sql="INSERT INTO `sales`( `company_id`, `invoice_no`, `invoice_date`, `remarks`, `subtotal1`, `discount`, `subtotal2`, `total_cgst`, `total_sgst`, `total_igst`, `subtotal3`, `roundoff`, `grand_total`, `created_by`, `created_date`) VALUES ('".$company_id."','".$invoice_no."', '".$invoice_date."', '".$remarks."', '".$subtotal1."', '".$discount."', '".$subtotal2."', '".$total_cgst."',  '".$total_sgst."',  '".$total_igst."', '".$subtotal3."', '".$roundoff."',  '".$grand_total."', '".$created_by."', '".$created_date."')";
		$result=$this->db->query($sql);
		
		$sql="select * from `sales` order by id desc limit 1";
		$result=$this->db->query($sql);
		$invoice_no=0;
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$last_id=$row["id"];
			}
		}
		
		return $last_id;
	}
	
	public function updateSale($company_id,$invoice_date,$remarks,$subtotal1,$discount,$subtotal2,$total_cgst,$total_sgst,$total_igst,$subtotal3,$roundoff,$grand_total,$id){
		
		$sql="UPDATE `sales` SET `company_id`='".$company_id."', `invoice_date`='".$invoice_date."', `remarks`='".$remarks."', `subtotal1`='".$subtotal1."', `discount`='".$discount."', `subtotal2`='".$subtotal2."', `total_cgst`='".$total_cgst."', `total_sgst`='".$total_sgst."', `total_igst`='".$total_igst."', `subtotal3`='".$subtotal3."', `roundoff`='".$roundoff."', `grand_total`='".$grand_total."' WHERE id='".$id."'";
		
		$result=$this->db->query($sql);
		
	}
	
	public function addSaleGroup($sale_id,$product_id,$description,$qty,$rate,$discount_per,$discount_amount,$taxable_amount,$idv_tax,$cgst_per,$sgst_per,$igst_per,$cgst_amount,$sgst_amount,$igst_amount,$final_total){
		
		for($i=0;$i<sizeof($product_id);$i++){
			
			$sql="INSERT INTO `sales_group`(`sale_id`, `product_id`, `description`, `qty`, `rate`, `discount_per`, `discount_amount`, `taxable_amount`, `tax_id`, `cgst_per`, `sgst_per`, `igst_per`, `cgst_amount`, `sgst_amount`, `igst_amount`, `final_total`) VALUES ('".$sale_id."', '".$product_id[$i]."', '".$description."', '".$qty[$i]."', '".$rate[$i]."', '".$discount_per[$i]."', '".$discount_amount[$i]."', '".$taxable_amount[$i]."', '".$idv_tax[$i]."', '".$cgst_per[$i]."', '".$sgst_per[$i]."', '".$igst_per[$i]."', '".$cgst_amount[$i]."', '".$sgst_amount[$i]."', '".$igst_amount[$i]."', '".$final_total[$i]."')"; //echo $sql;
			$result=$this->db->query($sql);
		}
			
	}
	
	public function getAllSale(){
		$sql =" SELECT *,s.id as sale_id FROM `sales` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function getSale($id){
		$sql =" SELECT * FROM `sales` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		$sql.=" where s.id ='".$id."' "; 
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data=$row;
			}
		}
		return $data;
	}
	
	public function getSaleGroup($id){
		$sql =" SELECT s.*,p.name FROM `sales_group` s ";
		$sql.=" left join products p on p.id=s.product_id ";
		$sql.=" where s.sale_id in ('".$id."') ";
		
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function removeSale($id){
		
		$sql="DELETE FROM `sales` WHERE id='".$id."' ";
		$result=$this->db->query($sql);
		
		$sql="DELETE FROM `sales_group` WHERE sale_id in ('".$id."') ";
		$result=$this->db->query($sql);
		
	}
	
	public function deleteSaleGroup($sale_id){
		
		$sql="DELETE FROM `sales_group` WHERE sale_id in ('".$sale_id."')";
		$result=$this->db->query($sql);
		
	}
	
	
	public function getInvoiceNo1(){
		
		$sql="select * from `sales` order by abs(invoice_no) desc limit 1";
		$result=$this->db->query($sql);
		$invoice_no=0;
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$invoice_no=$row["invoice_no"];
			}
		}
		
		if($invoice_no==0){
			$invoice_no=date("Y").(date("y")+1)."1";
		}else{
			$old_dc_year_gap=substr($invoice_no,0,6);
			$old_dc_year_start=substr($old_dc_year_gap,0,4);
			$old_dc_no=str_replace($old_dc_year_gap,"",$invoice_no);
			
			if($old_dc_year_start==date("Y")){
				$invoice_no=date("Y").(date("y")+1).intval($old_dc_no)+1;
			}else{
				$invoice_no=date("Y").(date("y")+1)."1";
			}
			
		}
		
		return $invoice_no;
	}
	
	public function getInvoiceNo(){
		
		$sql="select * from `sales` order by abs(id) desc limit 1";
		$result=$this->db->query($sql);
		$invoice_no=0;
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$invoice_no=$row["invoice_no"];
			}
		}
		
		if($invoice_no==0){
			$invoice_no=date("Y").(date("y")+1)."1";
		}else{
			$old_dc_year_gap=substr($invoice_no,0,6);
			$old_dc_year_start=substr($old_dc_year_gap,0,4);
			$old_dc_no=str_replace($old_dc_year_gap,"",$invoice_no);
			
			if(date("m")>3){
				var_dump($old_dc_year_start);
				if($old_dc_year_start==date("Y")){
					$new_invoice_no=(intval($old_dc_no)+1);
					//$new_invoice_no=str_pad($new_invoice_no,4,0,STR_PAD_LEFT);
					$invoice_no=date("Y").(date("y")+1).$new_invoice_no;
				}else{
					$invoice_no=date("Y").(date("y")+1)."1";
				}
			}else{
				$new_invoice_no=(intval($old_dc_no)+1);
				//$new_invoice_no=str_pad($new_invoice_no,4,0,STR_PAD_LEFT);
				$invoice_no=(date("Y")-1).date("y").$new_invoice_no;
			}
		}
		
		return $invoice_no;
		
		
	}

	
	public function getQtNo1(){
		
		$sql="select * from `qutation` order by abs(invoice_no) desc limit 1";
		$result=$this->db->query($sql);
		$invoice_no=0;
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$invoice_no=$row["invoice_no"];
			}
		}
		
		if($invoice_no==0){
			$invoice_no=date("Y").(date("y")+1)."1";
		}else{
			$old_dc_year_gap=substr($invoice_no,0,6);
			$old_dc_year_start=substr($old_dc_year_gap,0,4);
			$old_dc_no=str_replace($old_dc_year_gap,"",$invoice_no);
			
			if($old_dc_year_start==date("Y")){
				$invoice_no=date("Y").(date("y")+1).intval($old_dc_no)+1;
			}else{
				$invoice_no=date("Y").(date("y")+1)."1";
			}
			
		}
		
		return $invoice_no;
	}
	
	public function getQtNo(){
		
		$sql="select * from `qutation` order by abs(invoice_no) desc limit 1";
		$result=$this->db->query($sql);
		$invoice_no=0;
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$invoice_no=$row["invoice_no"];
			}
		}
		
		if($invoice_no==0){
			$invoice_no=date("Y").(date("y")+1)."1";
		}else{
			$old_dc_year_gap=substr($invoice_no,0,6);
			$old_dc_year_start=substr($old_dc_year_gap,0,4);
			$old_dc_no=str_replace($old_dc_year_gap,"",$invoice_no);
			
			if(date("m")>3){
				if($old_dc_year_start==date("Y")){
					$new_invoice_no=(intval($old_dc_no)+1);
					//$new_invoice_no=str_pad($new_invoice_no,4,0,STR_PAD_LEFT);
					$invoice_no=date("Y").(date("y")+1).$new_invoice_no;
				}else{
					$invoice_no=date("Y").(date("y")+1)."1";
				}
			}else{
				$new_invoice_no=(intval($old_dc_no)+1);
				//$new_invoice_no=str_pad($new_invoice_no,4,0,STR_PAD_LEFT);
				$invoice_no=(date("Y")-1).date("y").$new_invoice_no;
			}
		}
		
		return $invoice_no;
		
		
	}
	
	
	
	function getAllProduct(){
		$sql="SELECT * FROM `products`";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		
		return $data;
	}
	
	public function getProduct($id){
		$sql="SELECT * FROM `products` where id='".$id."'";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data=$row;
			}
		}
		return $data;
	}
	
	function addProduct($name,$tax_id,$description){
		
		for($i=0;$i<sizeof($name);$i++){
			
			$sql='INSERT INTO `products`( `name`, `tax_id`, `description`) VALUES ("'.$name[$i].'", "'.$tax_id[$i].'", "'.$description[$i].'" )';
			$this->db->query($sql);
			
		}
		
		
		$sql="select * from `products` order by id desc limit 1";
		$result=$this->db->query($sql);
		$invoice_no=0;
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$last_id=$row["id"];
			}
		}
		
		return $last_id;
	}
	
	public function updateProduct($id,$name,$tax_id,$description){
		
		$sql='UPDATE `products` SET `name`="'.$name.'", `tax_id`="'.$tax_id.'", `description`="'.$description.'" WHERE  `id`="'.$id.'" ';
		$result=$this->db->query($sql);
		
	}
	
	public function getAllCustomer(){
		$sql="SELECT * FROM `customer`";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function getCustomer($id){
		$sql="SELECT * FROM `customer` where id='".$id."'";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data=$row;
			}
		}
		return $data;
	}
	
	public function addCustomer($name,$company_name,$email,$mobile,$land_line,$address,$city,$state,$pincode,$gst_no,$type){
		$sql="INSERT INTO `customer`( `name`, `company_name`, `email`, `mobile`, `land_line`, `address`, `city`, `state`, `pincode`, `gst_no`, `type`) VALUES ('".$name."', '".$company_name."', '".$email."', '".$mobile."', '".$land_line."', '".$address."', '".$city."', '".$state."', '".$pincode."', '".$gst_no."', '".$type."')"; //echo $sql;
		$result=$this->db->query($sql);
		
	}
	
	public function updateCustomer($id,$name,$company_name,$email,$mobile,$land_line,$address,$city,$state,$pincode,$gst_no,$type){
		
		$sql="UPDATE `customer` SET `name`='".$name."', `company_name`='".$company_name."', `email`='".$email."', `mobile`='".$mobile."', `land_line`='".$land_line."', `address`='".$address."', `city`='".$city."', `state`='".$state."', `pincode`='".$pincode."', `gst_no`='".$gst_no."', `type`='".$type."'  WHERE  `id`='".$id."' ";
		
		$result=$this->db->query($sql);
		
	}
	
	public function getAllTax(){
		$sql="SELECT * FROM `tax`";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function getTax($id){
		$sql="SELECT * FROM `tax` where id='".$id."'";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data=$row;
			}
		}
		return $data;
	}
	
	public function addTax($name,$cgst,$sgst,$igst){
		$sql="INSERT INTO `tax`(`name`, `cgst`, `sgst`, `igst`) VALUES ('".$name."', '".$cgst."', '".$sgst."', '".$igst."')";
		$result=$this->db->query($sql);
		
	}
	
	public function updateTax($id,$name,$cgst,$sgst,$igst){
		
		$sql="UPDATE `tax` SET `name`='".$name."', `cgst`='".$cgst."', `sgst`='".$sgst."', `igst`='".$igst."' WHERE  `id`='".$id."' ";
		$result=$this->db->query($sql);
		
	}
	
	
	//Purchase Payment
	public function getAllPurchasePayment(){
		$sql="SELECT sp.*,c.company_name FROM `purchase_payment` sp";
		$sql.=" left join customer c on c.id=sp.dealer_id ";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function getPurchasePayment($id){
		$sql="SELECT * FROM `purchase_payment` where id='".$id."'";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data=$row;
			}
		}
		return $data;
	}
	
	public function addPurchasePayment($dealer_id,$paid_amount,$payment_mode,$payment_date,$remarks){
		
		$sql="INSERT INTO `purchase_payment`( `dealer_id`, `paid_amount`, `payment_mode`, `payment_date`, `remarks`) VALUES ('".$dealer_id."', '".$paid_amount."', '".$payment_mode."', '".$payment_date."', '".$remarks."')";
		$result=$this->db->query($sql);
		
	}
	
	public function updatePurchasePayment($id,$dealer_id,$paid_amount,$payment_mode,$payment_date,$remarks){
		
		$sql="UPDATE `purchase_payment` SET `dealer_id`='".$dealer_id."', `paid_amount`='".$paid_amount."', `payment_mode`='".$payment_mode."', `payment_date`='".$payment_date."', `remarks`='".$remarks."' WHERE `id`='".$id."' "; echo $sql;
		$result=$this->db->query($sql);
		
	}
	
	//Sales Payment
	public function getAllSalesPayment(){
		$sql="SELECT sp.*,c.name as customer_name FROM `sales_payment` sp";
		$sql.=" left join customer c on c.id=sp.customer_id ";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function getSalesPayment($id){
		$sql="SELECT * FROM `sales_payment` where id='".$id."'";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data=$row;
			}
		}
		return $data;
	}
	
	public function addSalesPayment($customer_id,$paid_amount,$payment_mode,$payment_date,$remarks){
		
		$sql="INSERT INTO `sales_payment`( `customer_id`, `paid_amount`, `payment_mode`, `payment_date`, `remarks`) VALUES ('".$customer_id."', '".$paid_amount."', '".$payment_mode."', '".$payment_date."', '".$remarks."')";
		$result=$this->db->query($sql);
		
	}
	
	public function updateSalesPayment($id,$customer_id,$paid_amount,$payment_mode,$payment_date,$remarks){
		
		$sql="UPDATE `sales_payment` SET `customer_id`='".$customer_id."', `paid_amount`='".$paid_amount."', `payment_mode`='".$payment_mode."', `payment_date`='".$payment_date."', `remarks`='".$remarks."' WHERE `id`='".$id."' "; echo $sql;
		$result=$this->db->query($sql);
		
	}
	
	
	
	//Quotation
	
	public function addQt($company_id,$invoice_no,$invoice_date,$remarks,$subtotal1,$roundoff,$grand_total,$created_by,$created_date){
		
		$sql="INSERT INTO `qutation`( `company_id`, `invoice_no`, `invoice_date`, `remarks`, `sub_total`, `roundoff`, `grand_total`, `created_by`, `created_date`) VALUES ('".$company_id."','".$invoice_no."', '".$invoice_date."', '".$remarks."', '".$subtotal1."', '".$roundoff."',  '".$grand_total."', '".$created_by."', '".$created_date."')";
		$result=$this->db->query($sql);
		
		$sql="select * from `qutation` order by id desc limit 1";
		$result=$this->db->query($sql);
		$invoice_no=0;
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$last_id=$row["id"];
			}
		}
		
		return $last_id;
	}
	
	public function updateQt($company_id,$invoice_date,$remarks,$subtotal1,$roundoff,$grand_total,$id){
		
		$sql="UPDATE `qutation` SET `company_id`='".$company_id."', `invoice_date`='".$invoice_date."', `remarks`='".$remarks."', `sub_total`='".$subtotal1."', `roundoff`='".$roundoff."', `grand_total`='".$grand_total."' WHERE id='".$id."'";
		
		$result=$this->db->query($sql);
		
	}
	
	public function addQtGroup($sale_id,$product_id,$description,$qty,$rate,$final_total){
		
		for($i=0;$i<sizeof($product_id);$i++){
			
			$sql="INSERT INTO `qutation_group`(`purchase_id`, `product_id`, `description`, `qty`, `rate`, `final_total`) VALUES ('".$sale_id."', '".$product_id[$i]."', '".$description."', '".$qty[$i]."', '".$rate[$i]."', '".$final_total[$i]."')"; //echo $sql;
			$result=$this->db->query($sql);
		}
			
	}
	
	public function getAllQt(){
		$sql =" SELECT *,s.id as sale_id FROM `qutation` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function getQt($id){
		$sql =" SELECT * FROM `qutation` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		$sql.=" where s.id ='".$id."' "; 
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data=$row;
			}
		}
		return $data;
	}
	
	public function getQtGroup($id){
		$sql =" SELECT s.*,p.name FROM `qutation_group` s ";
		$sql.=" left join products p on p.id=s.product_id ";
		$sql.=" where s.purchase_id in ('".$id."') ";
		
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function removeQt($id){
		
		$sql="DELETE FROM `qutation` WHERE id='".$id."' ";
		$result=$this->db->query($sql);
		
		$sql="DELETE FROM `qutation_group` WHERE purchase_id in ('".$id."') ";
		$result=$this->db->query($sql);
		
	}
	
	public function deleteQtGroup($sale_id){
		
		$sql="DELETE FROM `qutation_group` WHERE purchase_id in ('".$sale_id."')";
		$result=$this->db->query($sql);
		
	}
	
}
?>
