<section role="main" class="content-body">
    <header class="page-header">
        <h2>FAQ List</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">FAQ List</span></li>
            </ol>
            <span class="listname" style="display: none;">Slider List/0,1,2,3,4/0,2,3,4</span>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Add Faq</h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="faqadd">
                            <input type="hidden" name="id" value="<?php echo ($edit) ? $edit['faq_id'] : ""; ?>" />
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">Quetions</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <textarea rows="5" name="quetion" placeholder="Enter Quetion" class="form-control"><?php echo ($edit) ? $edit['quetion'] : ""; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Answer</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <textarea rows="5" name="anwser" placeholder="Enter Answer" class="form-control"><?php echo ($edit) ? $edit['anwser'] : ""; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Status</label>
                                    <?php
									if ($edit) {
										$status = $edit['status'] == 1 ? 'checked=""' : '';
									} else {
										$status = 'checked=""';
									}
									?>
                                    <div class="switch switch-sm switch-success">
                                        <input type="checkbox" <?php echo $status; ?> name="status" value="1" data-plugin-ios-switch />
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
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Faq List (<?php echo count($list); ?>)
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Quetions</th>
                                    <th>Answer</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $key) {?>
                                <tr id="<?php echo $key['faq_id']; ?>">
                                    <td><?php echo $key['faq_id'] ?></td>
                                    <td><?php echo $key['quetion']; ?></td>
                                    <td><?php echo $key['anwser']; ?></td>
                                    <td>
                                        <?php
										$status = $key['status'] == 1 ? 'checked=""' : '';
									?>
                                        <div class="switch switch-sm switch-success">
                                            <input type="checkbox" <?php echo $status; ?> data-plugin-ios-switch />
                                        </div>

                                    </td>
                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'faq/faqEdit/' . $key['faq_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button></a>

                                        <a href="javascript:void(0)" id="<?php echo $key['faq_id']; ?>" onclick="deleterecord(this.id,'/faq/deletefaq');"><button type="button"
                                                class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </a>
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
