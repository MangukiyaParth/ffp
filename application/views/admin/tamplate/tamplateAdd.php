<section role="main" class="content-body pb-none">
    <header class="page-header">
        <h2>Add Tamplates</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Add Tamplates</span></li>
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

                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Add Tamplate
                        <a href="<?php echo ADMIN_URL . 'tamplate/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> <span> &nbsp;Tamplate
                                List</span></a>
                    </h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" method="post" id="addTamplateAdd" enctype="multipart/form-data" action="javascript:void(0);">
                        <!-- id="addTamplate" -->
                        <!-- <?php //echo base_url("admin/tamplate/isertTamplate"); ?> -->
                        <input type="hidden" value="<?php echo ($edit) ? $edit['tid'] : ""; ?>" name="id">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12" for="type"><strong>Type : <font color="red">*</font></strong></label>
                                            <div class="col-md-12">
                                                <!-- <input type="text" required value="<?php //echo ($edit) ? $edit['type'] : "0"; ?>" class="form-control" name="type"> -->
                                                <select class="form-control" required name="type">
                                                    <option value="">-- Select Type --</option>
                                                    <?php if ($c_type) {
														foreach ($c_type as $c_t) {
															$selected_type1 = "";
															if (($edit)) {
																if ($edit['type'] == $c_t['c_id']) {
																	$selected_type1 = "selected";
																}
															} ?>
                                                    <option <?php echo $selected_type1; ?> value="<?php echo $c_t['c_id']; ?>"><?php echo $c_t['c_title']; ?></option>
                                                    <?php  }
													} ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12" for="cat_id"><strong>Select Category: <font color="red">*</font></strong></label>
                                            <div class="col-md-12">
                                                <select name="cat_id" required id="cat_id" class="category form-control">
                                                    <option value="none">-- Select Category --</option>
                                                    <?php if ($cats) {
														foreach ($cats as $cat) {
															$selected_type = "";
															$festi_date = ($cat['event_date'] != "0000-00-00") ? ' || ' . date('d/m/Y', strtotime($cat['event_date'])) : '';
															if (($edit)) {
																if ($edit['cat_id'] == $cat['mid']) {
																	$selected_type = "selected";
																}
															} ?>
                                                    <option <?php echo $selected_type; ?> value="<?php echo $cat['mid'].'_'.$cat['event_date']; ?>"><?php echo $cat['mtitle'] . '' . $festi_date; ?>
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
                                            <label class="col-md-12"><strong>Event Date:</strong></label>
                                            <div class="col-md-12">
                                                <input type="date" name="t_event_date" class="t_event_date form-control" value="<?php echo ($edit) ? $edit['t_event_date'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12" for="image"><strong>Image : <font color="red">*</font></strong> -color-</label>
                                            <div class="col-md-12">
                                                <input type="file" <?php echo ($edit) ? '' : 'required' ?> class="form-control" name="image[]" accept="image/*" multiple="multiple">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12" for="category_name"><strong>Select Type</strong> </label>
                                            <div class="col-md-12">
                                                <select class="form-control" required name="category_name" id="category_name">
                                                    <option value="">-- Select Type --</option>
                                                    <?php if ($c_type) {
														foreach ($c_type as $c_t) {
															$selected_type1 = "";
															if (($edit)) {
																if ($edit['type'] == $c_t['c_id']) {
																	$selected_type1 = "selected";
																}
															} ?>
                                                    <option <?php echo $selected_type1; ?> value="<?php echo $c_t['c_id']; ?>"><?php echo $c_t['c_title']; ?></option>
                                                    <?php  }
													} ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12" for="font_size"><strong>Font Size : <font color="red">*</font></strong></label>
                                            <div class="col-md-12">
                                                <input type="text" required value="<?php echo ($edit) ? $edit['font_size'] : "17"; ?>" class="form-control" name="font_size">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12" for="font_color"><strong>Font Color : (#000000)</strong></label>
                                            <div class="col-md-12">
                                                <input type="text" value="<?php echo ($edit) ? $edit['font_color'] : ""; ?>" class="form-control font_color" name="font_color">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12" for="font_color"><strong>Select Code</strong></label>
                                            <div class="col-md-12" style="display: flex;">
                                                <input type="color" id="favcolor" name="favcolor" style="height: 34px;">
                                                <button type="button" onclick="myFunction()">Get Code</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12" for="ln_post"><strong>Select Language</strong> </label>
                                            <div class="col-md-12">
                                                
                                                <select name="ln_post" required id="ln_post" class="form-control">
                                                    <?php if ($language) {
                                                        foreach ($language as $lang) {
                                                            $selected_type = "";
                                                            if (($edit)) {
                                                                if ($edit['language'] == $lang['language']) {
                                                                    $selected_type = "selected";
                                                                }
                                                            } ?>
                                                    <option <?php echo $selected_type; ?> value="<?php echo $lang['language']; ?>"><?php echo $lang['language']; ?></option>
                                                    <?php }
                                                    } else {
                                                        echo '<option value="">Select Language</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Has Mask?</label>
                                            <div class="col-md-12 switch switch-sm switch-success">
                                                <input type="checkbox" id="has_mask" name="has_mask" <?php echo ($edit) ? ($edit['has_mask']=='1')? 'checked="checked"' : '' : ""; ?> value="1" onchange="changeMaskflag()" data-plugin-ios-switch />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-5" id="maskDiv">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label"> Mask </label>
                                            <div class="col-md-12">
                                                <input id="mask" type="file" <?php echo ($edit) ? '' : 'required' ?> class="form-control" name="mask[]" accept="image/*" multiple="multiple">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-6">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12" for="p_id"><strong>Select Position: <font color="red">*</font></strong></label>
                                                <div class="col-md-12">
                                                    <select name="p_id" id="p_id" required class="position form-control">
                                                        <option value="">-- Select Position --</option>
                                                        <?php if ($edit) {
                                                            if ($position) {
                                                                foreach ($position as $pos) {
                                                                    $selected_type1 = "";
                                                                    if (($edit)) {
                                                                        if ($edit['p_id'] == $pos['pid']) {
                                                                            $selected_type1 = "selected";
                                                                        }
                                                                    } ?>
                                                        <option <?php echo $selected_type1; ?> value="<?php echo $pos['pid']; ?>"><?php echo $pos['p_name']; ?></option>
                                                        <?php  }
                                                            } else {
                                                                echo '<option value="">Select Position</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12" for="font_type"><strong>Font : </strong></label>
                                                <div class="col-md-12">
                                                    <select name="font_type" required id="font_type" class="form-control">
                                                        <?php if ($fonts) {

                                                            foreach ($fonts as $font) {
                                                                $selected_type = "";
                                                                if (($edit)) {
                                                                    if ($edit['font_type'] == $font['font_name']) {
                                                                        $selected_type = "selected";
                                                                    }
                                                                } ?>
                                                        <option <?php echo $selected_type; ?> value="<?php echo $font['font_name']; ?>"><?php echo $font['font_name']; ?></option>
                                                        <?php }
                                                        } else {
                                                            echo '<option value="">Select Font</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12" for="Lable"><strong>Lable : (New)</strong></label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Enter Lable" value="<?php echo ($edit) ? $edit['lable'] : ""; ?>" class="form-control" name="lable">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12" for="Lable BG"><strong>Lable BG :(#000000) </strong></label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Enter Lable BG" value="<?php echo ($edit) ? $edit['lablebg'] : ""; ?>" class="form-control" name="lablebg">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="control-label">Free / Paid</label>
                                            <div class="switch switch-sm switch-success">
                                                <input type="checkbox" name="free_paid" <?php echo ($edit) ? ($edit['free_paid']=='1')? 'checked="checked"' : '' : ""; ?> value="1"
                                                    data-plugin-ios-switch />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <hr>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <?php if ($edit) { ?>
                                    <a class="image-popup-no-margins" href="<?php echo base_url(); ?>media/template/<?php echo $edit['path']; ?>">
                                        <img class="img-responsive" src="<?php echo base_url(); ?>media/template/<?php echo $edit['path']; ?>" style="width: 80% !important;height: 80% !important;">
                                    </a>

                                    <!-- <img src="<?php echo base_url("media/template/") . $edit['path']; ?>" width="50%"> -->
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
                            <div class="totalImg"></div>
                            <div class="countImgNotFound"></div>
                            <div class="countRenameImg"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
<script>
window.addEventListener('load', function() {
    changeMaskflag();
});

function myFunction() {
    var color = document.getElementById("favcolor").value;
    $(".font_color").val(color);
}

function changeMaskflag() {
    var maskFlag = document.getElementById("has_mask").checked;
    var mask = document.getElementById("mask");
    if(maskFlag){
        mask.disabled = false;
    }
    else {
        mask.disabled = true;
    }
}
</script>
