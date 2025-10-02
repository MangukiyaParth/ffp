<style>
.radio-inline, .checkbox-inline {
    font-size: 15px;
    padding-left: 50px;
}
.radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
    margin-left: -30px !important;
}
/* Increase the size of the radio buttons */
input[type="radio"] {
  /* Set the desired width and height */
    width: 20px;
    height: 20px;
  /* Optional: To center the radio button within the space */
    margin-bottom: 5px;
    vertical-align: middle;
}

/* Optional: Customize the appearance of the radio button itself */
input[type="radio"]::before {
    content: '';
    display: inline-block;
    width: 100%;
    height: 100%;
    border-radius: 50%;
}
.displayNone{
    display: none;
}
/* spiner */
/* Styles for the loading spinner */
#loading-spinner {
    display: none;
    border: 4px solid #f3f3f3; /* Light gray */
    border-top: 4px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.record_count {
    font-size: 20px;
    color: black;
}
</style>
<?php 
$cut_dt_time = strftime('%Y-%m-%d', time());
$cut_time = strftime('%H:%M', time());
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>WhatsApp Bulk</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">WhatsApp Bulk</span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>

                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-plus-square" aria-hidden="true"></i></a> &nbsp; Send WhatsApp Bulk 
                        <a href="<?php echo ADMIN_URL . 'whatsappbulk/list' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary"><i class="fa fa-list" aria-hidden="true"></i> 
                            <span> &nbsp;WhatsApp Bulk List</span>
                        </a>
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="form-body">
                        <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="WhatsbulkSend">
                                <div class="col-xs-12 col-md-10">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-12 col-xs-12">
                                            <label class="control-label">Types of Filter</label>
                                            <div class="input-group">
                                                <label class="radio-inline">
                                                    <input type="radio" name="typeoffilter" checked value="filter">Filter
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="typeoffilter" value="bulk">Bulk (CSV)
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="typeoffilter" value="manually">Manually
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="typeoffilter" value="retarget">Retarget
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-4 col-xs-12">
                                            <label class="control-label">Camping Name <span class="rerq">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-tag"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Enter Camping Name" name="cam_title" />
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <label class="control-label">Select Template</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-tag"></i>
                                                </span>
                                                <select class="form-control category temp_list" name="tamp_name">
                                                    <?php foreach ($list as $temp) { ?>
                                                        <option value="<?php echo $temp['wtemp_id']; ?>" data-id="<?php echo $temp['template']; ?>"><?php echo $temp['tamp_name']." -- ".$temp['template']." -- ".$temp['type']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12 block_bulk displayNone">
                                            <label class="control-label">File Upload (Only CSV) <a href="<?php echo base_url("media/whatsappTemp/files/sample_blank.csv");?>">Download Sample</a></label>
                                            
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-image"></i>
                                                </span>
                                                <input type="file" name="image" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12 block_retarget displayNone">
                                            <label class="control-label">Select Previous Camping</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-tag"></i>
                                                </span>
                                                <select class="form-control category previus_camping" name="previus_camping">
                                                    <?php foreach ($getCampingList as $temp) { 
                                                        $countTime = countHour($temp['created_at']);
                                                        ?>
                                                        <option value="<?php echo $temp['cam_id'].'<->'.$temp['cam_title']; ?>">
                                                            <?php echo (($countTime['status'])?"=>":"")." ".$temp['cam_title']." -- ".date("d/m/Y",strtotime($temp['cam_date'])); ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xs-12 block_filter">
                                        <div class="col-md-4 col-xs-12">
                                            <label class="control-label">Select Filter Type</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-tag"></i>
                                                </span>
                                                <select class="form-control" name="filter_type" id="filter_type">
                                                    <option value="11">Test - 8141631370</option>
                                                    <option value="1">Free User</option>
                                                    <option value="8">Payment Fail</option>
                                                    <option value="5">Trial Expried User</option>
                                                    <option value="3">Plan Expried User</option>
                                                    <!-- <option value="6">Without Logo</option> -->
                                                    <option value="10">Defult - Active Session - Free User</option>
                                                    <!-- <option value="9">Visit & Try Payment Page</option> -->
                                                    <option value="4">Trial Active User</option>
                                                    <option value="2">Plan Active User</option>
                                                    <option value="7">Last Login - All Free User</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <label class="control-label">Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="date" name="start_date" value="<?php echo $cut_dt_time;?>" id="start_date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <label class="control-label">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="date" name="end_date" value="<?php echo $cut_dt_time;?>" id="end_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xs-12 block_menually displayNone">
                                        <div class="col-md-4 col-xs-12">
                                            <label class="control-label">Phone Number(s)</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa pencil-square"></i>
                                                </span>
                                                <textarea rows="15" name="numbers_menually" placeholder="Ex. 8140331370,8140331370" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-12 col-xs-12 svbut">
                                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">Send</button>
                                        <div class="record_count"></div>
                                    </div>
                                    <div class="col-md-12 col-xs-12 svbut">
                                    <div id="loading-spinner"></div>
                                    <p><font color="red">Note: Defult Session Retrget Time (8141631375) Number Url Change</font></p>
                                    <h4 class="template_name_display"></h4>  

                                        <!-- <div class="form-group" id="process" style="display:none;">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style=""></div>
                                            </div>
                                        </div> -->
                                    </div>
                                    
                                </div>
                                <div class="col-xs-12 col-md-2">  
                                    <img src="<?php echo base_url("media/whatsappTemp/app_catalogue_pdf_short.png");?>" id="myImage" height="100%" width="100%" />
                                </div>
                                
                        </form>
                    </div>
                </div>
            </section>
        </div>
        
    </div>
    <!-- end: page -->
</section>
