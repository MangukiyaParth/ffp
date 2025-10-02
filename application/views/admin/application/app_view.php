<section role="main" class="content-body">
    <header class="page-header">
        <h2><?php echo $details['app_name'];?></h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span><?php echo $details['app_name'];?></span></li>
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
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;<?php echo $details['app_name'] .' - '.$details['app_package_name'];?>
                        (<?php echo count($list); ?>)
                        <a href="<?php echo ADMIN_URL . 'application/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary">
                            <i class="fa fa-list" aria-hidden="true"></i> <span> &nbsp;Back</span></a>
                    </h2>
                    <!-- <span class="listname" style="display: none;">Advertise List/0,1,2,3,4/0,1,2,3,4</span> -->
                </header>

                <div class="panel-body">
                    <div class="">
                        <h3>Application Info</h3>
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>App Name</th>
                                    <th>Package Name</th>
                                    <th>Ads Click</th>
                                    <th>Mode</th>
                                    <th>Status</th>
                                </tr>
                                <tr>
                                    <td><?php echo $details['app_name'];?></td>
                                    <td><?php echo $details['app_package_name'];?></td>
                                    <td><?php echo $details['adclick'];?></td>

                                    <td>
                                        <?php if($details['mode']==1){ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn btn-success" data-toggle="tooltip" title="Live">
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <?php }else{ echo "Test"; }?>
                                    </td>

                                    <td>
                                        <?php if($details['status'] == 0){ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn btn-light" data-toggle="tooltip" title="Off">
                                                <i class="fa fa-power-off"></i>
                                            </button>
                                        </a>
                                        <?php }else if($details['status'] == 1){ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Google">
                                                <i class="fa fa-google"></i>
                                            </button>
                                        </a>
                                        <?php }else{ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </button>
                                        </a>
                                        <?php } ?>
                                    </td>

                                </tr>
                            </table>
                            <br />
                            <br />
                        </div>
                    </div>

                    <div class="">
                        <h3>Dailog Info</h3>
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th width="5%">IsDisplay</th>
                                    <th width="5%">IsDisplay Other</th>
                                    <th width="">Title</th>
                                    <th width="">Description</th>
                                    <th width="10%">Button 1</th>
                                    <th width="10%">Button 2</th>
                                    <th width="5%">Link</th>
                                    <th width="10%">Image</th>
                                    <th width="5%">Version</th>
                                    <th width="5%">Update Force</th>
                                    <th width="5%">Other Force</th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php if($dailog['d_isDisplay']==1){ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn btn-success" data-toggle="tooltip" title="Display">
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <?php }else{ echo "Off"; }?>
                                    </td>
                                    <td>
                                        <?php if($dailog['d_other_isDisplay']==1){ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn btn-success" data-toggle="tooltip" title="Other Display">
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <?php }else{ echo "Off"; }?>
                                    </td>
                                    <td><?php echo $dailog['d_title'];?></td>
                                    <td><?php echo $dailog['d_description'];?></td>
                                    <td><button type="button" class="btn btn-info"><?php echo $dailog['d_button1'];?></button></td>
                                    <td><button type="button" class="btn btn-danger"><?php echo $dailog['d_button2'];?></button></td>
                                    <td><a href="<?php echo $dailog['d_link'];?>" target="_blank">Link</a></td>
                                    <td><img class="img-display" src="<?php echo ($dailog['image']!="")? base_url("media/dailog/").$dailog['image']:base_url("media/dailog/picture-icon.jpg");?>" width="80px"></td>
                                    <td><?php echo $dailog['d_appversion'];?></td>
                                    <td>
                                        <?php if($dailog['d_forcefully']==1){ ?>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="btn btn-sm btn btn-success" data-toggle="tooltip" title="Display">
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <?php }else{ echo "Off"; }?>
                                    </td>
                                    <td><?php echo ($dailog['d_other_forcefully']==0)?'Off':'On';?></td>

                                </tr>
                            </table>
                            <br />
                            <br />
                        </div>
                    </div>

                    <div class="">
                        <h3>7 Days User Analytics</h3>
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>Date</th>
                                    <th>New</th>
                                    <th>Active</th>
                                    <th>Impression</th>
                                    <th>Updated Date</th>
                                </tr>
                                <?php if($analytics){?>
                                <?php foreach($analytics as $analy){?>
                                <tr>
                                    <td><?php echo ($analy['c_date']!="0000-00-00")?date('d/m/Y',strtotime($analy['c_date'])):'';?></td>
                                    <td><?php echo $analy['new'];?></td>
                                    <td><?php echo $analy['active'];?></td>
                                    <td><?php echo $analy['impression'];?></td>
                                    <td><?php echo ($analy['updated_at']!="0000-00-00")?date('d/m/Y H:i',strtotime($analy['updated_at'])):'';?></td>
                                </tr>
                                <?php }?>
                                <?php }else{?>
                                <tr>
                                    <td colspan="5">No record found!..</td>
                                </tr>
                                <?php }?>
                            </table>
                            <br />
                            <br />
                        </div>
                    </div>

                    <div class="">
                        <h3>Live User Analytics</h3>
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>Date</th>
                                    <th>New</th>
                                    <th>Active</th>
                                    <th>Impression</th>
                                </tr>
                                <?php if($liveanalytics){?>
                                <tr>
                                    <td><?php echo ($liveanalytics['d_date']!="0000-00-00")?date('d/m/Y',strtotime($liveanalytics['d_date'])):'';?></td>
                                    <td><i class="round-green"><?php echo $liveanalytics['totalNew'];?></i></td>
                                    <td><i class="round-blue"><?php echo $liveanalytics['totalActive'];?></i></td>
                                    <td><?php echo $liveanalytics['totalImpression'];?></td>
                                </tr>
                                <?php }else{?>
                                <tr>
                                    <td colspan="4">No record found!..</td>
                                </tr>
                                <?php }?>
                            </table>
                            <br />
                            <br />
                        </div>
                    </div>

                    <div class="">
                        <h3>Application Unite Id</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped  datatable-tabletools">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="20%">Type</th>
                                        <!-- <th width="35%">App</th> -->
                                        <th width="20%">Title</th>
                                        <th width="30%">Ads ID</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                foreach ($list as $key) { ?>
                                    <tr id="<?php echo $key['a_id']; ?>">
                                        <td><?php echo $key['a_id']; ?></td>
                                        <td width="10%"><?php echo ($key['ads_type'] == '1') ? 'Adsmob' : 'Facebook'; ?></td>
                                        <!--  <td><?php echo $key['app_name']; ?></td> -->
                                        <td><?php echo $key['ads_title']; ?></td>
                                        <td><?php echo $key['ads_id']; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?php echo ADMIN_URL . 'MyUnit/edit/' . $key['a_id']; ?>">
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </button></a>

                                                <a href="javascript:void(0)" id="<?php echo $key['a_id']; ?>" onclick="deleterecord(this.id,'/MyUnit/deleteAdvertise');"><button type="button"
                                                        class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>    
    <!-- end: page -->
</section>
