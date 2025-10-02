<style>
#radioBtn .notActive {
    color: #3276b1;
    background-color: #fff;
}

</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Application</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Application</span></li>

            </ol>
            <!-- <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a> -->
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
                    <h2 class="panel-title">
                        <a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp; Application Page
                        <a href="<?php echo ADMIN_URL . 'MyUnit/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-list" aria-hidden="true"></i> <span> &nbsp;Advertise List</span></a>
                    </h2>
                </header>
                <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="addApplication">
                    <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['app_id'] : ''; ?>">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Application Name<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-snowflake-o"></i>
                                            </span>
                                            <input type="text" name="app_name" placeholder="Enter Application Name" class="form-control" maxlength="100"
                                                value="<?php echo ($edit) ? $edit['app_name'] : '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Application Package Name<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" name="app_package_name" placeholder="Enter Application Package Name" class="form-control" maxlength="100"
                                                value="<?php echo ($edit) ? $edit['app_package_name'] : '' ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">OnClick Count Ads Display<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-snowflake-o"></i>
                                            </span>
                                            <input type="text" name="adclick" placeholder="Enter OnClick Count Ads Display" class="form-control" maxlength="1" minlength="1"
                                                value="<?php echo ($edit) ? $edit['adclick'] : '3' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Ads Mode (0-Test, 1- Live)<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="mode" value="0" <?php echo ($edit) ? $edit['mode']==0?"checked":"":'checked' ?>>Test
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="mode" value="1" <?php echo ($edit) ? $edit['mode']==1?"checked":"":'' ?>>Live
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="adsPlatform" class="col-sm-4 col-md-4 control-label text-right">Ads Platform</label>
                                            <div class="col-sm-7 col-md-7">
                                                <div class="input-group">
                                                    <div id="radioBtn" class="btn-group">
                                                        <a class="btn btn-primary btn-sm <?php echo ($edit) ? ($edit['status'] == 0) ? 'active' : 'notActive':"active"; ?> " data-toggle="adsPlatform"
                                                            data-title="0">Off</a>
                                                        <a class="btn btn-primary btn-sm <?php echo ($edit) ? ($edit['status'] == 1) ? 'active' : 'notActive':"notActive"; ?> "
                                                            data-toggle="adsPlatform" data-title="1">Google</a>
                                                        <a class="btn btn-primary btn-sm <?php echo ($edit) ? ($edit['status'] == 2) ? 'active' : 'notActive':"notActive"; ?> "
                                                            data-toggle="adsPlatform" data-title="2">Facebook</a>
                                                    </div>
                                                    <input type="hidden" name="status" id="adsPlatform" value="<?php echo ($edit) ? $edit['status']:0;?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <br />
                                <h3 class="heading-bg"><b>Update Dailog Data</b></h3>
                                <br />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Title<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-snowflake-o"></i>
                                            </span>
                                            <input type="text" name="d_title" placeholder="Enter Dailog Title" class="form-control" value="<?php echo ($edit) ? $edit['d_title'] : '' ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Button 1</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-snowflake-o"></i>
                                            </span>
                                            <input type="text" name="d_button1" placeholder="Enter Button 1 Title" class="form-control" value="<?php echo ($edit) ? $edit['d_button1'] : '' ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">Button 2</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-snowflake-o"></i>
                                            </span>
                                            <input type="text" name="d_button2" placeholder="Enter Button 2 Title" class="form-control" value="<?php echo ($edit) ? $edit['d_button2'] : '' ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Description</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <textarea rows="5" cols="" name="d_description" placeholder="Enter Description"
                                                class="form-control"><?php echo ($edit) ? $edit['d_description'] : '' ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Link URL</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-snowflake-o"></i>
                                            </span>
                                            <input type="text" name="d_link" placeholder="Enter Link" class="form-control" value="<?php echo ($edit) ? $edit['d_link'] : '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">App Version</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-snowflake-o"></i>
                                            </span>
                                            <input type="text" name="d_appversion" placeholder="Enter App Version" class="form-control" value="<?php echo ($edit) ? $edit['d_appversion'] : '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Update - Is Display (0 - Off, 1 - On)</label>
                                        <div class="input-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="d_isDisplay" value="0" <?php echo ($edit) ? $edit['d_isDisplay']==0?"checked":"":'checked' ?>>Off
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="d_isDisplay" value="1" <?php echo ($edit) ? $edit['d_isDisplay']==1?"checked":"":'' ?>>On
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Update - Forcefully Update (0-Off, 1- On)</label>
                                        <div class="input-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="d_forcefully" value="0" <?php echo ($edit) ? $edit['d_forcefully']==0?"checked":"":'checked' ?>>Off
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="d_forcefully" value="1" <?php echo ($edit) ? $edit['d_forcefully']==1?"checked":"":'' ?>>On
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12 text-center">
                                <br />
                                <h3 class="heading-bg"><b>Offer Dailog Data</b></h3>
                                <br />
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-9">

                                <div class="col-md-4">
                                    <label class="control-label">Select Banner type</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-snowflake-o"></i>
                                        </span>
                                        <select name="o_type" class="form-control">
                                            <option value="">-- Select --</option>
                                            <option <?php echo($edit)?($edit['o_type']=="view")?"selected":"":""; ?> value="view">View</option>
                                            <option <?php echo($edit)?($edit['o_type']=="click")?"selected":"":""; ?> value="click">Click</option>
                                            <option <?php echo($edit)?($edit['o_type']=="today")?"selected":"":""; ?> value="today">Today</option>
                                            <option <?php echo($edit)?($edit['o_type']=="plan")?"selected":"":""; ?> value="plan">Plan</option>
                                            <option <?php echo($edit)?($edit['o_type']=="upcoming")?"selected":"":""; ?> value="upcoming">Upcoming</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">Offer Link URL</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-snowflake-o"></i>
                                        </span>
                                        <input type="text" name="o_link" placeholder="Enter Offer Banner Link" class="form-control" value="<?php echo ($edit) ? $edit['o_link'] : '' ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">Images</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-camera"></i>
                                        </span>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12 control-label">
                                            <label class="control-label">Offer - Is Display (0 - Off, 1 - On)</label>
                                            <div class="input-group">
                                                <label class="radio-inline">
                                                    <input type="radio" name="d_other_isDisplay" value="0" <?php echo ($edit) ? $edit['d_other_isDisplay']==0?"checked":"":'checked' ?>>Off
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="d_other_isDisplay" value="1" <?php echo ($edit) ? $edit['d_other_isDisplay']==1?"checked":"":'' ?>>On
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12 control-label">
                                            <label class="control-label">Offer - Forcefully Display (0 - Off, 1 - On)</label>
                                            <div class="input-group">
                                                <label class="radio-inline">
                                                    <input type="radio" name="d_other_forcefully" value="0" <?php echo ($edit) ? $edit['d_other_forcefully']==0?"checked":"":'checked' ?>>Off
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="d_other_forcefully" value="1" <?php echo ($edit) ? $edit['d_other_forcefully']==1?"checked":"":'' ?>>On
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="img-box">
                                    <?php if($edit!=null && $edit['image']!=""){ ?>
                                    <a href="javascript:void(0)" id="<?php echo ($edit) ? $edit['did']:""; ?>" onclick="deleterecord(this.id,'/application/deleteDailogImage');">
                                        <img class="img-display" src="<?php echo ($edit) ? base_url("media/dailog/").$edit['image']:base_url("media/dailog/picture-icon.jpg");?>" width="80px">
                                        <i class="close-button">X</i>
                                    </a>
                                    <?php }?>
                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-8">
                                <p><b>Note:</b>App Maintanance</p>
                                <p>Select Banner Type - Today / Click </p>
                                <p>App Maintanance - Offer - Forcefully Display -On and Select Banner type - Today</p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary"><?php echo empty($edit) ? 'Save' : 'Update'; ?></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </section>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a>
                        &nbsp;Application List (<?php echo count($list); ?>)</h2>
                    <span class="listname" style="display: none;">Application List/0,1,2,3/0,1,2,3</span>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped  datatable-tabletools">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="15%">App Name</th>
                                    <th width="20%">Package</th>
                                    <th width="10%">Unite</th>
                                    <th width="5%">Click</th>
                                    <th width="5%">Mode</th>
                                    <th width="5%">Platform</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($list as $key) { ?>
                                <tr id="<?php echo $key['app_id']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $key['app_name']; ?></td>
                                    <td><?php echo $key['app_package_name']; ?></td>
                                    <td><?php echo $key['totalUnite']; ?></td>
                                    <td><?php echo $key['adclick']; ?>
                                    <td>
                                        <?php if($key['mode']==1){ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn btn-success" data-toggle="tooltip" title="Live">
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <?php }else{ echo "Test"; }?>
                                    </td>

                                    <td>
                                        <?php if($key['status'] == 0){ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn btn-light" data-toggle="tooltip" title="Off">
                                                <i class="fa fa-power-off"></i>
                                            </button>
                                        </a>
                                        <?php }else if($key['status'] == 1){ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Google">
                                                <i class="fa fa-google"></i>
                                            </button>
                                        </a>
                                        <?php }else{ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </button>
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo ADMIN_URL . 'application/view/' . $key['app_id']; ?>">
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>

                                            <a href="<?php echo ADMIN_URL . 'application/edit/' . $key['app_id']; ?>">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </a>

                                            <!-- <a href="javascript:void(0)" id="<?php echo $key['app_id']; ?>" onclick="deleterecord(this.id,'/application/deleteApplication');">
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </a> -->
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
