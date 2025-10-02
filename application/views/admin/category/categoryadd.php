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

    <!-- start: page -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp;
                        <?php echo empty($edit) ? 'Add' : 'Edit'; ?> Main Category
                        <a href="<?php echo ADMIN_URL . 'category' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-list" aria-hidden="true"></i> <span> &nbsp;Category List</span>
                        </a>
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="addcategory">
                            <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['mid'] : ''; ?>">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Main Category<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <select class="form-control category" name="maincat">
                                                <?php foreach ($mainCat as $cat) {
                                                    $selectd = '';
                                                    if ($edit) {
                                                        if ($cat['cid'] == $edit['c_id']) {
                                                            $selectd = 'selected';
                                                        }
                                                    }
                                                ?>
                                                <option <?php echo $selectd; ?> value="<?php echo $cat['cid']; ?>"><?php echo $cat['cat_title']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="control-label">Event Date<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="date" name="event_date" class="form-control" value="<?php echo ($edit) ? $edit['event_date'] : ""; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="control-label">Name<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-cart-plus"></i>
                                            </span>
                                            <input autofocus="" type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo ($edit) ? $edit['mtitle'] : ""; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Lable</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <input autofocus="" type="text" name="lable" placeholder="Enter Lable" class="form-control" value="<?php echo ($edit) ? $edit['lable'] : ""; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="control-label">Lable BG</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-paint-brush"></i>
                                            </span>
                                            <input autofocus="" type="text" name="lablebg" placeholder="Enter Lable BG" class="form-control" value="<?php echo ($edit) ? $edit['lablebg'] : ""; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="control-label">Category Thumbnail </label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-image"></i>
                                            </span>
                                            <input type="file" name="image" class="form-control" accept="image/*" />
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Notification Quote</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-quote-right"></i>
                                            </span>
                                            <textarea rows="4" name="noti_quote" placeholder="Enter Notification Quote"
                                                class="form-control"><?php echo ($edit) ? $edit['noti_quote'] : ""; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Notification Banner </label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-image"></i>
                                            </span>
                                            <input type="file" name="noti_banner" class="form-control" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="col-md-1">
                                        <label class="control-label" for="textareaDefault">Status</label>
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
                                    <div class="col-md-3">
                                        <label class="control-label">Plan / Auto</label>
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="plan_auto" value="1" <?php echo ($edit) ? ($edit['plan_auto'] == 1)?"checked":"" : ""; ?> type="radio">
                                                <label for="awesome">Only Plan</label>
                                            </div>&nbsp;&nbsp;
                                        </div>
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="plan_auto" value="" type="radio" <?php echo ($edit) ? ($edit['plan_auto'] == null)?"checked":"" : "checked"; ?>>
                                                <label for="very-awesome">Both (Plan/Auto)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary"><?php echo empty($edit) ? 'Save' : 'Update'; ?></button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <form class="form-horizontal" id="import_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h4 class="text-center">Bulk Upload</h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-md-12 text-center">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label" for="file1"> File Upload</label>
                                                <div class="col-md-12">
                                                    <input type="file" name="file" class="form-control" id="file" <?php echo empty($edit) ? 'required' : ''; ?> accept=".xls, .xlsx">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label">&nbsp;</label>
                                                <div class="col-md-12">
                                                    <a href="<?php echo base_url("assets/upload/sample.xlsx"); ?>">
                                                        <button type="button" value="Click & Download" class="btn">Simple Download Click here...</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group text-left">
                                            <label class="col-md-12 control-label">&nbsp;</label>
                                            <div class="col-md-12">
                                                <button type="submit" name="import" class="btn btn-primary">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

    </div>
    </div>
    <!-- end: page -->
</section>
