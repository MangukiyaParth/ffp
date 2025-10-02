<style>
.text-red-color {
    color: red;
    font-weight: 900;
}
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Assign Logs</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Home</span></li>
                <li><span>Assign Logs</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-6 col-lg-12 col-xl-6">
            <section class="">
                <div class="row">
                    <!--Category Wise Tamplate Count  -->
                    <div class="col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                </div>

                                <h2 class="panel-title">Assign Lead Logs</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none datatable-tabletools">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Sub Admin</th>
                                                <th>Version</th>
                                                <th>Filter Type</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Tele Sales</th>
                                                <th>Total Assign</th>
                                                <th>created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $totalAssignCount=0; foreach ($list as $value) {  
                                                $totalAssignCount =  $totalAssignCount+$value['total_assign'];                                          ?>
                                            <tr id="rem_<?php echo $value['log_id']?>">
                                                <td><?php echo $value['log_id']; ?></td>
                                                <td><?php echo $value['subAdmin']; ?></td>
                                                <td><?php echo $value['version']; ?></td>
                                                <td><?php echo $value['type']; ?></td>
                                                <td><?php echo ($value['start_date']!="All")?date("d/m/Y",strtotime($value['start_date'])):""; ?></td>
                                                <td><?php echo ($value['end_date']!="All")?date("d/m/Y",strtotime($value['end_date'])):""; ?></td>
                                                <td><?php echo $value['teleSales']; ?></td>
                                                <td><?php echo $value['total_assign']; ?></td>
                                                <td><?php echo date("d/m/Y h:i:s",strtotime($value['created_at'])); ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfooter>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><b>Total</b></td>
                                                <td><b><?php echo $totalAssignCount;?></b></td>
                                                <td></td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>

    </div>
</section>
