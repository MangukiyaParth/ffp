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
        <h2>Whatsapp Camping Details</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Whatsapp Camping Details</span></li>
            </ol>
            <span class="listname" style="display: none;">Whatsapp Camping Details/0,1,2/0,1,2</span>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Whatsapp Camping Details (<?php echo count($list); ?>)
                        <a href="<?php echo ADMIN_URL . 'whatsappbulk/list' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> 
                            <span> &nbsp;WhatsApp Bulk List</span>
                        </a>
                    </h2>
                    <!-- <a href="<?php //echo ADMIN_URL . 'whatsappbulk' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> 
                        <span> &nbsp;Send WhatsApp Bulk</span>
                    </a> -->
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>Log ID</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Session</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($list as $key) {
                                    
                                    $countTime = countHour($key['created_at']); 
                                    $status = "Free";
                                    if($key['id']==null && $key['ispaid']==null && $key['planStatus']==null && $key['business_name']==null){
                                        $status = "Not Register";
                                    }else{
                                        if($key['ispaid']==1 && $key['planStatus']==2){
                                            $status = "Paid";
                                        }
                                    }
                                    
                                ?>
                                <tr id="<?php echo $key['wlog_id']; ?>">
                                    <td><?php echo $key['wlog_id'] ?></td>
                                    <td><?php echo $key['business_name'] ?></td>
                                    <td><?php echo $key['mobile'] ?></td>
                                    <td>
                                        <i class="<?php echo ($countTime['status'])?"timeSessionActive":"timeSessionDeactive"; ?>">
                                            <?php echo $countTime['time']; ?>
                                        </i>
                                    </td>
                                    <td><?php echo $status; ?></td>
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
