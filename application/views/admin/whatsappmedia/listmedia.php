<section role="main" class="content-body">
    <header class="page-header">
        <h2>WhatsApp Media List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">WhatsApp Media List</span></li>
            </ol>
            <span class="listname" style="display: none;">WhatsApp Media List/0,1,2/0,1,2</span>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Media
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="whatsappmedia">
                               
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">Title</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="text" name="title" placeholder="Enter Title" class="form-control" />
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
                                
                                <div class="col-md-12 svbut">
                                    <button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-9 col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;WhatsApp Media List (<?php echo count($list); ?>)
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Photo</th>
                                    <th>URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $key) { ?>
                                <tr id="<?php echo $key['wmid']; ?>">
                                    <td><?php echo $key['wmid'] ?></td>
                                    <td><?php echo $key['title'] ?></td>
                                    <td>
                                        <?php if ($key['image']) { ?>
                                            <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/whatsappmedia/<?php echo $key['image']; ?>">
                                                <img class="img-responsive" src="<?php echo base_url(); ?>media/whatsappmedia/<?php echo $key['image']; ?>" width="100px">
                                            </a>
                                        <?php } ?>
                                    </td>
                                  
                                    <td> <?php echo base_url("media/whatsappmedia/").$key['image']; ?></td>

                                    <td>
                                        <a href="javascript:void(0)" id="<?php echo $key['wmid']; ?>" onclick="deleterecord(this.id,'whatsappmedia/deletemediasingle');">
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
