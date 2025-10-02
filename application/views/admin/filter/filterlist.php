<section role="main" class="content-body">
    <header class="page-header">
        <h2>User List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">User List</span></li>
            </ol>
            <span class="listname" style="display: none;">Usaer List - <?php echo 'V-'.$versioncode.'-T-'.$type.'-S-'.$start.'-E-'.$end.'-C';?>/0,1,2,3,4,5,6,7/0,1,2,3,4,5,6,7</span>
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

                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;User List

                        <!-- <a href="<?php //echo ADMIN_URL . 'users/addusers/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> 
                        <span> &nbsp;Add User</span></a> -->

                    </h2>

                </header>
                <div class="panel-body">
                    <div class="row">
                        <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url('admin/filters/index')?>" id="">
                            <!-- filterGetData -->
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
                                            <option value="">--- Select ---</option>
                                            <option value="1">Free User</option>
                                            <option value="2">Plan Active</option>
                                            <option value="3">Plan Expired</option>
                                            <option value="4">Trial Active</option>
                                            <option value="5">Trial Expried</option>
                                            <option value="6">Free User Wise Post Count</option>
                                            <option value="7">Paid User Wise Post Count</option>
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
                                        <input type="date" name="end_date" value="<?php echo $cut_dt_time;?>" id="end_date" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
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
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped mb-none">
                                    <thead>
                                        <tr>
                                            <th>Version (V)</th>
                                            <th>Type (T)</th>
                                            <th>Start Date (S)</th>
                                            <th>End Date (E)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th><?php echo $versioncode;?></th>
                                            <th><?php echo $type;?></th>
                                            <th><?php echo $start;?></th>
                                            <th><?php echo $end;?></th>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="">
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
                                        <th>Expiry</th>
                                        <th>Total Post</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($list);
                                    foreach($list as $l){ ?>
                                    <tr>
                                        <td><?php echo $l->id;?></td>
                                        <td><?php echo $l->app_version;?></td>
                                        <td><?php echo $l->business_name;?></td>
                                        <td><?php echo $l->email;?></td>
                                        <td>
                                            <!-- <a target="_blank" href="https://api.whatsapp.com/send/?phone=%2B91<?php //echo $l->mobile;?>&text=&app_absent=0"> -->
                                                <?php echo "91".str_replace(' ', '', $l->mobile);;?>
                                            <!-- </a> -->
                                        </td>
                                        <td><?php echo userPaidStatus($l->ispaid,$l->planStatus);?></td>
                                        <td><?php echo $l->expdate;?></td>
                                        <td><?php echo $l->tamp_count;?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>

                            </table>

                        </div>

                    </div>

            </section>

        </div>

    </div>



    <!-- end: page -->

</section>
