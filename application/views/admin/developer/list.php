<section role="main" class="content-body">
	<header class="page-header">
		<h2>Developer</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Developer </span></li>
			</ol>
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
						<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a>  &nbsp; <?php echo empty($edit)?'Add':'Edit'; ?> Developer 
							
							<?php if(!empty($edit)){ ?><a href="<?php echo ADMIN_URL.'developer/'?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> <span> &nbsp;Back</span></a><?php } ?>
						</h2>
					</header>
					<div class="panel-body">
						<div class="form-body">
								<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="adddeveloper">
								
								<input type="hidden" name="id" value="<?php echo($edit)?$edit['d_id']:"";?>">
								
								<div class="col-md-6">
									<label class="control-label">Name<span class="rerq">*</span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-user"></i>
										</span>
										<input autofocus="" type="text" name="name" placeholder="Enter Name" class="form-control" maxlength="30" value="<?php if ($edit) {echo $edit['name'];} else {}?>" >
									</div>
								</div>
								<div class="col-md-6">
									<label class="control-label">Email<span class="rerq">*</span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
										</span>
										<input autofocus="" type="text" name="email" placeholder="Enter Email" class="form-control" maxlength="30" value="<?php if ($edit) {echo $edit['email'];} else {}?>" >
									</div>
								</div>
								<div class="col-md-6">
									<label class="control-label">Mobile No<span class="rerq">*</span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-mobile"></i>
										</span>
										<input autofocus="" type="text" name="mobile" placeholder="Enter Mobile" class="form-control" maxlength="10" value="<?php if ($edit) {echo $edit['mobile'];} else {}?>" >
									</div>
								</div>
								<div class="col-md-6">
									<label class="control-label">Skype ID<span class="rerq">*</span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-skype"></i>
										</span>
										<input autofocus="" type="text" name="skype_id" placeholder="Enter Skype ID" class="form-control" maxlength="30" value="<?php if ($edit) {echo $edit['skype_id'];} else {}?>" >
									</div>
								</div>
								<div class="col-md-6">
									<label class="control-label">Address<span class="rerq">*</span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-address-card-o"></i>
										</span>
										<textarea name="address" data-plugin-masked-input data-input-mask="" placeholder="Enter Address" class="form-control" rows="4" autocomplete="off"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<label class="control-label">Skill<span class="rerq">*</span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-exclamation-circle"></i>
										</span>
										<!-- 	<input autofocus="" type="text" name="skill" placeholder="Enter Skill" class="form-control" maxlength="30" value="" id="skill"> -->
										<select tabindex="1"  data-plugin-selectTwo class="form-control " name="skill[]" multiple   >
											<option value="">--Select Skill--</option>		
											<?php foreach($data['skill_list'] as $skill){?>
												<option <?php echo !empty($edit)?($edit['s_id']==$skill['s_id']?'selected':''):'';?> value="<?php echo $skill['s_id'];?>"><?php echo $skill['skill_name']; ?></option>     							
							                <?php }?>							
								        </select>   
									</div>
								</div>
								<div class="col-md-6">
									<label class="control-label">Reference Name<span class="rerq">*</span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-refresh"></i>
										</span>
										<input autofocus="" type="text" name="reference_name" placeholder="Enter Reference Name" class="form-control" maxlength="30" value="<?php if ($edit) {echo $edit['reference_name'];} else {}?>" >
									</div>
								</div>
								<div class="col-md-6">
									<label class="control-label">Time<span class="rerq">*</span></label>
									<div class="input-group">			
										<input type="radio" name="time" value="0" checked>&nbsp;Full Time &nbsp;&nbsp;
										<input type="radio" name="time" value="1">&nbsp;Part Time
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
			<div class="col-xs-12 col-sm-12 col-md-12">
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
						</div>
						<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a>  &nbsp;Developer List (<?php echo count($list);?>)</h2>
						<span class="listname" style="display: none;" >Developer List/0,1,2,3,4,5,6,7,8/0,1,2,3,4,5,6,7,8</span>

					</header>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
								<thead>
									<tr>	
										<th>No</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile No</th>
										<th>Address</th>
<!-- 									<th>Skill</th>
 -->									<th>Skype Id</th>
										<th>Reference Name</th>
										<th>Time</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;foreach ($list as $key) {?>
									<tr id="<?php echo $key['d_id']; ?>" >
										<td><?php echo $i; ?></td>
										<td><?php echo $key['name']; ?></td>
										<td><?php echo $key['email']; ?></td>
										<td><?php echo $key['mobile']; ?></td>
										<td><?php echo $key['address']; ?></td>	
										<!-- <td><?php echo $key['skill_name']; 
											$obj = json_decode($key); 
											print $obj->{'skill_name'};

										?></td> 
									-->
	<!-- 										<td><?php echo $key['skill_name'];?></td>
 -->									<td><?php echo $key['skype_id']; ?></td>
										<td><?php echo $key['reference_name']; ?></td>
										<td>
		                                    <?php 
		                                      if($key['time'] == 0)
		                                        {
		                                          echo "Full Time";
		                                        }
		                                        else
		                                        {
		                                        echo "Part Time";
		                                        } 
		                                    ?>
		                                </td>
										<td>
											<?php if($key['status'] == 1) { ?>
                                            <a value="1" class="switch switch-sm switch-success<?php echo $key['d_id'];?>" name="status" onclick="DeveloperstatusChanged('d_id/<?php echo $key['d_id'];?>/developer/0')" >
                                                 <i class="pointer fa fa-toggle-on faicon"  data-toggle="tooltip" title="Active"></i></a>
                                                <?php }else{?>
                                                    <a value="0" class="switch switch-sm switch-success<?php echo $key['d_id'];?>" name="status" onclick="DeveloperstatusChanged('d_id/<?php echo $key['d_id'];?>/developer/1')" >
                                                 <i class="pointer fa fa-toggle-off faicona"  data-toggle="tooltip" title="Deactive"></i></a>
                                                <?php } ?>
										</td>
										<td>
											<div class="btn-group">
		                                        <a href="<?php echo ADMIN_URL . 'developer/edit/' . $key['d_id']; ?>">
		                                        	<button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
		                                            <i class="fa fa-pencil"></i>
		                                        </button></a>

		                                    	 <a href="javascript:void(0)" id="<?php echo $key['d_id']; ?>" onclick="deleterecord(this.id,'/developer/deleteDeveloper');"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
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
