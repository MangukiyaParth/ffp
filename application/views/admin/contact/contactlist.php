<section role="main" class="content-body">
	<header class="page-header">
		<h2>Contact Diary</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Contact Diary</span></li>

			</ol>
				<span class="listname" style="display: none;" >Contact List/0,1,2,3,4/0,1,2,3,4</span>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

	<!-- start: page -->
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
						</div>
						<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a>  &nbsp; Add Contact Diary</h2>
					</header>
					<div class="panel-body">
						<div class="form-body">
								<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="addcontact">
								<!-- <div class="col-md-12"> -->
										<input type="hidden" name="id" value="<?php if ($edit) {echo $edit['c_id'];} else {}?>">
								<div class="col-md-6 ">
									<div class="col-md-12">
										<label class="control-label">Name<span class="rerq">*</span></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user"></i>
											</span>
											<input autofocus="" type="text" name="name" placeholder="Enter Name" class="form-control" maxlength="30" value="<?php if ($edit) {echo $edit['name'];} else {}?>" >
										</div>
									</div>
									<div class="col-md-12">
										<label class="control-label">Phone<span class="rerq">*</span></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-phone"></i>
											</span>
											<input id="phone" name="mobile" type="text" data-plugin-masked-input data-plugin-maxlength maxlength="10"  placeholder="8888888888" class="form-control onlynumber" value="<?php if ($edit) {echo $edit['mobile'];} else {}?>" >
										</div>
									</div>
									<div class="col-md-12">
										<label class="control-label">Designation</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user-circle-o"></i>
											</span>
											<input type="text" name="designation" id="designation" placeholder="Enter Designation" class="form-control" data-plugin-maxlength maxlength="30" value="<?php if ($edit) {echo $edit['designation'];} else {}?>" >
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-12">
										<label class="control-label" for="textareaDefault">Address</label>
										<textarea name="address" class="form-control" rows="7"><?php if ($edit) {echo $edit['address'];} else {}?></textarea>
									</div>
								</div>


								<div class="col-md-12">
										<div class="col-md-12">
											<button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary">Save</button>
										</div>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
								</div>
								<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a>  &nbsp;Contact List (<?php echo count($list);?>)</h2>
							</header>
							<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>Name</th>
											<th width="10%">Mobile</th>
											<th width="15%">Designation</th>
											<th >Address</th>
											<th width="15%">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;foreach ($list as $key) {?>
										<tr id="<?php echo $key['c_id']; ?>" >
											<td><?php echo $i; ?></td>
											<td><?php echo $key['name']; ?></td>
											<td><?php echo $key['mobile']; ?></td>
											<td><?php echo $key['designation']; ?></td>
											<td><?php echo $key['address']; ?></td>
											<td>
												<div class="btn-group">
			                                        <a href="<?php echo ADMIN_URL . 'contact/contactadd/' . $key['c_id']; ?>"><button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
			                                            <i class="fa fa-pencil"></i>
			                                        </button></a>

			                                    	 <a href="javascript:void(0)" id="<?php echo $key['c_id']; ?>" onclick="deleterecord(this.id,'/contact/deletecontact');"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
			                                            <i class="fa fa-times"></i>
			                                        </button>
			                                    	</a>
			                                    </div>
                                			</td>
										</tr>
										<?php $i++;}?>
									</tbody>
								</table>
							</div>
							</div>
						</section>
					</div>
				</div>
			</div>
	<!-- end: page -->
</section>
