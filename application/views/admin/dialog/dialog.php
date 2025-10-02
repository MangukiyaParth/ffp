<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dialog</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dialog</span></li>

            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);">Dialog</h2>
                    <?php if ($this->session->flashdata('msg-success')) {
                        echo "<div class='alert alert-success'>" . $this->session->flashdata('msg-success') . "</div>";
                    }
                    if ($this->session->flashdata('msg-error')) {
                        echo "<div class='alert alert-danger'>" . $this->session->flashdata('msg-error') . "</div>";
                    }
                    ?>
                </header>
                <form class="form-horizontal form-bordered" method="post"
                    action="<?php echo base_url('admin/dialog/save') ?>">
                    <div class="panel-body">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Dialog Title <span
                                                        class="rerq">*</span></label>
                                                <input type="text" name="title" class="form-control"
                                                    value="<?php echo $edit['title']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Description <span
                                                        class="rerq">*</span></label>
                                                <input type="text" name="description" class="form-control"
                                                    value="<?php echo $edit['description']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Button Name <span class="rerq"> if blank =
                                                        dialog off</span></label>
                                                <input type="text" name="button_name" class="form-control"
                                                    value="<?php echo $edit['button_name']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Link</label>
                                                <input type="text" name="link" class="form-control"
                                                    value="<?php echo $edit['link']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <label class="control-label">Version</label>
                                                <input type="text" name="version" class="form-control"
                                                    value="<?php echo $edit['version']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <label class="control-label" for="textareaDefault">App On/Off <span
                                                    class="rerq"> 0-On / 1-Off</span></label>
                                            <?php
                                            $app_on_off = $edit['app_on_off'] == 0 ? 'checked=""' : '';

                                            ?>
                                            <div class="switch switch-sm switch-success">
                                                <input type="checkbox" <?php echo $app_on_off; ?> name="app_on_off"
                                                    value="1" data-plugin-ios-switch />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="control-label" for="textareaDefault">App Forcefully
                                                Update</label>
                                            <?php
                                            $forcefully_update = $edit['forcefully_update'] == 1 ? 'checked=""' : '';

                                            ?>
                                            <div class="switch switch-sm switch-success">
                                                <input type="checkbox" <?php echo $forcefully_update; ?>
                                                    name="forcefully_update" value="1" data-plugin-ios-switch />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6"><br />
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit"
                                                    class="right mb-xs mt-xs mr-xs btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>

    </div>
    <!-- end: page -->
</section>
