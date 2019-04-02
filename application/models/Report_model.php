<?php

class report_model extends CI_Model
{
	function __construct() {  
		parent::__construct();  
		$this->load->database();
		
	} 
	
	//Sales Statements
	
	public function getSalesReport(){
		
		$sql =" SELECT c.name as customer_name, s.company_id as customer_id, sum(s.grand_total) as invoice_amount FROM `sales` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		$sql.=" group by s.company_id"; //echo $sql;
		$result=$this->db->query($sql); 
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				
				$data[]=array(
					"customer_id" => $row["customer_id"],
					"customer_name" => $row["customer_name"],
					"invoice_amount" => floatval($row["invoice_amount"])
				);
				
			}
		}
		
		return $data;
	}
	
	public function getSalesPaymentReport(){
		
		$sql =" SELECT c.name as customer_name, s.customer_id, sum(s.paid_amount) as paid_amount FROM `sales_payment` s ";
		$sql.=" left join customer c on c.id=s.customer_id ";
		$sql.=" group by s.customer_id"; //echo $sql;
		$result=$this->db->query($sql); 
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[$row["customer_id"]]=array(
					"customer_id" => $row["customer_id"],
					"customer_name" => $row["customer_name"],
					"paid_amount" => $row["paid_amount"]
				);
			}
		}
		return $data;
	}
	
	public function getFilterSalesReport($customer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no){
		
		$data=array();
		
		$sql =" SELECT c.name as customer_name,s.company_id as customer_id, s.invoice_no, s.invoice_date, s.grand_total as invoice_amount FROM `sales` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		if(($customer_id!="")||($from_date!="")||($to_date!="")||($from_invoice_no!="")||($to_invoice_no!="")){
			$sql.=" WHERE ";
			
			if(($customer_id!="")){
				$sql.=" s.company_id in ('".$customer_id."') ";
			}
			
			if(($from_date!="")){
				if(($customer_id!="")){
					$sql.=" and ";
				}
				$sql.=" s.invoice_date >='".date("Y-m-d",strtotime($from_date))."' ";
			}
			
			if(($to_date!="")){
				if(($customer_id!="")||($from_date!="")){
					$sql.=" and ";
				}
				$sql.=" s.invoice_date <='".date("Y-m-d",strtotime($to_date))."' ";
			}
			
			if(($from_invoice_no!="")){
				if(($customer_id!="")||($from_date!="")||($to_date!="")){
					$sql.=" and ";
				}
				$sql.=" s.invoice_no >='".$from_invoice_no."' ";
			}
			
			if(($to_invoice_no!="")){
				if(($customer_id!="")||($from_date!="")||($to_date!="")||($from_invoice_no!="")){
					$sql.=" and ";
				}
				$sql.=" s.invoice_no <='".$to_invoice_no."' ";
			}
		}
		$sql.=" order by c.name,s.invoice_no asc "; //echo $sql;
		
		$result=$this->db->query($sql);
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		
		
		return $data;
	}
	
	public function getFilterSalesPaymentReport($customer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no){
		$sql="SELECT s.*,c.name as customer_name FROM `sales_payment` s";
		$sql.=" left join customer c on c.id=s.customer_id ";
		if(($customer_id!="")||($from_date!="")||($to_date!="")||($from_invoice_no!="")||($to_invoice_no!="")){
			$sql.=" WHERE ";
			
			if(($customer_id!="")){
				$sql.=" s.customer_id in ('".$customer_id."') ";
			}
			
			if(($from_date!="")){
				if(($customer_id!="")){
					$sql.=" and ";
				}
				$sql.=" s.payment_date >='".date("Y-m-d",strtotime($from_date))."' ";
			}
			
			if(($to_date!="")){
				if(($customer_id!="")||($from_date!="")){
					$sql.=" and ";
				}
				$sql.=" s.payment_date <='".date("Y-m-d",strtotime($to_date))."' ";
			}
			
			if(($from_invoice_no!="")){
				
				
				$sub_sql="select invoice_date from `sales` where ";
				if(($customer_id!="")){
					$sub_sql.=" company_id in ('".$customer_id."') and ";
				}
				
				$sub_sql.=" invoice_no >='".$from_invoice_no."' ";
				
				$sub_sql.=" order by invoice_date ASC limit 1"; //echo $sub_sql;
				
				$subresult=$this->db->query($sub_sql);
				$result_date="";
				if($subresult->num_rows()>0){ 
					foreach($subresult->result_array() as $row){ 
						$result_date=$row["invoice_date"];
					}
				}
				if($result_date!=""){ 
					if(($customer_id!="")||($from_date!="")||($to_date!="")){
						$sql.=" and ";
					}
					$sql.=" s.invoice_date >='".$result_date."' ";
				}
			}
			
			if(($to_invoice_no!="")){
				
				
				$sub_sql="select invoice_date from `sales` where";
				if(($customer_id!="")){
					$sub_sql.=" company_id in ('".$customer_id."') and ";
				}
				
				$sub_sql.=" invoice_no >='".$to_invoice_no."' ";
				
				$sub_sql.=" order by invoice_date asc limit 1"; //echo $sub_sql;
				
				$subresult=$this->db->query($sub_sql); //var_dump("hh");
				$result_date="";
				if($subresult->num_rows()>0){
					foreach($subresult->result_array() as $row){
						$result_date=$row["invoice_date"];
					}
				}
				
				if($result_date!=""){
					if(($customer_id!="")||($from_date!="")||($to_date!="")||($from_invoice_no!="")){
						$sql.=" and ";
					}
					$sql.=" s.payment_date <='".$result_date."' ";
				}
			}
			
		} //echo $sql;
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function getSaleStartingBalance($customer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no){
		
		$data=array();
		
		if(($from_date!="")||($from_invoice_no!="")){ 
			
			$payments=array(); 
			
			$sql=" select customer_id,sum(paid_amount) as paid from `sales_payment` "; 
			if(($customer_id!="")||($from_date!="")||($from_invoice_no!="")){ 
				$inter_sql="";
				if(($customer_id!="")){ 
					$inter_sql.=" customer_id in ('".$customer_id."') ";
				} 
				if(($from_date!="")){ 
					if(($customer_id!="")){
						$inter_sql.=" and ";
					}
					$inter_sql.=" payment_date <'".date("Y-m-d",strtotime($from_date))."' ";
				}
				if(($from_invoice_no!="")){ 
					
					if($customer_id!=""){
					
						
						$subsql =" select company_id as customer_id,invoice_date from `sales` WHERE company_id in ('".$customer_id."') and invoice_no <= '".$from_invoice_no."' ";
						$subsql.=" group by company_id order by customer_id DESC limit 1 ";
					
						//echo $subsql;
						$result=$this->db->query($subsql); 
						if($result->num_rows()>0){
							foreach($result->result_array() as $row){
								$pay_date=$row["invoice_date"];
							}
						}
						if(isset($pay_date)){
							$inter_sql.=" and payment_date <'".date("Y-m-d",strtotime($pay_date))."' ";
						}
					}
				}
				if($inter_sql!=""){
					$sql.=" WHERE ".$inter_sql;
				}
			}
			$sql.=" group by customer_id ";  //echo $sql."<br/>";
			$result=$this->db->query($sql);
			if($result->num_rows()>0){
				foreach($result->result_array() as $row){
					$payments[$row["customer_id"]]=$row["paid"];
				}
			}
			//var_dump($payments);
	
			
			
			$sql="SELECT company_id as customer_id, sum(grand_total) as total FROM `sales` ";
			if(($customer_id!="")||($from_date!="")||($from_invoice_no!="")){
				$sql.=" WHERE ";
				if(($customer_id!="")){
					$sql.=" company_id in ('".$customer_id."') ";
				}
				if(($from_date!="")){
					if(($customer_id!="")){
						$sql.=" and ";
					}
					$sql.=" bill_date <'".date("Y-m-d",strtotime($from_date))."' ";
				}
				if(($from_invoice_no!="")){
					if(($customer_id!="")||($from_date!="")){
						$sql.=" and ";
					}
					$sql.=" invoice_no <'".$from_invoice_no."' ";
				}
			}
			$sql.=" group by company_id ";  //echo $sql;
			$result=$this->db->query($sql);
			
			if($result->num_rows()>0){
				foreach($result->result_array() as $row){
					if(isset($data[$row["company_id"]])){
						$data[$row["company_id"]]=$data[$row["company_id"]]+$row["total"];
					}else{
						if(isset($payments[$row["company_id"]])){
							$data[$row["company_id"]]=floatval($row["total"])-floatval($payments[$row["company_id"]]);
						}else{
							$data[$row["company_id"]]=floatval($row["total"]);
						}
					}
				}
			}
			
		}
		
		return $data;
	}
	
	
	
	
	
	//Purchase Statements
	
	public function getPurchaseReport(){
		
		$sql =" SELECT c.company_name, s.company_id, sum(s.grand_total) as invoice_amount FROM `purchase` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		$sql.=" group by s.company_id"; //echo $sql;
		$result=$this->db->query($sql); 
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				
				$data[]=array(
					"dealer_id" => $row["company_id"],
					"company_name" => $row["company_name"],
					"invoice_amount" => floatval($row["invoice_amount"])
				);
				
			}
		}
		
		return $data;
	}
	
	public function getPurchasePaymentReport(){
		
		$sql =" SELECT c.company_name, s.dealer_id, sum(s.paid_amount) as paid_amount FROM `purchase_payment` s ";
		$sql.=" left join customer c on c.id=s.dealer_id ";
		$sql.=" group by s.dealer_id"; //echo $sql;
		$result=$this->db->query($sql); 
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[$row["dealer_id"]]=array(
					"dealer_id" => $row["dealer_id"],
					"company_name" => $row["company_name"],
					"paid_amount" => $row["paid_amount"]
				);
			}
		}
		return $data;
	}
	
	public function getFilterPurchaseReport($dealer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no){
		
		$data=array();
		
		$sql =" SELECT c.company_name,s.company_id, s.invoice_no, s.invoice_date, s.grand_total as invoice_amount FROM `purchase` s ";
		$sql.=" left join customer c on c.id=s.company_id ";
		if(($dealer_id!="")||($from_date!="")||($to_date!="")||($from_invoice_no!="")||($to_invoice_no!="")){
			$sql.=" WHERE ";
			
			if(($dealer_id!="")){
				$sql.=" s.company_id in ('".$dealer_id."') ";
			}
			
			if(($from_date!="")){
				if(($dealer_id!="")){
					$sql.=" and ";
				}
				$sql.=" s.invoice_date >='".date("Y-m-d",strtotime($from_date))."' ";
			}
			
			if(($to_date!="")){
				if(($dealer_id!="")||($from_date!="")){
					$sql.=" and ";
				}
				$sql.=" s.invoice_date <='".date("Y-m-d",strtotime($to_date))."' ";
			}
			
			if(($from_invoice_no!="")){
				if(($dealer_id!="")||($from_date!="")||($to_date!="")){
					$sql.=" and ";
				}
				$sql.=" s.invoice_no >='".$from_invoice_no."' ";
			}
			
			if(($to_invoice_no!="")){
				if(($dealer_id!="")||($from_date!="")||($to_date!="")||($from_invoice_no!="")){
					$sql.=" and ";
				}
				$sql.=" s.invoice_no <='".$to_invoice_no."' ";
			}
		}
//		$sql.=" order by c.company_name,s.invoice_no asc "; //echo $sql;
		$sql.=" order by s.invoice_date asc "; //echo $sql;
		
		$result=$this->db->query($sql);
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		
		
		return $data;
	}
	
	public function getFilterPurchasePaymentReport($dealer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no){
		$sql="SELECT s.*,c.company_name FROM `purchase_payment` s";
		$sql.=" left join customer c on c.id=s.dealer_id ";
		if(($dealer_id!="")||($from_date!="")||($to_date!="")||($from_invoice_no!="")||($to_invoice_no!="")){
			$sql.=" WHERE ";
			
			if(($dealer_id!="")){
				$sql.=" s.dealer_id in ('".$dealer_id."') ";
			}
			
			if(($from_date!="")){
				if(($dealer_id!="")){
					$sql.=" and ";
				}
				$sql.=" s.payment_date >='".date("Y-m-d",strtotime($from_date))."' ";
			}
			
			if(($to_date!="")){
				if(($dealer_id!="")||($from_date!="")){
					$sql.=" and ";
				}
				$sql.=" s.payment_date <='".date("Y-m-d",strtotime($to_date))."' ";
			}
			
			if(($from_invoice_no!="")){
				
				
				$sub_sql="select invoice_date from `purchase` where ";
				if(($dealer_id!="")){
					$sub_sql.=" company_id in ('".$dealer_id."') and ";
				}
				
				$sub_sql.=" invoice_no >='".$from_invoice_no."' ";
				
				$sub_sql.=" order by invoice_date ASC limit 1"; //echo $sub_sql;
				
				$subresult=$this->db->query($sub_sql);
				$result_date="";
				if($subresult->num_rows()>0){ 
					foreach($subresult->result_array() as $row){ 
						$result_date=$row["invoice_date"];
					}
				}
				if($result_date!=""){ 
					if(($dealer_id!="")||($from_date!="")||($to_date!="")){
						$sql.=" and ";
					}
					$sql.=" s.payment_date >='".$result_date."' ";
				}
			}
			
			if(($to_invoice_no!="")){
				
				
				$sub_sql="select invoice_date from `purchase` where";
				if(($dealer_id!="")){
					$sub_sql.=" company_id in ('".$dealer_id."') and ";
				}
				
				$sub_sql.=" invoice_no >='".$to_invoice_no."' ";
				
				$sub_sql.=" order by invoice_date asc limit 1"; //echo $sub_sql;
				
				$subresult=$this->db->query($sub_sql); //var_dump("hh");
				$result_date="";
				if($subresult->num_rows()>0){
					foreach($subresult->result_array() as $row){
						$result_date=$row["invoice_date"];
					}
				}
				
				if($result_date!=""){
					if(($dealer_id!="")||($from_date!="")||($to_date!="")||($from_invoice_no!="")){
						$sql.=" and ";
					}
					$sql.=" s.payment_date <='".$result_date."' ";
				}
			}
			
		} //echo $sql;
		$result=$this->db->query($sql);
		$data=array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	public function getPurchaseStartingBalance($dealer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no){
		
		$data=array();
		
		if(($from_date!="")||($from_invoice_no!="")){ 
			
			$payments=array(); 
			
			$sql=" select dealer_id,sum(paid_amount) as paid from `purchase_payment` "; 
			if(($dealer_id!="")||($from_date!="")||($from_invoice_no!="")){ 
				$inter_sql="";
				if(($dealer_id!="")){ 
					$inter_sql.=" dealer_id in ('".$dealer_id."') ";
				} 
				if(($from_date!="")){ 
					if(($dealer_id!="")){
						$inter_sql.=" and ";
					}
					$inter_sql.=" payment_date <'".date("Y-m-d",strtotime($from_date))."' ";
				}
				if(($from_invoice_no!="")){ 
					
					if($dealer_id!=""){
					
						
						$subsql =" select company_id,invoice_date from `purchase` WHERE company_id in ('".$dealer_id."') and invoice_no <= '".$from_invoice_no."' ";
						$subsql.=" group by company_id order by invoice_date DESC limit 1 ";
					
						//echo $subsql;
						$result=$this->db->query($subsql); 
						if($result->num_rows()>0){
							foreach($result->result_array() as $row){
								$pay_date=$row["invoice_date"];
							}
						}
						if(isset($pay_date)){
							$inter_sql.=" and payment_date <'".date("Y-m-d",strtotime($pay_date))."' ";
						}
					}
				}
				if($inter_sql!=""){
					$sql.=" WHERE ".$inter_sql;
				}
			}
			$sql.=" group by dealer_id ";  //echo $sql."<br/>";
			$result=$this->db->query($sql);
			if($result->num_rows()>0){
				foreach($result->result_array() as $row){
					$payments[$row["dealer_id"]]=$row["paid"];
				}
			}
			//var_dump($payments);
	
			
			
			$sql="SELECT company_id, sum(grand_total) as total FROM `purchase` ";
			if(($dealer_id!="")||($from_date!="")||($from_invoice_no!="")){
				$sql.=" WHERE ";
				if(($dealer_id!="")){
					$sql.=" company_id in ('".$dealer_id."') ";
				}
				if(($from_date!="")){
					if(($dealer_id!="")){
						$sql.=" and ";
					}
					$sql.=" invoice_date <'".date("Y-m-d",strtotime($from_date))."' ";
				}
				if(($from_invoice_no!="")){
					if(($dealer_id!="")||($from_date!="")){
						$sql.=" and ";
					}
					$sql.=" invoice_no <'".$from_invoice_no."' ";
				}
			}
			$sql.=" group by company_id ";  //echo $sql;
			$result=$this->db->query($sql);
			
			if($result->num_rows()>0){
				foreach($result->result_array() as $row){
					if(isset($data[$row["company_id"]])){
						$data[$row["company_id"]]=$data[$row["company_id"]]+$row["total"];
					}else{
						if(isset($payments[$row["company_id"]])){
							$data[$row["company_id"]]=floatval($row["total"])-floatval($payments[$row["company_id"]]);
						}else{
							$data[$row["company_id"]]=floatval($row["total"]);
						}
					}
				}
			}
			
		}
		
		return $data;
	}
	
	
	
	
	
}
?>
	