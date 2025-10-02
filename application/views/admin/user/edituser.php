<section role="main" class="content-body">

	<header class="page-header">

		<h2>Edit User</h2>

		<div class="right-wrapper pull-right">

			<ol class="breadcrumbs">

				<li>

					<a href="dashboa<?php echo ADMIN_URL . 'dashboard/' ?>">

						<i class="fa fa-home"></i>

					</a>

				</li>

				<li><span>Edit User</span></li>

			</ol>



			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>

		</div>

	</header>



	<!-- start: page -->

	<div class="row">

		<div class="col-xs-12">

			<section class="panel">

				<header class="panel-heading">

					<div class="panel-actions">

						<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>

						<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->

					</div>

					<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Edit User <a href="<?php echo ADMIN_URL . 'users/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> <span> &nbsp;Users List</span></a></h2>

				</header>

				<div class="panel-body">

					<div class="form-body">

						<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="useredit">

							<div class="col-md-6">

								<input type="hidden" name="id" value="<?php echo ($edit) ? $edit['id'] : ""; ?>">

								<div class="col-md-12">

									<label class="control-label">Business Name</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-user"></i>

										</span>

										<input type="text" name="business_name" placeholder="Enter your business name" class="form-control" value="<?php echo $edit['business_name']; ?>" />

									</div>

								</div>



								<div class="col-md-12" style="display:none">

									<label class="control-label">Email (Register Email)</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-envelope"></i>

										</span>

										<input type="hidden" id="email" name="email" placeholder="example@gmail.com" class="form-control" autocomplete="off" value="<?php echo $edit['email']; ?>">

									</div>

								</div>

								<div class="col-md-12">

									<label class="control-label">Business Email</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-envelope"></i>

										</span>

										<input type="text" id="b_email" name="b_email" placeholder="example@gmail.com" class="form-control" autocomplete="off" value="<?php echo $edit['b_email']; ?>">

									</div>

								</div>
								<div class="col-md-12">

									<label class="control-label">Business Website</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-envelope"></i>

										</span>

										<input type="text" id="b_website" name="b_website" placeholder="www.gmail.com" class="form-control" autocomplete="off" value="<?php echo $edit['b_website']; ?>">

									</div>

								</div>
								<div class="col-md-12">

									<label class="control-label">Business Logo <span>(250px X 100px)</span></label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-image"></i>

										</span>

										<input type="file" name="image" class="form-control" accept="image/*" />

									</div>

								</div>
								<div class="col-md-12">

									<?php if ($edit['photo']) { ?>

										<a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/logo/<?php echo $edit['photo']; ?>">

											<img src="<?php echo base_url(); ?>media/logo/<?php echo $edit['photo']; ?>" alt="" class="edimg"></a>

										<a href="javascript:void(0)" style="" class="edituimg" id="<?php echo $edit['id']; ?>" onclick="deleterecord(this.id,'/users/deletuserimg');" class="">

											<i class="fa fa-times"></i>

										</a>

									<?php } ?>

								</div>

							</div>

							<div class="col-md-6">
								<div class="col-md-12">

									<label class="control-label">Business Note</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-user"></i>

										</span>

										<input type="text" name="name" placeholder="Enter your business note" class="form-control"  value="<?php echo $edit['name']; ?>"/>

									</div>

								</div>
								<div class="col-md-12">

									<label class="control-label">Mobile (Register Mobile)<span class="rerq">*</span></label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-phone"></i>

										</span>

										<input id="text" name="mobile1" data-plugin-masked-input placeholder="8888888888" class="form-control" data-plugin-maxlength maxlength="10" minlength="10" autocomplete="off" value="<?php echo $edit['mobile']; ?>" />

									</div>

								</div>

								<div class="col-md-12">

									<label class="control-label">Business Mobile 2</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-phone"></i>

										</span>

										<input id="text" name="mobile2" class="form-control" autocomplete="off" value="<?php echo $edit['b_mobile2']; ?>" />

									</div>

								</div>



								<div class="col-md-12">

									<label class="control-label">Business Address</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-address-card fsize"></i>

										</span>

										<textarea name="address" placeholder="" class="form-control" rows="6" autocomplete="off"><?php echo $edit['address']; ?></textarea>

									</div>

								</div>

							</div>


							<div class="col-md-12">

								<div class="col-md-2">

									<label class="control-label">Active / Deactive</label>

									<?php if ($edit['status'] == 1) { ?>

										<div class="switch switch-sm switch-success">

											<input type="checkbox" name="active" value="1" data-plugin-ios-switch checked="checked" />

										</div>

									<?php } else { ?>

										<div class="switch switch-sm switch-success">

											<input type="checkbox" name="active" value="1" data-plugin-ios-switch />

										</div>

									<?php } ?>

								</div>

								<div class="col-md-2">


									<label class="control-label">Paid / Unpaid</label>

									<?php if ($edit['ispaid'] == 1) { ?>

										<div class="switch switch-sm switch-success">

											<input type="checkbox" name="paidunpaid" value="1" data-plugin-ios-switch checked="checked" />

										</div>

									<?php } else { ?>

										<div class="switch switch-sm switch-success">

											<input type="checkbox" name="paidunpaid" value="1" data-plugin-ios-switch />

										</div>

									<?php } ?>


								</div>

								<div class="col-md-2">

									<label class="control-label">Gender</label>

									<div class="single-line">

										<div class="radio-custom radio-primary">

											<input id="awesome" name="gender" value="0" type="radio" value="awesome" required="" aria-required="true" <?php echo $edit['gender'] == 0 ? 'checked' : '' ?>>

											<label for="awesome">Male</label> &nbsp;&nbsp;

										</div>

									</div>

									<div class="single-line">

										<div class="radio-custom radio-primary">

											<input id="very-awesome" name="gender" value="1" type="radio" value="very-awesome" <?php echo $edit['gender'] == 1 ? 'checked' : '' ?>>

											<label for="very-awesome">Female</label>

										</div>

									</div>

								</div>



								<div class="col-md-6 svbut">

									<button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary">Update</button>

								</div>

							</div>

						</form>

					</div>

				</div>

			</section>

		</div>

	</div>

	<!-- end: page -->

</section>