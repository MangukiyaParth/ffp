
<section role="main" class="content-body">
	<header class="page-header">
		<h2>User Profile</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL.'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>User Profile</span></li>
			</ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

	<!-- start: page -->
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
				<!-- <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a> -->
			</div>
			<h2 class="panel-title">Personal Information</h2>
		</header>
	<section class="panel panel-body">
		<div class="row">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="thumb-info mb-md">
					<?php $em = getOptionuserdata();?>
					<img src="<?php if($profile['photo'])  { echo base_url();?>media/users/<?php echo $profile['photo']; } else { echo base_url();?>assets/images/!logged-user.jpg <?php } ?>" class="rounded img-responsive"  id="blah" alt="John Doe">	
					<form method="post" enctype="multipart/form-data" id="editprofile">
						<span class="btn btn-primary btn-file fileedit">
							Edit <input type="file" name="image" id="imgInp" >
						</span>
					</form>
					<div class="thumb-info-title">
						<span class="thumb-info-inner"><?php echo $em['name']; ?></span>
					</div>
				</div>
				<div class="clearfix">
				</div>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<form class="form-horizontal" method="post" action="javascript:void(0);" id="profileedit">
					<!-- <h4 class="mb-xlg">Personal Information</h4> -->
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="tabs">
								<div id="edit" class="tab-pane active">
									<fieldset>
										<div class="form-group">
											<label class="col-md-12 control-label" for="profileFirstName">Name</label>
											<div class="col-md-12">
												<input type="text" class="form-control" id="guj1" name="name" value="<?php echo $profile['name'];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12 control-label" for="profileAddress">Address</label>
											<div class="col-md-12">
												<textarea class="form-control" rows="3" id="guj2" name="address"><?php echo ($profile['address']);?></textarea>
											</div>
										</div>
									</fieldset>
								</div>
							</div>	
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="tabs">
								<div id="edit" class="tab-pane active">
									<fieldset>
										<div class="form-group">
											<label class="col-md-12 control-label" for="profileLastName">Mobile No</label>
											<div class="col-md-12">
												<input type="text" data-plugin-masked-input data-plugin-maxlength maxlength="10" class="form-control onlynumber"  id="pmobile" name="mobile" value="<?php echo ($profile['mobile']);?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12 control-label" for="profileBio">Note</label>
											<div class="col-md-12">
												<textarea class="form-control" rows="3" id="guj3" name="note"><?php echo ($profile['note']);?></textarea>
											</div>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="float: right;">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>	
		</div>	
	</section>



	
	<!-- end: page -->
</section>
	<script type="text/javascript" >
    google.load("elements", "1", {
            packages: "transliteration"
          });

      function onLoad() {
        var options = {
            sourceLanguage:
                google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage:
                [google.elements.transliteration.LanguageCode.GUJARATI],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };
        var control =
            new google.elements.transliteration.TransliterationControl(options);
            if($(".filter").length > 0){
                 $('.filter').each( function (i) {
                    var fil = this.id;
                    control.makeTransliteratable([fil]);
                 })
            }
            if ($("#guj6").length > 0){
            control.makeTransliteratable(['guj6']);
        }
        if ($("#guj7").length > 0){
            control.makeTransliteratable(['guj7']);
        }
        if ($("#guj8").length > 0){
            control.makeTransliteratable(['guj8']);
        }
        if ($("#guj9").length > 0){
            control.makeTransliteratable(['guj9']);
        }
        if ($("#guj10").length > 0){
            control.makeTransliteratable(['guj10']);
        }
        if ($("#guj1").length > 0) {

            control.makeTransliteratable(['guj1']);
        }
        if ($("#guj2").length > 0) {
            control.makeTransliteratable(['guj2']);
        }
        if ($("#guj3").length > 0){
            control.makeTransliteratable(['guj3']);
        }
        if ($("#guj4").length > 0){
            control.makeTransliteratable(['guj4']);
        }
        if ($("#guj5").length > 0){
            control.makeTransliteratable(['guj5']);
        }

        
      }
      google.setOnLoadCallback(onLoad);
     

      function onSearch(val) {
            
                setTimeout(function() {

                    var hasSpace = $("#guj6").val().indexOf(' ')>=0;
                    /*if(hasSpace) {
                        val=$.trim($("#guj6").val());
                        $("#guj6").val(val);
                    }*/
                    /*var t = $('.select2-hidden-accessible').parents('body').find('span').find('.select2-search__field');

                        t.attr({id:"guj6",translate:"yes",lang:"gu",onkeypress:"onLoad();",onkeyup:"onSearch(this.value);" });*/
                   }, 1000);
            }
            /*$('b').html(hasSpace ? 'has space' : "doesn't have space");*/

    </script>