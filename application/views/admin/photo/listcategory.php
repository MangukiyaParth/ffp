<section role="main" class="content-body">
	<header class="page-header">
		<h2>Category List</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span class="">Category List</span></li>
			</ol>
			<span class="listname" style="display: none;">Category List/0,1,2,3,4/0,2,3,4</span>
			<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-xs-4">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>

					</div>
					<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Category
					</h2>
				</header>
				<div class="panel-body">
					<div class="form-body">
						<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="categoryadd">
						<input type="hidden" name="id" value="<?php echo ($edit) ? $edit['pcat_id'] : ''; ?>">
							<div class="col-md-12">
								<div class="col-md-12">
									<label class="control-label">Category Name</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-person"></i>
										</span>
										<input type="text" name="pcat_title" placeholder="Category Name" value="<?php echo ($edit) ? $edit['pcat_title'] : ""; ?>" class="form-control" />
									</div>
								</div>
								<div class="col-md-12">
									<label class="control-label">Lable</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-tag"></i>
										</span>
										<input autofocus="" type="text" name="lable" placeholder="Enter Lable" class="form-control" value="<?php echo ($edit) ? $edit['lable'] : ""; ?>">
									</div>
								</div>
								<div class="col-md-12">
									<label class="control-label">Lable BG</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-paint-brush"></i>
										</span>
										<input autofocus="" type="text" name="lablebg" placeholder="Enter Lable BG" class="form-control" value="<?php echo ($edit) ? $edit['lablebg'] : ""; ?>">
									</div>
								</div>
								<div class="col-md-12">
									<label class="control-label">Category</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-image"></i>
										</span>
										<input type="file" name="image" class="form-control" />
									</div>
								</div>

								<div class="col-md-12 svbut">
									<button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary"><?php echo empty($edit) ? 'Save' : 'Update'; ?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
		<div class="col-xs-8">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
					</div>
					<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Category List (<?php echo count($list); ?>)
					</h2>
				</header>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
							<thead>
								<tr>
									<th>ID</th>
									<th>Photo</th>
									<th>Title</th>
									<th>Lable</th>
									<th>Lable BG</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key) { ?>
									<tr id="<?php echo $key['pcat_id']; ?>">
										<td><?php echo $key['pcat_id'] ?></td>
										<td>
											<?php if ($key['pcat_image']) { ?>
												<a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/photocategory/<?php echo $key['pcat_image']; ?>">
													<img class="img-responsive" src="<?php echo base_url(); ?>media/photocategory/<?php echo $key['pcat_image']; ?>" width="100px">
												</a>
											<?php } else { ?>
												<a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/Admin.png">
													<img class="img-responsive" src="<?php echo base_url(); ?>media/Admin.png" width="100px"></a>
												<!-- <img src="<?php echo base_url(); ?>media/Admin.png"  alt="" class="heim" > -->
											<?php } ?>
										</td>
										<td><?php echo $key['pcat_title']; ?></td>
										<td><?php echo $key['lable']; ?></td>
										<td><?php echo $key['lablebg']; ?></td>
										<td>
                                        <div class="btn-group">
                                            <a href="<?php echo ADMIN_URL . 'photo/editcategory/' . $key['pcat_id']; ?>">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
											</a>

                                           <!--  <a href="javascript:void(0)" id="<?php //echo $key['mid']; ?>" onclick="deleterecord(this.id,'/category/deleteCategory');"><button type="button"
                                                    class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </a> -->
                                        </div>
                                    </td>
									</tr>
								<?php } ?>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- end: page -->
</section>