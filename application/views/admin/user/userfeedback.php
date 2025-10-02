<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Feedback List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>

                <li><span class="">User Feedback List</span></li>
            </ol>
            <span class="listname" style="display: none;">User Feedback List/0,1,2,3,4,5/0,1,2,3,4,5</span>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;User Feedback List
                    </h2>
                </header>

                <div class="panel-body">
                    <div class="">
                        <!-- table-responsive -->
                        <table class="table table-bordered table-striped  datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($list){
                                    foreach($list as $item){
                                    ?>
                                <tr id="<?php echo $item->feedid; ?>">
                                    <td><?php echo $item->feedid;?></td>
                                    <td><?php echo $item->business_name;?></td>
                                    <td><?php echo $item->mobile;?></td>
                                    <td><?php echo $item->subject;?></td>
                                    <td><?php echo $item->message;?></td>
                                    <td><?php echo ($item->created_at!='0000-00-00 00:00')?date('d/m/Y H:i',strtotime($item->created_at)):'-';?></td>
                                    <td>
                                    <a href="javascript:void(0)" id="<?php echo $item->feedid; ?>" onclick="deleterecord(this.id,'/users/feedbackDelete');"><button type="button"
                                                class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </a>  
                                </td>    
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
