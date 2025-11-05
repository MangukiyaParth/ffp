<section role="main" class="content-body">
    <header class="page-header">
        <h2>Category</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Category </span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">

        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Category Filter </h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url('admin/category')?>">
                            <!-- filterGetData -->
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="start_date" id="start_date" value="<?php echo ($start_date !="")?$start_date:""?>" class="form-control">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="end_date" id="end_date" value="<?php echo ($end_date !="")?$end_date:""?>" class="form-control">
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="input-group" style="float: left;">
                                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">Filter</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group" style="float: left;">
                                        <a href="<?php echo ADMIN_URL . 'category' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                                            <i class="fa fa-filter" aria-hidden="true"></i> <span> &nbsp;Reset Filter</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </section>
        </div>
    </div>

    <!-- start: page -->
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Category List (<?php echo count($list); ?>)
                        <a href="<?php echo ADMIN_URL . 'category/CatAdd' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i> <span> &nbsp;Add Category</span>
                        </a>
                    </h2>
                    <span class="listname" style="display: none;">Category List/0,2,3,4/0,2,3,4</span>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped  datatable-tabletools">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="5%">Date</th>
                                    <th width="10%">Category</th>
                                    <th width="5%">Image</th>
                                    <th width="5%">Thumb</th>
                                    <th width="20%">Name</th>
                                    <th width="5%">Noti Banner</th>
                                    <th width="5%">Mask</th>
                                    <th width="10%">Quote</th>
                                    <th width="10%">Tag</th>
                                    <th width="10%">TagBG</th>
                                    <th width="5%">Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
								foreach ($list as $key) { ?>
                                <tr id="<?php echo $key['mid']; ?>">
                                    <td><?php echo $key['mid']; ?></td>
                                    <td><?php echo ($key['event_date'] != "0000-00-00") ? date("d/m/Y", strtotime($key['event_date'])) : ""; ?></td>
                                    <td><?php echo $key['cat_title']; ?></td>
                                    <td>
                                        <?php if ($key['image']) { ?>
                                        <a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/category/<?php echo $key['image']; ?>">
                                            <img class="img-responsive " width="50px" src="<?php echo base_url(); ?>media/category/<?php echo $key['image']; ?>">
                                        </a>
                                        <?php } else { ?>
                                        <a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/Admin.png">
                                            <img class="img-responsive " width="50px" src="<?php echo base_url(); ?>media/Admin.png"></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($key['image']) { ?>
                                        <a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/category/thumb/<?php echo $key['image']; ?>">
                                            <img class="img-responsive " width="50px" src="<?php echo base_url(); ?>media/category/thumb/<?php echo $key['image']; ?>">
                                        </a>
                                        <?php } else { ?>
                                        <a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/Admin.png">
                                            <img class="img-responsive " width="50px" src="<?php echo base_url(); ?>media/Admin.png"></a>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $key['mtitle']; ?></td>
                                    <td>
                                        <?php if ($key['noti_banner']) { ?>
                                        <a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/category/banner/<?php echo $key['noti_banner']; ?>">
                                            <img class="img-responsive " width="50px" src="<?php echo base_url(); ?>media/category/banner/<?php echo $key['noti_banner']; ?>">
                                        </a>
                                        <?php } else { ?>
                                        -
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($key['mask']) { ?>
                                        <a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/category/mask/<?php echo $key['mask']; ?>">
                                            <img class="img-responsive " width="50px" src="<?php echo base_url(); ?>media/category/mask/<?php echo $key['mask']; ?>">
                                        </a>
                                        <?php } else { ?>
                                        -
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $key['noti_quote']; ?></td>
                                    <td><?php echo $key['lable']; ?></td>
                                    <td><?php echo $key['lablebg']; ?></td>
                                    <td>
                                        <?php if ($key['status'] == 1) { ?>
                                        <a value="1" class="switch switch-sm switch-success<?php echo $key['mid']; ?>" name="status"
                                            onclick="statusChanged('cat_id/<?php echo $key['mid']; ?>/category/0')">
                                            <i class="pointer fa fa-toggle-on faicon" data-toggle="tooltip" title="Active"></i></a>
                                        <?php } else { ?>
                                        <a value="0" class="switch switch-sm switch-success<?php echo $key['mid']; ?>" name="status"
                                            onclick="statusChanged('cat_id/<?php echo $key['mid']; ?>/category/1')">
                                            <i class="pointer fa fa-toggle-off faicona" data-toggle="tooltip" title="Deactive"></i></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo ADMIN_URL . 'category/edit/' . $key['mid']; ?>">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button></a>

                                            <a href="javascript:void(0)" id="<?php echo $key['mid']; ?>" onclick="deleterecord(this.id,'/category/deleteCategory');"><button type="button"
                                                    class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </a>

                                            <a href="javascript:void(0)" onclick="createFolder('<?php echo $key['mslug']; ?>','/category/makedi');">
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Make Folder">
                                                    <i class="fa fa-folder"></i>
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
    </div>
    <!-- end: page -->
</section>
