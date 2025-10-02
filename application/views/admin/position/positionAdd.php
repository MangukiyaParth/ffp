<section role="main" class="content-body pb-none">
	<header class="page-header">
		<h2>Add Position</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span class="">Add Position</span></li>
			</ol>
			<span class="listname" style="display: none;">Usaer List/0,1,2,3,4/0,2,3,4</span>

			<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	<!-- start: page -->
	<div class="row">
		<div class="col-md-12">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
					</div>

					<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Add Position

					</h2>
				</header>
				<?php if ($this->session->flashdata('msg-success')) {
					echo "<div class='alert alert-success'>" . $this->session->flashdata('msg-success') . "</div>";
				}
				if ($this->session->flashdata('msg-error')) {
					echo "<div class='alert alert-danger'>" . $this->session->flashdata('msg-error') . "</div>";
				}
				?>
				<div class="panel-body">
					<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="<?php echo base_url("admin/position/isertPosition"); ?>">
						<!-- id="addTamplate" -->
						<input type="hidden" value="<?php echo ($edit) ? $edit['pid'] : ""; ?>" name="id">
						<fieldset>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-md-12" for="c_type"><strong>Select Type</strong> </label>
										<div class="col-md-12">
											<select class="form-control" required name="c_type">
												<option value="">-- Select Type --</option>
												<?php if ($c_type) {
													foreach ($c_type as $c_t) {
														$selected_type1 = "";
														if (($edit)) {
															if ($edit['c_type'] == $c_t['c_id']) {
																$selected_type1 = "selected";
															}
														} ?>
														<option <?php echo $selected_type1; ?> value="<?php echo $c_t['c_id']; ?>"><?php echo $c_t['c_id'].'-'.$c_t['c_title']; ?></option>
												<?php  }
												} ?>

											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-md-12" for="p_name"><strong>Position Name :<font color="red">*</font></strong> </label>
										<div class="col-md-12">
											<input type="text" value="<?php echo ($edit) ? $edit['p_name'] : ""; ?>" required class="form-control" name="p_name">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-md-12" for="image"><strong>Position Sample Image :</strong></label>
										<div class="col-md-12">
											<input type="file" <?php echo ($edit) ? '' : 'required'; ?> class="form-control" name="image" accept="image/*">
										</div>
									</div>
								</div>
							</div>
							<div class="row">

								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12" for="logo_pos"><strong>Logo Position :</strong> </label>
										<div class="col-md-12">
											<input type="text"  value="<?php echo ($edit) ? $edit['logo_pos'] : "top-left_20_65"; ?>" class="form-control" name="logo_pos">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12" for="mobile_pos"><strong>Mobile Position :</strong> </label>
										<div class="col-md-12">
											<input type="text" value="<?php echo ($edit) ? $edit['mobile_pos'] : "top-left_20_17"; ?>" class="form-control" name="mobile_pos">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12" for="website_pos"><strong>Website Position : </strong></label>
										<div class="col-md-12">
											<input type="text" value="<?php echo ($edit) ? $edit['website_pos'] : "bottom-left_20_-55"; ?>" class="form-control" name="website_pos">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12" for="email_pos"><strong>Email Position : </strong></label>
										<div class="col-md-12">
											<input type="text" value="<?php echo ($edit) ? $edit['email_pos'] : "bottom-right_-20_-55"; ?>" class="form-control" name="email_pos">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12" for="address_pos"><strong>Address Position :</strong></label>
										<div class="col-md-12">
											<input type="text" value="<?php echo ($edit) ? $edit['address_pos'] : "bottom-center_0_-5"; ?>" class="form-control" name="address_pos">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12" for="name_pos"><strong>Name Position : </strong></label>
										<div class="col-md-12">
											<input type="text" value="<?php echo ($edit) ? $edit['name_pos'] : "bottom-center_0_-105"; ?>" class="form-control" name="name_pos">
										</div>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-md-12" for="birthdayPhoto_pos"><strong>Bithday Photo Position :</strong></label>
										<div class="col-md-12">
											<input type="text" value="<?php echo ($edit) ? $edit['birthdayPhoto_pos'] : ""; ?>" class="form-control" name="birthdayPhoto_pos">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-md-12" for="birthdayName_pos"><strong>Bithday Name Position :</strong></label>
										<div class="col-md-12">
											<input type="text" value="<?php echo ($edit) ? $edit['birthdayName_pos'] : ""; ?>" class="form-control" name="birthdayName_pos">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-md-12" for="birthday_font"><strong>Birthday Font : </strong></label>
										<div class="col-md-12">
											<input type="text" value="<?php echo ($edit) ? $edit['birthday_font'] : ""; ?>" class="form-control" name="birthday_font">
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="col-md-6">
								<div class="col-md-6">
									<span>
										<b>Note:</b> <br />
										top-left<br />
										top-center<br />
										top-right<br />
										middle-left<br />
										middle-center<br />
										middle-right<br />
										bottom-left<br />
										bottom-center<br />
										bottom-right<br />
									</span>
								</div>
								<div class="col-md-6">
									<span>
										<b>Note:</b> <br />
										First - (left) Second - (top)<br />
										Email Position : null then email-web center<br />
										<b>Birthday</b><br />
										Logo-left_Logo-top<br />
										535_380<br />
										Text-left_Text-top_Text-roted<br />
										585_920_0<br />
										Text-font,Text-size,Text-color<br />
										Sounds_Eroded.ttf,30,0,0,0
									</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-6">
									<?php if ($edit) { ?>
										<a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/position/<?php echo $edit['p_image']; ?>">
											<img class="img-responsive" src="<?php echo base_url(); ?>media/position/<?php echo $edit['p_image']; ?>" style="width: 80% !important;height: 80% !important;">
										</a>

									<?php } ?>
								</div>
								<div class="col-md-6">
									<button type="submit" class="btn btn-primary right">Submit</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</section>

			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
					</div>
					<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;List Position
					</h2>
				</header>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
							<thead>
								<tr>
									<th>ID</th>
									<th>C Type</th>
									<th>Name</th>
									<th>Image</th>
									<th>Logo</th>
									<th>Mobile</th>
									<th>Website</th>
									<th>Email</th>
									<th>Address</th>
									<th>Name P</th>
									<th>B-day-P</th>
									<th>B-day-N</th>
									<th>Wish</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($list as $key) { ?>
									<tr id="<?php echo $key['pid']; ?>">
										<td><?php echo $key['pid']; ?></td>
										<td><?php echo $key['c_type']; ?></td>
										<td><?php echo $key['p_name']; ?></td>
										<td>
											<?php if ($key['p_image']) { ?>
												<a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/position/<?php echo $key['p_image']; ?>">
													<img class="img-responsive " src="<?php echo base_url(); ?>media/position/<?php echo $key['p_image']; ?>" width="100%">
												</a>
											<?php } ?>
										</td>
										<td><?php echo $key['logo_pos']; ?></td>
										<td><?php echo $key['mobile_pos'] ?></td>
										<td><?php echo $key['website_pos'] ?></td>
										<td><?php echo $key['email_pos'] ?></td>
										<td><?php echo $key['address_pos'] ?></td>
										<td><?php echo $key['name_pos'] ?></td>
										<td><?php echo $key['birthdayPhoto_pos'] ?></td>
										<td><?php echo $key['birthdayName_pos'] ?></td>
										<td><?php echo $key['birthday_font'] ?></td>
										<td>
											<div class="btn-group">

												<a href="<?php echo ADMIN_URL . 'position/editPosition/' . $key['pid']; ?>">
													<button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button>
												</a>

												<a href="<?php echo ADMIN_URL . 'position/dublicatePosition/' . $key['pid']; ?>">
													<button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="Dublicate"><i class="fa fa-copy"></i></button>
												</a>

											</div>
										</td>
									</tr>
								<?php $i++;
								} ?>
							</tbody>
						</table>
					</div>



				</div>
			</section>

		</div>
	</div>
	<!-- end: page -->
</section>