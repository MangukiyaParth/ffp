<style>
.text-red-color {
    color: red;
    font-weight: 900;
}
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard Lead</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Home</span></li>
                <li><span>Dashboard Lead</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-6 col-lg-12 col-xl-6">
            <section class="">
                <!-- 1 -->
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-xl-6 text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <section class="panel panel-featured-left panel-featured-danger">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-danger">
                                                <i class="fa fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total Users</h4>
                                                <div class="info">
                                                    <strong class="amount">00</strong><br />
                                                    <span class="text-danger">(Deactive)</span>
                                                    || <span class="text-danger">(Today)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a href="<?php echo ADMIN_URL . 'users' ?>" class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>

                    <div class="col-md-4 col-lg-4 col-xl-6 text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <section class="panel panel-featured-left panel-featured-success">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-success">
                                                <i class="fa fa-photo"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total User Post</h4>
                                                <div class="info">
                                                    <strong class="amount">00</strong><br />
                                                    <span class="text-success">(Today Total Post)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a href="<?php echo ADMIN_URL . 'userpost' ?>" class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-xl-6 text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total User Videos</h4>
                                                <div class="info">
                                                    <strong class="amount">00</strong><br />
                                                    <span class="text-primary">(Today Total Videos)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a href="<?php //echo ADMIN_URL . 'userpost' ?>" class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <!--Category Wise Tamplate Count  -->
                    <div class="col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                                </div>

                                <h2 class="panel-title">Pending Review Status</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none datatable-tabletools">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Screenshort</th>
                                                <th>Note</th>
                                                <th>Mobile</th>
                                                <th>Sales</th>
                                                <th>Email</th>
                                                <th>Review Date</th>
                                                <th>Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pendingReview as $key=>$value) { 
                                            if($value['review_photo'] !="" && $value['review_photo'] !=null){
                                                $filestring = PUBPATH . "media/review/".$value['review_photo'];
                                                $screenshort_review = base_url("media/review/").$value['review_photo']; 
                                                if(!file_exists($filestring)){
                                                    $screenshort_review = base_url("assets/images/avatar7.png");
                                                }
                                            }else{
                                                $screenshort_review = base_url("assets/images/avatar7.png");     
                                            }
                                            ?>
                                             
                                            <tr id="rem_<?php echo $value['custom_review_id']?>">
                                                <td><?php echo $value['custom_review_id']; ?></td>
                                                <td>
                                                    <a href="<?php echo $screenshort_review;?>" target="_blank">
                                                        <img src="<?php echo $screenshort_review;?>" alt="Admin" class="rounded-circle" width="100">
                                                    </a>
                                                </td>
                                                <td><?php echo $value['note']; ?></td>
                                                <td><?php echo $value['mobile']; ?></td>
                                                <td><?php echo $value['salesName']; ?></td>
                                                <td><?php echo $value['salesEmail']; ?></td>
                                                <td><?php echo $value['review_date']; ?></td>
                                                <td><?php echo $value['created_at']; ?></td>
                                                <td>
                                                    <select class="form-control statusChanges" name="statusChanges">
                                                        <option data-id="<?php echo $value['custom_review_id']?>" value="0_rev">Pending</option>
                                                        <option data-id="<?php echo $value['custom_review_id']?>" value="1_rev">Approve</option>
                                                        <option data-id="<?php echo $value['custom_review_id']?>" value="2_rev">Rejecte</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row">
                    <!--Category Wise Tamplate Count  -->
                    <div class="col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                                </div>

                                <h2 class="panel-title">Pending Subscription Status</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none datatable-tabletools">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Mobile</th>
                                                <th>ScreenShort</th>
                                                <th>User Created</th>
                                                <th>Lead Assign</th>
                                                <th>Open Date</th>
                                                <th>Package Buy</th>
                                                <th>Request Date</th>
                                                <th>Plan Name</th>
                                                <th>Price</th>
                                                <th>Sale</th>
                                                <th>Sales Person</th>
                                                <th>Note</th>
                                                <th>IsPaid</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pendingSubscription as $key=>$value) { 
                                            if($value['sub_ss'] !="" && $value['sub_ss'] !=null){
                                                $filestring = PUBPATH . "media/subss/".$value['sub_ss'];
                                                $screenshort_review = base_url("media/subss/").$value['sub_ss'];  
                                                if(!file_exists($filestring)){
                                                    $screenshort_review = base_url("assets/images/avatar7.png");
                                                }
                                            }else{
                                                $screenshort_review = base_url("assets/images/avatar7.png");     
                                            }
                                            ?>
                                             
                                            <tr id="rem_<?php echo $value['sales_report_id']?>">
                                                <td><?php echo $value['sales_report_id']; ?></td>
                                                <td><?php echo $value['mobile']; ?></td>
                                                <td>
                                                    <a href="<?php echo $screenshort_review;?>" target="_blank">
                                                        <img src="<?php echo $screenshort_review;?>" alt="Admin" class="rounded-circle" width="70">
                                                    </a>
                                                </td>
                                                <td><?php echo date("d/m/Y h:i",strtotime($value['userCreatedDate'])); ?></td>
                                                <td><?php echo date("d/m/Y h:i",strtotime($value['leadAssignDate'])); ?></td>
                                                <td><?php echo date("d/m/Y h:i",strtotime($value['open_status_time'])); ?></td>
                                                <td><?php echo date("d/m/Y h:i",strtotime($value['pack_buy_date'])); ?></td>
                                                <td><?php echo date("d/m/Y h:i",strtotime($value['subRequestAddDate'])); ?></td>
                                                <td><?php echo $value['plan_name']; ?></td>
                                                <td><?php echo $value['price']; ?></td>
                                                <td><?php echo $value['sales_amount']; ?></td>
                                                <td><?php echo $value['salesName']; ?></td>
                                                <td><?php echo $value['note']; ?></td>
                                                <td>
                                                    <?php echo ($value['ispaid'] == 1 && $value['planStatus'] == 2) ? '<i class="fa fa-check-circle iconfsize icolgreen" data-toggle="tooltip" title="Paid"></i>' : '<i class="fa fa-times-circle iconfsize icolred" data-toggle="tooltip" title="Free"></i>'; ?>
                                                </td>
                                                <td>
                                                    <select class="form-control statusChanges" name="statusChanges">
                                                        <option data-id="<?php echo $value['sales_report_id']?>" value="0_sub">Pending</option>
                                                        <option data-id="<?php echo $value['sales_report_id']?>" value="1_sub">Approve</option>
                                                        <option data-id="<?php echo $value['sales_report_id']?>" value="2_sub">Rejecte</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <?php foreach($allTeleSalesOverView as $key=>$value){?>
                <div class="row">
                    <div class="col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                                </div>
                                <h2 class="panel-title"><?php echo $key;?></h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none">
                                        <thead>
                                            <tr>
                                                <?php foreach($value as $key1=>$v){?>
                                                    <td><?php echo $key1;?></td>
                                                <?php } ?>
                                                <th><b>Total</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php $totalDataSalseWise=0; foreach($value as $key1=>$v){?>
                                                    <td>
                                                        <?php 
                                                        echo $v['totalCount'];
                                                        $totalDataSalseWise = $totalDataSalseWise+$v['totalCount'];
                                                        ?>
                                                    </td>
                                                <?php } ?>
                                                <td><b><?php echo $totalDataSalseWise;?></b></td>
                                            </tr>   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <?php } ?>    

            </section>
        </div>

    </div>
</section>
