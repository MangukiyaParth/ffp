<section role="main" class="content-body">
	<header class="page-header">
		<h2>Roles</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL.'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Roles</span></li>

			</ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

								<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="role">
	<!-- start: page -->
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6">
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
						</div>
						<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a>  &nbsp; Add Role</h2>
					</header>
					<div class="panel-body">
						<div class="form-body">
							<div class="col-md-12">
								<div class="form-group">
									<input type="hidden" name="id" value="<?php if($edit) { echo $edit['r_id']; }else {}?>">
									<div class="col-md-12 control-label">
										<label class="control-label">Role-Title<span class="rerq">*</span></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user-secret"></i>
											</span>
											<input autofocus="" type="text" name="role" data-plugin-masked-input data-input-mask="" placeholder="Role" class="form-control" data-plugin-maxlength maxlength="15" value="<?php if($edit) { echo $edit['title'];} else {} ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-body">

								<div class="col-md-12 col-xs-12 col-sm-12">
									<label class="control-label">Module Permission</label>
									<div class="form-group">
										<div class="col-md-12 control-label">
											<div class="table-responsive">
											<!-- <label class="control-label">Module list</label> -->
											<table class="table table-bordered table-stripe" >
												<thead>
													<th>Module Name</th>
													<th>ADD</th>
													<th>DELETE</th>
													<th>UPDATE</th>
													
												</thead>
												<tbody>
													<?php 
														for ($i=0; $i < count($module) ; $i++) { 
															if($i != 0){

														 if($i%3 == 0) { ?><tr>
																<td> <?php $value = explode('_',$module[$i]['title']); if($value[0] == 'mmberads'){ echo "Member Ads"; }elseif($value[0] == 'spnsorlogo') { echo 'Sponsor Logo '; }elseif($value[0] == 'wrkallocation'){ echo 'Work Allocation'; }else{  echo ucfirst($value[0]); } ?></td>
														<?php } } else { ?>
 															<td> <?php $value  = explode('_',$module[$i]['title']); if($value[0] == 'mmberads'){ echo "Member Ads"; }elseif($value[0] == 'spnsorlogo') { echo 'Sponsor Logo '; }elseif($value[0] == 'wrkallocation'){ echo 'Work Allocation'; }else{  echo ucfirst($value[0]); } ?></td>
														<?php } ?>

															<td>	
																	<div class="switch switch-sm switch-success">
																		<input type="checkbox" name="permission[]" value="<?php echo $module[$i]['m_id'];?>" data-plugin-ios-switch  <?php  if($edit) {  if(count(search($permission,'m_id',$module[$i]['m_id']))) { 
																			echo "checked"; 
																		} } ?>/>
																	</div>
															</td>			
													<?php } ?>	
												</tbody>
											</table>
										</div>		
									</div>
									</div>
								</div>
								<div class="col-md-12"><br />
									<div class="form-group">
										<div class="col-md-12">
											<button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary">Save</button>
										</div>
									</div>
									<!-- <div class="form-group">
										<div class="col-md-12">
										</div>
									</div> -->
								</div>
							</form>
						</div>
					</div>
				</section>

				
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
						</div>
						<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a>  &nbsp;Role List (<?php echo count($role); ?>)</h2>
						<span class="listname" style="display: none;" >Role List/0,1/0,1</span>
					</header>
					<div class="panel-body">
						<div class="table-responsive">
						<table class="table table-bordered table-striped  datatable-tabletools">
							<thead>
								<tr>
									<th width="5%">ID</th>
									<th>Title</th>
									<th width="25%">Action</th>
								</tr>
							</thead>
							<tbody>
								
									<?php $i=1; foreach ($role as $key ) { ?>
										<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $key['title'];?></td>
									<td>
										<div class="btn-group">
                                            <a href="<?php echo ADMIN_URL.'setting/role/'.$key['r_id']; ?>"><button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button></a>
                                            <a href="javascript:void(0)" class="" id="<?php echo $key['r_id']; ?>" onclick="deleterecord(this.id,'/setting/deleterole');"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        	</a>
                                        </div>
                                   	</td>
								</tr>
									<?php $i++;} ?>
							</tbody>
						</table>
					</div>
					</div>
				</section>

			
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12	">
					<!-- <section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									
								</div>
								<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a>  &nbsp;Role List</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped  tabletools">
									<thead>
										<tr>
											<th>ID</th>
											<th>Title</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<?php $i=1; foreach ($role as $key ) { ?>
												<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $key['title'];?></td>
											<td>
												<div class="btn-group">
                                                    <a href="<?php echo ADMIN_URL.'setting/role/'.$key['r_id']; ?>"><button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </button></a>
                                                    <sa href="javascript:void(0)" onclick="deleterole(<?php echo $key['r_id'];?>)"><button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                	</a>
                                                </div>
                                           	</td>
										</tr>
											<?php $i++;} ?>
									</tbody>
								</table>
							</div>
						</section> -->
					</div>
				</div>
			</div>
	<!-- end: page -->
</section>
