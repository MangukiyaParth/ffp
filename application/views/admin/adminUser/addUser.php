<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add User</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Add User</span></li>
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

                    <h2 class="panel-title"><a href="javascipt:void(0);">
                            <i class="fa fa-list" aria-hidden="true"></i></a> &nbsp; Add User

                        <a href="<?php echo ADMIN_URL . 'users/adminList' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <span> &nbsp;Back</span></a>
                    </h2>



                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" id="addAdminUserForm">

                        <input type="hidden" id="id" name="id" value="<?php echo $edit ? $edit['id'] : ''; ?>" />
                        <div class="col-md-4">
                            <label class="control-label">Name</label>
                            <input type="text" id="name" name="name" placeholder="Name" class="form-control" value="<?php echo $edit ? $edit['name'] : ''; ?>" />
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="<?php echo $edit ? $edit['email'] : ''; ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Promo Code (Multiple Code separated by ,)</label>
                            <input type="text" name="note" placeholder="Enter Promo Code" class="form-control" value="<?php echo $edit ? $edit['note'] : ''; ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Mobile</label>
                            <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="form-control" value="<?php echo $edit ? $edit['mobile'] : ''; ?>" />
                        </div>

                        <?php //if (!$edit) { ?>
                            <div class="col-md-4">
                                <label class="control-label">Password</label>
                                <input type="text" id="password" name="password" placeholder="password" class="form-control" value="" />
                            </div>
                        <?php //} ?>

                        <div class="col-md-4">
                            <label class="control-label">Role</label>
                            <select id="roleId" name="roleId" class="form-control">
                                <option value=""> Select </option>
                                <?php
                                foreach ($roleList as $role) {

                                    $selected = '';

                                    if ($edit && $edit['role_id'] == $role->r_id) {
                                        $selected = 'selected';
                                    }

                                ?>
                                    <option value="<?php echo $role->r_id; ?>" <?php echo $selected;  ?>><?php echo $role->title; ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Status</label>

                            <?php
                            $status = '';
                            $statusValue = 0;
                            if ($edit && $edit['status']) {
                                $status = 'checked=""';
                                $statusValue = 1;
                            }

                            if (!$edit) {
                                $status = 'checked=""';
                                $statusValue = 1;
                            }

                            ?>

                            <div class="switch switch-sm switch-success">
                                <input type="checkbox" id="status" <?php echo $status; ?> name="status" value="<?php echo $statusValue; ?>" data-plugin-ios-switch />
                            </div>
                        </div>

                        <div class="col-md-12 svbut">
                            <button type="submit" class="left  mb-xs mt-xs mr-xs btn btn-primary">Save</button>
                        </div>


                </div>
                </form>

        </div>

</section>

</div>

</div>



<!-- end: page -->

</section>