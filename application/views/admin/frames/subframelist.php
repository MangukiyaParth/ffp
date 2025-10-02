<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sub Frames List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Sub Frames List</span></li>
            </ol>
            <span class="listname" style="display: none;">Sub Frames List/0,1,2,3/0,1,2,3</span>
            <a class="sf_idebar-right-toggle">&nbsp;<!-- <i class="fa fa-chevron-left"></i> --></a>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Sub Frames
                        

                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="SubFramesadd">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">Select Frame Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <select class="form-control" name="fid">
                                            <option value="">--Select--</option>
                                            <?php foreach ($dropDownlist as $key) {?>
                                                <option value="<?php echo $key['fid'] ?>"><?php echo $key['frame_name'] ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <label class="control-label">Frame Image</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-image"></i>
                                        </span>
                                        <input type="file" name="image[]" class="form-control" multiple/>
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

                                <div class="col-md-12 svbut">
                                    <button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary">Save</button>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Sub Frames List (<?php echo count($list); ?>)
                        <a href="<?php echo ADMIN_URL . 'frames/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i> <span> &nbsp;Main Frames</span>
                        </a>
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Frame Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $key) {?>
                                <tr id="<?php echo $key['sf_id']; ?>">
                                    <td><?php echo $key['sf_id'] ?></td>
                                    <td>
                                        <?php if ($key['image']) { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/frames/subframes/<?php echo $key['image']; ?>">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/frames/subframes/<?php echo $key['image']; ?>" width="100px">
                                        </a>
                                        <?php } else { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/Admin.png">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/Admin.png" width="100px"></a>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $key['frame_name']; ?></td>
                                    <td>
                                        <!-- <div class="switch switch-sm switch-success">
                                            <input type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div> -->
                                        
                                        <?php if($key['status'] == 1){ ?>
                                            <a value="1" class="statusche3" name="status" onclick='statusChangedd("sf_id/<?php echo $key["sf_id"]?>/sub_frames/0")'>
                                                <i class="pointer fa fa-toggle-on faicon" data-toggle="tooltip" title="Active"></i>
                                            </a>
                                        <?php }else{?>
                                            <a value="0" class="statusche3" name="status" onclick='statusChangedd("sf_id/<?php echo $key["sf_id"]?>/sub_frames/1")'>
                                                <i class="pointer fa fa-toggle-off faicon" data-toggle="tooltip" title="Deactive"></i>
                                            </a>
                                        <?php }?>

                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" id="<?php echo $key['sf_id']; ?>" onclick="deleterecord(this.id,'/frames/subDeleteFrames');">
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
