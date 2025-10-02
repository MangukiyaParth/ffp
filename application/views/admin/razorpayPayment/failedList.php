<section role="main" class="content-body">
    <header class="page-header">
        <h2>Payment Failed List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Payment Failed List</span></li>
            </ol>
            
        </div>

    </header>
    <!-- start: page -->
    <div class="row">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                </div>
                <h2 class="panel-title">
                    <a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Date wise filter
                </h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <form class="form-horizontal form-bordered" action="" id="form-filter">
                        <div class="col-md-12"></div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group" >
                                <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary" id="btn-filter">Filter</button>
                                <button type="button" class="mb-xs mt-xs mr-xs btn btn-danger" id="btn-reset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div> -->

        <section class="panel panel-collapsed">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                </div>
                <h2 class="panel-title">
                    <a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Payment Failed List
                </h2>
            </header>
            <div class="panel-body">

                <div>
                    <!-- table-responsive -->
                    <span class="listname" style="display: none;">Payment Faile List/0,1,2,3,4,6,7,8,9/0,1,2,3,4,6,7,8,9</span>
                    <table class="table table-bordered table-striped mb-none" id="razorpayPaymentFailedTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Failed Date</th>
                                <th>Mobile</th>
                                <th>Transaction Id</th>
                                <th>Amount</th>
                                <th>Email</th>
                                <!-- <th>Payment Link</th>
                                <th>Expiry Date</th>
                                <th>Total Send</th>
                                <th>Send Time</th> -->
                                <th>Created</th>
                                <th>Updated</th>
                                <!--  <th width="5%">Action</th> -->
                                <!-- <th width="15%">Action</th> -->
                            </tr>
                        </thead>

                    </table>

                </div>

            </div>
        </section>

        <!-- <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div> -->

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                </div>
                <h2 class="panel-title">
                    <a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Order Create List
                </h2>
            </header>
            <div class="panel-body">

                <div class="">
                    <!-- table-responsive -->
                    <span class="listname" style="display: none;">Order Created List/0,1,2,3,4,6,7/0,1,2,3,4,6,7</span>
                    <table class="table table-bordered table-striped mb-none" id="datatable-tabletools">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Entity</th>
                                <th>Amount</th>
                                <th>Receipt</th>
                                <th>Status</th>
                                <th>Attempts</th>
                                <!-- <th>Notes</th> -->
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($ordersList as $item){ if($item['status'] != "paid"){
                                $userID = explode("_",$item['receipt']); ?>
                                <tr>
                                    <th><?php echo $i;?></th>
                                    <th><?php echo $item['id'];?></th>
                                    <th><?php echo $item['entity'];?></th>
                                    <th><?php echo $item['amount'] / 100;?></th>
                                    <th>
                                        <a target="_blank" href="https://web.whatsapp.com/send/?phone=%2B91<?php echo getUserMobileNumber(end($userID));?>&text=&app_absent=0">    
                                            <?php echo getUserMobileNumber(end($userID));?>
                                        </a>
                                    </th>
                                    <th><?php echo $item['status'];?></th>
                                    <th><?php echo $item['attempts'];?></th>
                                    <!-- <th><?php //print_r($item['notes']);?></th> -->
                                    <th><?php echo date("d/m/Y h:i:s",$item['created_at']);?></th>
                                </tr>
                            <?php $i++; } } ?>
                        </tbody>

                    </table>

                </div>

            </div>
        </section>
    </div>
    <!-- end: page -->
</section>
