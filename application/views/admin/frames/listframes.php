<section role="main" class="content-body">
    <header class="page-header">
        <h2>Frames List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Frames List</span></li>
            </ol>
            <span class="listname" style="display: none;">Frames List/0,1,2,3,4/0,1,2,3,4</span>
            <a class="fidebar-right-toggle">&nbsp;
                <!-- <i class="fa fa-chevron-left"></i> -->
            </a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-xs-4">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Frames
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="Framesadd">
                            <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['fid'] : ""; ?>" />
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">Frame Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="text" name="frame_name" placeholder="Frame Name" class="form-control" value="<?php echo ($edit) ? $edit['frame_name'] : ""; ?>" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="control-label">Frame Code</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-paint-brush"></i>
                                        </span>
                                        <textarea rows="30" name="data" placeholder="Enter Frame Source Code" class="form-control"><?php echo ($edit) ? $edit['data'] : ""; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Logo Code</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-paint-brush"></i>
                                        </span>
                                        <textarea rows="25" name="logosection" placeholder="Enter Logo Source Code" class="form-control"><?php echo ($edit) ? $edit['logosection'] : ""; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Free / Paid</label>
                                    <?php
									if ($edit) {
										$free_paid = $edit['free_paid'] == 1 ? 'checked=""' : '';
									} else {
										$free_paid = 'checked=""';
									}
									?>
                                    <div class="switch switch-sm switch-success">
                                        <input type="checkbox" <?php echo $free_paid; ?> name="free_paid" value="1" data-plugin-ios-switch />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Status</label>
                                    <?php
									if ($edit) {
										$status = $edit['status'] == 1 ? 'checked=""' : '';
									} else {
										$status = 'checked=""';
									}
									?>
                                    <div class="switch switch-sm switch-success">
                                        <input type="checkbox" <?php echo $status; ?> name="status" value="1" data-plugin-ios-switch />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Frame Image</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-image"></i>
                                        </span>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-12 svbut">
                                    <button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary">Save</button>
                                </div>
                                <div class="col-md-12">
                                    <?php if ($edit) { ?>
                                    <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/frames/<?php echo $edit['image']; ?>">
                                        <img class="img-responsive" src="<?php echo base_url(); ?>media/frames/<?php echo $edit['image']; ?>" width="250px">
                                    </a>
                                    <?php }?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xs-8">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Frames List (<?php echo count($list); ?>)
                        <a href="<?php echo ADMIN_URL . 'frames/subframeindex/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i> <span> &nbsp;Sub Frames</span>
                        </a>
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Frame Name</th>
                                    <th>Free / Paid</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $key) {?>
                                <tr id="<?php echo $key['fid']; ?>">
                                    <td><?php echo $key['fid'] ?></td>
                                    <td>
                                        <?php if ($key['image']) { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/frames/<?php echo $key['image']; ?>">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/frames/<?php echo $key['image']; ?>" width="100px">
                                        </a>
                                        <?php } else { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/Admin.png">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/Admin.png" width="100px"></a>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $key['frame_name']; ?></td>
                                    <!-- <td><?php //echo($key['free_paid']=="1")?'Paid':'Free'; ?></td> -->
                                    <td>
                                        <?php 
                                        $status = $key['free_paid'] == 1 ? 'checked=""' : '';
                                        if ($key['free_paid'] == 1) { ?>
                                        <div class="switch switch-sm switch-success" onclick="statusFrameOnOFF(<?php echo $key['fid']; ?>,0,'free_paid')">
                                            <input type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div>
                                        <?php } else { ?>
                                        <div class="switch switch-sm switch-success" onclick="statusFrameOnOFF(<?php echo $key['fid']; ?>,1,'free_paid')">
                                            <input type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <!-- <td>
                                        <?php //$status = $key['status'] == 1 ? 'checked=""' : ''; ?>
                                        <div class="switch switch-sm switch-success">
                                            <input type="checkbox" <?php //echo $status; ?> data-plugin-ios-switch />
                                        </div>
                                    </td> -->
                                    <td>
                                        <?php 
                                        $status1 = $key['status'] == 1 ? 'checked=""' : '';
                                        if ($key['status'] == 1) { ?>
                                        <div class="switch switch-sm switch-success" onclick="statusFrameOnOFF(<?php echo $key['fid']; ?>,0,'status')">
                                            <input type="checkbox" <?php echo $status1; ?> data-plugin-ios-switch />
                                        </div>
                                        <?php } else { ?>
                                        <div class="switch switch-sm switch-success" onclick="statusFrameOnOFF(<?php echo $key['fid']; ?>,1,'status')">
                                            <input type="checkbox" <?php echo $status1; ?> data-plugin-ios-switch />
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'frames/framesEdit/' . $key['fid']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </a>
                                        <a href="javascript:void(0)" id="<?php echo $key['fid']; ?>" onclick="deleterecord(this.id,'/frames/deleteFrames');">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
