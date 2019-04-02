<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->model('home_model');
		$this->load->model('report_model');
	}

	public function index()
	{
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
	}
	
	public function getSalesReportOverview(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$sales=$this->report_model->getSalesReport(); 
		$payments=$this->report_model->getSalesPaymentReport(); 
		$records=array();
		foreach($sales as $sale){ 
			
			$invoice_amount=$sale["invoice_amount"];
			$paid_amount=0;
			if(isset($payments[$sale["customer_id"]])){
				$paid_amount=$payments[$sale["customer_id"]]["paid_amount"];
				unset($payments[$sale["customer_id"]]);
			}
			
			$balance_amount=floatval($invoice_amount)-floatval($paid_amount);
			
			$records[]=array(
				'customer_id' => $sale["customer_id"],
				'customer_name' => $sale["customer_name"],
				'invoice_amount' => $invoice_amount,
				'paid_amount' => $paid_amount,
				'balance_amount' => $balance_amount
			);
			
		}
		
		foreach($payments as $payment){
			$records[]=array(
				'customer_id' => $payment["customer_id"],
				'customer_name' => $payment["customer_name"],
				'invoice_amount' => 0,
				'paid_amount' => floatval($payment["paid_amount"]),
				'balance_amount' => 0-floatval($payment["paid_amount"])
			);
		}
		$data["records"]=$records;
		$this->load->view('sale_report_overview',$data);
	}
	
	public function getSalesReportForm(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["company"]=$this->home_model->getAllCustomer();
		
		$this->load->view('sale_report_form',$data);
	}
	
	public function printSalesReport(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$customer_id=isset($_GET["cid"])?$_GET["cid"]:"";
		$from_date=isset($_GET["from_date"])?$_GET["from_date"]:"";
		$to_date=isset($_GET["to_date"])?$_GET["to_date"]:"";
		$from_invoice_no=isset($_GET["from_invoice_no"])?$_GET["from_invoice_no"]:"";
		$to_invoice_no=isset($_GET["to_invoice_no"])?$_GET["to_invoice_no"]:"";
		$data["records"]=$this->report_model->getFilterSalesReport($customer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no);
		
		$data["company"]=$this->home_model->getAllCustomer();
		$data["sales_payment"]=$this->report_model->getFilterSalesPaymentReport($customer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no);
		$data["start_balance"]=$this->report_model->getSaleStartingBalance($customer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no);
		//var_dump(sizeof($data["company"]));
		$this->load->view('sale_report_print',$data);
	}
	
	
	
	//Purchase 
	
	public function getPurchaseReportOverview(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$sales=$this->report_model->getPurchaseReport(); 
		$payments=$this->report_model->getPurchasePaymentReport(); 
		$records=array();
		foreach($sales as $sale){ 
			
			$invoice_amount=$sale["invoice_amount"];
			$paid_amount=0;
			if(isset($payments[$sale["dealer_id"]])){
				$paid_amount=$payments[$sale["dealer_id"]]["paid_amount"];
				unset($payments[$sale["dealer_id"]]);
			}
			
			$balance_amount=floatval($invoice_amount)-floatval($paid_amount);
			
			$records[]=array(
				'dealer_id' => $sale["dealer_id"],
				'company_name' => $sale["company_name"],
				'invoice_amount' => $invoice_amount,
				'paid_amount' => $paid_amount,
				'balance_amount' => $balance_amount
			);
			
		}
		
		foreach($payments as $payment){
			$records[]=array(
				'dealer_id' => $payment["dealer_id"],
				'company_name' => $payment["company_name"],
				'invoice_amount' => 0,
				'paid_amount' => floatval($payment["paid_amount"]),
				'balance_amount' => 0-floatval($payment["paid_amount"])
			);
		}
		$data["records"]=$records;
		$this->load->view('purchase_report_overview',$data);
	}
	
	public function getPurchaseReportForm(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["company"]=$this->home_model->getAllCustomer();
		
		$this->load->view('purchase_report_form',$data);
	}
	
	public function printPurchaseReport(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$dealer_id=isset($_GET["cid"])?$_GET["cid"]:"";
		$from_date=isset($_GET["from_date"])?$_GET["from_date"]:"";
		$to_date=isset($_GET["to_date"])?$_GET["to_date"]:"";
		$from_invoice_no=isset($_GET["from_invoice_no"])?$_GET["from_invoice_no"]:"";
		$to_invoice_no=isset($_GET["to_invoice_no"])?$_GET["to_invoice_no"]:"";
		$data["records"]=$this->report_model->getFilterPurchaseReport($dealer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no);
		
		$data["company"]=$this->home_model->getAllCustomer();
		$data["sales_payment"]=$this->report_model->getFilterPurchasePaymentReport($dealer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no);
		$data["start_balance"]=$this->report_model->getPurchaseStartingBalance($dealer_id,$from_date,$to_date,$from_invoice_no,$to_invoice_no);
		//var_dump($data["records"]);
		$this->load->view('purchase_report_print',$data);
	}
	
}