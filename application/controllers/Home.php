<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		
		$this->load->view('dashboard');
	}
	
	public function PurchasePrint(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["purchase"]=$this->home_model->getPurchase($_GET["id"]);
		$data["purchase_group"]=$this->home_model->getPurchaseGroup($_GET["id"]);
		
		$this->load->view('purchase_print',$data);
	}
	
	public function getAllPurchase(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["records"]=$this->home_model->getAllPurchase();
		$this->load->view('purchase_list',$data);
	}
	
	public function addPurchase(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		
		if(isset($_POST["submit"])){ 
			
			$company_id=isset($_POST["company_id"])?$_POST["company_id"]:"";
			$invoice_no=isset($_POST["invoice_no"])?$_POST["invoice_no"]:"";
			$invoice_date=isset($_POST["invoice_date"])?date("Y-m-d",strtotime($_POST["invoice_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			$subtotal1=isset($_POST["sub_total1"])?$_POST["sub_total1"]:"";
			$discount=isset($_POST["total_discount"])?$_POST["total_discount"]:"";
			$subtotal2=isset($_POST["sub_total2"])?$_POST["sub_total2"]:"";
			$total_cgst=isset($_POST["total_cgst"])?$_POST["total_cgst"]:"";
			$total_sgst=isset($_POST["total_sgst"])?$_POST["total_sgst"]:"";
			$total_igst=isset($_POST["total_igst"])?$_POST["total_igst"]:"";
			$subtotal3=isset($_POST["sub_total3"])?$_POST["sub_total3"]:"";
			$roundoff=isset($_POST["roundoff"])?$_POST["roundoff"]:"";
			$grand_total=isset($_POST["grand_total"])?$_POST["grand_total"]:"";
		
			$created_by=$this->ion_auth->get_user_id();
			$created_date=date("Y-m-d H:i:s");
			
			$purchase_id=$this->home_model->addPurchase($company_id,$invoice_no,$invoice_date,$remarks,$subtotal1,$discount,$subtotal2,$total_cgst,$total_sgst,$total_igst,$subtotal3,$roundoff,$grand_total,$created_by,$created_date);
			
			$product_id	=isset($_POST["product_id"])?$_POST["product_id"]:"";
			$description	=isset($_POST["description"])?$_POST["description"]:"";
			$qty		=isset($_POST["qty"])?$_POST["qty"]:"";
			$rate		=isset($_POST["rate"])?$_POST["rate"]:"";
			$discount_per=isset($_POST["discount"])?$_POST["discount"]:"";
			$discount_amount=isset($_POST["discount_amount"])?$_POST["discount_amount"]:"";
			$taxable_amount=isset($_POST["taxable_amount"])?$_POST["taxable_amount"]:"";
			$idv_tax	=isset($_POST["idv_tax"])?$_POST["idv_tax"]:"";
			$cgst_per	=isset($_POST["cgst_per"])?$_POST["cgst_per"]:"";
			$sgst_per	=isset($_POST["sgst_per"])?$_POST["sgst_per"]:"";
			$igst_per	=isset($_POST["igst_per"])?$_POST["igst_per"]:"";
			$cgst_amount=isset($_POST["cgst_amount"])?$_POST["cgst_amount"]:"";
			$sgst_amount=isset($_POST["sgst_amount"])?$_POST["sgst_amount"]:"";
			$igst_amount=isset($_POST["igst_amount"])?$_POST["igst_amount"]:"";
			$final_total=isset($_POST["final_total"])?$_POST["final_total"]:"";
			
			$this->home_model->addPurchaseGroup($purchase_id,$product_id,$description,$qty,$rate,$discount_per,$discount_amount,$taxable_amount,$idv_tax,$cgst_per,$sgst_per,$igst_per,$cgst_amount,$sgst_amount,$igst_amount,$final_total);
			
			redirect("Home/getAllPurchase");
			
		}else{
		
			$data["product"]=$this->home_model->getAllProduct();
			$data["company"]=$this->home_model->getAllCustomer();
			$data["tax_list"]=$this->home_model->getAllTax();
			
			$this->load->view('purchase_add',$data);
		}
	}
	
	public function updatePurchase(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		
		if(isset($_POST["submit"])){ 
			
			$id=isset($_POST["id"])?$_POST["id"]:"";
			
			$company_id=isset($_POST["company_id"])?$_POST["company_id"]:"";
			$invoice_no=isset($_POST["invoice_no"])?$_POST["invoice_no"]:"";
			$invoice_date=isset($_POST["invoice_date"])?date("Y-m-d",strtotime($_POST["invoice_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			$subtotal1=isset($_POST["sub_total1"])?$_POST["sub_total1"]:"";
			$discount=isset($_POST["total_discount"])?$_POST["total_discount"]:"";
			$subtotal2=isset($_POST["sub_total2"])?$_POST["sub_total2"]:"";
			$total_cgst=isset($_POST["total_cgst"])?$_POST["total_cgst"]:"";
			$total_sgst=isset($_POST["total_sgst"])?$_POST["total_sgst"]:"";
			$total_igst=isset($_POST["total_igst"])?$_POST["total_igst"]:"";
			$subtotal3=isset($_POST["sub_total3"])?$_POST["sub_total3"]:"";
			$roundoff=isset($_POST["roundoff"])?$_POST["roundoff"]:"";
			$grand_total=isset($_POST["grand_total"])?$_POST["grand_total"]:"";
			
			$this->home_model->updatePurchase($company_id,$invoice_no,$invoice_date,$remarks,$subtotal1,$discount,$subtotal2,$total_cgst,$total_sgst,$total_igst,$subtotal3,$roundoff,$grand_total,$id);
			
			$purchase_id=$id;
			
			$this->home_model->deletePurchaseGroup($purchase_id);
			
			$product_id	=isset($_POST["product_id"])?$_POST["product_id"]:"";
			$description	=isset($_POST["description"])?$_POST["description"]:"";
			$qty		=isset($_POST["qty"])?$_POST["qty"]:"";
			$rate		=isset($_POST["rate"])?$_POST["rate"]:"";
			$discount_per=isset($_POST["discount"])?$_POST["discount"]:"";
			$discount_amount=isset($_POST["discount_amount"])?$_POST["discount_amount"]:"";
			$taxable_amount=isset($_POST["taxable_amount"])?$_POST["taxable_amount"]:"";
			$idv_tax	=isset($_POST["idv_tax"])?$_POST["idv_tax"]:"";
			$cgst_per	=isset($_POST["cgst_per"])?$_POST["cgst_per"]:"";
			$sgst_per	=isset($_POST["sgst_per"])?$_POST["sgst_per"]:"";
			$igst_per	=isset($_POST["igst_per"])?$_POST["igst_per"]:"";
			$cgst_amount=isset($_POST["cgst_amount"])?$_POST["cgst_amount"]:"";
			$sgst_amount=isset($_POST["sgst_amount"])?$_POST["sgst_amount"]:"";
			$igst_amount=isset($_POST["igst_amount"])?$_POST["igst_amount"]:"";
			$final_total=isset($_POST["final_total"])?$_POST["final_total"]:"";
			
			$this->home_model->addPurchaseGroup($purchase_id,$product_id,$description,$qty,$rate,$discount_per,$discount_amount,$taxable_amount,$idv_tax,$cgst_per,$sgst_per,$igst_per,$cgst_amount,$sgst_amount,$igst_amount,$final_total);
			
			redirect("Home/getAllPurchase");
			
		}else{
			
			$data["purchase"]=$this->home_model->getPurchase($_GET["id"]);
			$data["purchase_group"]=$this->home_model->getPurchaseGroup($_GET["id"]);
			
			$data["product"]=$this->home_model->getAllProduct();
			$data["company"]=$this->home_model->getAllCustomer();
			$data["tax_list"]=$this->home_model->getAllTax();
			
			$this->load->view('purchase_update',$data);
		}
	}
	
	
	public function removePurchase(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		if(isset($_GET["id"])&&$_GET["id"]!=""){
			$this->home_model->removePurchase($_GET["id"]);
		}
		
		redirect("Home/getAllPurchase");
	}
	
	
	
	//Sales
	public function SalePrint(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["sale"]=$this->home_model->getSale($_GET["id"]);
		$data["sale_group"]=$this->home_model->getSaleGroup($_GET["id"]);
		
		$this->load->view('sale_print',$data);
	}
	
	public function getAllSale(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["records"]=$this->home_model->getAllSale();
		$this->load->view('sale_list',$data);
	}
	
	public function addSale(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		
		if(isset($_POST["submit"])){ 
			
			$company_id=isset($_POST["company_id"])?$_POST["company_id"]:"";
			$invoice_no=$this->home_model->getInvoiceNo();
			$invoice_date=isset($_POST["invoice_date"])?date("Y-m-d",strtotime($_POST["invoice_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			/* $subtotal1=isset($_POST["sub_total1"])?$_POST["sub_total1"]:"";
			$discount=isset($_POST["total_discount"])?$_POST["total_discount"]:"";
			$subtotal2=isset($_POST["sub_total2"])?$_POST["sub_total2"]:"";
			$total_cgst=isset($_POST["total_cgst"])?$_POST["total_cgst"]:"";
			$total_sgst=isset($_POST["total_sgst"])?$_POST["total_sgst"]:"";
			$total_igst=isset($_POST["total_igst"])?$_POST["total_igst"]:"";
			$subtotal3=isset($_POST["sub_total3"])?$_POST["sub_total3"]:"";
			$roundoff=isset($_POST["roundoff"])?$_POST["roundoff"]:"";
			$grand_total=isset($_POST["grand_total"])?$_POST["grand_total"]:"";
		
			$created_by=$this->ion_auth->get_user_id();
			$created_date=date("Y-m-d H:i:s");
			
			$sale_id=$this->home_model->addSale($company_id,$invoice_no,$invoice_date,$remarks,$subtotal1,$discount,$subtotal2,$total_cgst,$total_sgst,$total_igst,$subtotal3,$roundoff,$grand_total,$created_by,$created_date);
			
			$product_id	=isset($_POST["product_id"])?$_POST["product_id"]:"";
			$description	=isset($_POST["description"])?$_POST["description"]:"";
			$qty		=isset($_POST["qty"])?$_POST["qty"]:"";
			$rate		=isset($_POST["rate"])?$_POST["rate"]:"";
			$discount_per=isset($_POST["discount"])?$_POST["discount"]:"";
			$discount_amount=isset($_POST["discount_amount"])?$_POST["discount_amount"]:"";
			$taxable_amount=isset($_POST["taxable_amount"])?$_POST["taxable_amount"]:"";
			$idv_tax	=isset($_POST["idv_tax"])?$_POST["idv_tax"]:"";
			$cgst_per	=isset($_POST["cgst_per"])?$_POST["cgst_per"]:"";
			$sgst_per	=isset($_POST["sgst_per"])?$_POST["sgst_per"]:"";
			$igst_per	=isset($_POST["igst_per"])?$_POST["igst_per"]:"";
			$cgst_amount=isset($_POST["cgst_amount"])?$_POST["cgst_amount"]:"";
			$sgst_amount=isset($_POST["sgst_amount"])?$_POST["sgst_amount"]:"";
			$igst_amount=isset($_POST["igst_amount"])?$_POST["igst_amount"]:"";
			$final_total=isset($_POST["final_total"])?$_POST["final_total"]:"";
			
			$this->home_model->addSaleGroup($sale_id,$product_id,$description,$qty,$rate,$discount_per,$discount_amount,$taxable_amount,$idv_tax,$cgst_per,$sgst_per,$igst_per,$cgst_amount,$sgst_amount,$igst_amount,$final_total);
			
			redirect("Home/getAllSale"); */
			
		}else{
		
			$data["product"]=$this->home_model->getAllProduct();
			$data["company"]=$this->home_model->getAllCustomer();
			$data["tax_list"]=$this->home_model->getAllTax();
			
			$this->load->view('sale_add',$data);
		}
	}
	
	public function updateSale(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		
		if(isset($_POST["submit"])){ 
			
			$id=isset($_POST["id"])?$_POST["id"]:"";
			
			$company_id=isset($_POST["company_id"])?$_POST["company_id"]:"";
			$invoice_date=isset($_POST["invoice_date"])?date("Y-m-d",strtotime($_POST["invoice_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			$subtotal1=isset($_POST["sub_total1"])?$_POST["sub_total1"]:"";
			$discount=isset($_POST["total_discount"])?$_POST["total_discount"]:"";
			$subtotal2=isset($_POST["sub_total2"])?$_POST["sub_total2"]:"";
			$total_cgst=isset($_POST["total_cgst"])?$_POST["total_cgst"]:"";
			$total_sgst=isset($_POST["total_sgst"])?$_POST["total_sgst"]:"";
			$total_igst=isset($_POST["total_igst"])?$_POST["total_igst"]:"";
			$subtotal3=isset($_POST["sub_total3"])?$_POST["sub_total3"]:"";
			$roundoff=isset($_POST["roundoff"])?$_POST["roundoff"]:"";
			$grand_total=isset($_POST["grand_total"])?$_POST["grand_total"]:"";
			
			$this->home_model->updateSale($company_id,$invoice_date,$remarks,$subtotal1,$discount,$subtotal2,$total_cgst,$total_sgst,$total_igst,$subtotal3,$roundoff,$grand_total,$id);
			
			$sale_id=$id;
			//var_dump("hh");
			$this->home_model->deleteSaleGroup($sale_id);
			
			$product_id	=isset($_POST["product_id"])?$_POST["product_id"]:"";
			$description	=isset($_POST["description"])?$_POST["description"]:"";
			$qty		=isset($_POST["qty"])?$_POST["qty"]:"";
			$rate		=isset($_POST["rate"])?$_POST["rate"]:"";
			$discount_per=isset($_POST["discount"])?$_POST["discount"]:"";
			$discount_amount=isset($_POST["discount_amount"])?$_POST["discount_amount"]:"";
			$taxable_amount=isset($_POST["taxable_amount"])?$_POST["taxable_amount"]:"";
			$idv_tax	=isset($_POST["idv_tax"])?$_POST["idv_tax"]:"";
			$cgst_per	=isset($_POST["cgst_per"])?$_POST["cgst_per"]:"";
			$sgst_per	=isset($_POST["sgst_per"])?$_POST["sgst_per"]:"";
			$igst_per	=isset($_POST["igst_per"])?$_POST["igst_per"]:"";
			$cgst_amount=isset($_POST["cgst_amount"])?$_POST["cgst_amount"]:"";
			$sgst_amount=isset($_POST["sgst_amount"])?$_POST["sgst_amount"]:"";
			$igst_amount=isset($_POST["igst_amount"])?$_POST["igst_amount"]:"";
			$final_total=isset($_POST["final_total"])?$_POST["final_total"]:"";
			
			$this->home_model->addSaleGroup($sale_id,$product_id,$description,$qty,$rate,$discount_per,$discount_amount,$taxable_amount,$idv_tax,$cgst_per,$sgst_per,$igst_per,$cgst_amount,$sgst_amount,$igst_amount,$final_total);
			
			redirect("Home/getAllSale");
			
		}else{
			
			$data["sale"]=$this->home_model->getSale($_GET["id"]);
			$data["sale_group"]=$this->home_model->getSaleGroup($_GET["id"]);
			
			$data["product"]=$this->home_model->getAllProduct();
			$data["company"]=$this->home_model->getAllCustomer();
			$data["tax_list"]=$this->home_model->getAllTax();
			
			$this->load->view('sale_update',$data);
		}
	}
	
	
	public function removeSale(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		if(isset($_GET["id"])&&$_GET["id"]!=""){
			$this->home_model->removeSale($_GET["id"]);
		}
		
		redirect("Home/getAllSale");
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function getJsonProducts(){
		
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		echo json_encode($this->home_model->getAllProduct());
	}
	
	public function getSaleProducts(){
		
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		echo json_encode($this->report_model->getStocksReport());
	}
	
	
	//Products
	public function getAllProduct(){
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		
		$data["records"]=$this->home_model->getAllProduct();
		
		$this->load->view('product_list',$data);
		
	}
	
	public function addProduct(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$name=isset($_POST["name"])?$_POST["name"]:"";
			$tax_id=isset($_POST["tax_id"])?$_POST["tax_id"]:"";
			$description=isset($_POST["description"])?$_POST["description"]:"";
			
			$this->home_model->addProduct($name,$tax_id,$description);
			
			redirect('Home/getAllProduct');
			
		}else{
			$data["tax_list"]=$this->home_model->getAllTax();
			$this->load->view('product_add',$data);
		}
	}
	
	function updateProduct(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$id=isset($_POST["id"])?$_POST["id"]:"";
			$name=isset($_POST["name"])?$_POST["name"]:"";
			$tax_id=isset($_POST["tax_id"])?$_POST["tax_id"]:"";
			$description=isset($_POST["description"])?$_POST["description"]:"";
			
			$this->home_model->updateProduct($id,$name,$tax_id,$description);
			
			redirect("Home/getAllProduct");
			
		}else{
			if(isset($_GET["id"])&&($_GET["id"]!="")){
				$data=$this->home_model->getProduct($_GET["id"]);
				if(!empty($data)){
					$data["tax_list"]=$this->home_model->getAllTax();
					$this->load->view('product_update',$data);
				}
			}
		}

	}
	
	
	public function addAjaxProduct(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$name=isset($_POST["name"])?$_POST["name"]:"";
		$tax_id=isset($_POST["tax_id"])?$_POST["tax_id"]:"";
		$description=isset($_POST["description"])?$_POST["description"]:"";
		
		echo json_encode($this->home_model->addProduct($name,$tax_id,$description));
		
	}
	
	public function searchProduct(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		echo json_encode($this->home_model->getProduct($_POST["id"]));
	}
	
	public function searchTax(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		echo json_encode($this->home_model->getTax($_POST["id"]));
	}
	
	
	public function getAllTax(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["records"]=$this->home_model->getAllTax();
		
		$this->load->view('tax_list',$data);
		
	}
	
	public function addTax(){
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$name=isset($_POST["name"])?$_POST["name"]:"";
			$cgst=isset($_POST["cgst"])?$_POST["cgst"]:"";
			$sgst=isset($_POST["sgst"])?$_POST["sgst"]:"";
			$igst=isset($_POST["igst"])?$_POST["igst"]:"";
			
			$this->home_model->addTax($name,$cgst,$sgst,$igst);
			redirect("Home/getAllTax");
		}else{
			$this->load->view('tax_add');
		}
	}
	
	function updateTax(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$id=isset($_POST["id"])?$_POST["id"]:"";
			$name=isset($_POST["name"])?$_POST["name"]:"";
			$cgst=isset($_POST["cgst"])?$_POST["cgst"]:"";
			$sgst=isset($_POST["sgst"])?$_POST["sgst"]:"";
			$igst=isset($_POST["igst"])?$_POST["igst"]:"";
			
			$this->home_model->updateTax($id,$name,$cgst,$sgst,$igst);
			
			redirect("Home/getAllTax");
			
		}else{
			if(isset($_GET["id"])&&($_GET["id"]!="")){
				$data=$this->home_model->getTax($_GET["id"]);
				if(!empty($data)){
					$this->load->view('tax_update',$data);
				}
			}
		}

	}
	
	public function getAllUsers(){
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		if($this->ion_auth->is_admin()){
			
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
			//var_dump($this->data);
			$this->load->view('user_list',$this->data);
			
		}
		
		
		
	}
	
	function getAllCustomer(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["records"]=$this->home_model->getAllCustomer();
		
		$this->load->view('customer_list',$data);
	}
	
	function addCustomer(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$name=isset($_POST["name"])?$_POST["name"]:"";
			$company_name=isset($_POST["company_name"])?$_POST["company_name"]:"";
			$email=isset($_POST["email"])?$_POST["email"]:"";
			$mobile=isset($_POST["mobile"])?$_POST["mobile"]:"";
			$land_line=isset($_POST["land_line"])?$_POST["land_line"]:"";
			$address=isset($_POST["address"])?$_POST["address"]:"";
			$city=isset($_POST["city"])?$_POST["city"]:"";
			$state=isset($_POST["state"])?$_POST["state"]:"";
			$pincode=isset($_POST["pincode"])?$_POST["pincode"]:"";
			$gst_no=isset($_POST["gst_no"])?$_POST["gst_no"]:"";
			$type=isset($_POST["type"])?$_POST["type"]:"";
			
			$this->home_model->addCustomer($name,$company_name,$email,$mobile,$land_line,$address,$city,$state,$pincode,$gst_no,$type);
			
			redirect("Home/getAllCustomer");
			
		}else{
			$this->load->view('customer_add');
		}

	}
	
	function updateCustomer(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$id=isset($_POST["id"])?$_POST["id"]:"";
			$name=isset($_POST["name"])?$_POST["name"]:"";
			$company_name=isset($_POST["company_name"])?$_POST["company_name"]:"";
			$email=isset($_POST["email"])?$_POST["email"]:"";
			$mobile=isset($_POST["mobile"])?$_POST["mobile"]:"";
			$land_line=isset($_POST["land_line"])?$_POST["land_line"]:"";
			$address=isset($_POST["address"])?$_POST["address"]:"";
			$city=isset($_POST["city"])?$_POST["city"]:"";
			$state=isset($_POST["state"])?$_POST["state"]:"";
			$pincode=isset($_POST["pincode"])?$_POST["pincode"]:"";
			$gst_no=isset($_POST["gst_no"])?$_POST["gst_no"]:"";
			$type=isset($_POST["type"])?$_POST["type"]:"";
			
			$this->home_model->updateCustomer($id,$name,$company_name,$email,$mobile,$land_line,$address,$city,$state,$pincode,$gst_no,$type);
			
			redirect("Home/getAllCustomer");
			
		}else{
			if(isset($_GET["id"])&&($_GET["id"]!="")){
				$data=$this->home_model->getCustomer($_GET["id"]);
				if(!empty($data)){
					$this->load->view('customer_update',$data);
				}
			}
		}

	}
	
	//Purchase Payment
	
	public function getAllPurchasePayment(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["records"]=$this->home_model->getAllPurchasePayment();
		
		$this->load->view('purchase_payment_list',$data);
		
	}
	
	public function addPurchasePayment(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$dealer_id=isset($_POST["dealer_id"])?$_POST["dealer_id"]:"";
			$paid_amount=isset($_POST["paid_amount"])?$_POST["paid_amount"]:"";
			$payment_mode=isset($_POST["payment_mode"])?$_POST["payment_mode"]:"";
			$payment_date=isset($_POST["payment_date"])?date("Y-m-d",strtotime($_POST["payment_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			$this->home_model->addPurchasePayment($dealer_id,$paid_amount,$payment_mode,$payment_date,$remarks);
			
			redirect('Home/getAllPurchasePayment');
			
		}else{
			$data["company"]=$this->home_model->getAllCustomer();
			$this->load->view('purchase_payment_add',$data);
		}
	}
	
	public function updatePurchasePayment(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$id=isset($_POST["id"])?$_POST["id"]:"";
			$dealer_id=isset($_POST["dealer_id"])?$_POST["dealer_id"]:"";
			$paid_amount=isset($_POST["paid_amount"])?$_POST["paid_amount"]:"";
			$payment_mode=isset($_POST["payment_mode"])?$_POST["payment_mode"]:"";
			$payment_date=isset($_POST["payment_date"])?date("Y-m-d",strtotime($_POST["payment_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			$this->home_model->updatePurchasePayment($id,$dealer_id,$paid_amount,$payment_mode,$payment_date,$remarks);
			
			redirect('Home/getAllPurchasePayment');
			
		}else{
			$data["company"]=$this->home_model->getAllCustomer();
			$data["records"]=$this->home_model->getPurchasePayment($_GET["id"]);
			//var_dump($data["records"]);
			$this->load->view('purchase_payment_update',$data);
		}
	}
	
	
	//Sales Payment
	
	public function getAllSalesPayment(){
		
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["records"]=$this->home_model->getAllSalesPayment();
		
		$this->load->view('sales_payment_list',$data);
		
	}
	
	public function addSalesPayment(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$customer_id=isset($_POST["customer_id"])?$_POST["customer_id"]:"";
			$paid_amount=isset($_POST["paid_amount"])?$_POST["paid_amount"]:"";
			$payment_mode=isset($_POST["payment_mode"])?$_POST["payment_mode"]:"";
			$payment_date=isset($_POST["payment_date"])?date("Y-m-d",strtotime($_POST["payment_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			$this->home_model->addSalesPayment($customer_id,$paid_amount,$payment_mode,$payment_date,$remarks);
			
			redirect('Home/getAllSalesPayment');
			
		}else{
			$data["customer"]=$this->home_model->getAllCustomer();
			$this->load->view('sales_payment_add',$data);
		}
	}
	
	public function updateSalesPayment(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		if(isset($_POST["submit"])){
			
			$id=isset($_POST["id"])?$_POST["id"]:"";
			$customer_id=isset($_POST["customer_id"])?$_POST["customer_id"]:"";
			$paid_amount=isset($_POST["paid_amount"])?$_POST["paid_amount"]:"";
			$payment_mode=isset($_POST["payment_mode"])?$_POST["payment_mode"]:"";
			$payment_date=isset($_POST["payment_date"])?date("Y-m-d",strtotime($_POST["payment_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			$this->home_model->updateSalesPayment($id,$customer_id,$paid_amount,$payment_mode,$payment_date,$remarks);
			
			redirect('Home/getAllSalesPayment');
			
		}else{
			$data["customer"]=$this->home_model->getAllCustomer();
			$data["records"]=$this->home_model->getSalesPayment($_GET["id"]);
			//var_dump($data["records"]);
			$this->load->view('sales_payment_update',$data);
		}
	}
	
	
	
	
	//Quotation
	public function QtPrint(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["sale"]=$this->home_model->getQt($_GET["id"]);
		$data["sale_group"]=$this->home_model->getQtGroup($_GET["id"]);
		
		$this->load->view('qt_print',$data);
	}
	
	public function getAllQt(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		$data["records"]=$this->home_model->getAllQt();
		$this->load->view('qt_list',$data);
	}
	
	public function addQt(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		
		if(isset($_POST["submit"])){ 
			
			$company_id=isset($_POST["company_id"])?$_POST["company_id"]:"";
			$invoice_no=$this->home_model->getQtNo();
			$invoice_date=isset($_POST["invoice_date"])?date("Y-m-d",strtotime($_POST["invoice_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			$subtotal1=isset($_POST["sub_total1"])?$_POST["sub_total1"]:"";
			$roundoff=isset($_POST["roundoff"])?$_POST["roundoff"]:"";
			$grand_total=isset($_POST["grand_total"])?$_POST["grand_total"]:"";
		
			$created_by=$this->ion_auth->get_user_id();
			$created_date=date("Y-m-d H:i:s");
			
			$sale_id=$this->home_model->addQt($company_id,$invoice_no,$invoice_date,$remarks,$subtotal1,$roundoff,$grand_total,$created_by,$created_date);
			
			$product_id	=isset($_POST["product_id"])?$_POST["product_id"]:"";
			$description	=isset($_POST["description"])?$_POST["description"]:"";
			$qty		=isset($_POST["qty"])?$_POST["qty"]:"";
			$rate		=isset($_POST["rate"])?$_POST["rate"]:"";
			$final_total=isset($_POST["final_total"])?$_POST["final_total"]:"";
			
			$this->home_model->addQtGroup($sale_id,$product_id,$description,$qty,$rate,$final_total);
			
			redirect("Home/getAllQt");
			
		}else{
		
			$data["product"]=$this->home_model->getAllProduct();
			$data["company"]=$this->home_model->getAllCustomer();
			$data["tax_list"]=$this->home_model->getAllTax();
			
			$this->load->view('qt_add',$data);
		}
	}
	
	public function updateQt(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		
		
		if(isset($_POST["submit"])){ 
			
			$id=isset($_POST["id"])?$_POST["id"]:"";
			
			$company_id=isset($_POST["company_id"])?$_POST["company_id"]:"";
			$invoice_date=isset($_POST["invoice_date"])?date("Y-m-d",strtotime($_POST["invoice_date"])):"";
			$remarks=isset($_POST["remarks"])?$_POST["remarks"]:"";
			
			$subtotal1=isset($_POST["sub_total1"])?$_POST["sub_total1"]:"";
			$roundoff=isset($_POST["roundoff"])?$_POST["roundoff"]:"";
			$grand_total=isset($_POST["grand_total"])?$_POST["grand_total"]:"";
			
			$this->home_model->updateQt($company_id,$invoice_date,$remarks,$subtotal1,$roundoff,$grand_total,$id);
			
			$sale_id=$id;
			//var_dump("hh");
			$this->home_model->deleteQtGroup($sale_id);
			
			$product_id	=isset($_POST["product_id"])?$_POST["product_id"]:"";
			$description	=isset($_POST["description"])?$_POST["description"]:"";
			$qty		=isset($_POST["qty"])?$_POST["qty"]:"";
			$rate		=isset($_POST["rate"])?$_POST["rate"]:"";
			$final_total=isset($_POST["final_total"])?$_POST["final_total"]:"";
			
			$this->home_model->addQtGroup($sale_id,$product_id,$description,$qty,$rate,$final_total);
			
			redirect("Home/getAllQt");
			
		}else{
			
			$data["sale"]=$this->home_model->getQt($_GET["id"]);
			$data["sale_group"]=$this->home_model->getQtGroup($_GET["id"]);
			
			$data["product"]=$this->home_model->getAllProduct();
			$data["company"]=$this->home_model->getAllCustomer();
			$data["tax_list"]=$this->home_model->getAllTax();
			
			$this->load->view('qt_update',$data);
		}
	}
	
	
	public function removeQt(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		if(isset($_GET["id"])&&$_GET["id"]!=""){
			$this->home_model->removeQt($_GET["id"]);
		}
		
		redirect("Home/getAllQt");
	}
	
}
