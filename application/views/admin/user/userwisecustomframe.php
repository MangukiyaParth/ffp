<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Custom Frame</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">User Custom Frame</span></li>
            </ol>
            <span class="listname" style="display: none;">User Custom Frame/0,1,2,3,4/0,2,3,4</span>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
<?php $user_id = $this->uri->segment(4);?>
    <!-- start: page -->
    <div class="row">
        <div class="col-xs-4">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>

                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Custom Frames</h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="UserFrameCustomAdd">
                            <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['cframeid'] : ""; ?>" />
                            <input type="hidden" name="user_id" class="user_id" value="<?php echo $user_id; ?>" />
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
                                    <label class="control-label">Images</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-image"></i>
                                        </span>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;User Custom Frame List (<?php echo count($viewCustomFrame); ?>)
                        <a href="<?php echo ADMIN_URL . 'users/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> 
                            <span> &nbsp;Back</span>
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
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($viewCustomFrame as $key) {?>
                                <tr id="<?php echo $key['cframeid']; ?>">
                                    <td><?php echo $key['cframeid'] ?></td>
                                    <td>
                                        <?php if ($key['image']) { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/frames/custom/<?php echo $key['image']; ?>">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/frames/custom/<?php echo $key['image']; ?>" width="100px">
                                        </a>
                                        <?php } else { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/Admin.png">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/Admin.png" width="100px"></a>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $key['frame_name']; ?></td>
                                    <td>
                                        <?php
										$status = $key['status'] == 1 ? 'checked=""' : '';
									?>
                                        <div class="switch switch-sm switch-success">
                                            <input type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div>

                                    </td>
                                    
                                    <td>
                                        <?php echo ($key['created_at']!="0000-00-00 00:00:00")?date("d/m/Y H:i",strtotime($key['created_at'])):"";?>
                                    </td>
                                    <td>
                                        <?php echo ($key['updated_at']!="0000-00-00 00:00:00")?date("d/m/Y H:i",strtotime($key['updated_at'])):"";?>
                                    </td>
                                    <td>
                                        <a href='<?php echo ADMIN_URL . "users/viewusers/".$user_id."/" . $key["cframeid"]; ?>'>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button></a>

                                        <a href="javascript:void(0)" id="<?php echo $key['cframeid']; ?>" onclick="deleterecord(this.id,'/users/deleteUserCustomFrame');"><button type="button"
                                                class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
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
