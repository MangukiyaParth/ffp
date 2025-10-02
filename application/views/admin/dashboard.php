<style>
.text-red-color {
    color: red;
    font-weight: 900;
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
        <div class="col-md-6 col-lg-12 col-xl-6">
            <section class="">
                <!-- 1 -->
                <?php if($this->session->userdata('role_code') == ROLE_ADMIN_CODE){ ?>
                
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
                                                    <strong class="amount"><?php echo $totalUser-1;?></strong><br />
                                                    <span class="text-danger">(<?php echo $totalDeactiveUser;?> Deactive)</span>
                                                    || <span class="text-danger">(<?php echo $totalTodayNewUser;?> Today)</span>
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
                                                    <strong class="amount"><?php echo $totalUserPost;?></strong><br />
                                                    <span class="text-success">(<?php echo $totalUserPostToday;?> Today Total Post)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a href="https://freefestivalpost.in/admin/Cronjob/deleteDaysAfterRemoveUserPost/mycustomapi321/Smaonr313ffp" target="_blank" class="text-muted text-uppercase">Clear Old Post</a> ||
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
                                                    <strong class="amount"><?php echo $videoanalytics;?></strong><br />
                                                    <span class="text-primary">(<?php echo $videoanalyticsToday;?> Today Total Videos)</span>
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

                <!-- 2 -->
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-xl-6 text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <section class="panel panel-featured-left panel-featured-primary ">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-photo"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total Tamplate</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $totalTamplate;?></strong><br />
                                                    <!-- <span class="text-primary">(<?php //echo $totalUserPostToday;?> Today Total Post)</span> -->
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a href="<?php echo ADMIN_URL . 'tamplate' ?>" class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>

                    <div class="col-md-4 col-lg-4 col-xl-6 text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <section class="panel panel-featured-left panel-featured-info">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-info">
                                                <i class="fa fa-photo"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total Positione</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $totalPositione;?></strong><br />
                                                    <!-- <span class="text-info">(<?php //echo $totalUserPostToday;?> Today Total Post)</span> -->
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a href="<?php echo ADMIN_URL . 'position' ?>" class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>

                    <div class="col-md-4 col-lg-4 col-xl-6 text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <section class="panel panel-featured-left panel-featured-warning">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-warning">
                                                <i class="fa fa-tag"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total Category</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $totalCategory;?></strong><br />
                                                    <!-- <span class="text-warning">(<?php //echo $totalUserPostToday;?> Today Total Post)</span> -->
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a href="<?php echo ADMIN_URL . 'category' ?>" class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>

                <!-- 3 -->
                <div class="row">

                    <div class="col-md-6 col-lg-6 col-xl-6 text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <section class="panel panel-featured-left panel-featured-danger">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-danger">
                                                <i class="fa fa-id-card"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total Premium User</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $totalPremiumUser['totalPremiumUser'];?></strong><br />
                                                    <span class="text-success">(<?php echo $totalPremiumUser['totalActivePremiumUser'];?> Active)</span> |
                                                    <span class="text-success">(<?php echo $totalPremiumUser['totalTodayPremiumUser'];?> Paid Today)</span> |
                                                    <span class="text-danger">(<?php echo $totalPremiumUser['totalExpiredTodayUser'];?> Expired Today)</span> |
                                                    <span class="text-danger">(<?php echo $totalPremiumUser['totalExpiredUser'];?> Total Expired)</span>
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

                    <div class="col-md-6 col-lg-6 col-xl-6 text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <section class="panel panel-featured-left panel-featured-success">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-success">
                                                <i class="fa fa-user-times"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total Trial User</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $totalTrialUser['totalTrialUser'];?></strong><br />
                                                    <span class="text-success">(<?php echo $totalTrialUser['totalActiveTrialUser'];?> Active)</span> |
                                                    <span class="text-success">(<?php echo $totalTrialUser['totalTodayTrialUser'];?> Trial Today)</span> |
                                                    <span class="text-danger">(<?php echo $totalTrialUser['totalExpiredTodayTrialUser'];?> Expired Today)</span> |
                                                    <span class="text-danger">(<?php echo $totalTrialUser['totalExpiredTrialUser'];?> Total Expired)</span>
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

                    <!--  <div class="col-md-4 col-lg-4 col-xl-6 text-center">
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
                                                <h4 class="title">Paid User Expired</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php //echo $totalExpirePckduser['totalExpPckUser'];?></strong><br />
                                                    <span class="text-primary">(<?php //echo $totalExpirePckduser['totalExpPckUserTodat'];?> Today)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a href="<?php //echo ADMIN_URL . 'users' ?>" class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div> -->

                </div>

                <?php } ?>

                <!--Today Festival List  -->
                <div class="row">
                    <div class="col-xs-12">
                        <section class="panel panel-collapsed">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>
                                <h2 class="panel-title">Today Festival Post List</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none datatable-tabletools">
                                        <thead>
                                            <tr>
                                                <th width="10%">No</th>
                                                <th width="10%">Date</th>
                                                <th width="10%">Cat ID</th>
                                                <th width="40%">Title</th>
                                                <th width="15%">Image</th>
                                                <th width="15%">Plan</th>
                                                <th width="15%">Thumb</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;if($todayFestivalPostList){ 
												foreach ($todayFestivalPostList as $key=>$value) { 
                                                $checkPlanExist = PUBPATH.'media/template/plan/'.$value['mslug'].'/'.$value['tid'].".jpg";
                                              ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value['event_date']; ?></td>
                                                <td><?php echo $value['mid']; ?></td>
                                                <td><?php echo $value['mtitle']; ?></td>
                                                <td>
                                                    <a target="_blank" href="<?php echo base_url('media/template/').$value['path']; ?>">
                                                        <img src="<?php echo base_url('media/template/').$value['path']; ?>" width="30%" />
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php  if(file_exists($checkPlanExist)){ ?>
                                                        <a target="_blank" href="<?php echo base_url('media/template/plan/').$value['mslug'].'/'.$value['tid'].".jpg"; ?>">
                                                            <img src="<?php echo base_url('media/template/plan/').$value['mslug'].'/'.$value['tid'].".jpg"; ?>" width="30%" />
                                                        </a>
                                                    <?php
                                                    }else{
                                                       echo "-";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php  if($value["planImgName"]!=""){ ?>
                                                        <a target="_blank" href="<?php echo base_url('media/template/plan/thumb/').$value['tid'].".jpg"; ?>">
                                                            <img src="<?php echo base_url('media/template/plan/thumb/').$value['tid'].".jpg"; ?>" width="25%" />
                                                        </a>
                                                    <?php }else{ ?>
                                                        <a target="_blank" href="<?php echo base_url('media/template/thumb/').$value['path']; ?>">
                                                            <img src="<?php echo base_url('media/template/thumb/').$value['path']; ?>" width="25%" />
                                                        </a>
                                                    <?php }?>
                                                </td>
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

                <!-- upcoming festival post list -->
                <div class="row">
                    <div class="col-xs-12">
                        <section class="panel panel-collapsed">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>
                                <h2 class="panel-title">UpComing Festival Post List</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none datatable-tabletools">
                                        <thead>
                                            <tr>
                                                <th width="10%">No</th>
                                                <th width="10%">Date</th>
                                                <th width="10%">Cat ID</th>
                                                <th width="40%">Title</th>
                                                <th width="15%">Image</th>
                                                <th width="15%">Plan</th>
                                                <th width="15%">Thumb</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;if($upComingFestivalPostList){ 
												foreach ($upComingFestivalPostList as $key=>$value) { 
                                                    $checkPlanExist = PUBPATH.'media/template/plan/'.$value['mslug'].'/'.$value['tid'].".jpg";
                                                ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value['event_date']; ?></td>
                                                <td><?php echo $value['mid']; ?></td>
                                                <td><?php echo $value['mtitle']; ?></td>
                                                <td>
                                                    <a target="_blank" href="<?php echo base_url('media/template/').$value['path']; ?>">
                                                        <img src="<?php echo base_url('media/template/').$value['path']; ?>" width="30%" />
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php  if(file_exists($checkPlanExist)){ ?>
                                                        <a target="_blank" href="<?php echo base_url('media/template/plan/').$value['mslug'].'/'.$value['tid'].".jpg"; ?>">
                                                            <img src="<?php echo base_url('media/template/plan/').$value['mslug'].'/'.$value['tid'].".jpg"; ?>" width="35%" />
                                                        </a>
                                                    <?php
                                                    }else{
                                                       echo "-";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php  if($value["planImgName"]!=""){ ?>
                                                        <a target="_blank" href="<?php echo base_url('media/template/plan/thumb/').$value['tid'].".jpg"; ?>">
                                                            <img src="<?php echo base_url('media/template/plan/thumb/').$value['tid'].".jpg"; ?>" width="25%" />
                                                        </a>
                                                    <?php }else{ ?>
                                                        <a target="_blank" href="<?php echo base_url('media/template/thumb/').$value['path']; ?>">
                                                            <img src="<?php echo base_url('media/template/thumb/').$value['path']; ?>" width="25%" />
                                                        </a>
                                                    <?php }?>
                                                </td>
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


                <div class="row">
                    <!-- App Version Wise User Count -->
                    <div class="col-xs-3 col-md-3">
                        <section class="panel panel-collapsed">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>
                                <h2 class="panel-title">App Version Count</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Version Code</th>
                                            <th>Total User</th>
                                        </tr>
                                        <?php $i=1;$totalVersionWiseUser=0;
                                            if($versionwiseUserCount){ 
                                                foreach($versionwiseUserCount as $versionUser){ ?>
                                                <tr>
                                                    <td><?php echo $versionUser['app_version'];?></td>
                                                    <td><?php echo $versionUser['totalUser'];?></td>
                                                </tr>
                                                <?php 
                                                    $i++;
                                                    $totalVersionWiseUser = $totalVersionWiseUser + $versionUser['totalUser'];
                                                } }else{ ?>
                                                    <tr>
                                                        <td colspan="2">No record found!..</td>
                                                    </tr>
                                                <?php }?>
                                            <tr>
                                                <th>Total</th>
                                                <th><b><?php echo $totalVersionWiseUser;?></b></th>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- Videos Analytics Last 7 Days -->
                    <div class="col-xs-3 col-md-3">
                        <section class="panel panel-collapsed">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>
                                <h2 class="panel-title">Videos Analytics Last - 7 Days</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="10%">No</th>
                                                <th width="40%">Date</th>
                                                <th width="50%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;if($videoanalyticsLast7Days){ 
												foreach ($videoanalyticsLast7Days as $key=>$value) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value['va_date']; ?></td>
                                                <td><?php echo $value['ca_count']; ?></td>
                                            </tr>
                                            <?php $i++;
											} } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="col-xs-6 col-md-6">
                        <section class="panel panel-collapsed">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>
                                <h2 class="panel-title">Daily Crone Job Report</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Function</th>
                                                <th>Title</th>
                                                <th>Type</th>
                                                <th>Count</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($croneReportFetch){ 
												foreach ($croneReportFetch as $key=>$value) { ?>
                                            <tr>
                                                <td><?php echo $value['crone_id']; ?></td>
                                                <td><?php echo $value['crone_funcation']; ?></td>
                                                <td><?php echo $value['crone_title']; ?></td>
                                                <td><?php echo $value['crone_type']; ?></td>
                                                <td><?php echo $value['crone_count']; ?></td>
                                                <td><?php echo $value['created_at']; ?></td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- 7 Days User Analytics -->
                   <!--  <div class="col-xs-5">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>
                                <h2 class="panel-title">User Analytics Last - 7 Days </h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Date</th>
                                            <th>New</th>
                                            <th>Active</th>
                                            <th>Impression</th>
                                            <th>Updated Date</th>
                                        </tr>
                                        <?php /* if($analytics){?>
                                        <?php foreach($analytics as $analy){?>
                                        <tr>
                                            <td><?php echo ($analy['c_date']!="0000-00-00")?date('d/m/Y',strtotime($analy['c_date'])):'';?></td>
                                            <td><?php echo $analy['new'];?></td>
                                            <td><?php echo $analy['active'];?></td>
                                            <td><?php echo $analy['impression'];?></td>
                                            <td><?php echo ($analy['updated_at']!="0000-00-00")?date('d/m/Y H:i',strtotime($analy['updated_at'])):'';?></td>
                                        </tr>
                                        <?php }?>
                                        <?php }else{?>
                                        <tr>
                                            <td colspan="5">No record found!..</td>
                                        </tr>
                                        <?php } */?>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div> -->
                </div>

                <div class="row">
                    <!--Category Wise Tamplate Count  -->
                    <div class="col-xs-6">
                        <section class="panel panel-collapsed">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>

                                <h2 class="panel-title">Category Wise Tamplate Count</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Category</th>
                                                <th>Total Post</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach ($totalTamplateCategoryWise as $key=>$value) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value['event_date']; ?></td>
                                                <td><?php echo $value['mtitle']; ?></td>
                                                <td><?php echo $value['totalPost']; ?></td>
                                            </tr>
                                            <?php $i++;} ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!--Category Wise Photos Count  -->
                    <div class="col-xs-6">
                        <section class="panel panel-collapsed">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>

                                <h2 class="panel-title">Category Wise Photos Count</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none datatable-tabletools" id="">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Category</th>
                                                <th>Total Photo</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;$count=0; foreach ($totalPhotoCategoryWise as $key=>$value) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value['pcat_title']; ?></td>
                                                <td><?php echo $value['totalPhoto']; ?></td>
                                            </tr>
                                            <?php $i++;
												$count=$count+$value['totalPhoto'];
											} ?>

                                        </tbody>
                                        <tfooter>
                                            <tr>
                                                <td colspan="2">Total</td>
                                                <td><?php echo $count;?></td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <?php if($this->session->userdata('role_code') == ROLE_ADMIN_CODE){ ?>
                <!-- subscription user list -->
                <div class="row">
                    <!--Paid User  -->
                    <div class="col-xs-6">
                        <section class="panel panel-collapsed">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>

                                <h2 class="panel-title">Paid User Last - 10</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Mobile</th>
                                                <th>Transaction</th>
                                                <th>Price</th>
                                                <th>Month</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach ($todayPaidSubscriptionUser as $key=>$value) { ?>
                                            <tr>
                                                <td><?php echo $value['pid']; ?></td>
                                                <td><?php echo $value['created_at']; ?></td>
                                                <td><?php echo $value['mobile']; ?></td>
                                                <td><?php echo $value['ptransactionid']; ?></td>
                                                <td><?php echo $value['pprice']; ?></td>
                                                <td><?php echo $value['pmonth']; ?></td>
                                            </tr>
                                            <?php $i++;} ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!--Category Wise Photos Count  -->
                    <div class="col-xs-6">
                        <section class="panel panel-collapsed">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>

                                <h2 class="panel-title">Trial User Last - 10</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Mobile</th>
                                                <th>Transaction</th>
                                                <th>Price</th>
                                                <th>Plan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach ($todayTrialSubscriptionUser as $key=>$value) { ?>
                                            <tr>
                                                <td><?php echo $value['pid']; ?></td>
                                                <td><?php echo $value['created_at']; ?></td>
                                                <td><?php echo $value['mobile']; ?></td>
                                                <td><?php echo $value['ptransactionid']; ?></td>
                                                <td><?php echo $value['pprice']; ?></td>
                                                <td><?php echo $value['pmonth']; ?></td>
                                            </tr>
                                            <?php $i++;} ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <?php } ?>

                <?php if($this->session->userdata('role_code') == ROLE_ADMIN_CODE){ ?>
                <!-- subscription user list -->
                <div class="row">
                    <!--Paid User  -->
                    <div class="col-md-9 col-ms-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>

                                <h2 class="panel-title">Custom Report</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Post</th>
                                                <th>Video</th>
                                                <th>Register</th>
                                                <th>Paid</th>
                                                <th>Fail</th>
                                                <th>Trile</th>
                                                <th>Revenew</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach ($customReport as $key=>$value) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $key; ?></td>
                                                <td><?php echo $value['totalPost']; ?></td>
                                                <td><?php echo $value['totalVideoCreate']; ?></td>
                                                <td><?php echo $value['totalRegister']; ?></td>
                                                <td><?php echo $value['totalSub']; ?></td>
                                                <td><?php echo $value['totalFail']; ?></td>
                                                <td><?php echo $value['totalTrial']; ?></td>
                                                <td><?php echo $value['totalRevenew']; ?></td>
                                            </tr>
                                            <?php $i++;} ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-3 col-ms-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>

                                <h2 class="panel-title">SMS Log</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Forgot</th>
                                                <th>Signup</th>
                                                <th>Uniqu Signup</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $i=1; foreach (array_reverse($smsOtpCountDateWise) as $key=>$value) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value['sms_date']; ?></td>
                                                <td><?php echo $value['total_forgot_sms']; ?></td>
                                                <td><?php echo $value['total_singup_sms']; ?></td>
                                                <td><?php echo $value['total_unique_singup_sms']; ?></td>
                                            </tr>
                                            <?php $i++;}  ?>

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
