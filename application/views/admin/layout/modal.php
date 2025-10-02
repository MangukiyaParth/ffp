<style type="text/css">
.input-group .select2-container--bootstrap.select2-container--focus,
.input-group .select2-container--bootstrap.select2-container--open {
    width: 100% !important;
}

.select2-container--bootstrap .select2-selection--multiple .select2-search--inline .select2-search__field {
    width: 100% !important;
}

.input-group .select2-container--bootstrap {
    width: 100% !important;
}

</style>
<?php if ($this->uri->segment(2) == 'work') { ?>

<!-- <div id="workallication" class=" zoom-anim-dialog modal-header-color modal-block modal-block-info modal-block-md mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title">Work Allocation</h2>
		</header>
		<form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="work">
								<input type="hidden" name="id" value="<?php /*if ($edit) {
																			echo $edit['w_id'];
																		} else {
																		}*/ ?>">
								<div class="col-md-12">
									<div class="form-group">
										<div class="col-md-12 control-label">
											<label class="control-label">Work</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-child"></i>
												</span>
												<select  data-plugin-selectTwo class="form-control populate placeholder" name="work" data-plugin-options='{ "placeholder": "Select a Work", "allowClear": true }' />
												<option value=''>Select Work</option>
												<?php foreach ($work as $key) { ?>
												<?php if ($edit) { ?>
														<?php if ($key['w_id'] == $edit['w_id']) { ?>
															<option value="<?php echo $key['w_id']; ?>" selected ><?php echo $key['title']; ?></option>
														<?php } else { ?>
																<option value="<?php echo $key['w_id']; ?>"><?php echo $key['title']; ?></option>
														<?php } ?>
												<?php } else { ?>								
														<option value="<?php echo $key['w_id']; ?>"><?php echo $key['title']; ?></option>
													
												<?php }
												} ?>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12 control-label">
											<label class="control-label">Memeber</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-users"></i>
												</span>
												<select multiple data-plugin-selectTwo class="form-control populate placeholder" name="member" data-plugin-options='{ "placeholder": "Select a member", "allowClear": true }' />
												<option value=''>Select Member</option>
												<?php foreach ($member as $key) { ?>
												<?php if ($edit) { ?>
														<?php if ($key['mr_id'] == $edit['m_id']) { ?>
															<option value="<?php echo $key['mr_id']; ?>" selected ><?php echo $key['name']; ?></option>
														<?php } else { ?>
																<option value="<?php echo $key['mr_id']; ?>"><?php echo $key['name']; ?></option>
														<?php } ?>
												<?php } else { ?>								
														<option value="<?php echo $key['mr_id']; ?>"><?php echo $key['name']; ?></option>
													
												<?php }
												} ?>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12 control-label">
											<label class="control-label">Note</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-list"></i>
												</span>
												<textarea  id="note" name="note" data-plugin-masked-input data-input-mask="" placeholder="Enter title" class="form-control"><?php if ($edit) {
																																												echo $edit['note'];
																																											} else {
																																											} ?></textarea>
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
								</div>
							
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary" type="submit">Submit</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
	</section>
</div> -->
<?php } ?>



<div id="changepassword" class=" zoom-anim-dialog modal-header-color modal-block modal-block-info modal-block-md mfp-hide" style="z-index: 9999;">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Change Password</h2>
        </header>
        <form method="post" enctype="multipart/form-data" action="javascript:void(0);" id="changepass">
            <div class="panel-body">
                <div id="msg" class="msg"></div>
                <div class="modal-wrapper">
                    <div class="modal-text">
                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <label class="control-label">Current Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="currentpass" id="currentpass" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control " data-plugin-maxlength
                                        maxlength="15" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <label class="control-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="newpass" id="new" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control " data-plugin-maxlength maxlength="15"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <label class="control-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="conpass" id="conpass" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control " data-plugin-maxlength
                                        maxlength="15" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<!-- <div id="user_chang_pass_model" class="stu_res_model zoom-anim-dialog modal-header-color modal-block modal-block-info modal-block-md mfp-hide" style="z-index: 999999;">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Change Password-</h2>
        </header>
        <form method="post" enctype="multipart/form-data" action="javascript:void(0);" id="userchangepass">
            <div class="panel-body">
                <div id="msg" class="msg"></div>
                <div class="modal-wrapper">
                    <div class="modal-text">
                        <input type="hidden" name="id" id="id" value="id">
                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <label class="control-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="newpass" id="newpass" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control " data-plugin-maxlength
                                        maxlength="15" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <label class="control-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="conpass" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control " data-plugin-maxlength maxlength="15"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div> -->
