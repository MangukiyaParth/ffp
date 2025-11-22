<section role="main" class="content-body">
    <header class="page-header">
        <h2>User List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">User List</span></li>
            </ol>
            <span class="listname" style="display: none;">User List/0,1,2,4,5,8/0,1,2,4,5,8</span>
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

                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;User List
                        <a href="<?php echo ADMIN_URL . 'users/addusers/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> <span> &nbsp;Add
                                User</span></a>
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <form class="form-horizontal form-bordered" action="" id="form-filter">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" placeholder="Enter Version Code" class="form-control" name="version" id="version">
                                    </div>
                                    <br />
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select class="form-control" name="type" id="type">
                                            <!-- <option value="1">New User</option>
                                            <option value="2">Paid User</option>
                                            <option value="3">Without Logo</option>
                                            <option value="4">Expired User</option> -->
                                            <option value="">--- Select ---</option>
                                            <option value="1">New User</option>
                                            <option value="2">Total Package Paid User</option>
                                            <option value="6">Total Package Expried User</option>
                                            <option value="3">Trial Plan Active User</option>
                                            <option value="5">Trial Plan Expried User</option>
                                            <option value="4">Without Logo</option>
                                            <option value="8">Total Free User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="input-group" style="float: right;">
                                        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary" id="btn-filter">Filter</button>
                                        <button type="button" class="mb-xs mt-xs mr-xs btn btn-danger" id="btn-reset">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="">
                            <!-- table-responsive -->
                            <table class="table table-bordered table-striped mb-none" id="userListServerSide">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="2%">Post</th>
                                        <th width="10%">Reg. date</th>
                                        <th width="3%">Version</th>
                                        <th width="10%">Logo</th>
                                        <th width="25%">Name</th>
                                        <!-- <th width="20%">Email</th> -->
                                        <th width="10%">Mobile</th>
                                        <th width="10%">IsPaid</th>
                                        <th width="5%">Status</th>
                                        <th width="5%">Expiry</th>
                                        <th width="5%">OTP</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>