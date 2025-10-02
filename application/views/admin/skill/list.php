<section role="main" class="content-body">
	<header class="page-header">
		<h2>Skill</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Skill </span></li>
			</ol>
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

	<!-- start: page -->
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4">
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
						</div>
						<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a>  &nbsp; <?php echo empty($edit)?'Add':'Edit'; ?> Skill 
							
							<?php if(!empty($edit)){ ?><a href="<?php echo ADMIN_URL.'skill/'?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> <span> &nbsp;Back</span></a><?php } ?>
						</h2>
					</header>
					<div class="panel-body">
						<div class="form-body">
								<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="addskill">
								
								<input type="hidden" name="id" value="<?php if ($edit) {echo $edit['s_id'];} else {}?>">
								
								<div class="col-md-12">
									<label class="control-label">Name<span class="rerq">*</span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-exclamation-circle"></i>
										</span>
										<input autofocus="" type="text" name="skill" placeholder="Enter Skill" class="form-control" maxlength="30" value="<?php if ($edit) {echo $edit['skill_name'];} else {}?>" >
									</div>
								</div>
								
								<div class="col-md-12">
									<label class="control-label" for="textareaDefault">Status</label>
									<?php 
										if ($edit) {
											$status = $edit['status']==1?'checked=""':'';
										} else {
											$status = 'checked=""';
										}
										?>
									<div class="switch switch-sm switch-success">
										<input type="checkbox" <?php echo $status; ?> name="status" value="1" data-plugin-ios-switch  />
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-12">
										<button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary"><?php echo empty($edit)?'Save':'Update'; ?></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8">
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
						</div>
						<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a>  &nbsp;Skill List (<?php echo count($list);?>)</h2>
						<span class="listname" style="display: none;" >Skill List/0,1,2/0,1,2</span>

					</header>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
								<thead>
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;foreach ($list as $key) {?>
									<tr id="<?php echo $key['s_id']; ?>" >
										<td><?php echo $i; ?></td>
										<td><?php echo $key['skill_name']; ?></td>
										<td>
											<?php if($key['status'] == 1) { ?>
                                            <a value="1" class="switch switch-sm switch-success<?php echo $key['s_id'];?>" name="status" onclick="SkillstatusChanged('s_id/<?php echo $key['s_id'];?>/skill/0')" >
                                                 <i class="pointer fa fa-toggle-on faicon"  data-toggle="tooltip" title="Active"></i></a>
                                                <?php }else{?>
                                                    <a value="0" class="switch switch-sm switch-success<?php echo $key['s_id'];?>" name="status" onclick="SkillstatusChanged('s_id/<?php echo $key['s_id'];?>/skill/1')" >
                                                 <i class="pointer fa fa-toggle-off faicona"  data-toggle="tooltip" title="Deactive"></i></a>
                                                <?php } ?>
										</td>
										<td>
											<div class="btn-group">
		                                        <a href="<?php echo ADMIN_URL . 'skill/edit/' . $key['s_id']; ?>">
		                                        	<button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
		                                            <i class="fa fa-pencil"></i>
		                                        </button></a>

		                                    	 <a href="javascript:void(0)" id="<?php echo $key['s_id']; ?>" onclick="deleterecord(this.id,'/skill/deleteSkill');"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
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
