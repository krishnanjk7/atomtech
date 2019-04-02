<?php include "admin_header.php"; ?>
	
	
	
	<section class="content-header">
		<h1>User<small>List</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."index.php/Home"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url()."index.php/Home/getAllUsers"; ?>">user</a></li>
			<li class="active">list</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
				
					<a href="<?php echo base_url(); ?>index.php/auth/create_user">
						<input class="btn btn-primary" type="button" value="Create User"/>
					</a>
					<hr/>
					
					<table class="table table-bordered" id="data_list">
						<thead>
							<th><?php echo lang('index_fname_th');?></th>
							<th><?php echo lang('index_lname_th');?></th>
							<th><?php echo lang('index_email_th');?></th>
							<th><?php echo lang('index_username_th');?></th>
							<th><?php echo lang('index_company_th');?></th>
							<th><?php echo lang('index_groups_th');?></th>
							<!--
							<th><?php echo lang('index_status_th');?></th> -->
							<th><?php echo lang('index_action_th');?></th>
						</thead>
						<tbody>
							<?php foreach ($users as $user):?>
								<tr>
									<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
									<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
									<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
									<td><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8');?></td>
									<td><?php echo htmlspecialchars($user->company,ENT_QUOTES,'UTF-8');?></td>
									<td style="text-transform:capitalize">
										<?php foreach ($user->groups as $group):?>
											<?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8') ;?><br />
										<?php endforeach?>
									</td>
									<!--
									<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
									-->
									<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	
	<script>
		$("#data_list").DataTable();
	</script>
	
	
	
<?php include "admin_footer.php"; ?>