<section role="main" class="content-body">
	<header class="page-header">
		<h2>User Post List</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span class="">User Post List</span></li>
			</ol>
			<span class="listname" style="display: none;">Usaer List/0,1,2,3,4/0,1,2,3,4</span>

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

					<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;User Post List (<?php echo count($list); ?>)
						<a href="javascript:void(0)" id="0" onclick="deleterecord(this.id,'/userpost/allUserPostDelete');" class="right mb-xs mt-xs mr-xs btn padheader btn-danger"><i class="fa fa-trush" aria-hidden="true"></i> <span> &nbsp;All Clear</span></a>
					</h2>
				</header>
				<div class="panel-body">
					<div class=""><!-- table-responsive -->
						<table class="table table-bordered table-striped mb-none" id="userPostServerList">
							<thead>
								<tr>
									<th width="5%">ID</th>
									<th width="20%">User</th>
									<th width="10%">Mobile</th>
									<th width="5%">Tamp ID</th>
									<th width="5%">Post</th>
									<th width="5%">Created</th>
									<th width="5%">Updated</th>
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