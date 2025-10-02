<section role="main" class="content-body">
    <header class="page-header">
        <h2>OTP List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>

                <li><span class="">OTP List</span></li>
            </ol>
            <span class="listname" style="display: none;">OTP List/0,1,2,3,4,5/0,1,2,3,4,5</span>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;OTP List
                    </h2>
                </header>

                <div class="panel-body">
                    <div class="">
                        <!-- table-responsive -->
                        <table class="table table-bordered table-striped datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Mobile</th>
                                    <th>OTP</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($list){
                                    foreach($list as $item){
                                    ?>
                                <tr>
                                    <td><?php echo $item->sms_id;?></td>
                                    <td><?php echo $item->sms_date;?></td>
                                    <td><?php echo $item->sms_type;?></td>
                                    <td><?php echo $item->sms_mobile;?></td>
                                    <td><?php echo $item->otp;?></td>
                                    <td><?php echo $item->created_at;?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->

</section>
