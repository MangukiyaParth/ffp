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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Lead List</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url('admin/telesales/index')?>">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <textarea placeholder="Enter Version Code" class="form-control" name="version"></textarea>
                                    </div>
                                    <br />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group" style="float: right;">
                                    <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>

