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
i.timeSessionRetarget {
    background-color: #EFA740;
    padding: 7px;
    color: white;
}
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>WhatsApp Bulk List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">WhatsApp Bulk List</span></li>
            </ol>
            <span class="listname" style="display: none;">WhatsApp Camping Session Close List/0,1,2,3,4/0,2,3,4</span>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; WhatsApp New Camping List (<?php echo count($list["new"]); ?>) 
                        <a href="<?php echo ADMIN_URL . 'whatsappbulk' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> 
                            <span> &nbsp;Send WhatsApp Bulk</span>
                        </a>
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>Cam ID</th>
                                    <th>Date</th>
                                    <th>Retarget</th>
                                    <th>Camping</th>
                                    <th>Template</th>
                                    <th>Type</th>
                                    <th>Active Session</th>
                                    <th>Total Send</th>
                                    <th>Delivery</th>
                                    <th>Read</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list['new'] as $key) {
                                    $countTime = countHour($key['created_at']); 
                                    $session_active = ""; 
                                    if($key['retarget']==1 || $key['retarget']==2){
                                        $session_active = "timeSessionRetarget";
                                    }elseif($countTime['status']){
                                        $session_active = "timeSessionActive";
                                    }else{
                                        $session_active = "timeSessionDeactive";
                                    }  
                                    
                                    if($key['retarget']==1){
                                        $retargetva = "Retarget"; 
                                    }elseif($key['retarget']==2){
                                        $retargetva = "Defult Target"; 
                                    }else{
                                        $retargetva = "";
                                    }
                                ?>
                                <tr id="<?php echo $key['cam_id']; ?>">
                                    <td><?php echo $key['cam_id'] ?></td>
                                    <td><?php echo date("d/m/Y H:i",strtotime($key['created_at'])); ?></td>
                                    <td><?php echo $retargetva; ?></td>
                                    <td><?php echo $key['cam_title']; ?></td>
                                    <td><?php echo $key['template']; ?></td>
                                    <td><?php echo $key['type']; ?></td>
                                    <td>
                                        <i class="<?php echo $session_active; ?>">
                                            <?php echo $countTime['time']; ?>
                                        </i>
                                    </td>
                                    <td><?php echo $key['total_send']; ?></td>
                                    <td><?php //echo $key['status']; ?></td>
                                    <td><?php //echo $key['status']; ?></td>
                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'whatsappbulk/camsublist/' . $key['cam_id']; ?>" target="_blank">
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="View">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                        <?php /* if($key['total_send']<= 0){ */?>
                                            <a href="javascript:void(0)" id="<?php echo $key['cam_id']; ?>" onclick="deleterecord(this.id,'whatsappbulk/deletecamp');">
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </a>
                                        <?php /* } */?>
                                    </td>
                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </section>
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title">
                        <a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; WhatsApp Retarget Camping List (<?php echo count($list['retarget']); ?>) 
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
                                    <th>Cam ID</th>
                                    <th>Date</th>
                                    <th>Retarget</th>
                                    <th>Camping</th>
                                    <th>Template</th>
                                    <th>Type</th>
                                    <th>Active Session</th>
                                    <th>Total Send</th>
                                    <th>Delivery</th>
                                    <th>Read</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list['retarget'] as $key) {
                                    $countTime = countHour($key['created_at']); 
                                    $session_active = ""; 
                                    if($key['retarget']==1 || $key['retarget']==2){
                                        $session_active = "timeSessionRetarget";
                                    }elseif($countTime['status']){
                                        $session_active = "timeSessionActive";
                                    }else{
                                        $session_active = "timeSessionDeactive";
                                    }  
                                    
                                    if($key['retarget']==1){
                                        $retargetva = "Retarget"; 
                                    }elseif($key['retarget']==2){
                                        $retargetva = "Defult Target"; 
                                    }else{
                                        $retargetva = "";
                                    }
                                ?>
                                <tr id="<?php echo $key['cam_id']; ?>">
                                    <td><?php echo $key['cam_id'] ?></td>
                                    <td><?php echo date("d/m/Y H:i",strtotime($key['created_at'])); ?></td>
                                    <td><?php echo $retargetva; ?></td>
                                    <td><?php echo $key['cam_title']; ?></td>
                                    <td><?php echo $key['template']; ?></td>
                                    <td><?php echo $key['type']; ?></td>
                                    <td>
                                        <i class="<?php echo $session_active; ?>">
                                            <?php echo $countTime['time']; ?>
                                        </i>
                                    </td>
                                    <td><?php echo $key['total_send']; ?></td>
                                    <td><?php //echo $key['status']; ?></td>
                                    <td><?php //echo $key['status']; ?></td>
                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'whatsappbulk/camsublist/' . $key['cam_id']; ?>" target="_blank">
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="View">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                        <?php /* if($key['total_send']<= 0){ */ ?>
                                            <a href="javascript:void(0)" id="<?php echo $key['cam_id']; ?>" onclick="deleterecord(this.id,'whatsappbulk/deletecamp');">
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </a>
                                        <?php /* } */?>
                                    </td>
                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </section>
            <section class="panel panel-collapsed">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title">
                        <a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; WhatsApp Defult Camping List (<?php echo count($list['defult']); ?>) 
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
                                    <th>Cam ID</th>
                                    <th>Date</th>
                                    <th>Retarget</th>
                                    <th>Camping</th>
                                    <th>Template</th>
                                    <th>Type</th>
                                    <th>Active Session</th>
                                    <th>Total Send</th>
                                    <th>Delivery</th>
                                    <th>Read</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list['defult'] as $key) {
                                    $countTime = countHour($key['created_at']); 
                                    $session_active = ""; 
                                    if($key['retarget']==1 || $key['retarget']==2){
                                        $session_active = "timeSessionRetarget";
                                    }elseif($countTime['status']){
                                        $session_active = "timeSessionActive";
                                    }else{
                                        $session_active = "timeSessionDeactive";
                                    }  
                                    
                                    if($key['retarget']==1){
                                        $retargetva = "Retarget"; 
                                    }elseif($key['retarget']==2){
                                        $retargetva = "Defult Target"; 
                                    }else{
                                        $retargetva = "";
                                    }
                                ?>
                                <tr id="<?php echo $key['cam_id']; ?>">
                                    <td><?php echo $key['cam_id'] ?></td>
                                    <td><?php echo date("d/m/Y H:i",strtotime($key['created_at'])); ?></td>
                                    <td><?php echo $retargetva; ?></td>
                                    <td><?php echo $key['cam_title']; ?></td>
                                    <td><?php echo $key['template']; ?></td>
                                    <td><?php echo $key['type']; ?></td>
                                    <td>
                                        <i class="<?php echo $session_active; ?>">
                                            <?php echo $countTime['time']; ?>
                                        </i>
                                    </td>
                                    <td><?php echo $key['total_send']; ?></td>
                                    <td><?php //echo $key['status']; ?></td>
                                    <td><?php //echo $key['status']; ?></td>
                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'whatsappbulk/camsublist/' . $key['cam_id']; ?>" target="_blank">
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="View">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                        <?php /* if($key['total_send']<= 0){ */ ?>
                                            <a href="javascript:void(0)" id="<?php echo $key['cam_id']; ?>" onclick="deleterecord(this.id,'whatsappbulk/deletecamp');">
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </a>
                                        <?php /* } */?>
                                    </td>
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
