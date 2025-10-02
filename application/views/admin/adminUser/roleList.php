<section role="main" class="content-body">
    <header class="page-header">
        <h2>Role List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Role List</span></li>
            </ol>

        </div>

    </header>

    <!-- start: page -->

    <div class="row">

    <div class="col-xs-4">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>

                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Role
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" id="roleAddForm">
                            <input type="hidden" name="id" id="hId" />
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">Name</label>
                                    <input type="text" id="tName" name="name" placeholder="Name" class="form-control" value="" />
                                </div>

                                <div class="col-md-12">
                                    <label class="control-label">Code</label>
                                    <input type="text" id="tCode" name="code" placeholder="Code" class="form-control" value="" />
                                </div>

                                <div class="col-md-12">
                                    <label class="control-label">Status</label>
                                   
                                    <div class="switch switch-sm switch-success">
                                        <input type="checkbox" id="status" checked=""  name="status" value="1" data-plugin-ios-switch />
                                    </div>
                                </div>

                                <div class="col-md-12 svbut">
                                    <button type="submit" class="right  mb-xs mt-xs mr-xs btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-xs-8">

            <section class="panel">

                <header class="panel-heading">

                    <div class="panel-actions">

                      
                    </div>

                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Role List
                    <a href="javascript:void(0)" 
                    id="roleAddBtn"
                        class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i> <span> &nbsp;Add
                                Role</span></a>
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

                            <table class="table table-bordered table-striped mb-none" id="adminRoleList">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr No</th>
                                        <th width="10%">Name</th>
                                        <th width="15%">Code</th>
                                        <th width="5%">Status</th>
                                        <th width="8%">Action</th>
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

