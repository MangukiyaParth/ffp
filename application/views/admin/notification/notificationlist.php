<section role="main" class="content-body">
	<header class="page-header">
		<h2>Notification</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Notification</span></li>

			</ol>
				<span class="listname" style="display: none;" >Notification List/0,1,2,3,4,5,6/0,1,2,3,4,5,6</span>

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
						<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a>  &nbsp; <?php echo empty($edit)?'Add':'Edit'; ?> Notification
							<?php if(!empty($edit)){ ?><a href="<?php echo ADMIN_URL.'notification/'?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> <span> &nbsp;Back</span></a><?php } ?></h2>
					</header>
					<div class="panel-body">
						<div class="form-body">
								<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="addNotification">
								<!-- <div class="col-md-12"> -->
										<input type="hidden" name="id" value="<?php if ($edit) {echo $edit['n_id'];} else {}?>">
								<div class="col-md-6 ">
									<div class="col-md-12">
										<label class="control-label">Application ID<span class="rerq">*</span></label>
										<div class="input-group">
											<select tabindex="1" data-plugin-selectTwo class="customer form-control" name="app_id">
                      								<option value="">--Select Application--</option>
                       									 <?php foreach($data['application_list'] as $application){?>
                        								<option <?php echo !empty($edit)?($edit['app_id']==$application['app_id']?'selected':''):'';?> value="<?php echo $application['app_id']?>"><?php echo $application['app_name']; ?>
                        							</option>
								                        <?php }?>

								                  </select>   
										</div>
									</div>
									<div class="col-md-12">
										<label class="control-label">Title<span class="rerq">*</span></label>
										<div class="input-group">
											<span class="input-group-addon">
												 <i class="fa fa-list"></i>
											</span>
											<input autofocus="" type="text" name="title" placeholder="Enter Title" class="form-control" maxlength="30" value="<?php if ($edit) {echo $edit['title'];} else {}?>" >
										</div>
									</div>
									<div class="col-md-12">
										<label class="control-label">Message<span class="rerq">*</span></label>
										<textarea name="message" class="form-control" rows="5"><?php if ($edit) {echo $edit['message'];} else {}?></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-12">
										<label class="control-label">Image</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-image"></i>
												</span>
												<input type="file" name="image"  class="form-control"  accept="image/*"/>
											</div>
										
									</div>
									<div class="col-md-12">
										<div class="col-md-12">
										
										</div>
									</div>
									<div class="col-md-12">
										<label class="control-label">Schedule Time<span class="rerq">*</span></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-calendar"></i> 
											</span>
											<input id="schedule_time" name="schedule_time" type="datetime-local" placeholder="" class="form-control " value="" >
										</div>
											
										
									</div>


								</div>

								<div class="col-md-6">
									<div>
										<div class="col-md-12">
											<label class="control-label">Status</label>
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
									</div>
								</div>
								<div class="col-md-6">
										<div>
										<div class="col-md-12">
										<?php if ($edit) { if($edit['image']) { ?>
										<a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/notification/<?php echo $edit['image'];?>">
	                                  	<img src="<?php echo base_url(); ?>media/notification/<?php echo $edit['image'];?>" alt="" class="edimg right"></a>
	                                  	<!-- <a href="javascript:void(0)"  style="" class="edituimg" id="<?php echo $edit['n_id']; ?>" onclick="deleterecord(this.id,'/notification/deletnotificationimg');"class="" >
                                          <i class="fa fa-times"></i>         
                                        </a> -->
	                                  	<?php } } ?> 
	                                	</div>
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
								<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a>  &nbsp;Notification List(<?php echo count($list);?>) </h2>
							</header>
							<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>Application ID</th>
											<th width="10%">Title</th>
											<th width="15%">Message</th>
											<th>Image</th>
											<th>Schedule Time</th>
											<th>Status</th>
											<th width="15%">Action</th>
										</tr>
									</thead>
									 <tbody>
										<?php $i = 1;foreach ($list as $key) {?>
										<tr id="<?php echo $key['n_id']; ?>" >
											<td><?php echo $i; ?></td>
											<td><?php echo $key['app_name']; ?></td>
											<td><?php echo $key['title']; ?></td>
											<td><?php echo $key['message']; ?></td>
											<td><?php if($key['image']) { ?>
												<a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/notification/<?php echo $key['image'];?>">
												<img class="img-responsive heim" src="<?php echo base_url(); ?>media/notification/<?php echo $key['image'];?>" width="75%">
												</a> 
                                            
                                            <?php } else {?> 
                                            	<a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/Admin.png">
												<img class="img-responsive heim" src="<?php echo base_url(); ?>media/Admin.png" width="75%" ></a>
                                           
                                            <?php } ?></td>
											<td><?php echo $key['schedule_time']; ?></td>
											<td>
											<?php if($key['status'] == 1) { ?>
                                            <a value="1" class="switch switch-sm switch-success<?php echo $key['n_id'];?>" name="status" onclick="NotificationstatusChanged('n_id/<?php echo $key['n_id'];?>/notification/0')" >
                                                 <i class="pointer fa fa-toggle-on faicon"  data-toggle="tooltip" title="Active"></i></a>
                                                <?php }else{?>
                                                    <a value="0" class="switch switch-sm switch-success<?php echo $key['n_id'];?>" name="status" onclick="NotificationstatusChanged('n_id/<?php echo $key['n_id'];?>/notification/1')" >
                                                 <i class="pointer fa fa-toggle-off faicona"  data-toggle="tooltip" title="Deactive"></i></a>
                                                <?php } ?>
										</td>
											<td>
												<div class="btn-group">
			                                       <a href="<?php echo ADMIN_URL . 'notification/edit/' . $key['n_id']; ?>">
		                                        	<button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
		                                            <i class="fa fa-pencil"></i>
		                                        </button></a>

			                                    	 <a href="javascript:void(0)" id="<?php echo $key['n_id']; ?>" onclick="deleterecord(this.id,'/notification/deleteNotification');"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
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
