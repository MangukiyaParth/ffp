<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Transaction List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">User Transaction List</span></li>

            </ol>
            <span class="listname" style="display: none;">User Transaction List/0,1,2,3,4,5,6,7,8,9/0,1,2,3,4,5,6,7,8,9</span>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;User Transaction List
                        <!--  <a href="<?php echo ADMIN_URL . 'users/addusers/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> <span> &nbsp;Add User</span></a> -->
                    </h2>

                </header>
                <div class="panel-body">
                    <div class="row">
                        <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url('admin/users/usertransaction/');?>">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="start_date" value="<?php echo ($start_date!="")?$start_date:''?>" class="form-control">
                                    </div>
                                    <br />
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="end_date" value="<?php echo ($end_date!="")?$end_date:''?>" class="form-control">
                                    </div>
                                    <br />
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">Filter</button>
                                        <a href="<?php echo base_url('admin/users/usertransaction/');?>">
                                            <button type="button" class="mb-xs mt-xs mr-xs btn btn-danger">Reset</button>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="40%">Report Date</th>
                                                <th width="60%">
                                                    <?php echo ($start_date!="")?date('d/m/Y',strtotime($start_date)):''?> -
                                                    <?php echo ($end_date!="")?date('d/m/Y',strtotime($end_date)):''?>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- table-responsive -->
                        <table class="table table-bordered table-striped  datatable-tabletools">
                            <!--  id="userTransactionListServerSide" -->
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="15%">Name</th>
                                    <th width="10%">Mobile</th>
                                    <th width="8%">Tra Date</th>
                                    <th width="5%">Aamount</th>
                                    <th width="12%">Package Name</th>
                                    <th width="15%">Transaction No</th>
                                    <th width="5%">Status</th>
                                    <th width="5%">IsPaid</th>
                                    <th width="15%">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($list){
                                    $count=0;
                                    foreach($list as $item){
                                        $count = $count+$item->pamount;
                                    ?>
                                <tr>
                                    <td><?php echo $item->id;?></td>
                                    <td><?php echo $item->business_name;?></td>
                                    <td><?php echo $item->mobile;?></td>
                                    <td><?php echo ($item->pdate!='0000-00-00')?date('d/m/Y',strtotime($item->pdate)):'-';?></td>
                                    <td><?php echo $item->pamount;?></td>
                                    <td><?php echo $item->plan_name;?></td>
                                    <td><?php echo $item->ptransactionid;?></td>
                                    <td style="<?php echo($item->pstatus=='success')?'background-color: green;color: white;':'background-color: #bd0707;color: white;';?>"><?php echo $item->pstatus;?>
                                    </td>
                                    <td><?php echo($item->ispaid=="1")?'Paid':'Free';?></td>
                                    <td><?php echo ($item->created_at!='0000-00-00 00:00')?date('d/m/Y H:i',strtotime($item->created_at)):'-';?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                            <tfooter>
                                <td colspan="4" class="text-right"><b>Total</b></td>
                                <td><b><?php echo $count;?></b></td>
                                <td colspan="5"></td>
                            </tfooter>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->

</section>
