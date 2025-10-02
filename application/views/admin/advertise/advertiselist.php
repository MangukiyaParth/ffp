<section role="main" class="content-body">
    <header class="page-header">
        <h2>Advertise</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Advertise</span></li>

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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp; Advertise Page
                        <a href="<?php echo ADMIN_URL . 'application/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-List" aria-hidden="true"></i> <span>
                                &nbsp;Application List</span></a>
                    </h2>

                </header>
                <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="addAdvertise">
                    <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['a_id'] : '' ?>">
                    <input type="hidden" name="returnUrl" value="<?php echo ($edit) ? $this->agent->referrer():""; ?>" class="returnUrl">
                    <div class="panel-body">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="control-label">Select Application<span class="rerq">*</span></label>
                                                <div class="input-group">
                                                    <select tabindex="1" data-plugin-selectTwo class="form-control" name="application" required>
                                                        <option value="">-- Select Application --</option>
                                                        <?php foreach ($data['app_list'] as $app) { ?>
                                                        <option <?php echo !empty($edit) ? ($edit['app_id'] == $app['app_id'] ? 'selected' : '') : ''; ?> value="<?php echo $app['app_id'] ?>">
                                                            <?php echo $app['app_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <input type="hidden" value="1" name="ads_type"> -->
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="control-label">Select Ads Type<span class="rerq">*</span></label>
                                                <div class="input-group">
                                                    <select tabindex="2" data-plugin-selectTwo class="form-control" name="ads_type">
                                                        <option <?php //echo !empty($edit) ? ($edit['ads_type'] == '1' ? 'selected' : '') : ''; ?> value="1">AdsMob</option>
                                                        <option <?php //echo !empty($edit) ? ($edit['ads_type'] == '2' ? 'selected' : '') : ''; ?> value="2">Facebook</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Select Ads Type (1-Admob, 2- Facebook)</label>
                                                <div class="input-group">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ads_type" value="1" <?php echo ($edit) ? $edit['ads_type']==1?"checked":"":'checked' ?>>AdMob
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ads_type" value="2" <?php echo ($edit) ? $edit['ads_type']==2?"checked":"":'' ?>>Facebook
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="control-label">Advertise Title <span class="rerq">*</span></label>
                                                <input type="text" name="title" class="form-control" placeholder="Enter Ads Title" value="<?php echo ($edit) ? $edit['ads_title'] : '' ?>">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="control-label">Advertise ID </label>
                                                <!-- <textarea name="advertise" class="form-control" rows="5"><?php echo ($edit) ? $edit['ads_id'] : '' ?></textarea> -->
                                                <input type="text" name="advertise" placeholder="Enter Placement ID" class="form-control abc" value="<?php echo ($edit) ? $edit['ads_id'] : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label" for="textareaDefault">Status</label>
                                                <?php /*
                                                if ($edit) {
                                                    $status = $edit['status'] == 1 ? 'checked=""' : '';
                                                } else {
                                                    $status = 'checked=""';
                                                } */
                                                ?>
                                                <div class="switch switch-sm switch-success">
                                                    <input type="checkbox" <?php //echo $status; 
                                                                            ?> name="status" value="1"
                                                        data-plugin-ios-switch />
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                <div class="col-md-12"><br />
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary"><?php echo empty($edit) ? 'Save' : 'Update'; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <div class="col-md-12">
            <div class="" style="float: right;">
                <div class="control-label">
                    <label class="control-label">Select Application</label>
                    <select tabindex="1" data-plugin-selectTwo class="col-md-4 form-control" id="application" name="application" required>
                        <option value="">-- Select Application --</option>
                        <?php foreach ($data['app_list'] as $app) { ?>
                        <option value="<?php echo $app['app_name'] ?>"><?php echo $app['app_name']; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                </div>
                <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Advertise List (<?php echo count($list); ?>)</h2>
                <!-- <span class="listname" style="display: none;">Advertise List/0,1,2,3,4/0,1,2,3,4</span> -->

            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped  datatable-tabletools">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">Type</th>
                                <th width="35%">App</th>
                                <th width="20%">Title</th>
                                <th width="30%">Ads ID</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                                foreach ($list as $key) { ?>
                            <tr id="<?php echo $key['a_id']; ?>">
                                <td><?php echo $key['a_id']; ?></td>
                                <td width="10%"><?php echo ($key['ads_type'] == '1') ? 'Adsmob' : 'Facebook'; ?></td>
                                <td><?php echo $key['app_name']; ?></td>
                                <td><?php echo $key['ads_title']; ?></td>
                                <td><?php echo $key['ads_id']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo ADMIN_URL . 'MyUnit/edit/' . $key['a_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button></a>

                                        <a href="javascript:void(0)" id="<?php echo $key['a_id']; ?>" onclick="deleterecord(this.id,'/MyUnit/deleteAdvertise');"><button type="button"
                                                class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </a>
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
