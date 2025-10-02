<section role="main" class="content-body">
    <header class="page-header">
        <h2>Setting Forms</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Forms</span></li>
                <li><span>Setting</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
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
                    <h2 class="panel-title">Site Setting</h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="setting">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <h2>Site Settings</h2>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="control-label">Site Name<span class="rerq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <input autofocus="" type="text" name="sitename" value="<?php echo $result['sitename']; ?>" data-plugin-masked-input data-input-mask="" placeholder="Site Name"
                                            class="form-control" data-plugin-maxlength maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="email" id="site_email" name="site_email" value="<?php echo $result['site_email']; ?>" data-plugin-masked-input data-input-mask=""
                                            placeholder="example@gmail.com" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Site Logo</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-image"></i>
                                        </span>
                                        <input type="file" name="site_logo" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <?php if ($result['site_logo']) { ?>
                                        <img src="<?php echo base_url(); ?>media/users/<?php echo $result['site_logo']; ?>" alt="" style="position: relative;padding-top: 27px;" class="higimg">
                                        <a href="javascript:void(0)" style="" class="imdele" id="1" onclick="deleterecord(this.id,'/setting/logoremove');" class="">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="control-label">Title</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-list"></i>
                                        </span>
                                        <input type="text" name="title" value="<?php echo $result['title']; ?>" data-plugin-masked-input data-input-mask="" placeholder="Enter Title"
                                            class="form-control" data-plugin-maxlength maxlength="30">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="control-label">Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-map-marker"></i>
                                        </span>
                                        <textarea name="address" data-plugin-masked-input data-input-mask="" placeholder="" class="form-control" rows="5"><?php echo $result['address']; ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <br />
                                <hr />
                                <div class="col-md-12">
                                    <h2>Application Settings</h2>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="control-label">Call Number</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <input type="text" id="support_call" name="support_call" value="<?php echo $result['support_call']; ?>" placeholder="+91 8888888888" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">WhatsApp Numbe</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <input type="text" id="whatsappNumber" name="whatsappNumber" value="<?php echo $result['whatsappNumber']; ?>" placeholder="+91 8888888888" class="form-control">
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <label class="control-label">Sharing Link</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <input type="text" id="sharingLink" name="sharingLink" value="<?php echo $result['sharingLink']; ?>" placeholder="Enter payment key 2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Sharing Banner</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-image"></i>
                                        </span>
                                        <input type="file" name="sharingBanner" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">Total User Post</label>
                                    <div class="switch switch-sm switch-success">
                                        <h3 style="margin-top: 0px;"><?php echo $result['totalpost']; ?></h3>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <?php if ($result['sharingBanner']) { ?>
                                        <img src="<?php echo base_url(); ?>media/sharingBanner/<?php echo $result['sharingBanner']; ?>" style="position: relative;padding-top: 27px;" class="higimg">
                                        <a href="javascript:void(0)" class="imdele" id="1" onclick="deleterecord(this.id,'/setting/sharingBannerRemove');">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    <?php } ?>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">App Active / Deactive</label>
                                    <div class="switch switch-sm switch-success">
                                        <!-- <label>&nbsp;</label> -->
                                        <input type="checkbox" name="active" value="1" data-plugin-ios-switch <?php echo ($result['active'] == 1) ? 'checked="checked"' : ''; ?> />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <label class="control-label">Whatsapp Festival Name</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <input type="text" id="festival_name" name="festival_name" value="<?php echo $result['festival_name']; ?>" placeholder="Enter Festival Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">8141631381 <span class="rerq">auto/bulk</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <input type="text" id="mobile81" name="mobile81" value="<?php echo $result['mobile81']; ?>" placeholder="Enter 1 or 2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">8141631375 <span class="rerq">auto/bulk</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <input type="text" id="mobile75" name="mobile75" value="<?php echo $result['mobile75']; ?>" placeholder="Enter 1 or 2" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="col-md-12">
                                    <label class="control-label">About Us</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-map-marker"></i>
                                        </span>
                                        <textarea name="aboutUs" data-plugin-masked-input data-input-mask="" placeholder="Enter App About us" class="form-control"
                                            rows="7"><?php echo $result['aboutUs']; ?></textarea>
                                    </div>
                                </div>
                                
                                <!--  -->

                               

                                <div class="col-md-4">
                                    <label class="control-label">Forcefully all Logout</label>
                                    <div class="switch switch-sm switch-success">
                                        <input type="checkbox" name="forceFullyLogout" value="1" data-plugin-ios-switch
                                            <?php echo ($result['forceFullyLogout'] == 1) ? 'checked="checked"' : ''; ?> />
                                    </div>
                                </div>

                                <!--  -->

                                <div class="col-md-4">
                                    <label class="control-label">Help & Support</label>
                                    <div class="switch switch-sm switch-success">
                                        <!-- <label>&nbsp;</label> -->
                                        <input type="checkbox" name="help-support" value="1" data-plugin-ios-switch <?php echo ($result['help-support'] == 1) ? 'checked="checked"' : ''; ?> />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">Feedback & Suggestion</label>
                                    <div class="switch switch-sm switch-success">
                                        <!-- <label>&nbsp;</label> -->
                                        <input type="checkbox" name="feedback-suggestion" value="1" data-plugin-ios-switch
                                            <?php echo ($result['feedback-suggestion'] == 1) ? 'checked="checked"' : ''; ?> />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">Premium Subscription</label>
                                    <div class="switch switch-sm switch-success">
                                        <!-- <label>&nbsp;</label> -->
                                        <input type="checkbox" name="premium-subscription" value="1" data-plugin-ios-switch
                                            <?php echo ($result['premium-subscription'] == 1) ? 'checked="checked"' : ''; ?> />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">Refer & Earn</label>
                                    <div class="switch switch-sm switch-success">
                                        <!-- <label>&nbsp;</label> -->
                                        <input type="checkbox" name="refer-earn" value="1" data-plugin-ios-switch <?php echo ($result['refer-earn'] == 1) ? 'checked="checked"' : ''; ?> />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">Complaint Menu</label>
                                    <div class="switch switch-sm switch-success">
                                        <!-- <label>&nbsp;</label> -->
                                        <input type="checkbox" name="complaint_menu" value="1" data-plugin-ios-switch <?php echo ($result['complaint_menu'] == 1) ? 'checked="checked"' : ''; ?> />
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                            <div class="col-md-12">
                                    <label class="control-label">SMS Gateway</label>
                                    <div class="input-group">
                                        <select name="sms_gateway_type" class="form-control">
                                            <option value="windex" <?php echo $result['sms_gateway_type'] == 'windex' ? 'selected':''; ?>>Windex</option>
                                            <option value="bulksms" <?php echo $result['sms_gateway_type'] == 'bulksms' ? 'selected':''; ?>>Bulksms</option>
                                            <option value="msg91" <?php echo $result['sms_gateway_type'] == 'msg91' ? 'selected':''; ?>>MSG91</option>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>&nbsp;</label>
                                <button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
