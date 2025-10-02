<section role="main" class="content-body">
    <header class="page-header">
        <h2>User List (Lead)</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">User List (Lead)</span></li>
            </ol>
            <span class="listname" style="display: none;">User List (Lead) - <?php echo 'V-'.$versioncode.'-T-'.$type.'-S-'.$start.'-E-'.$end.'-C';?>/1,2,3,4,5,6,7,8/1,2,3,4,5,6,7,8</span>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>

        </div>

    </header>
<?php 
$cut_dt_time = strftime('%Y-%m-%d', time());
$cut_time = strftime('%H:%M', time());
/* print_r($dataResumt); */
?>
    <!-- start: page -->

    <div class="row">
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Lead List
                        <!-- <a href="<?php //echo ADMIN_URL . 'users/addusers/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> 
                        <span> &nbsp;Add User</span></a> -->
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url('admin/telesales/index')?>">
                            <!-- filterGetData -->
                            <!-- <div class="col-md-12">
                                <div class="col-md-2" style="width: 140px !important;">
                                    <div class="input-group">
                                        <div class="input-group">
                                            <h4><b>Report Type</b></h4>
                                        </div>
                                    </div>
                                    <br />
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="imgsend" value="0">No
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="imgsend" checked value="1">Yes
                                            </label>
                                        </div>
                                    </div>
                                    <br />
                                </div>
                            </div> -->

                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" placeholder="Enter Version Code" class="form-control" name="version" id="version">
                                    </div>
                                    <br />
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select class="form-control" name="type" id="type">
                                            <!-- <option value="">--- Select ---</option> -->
                                            <!-- <option value="2">Total Package Paid User</option> -->
                                            <option value="1">Free User</option>
                                            <option value="2">Plan Expried</option>
                                            <option value="3">Trial Active</option>
                                            <option value="4">Trial Expried</option>
                                            <!-- <option value="5">User Wise Post Count</option> -->
                                            <!-- <option value="6">New User - Not Paid</option> -->
                                            <!-- <option value="4">Without Logo</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="start_date" value="<?php echo $cut_dt_time;?>" id="start_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="end_date" id="end_date" value="<?php echo $cut_dt_time;?>" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="col-md-10">
                                <table class="table table-bordered table-striped mb-none">
                                    <tbody>
                                        <tr>
                                            <th>Version (V): <?php echo $versioncode;?></th>
                                            <th>Type (T): <?php echo $type;?></th>
                                            <th>Start Date (S): <?php echo $start;?></th>
                                            <th>End Date (E): <?php echo $end;?></th>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group" style="float: right;">
                                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">Filter</button>
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
                    <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url("admin/telesales/assignData");?>">
                    <input type="hidden" value="<?php echo $type;?>" name="l_type">
                    <input type="hidden" value="<?php echo $versioncode;?>" name="l_versioncode">
                    <input type="hidden" value="<?php echo $start;?>" name="l_start">
                    <input type="hidden" value="<?php echo $end;?>" name="l_end">
                        <div class="row">
                            <div class="col-md-1" style="width: 55px !important;">
                                <input type="checkbox" id="master" style="height: 30px;width: 30px;">
                            </div>
                            <div class="col-md-4">
                                <select name="telesales_user" class="form-control">
                                    <?php if($telesalesUser){
                                        foreach($telesalesUser as $teleus){ ?>
                                        <option value="<?php echo $teleus['id']?>"><?php echo $teleus['title'].' - '.$teleus['email'];?></option>
                                    <?php } }else{?>
                                        <option value="">-- Select --</option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" style="margin-bottom: 25px" class="btn btn-success">Assign Lead</button>
                            </div>
                            <div class="col-md-5">
                                <?php if($msg){ ?>
                                        <div class="alert alert-success">
                                        <strong>Success!</strong> <?php echo $msg;?>
                                        </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <!-- table-responsive -->
                            <table class="table table-bordered table-striped mb-none datatable-tabletools">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Version</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>mobile</th>
                                        <th>IsPaid</th>
                                        <th>Expired</th>
                                        <th>Total Post</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($list);
                                    foreach($list as $l){?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="sub_chk" name="cust_id[]" value="<?php echo $l->id;?>" width="12px">
                                            <?php echo $l->id;?>
                                        </td>
                                        <td><?php echo $l->app_version;?></td>
                                        <td><?php echo $l->business_name;?></td>
                                        <td><?php echo $l->email;?></td>
                                        <td><?php echo "91".str_replace(' ', '', $l->mobile);?></td>
                                        <td><?php echo userPaidStatus($l->ispaid,$l->planStatus);?></td>
                                        <td><?php echo ($l->expdate != null)?date("d-m-Y",strtotime($l->expdate)):"-";?></td>
                                        <td><?php echo $l->tamp_count;?></td>
                                        <td><?php echo date("d/m/Y H:i:s",strtotime($l->created_date));?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>

                            </table>

                        </div>
                    </form>
                    </div>

            </section>

        </div>

    </div>

    <!-- end: page -->

</section>

