<section role="main" class="content-body pb-none">
    <header class="page-header">
        <h2>Add Videogif</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Add Videogif</span></li>
            </ol>
            <span class="listname" style="display: none;">Usaer List/0,1,2,3,4/0,2,3,4</span>

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

                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Add Videogif
                        <a href="<?php echo ADMIN_URL . 'videogif/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> <span> &nbsp;Videogif
                                List</span></a>
                    </h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" method="post" id="addVideogifAdd" enctype="multipart/form-data" action="javascript:void(0);">
                        <!-- id="addVideogif" -->
                        <!-- <?php //echo base_url("admin/Videogif/isertVideogif"); ?> -->
                        <input type="hidden" value="<?php echo ($edit) ? $edit['v_id'] : ""; ?>" name="id">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12" for="mid"><strong>Select Category: <font color="red">*</font></strong></label>
                                            <div class="col-md-12">
                                                <select name="mid" required id="mid" class="category form-control">
                                                    <option value="none">-- Select Category --</option>
                                                    <?php if ($cats) {
														foreach ($cats as $cat) {
															$selected_type = "";
															$festi_date = ($cat['event_date'] != "0000-00-00") ? ' || ' . date('d/m/Y', strtotime($cat['event_date'])) : '';
															if (($edit)) {
																if ($edit['mid'] == $cat['mid']) {
																	$selected_type = "selected";
																}
															} ?>
                                                    <option <?php echo $selected_type; ?> value="<?php echo $cat['mid']; ?>"><?php echo $cat['mtitle'] . '' . $festi_date; ?>
                                                    </option>
                                                    <?php }
													} else {
														echo '<option value="none">Select Category</option>';
													}
													?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Tamplate Type (0-Gif, 1-Video)</label>
                                                <div class="input-group">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="type" value="0" <?php echo ($edit) ? $edit['type']==0?"checked":"":'' ?>>GIF
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="type" value="1" <?php echo ($edit) ? $edit['type']==1?"checked":"":'checked' ?>>Video
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Paid / Free (0-Free, 1-Paid)</label>
                                                <div class="input-group">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="free_paid" value="0" <?php echo ($edit) ? $edit['free_paid']==0?"checked":"":'' ?>>Free
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="free_paid" value="1" <?php echo ($edit) ? $edit['free_paid']==1?"checked":"":'checked' ?>>Paid
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12" for="image"><strong>Image : <font color="red">*</font></strong> </label>
                                            <div class="col-md-12">
                                                <input type="file" <?php echo ($edit) ? '' : 'required' ?> class="form-control" name="image[]" accept="image/*|video/*" multiple="multiple">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12" for="Lable"><strong>Lable : </label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Enter Lable" value="<?php echo ($edit) ? $edit['lable'] : ""; ?>" class="form-control" name="lable">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12" for="Lable BG"><strong>Lable BG : </label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Enter Lable BG" value="<?php echo ($edit) ? $edit['lablebg'] : ""; ?>" class="form-control" name="lablebg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Status (0-off, 1-on)</label>
                                                <div class="input-group">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" value="0" <?php echo ($edit) ? $edit['status']==0?"checked":"":'' ?>>Off
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" value="1" <?php echo ($edit) ? $edit['status']==1?"checked":"":'checked' ?>>On
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                </div>


                <hr>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <?php if ($edit) { 
                        if($edit['type']=='0'){
                    ?>
                        <a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/videogif/<?php echo $edit['path']; ?>">
                            <img class="img-responsive" src="<?php echo base_url(); ?>media/videogif/<?php echo $edit['path']; ?>" style="width: 80% !important;height: 80% !important;">
                        </a>
                        <?php 
                        }else{
                    ?>
                        <video width="400" controls>
                            <source src="<?php echo base_url(); ?>media/videogif/<?php echo $edit['path']; ?>" type="video/mp4">
                        </video>
                        <?php        
                        } 
                    } 
                    ?>
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
