<section role="main" class="content-body">
    <header class="page-header">
        <h2>Home Category</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Home Category</span></li>
            </ol>
            <span class="listname" style="display: none;">Home Category</span>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Home Category
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">

                        <?php if ($this->session->flashdata('success')) { ?>

                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong><?php echo $this->session->flashdata('success'); ?></strong>
                        </div>

                        <?php } ?>

                        <?php if ($this->session->flashdata('error')) { ?>

                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong><?php echo $this->session->flashdata('error'); ?></strong>
                        </div>

                        <?php } ?>

                        <?php 
                            $url = 'admin/homeCategory/addCategory';
                            if($edit && $edit['id']){
                                $url = 'admin/homeCategory/addCategory/'.$edit['id'];
                            }
                        ?>
                        <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url($url);?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Category</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-image"></i>
                                        </span>
                                        <select name="category_id" required class="category form-control">
                                            <option value="" selected>--Select Category --</option>
                                            <?php foreach($categoryList as $category){

                                            $selected = '';
                                            if($edit && $category['mid'] == $edit['category_id']){
                                                $selected = 'selected';
                                            }
                                            
                                            ?>
                                            <option value="<?php echo $category['mid']?>" <?php echo $selected; ?>><?php echo $category['mtitle']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">Title</label>
                                    <input type="text" id="title" value="<?php echo $edit ? $edit['title'] : '' ?>" name="title" class="form-control" />
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label">Sequence</label>
                                    <input type="number" min="1" name="sequence" value="<?php echo $edit ? $edit['sequence'] : '' ?>" required class="form-control" />

                                </div>
                            </div>

                            <div class="row mt-lg">

                                <div class="col-md-2">
                                    <?php
                                    $status = '';
                                    $statusValue = 0;
                                    if($edit && $edit['status']){
                                        $status = 'checked=""';
                                        $statusValue = 1;
                                    }

                                    if(!$edit){
                                        $status = 'checked=""';
                                        $statusValue = 1;
                                    }
										
									?>

                                    <label class="control-label">Status</label>
                                    <div class="switch switch-sm switch-success" onclick="statusUpdate('status')">
                                        <input type="checkbox" id="status" <?php echo $status; ?> value="<?php echo  $statusValue; ?>" name="status" data-plugin-ios-switch />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <?php
                                    $is_show_on_home = '';
                                    $is_show_on_homeValue = 0;
                                    if($edit && $edit['is_show_on_home']){
                                        $is_show_on_home = 'checked=""';
                                        $is_show_on_homeValue = 1;
                                    }

                                    if(!$edit){
                                        $is_show_on_home = 'checked=""';
                                        $is_show_on_homeValue = 1;
                                    }
										
									?>

                                    <label class="control-label">Show on Home </label>
                                    <div class="switch switch-sm switch-success" onclick="statusUpdate('is_show_on_home')">
                                        <input type="checkbox" id="is_show_on_home" <?php echo $is_show_on_home; ?> value="<?php echo $is_show_on_homeValue;  ?>" name="is_show_on_home"
                                            data-plugin-ios-switch />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <?php
                                    $is_new = '';
                                    $is_newValue = 0;
                                    if($edit && $edit['is_new']){
                                        $is_new = 'checked=""';
                                        $is_newValue = 1;
                                    }									
									?>
                                    <label class="control-label">New </label>
                                    <div class="switch switch-sm switch-success" onclick="statusUpdate('is_new')">
                                        <input type="checkbox" id="is_new" name="is_new" <?php echo $is_new; ?> value="<?php echo $is_newValue; ?>" data-plugin-ios-switch />
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-md-3">

                                    <button type="submit" class="mt-lg mb-xs mt-xs mr-xs btn btn-primary">Save</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <div class="row">


        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp; List Home Cateogry
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-none" id="list">
                                <!--  datatable-tabletools -->
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title </th>
                                        <th>Category Name</th>
                                        <th>Seq</th>
                                        <th>Status</th>
                                        <th>Show on Home</th>
                                        <th>New</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($list as $key) { ?>
                                    <tr id="<?php echo $key['id']; ?>">
                                        <td><?php echo $key['id'] ?></td>
                                        <td><?php echo $key['title']; ?></td>
                                        <td><?php echo $key['mtitle']; ?></td>
                                        <td><?php echo $key['sequence']; ?></td>
                                        <td>
                                            <input type="hidden" id="status_<?php echo $key['id']; ?>" value="<?php echo $key['status']; ?>" />
                                            <?php
                                            $status = $key['status'] == 1 ? 'checked=""' : '';
                                            ?>
                                            <div class="switch switch-sm switch-success" onclick="homeCategoryStatusUpdate(<?php echo $key['id']; ?>, 'status')">
                                                <input name="<?php echo 'status_'.$key['id']; ?>" value="<?php echo $key['status']; ?>" type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                            </div>
                                        </td>

                                        <td>
                                            <input type="hidden" id="is_show_on_home_<?php echo $key['id']; ?>" value="<?php echo $key['is_show_on_home']; ?>" />
                                            <?php
                                            $is_show_on_home = $key['is_show_on_home'] == 1 ? 'checked=""' : '';
                                            ?>
                                            <div class="switch switch-sm switch-success" onclick="homeCategoryStatusUpdate(<?php echo $key['id']; ?>, 'is_show_on_home')">
                                                <input name="<?php echo 'is_show_on_home_'.$key['id']; ?>" value="<?php echo $key['is_show_on_home']; ?>" type="checkbox"
                                                    <?php echo $is_show_on_home; ?> data-plugin-ios-switch />
                                            </div>
                                        </td>

                                        <td>
                                            <input type="hidden" id="is_new_<?php echo $key['id']; ?>" value="<?php echo $key['is_new']; ?>" />
                                            <?php
                                            $is_new = $key['is_new'] == 1 ? 'checked=""' : '';
                                            ?>
                                            <div class="switch switch-sm switch-success" onclick="homeCategoryStatusUpdate(<?php echo $key['id']; ?>, 'is_new')">
                                                <input name="<?php echo 'is_new_'.$key['id']; ?>" value="<?php echo $key['is_new']; ?>" type="checkbox" <?php echo $is_new; ?> data-plugin-ios-switch />
                                            </div>
                                        </td>

                                        <td>

                                            <a class="btn btn-sm btn-info" href="<?php echo ADMIN_URL . 'homeCategory/index/'.$key['id'];  ?>">
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>

                                            <a href="javascript:void(0)" id="<?php echo $key['id']; ?>" onclick="deleterecord(this.id,'homeCategory/delete');">
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </a>

                                        </td>



                                    </tr>
                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>


                    </div>
                </div>
            </section>
        </div>

    </div>


    <!-- end: page -->


</section>
