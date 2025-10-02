<style>
i.timeSessionActive {
    background-color: #47a447;
    padding: 7px;
    color: white;
}
i.timeSessionDeactive {
    background-color: #0088cc;
    padding: 7px;
    color: white;
}
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>WhatsApp Auto Send Message List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>WhatsApp Auto Send Message List</span></li>
            </ol>
            <span class="listname" style="display: none;">WhatsApp Auto Send Message List/0,1/0,1</span>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; WhatsApp Auto Send Message List (<?php echo count($list); ?>) 
                        <!-- <a href="<?php //echo ADMIN_URL . 'whatsappbulk' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> 
                            <span> &nbsp;Send WhatsApp Bulk</span>
                        </a> -->
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>Log ID</th>
                                    <th>Date</th>
                                    <th>Mobile</th>
                                    <th>Cam Name</th>
                                    <th>Type</th>
                                    <th>Active Session</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $key) { 
                                $countTime = countHour($key['created_at']);    
                                ?>
                                <tr id="<?php echo $key['wlog_id']; ?>">
                                    <td><?php echo $key['wlog_id'] ?></td>
                                    <td><?php echo date("d/m/Y H:i",strtotime($key['created_at'])); ?></td>
                                    <td><?php echo $key['mobile'] ?></td>
                                    <td><?php echo $key['template']; ?></td>
                                    <td><?php echo $key['type']; ?></td>
                                    <td>
                                        <i class="<?php echo ($countTime['status'])?"timeSessionActive":"timeSessionDeactive"; ?>">
                                            <?php echo $countTime['time']; ?>
                                        </i>
                                    </td>
                                    <!--  <td>
                                        <a href="<?php //echo ADMIN_URL . 'whatsappbulk/viewcamping/' . $key['wlog_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="View">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="<?php //echo ADMIN_URL . 'whatsappbulk/viewcamping/' . $key['wlog_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Resend">
                                                <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </a>
                                    </td> -->
                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
