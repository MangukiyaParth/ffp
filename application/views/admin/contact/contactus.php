<section role="main" class="content-body">
	<header class="page-header">
		<h2>Contact Us List</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo ADMIN_URL.'dashboard/' ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span class="listname" >Contact List</span></li>
			</ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
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
						
								<h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a>  &nbsp;Contact List (<?php echo count($contlist);?>) <!--  <a href="javascript:void(0)" class="right mb-xs mt-xs mr-xs btn padheader btn-primary " onclick="deleterecord('rem','/contact/deletecontact');"><i class="fa fa-trash"></i></i> <span> &nbsp;Clear data</span></a> --></h2>
							</header>
							<div class="panel-body">
							<button  class="btn btn-danger btnmar delete_all_con" data-url="<?php //echo ADMIN_URL . 'contact/deleteAll'; ?>">Delete</button>
						</br>
						</br>
						<div class="table-responsive">
								<table class="table table-bordered table-striped mb-none datatable-tabletools" id="" >
									<thead>
										<tr>
											<th width="3%"><div class="checkbox-custom checkbox-primary"><input type="checkbox" name="allcheck"  onclick="checkallcont();" class="master"  id="checkboxExample2"><label for="checkboxExample2"></label></div></th>
											<th width="5%">ID</th>
											<th width="20%">Name</th>
											<th width="20%">Email</th>
											<th width="5%">Mobile No</th>
											<th>Message</th>
											<th width="10%">Date</th>
											<th width="5%" >Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i=1; foreach ($contlist as $key) { ?>
										<tr id="<?php echo $key['cu_id'];?>">
											<td> <div class="checkbox-custom checkbox-primary"><input type="checkbox" name="" data-id="<?php echo $key['cu_id']; ?>" class="case" value="<?php echo $key['cu_id']; ?>"><label for="checkboxExamples"></label></div></td>
											<td><?php echo $i;?></td>
											<td><?php echo $key['name'];?></td>
											<td><?php echo $key['email'];?></td>
											<td><?php echo $key['mobile'];?></td>
											<td><?php echo $key['message'];?></td>
											<td><?php $newdate = date("d-m-Y", strtotime($key['created_date'])); echo $newdate;?></td>
											<td>
												<div class="btn-group">
                                                     <a href="javascript:void(0)" id="<?php echo $key['cu_id']; ?>" onclick="deleterecord(this.id,'/contact/deletecontactus');"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                	</a>
                                                </div>
                                            </td>
										</tr>
										<?php $i++; } ?>
									</tbody>
									
								</table>
							</div>
							</div>
						</section>
			</div>
		</div>

	<!-- end: page -->
</section>
<!-- <script type="text/javascript">
	$(document).ready(function() {
    $('#datatable-tabletools tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    var table = $('#datatable-tabletools').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>
 -->