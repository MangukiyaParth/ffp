<style>
.text-red-color {
    color: red;
    font-weight: 900;
}
.h2_title{
    margin-left: 18px !important;
    font-weight: 700;
}
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Home</span></li>
                <li><span>Dashboard</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <section class="">
            <!-- 1 -->
            <div class="row">
                <!-- <div class="col-md-12 col-lg-12 col-xl-12 text-left">
                    <h2 class="h2_title">Todays Report</h2>
                </div> -->

                <div class="col-md-4 col-lg-4 col-xl-12 text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <section class="panel panel-featured-left panel-featured-success">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-success">
                                            <i class="fa fa-trophy"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Premiums</h4>
                                            <div class="info">
                                                <strong class="amount">00</strong><br />
                                                <span class="text-success">(Today:)</span>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a href="javascript:void(0);" class="text-muted text-uppercase">This Month:</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-12 text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <section class="panel panel-featured-left panel-featured-primary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-primary">
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Reviews</h4>
                                            <div class="info">
                                                <strong class="amount">00</strong><br />
                                                <span class="text-primary">(Today:)</span>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a href="javascript:void(0);" class="text-muted text-uppercase">This Month:</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-12 text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <section class="panel panel-featured-left panel-featured-danger">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-danger">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Call</h4>
                                            <div class="info">
                                                <strong class="amount">00</strong><br />
                                                <span class="text-danger">(Today:)</span>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a href="javascript:void(0);" class="text-muted text-uppercase">This Month:</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>

                <div class="col-md-4 col-lg-4 col-xl-12 text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <section class="panel panel-featured-left panel-featured-primary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-primary">
                                            <i class="fa fa-volume-control-phone"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Call Receive</h4>
                                            <div class="info">
                                                <strong class="amount">00</strong><br />
                                                <span class="text-primary">(Today:)</span>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a href="javascript:void(0);" class="text-muted text-uppercase">This Month:</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>

                <div class="col-md-4 col-lg-4 col-xl-12 text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <section class="panel panel-featured-left panel-featured-danger">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-danger">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Call Receive Time (H:M)</h4>
                                            <div class="info">
                                                <strong class="amount">Total: <?php echo $telesalesAllCounter['totalReceviedCall'];?></strong><br />
                                                <span class="text-danger">This Month: <b><?php echo $telesalesAllCounter['monthReceviedCall'];?></b></span><br />
                                                <span class="text-danger">(Today: <b><?php echo $telesalesAllCounter['dayReceviedCall'];?></b>)</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-12 text-center">
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
                                            <h4 class="title">Promo Code</h4>
                                            <div class="info">
                                                <strong class="amount">Total: </strong><br />
                                                <span class="text-success">This Month: </span></ br>
                                                <span class="text-success">Today: </span>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a href="javascript:void(0);" class="text-muted text-uppercase">&nbsp;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </section>

    </div>
    <!-- all record counting indivisule -->
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
                            <table class="table table-bordered table-striped mb-none datatable-tabletools">
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

    <!--upcoming List  -->
    <div class="row">
        <div class="col-xs-12">
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <span class="listname" style="display: none;">Usaer List/0,1,2,3,4,5,6,7,8,9/0,1,2,3,4,5,6,7,8,9</span>
                    <h2 class="panel-title">UpComing Festival List</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Date</th>
                                    <th width="5%">Cat ID</th>
                                    <th width="40%">Title</th>
                                    <th width="5%">Plan/Auto</th>
                                    <th width="20%">Image</th>
                                    <th width="20%">Thumb</th>
                                    <th width="5%">Template</th>
                                    <th width="5%">Plan</th>
                                    <th width="3%">Paid</th>
                                    <th width="3%">Videos</th>
                                    <th width="3%">Paid</th>
                                    <th width="3%">Banner</th>
                                    <th width="3%">Quote</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;if($upcominglist){ 
                                    foreach ($upcominglist as $key=>$value) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value['event_date']; ?></td>
                                    <td><?php echo $value['mid']; ?></td>
                                    <td><?php echo $value['mtitle']; ?></td>
                                    <td><?php echo($value['plan_auto']==1)?'Only Plan':''; ?></td>
                                    <td>
                                        <a target="_blank" href="<?php echo $value['image']; ?>">
                                            <img src="<?php echo $value['image']; ?>" width="100%" />
                                        </a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?php echo $value['thumb']; ?>">
                                            <img src="<?php echo $value['thumb']; ?>" width="80%" />
                                        </a>
                                    </td>
                                    <td class="<?php echo ($value['total_auto_tamp']==0)?'text-red-color':''?>"><?php echo $value['total_auto_tamp']; ?></td>
                                    <td class="<?php echo ($value['totalPlanPost']< $value['total_auto_tamp'])?'text-red-color':''?>"><?php echo $value['totalPlanPost']; ?></td>
                                    <?php 
                                    $temp_clas = "";
                                    if($value['total_auto_tamp']!=0){
                                        if($value['totalPaidTamp']==0){
                                            $temp_clas = "style='background-color: red;color: wheat;'";
                                        }
                                    }   
                                    ?>
                                    <td <?php echo $temp_clas;?>><?php echo $value['totalPaidTamp']; ?></td>
                                    <td><?php echo ($value['total_video_tamp']!=0)?$value['total_video_tamp']:""; ?></td>
                                    <?php 
                                    $video_clas = "";
                                    if($value['total_video_tamp']!=0){
                                        if($value['totalPaidvVideo']==0){
                                            $video_clas = "style='background-color: red;color: wheat;'";
                                        }
                                    }   
                                    ?>
                                    <td <?php echo $video_clas;?>><?php echo ($value['total_video_tamp']!=0)? $value['totalPaidvVideo']:""; ?></td>
                                    <td>
                                        <?php if($value['noti_banner']!=""){?>
                                        <a target="_blank" href="<?php echo base_url("media/category/banner/").$value['noti_banner']; ?>">
                                            <img src="<?php echo base_url("media/category/banner/").$value['noti_banner']; ?>" width="100%" />
                                        </a>
                                        <?php }?>
                                    </td>
                                    <td><?php echo $value['noti_quote']; ?></td>
                                </tr>
                                <?php $i++;
                                } } ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>                                         

    <!-- today register and today expired -->
    <div class="row">
        <div class="col-md-12 col-ms-12">
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>

                    <h2 class="panel-title">Today Register User - (<?php echo count($todayRegisterUser);?>)</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mobile</th>
                                    <th>B Mobile</th>
                                    <th>B Name</th>
                                    <th>Service</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($todayRegisterUser as $key=>$value) { 
                                if($value['planStatus']==2){
                                    $status = "Paid";
                                }else if($value['planStatus']==1){
                                    $status = "Trial";
                                }else{
                                    $status = "Free";
                                }   
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                    <a target="_blank" href="https://web.whatsapp.com/send/?phone=%2B91<?php echo $value['mobile'];?>&text=<?php echo $value['business_name'];?>&app_absent=0">    
                                        <?php echo $value['mobile']; ?>
                                    </a>
                                    </td>
                                    <td><?php echo $value['b_mobile2']; ?></td>
                                    <td><?php echo $value['business_name']; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['b_email']; ?></td>
                                    <td><?php echo $value['b_website']; ?></td>
                                    <td><?php echo $value['created_date']; ?></td>
                                    <td><?php echo $status; ?></td>
                                </tr>
                                <?php $i++;} ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        
    </div>
    <!-- plan expire before after -->                            
    <div class="row">
    <div class="col-md-12 col-xs-12">
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Today Expire (<?php echo date('d/m/Y')?>) - (<?php echo (!empty($planExpiredData))?($planExpiredData[date('Y-m-d')])?count($planExpiredData[date('Y-m-d')]):"0":"";?>)</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!--  <th>Date</th> -->
                                    <th>Plan</th>
                                    <th>Month</th>
                                    <th>Mobile</th>
                                    <th>B Name</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($planExpiredData)){ foreach ($planExpiredData[date('Y-m-d')] as $key=>$value) { ?>
                                <tr>
                                    <td><?php echo $value['id']; ?></td>
                                    <!-- <td><?php //echo date("d/m/Y",strtotime($value['expdate'])); ?></td> -->
                                    <td><?php echo $value['pstatus']; ?></td>
                                    <td><?php echo $value['pmonth']; ?></td>
                                    <td>
                                        <a target="_blank" href="https://web.whatsapp.com/send/?phone=%2B91<?php echo $value['mobile'];?>&text=<?php echo $value['business_name'];?>&app_absent=0">    
                                            <?php echo $value['mobile']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $value['business_name']; ?></td>
                                    <td><?php echo date("d/m/Y H:i",strtotime($value['last_login'])); ?></td>
                                    <td>
                                        <a class="mb-xs mt-xs  user_profile" id="<?php echo $value['id'];?>">
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="View Profile">
                                                <i class="fa fa-user"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php } } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-6 col-xs-6">
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Before 1 Days Expired (<?php echo date('d/m/Y', strtotime('-1 day', strtotime(date('Y-m-d'))))?>) - (<?php echo (!empty($planExpiredData))?($planExpiredData[date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))))])?count($planExpiredData[date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))))]):"0":"";?>)</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>Date</th> -->
                                    <th>Plan</th>
                                    <th>Month</th>
                                    <th>Mobile</th>
                                    <th>B Name</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($planExpiredData)){ foreach ($planExpiredData[date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))))] as $key=>$value) { ?>
                                <tr>
                                    <td><?php echo $value['id']; ?></td>
                                    <!-- <td><?php //echo date("d/m/Y",strtotime($value['expdate'])); ?></td> -->
                                    <td><?php echo $value['pstatus']; ?></td>
                                    <td><?php echo $value['pmonth']; ?></td>
                                    <td>
                                        <a target="_blank" href="https://web.whatsapp.com/send/?phone=%2B91<?php echo $value['mobile'];?>&text=<?php echo $value['business_name'];?>&app_absent=0">    
                                            <?php echo $value['mobile']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $value['business_name']; ?></td>
                                    <td><?php echo date("d/m/Y H:i",strtotime($value['last_login'])); ?></td>
                                    <td>
                                        <a class="mb-xs mt-xs  user_profile" id="<?php echo $value['id'];?>">
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="View Profile">
                                                <i class="fa fa-user"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php } } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-6 col-xs-6">
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">After 1 Days Expire (<?php echo date('d/m/Y', strtotime('+1 day', strtotime(date('Y-m-d'))))?>) - (<?php echo (!empty($planExpiredData))?($planExpiredData[date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d'))))])?count($planExpiredData[date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d'))))]):"0":"";?>)</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>Date</th> -->
                                    <th>Plan</th>
                                    <th>Month</th>
                                    <th>Mobile</th>
                                    <th>B Name</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($planExpiredData)){ foreach ($planExpiredData[date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d'))))] as $key=>$value) { ?>
                                <tr>
                                    <td><?php echo $value['id']; ?></td>
                                    <!-- <td><?php //echo date("d/m/Y",strtotime($value['expdate'])); ?></td> -->
                                    <td><?php echo $value['pstatus']; ?></td>
                                    <td><?php echo $value['pmonth']; ?></td>
                                    <td>
                                        <a target="_blank" href="https://web.whatsapp.com/send/?phone=%2B91<?php echo $value['mobile'];?>&text=<?php echo $value['business_name'];?>&app_absent=0">    
                                            <?php echo $value['mobile']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $value['business_name']; ?></td>
                                    <td><?php echo date("d/m/Y H:i",strtotime($value['last_login'])); ?></td>
                                    <td>
                                        <a class="mb-xs mt-xs  user_profile" id="<?php echo $value['id'];?>">
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="View Profile">
                                                <i class="fa fa-user"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php } }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        
    </div>
    <!-- Next Schedule List -->                                
    <div class="row">
        <div class="col-md-6 col-ms-12">
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Next Schedule List</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mobile</th>
                                    <th>B Mobile</th>
                                    <th>B Name</th>
                                    <th>Service</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6 col-ms-12">
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Today Schedule List</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Plan</th>
                                    <th>Mobile</th>
                                    <th>B Name</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        
    </div>
    <!-- package and review verify status pending -->                                 
    <div class="row">
        <div class="col-md-6 col-ms-12">
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Package Verify Status List</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mobile</th>
                                    <th>B Mobile</th>
                                    <th>ScreenShort</th>
                                    <th>Package</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6 col-ms-12">
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Review Verify Status List</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mobile</th>
                                    <th>B Mobile</th>
                                    <th>ScreenShort</th>
                                    <th>Package</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        
    </div>
</section>
