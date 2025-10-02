<section role="main" class="content-body pb-none">
    <header class="page-header">
        <h2>Add Photo</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Add Photo</span></li>
            </ol>
            <span class="listname" style="display: none;">Photo List/0,1,2,3,4/0,2,3,4</span>

            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>

                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Add Photo
                        <a href="<?php echo ADMIN_URL . 'photo/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> <span> &nbsp;Photo
                                List</span></a>
                    </h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" method="post" id="addphotoAdd" enctype="multipart/form-data" action="javascript:void(0);">
                        <input type="hidden" value="<?php echo ($edit) ? $edit['photo_id'] : ""; ?>" name="id">
                        <fieldset>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12" for="category"><strong>Photo Category : <font color="red">*</font></strong></label>
                                        <div class="col-md-12">
                                            <select class="form-control" required name="pcat_id">
                                                <option value="">-- Select Category --</option>
                                                <?php if ($list) {
													foreach ($list as $l) {
														$selected_id = "";
														if (($edit)) {
															if ($edit['pcat_id'] == $l['pcat_id']) {
																$selected_id = "selected";
															}
														} ?>
                                                <option <?php echo $selected_id; ?> value="<?php echo $l['pcat_id']; ?>"><?php echo $l['pcat_title']; ?></option>
                                                <?php  }
												} ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12" for="image"><strong>Image : <font color="red">*</font></strong> (Maximum Upload - 20)</label>
                                        <div class="col-md-12">
                                            <input type="file" <?php echo ($edit) ? '' : 'required' ?> class="form-control" name="image[]" accept="image/*" multiple="multiple">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <?php if ($edit) { ?>
                                    <a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/photo/<?php echo $edit['photo']; ?>">
                                        <img class="img-responsive" src="<?php echo base_url(); ?>media/photo/<?php echo $edit['photo']; ?>" style="width: 80% !important;height: 80% !important;">
                                    </a>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary right">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="col-md-12">
                        <div class="col-md-4">

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
