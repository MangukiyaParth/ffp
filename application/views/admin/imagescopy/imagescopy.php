<section role="main" class="content-body">
    <header class="page-header">
        <h2>Images Copy With Zip Download</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Images Copy With Zip Download</span></li>
            </ol>
            <span class="listname" style="display: none;">Images Copy With Zip Download/0,1,2,3,4/0,2,3,4</span>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-xs-6">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Images Copy With Zip Download
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url("admin/ImagesCopy/copyToPlanFolderWithIdName");?>">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <label class="control-label">Category</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-image"></i>
                                        </span>
                                        <select name="cat_id" required class="category form-control">
                                            <option value="" selected>--Select Category --</option>
                                            <option value="all">All</option>
                                            <?php foreach($categoryList as $category){?>
                                            <option value="<?php echo $category['mid']."-_-".$category['mslug']?>"><?php echo $category['mtitle']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 svbut">
                                    <button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary">Ok</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-xs-6">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Plan Images Upload
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="<?php echo base_url("admin/ImagesCopy/planImagesBulkUpload");?>">
                            <div class="col-md-12">
                                <label class="control-label">Category</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </span>
                                    <select name="cat_slug" required class="category form-control">
                                        <option value="" selected>--Select Category --</option>
                                        <?php foreach($categoryList as $category){?>
                                        <option value="<?php echo $category['mslug']?>"><?php echo $category['mtitle']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12" for="image"><strong>Images : <font color="red">*</font></strong> </label>
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" name="image[]" accept="image/*|video/*" multiple="multiple">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9">
                                    <p><?php echo $this->session->flashdata('totalUploadImg');?></p>
                            </div>
                            <div class="col-md-3">
                                <div class="col-md-2 svbut" style="float: right;">
                                    <button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

    </div>
    <!-- end: page -->

    
</section>
