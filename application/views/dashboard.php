<?php include "admin_header.php"; ?>

	<style>	
		.btn-success {
			background-color: #0033a6 !important;
			border-color: #0033a6 !important;
		}
		.btn-success:hover {
			background-color: white !important;
			border-color: #0033a6 !important;
			color: #0033a6 !important;
		}
		th span{
			font-size:18px;
		}
	</style>
	
    <!-- Content Header (Page header) SELECT sum(case when pg.load_or_empty="LOAD" then pg.qty else 0 end) as received, sum(case when pg.load_or_empty="EMPTY" then pg.qty else 0 end) as returned FROM `purchase_group` pg left join purchase p on p.id=pg.purchase_id -->
    <section class="content-header">
      <!--
	  <h1>
        Dashboard
        <small>Control panel</small>
      </h1> 
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
       <h1 class="text-center" style="font-family:Montserrat-Light;">ATOM TECH</h1>
	   
	   <table class="table table-bordered">
			<thead>
				<tr>
					<th>
						<span>REPORTS</span><br/><br/>
						<a href="<?php echo base_url();?>index.php/Report/getPurchaseReportOverview" target="new"> <button class="btn btn-success">Purchase Report Overview</button> </a>
						<a href="<?php echo base_url();?>index.php/Report/getPurchaseReportForm" target="new"> <button class="btn btn-success">Purchase Report Statement</button> </a>
						
						<a href="<?php echo base_url();?>index.php/Report/getSalesReportOverview" target="new"> <button class="btn btn-success">Sales Report Overview</button> </a>
						<a href="<?php echo base_url();?>index.php/Report/getSalesReportForm" target="new"> <button class="btn btn-success">Sales Report Statement</button> </a>
					</th>
				</tr>
				<tr>
					<th><span>PAYMENTS</span> <br/><br/>
						<a href="<?php echo base_url();?>index.php/home/addPurchasePayment" target="new"><button class="btn btn-success">Add Purchase Payment</button> </a>
						<a href="<?php echo base_url();?>index.php/home/getAllPurchasePayment" target="new"><button class="btn btn-success">Purchase Payment List</button></a>
						<a href="<?php echo base_url();?>index.php/home/addSalesPayment" target="new"><button class="btn btn-success">Add Sales Payment</button> </a>
						<a href="<?php echo base_url();?>index.php/home/getAllSalesPayment" target="new"><button class="btn btn-success">Sales Payment List</button></a>
						
					</th>
				</tr>
				<tr>
					<th><span>PURCHASE</span> <br/><br/>
						<a href="<?php echo base_url();?>index.php/home/addPurchase" target="new"><button class="btn btn-success">Add Purchase</button> </a>
						<a href="<?php echo base_url();?>index.php/home/getAllPurchase" target="new"><button class="btn btn-success">Purchase List</button></a>
					</th>
				</tr>
				<tr>
					<th><span>Quatation</span> <br/><br/>
						<a href="<?php echo base_url();?>index.php/home/addQt" target="new"><button class="btn btn-success">Add Quatation</button> </a>
						<a href="<?php echo base_url();?>index.php/home/getAllQt" target="new"><button class="btn btn-success">Quatation List</button></a>
					</th>
				</tr>
				<tr>
					<th><span>SALES</span> <br/><br/>
						<a href="<?php echo base_url();?>index.php/home/addSale" target="new"><button class="btn btn-success">Add Sale</button> </a>
						<a href="<?php echo base_url();?>index.php/home/getAllSale" target="new"><button class="btn btn-success">Sales List</button></a>
					</th>
				</tr>
				<tr>
					<th><span>MASTER</span> <br/><br/>
						<a href="<?php echo base_url();?>index.php/home/getAllTax" target="new"><button class="btn btn-success">Tax</button></a>
						<a href="<?php echo base_url();?>index.php/home/getAllProduct" target="new"><button class="btn btn-success">Products</button></a>
						<a href="<?php echo base_url();?>index.php/home/getAllCustomer" target="new"><button class="btn btn-success">Customer</button></a>
						<a href="<?php echo base_url();?>index.php/home/getAllUsers" target="new"><button class="btn btn-success">Users</button></a>
					</th>
				</tr>
			</thead>
	   </table>
	   
      </div>
      <!-- /.row -->
      
    </section>
   <?php include "admin_footer.php"; ?>