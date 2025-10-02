<section role="main" class="content-body">
    <header class="page-header">
        <h2>Slider List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Slider List</span></li>
            </ol>
            <span class="listname" style="display: none;">Slider List/0,1,2,3,4/0,2,3,4</span>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>

                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Slider
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="Slideradd">
                            <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['sid'] : ""; ?>" />
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label class="control-label">Category Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="text" name="cat_title" placeholder="Category Name" class="form-control" value="<?php echo ($edit) ? $edit['cat_title'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">MID</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="text" name="mid" placeholder="Enter MID" class="form-control" value="<?php echo ($edit) ? $edit['mid'] : ""; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">Festival Date</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="festivalDate" id="festivalDate" class="form-control" value="<?php echo ($edit) ? date('Y-m-d',strtotime($edit['festivalDate'])) : ""; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">Sequence</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="number" id="sort" name="sort" placeholder="Sequence" class="form-control" value="<?php echo ($edit) ? $edit['sort'] : ""; ?>" />
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">

                                <div class="col-md-6">
                                    <label class="control-label">Sub (""-Not click, 0-All image list, 1-Sub category list, 2-Plan Details page, 3-Other Url redirect)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-paint-brush"></i>
                                        </span>
                                        <input type="text" name="sub" placeholder="Enter sub" class="form-control" value="<?php echo ($edit) ? $edit['sub'] : "0"; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Url (sub = 3 hoy to url ma link apvi)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-paint-brush"></i>
                                        </span>
                                        <input type="text" name="url" placeholder="Enter Url" class="form-control" value="<?php echo ($edit) ? $edit['url'] : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="col-md-6">
                                    <label class="control-label">Images</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-image"></i>
                                        </span>
                                        <input type="file" name="image" class="form-control" />
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
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Active Slider List (<?php echo count($Activelist); ?>)
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>MID</th>
                                    <th>Sub</th>
                                    <th width="50px">URL</th>
                                    <th>Status</th>
                                    <th>Seq</th>
                                    <th>Festival Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Activelist as $key) { ?>
                                <tr id="<?php echo $key['sid']; ?>">
                                    <td><?php echo $key['sid'] ?></td>
                                    <td>
                                        <?php if ($key['image']) { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/slider/<?php echo $key['image']; ?>">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/slider/<?php echo $key['image']; ?>" width="100px">
                                        </a>
                                        <?php } else { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/Admin.png">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/Admin.png" width="100px"></a>
                                        <!-- <img src="<?php echo base_url(); ?>media/Admin.png"  alt="" class="heim" > -->
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $key['cat_title']; ?></td>
                                    <td><?php echo $key['mid']; ?></td>
                                    <td><?php echo $key['sub']; ?></td>
                                    <td width="50px"><?php echo $key['url']; ?></td>
                                    <td>
                                        <input type="hidden" id="sh_<?php echo $key['sid']; ?>" value="<?php echo $key['status']; ?>" />
                                        <?php
                                            $status = $key['status'] == 1 ? 'checked=""' : '';
                                            ?>
                                        <div class="switch switch-sm switch-success" onclick="sliderStatusUpdate(<?php echo $key['sid'] ?>)">
                                            <input value="<?php echo $key['status']; ?>" type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div>

                                    </td>
                                    <td> <?php echo $key['sort']; ?> </td>
                                    <td> <?php echo $key['festivalDate'] ? date('d/m/Y', strtotime($key['festivalDate'])) : ''; ?> </td>

                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'slider/sliderEdit/' . $key['sid']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button></a>

                                        <a href="javascript:void(0)" id="<?php echo $key['sid']; ?>" onclick="deleterecord(this.id,'/slider/deleteSlider');"><button type="button"
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
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Deactive Slider List (<?php echo count($list); ?>)
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>MID</th>
                                    <th>Sub</th>
                                    <th width="50px">URL</th>
                                    <th>Status</th>
                                    <th>Seq</th>
                                    <th>Festival Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $key) { ?>
                                <tr id="<?php echo $key['sid']; ?>">
                                    <td><?php echo $key['sid'] ?></td>
                                    <td>
                                        <?php if ($key['image']) { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/slider/<?php echo $key['image']; ?>">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/slider/<?php echo $key['image']; ?>" width="100px">
                                        </a>
                                        <?php } else { ?>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/Admin.png">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/Admin.png" width="100px"></a>
                                        <!-- <img src="<?php echo base_url(); ?>media/Admin.png"  alt="" class="heim" > -->
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $key['cat_title']; ?></td>
                                    <td><?php echo $key['mid']; ?></td>
                                    <td><?php echo $key['sub']; ?></td>
                                    <td width="50px"><?php echo $key['url']; ?></td>
                                    <td>
                                        <input type="hidden" id="sh_<?php echo $key['sid']; ?>" value="<?php echo $key['status']; ?>" />
                                        <?php
                                            $status = $key['status'] == 1 ? 'checked=""' : '';
                                            ?>
                                        <div class="switch switch-sm switch-success" onclick="sliderStatusUpdate(<?php echo $key['sid'] ?>)">
                                            <input value="<?php echo $key['status']; ?>" type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div>

                                    </td>
                                    <td> <?php echo $key['sort']; ?> </td>
                                    <td> <?php echo $key['festivalDate'] ? date('d/m/Y', strtotime($key['festivalDate'])) : ''; ?> </td>

                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'slider/sliderEdit/' . $key['sid']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button></a>

                                        <a href="javascript:void(0)" id="<?php echo $key['sid']; ?>" onclick="deleterecord(this.id,'/slider/deleteSlider');"><button type="button"
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
