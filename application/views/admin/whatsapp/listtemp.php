<section role="main" class="content-body">
    <header class="page-header">
        <h2>WhatsApp Template List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">WhatsApp Template List</span></li>
            </ol>
            <span class="listname" style="display: none;">Slider List/0,1,2,3,4/0,2,3,4</span>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>

                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Tamplet</h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="WhatsTempAdd">
                            <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['wtemp_id'] : ""; ?>" />
                                <div class="col-xs-12 col-md-6">
                                    <div class="col-md-6 col-xs-12">
                                        <label class="control-label">Template Title</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter Template Title" name="tamp_name" value="<?php echo ($edit) ? $edit['tamp_name'] : ""; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label class="control-label">Template Name</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter Template ID" name="template" value="<?php echo ($edit) ? $edit['template'] : ""; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <label class="control-label">Type</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <select class="form-control" name="type">
                                                <option value="Utility" <?php echo ($edit) ? ($edit['type']=='Utility')?"selected":"" : ""; ?>>Utility</option>
                                                <option value="Marketing" <?php echo ($edit) ? ($edit['type']=='Marketing')?"selected":"" : ""; ?>>Marketing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <label class="control-label">Total Parameters</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter Total Parameters" name="param" value="<?php echo ($edit) ? $edit['param'] : ""; ?>" />
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-3 col-xs-12">
                                        <label class="control-label">Language</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-language"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter Language" name="lang" value="<?php echo ($edit) ? $edit['lang'] : ""; ?>" />
                                        </div>
                                    </div> -->
                                    <div class="col-md-3 col-xs-12">
                                        <label class="control-label">Language</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-language"></i>
                                            </span>
                                            <select class="form-control" name="lang">
                                                <option value="en" <?php echo ($edit) ? ($edit['lang']=='en')?"selected":"" : ""; ?>>English</option>
                                                <option value="hi" <?php echo ($edit) ? ($edit['lang']=='hi')?"selected":"" : ""; ?>>Hindi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <label class="control-label">Sort</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-sort"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter sorting number" name="sort" value="<?php echo ($edit) ? $edit['sort'] : ""; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <label class="control-label">Media URL</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-picture-o"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter Media URL" name="media" value="<?php echo ($edit) ? $edit['media'] : ""; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="col-md-12 col-xs-12">
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
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="col-md-12 col-xs-12">
                                            <label class="control-label">Bulk Camping Listing</label>
                                            <?php
                                            if ($edit) {
                                                $bulk_status = $edit['bulk_status'] == 1 ? 'checked=""' : '';
                                            } else {
                                                $bulk_status = 'checked=""';
                                            }
                                            ?>
                                            <div class="switch switch-sm switch-success">
                                                <input type="checkbox" <?php echo $bulk_status; ?> name="bulk_status" value="1" data-plugin-ios-switch />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">    
                                    <div class="col-md-12 col-xs-12">
                                        <label class="control-label">Note</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa pencil-square"></i>
                                            </span>
                                            <textarea rows="7" name="note" placeholder="Enter Note" class="form-control"><?php echo ($edit) ? $edit['note'] : ""; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-12 col-xs-12 svbut">
                                            <button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>

                                
                                
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12 col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;WhatsApp Template List (<?php echo count($list); ?>)
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Preview</th>
                                    <th>Template</th>
                                    <th>Media</th>
                                    <th>Note</th>
                                    <th>Created</th>
                                    <th>Sort</th>
                                    <th>Status</th>
                                    <th>Bulk Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $key) {?>
                                <tr id="<?php echo $key['wtemp_id']; ?>">
                                    <td><?php echo $key['wtemp_id'] ?></td>
                                    <td>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo base_url(); ?>media/whatsappTemp/<?php echo $key['template']; ?>.png">
                                            <img class="img-responsive" src="<?php echo base_url(); ?>media/whatsappTemp/<?php echo $key['template']; ?>.png" width="100px">
                                        </a>
                                    </td>
                                    <td>
                                        <?php 
                                            echo "<b>Title: ".$key['tamp_name']."</b>";
                                            echo "</br>"; 
                                            echo "<b>Name:</b> ".$key['template'];
                                            echo "</br>";
                                            echo "<b>Type:</b> ".$key['type']; 
                                            echo "</br>";
                                            echo "<b>Language:</b> ".$key['lang']; 
                                            echo "</br>";
                                            echo "<b>Parameter:</b> ".$key['param']; 
                                        ?>
                                    </td>
                                    <td>
                                        <a class="image-popup-no-margins abc" target="_blank" href="<?php echo $key['media']; ?>">
                                            <img class="img-responsive" src="<?php echo $key['media']; ?>" width="100px">
                                        </a>
                                        <span class="mobilecopy" onclick="copyToClipboard('<?php echo $key['media']; ?>')">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Copy">
                                                <i class="fa fa-clone"></i>
                                            </button>
                                        </span>
                                    </td>
                                    <td><?php echo $key['note']; ?></td>
                                    <td><?php echo $key['created_at']; ?></td>
                                    <td><?php echo $key['sort']; ?></td>
                                    <td>
                                        <?php $status = $key['status'] == 1 ? 'checked=""' : '';?>
                                        <div class="switch switch-sm switch-success">
                                            <input type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div>
                                    </td>
                                    <td>
                                        <?php $bulk_status_ = $key['bulk_status'] == 1 ? 'checked=""' : '';?>
                                        <div class="switch switch-sm switch-success">
                                            <input type="checkbox" <?php echo $bulk_status_; ?> data-plugin-ios-switch />
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'whatsapptemp/tempEdit/' . $key['wtemp_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </a>

                                        <a href="javascript:void(0)" id="<?php echo $key['wtemp_id']; ?>" onclick="deleterecord(this.id,'whatsapptemp/deletetemp');">
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
<script>
    function copy1(url)
    {
        try{
            alert(url);
            //url.select();
            document.execCommand('copy');
        }catch(e){
            alert(e);
        }
    }
</script>