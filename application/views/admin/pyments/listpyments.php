<section role="main" class="content-body">
    <header class="page-header">
        <h2>Payments List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Payments List</span></li>
            </ol>
            <span class="listname" style="display: none;">Payments List/0,1,2,3,4,5,6,7,8,9,10,11/0,1,2,3,4,5,6,7,8,9,10,11</span>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
<?php 
$cut_dt_time = strftime('%Y-%m-%d', time());
$cut_time = strftime('%H:%M', time());
?>
    <div class="row">
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;User Payment Entry (<i class="userName"></i>)</h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="userMenualPyAdd">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Fetch User<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" id="mobile" name="mobile" placeholder="Enter Mobile Number" class="form-control mobile">
                                            <input type="hidden" id="userid" name="userid" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class=""></label>
                                        <div class="input-group">
                                            <button type="button" id="getMobileData" class="getMobileData right mb-xs mt-xs mr-xs btn btn-primary fetch">Fetch</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Transaction ID<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-list"></i>
                                            </span>
                                            <input type="text" id="transationid" name="transationid" placeholder="Enter Transation ID" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Select Plan<span class="rerq">*</span> </label>
                                        <select name="select_plan" id="select_plan" class="category form-control">
                                            <option value="">-- Select Plan --</option>
                                            <option value="1">Free Trial</option>
                                            <?php foreach ($packages as $package) { ?>
                                            <option value="<?php echo $package['plan_id']; ?>"><?php echo $package['plan_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <label class="control-label">Select Date<span class="rerq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-list"></i>
                                            </span>
                                            <input type="date" name="buyDate" value="<?php echo $cut_dt_time;?>" class="buyDate form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                    <label class="control-label">Free Trial Days</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-list"></i>
                                            </span>
                                            <input type="text" id="freeDays" name="freeDays" placeholder="Enter Transation ID" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="col-md-12">
                                    <label class="control-label">Free Or Paid?</label>
                                    <div class="input-group">
                                        <label class="radio-inline">
                                            <input type="radio" name="freeorpaid" value="0">Free
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="freeorpaid" checked value="1">Paid
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary" disabled="disabled">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-12">
                            <table class="table myuserData">
                                <tr>
                                    <th>ID</th>
                                    <th>Mobile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>isPaid</th>
                                    <th>Exp Date</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                </tr>
                                <tr class="insertRow">

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- user ne alag number che payment kiya wahi history -->
    <div class="row">
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Other Number Payment Pay </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Event</th>
                                    <th>Transaction</th>
                                    <th>Amount</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($othernumberpayment as $key) {?>
                                <tr id="<?php echo $key['web_auth_id']; ?>">
                                    <td><?php echo $key['web_auth_id'] ?></td>
                                    <td><?php echo $key['w_date']; ?></td>
                                    <td><?php echo $key['w_event']; ?></td>
                                    <td><?php echo $key['transaction_id']; ?></td>
                                    <td><?php echo $key['w_amount']; ?></td>
                                    <td><?php echo $key['w_email']; ?></td>
                                    <td><?php echo $key['w_mobile']; ?></td>
                                    <td><?php echo $key['w_status']; ?></td>
                                    <td><?php echo $key['created_at']; ?></td>
                                    <td>
                                        <a href="javascript:void(0)" id="<?php echo $key['web_auth_id']; ?>" onclick="deleterecord(this.id,'pyments/deleteNumPaymentUser');">
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

    <!-- start: page -->
    <div class="row">
        <div class="col-xs-12">
            <section class="panel  panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Paid Payments Active List (<?php echo count($list); ?>)
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="msg"></div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mobile</th>
                                    <th>U ID-Name</th>
                                    <th>P Amt</th>
                                    <!-- <th>P Date</th> -->
                                    <th>Trans ID</th>
                                    <th>Status</th>
                                    <th>PKG</th>
                                    <th>Price</th>
                                    <th>Month</th>
                                    <th>IsPaid</th>
                                    <th>Exp Date</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $key) { ?>
                                <tr id="tr_<?php echo $key['pid']; ?>">
                                    <td><?php echo $key['pid'] ?></td>
                                    <td>
                                        <a target="_blank" href="https://api.whatsapp.com/send/?phone=%2B91<?php echo $key['mobile'] ?>&text=&app_absent=0">
                                            <?php echo $key['mobile'] ?>
                                        </a>
                                    </td>
                                    <td><?php echo $key['u_id'] ?> - <?php echo $key['business_name'] ?></td>
                                    <td><?php echo $key['pamount']; ?></td>
                                    <!-- <td><?php //echo $key['pdate']; 
                                                    ?></td> -->
                                    <td><?php echo $key['ptransactionid']; ?></td>
                                    <td><?php echo $key['pstatus']; ?></td>
                                    <td><?php echo $key['packageid']; ?></td>
                                    <td><?php echo $key['pprice']; ?></td>
                                    <td><?php echo $key['pmonth']; ?></td>
                                    <td><?php echo($key['ispaid']==1)?"Paid":"Free"; ?></td>
                                    <td><?php echo $key['expdate']; ?></td>
                                    <td><?php echo $key['created_at']; ?></td>
                                    <td>
                                        <a class="mb-xs mt-xs refundBtn" id="<?php echo $key['pid']; ?>" userId="<?php echo $key['u_id'] ?>"><button type="button" class="btn btn-sm btn-success"
                                                data-toggle="tooltip" title="Refund">
                                                <i class="fa fa-key"></i></button></a>

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


     <!-- start: page -->
     <div class="row">
        <div class="col-xs-12">
            <section class="panel  panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Paid Payments But Expired List (<?php echo count($paidButExpList); ?>)
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="msg"></div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mobile</th>
                                    <th>U ID-Name</th>
                                    <th>P Amt</th>
                                    <!-- <th>P Date</th> -->
                                    <th>Trans ID</th>
                                    <th>Status</th>
                                    <th>PKG</th>
                                    <th>Price</th>
                                    <th>Month</th>
                                    <th>IsPaid</th>
                                    <th>Exp Date</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($paidButExpList as $key) { ?>
                                <tr id="tr_<?php echo $key['pid']; ?>">
                                    <td><?php echo $key['pid'] ?></td>
                                    <td>
                                        <a target="_blank" href="https://api.whatsapp.com/send/?phone=%2B91<?php echo $key['mobile'] ?>&text=&app_absent=0">
                                            <?php echo $key['mobile'] ?>
                                        </a>
                                    </td>
                                    <td><?php echo $key['u_id'] ?> - <?php echo $key['business_name'] ?></td>
                                    <td><?php echo $key['pamount']; ?></td>
                                    <!-- <td><?php //echo $key['pdate']; 
                                                    ?></td> -->
                                    <td><?php echo $key['ptransactionid']; ?></td>
                                    <td><?php echo $key['pstatus']; ?></td>
                                    <td><?php echo $key['packageid']; ?></td>
                                    <td><?php echo $key['pprice']; ?></td>
                                    <td><?php echo $key['pmonth']; ?></td>
                                    <td><?php echo($key['ispaid']==1)?"Paid":"Free"; ?></td>
                                    <td><?php echo $key['expdate']; ?></td>
                                    <td><?php echo $key['created_at']; ?></td>
                                    <td>
                                        <a class="mb-xs mt-xs refundBtn" id="<?php echo $key['pid']; ?>" userId="<?php echo $key['u_id'] ?>"><button type="button" class="btn btn-sm btn-success"
                                                data-toggle="tooltip" title="Refund">
                                                <i class="fa fa-key"></i></button></a>

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
