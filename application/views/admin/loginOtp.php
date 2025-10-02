<!doctype html>
<html class="fixed">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="" />
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/theme.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/skins/default.css" />
	<script> var Admin_url = '<?php echo ADMIN_URL?>';</script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/theme-custom.css">
	<script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>
</head>

<body>
	<!-- start: page -->
	<section class="body-sign" id="loginSection">
		<div class="center-sign">
			<!-- <a href="javascripts:void(0);" class="logo pull-left" style="width: 50%;">
				<?php /* if (getOptionValue('site_logo')) { ?>
					<img src="<?php echo base_url() . 'media/users/' . getOptionValue('site_logo'); ?>" style="width: 30%;" alt="Hanol" />

				<?php } else { ?>
					<h4><?php echo strtoupper(getOptionValue('sitename')); ?></h4>
				<?php } */?>
			</a> -->
			<div class="panel panel-sign">
				<div class="panel-title-sign mt-xl text-right">
					<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i>Log In</h2>
				</div>
				<div class="panel-body">

					
				<div class="msg"></div>

					<form method="post" id="otpLogin" class="with-otp">
						<div class="form-group mb-lg" id="otp_section">
							<label>Otp</label>
							<div class="input-group input-group-icon">
								<input name="otp" type="text" id="otp" placeholder="Enter otp" class="form-control input-lg" />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-key"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-8">
							</div>
							<div class="col-sm-4 text-right">
								<button type="submit" class="btn btn-primary btn-block btn-lg visible mt-lg">Log In</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</section>
	<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
	<script src="<?php echo base_url(); ?>assets/javascripts/theme.js"></script>
	<script src="<?php echo base_url(); ?>assets/javascripts/theme.login-otp.js"></script>
	<script src="<?php echo base_url(); ?>assets/javascripts/theme.init.js"></script>
</body>

</html>

 
<script type="text/javascript">
function disableSelection(e) {
    if (typeof e.onselectstart != "undefined") e.onselectstart = function() {
        return false
    };
    else if (typeof e.style.MozUserSelect != "undefined") e.style.MozUserSelect = "none";
    else e.onmousedown = function() {
        return false
    };
    e.style.cursor = "default"
}
window.onload = function() {
    disableSelection(document.body)
}
</script>
<script type="text/javascript">
function mousedwn(e) {
    try {
        if (event.button == 2 || event.button == 3) return false
    } catch (e) {
        if (e.which == 3) return false
    }
}
document.oncontextmenu = function() {
    return false
};
document.ondragstart = function() {
    return false
};
document.onmousedown = mousedwn
</script>
<script type="text/javascript">
window.addEventListener("keydown", function(e) {
    if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 67 || e.which == 73 || e.which == 80 || e.which == 83 || e.which == 85 || e.which == 86)) {
        e.preventDefault()
    }
});
document.keypress = function(e) {
    if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 67 || e.which == 73 || e.which == 80 || e.which == 83 || e.which == 85 || e.which == 86)) {}
    return false
}
</script>
<script type="text/javascript">
document.onkeydown = function(e) {
    e = e || window.event;
    if (e.keyCode == 123 || e.keyCode == 18) {
        return false
    }
}
</script> 