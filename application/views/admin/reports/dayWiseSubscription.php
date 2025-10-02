<section role="main" class="content-body">
    <header class="page-header">
        <h2>Day Wise Subscription Report</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Day Wise Subscription Report</span></li>
            </ol>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Day Wise Subscription List
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <form class="form-horizontal form-bordered" action="" id="form-filter">
                            <div class="col-md-12">
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo date('Y-m-01'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group" >
                                        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary" id="btn-filter">Filter</button>
                                        <button type="button" class="mb-xs mt-xs mr-xs btn btn-danger" id="btn-reset">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="">
                            <!-- table-responsive -->
                            <table class="table table-bordered table-striped mb-none" id="dayWiseSubscriptionList">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Monthly</th>
                                        <th>3 Monthly</th>
                                        <th>6 Monthly</th>
                                        <th>Yearly</th>
                                        <th>Exclusive</th>
                                        <th>Trail Total</th>
                                        <th>Refund</th>
                                        <th>Refund Amount</th>
                                        <th>Total Paid</th>
                                        <th>Total Amount</th>
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
