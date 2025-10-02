<!doctype html>
<html class="sidebar-left-big-icons">

<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title><?php echo getOptionValue('title'); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(''); ?>media/users/favicon.png">
    <meta name="keywords" content="SnehMilan Hanol" />
    <meta name="description" content="SnehMilan Hanol">
    <meta name="author" content="techbitinfo.com">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- <style type="text/css">
        .gujarati { font-family: shruti; }
        </style> -->
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
    <!-- <link rel="stylesheet" href="https://wfolly.firebaseapp.com/node_modules/sweetalert/dist/sweetalert.css" /> -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
    <!-- data table  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
    <!-- multi select box -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/dropzone/basic.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/dropzone/dropzone.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/summernote/summernote.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/codemirror/lib/codemirror.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/codemirror/theme/monokai.css" />

    <!-- calendar page3 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fullcalendar/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fullcalendar/fullcalendar.print.css" media="print" />

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/morris.js/morris.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/theme-custom.css">
    <!-- my custom css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <style>
    .body {
        opacity: 0.5;
    }

    .fa {
        margin-left: -12px;
        margin-right: 8px;
    }

    </style>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/simple-line-icons/css/simple-line-icons.css" />
    <style type="text/css">
    thead input {
        width: 100%;
    }

    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/buttons.dataTables.min.css" />
    <script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>
    <!-- <script type="text/javascript" src="https://www.google.com/jsapi"></script> -->
    <script>
        var Admin_url = '<?php echo ADMIN_URL; ?>';
        var base_url = '<?php echo base_url(); ?>';
        </script>

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/3.3.7/slate/bootstrap.min.css" />
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.2/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.2/dist/js/uikit-icons.min.js"></script>
-->
</head>