<div id="user_chang_pass_model" class="stu_res_model zoom-anim-dialog modal-header-color modal-block modal-block-info modal-block-md mfp-hide" style="z-index: 999999;">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Change Password-</h2>
        </header>
        <form method="post" enctype="multipart/form-data" action="javascript:void(0);" id="userchangepass">
            <div class="panel-body">
                <div id="msg" class="msg"></div>
                <div class="modal-wrapper">
                    <div class="modal-text">
                        <input type="hidden" name="id" id="id" value="id">
                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <label class="control-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="newpass" id="newpass" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control " data-plugin-maxlength
                                        maxlength="15" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <label class="control-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="conpass" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control " data-plugin-maxlength maxlength="15"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Change Password</h3>
            </div>
            <form method="post" action="javascript:void(0);" id="userchangepass1">
                <div class="modal-body form">
                    <div class="panel-body">
                        <div id="msg" class="msg"></div>
                        <div class="modal-wrapper">
                            <div class="modal-text">
                                <input type="hidden" name="userid" id="userid" value="">
                                <input type="hidden" name="type" id="type" value="">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </span>
                                            <input type="password" name="newpassword" id="newpassword" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control "
                                                data-plugin-maxlength maxlength="15" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </span>
                                            <input type="password" name="confirmpassword" id="confirmpassword" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control "
                                                data-plugin-maxlength maxlength="15" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-primary" type="button" data-dismiss="modal" aria-label="Close">Cencel</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="complainReplyModel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Reply</h3>
            </div>
            <form method="post" action="javascript:void(0);" id="replyForm">
                <div class="modal-body form">
                    <div class="panel-body">
                        <div class="msg"> </div>
                       
                        <div class="modal-wrapper1">
                            <div class="modal-text">
                                <input type="hidden" name="id" id="compainId" value="">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Reply Message</label>
                                    <textarea name="reply" id="reply" placeholder="" class="form-control "
                                        row="4" autocomplete="off"> </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Status</label>
                                        <select id="status" name="status" class="form-control">
                                        <option value="0">Pending</option>
                                        <option value="1">On Progress</option>
                                        <option value="2">Hold</option>
                                        <option value="3">Solved</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12"> 
                                       <input type="checkbox" name="sendNotification" id="sendNotification" value="yes" /> Send Notification                                                                                                                                     
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-primary" type="button" data-dismiss="modal" aria-label="Close">Cencel</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<style>
.modal-header {
    background-color: #56c1e0;
    margin: -1px;
    color: white;
}

.modal-dialog {
    width: 800px !important;
}

.header-title-bg {
    background-color: #5bc0de;
    color: white;
}

.logoset {
    margin-bottom: 10px;
}

.exp_date {
    background-color: green;
    color: white;
}

</style>

<div class="modal fade" id="userProfile" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Profile</h3>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                <div id="msg" class="msg"></div>
                    <div class="col-md-4 logoset">
                        <!-- <img src="<?php echo base_url('media/logo/1619701775-image_cropper_1619701746062.png');?>" width="100%"> -->
                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped first-part">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped second-part">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 header-title-bg">
                        <h4>Assign Information</h4>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped third-part">
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 header-title-bg">
                        <h4>Payment Information</h4>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped payments">
                            <thead>
                                <!-- <tr>
                                    <th>Plan</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Transaction</th>
                                    <th>Created At</th>
                                    <th>Refund</th>
                                    <th>Date</th>
                                    <th>Role</th>
                                </tr> -->
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="sendPaymentLinkByUser">
                            <input type="hidden" name="user_id" class="user_id">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Payment Link Id</th>
                                        <th>Mobile</th>
                                        <th>Attempts</th>
                                        <th>Exp Date</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label class="control-label">Select Package <span class="rerq">*</span></label>
                                            <select name="packageid" class="form-control packageid">
                                                <option value="">-- Select Package--</option>
                                            </select>
                                        </td>
                                        <td colspan="3">
                                            <label class="control-label">Enter Amount <span class="rerq">*</span></label>
                                            <input type="number" name="amount" class="form-control amount" placeholder="Enter Amount" readonly>
                                        </td>
                                        <td colspan="2">
                                            <label class="control-label">&nbsp;</label>
                                            <button type="submit" class="Right mb-xs mt-xs mr-xs btn btn-success" style="float: right;">Send Payment Link</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <div class="col-md-12 header-title-bg">
                        <h4>Device Information</h4>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped deviceinfo">
                            <thead>
                                <tr>
                                    <th>Device ID</th>
                                    <th>User ID</th>
                                    <th>App Version</th>
                                    <th>Oprating System</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 header-title-bg">
                        <h4 class="custom_frames"> </h4>
                    </div>
                    <p>&nbsp;</p>
                    <div class="col-md-12 header-title-bg">
                        <h4>Refund</h4>
                    </div>
                    <div class="col-md-12">
                        <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="refundModalForm">
                        <input type="hidden" name="user_id" class="user_id">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Enter Refund ID <span class="rerq">*</span></label>
                                    <input type="text" name="refund_id" class="form-control" placeholder="Enter Refund ID">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="Left mb-xs mt-xs mr-xs btn btn-primary" style="margin-top: 27px !important;">Refund</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p></p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>
