
<?php include(dirname(dirname(__FILE__)) . '/admin_header.php'); ?>


<section class="content-header">
	<h1>User<small>Edit</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">User</a></li>
		<li class="active">Edit</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
			
				<div id="infoMessage"><?php echo $message;?></div>

				<?php echo form_open(uri_string());?>
						
						
					<div class="box-body">
						<div class="form-group col-lg-12">
							<label class="col-lg-3 control-label"><?php echo lang('edit_user_fname_label', 'first_name');?> </label>
							<div class="col-lg-5">
								<?php echo form_input($first_name);?>
							</div>
						</div>
						<div class="form-group col-lg-12">
							<label class="col-lg-3 control-label"><?php echo lang('edit_user_lname_label', 'last_name');?> </label>
							<div class="col-lg-5">
								<?php echo form_input($last_name);?>
							</div>
						</div>
						<div class="form-group col-lg-12">
							<label class="col-lg-3 control-label"><?php echo lang('edit_user_company_label', 'company');?> </label>
							<div class="col-lg-5">
								<?php echo form_input($company);?>
							</div>
						</div>
						<div class="form-group col-lg-12">
							<label class="col-lg-3 control-label"><?php echo lang('edit_user_email_label', 'email');?> </label>
							<div class="col-lg-5">
								<?php echo form_input($email);?>
							</div>
						</div>
						<div class="form-group col-lg-12">
							<label class="col-lg-3 control-label"><?php echo lang('edit_user_password_label', 'password');?> </label>
							<div class="col-lg-5">
								<?php echo form_input($password);?>
							</div>
						</div>
						<div class="form-group col-lg-12">
							<label class="col-lg-3 control-label"><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?> </label>
							<div class="col-lg-5">
								<?php echo form_input($password_confirm);?>
							</div>
						</div>
						
						<div class="form-group col-lg-12">
							<div class="col-lg-5">
								  <?php if ($this->ion_auth->is_admin()): ?>

									  <h3><?php echo lang('edit_user_groups_heading');?></h3>
									  <?php foreach ($groups as $group):?>
										  <label class="checkbox">
										  <?php
											  $gID=$group['id'];
											  $checked = null;
											  $item = null;
											  foreach($currentGroups as $grp) {
												  if ($gID == $grp->id) {
													  $checked= ' checked="checked"';
												  break;
												  }
											  }
										  ?>
										  <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
										  <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
										  </label>
									  <?php endforeach?>

								  <?php endif ?>

								  <?php echo form_hidden('id', $user->id);?>
								  <?php echo form_hidden($csrf); ?>
							</div>
						</div>
						
						<div class="form-group col-lg-12">
							<div class="col-lg-5">
								<?php echo form_submit('submit', lang('edit_user_submit_btn'));?>
							</div>
						</div>
						
					</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</section>

<?php include(dirname(dirname(__FILE__)) . '/admin_footer.php'); ?>