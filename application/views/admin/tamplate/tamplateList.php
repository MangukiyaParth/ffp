<style>
tbody tr td {
    text-align: center !important;
    vertical-align: middle !important;
}

</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Tamplate List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Tamplate List</span></li>
            </ol>
            <span class="listname" style="display: none;">Usaer List/0,1,2,3,4/0,2,3,4</span>
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
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>
                    <h2 class="panel-title">
                        <a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Tamplate List (<?php echo count($list); ?>)
                        <a href="<?php echo ADMIN_URL . 'tamplate/addTamplate/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span>&nbsp;Add Tamplate</span>
                        </a>
                    </h2>
                </header>
                <?php if ($this->session->flashdata('msg-success')) {
					echo "<div class='alert alert-success'>" . $this->session->flashdata('msg-success') . "</div>";
				}
				if ($this->session->flashdata('msg-error')) {
					echo "<div class='alert alert-danger'>" . $this->session->flashdata('msg-error') . "</div>";
				}
				?>
                <div class="panel-body">
                    <button style="margin-bottom: 10px" class="btn btn-primary edit_all" data-url="<?php echo base_url("admin/tamplate/editAllTamplate"); ?>">All Edit</button>
                    <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="<?php echo base_url("admin/tamplate/deleteAllTamplate"); ?>">All Selected</button>
                    <div class="">
                        <input type="checkbox" id="master" style="height: 30px;width: 30px;">
                        <!-- table-responsive -->
                        <table class="table table-bordered table-striped mb-none" id="memListTable">
                            <thead>
                                <tr>
                                    <th width="5%"></th>
                                    <th width="5%">ID</th>
                                    <th width="5%">MRP</th>
                                    <th width="5%">C Type</th>
                                    <th width="10%">Position</th>
                                    <th width="10%">Date</th>
                                    <th width="10%">Post</th>
                                    <th width="10%">Plan</th>
                                    <th width="10%">Thumb</th>
                                    <th width="5%">Mask</th>
                                    <th width="10%">Category</th>
                                    <!-- <th width="10%">Font</th> 
                                    <th width="10%">Color</th>-->
                                    <th width="10%">Lang</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>
<style>
.modal-open .select2-container--open {
    z-index: 999999 !important;
    width: 100% !important;
}

</style>
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url("admin/tamplate/allEditUpdate");?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Tamplate</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="edit_id" name="edit_id">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Event Date:<font color="red">*</font></strong></label>
                                    <div class="col-md-12">
                                        <input type="date" name="t_event_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12" for="font_size"><strong>Font Size : </strong></label>
                                    <div class="col-md-12">
                                        <input type="text" value="" class="form-control" name="font_size">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12" for="font_color"><strong>Font Color : (# Next, add a # sign)</strong></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control font_color" name="font_color">
                                        <div style="display: flex;">
                                            <input type="color" id="favcolor" name="favcolor" style="height: 34px;">
                                            <button type="button" onclick="myFunction()">get Code</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12" for="font_color"><strong>Select Category : </strong></label>
                                    <div class="col-md-12">
                                        <select name="category_name" id="category_name" class="category_name form-control category"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12" for="font_color"><strong>Select Font : </strong></label>
                                    <div class="col-md-12">
                                        <select name="font_name" id="font_name" class="font_name form-control"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12" for="font_color"><strong>Select Position : </strong></label>
                                    <div class="col-md-12">
                                        <select name="position_name" id="position_name" class="position_name form-control position"></select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Free / Paid</label>
                                <div class="switch switch-sm switch-success">
                                    <input type="checkbox" name="free_paid" value="1" data-plugin-ios-switch />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">ફ્રી અને પેડ માં સુધારા કરવા છે?</label>
                                <div class="single-line">
                                    <div class="radio-custom radio-primary">
                                        <input id="awesome" name="fpchanges" value="0" checked type="radio" value="awesome" aria-required="true">
                                        <label for="awesome">No</label>
                                    </div>&nbsp;&nbsp;
                                </div>
                                <div class="single-line">
                                    <div class="radio-custom radio-primary">
                                        <input id="very-awesome" name="fpchanges" value="1" type="radio" value="very-awesome">
                                        <label for="very-awesome">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12" for="lang_name"><strong>Select Language : </strong></label>
                                    <div class="col-md-12">
                                        <select name="lang_name" id="lang_name" class="lang_name form-control"></select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
function myFunction() {
    var color = document.getElementById("favcolor").value;
    $(".font_color").val(color);
}
</script>
