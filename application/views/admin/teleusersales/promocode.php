<style>
.text-red-color {
    color: red;
    font-weight: 900;
}
.h2_title{
    margin-left: 18px !important;
    font-weight: 700;
}
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Promo Code</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Home</span></li>
                <li><span>Promo Code</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- promo code active and expired -->                               
    <div class="row">
        <div class="col-md-12 col-ms-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Promo Code List (<?php echo $promoCodeData['promo'];?>)</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url('admin/teleUserSales/promocode')?>">
                            <div class="col-md-12">
                                <div class="col-md-4 col-xs-12">
                                    <label class="control-label">Select Filter Type</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <select class="form-control" name="promo_filter_type" id="promo_filter_type">
                                            <option value="1">All</option>
                                            <option value="2">Active Promo</option>
                                            <option value="3">Expried Promo</option>
                                            <option value="4">Today Expire</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label class="control-label">Start Date</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label class="control-label">End Date</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">&nbsp;</label>
                                    <div class="input-group" style="margin-top: -6px !important;">
                                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">&nbsp;&nbsp;Filter&nbsp;&nbsp;</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <?php 
                                    if($type==1){
                                        $ty = "All";
                                    }elseif($type==2){
                                        $ty = "Active Promo";
                                    }elseif($type==3){
                                        $ty = "Expried Promo";
                                    }elseif($type==4){
                                        $ty = "Today Expire";
                                    }else{
                                        $ty ="";
                                    }
                                    ?>
                                    <table class="table">
                                        <tr>
                                            <th>Filter Type: <?php echo ($ty);?></th>
                                            <th>Start Date: <?php echo ($start_date)?date("d/m/Y",strtotime($start_date)):"";?></th>
                                            <th>Start Date: <?php echo ($end_date)?date("d/m/Y",strtotime($end_date)):"";?></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mobile</th>
                                    <!--<th>B Mobile</th> -->
                                    <th>Business</th>
                                    <th>Paid</th>
                                    <th>Activeted</th>
                                    <th>Expired</th>
                                    <th>Last Login</th>
                                    <th>Promo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($promoCodeData['data'] as $key=>$subvalue) {  ?>
                                <tr>
                                    <td><?php echo $subvalue['id']; ?></td>
                                    <td>
                                        <a target="_blank" href="https://web.whatsapp.com/send/?phone=%2B91<?php echo $subvalue['mobile'];?>&text=<?php echo $subvalue['business_name'];?>&app_absent=0">    
                                            <?php echo $subvalue['mobile']; ?>
                                        </a>
                                    </td>
                                    <!-- <td><?php //echo $subvalue['b_mobile2']; ?></td> -->
                                    <td><?php echo $subvalue['business_name']; ?></td>
                                    <td><?php echo userPaidStatus($subvalue['ispaid'],$subvalue['planStatus']); ?></td>
                                    <td><?php echo date("d/m/Y",strtotime($subvalue['pdate'])); ?></td>
                                    <td><?php echo date("d/m/Y",strtotime($subvalue['expdate'])); ?></td>
                                    <td><?php echo date("d/m/Y H:i",strtotime($subvalue['last_login'])); ?></td>
                                    <td><?php echo $subvalue['pstatus']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        
    </div>
</section>
