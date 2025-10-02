<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sales User List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Sales User List</span></li>
            </ol>
            
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

                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Sales User List
                        <a href="<?php echo ADMIN_URL . 'users/addAdminUser' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i> 
                            <span> &nbsp;Add User</span>
                        </a>
                    </h2>

                </header>
                <div class="panel-body">
                   
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="">
                            <!-- table-responsive -->
                            <table class="table table-bordered table-striped mb-none">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="10%">Name</th>
                                        <th width="15%">Email</th>
                                        <th width="10%">Mobile</th>
                                        <th width="8%">Role</th>
                                        <th width="8%">Reg Date</th>
                                        <th width="8%">Status</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($list){ 
                                        foreach($list as $user){?>
                                    <tr>
                                        <td><?php echo $user['id']?></td>
                                        <td><?php echo $user['name']?></td>
                                        <td><?php echo $user['email']?></td>
                                        <td><?php echo $user['mobile']?></td>
                                        <td><?php echo $user['title']?></td>
                                        <td><?php echo date("d-m-Y H:i:s",strtotime($user['created_date']));?></td>
                                        <td><?php echo($user['status']==1)?'Active':'Deactive'?></td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL . 'telesales/telesalesprofile/' . $user['id']; ?>">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } }?>
                                </tbody>

                            </table>

                        </div>

                    </div>

            </section>

        </div>

    </div>



    <!-- end: page -->

</section>
