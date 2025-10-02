<style>
    .expired_date{
        background-color: #af3333;
        color:white;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Slider List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Coupon Code</span></li>
            </ol>
            <span class="listname" style="display: none;">Coupon Code List/0,1,2,3,4/0,2,3,4</span>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Coupon Code
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="CouponCodeADD">
                            <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['coupon_id'] : ""; ?>" />
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="control-label">Coupon Name <span class="rerq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="text" name="c_name" placeholder="Enter Coupon Name" class="form-control" value="<?php echo ($edit) ? $edit['c_name'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Coupon Code <span class="rerq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="text" name="c_code" placeholder="Enter Coupon Code" class="form-control" value="<?php echo ($edit) ? $edit['c_code'] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Coupon Title <span class="rerq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="text" name="c_title" placeholder="Enter Coupon Title" class="form-control" value="<?php echo ($edit) ? $edit['c_title'] : ""; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">Start Date <span class="rerq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="start_date" class="form-control" value="<?php echo ($edit) ? date('Y-m-d',strtotime($edit['start_date'])) : ""; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">End Date <span class="rerq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="end_date" class="form-control" value="<?php echo ($edit) ? date('Y-m-d',strtotime($edit['end_date'])) : ""; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">Total QTY <span class="rerq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="number" name="total_qty" placeholder="Enter Total QTY" class="form-control" value="<?php echo ($edit) ? $edit['total_qty'] : ""; ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">Total Days <span class="rerq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input type="number" name="total_days" placeholder="Enter Total Days" class="form-control" value="<?php echo ($edit) ? $edit['total_days'] : ""; ?>" />
                                    </div>
                                </div>

                            </div>
                           
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label class="control-label">Note</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-paint-brush"></i>
                                        </span>
                                        <input type="text" name="note" placeholder="Enter Note" class="form-control" value="<?php echo ($edit) ? $edit['note'] : ""; ?>">
                                    </div>
                                </div>
                                

                                <div class="col-md-6">
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

                                <div class="col-md-12 svbut">
                                    <button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Active Coupon Code List (<?php echo count($list['active']); ?>)
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code Name</th>
                                    <th>Code</th>
                                    <th>Code Title</th>
                                    <th>Total Days</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Total QTY</th>
                                    <th>Apply Promo</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list['active'] as $key) { 
                                $color_status = "";
                                $color_qty_status = "";

                                if($key['end_date'] <= date('Y-m-d', strtotime('+' . 10 . ' days', strtotime(ONLY_DATE)))){
                                    $color_status = "expired_date";
                                }    
                                if($key['total_qty'] <= $key['total_count_user_apply']+20){
                                    $color_qty_status = "expired_date";
                                }    
                                ?>
                                <tr id="<?php echo $key['coupon_id']; ?>">
                                    <td><?php echo $key['coupon_id']; ?></td>
                                    <td><?php echo $key['c_name']; ?></td>
                                    <td><?php echo $key['c_code']; ?></td>
                                    <td><?php echo $key['c_title']; ?></td>
                                    <td><?php echo $key['total_days']; ?></td>
                                    <td><?php echo $key['start_date'] ? date('d/m/Y', strtotime($key['start_date'])) : ''; ?> </td>
                                    <td class="<?php echo $color_status;?>"><?php echo $key['end_date'] ? date('d/m/Y', strtotime($key['end_date'])) : ''; ?></td>
                                    <td><?php echo $key['total_qty']; ?></td>
                                    <td class="<?php echo $color_qty_status;?>"><?php echo $key['total_count_user_apply']; ?></td>
                                    <td><?php echo $key['note']; ?></td>
                                    <td>
                                        <?php $status = $key['status'] == 1 ? 'checked=""' : ''; ?>
                                        <div class="switch switch-sm switch-success">
                                            <input type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div>
                                    </td>
                                    <td><?php echo ($key['created_at']!="0000-00-00 00:00:00" && $key['created_at']!="")?date('d/m/Y h:i', strtotime($key['created_at'])) : ''; ?></td>
                                    <td><?php echo ($key['updated_at']!="0000-00-00 00:00:00" && $key['updated_at']!="")?date('d/m/Y h:i', strtotime($key['updated_at'])) : ''; ?></td>
                                    
                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'couponcode/couponCodeEdit/' . $key['coupon_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </a>

                                        <a href="javascript:void(0)" id="<?php echo $key['coupon_id']; ?>" onclick="deleterecord(this.id,'/couponcode/deleteCouponCode');">
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

            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Deactive Coupon Code List (<?php echo count($list['deactive']); ?>)
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code Name</th>
                                    <th>Code</th>
                                    <th>Code Title</th>
                                    <th>Total Days</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Total QTY</th>
                                    <th>Apply Promo</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list['deactive'] as $key) { 
                                $color_status1 = "";
                                $color_qty_status1 = "";

                                if($key['end_date'] <= date('Y-m-d', strtotime('+' . 10 . ' days', strtotime(ONLY_DATE)))){
                                    $color_status1 = "expired_date";
                                }    
                                if($key['total_qty'] <= $key['total_count_user_apply']+20){
                                    $color_qty_status1 = "expired_date";
                                } 
                                ?>
                                <tr id="<?php echo $key['coupon_id']; ?>">
                                    <td><?php echo $key['coupon_id']; ?></td>
                                    <td><?php echo $key['c_name']; ?></td>
                                    <td><?php echo $key['c_code']; ?></td>
                                    <td><?php echo $key['c_title']; ?></td>
                                    <td><?php echo $key['total_days']; ?></td>
                                    <td><?php echo $key['start_date'] ? date('d/m/Y', strtotime($key['start_date'])) : ''; ?> </td>
                                    <td class="<?php echo $color_status1;?>"><?php echo $key['end_date'] ? date('d/m/Y', strtotime($key['end_date'])) : ''; ?> </td>
                                    <td><?php echo $key['total_qty']; ?></td>
                                    <td class="<?php echo $color_qty_status1;?>"><?php echo $key['total_count_user_apply']; ?></td>
                                    <td><?php echo $key['note']; ?></td>
                                    <td>
                                        <?php $status = $key['status'] == 1 ? 'checked=""' : ''; ?>
                                        <div class="switch switch-sm switch-success">
                                            <input type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div>
                                    </td>
                                    <td><?php echo ($key['created_at']!="0000-00-00 00:00:00" && $key['created_at']!="")?date('d/m/Y h:i', strtotime($key['created_at'])) : ''; ?></td>
                                    <td><?php echo ($key['updated_at']!="0000-00-00 00:00:00" && $key['updated_at']!="")?date('d/m/Y h:i', strtotime($key['updated_at'])) : ''; ?></td>
                                    
                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'couponcode/couponCodeEdit/' . $key['coupon_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </a>

                                        <a href="javascript:void(0)" id="<?php echo $key['coupon_id']; ?>" onclick="deleterecord(this.id,'/couponcode/deleteCouponCode');">
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
