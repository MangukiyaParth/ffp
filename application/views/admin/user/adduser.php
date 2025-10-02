<section role="main" class="content-body">

	<header class="page-header">

		<h2>Add User</h2>

		<div class="right-wrapper pull-right">

			<ol class="breadcrumbs">

				<li>

					<a href="<?php echo ADMIN_URL . 'dashboard/' ?>">

						<i class="fa fa-home"></i>

					</a>

				</li>

				<li><span>Add User</span></li>

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

					<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add User <a href="<?php echo ADMIN_URL . 'users/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> <span> &nbsp;Users List</span></a></h2>

				</header>

				<div class="panel-body">

					<div class="form-body">

						<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="useradd">

							<div class="col-md-6">

								<div class="col-md-12">

									<label class="control-label">Business Name</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-user"></i>

										</span>

										<input type="text" name="business_name" placeholder="Enter your business name" class="form-control"  />

									</div>

								</div>
								

								<div class="col-md-12">

									<label class="control-label">Email</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-envelope"></i>

										</span>

										<input type="text" id="email" name="email" placeholder="example@gmail.com" class="form-control" autocomplete="off" />

									</div>

								</div>



								<div class="col-md-12">

									<label class="control-label">Password <span class="rerq">*</span></label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-key"></i>

										</span>

										<input type="password" id="password" name="password"  placeholder="Enter Password" class="form-control" data-plugin-maxlength maxlength="15" minlength="4" autocomplete="off" />

									</div>

								</div>



								<div class="col-md-12">

									<label class="control-label">Confirm Password <span class="rerq">*</span></label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-key"></i>

										</span>

										<input type="password" id="cpassword" name="cpassword" data-plugin-masked-input data-input-mask="" placeholder="Enter Confirm Password" class="form-control" data-plugin-maxlength minlength="4" maxlength="15" autocomplete="off" />

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

							</div>



							<div class="col-md-6">


							<div class="col-md-12">

								<label class="control-label">Business Note</label>

								<div class="input-group">

									<span class="input-group-addon">

										<i class="fa fa-user"></i>

									</span>

									<input type="text" name="name" placeholder="Enter your business note" class="form-control"  />

								</div>

								</div>
								<div class="col-md-12">

									<label class="control-label">Business Mobile 1 <span class="rerq">*</span></label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-phone"></i>

										</span>

										<input id="mobile1" required name="mobile1" data-plugin-masked-input data-plugin-maxlength maxlength="12" placeholder="8888888888" class="form-control" autocomplete="off" />

									</div>

								</div>

								<div class="col-md-12">

									<label class="control-label">Business Mobile 2</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-phone"></i>

										</span>

										<input id="mobile2" name="mobile2" data-plugin-masked-input data-plugin-maxlength maxlength="12" placeholder="8888888888" class="form-control" autocomplete="off" />

									</div>

								</div>

								<div class="col-md-12">

									<label class="control-label">Business Email</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-envelope"></i>

										</span>

										<input type="text" id="b_email" name="b_email"  placeholder="example@gmail.com" class="form-control" autocomplete="off" />

									</div>

								</div>

								<div class="col-md-12">

									<label class="control-label">Business Website</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-envelope"></i>

										</span>

										<input type="text" id="b_website" name="b_website"  placeholder="www.example.com" class="form-control" autocomplete="off" />

									</div>

								</div>

							</div>



							<div class="col-md-12">

								<div class="col-md-12">

									<label class="control-label">Business Address</label>

									<div class="input-group">

										<span class="input-group-addon">

											<i class="fa fa-address-card fsize"></i>

										</span>

										<textarea name="address" placeholder="Business Address" class="form-control" rows="4" autocomplete="off"></textarea>

									</div>

								</div>

								<div class="col-md-3">

									<label class="control-label">Active / Deactive</label>

									<div class="switch switch-sm switch-success">

										<input type="checkbox" name="active" value="1" data-plugin-ios-switch checked="checked" />

									</div>

								</div>

								<div class="col-md-3">

									<label class="control-label">Paid / Unpaid</label>

									<div class="switch switch-sm switch-success">

										<input type="checkbox" name="paidunpaid" value="1" data-plugin-ios-switch />

									</div>

								</div>

								<div class="col-md-3">

									<label class="control-label">Gender</label>

									<div class="single-line">

										<div class="radio-custom radio-primary">

											<input id="awesome" name="gender" value="0" checked type="radio" value="awesome" required="" aria-required="true">

											<label for="awesome">Male</label>

										</div>&nbsp;&nbsp;

									</div>

									<div class="single-line">

										<div class="radio-custom radio-primary">

											<input id="very-awesome" name="gender" value="1" type="radio" value="very-awesome">

											<label for="very-awesome">Female</label>

										</div>

									</div>

								</div>

								<div class="col-md-3 svbut">

									<button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary">Save</button>

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