<body>
    <div id="loading"></div>
    <section class="body">
        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="<?php echo ADMIN_URL . 'dashboard'; ?>" class="logo">
                    <?php if (getOptionValue('site_logo')) { ?>
                    <img src="<?php echo base_url() . 'media/users/' . getOptionValue('site_logo'); ?>" height="50px" alt="Porto Admin" />
                    <?php } else { ?>
                    <h4><?php echo getOptionValue('sitename'); ?></h4>
                    <!-- <img src="<?php echo base_url(); ?>assets/images/logo.png" width="75" height="35" alt="Porto Admin" /> -->
                    <?php } ?>
                </a>
                <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
            <!-- start: search & user box -->
            <?php if ($this->session->userdata('role') == 0) { ?>
            <div class="header-right">
                <span class="separator"></span>
                <div id="userbox" class="userbox">
                    <?php $em = getOptionuserdata(); ?>
                    <a href="javascript:void(0);" data-toggle="dropdown">
                        <figure class="profile-picture">
                            <div>
                                <?php $img = FCPATH . 'media/users/' . $em['photo']; ?>
                                <?php if (!file_exists($img)) { ?>
                                    <img src="<?php echo base_url(); ?>media/Admin.png" width="32" height="32" alt="">
                                <?php } else { ?>
                                    <?php if ($em['photo']) { ?>
                                        <img src="<?php echo base_url(); ?>media/users/<?php echo $em['photo']; ?>" alt="" class="img-circle" />
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>media/Admin.png" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </figure>
                        <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                            <span class="name"><?php echo $em['name']; ?></span>
                            <span class="role"><?php echo $em['title'] ? $em['title'] : 'Administrator'; ?></span>
                        </div>

                        <i class="fa custom-caret"></i>
                    </a>
                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="<?php echo ADMIN_URL . 'user/profile' ?>"><i class="fa fa-user"></i> My Profile</a>
                            </li>
                            <li>
                                <a class="mb-xs mt-xs mr-xs modal-sizes modal-with-zoom-anim" href="#changepassword"><i class="fa fa-key"></i> Change Password</a>
                            </li>
                            <?php if ($this->session->userdata('role_code') == ROLE_ADMIN_CODE) { ?>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?php echo ADMIN_URL . 'DBExport' ?>"><i class="fa fa-file-zip-o"></i> Backup </a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?php echo ADMIN_URL . 'setting' ?>"><i class="fa fa-cog"></i> Setting</a>
                                </li>
                            <?php } ?>
                            <li>
                                <a role="menuitem" tabindex="-1" href="<?php echo ADMIN_URL . 'auth/logout' ?>"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- end: search & user box -->
        </header>
        <!-- end: header -->
        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <aside id="sidebar-left" class="sidebar-left">
                <div class="sidebar-header">
                    <div class="sidebar-title">
                        <p class="hti"><b><?php echo getOptionValue('title'); ?></b></p>
                    </div>
                    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>
                <div class="nano">
                    <div class="nano-content">
                        <nav id="menu" class="nav-main" role="navigation">
                            <ul class="nav nav-main">
                                <?php if (in_array($this->session->userdata('role_code'),array(ROLE_ADMIN_CODE,ROLE_SUB_ADMIN_CODE))) { ?>
                                    <li>
                                        <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a href="<?php echo ADMIN_URL . 'category' ?>">
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <span>Category</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'category' ?>">
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <span>Category List</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'category/CatAdd' ?>">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    <span>Add Category</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'homeCategory' ?>">
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <span>Home Category</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li class="nav-parent">
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>Users</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'users/' ?>">
                                                    <i class="fa fa-users" aria-hidden="true"></i>
                                                    <span>Users List</span>
                                                </a>
                                            </li>
                                            <?php if ($this->session->userdata('role_code') == ROLE_ADMIN_CODE) { ?>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'users/usertransaction/' ?>">
                                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                                        Users Transaction
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'userpost/' ?>">
                                                    <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                                    <span>User Post</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'users/feedback/' ?>">
                                                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                                                    <span>User Feedback</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'users/otplist/' ?>">
                                                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                                                    <span>OTP List</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?php echo ADMIN_URL . 'tamplate/' ?>">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            <span>Tamplate</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo ADMIN_URL . 'videogif/' ?>">
                                            <i class="fa fa-film" aria-hidden="true"></i>
                                            <span>Video / GIF</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            <span>Photos List</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'photo' ?>">
                                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                    Photos
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'photo/category/' ?>">
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    Photos Category
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                    <?php if (in_array($this->session->userdata('role_code'),array(ROLE_ADMIN_CODE,ROLE_SUB_ADMIN_CODE))) { ?>
                                    <?php /* if ($this->session->userdata('role_code') == ROLE_ADMIN_CODE) {  */?>
                                        <li class="nav-parent">
                                            <a href="javascript:void(0);">
                                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                                <span>Application</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'MyUnit' ?>">
                                                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                                        Advertise
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'application/' ?>">
                                                        <i class="fa fa-mobile" aria-hidden="true"></i>
                                                        Application
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'dialog/' ?>">
                                                        <i class="fa fa-archive" aria-hidden="true"></i>
                                                        Dailog
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                    <?php } ?>
                                    <?php if ($this->session->userdata('role_code') == ROLE_ADMIN_CODE) { ?>
                                    <li>
                                        <a href="<?php echo ADMIN_URL . 'subscription' ?>">
                                            <i class="fa fa-paw" aria-hidden="true"></i>
                                            <span>Subscription Plan</span>
                                        </a>
                                    </li>

                                    <li class="nav-parent">
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-filter" aria-hidden="true"></i>
                                            <span>Reports</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'report/subscription/dayWiseSubscription' ?>">
                                                    <i class="fa fa-sun-o" aria-hidden="true"></i>
                                                    Day Wise Subscription
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'report/subscription/monthWiseSubscription' ?>">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    Monthly Subscription
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'report/subscription/repeatSubscriptionList' ?>">
                                                    <i class="fa fa-paw" aria-hidden="true"></i>
                                                    Repeat Subscription
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'report/users/dayWiseReg' ?>">
                                                    <i class="fa fa-users" aria-hidden="true"></i>
                                                    Daily User Register
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <li class="nav-parent">
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                            <span>Payment</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'razorpayPayment/failed' ?>">
                                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                    Payment failed
                                                </a>
                                            </li>

                                            <?php if ($this->session->userdata('role_code') == ROLE_ADMIN_CODE) { ?>
                                                <!-- <li>
                                                    <a href="<?php //echo ADMIN_URL . 'razorpayPayment/success' ?>">
                                                        <i class="fa fa-check-square" aria-hidden="true"></i>
                                                        Payment Success
                                                    </a>
                                                </li> -->
                                            <?php } ?>
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'pyments' ?>">
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    Paid Subscription
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'pyments/trial' ?>">
                                                    <i class="fa fa-money" aria-hidden="true"></i>
                                                    Trial Subscription
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    <li class="nav-parent">
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                            <span>Site Setting</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <?php if ($this->session->userdata('role_code') == ROLE_ADMIN_CODE) { ?>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'position/' ?>">
                                                        <i class="fa fa-pie-chart" aria-hidden="true"></i>
                                                        <span>Position</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'frames/' ?>">
                                                        <i class="fa fa-th-large" aria-hidden="true"></i>
                                                        <span>Frames</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'frames/subframeindex/' ?>">
                                                        <i class="fa fa-th" aria-hidden="true"></i>
                                                        <span>Sub Frames</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'setting' ?>">
                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                        Setting
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'font' ?>">
                                                        <i class="fa fa-font" aria-hidden="true"></i>
                                                        Fonts
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'notificationsend' ?>">
                                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                                        Send Notification
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'couponcode' ?>">
                                                        <i class="fa fa-ticket" aria-hidden="true"></i>
                                                        Coupon Code
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'slider/' ?>">
                                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                    <span>Slider</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'faq/' ?>">
                                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    <span>FAQ</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'filters' ?>">
                                                    <i class="fa fa-filter" aria-hidden="true"></i>
                                                    Filters
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'ImagesCopy' ?>">
                                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                    Images Copy with zip
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    <li class="nav-parent">
                                        <a href="<?php echo ADMIN_URL . 'complain' ?>">
                                            <i class="fa fa-comments" aria-hidden="true"></i>
                                            <span>Complain</span>
                                        </a>
                                    </li>

                                    <?php if ($this->session->userdata('role_code') == ROLE_ADMIN_CODE) { ?>
                                        <li class="nav-parent">
                                            <a href="javascript:void(0);">
                                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                <span>WhatsApp</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'whatsappmedia/' ?>">
                                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                        <span>WhatsApp Media</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'whatsapptemp/' ?>">
                                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                        <span>WhatsApp Template</span>
                                                    </a>
                                                </li>  
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'whatsappbulk/' ?>">
                                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                        <span>WhatsApp Bulk Add</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'whatsappbulk/autosend' ?>">
                                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                        <span>Auto Send Message</span>
                                                    </a>
                                                </li>   
                                            </ul>
                                        </li>
                                        <li class="nav-parent">
                                            <a href="javascript:void(0);">
                                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                <span>Admin</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'users/adminList' ?>">
                                                        <i class="fa fa-users" aria-hidden="true"></i>
                                                        Users
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'role' ?>">
                                                        <i class="fa fa-user-md" aria-hidden="true"></i>
                                                        Role
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if (in_array($this->session->userdata('role_code'),array(ROLE_ADMIN_CODE,ROLE_SUB_ADMIN_CODE))) { ?>
                                        <li class="nav-parent">
                                            <a href="javascript:void(0);">
                                                <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                                                <span>TeleSalas</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'telesales/dashboard' ?>">
                                                        <i class="fa fa-desktop" aria-hidden="true"></i>
                                                        Dashboard Leads
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'telesales/' ?>">
                                                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                                                        Assign Lead
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'telesales/leadassignlogs' ?>">
                                                        <i class="fa fa-history" aria-hidden="true"></i>
                                                        Lead Assign Logs
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo ADMIN_URL . 'telesales/saleslist' ?>">
                                                        <i class="fa fa-users" aria-hidden="true"></i>
                                                        Sales List
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                                <?php //if (in_array($this->session->userdata('role_code'),array(ROLE_TELESALES_CODE,ROLE_SUB_ADMIN_CODE))) { ?>
                                <?php if ($this->session->userdata('role_code') == ROLE_TELESALES_CODE) { ?>
                                    <li>
                                        <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>Users</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'users/' ?>">
                                                    <i class="fa fa-users" aria-hidden="true"></i>
                                                    <span>Users List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-parent">
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-sitemap" aria-hidden="true"></i>
                                            <span>Leads</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'teleUserSales' ?>">
                                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                                    Leads List
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_URL . 'teleUserSales/promocode' ?>">
                                                    <i class="fa fa-tag" aria-hidden="true"></i>
                                                    Promo Code
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                
                            </ul>
                        </nav>
                    </div>
                    <script>
                    if (typeof localStorage !== 'undefined') {
                        if (localStorage.getItem('sidebar-left-position') !== null) {
                            var initialPosition = localStorage.getItem('sidebar-left-position'),
                                sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                            sidebarLeft.scrollTop = initialPosition;
                        }
                    }
                    </script>
                </div>
            </aside>
            <!-- end: sidebar -->
