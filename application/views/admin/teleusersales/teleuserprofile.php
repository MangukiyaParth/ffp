<style>
.text-red-color {
    color: red;
    font-weight: 900;
}


.card {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.h-100 {
    height: 100% !important;
}

.shadow-none {
    box-shadow: none !important;
}
/* .fa-whatsapp  {
  color:#fff;
  background:
   linear-gradient(#25d366,#25d366) 14% 84%/16% 16% no-repeat,
   radial-gradient(#25d366 58%,transparent 0);
} */
/* .btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 16px;
  font-size: 16px;
  cursor: pointer;
} */

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}
/* timeline css */

.timeline{
  margin-top:10px;
  position:relative;
  
}
.timeline:before{
  position:absolute;
  content:'';
  width:4px;
  height:calc(100% + 50px);
background: rgb(138,145,150);
background: -moz-linear-gradient(left, rgba(138,145,150,1) 0%, rgba(122,130,136,1) 60%, rgba(98,105,109,1) 100%);
background: -webkit-linear-gradient(left, rgba(138,145,150,1) 0%,rgba(122,130,136,1) 60%,rgba(98,105,109,1) 100%);
background: linear-gradient(to right, rgba(138,145,150,1) 0%,rgba(122,130,136,1) 60%,rgba(98,105,109,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8a9196', endColorstr='#62696d',GradientType=1 );
  left:14px;
  top:5px;
  border-radius:4px;
}

.timeline-month{
    position: relative;
    padding: 4px 15px 4px 35px;
    background-color: #47a447;
    display: inline-block;
    width: auto;
    border-radius: 40px;
    border: 1px solid #ededed;
    margin-bottom: 30px;
    color: white;
}

.timeline-month span{
  position:absolute;
  top:-1px;
  left:calc(100% - 10px);
  z-index:-1;
  white-space:nowrap;
  display:inline-block;
  background-color:#111;
  padding:4px 10px 4px 20px;
  border-top-right-radius:40px;
  border-bottom-right-radius:40px;
  border:1px solid black;
  box-sizing:border-box;
}

.timeline-month:before{
  position:absolute;
  content:'';
  width:20px;
  height:20px;
background: rgb(138,145,150);
background: -moz-linear-gradient(top, rgba(138,145,150,1) 0%, rgba(122,130,136,1) 60%, rgba(112,120,125,1) 100%);
background: -webkit-linear-gradient(top, rgba(138,145,150,1) 0%,rgba(122,130,136,1) 60%,rgba(112,120,125,1) 100%);
background: linear-gradient(to bottom, rgba(138,145,150,1) 0%,rgba(122,130,136,1) 60%,rgba(112,120,125,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8a9196', endColorstr='#70787d',GradientType=0 );
  border-radius:100%;
  border:1px solid #ededed;
  left:5px;
}

.timeline-section{
  padding-left:35px;
  display:block;
  position:relative;
  margin-bottom:30px;
}

.timeline-date{
    margin-bottom: 10px;
    padding: 2px 10px;
    background: #08c;
    position: relative;
    display: inline-block;
    border-radius: 25px;
    border: 1px solid #ededed;
    color: #fff;
}
.timeline-section:before{
  content:'';
  position:absolute;
  width:30px;
  height:1px;
  background-color:#444950;
  top:12px;
  left:20px;
}

.timeline-section:after{
  content:'';
  position:absolute;
  width:10px;
  height:10px;
  background:linear-gradient(to bottom, rgba(138,145,150,1) 0%,rgba(122,130,136,1) 60%,rgba(112,120,125,1) 100%);
  top:7px;
  left:11px;
  border:1px solid #ededed;
  border-radius:100%;
}

.timeline-section .col-sm-4{
  margin-bottom:15px;
}

.timeline-box{
  position:relative;
  
 background-color:#444950;
  border-radius:15px;
  border-top-left-radius:0px;
  border-bottom-right-radius:0px;
  border:1px solid #ededed;
  transition:all 0.3s ease;
  overflow:hidden;
}

.box-icon{
  position:absolute;
  right:5px;
  top:0px;
}

.box-title{
  padding:5px 15px;
  border-bottom: 1px solid #ededed;
}

.box-title i{
  margin-right:5px;
}

.box-content{
  padding:5px 5px;
  background-color:#ededed;
}

.box-content strong{
  color:#666;
  /* font-style:italic; */
  margin-right:5px;
}

.box-item{
  margin-bottom:5px;
}

.box-footer{
 padding:5px 15px;
  border-top: 1px solid #ededed;
  background-color:#444950;
  text-align:right;
  font-style:italic;
}
.box-title {
    color: white;
}
.call-log-css{
    float: right;
    font-size: 13px;
    color: #ccc !important;
}
.created-dt-css{
    float: right;
    font-size: 13px;
    color: #767676 !important;
}
#frameScrollView {
    width: 100%;
    height: 500px;
    padding: 5px;
    overflow: auto;
    border: 1px solid #ccc;
  }
  
</style>
<?php 
$assign_id_url = $this->uri->segment(5);

$cut_dt_time = strftime('%Y-%m-%dT%H:%M:%S', time());
$cut_time = strftime('%H:%M', time());
/* print_r($dataResumt); */
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Cutomer Profile</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Home</span></li>
                <li><span>Cutomer Profile</span></li>
            </ol>
            <a class="sidebar-right-toggle">&nbsp;</a>
        </div>
       
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-6 col-lg-12 col-xl-6">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <!-- <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> -->
                        <!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
                    </div>
                    <h2 class="panel-title" style="margin-bottom: 10px;">
                        <i class="fa fa-list" aria-hidden="true"></i> &nbsp;<span class="mobilecopy" onclick="copy(this)"><?php echo $dataResumt['mobile'];?></span>
                        <a href="<?php echo ADMIN_URL . 'teleUserSales/' ?>" class="right mb-xs mt-xs mr-xs btn padheader btn-primary" style="width: 13%;"><i class="fa fa-arrow-left" aria-hidden="true"></i> 
                            <span> &nbsp;Back to List</span>
                        </a>
                    </h2>
                </header>
            </section>
            <section>
                <div class="row">
                    <div class="col-md-6">
                        <section class="panel">

                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                </div>
                                <h2 class="panel-title"><a href="javascipt:void(0);">
                                    <i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;User Profile - <?php echo $dataResumt['business_name'];?>
                                </h2>
                            </header>
                            <p>&nbsp;</p>
                            <div class=""><!-- panel-body -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a class="active" data-toggle="tab" href="#customer">Customer Profile</a></li>
                                    <li><a data-toggle="tab" href="#review">Customer Review</a></li>
                                    <li><a data-toggle="tab" href="#premium">Premium Conformation</a></li>
                                </ul>
                                <div class="tab-content">

                                    <div id="customer" class="tab-pane fade in active">
                                        <div class="row">
                                            <div class="col-md-12 mb-12">
                                                <div class="card-body">
                                                    <div class="d-flex flex-column align-items-center text-center">
                                                        <?php
                                                        if($dataResumt['photo'] !="" && $dataResumt['photo'] !=null){
                                                            $logo_img_url = FCPATH."media/logo/".$dataResumt['photo'];  
                                                            if(file_exists($logo_img_url)){
                                                                $logo_img_url = base_url("media/logo/").$dataResumt['photo'];  
                                                            }else{
                                                                $logo_img_url = base_url("assets/images/avatar7.png");
                                                            }
                                                        }else{
                                                            $logo_img_url = base_url("assets/images/avatar7.png");     
                                                        }
                                                        ?>
                                                        <img src="<?php echo $logo_img_url;?>" alt="Admin" class="rounded-circle" width="150">
                                                        <div class="mt-3">
                                                            <h4><?php echo $dataResumt['business_name'];?></h4>
                                                            <p class="text-secondary mb-1"><?php echo $dataResumt['mobile'];?></p>
                                                            <p class="text-muted font-size-sm"><?php echo $dataResumt['name'];?></p>
                                                            <p class="text-muted font-size-sm">Last Login: <?php echo ($dataResumt['last_login']!=null && $dataResumt['last_login']!="0000-00-00 00:00:00")?date("d-m-Y H:i:s",strtotime($dataResumt['last_login'])):'';;?></p>

                                                            <a href="tel:<?php echo $dataResumt['mobile'];?>">
                                                                <button class="btn btn-primary"><i class="fa fa-phone fa-lg"></i> Call Now</button>
                                                            </a>
                                                            <a target="_blank" href="https://web.whatsapp.com/send/?phone=%2B91<?php echo $dataResumt['mobile'];?>&text=<?php echo $dataResumt['business_name'];?>&app_absent=0">
                                                                <button class="btn btn-success"><i class="fa fa-whatsapp fa-lg"></i> Message</button>
                                                            </a>

                                                            <a href="javascript:void(0);">
                                                                <button class="btn btn-danger" onclick="copy(this)"><i class="fa fa-copy fa-lg"></i> <?php echo $dataResumt['mobile'];?></button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="mb-0"><i class="fa fa-building-o fa-lg btn-sucess"></i> <i>Business Name</i></h6>
                                                            <span><strong><?php echo $dataResumt['business_name'];?></strong></span>
                                                        </li>

                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="mb-0"><i class="fa fa-cogs fa-lg btn-sucess"></i> <i>Services</i></h6>
                                                            <span><strong><?php echo $dataResumt['name'];?></strong></span>
                                                        </li>

                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="mb-0"><i class="fa fa-phone fa-lg btn-sucess"></i> <i>Register Number</i></h6>
                                                            <span><strong><?php echo $dataResumt['mobile'];?></strong></span>
                                                        </li>

                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="mb-0"><i class="fa fa-phone fa-lg btn-sucess"></i> <i>Business Number</i></h6>
                                                            <span><strong><?php echo $dataResumt['b_mobile2'];?></strong></span>
                                                        </li>

                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="mb-0"><i class="fa fa-envelope fa-lg btn-sucess"></i> <i>Email</i></h6>
                                                            <span><strong><?php echo $dataResumt['b_email'];?></strong></span>
                                                        </li>

                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="mb-0"><i class="fa fa-globe fa-lg btn-sucess"></i> <i>Website</i></h6>
                                                            <span><strong><?php echo $dataResumt['b_website'];?></strong></span>
                                                        </li>

                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="mb-0"><i class="fa fa-map-marker fa-lg btn-sucess"></i> <i>Address</i></h6>
                                                            <span><strong><?php echo $dataResumt['address'];?></strong></span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="mb-0"><i class="fa fa-map-marker fa-lg btn-sucess"></i> <i>Note</i></h6>
                                                            <span><strong><?php echo $dataResumt['note'];?></strong></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="review" class="tab-pane fade in">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <?php 
                                                $buttonHide = false;
                                                if(array_key_exists("review_status",$dataResumt)){
                                                    if($dataResumt['review_status']==0 && $dataResumt['review_status']!="" && $dataResumt['review_status']!=null){
                                                        echo '<div class="alert alert-info"><strong>Pending!</strong> Your review status is pending, please wait some time.</div>';
                                                        $buttonHide = true;
                                                    }else if($dataResumt['review_status']==1){
                                                        echo '<div class="alert alert-success"><strong>Approve!</strong> Congratulations, Your review status is approve.</div>';
                                                        $buttonHide = true;
                                                    }else if($dataResumt['review_status']==2){
                                                        echo '<div class="alert alert-danger"><strong>Rejected!</strong> Sorry, Your review status is rejected, please contact to TL.</div>';
                                                        $buttonHide = true;
                                                    }
                                                    
                                                }
                                            ?>
                                            </div>
                                            <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="addReviewForm">
                                                <input type="hidden" name="lead_assign_id" value="<?php echo $assign_id_url;?>"/>
                                                <div class="col-md-12">
                                                    <label class="control-label">Review Screen Short </label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-image"></i>
                                                        </span>
                                                        <input type="file" name="image" class="form-control" accept="image/*" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="control-label">Review Date & Time</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                        <input type="datetime-local" name="reviewtime" value="<?php echo $cut_dt_time;?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="control-label">Other Note</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-quote-right"></i>
                                                        </span>
                                                        <textarea rows="4" name="note" placeholder="Enter Extra Note" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <?php if($buttonHide == false){?>
                                                    <div class="col-md-12 text-right">
                                                        <button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary">Send Request</button>
                                                    </div>
                                                <?php }?>
                                            </form>
                                        </div>
                                    </div>

                                    <div id="premium" class="tab-pane fade in">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php 
                                                    $buttonHideSub = false;
                                                        if(array_key_exists("sub_status",$dataResumt)){
                                                            if($dataResumt['sub_status']==0 && $dataResumt['sub_status']!="" && $dataResumt['sub_status']!=null){
                                                                echo '<div class="alert alert-info"><strong>Pending!</strong> Your subscription status is pending, please wait some time.</div>';
                                                                $buttonHideSub = true;
                                                            }else if($dataResumt['sub_status']==1){
                                                                echo '<div class="alert alert-success"><strong>Approve!</strong> Congratulations, Your subscription status is approve.</div>';
                                                                $buttonHideSub = true;
                                                            }else if($dataResumt['sub_status']==2){
                                                                echo '<div class="alert alert-danger"><strong>Rejected!</strong> Sorry, Your subscription status is rejected, please contact to TL.</div>';
                                                                $buttonHideSub = true;
                                                            }
                                                            
                                                        }
                                                    ?>
                                                </div>
                                            <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" action="javascript:void(0);" id="addPaymentPackForSales">
                                                <input type="hidden" name="lead_assign_id" value="<?php echo $assign_id_url;?>"/>
                                                <div class="col-md-12">
                                                    <label class="control-label">Subscription Package</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-money"></i>
                                                        </span>
                                                        <select class="form-control pack_id" name="pack_id">
                                                            <option value="">-- Select Package --</option>
                                                            <?php if($packagelist){
                                                                foreach($packagelist as $packlst){ ?>
                                                                <option data-id="<?php echo $packlst['price']?>" value="<?php echo $packlst['plan_id']?>"><?php echo $packlst['plan_name']?></option>
                                                            <?php }}?>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="control-label">Amount</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-money"></i>
                                                        </span>
                                                        <input type="number" name="ampunt" placeholder="Enter amount" class="form-control ampunt">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="control-label">Payment Screen Short </label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-image"></i>
                                                        </span>
                                                        <input type="file" name="images" class="form-control" accept="image/*" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <label class="control-label">Buy Date & Time</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                        <input type="datetime-local" id="buydatetime" name="buydatetime" value="<?php echo $cut_dt_time;?>" class="form-control">
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-12">
                                                    <label class="control-label">Other Note</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-quote-right"></i>
                                                        </span>
                                                        <textarea rows="4" name="note" placeholder="Enter Extra Note" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <?php if($buttonHideSub == false){?>
                                                    <div class="col-md-12 text-right">
                                                        <button type="submit" class="right mb-xs mt-xs mr-xs btn btn-primary">Send Request</button>
                                                    </div>
                                                <?php }?>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </section>
                    </div>
                    <div class="col-md-6">
                        <section class="panel">

                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                </div>
                                <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Call History</h2>
                            </header>

                            <div class="panel-body">
                                
                                <div class="col-md-12" id="frameScrollView">
                                    <!-- timeline start -->
                                    <div class="timeline">
                                        <div class="timeline-month"><?php echo date('F, Y', strtotime(date('Y-m-d')));?> <span></span></div>
                                        
                                        <?php if($cus_chat_history){
                                            foreach($cus_chat_history as $chat_history){ 
                                            $call_type = ($chat_history['call_type']==0)?"Outgoing":"Incoming";
                                            $time1 = new DateTime($chat_history['start_time']);
                                            $time2 = new DateTime($chat_history['end_time']);
                                            $interval = $time1->diff($time2);
                                            $call_type = $call_type.', '.$interval->format('%i mins %s secs'); ?>            
                                        <div class="timeline-section">
                                            <div class="timeline-date"><?php echo date('d, F Y', strtotime($chat_history['created_time'])) .', Call '. date('h:i', strtotime($chat_history['start_time'])) .' to '.date('h:i', strtotime($chat_history['end_time']));?></div>
                                            <!-- <div class="timeline-date">21, Tuesday 10:20 pm</div> -->
                                            
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="timeline-box">
                                                        <div class="box-title">
                                                            <i class="fa fa-asterisk text-success" aria-hidden="true"></i> <?php echo $chat_history['custom_status_title'];?>
                                                            <i class="call-log-css" aria-hidden="true"> <?php echo $call_type;?></i>
                                                        </div>
                                                        <div class="box-content">
                                                            <!-- <a class="btn btn-xs btn-default pull-right">Details</a> -->
                                                            <div class="box-item"><strong>-</strong> <?php echo ($chat_history['messages']!="")?$chat_history['messages']:"No Message...";?></div>
                                                            <i class="created-dt-css" aria-hidden="true"> Created: <?php echo date("d-m-Y h:i:s",strtotime($chat_history['created_time']));?></i>
                                                            <div class="box-item">&nbsp;</div>
                                                        </div>
                                                        <!-- <div class="box-footer">- Tyler</div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } }else{?>
                                            <div class="timeline-section">
                                            <div class="timeline-date"><?php echo date('d, F Y', strtotime(date("Y-m-d")));?></div>
                                            <!-- <div class="timeline-date">21, Tuesday 10:20 pm</div> -->
                                            
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="timeline-box">
                                                        <div class="box-title">
                                                            <i class="fa fa-asterisk text-success" aria-hidden="true"></i> No call history
                                                            <i class="call-log-css" aria-hidden="true"> No call history</i>
                                                        </div>
                                                        <div class="box-content">
                                                            <!-- <a class="btn btn-xs btn-default pull-right">Details</a> -->
                                                            <div class="box-item"><strong>Message</strong>: No data found!...</div>
                                                            <i class="created-dt-css" aria-hidden="true"> &nbsp;</i>
                                                            <div class="box-item">&nbsp;</div>
                                                        </div>
                                                        <!-- <div class="box-footer">- Tyler</div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }?>            

                                    </div>
                                    <!-- timeline end  -->
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            
                                <form class="form-horizontal form-bordered" method="post" action="javascript:void(0);" id="addChatHistoryCall">
                                    <input type="hidden" name="lead_assign_id" value="<?php echo $assign_id_url;?>"/>
                                    <div class="col-md-12">
                                        <label class="control-label">Call Type</label>
                                        
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="call_type" id="call_type1" value="0" checked type="radio">
                                                <label for="call_type1">Outgoing Call</label>
                                            </div>&nbsp;&nbsp;
                                        </div>
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="call_type" id="call_type2" value="1" type="radio">
                                                <label for="call_type2">Incoming Call</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Call Status</label>
                                        <?php if($cus_feedback_status){ $i = 1;
                                        foreach($cus_feedback_status as $feedback_status){ 
                                            if($i == 1){
                                                $checked = "checked";
                                            }else{
                                                $checked = "";
                                            }
                                            ?>
                                            <div class="single-line">
                                                <div class="radio-custom radio-primary">
                                                    <input name="custom_status_list" id="cs_<?php echo $feedback_status['customer_status_id'];?>" value="<?php echo $feedback_status['customer_status_id'];?>" <?php echo $checked;?> type="radio">
                                                    <label for="cs_<?php echo $feedback_status['customer_status_id'];?>"><?php echo $feedback_status['custom_status_title'];?></label>
                                                </div>&nbsp;&nbsp;
                                            </div>
                                        <?php $i++; }}?>        
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <label class="control-label">Call Status</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-money"></i>
                                            </span>
                                            <select class="form-control call_status" name="call_status">
                                                <option value="">-- Select Status --</option>
                                                <?php /* if($cus_feedback_status){
                                                foreach($cus_feedback_status as $feedback_status){ ?>
                                                <option value="<?php echo $feedback_status['customer_status_id'];?>"><?php echo $feedback_status['custom_status_title'];?></option>
                                                <?php }} */?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 next_schedule_block" style="display:none;">
                                        <label class="control-label">Next Schedule</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <input type="datetime-local" id="next_schedule" name="next_schedule" value="<?php echo $cut_dt_time;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 client_percentage_block" style="display:none;">
                                        <label class="control-label">How much interested?</label>
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="client_percentage" id="clt_perc0" value="0" checked type="radio">
                                                <label for="clt_perc0">0%</label>
                                            </div>&nbsp;&nbsp;
                                        </div>
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="client_percentage" id="clt_perc20" value="20" type="radio">
                                                <label for="clt_perc20">20%</label>
                                            </div>
                                        </div>
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="client_percentage" id="clt_perc40" value="40" type="radio">
                                                <label for="clt_perc40">40%</label>
                                            </div>
                                        </div>
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="client_percentage" id="clt_perc60" value="60" type="radio">
                                                <label for="clt_perc60">60%</label>
                                            </div>
                                        </div>
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="client_percentage" id="clt_perc80" value="80" type="radio">
                                                <label for="clt_perc80">80%</label>
                                            </div>
                                        </div>
                                        <div class="single-line">
                                            <div class="radio-custom radio-primary">
                                                <input name="client_percentage" id="clt_perc100" value="100" type="radio">
                                                <label for="clt_perc100">100%</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Call Start Time</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <input type="time" id="start_time" name="start_time" value="<?php echo $cut_time;?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Call End Time</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <input type="time" id="end_time" name="end_time" value="<?php echo $cut_time;?>" class="form-control" >
                                        </div>
                                        <!-- <input type="text" class="flatpickr" > -->
                                    </div>
                                    
                                   
                                    <div class="col-md-12">
                                        <label class="control-label">Client Comment</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-quote-right"></i>
                                            </span>
                                            <textarea rows="4" name="note" placeholder="Enter client says" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 text-left">
                                        <button type="submit" class=" mb-xs mt-xs mr-xs btn btn-success">Save Call History</button>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <a href="<?php echo ADMIN_URL . 'teleUserSales/' ?>">
                                            <button type="button" class="right mb-xs mt-xs mr-xs btn btn-primary">Back</button>
                                        </a>
                                    </div> -->
                                </form>                       
                            </div>

                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<!-- <script>
  flatpickr(".flatpickr", {
    enableTime: true,
    noCalendar: true,
    enableSeconds: true,
    time_24hr: true,
    dateFormat: "H:i:S",
  });
</script> -->