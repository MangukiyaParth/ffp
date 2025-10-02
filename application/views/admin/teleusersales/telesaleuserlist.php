<section role="main" class="content-body">
    <header class="page-header">
        <h2>Lead List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Lead List</span></li>
            </ol>
            <span class="listname" style="display: none;">Lead List /0,1,2,3,4,5,6/0,1,2,3,4,5,6</span>
            <a>&nbsp;</a>

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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Lead List </h2>
                </header>

                <div class="panel-body">
                    <div class="row">
                        <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url('admin/teleUserSales')?>">
                            <div class="col-md-12">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="date" name="start_date" id="start_date" class="form-control"  value="<?php echo date('Y-m-01'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <div class="input-group" style="margin-top: -6px !important;">
                                            <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">&nbsp;&nbsp;Filter&nbsp;&nbsp;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <ul class="nav nav-tabs">
                    <?php if($list){
                        $active1 = "";
                        $y=0;
                        foreach($list as $key=>$res){ 
                            $active1 = $y==0?'active':'';?>
                        <li class="<?php echo $active1;?>"><a class="<?php echo $active1;?>" data-toggle="tab" href="#<?php echo str_replace(' ', '', $key);?>"><?php echo $key; echo " <b>(".count($list[$key]).")</b>";?></a></li>
                    <?php $y++; } }else{ ?>
                        <li class="active"><a class="active" data-toggle="tab" href="#nodata">No Data Found!</a></li>
                    <?php } ?>
                    
                </ul>


                <div class="tab-content">
                    
                <?php if($list){
                        $active = "";
                        $i=0;
                        foreach($list as $key => $res){ 
                            $active = $i==0?'active':'';?>
                            <div id="<?php echo str_replace(' ', '', $key);?>" class="tab-pane fade in <?php echo $active;?>">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped mb-none datatable-tabletools">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>View</th>
                                                        <th>Logo</th>
                                                        <th>Mobile</th>
                                                        <th>B. Mobile</th>
                                                        <th>B. Name</th>
                                                        <!-- <th>Open Time</th> -->
                                                        <th>Comment</th>
                                                        <th>Schedule</th>
                                                        <th>Interested %</th>
                                                        <th>IsPaid</th>
                                                        <th>Post</th>
                                                        <th>Last Login</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $k=0; foreach($list[$key] as $r){ ?>
                                                        <tr id="<?php echo $r['lead_assign_id'];?>">
                                                            <td><?php echo $r['lead_assign_id'];?></td>
                                                            <td>
                                                                <div class="btn-group cutom_btn">
                                                                    <?php if($r['lead_status_id'] == 1){ ?>
                                                                        <a target="_blank" class="mb-xs mt-xs" onclick="openMobileConfirm(<?php echo $r['lead_assign_id']; ?>,<?php echo $r['id']; ?>)">
                                                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" title="View">
                                                                                <i class="fa fa-eye"></i>
                                                                            </button>
                                                                        </a>
                                                                    <?php }else{ ?>
                                                                        <a target="_blank" class="mb-xs mt-xs" href="<?php echo base_url("admin/teleUserSales/leadOpenViewPage/").$r['id'].'/'.$r['lead_assign_id'];?>">
                                                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" title="View">
                                                                                <i class="fa fa-eye"></i>
                                                                            </button>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php if($r['lead_status_id'] != 1){ ?>
                                                                    <div class="btn-group cutom_btn">
                                                                    <a target="_blank" href="https://web.whatsapp.com/send/?phone=%2B91<?php echo $r['mobile'];?>&text=<?php echo $r['name'];?>&app_absent=0">   
                                                                            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="View">
                                                                                <i class="fa fa-whatsapp"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                <?php } ?>
                                                            </td>
                                                            
                                                            
                                                            <td>
                                                            <?php
                                                                if($r['photo'] !="" && $r['photo'] !=null){
                                                                    $logo_img_url = FCPATH."media/logo/".$r['photo'];  
                                                                    if(file_exists($logo_img_url)){
                                                                        $logo_img_url = base_url("media/logo/").$r['photo']; 
                                                                    ?>
                                                                        <img src="<?php echo $logo_img_url;?>" alt="Admin" class="rounded-circle" width="80">
                                                                    <?php 
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <?php if($r['lead_status_id'] != 1){ ?>
                                                                    <td><a href="tel:<?php echo $r['mobile'];?>"><?php echo $r['mobile'];?></a> </td>
                                                                    <td><a href="tel:<?php echo $r['b_mobile2'];?>"><?php echo $r['b_mobile2'];?></a></td>
                                                            <?php }else{?>
                                                                    <td><?php echo $r['mobile'];?></td>
                                                                    <td><?php echo $r['b_mobile2'];?></td>
                                                            <?php }?>
                                                            <td><?php echo $r['business_name'];?></td>
                                                            <!-- <td><?php //echo ($r['open_status_time']!=null)?date("d-m-Y H:i",strtotime($r['open_status_time'])):'';?></td> -->
                                                            <td><?php echo $r['messages'];?></td>
                                                            <td><?php echo $r['next_schedule_date'];?></td>
                                                            <td><?php echo $r['client_percentage'];?></td>
                                                            <td><?php echo userPaidStatus($r['ispaid'],$r['planStatus']);?></td>
                                                            <td><?php echo $r['totalUserPost'];?></td>
                                                            <td><?php echo ($r['last_login']!="" && $r['last_login']!="0000-00-00 00:00:00")?date("d-m-Y H:i",strtotime($r['last_login'])):"";?></td>
                                                            
                                                        </tr>
                                                    <?php $k++; } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php $i++; } }else{?>
                        <div id="nodata" class="tab-pane fade in active">
                            <h4><center>No Data Found!....</center></h4>
                        </div>
                    <?php }?>
                </div>


            </section>
        </div>
    </div>
    <!-- end: page -->
</section>

