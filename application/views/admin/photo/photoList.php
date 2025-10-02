<style>
tbody tr td {
    text-align: center !important;
    vertical-align: middle !important;
}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Photo List</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span class="">Photo List</span></li>
			</ol>
			<span class="listname" style="display: none;">Photo List/0,1,2,3,4/0,2,3,4</span>
			<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
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
					<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Photo List (<?php echo count($list); ?>)
						<a href="<?php echo ADMIN_URL . 'photo/addphoto/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> <span> &nbsp;Add Photo</span></a>
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
					<button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="<?php echo base_url("admin/photo/deleteAllphoto"); ?>">All Selected</button>
					<div class=""><!-- table-responsive -->
					<table class="table table-bordered table-striped mb-none" id="photoListServer">
							<thead>
								<tr>
									<th width="5%"><input type="checkbox" id="master"></th>
									<th width="5%">ID</th>
									<th width="5%">Date</th>
									<th width="5%">Category</th>
									<th width="5%">Title</th>
									<th width="5%">Post</th>
									<th width="5%">Action</th>
								</tr>
							</thead>
							
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>

	<!-- end: page -->
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form class="form-horizontal form-bordered" method="post" action="<?php echo base_url("admin/photo/allEditUpdate");
																		?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Edit photo</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" class="edit_id" name="edit_id">
					<fieldset>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="col-md-12"><strong>Event Date:<font color="red">*</font></strong></label>
									<div class="col-md-12">
										<input type="date" name="t_event_date" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="col-md-12" for="font_size"><strong>Font Size : </strong></label>
									<div class="col-md-12">
										<input type="text" value="18" class="form-control" name="font_size">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="col-md-12" for="font_color"><strong>Font Color : </strong></label>
									<div class="col-md-12">
										<input type="text" value="#ffffff" class="form-control" name="font_color">
									</div>
								</div>
							</div>


						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="col-md-12" for="font_color"><strong>Select Category : </strong></label>
									<div class="col-md-12">
										<select name="category_name" id="category_name" class="category_name form-control"></select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="col-md-12" for="font_color"><strong>Select Font : </strong></label>
									<div class="col-md-12">
										<select name="font_name" id="font_name" class="font_name form-control"></select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="col-md-12" for="font_color"><strong>Select Position : </strong></label>
									<div class="col-md-12">
										<select name="position_name" id="position_name" class="position_name form-control"></select>
									</div>
								</div>
							</div>

						</div>

						<hr>


					</fieldset>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</div>
	</form>
</div>