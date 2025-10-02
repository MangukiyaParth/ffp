<section role="main" class="content-body">
    <header class="page-header">
        <h2>Trial Subscription</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Trial Subscription</span></li>
            </ol>
            <span class="listname" style="display: none;">Trial Subscription/0,1,2,3,4,5,6,7,8,9,10,11/0,1,2,3,4,5,6,7,8,9,10,11</span>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- <div class="row">
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
                                            <?php /*  foreach ($packages as $package) { ?>
                                            <option value="<?php echo $package['plan_id']; ?>"><?php echo $package['plan_name'];?></option>
                                            <?php } */?>
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
                                            <input type="date" name="buyDate" class="buyDate form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    </div> -->


    <div class="row">
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Trial Subscription (<?php echo count($trial); ?>)
                    </h2>
                </header>
                <div class="panel-body">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trial as $key) {?>
                                <tr id="<?php echo $key['pid']; ?>">
                                    <td><?php echo $key['pid'] ?></td>
                                    <td>
                                        <a target="_blank" href="https://api.whatsapp.com/send/?phone=%2B91<?php echo $key['mobile'] ?>&text=&app_absent=0">
                                            <?php echo $key['mobile'] ?>
                                        </a>
                                    </td>
                                    <td><?php echo $key['u_id'] ?> - <?php echo $key['business_name'] ?></td>
                                    <td><?php echo $key['pamount']; ?></td>
                                    <!-- <td><?php //echo $key['pdate']; ?></td> -->
                                    <td><?php echo $key['ptransactionid']; ?></td>
                                    <td><?php echo $key['pstatus']; ?></td>
                                    <td><?php echo $key['packageid']; ?></td>
                                    <td><?php echo $key['pprice']; ?></td>
                                    <td><?php echo $key['pmonth']; ?></td>
                                    <td><?php echo($key['ispaid']==1)?'Paid':'Free'; ?></td>
                                    <td><?php echo $key['expdate']; ?></td>
                                    <td><?php echo $key['created_at']; ?></td>

                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
