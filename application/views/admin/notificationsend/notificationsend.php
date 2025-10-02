<section role="main" class="content-body">
    <header class="page-header">
        <h2>App Notification</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>App Notification</span></li>
            </ol>
            <span class="listname" style="display: none;">Notification Send List/0,1,2,3/0,1,2,3</span>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Notification Send List </h2>
                </header>
                <div class="panel-body">
                    <div class="row">

                    </div>
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="app_notification">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <p>1). cat_10 - go to category 10 id par page</p>
                                    <p>2). plan_0 - go to plan page</p>
                                </div>
                                <div class="col-md-6">
                                    <p>3). update_0 - go to play store</p>
                                    <!-- <p>4). today_0 - go to today special page</p> -->
                                    <p>4). general_0 - go to main page</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Topic Or Token ?</label>
                                        <div class="input-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="topictoken" value="0">Topic
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="topictoken" checked value="1">Token
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Save Or Not ?</label>
                                        <div class="input-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="savenote" value="0">No
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="savenote" checked value="1">Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Image send or not ?</label>
                                        <div class="input-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="imgsend" value="0">No
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="imgsend" checked value="1">Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12 control-label">
                                    <label class="control-label">User Filter </label>
                                    <select name="userFilter" id="userFilter" class="form-control">
                                        <option value="">-- Select User Filter --</option>
                                        <option value="1">New User</option>
                                        <option value="2">Total Package Paid User</option>
                                        <option value="6">Total Package Expried User</option>
                                        <option value="3">Trial Plan Active User</option>
                                        <option value="5">Trial Plan Expried User</option>
                                        <option value="4">Without Logo</option>
                                        <option value="8">Total Free User</option>
                                        <option value="7">My Testing Device - Sandip</option>
                                    </select>
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12 control-label">
                                    <label class="control-label">Select Category: </label>
                                    <select name="category_data" id="category_data" class="category form-control">
                                        <option value="">-- Select Category --</option>
                                        <?php  foreach ($cats as $cat) { 
                                            $festi_date = ($cat['event_date'] != "0000-00-00") ? ' || ' . date('d/m/Y', strtotime($cat['event_date'])) : '';
                                        ?>
                                        <option <?php //echo $selected_type; ?> value="<?php echo $cat['mid']; ?>"><?php echo $cat['mtitle'].'' . $festi_date;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 control-label">
                                    <label class="control-label">Title<span class="rerq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-list"></i>
                                        </span>
                                        <input type="text" id="title" name="title" data-plugin-masked-input data-input-mask="999" placeholder="Title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 control-label">
                                    <label class="control-label">Message<span class="rerq">*</span>
                                    </label>
                                    <div class="">
                                        <textarea name="message" id="message" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12 control-label">
                                            <label class="control-label">URL<span class="rerq">*</span> (cat_categoryID / plan_0 / update_0 / general_0)</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-list"></i>
                                                </span>
                                                <input type="text" id="url" name="url" data-plugin-masked-input data-input-mask="999" placeholder="Enter ID" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 control-label">
                                            <label class="control-label">Notification Banner (900 X 400)</label>
                                            <div class="input-group">
                                                <input type="file" name="image" id="upfile" class="form-control" accept="image/*">
                                                <label for="upfile" id="apupl"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"><br />
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </section>
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>

                    <h2 class="panel-title">App Notification List (<?php count($notification); ?>)</h2>
                    <span class="listname" style="display: none;">Slider List/0,1,2,3,4/0,1,2,3,4</span>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="10%">Image</th>
                                    <th width="20%">Title</th>
                                    <th>Message</th>
                                    <th>URL</th>
                                    <th width="5%">Created</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notification as $key => $value) { ?>

                                <tr id="<?php echo $value['id']; ?>">
                                    <td><?php echo $value['id']; ?></td>
                                    <td>
                                        <?php if ($value['image'] != "") { ?>
                                        <a target="_blank" href="<?php echo base_url('media/notification/').$value['image']; ?>">
                                            <img src="<?php echo base_url("media/notification/") . $value['image']; ?>" width="120px" height="60px">
                                        </a>
                                        <?php } else {
                                                echo "No Img";
                                            } ?>
                                    </td>
                                    <td><?php echo $value['title']; ?></td>
                                    <td><?php echo $value['message']; ?></td>
                                    <td><?php echo $value['url']; ?></td>
                                    <td><?php echo date("d/m/Y H:i", strtotime($value['created_date'])); ?></td>
                                    <td>
                                        <a href="javascript:void(0)" id="<?php echo $value['id']; ?>" onclick="deleterecord(this.id,'/notificationsend/deletenotification');"><button type="button"
                                                class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">

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
            </section>
            <!-- end: page -->
        </div>
    </div>
</section>
