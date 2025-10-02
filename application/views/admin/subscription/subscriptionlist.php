<section role="main" class="content-body">
    <header class="page-header">
        <h2>Subscription</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Subscription</span></li>

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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp; Subscription Page
                        <!-- <a href="<?php //echo ADMIN_URL . 'application/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-List" aria-hidden="true"></i> <span>
                                &nbsp;Application List</span></a> -->
                    </h2>

                </header>
                <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="addsubscription">
                    <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['sub_dis_id'] : '' ?>">
                    <div class="panel-body">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="control-label">Select Plan<span class="rerq">*</span></label>
                                                <select tabindex="1" class="form-control" name="plan_id" required>
                                                    <?php foreach($planlist as $plist){?>
                                                        <option <?php echo !empty($edit) ? ($edit['plan_id'] == $plist['plan_id'] ? 'selected' : '') : ''; ?> value="<?php echo $plist['plan_id'];?>"><?php echo $plist['plan_name'];?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="control-label">Discription Title <span class="rerq">*</span></label>
                                                <input type="text" name="title" class="form-control" placeholder="Enter Discription Title" value="<?php echo ($edit) ? $edit['title'] : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Select Sign (0-False, 1-True)</label>
                                                <div class="input-group">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="sign" value="0" <?php echo ($edit) ? $edit['sign']==0?"checked":"":'checked' ?>><i class="fa fa-times fa-2x text-primary" aria-hidden="true"></i>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="sign" value="1" <?php echo ($edit) ? $edit['sign']==1?"checked":"":'' ?>><i class="fa fa-check fa-2x text-success" aria-hidden="true"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12"><br />
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary"><?php echo empty($edit) ? 'Save' : 'Update'; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
<!--         <div class="col-md-12">
            <div class="" style="float: right;">
                <div class="control-label">
                    <label class="control-label">Select Application</label>
                    <select tabindex="1" data-plugin-selectTwo class="col-md-4 form-control" id="application" name="application" required>
                        <option value="">-- Select Application --</option>
                        <?php /*foreach ($data['app_list'] as $app) { ?>
                        <option value="<?php echo $app['app_name'] ?>"><?php echo $app['app_name']; ?></option>
                        <?php } */?>
                    </select>
                    <br />
                </div>
            </div>
        </div> -->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                </div>
                <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Subscription List (<?php echo count($sub_list); ?>)</h2>
                <!-- <span class="listname" style="display: none;">Advertise List/0,1,2,3,4/0,1,2,3,4</span> -->

            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped  datatable-tabletools">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">Sign</th>
                                <th width="30%">Plan Name - Title</th>
                                <th width="30%">Title</th>
                                <th width="15%">Price - Discount</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; $a = 1;
                                foreach ($sub_list as $key) { ?>
                                <tr id="<?php echo $key['sub_dis_id']; ?>">
                                    <td><?php echo $key['sub_dis_id']; ?></td>
                                    <td width="10%"><?php echo ($key['sign'] == '1') ? '<i class="fa fa-check fa-2x text-success" aria-hidden="true"></i>' : '<i class="fa fa-times fa-2x text-primary" aria-hidden="true"></i>'; ?></td>
                                    <?php if($a==1){ ?>
                                        <td rowspan="<?php echo $totalSubRecord;?>">
                                            <b><?php echo $key['plan_name']; ?></b><br /> 
                                            <i><?php echo $key['special_title']; ?></i>
                                            <button type="button" style="float: right;margin-top: -20px;" class="btn btn-info openBtn" data-id="<?php echo $key['plan_id']; ?>">Edit</button>
                                        </td>
                                    <?php } ?>
                                    
                                    <td><?php echo $key['title']; ?></td>
                                    <?php if($a == 1){ ?>
                                        <td rowspan="<?php echo $totalSubRecord;?>" class="changePrice"><?php echo $key['price']." - ".$key['discount_price']; ?></td>
                                    <?php } ?>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo ADMIN_URL . 'subscription/edit/' . $key['sub_dis_id']; ?>">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </a>
                                            <a href="javascript:void(0)" id="<?php echo $key['sub_dis_id']; ?>" onclick="deleterecord(this.id,'/subscription/deleteSubDescription');">
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;$a++;($a==11)?$a=1:"";
                                } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    </div>
    <!-- end: page -->
</section>


<!-- Modal -->
<div class="modal fade" id="mySubUpdateModel" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="updatePlan">
        <input type="hidden" name="pl_id" class="pl_id" value="0">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Subscription Plan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Month <span class="rerq">*</span></label>
                                            <input type="text" name="month" class="form-control month">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Plan Name <span class="rerq">*</span></label>
                                            <input type="text" name="plan_name" class="form-control plan_name">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Price <span class="rerq">*</span></label>
                                            <input type="text" name="price" class="form-control price">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Discount Price <span class="rerq">*</span></label>
                                            <input type="text" name="discount_price" class="form-control discount_price">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Special Title <span class="rerq">*</span></label>
                                            <input type="text" name="special_title" class="form-control special_title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Status (0-off 1-On) <span class="rerq">*</span></label>
                                            <input type="text" name="status" class="form-control status">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>