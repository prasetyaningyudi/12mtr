		<!-- start modal -->
		<div class="modal-filter">
			<div class="filter-dialog">	
				<form method="post" id="form-filter"> 
				<div class="filter-header row align-middle">
					<div class="col-md-8 col-sm-8 col-xs-8 filter-title">Filters</div>
					<button type="button" class="col-md-2 col-sm-2 col-xs-2 close button-filter-close pull-right" >
					  <span aria-hidden="true">&times;</span>
					</button>				
				</div>	
				<div class="filter-body">
				
				</div>	
				<div class="filter-footer row align-middle">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input role="button" type="reset" id="button-reset" name="reset" class="btn-block btn btn-info" value="reset">
					</div>					
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input role="button" type="submit" id="button-submit-filter" name="submit" class="btn-block btn btn-primary align-right" value="submit">
					</div>
				</div>
				</form>
			</div>
		</div>

		<div class="modal fade" id="modal-add" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Modal Add</h4>
				</div>
				<div class="modal-body">
				  <p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			  
			</div>
		</div>	

		<div class="modal fade" id="modal-edit" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Modal Edit</h4>
				</div>
				<div class="modal-body">
				  <p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			  
			</div>
		</div>

		<div class="modal fade" id="modal-delete" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Modal Delete</h4>
				</div>
				<div class="modal-body">
				  <p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			  
			</div>
		</div>

		<div class="modal fade" id="modal-detail" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Modal Detail</h4>
				</div>
				<div class="modal-body">
				  <p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			  
			</div>
		</div>			
		<!-- end modal -->
		
		
		<div class="top_toolbar">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12 toolbar-left align-middle">
				TESSS
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12 toolbar-right">
					<div class="button-toolbar-item">
						<a href="#" data-toggle="modal" data-target="#modal-detail">
							<i style="font-size: 16px;" class="fa fa-layer-group"></i><br>TOOLBAR
						</a>
					</div>					
					<div class="button-toolbar-item button-add">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-add">
							<i style="font-size: 16px;" class="fa fa-plus"></i><br>ADD
						</a>
					</div>								
					<div class="button-toolbar-item button-xls">
						<a href="javascript:void(0)">
							<i style="font-size: 16px;" class="fa fa-file-excel"></i><br>XLS
						</a>
					</div>					
					<div class="button-toolbar-item button-pdf">
						<a href="javascript:void(0)">
							<i style="font-size: 16px;" class="fas fa-file-pdf"></i><br>PDF
						</a>
					</div>			
					<div class="button-toolbar-item button-filter">
						<a href="javascript:void(0)">
							<i style="font-size: 16px;" class="fa fa-filter"></i><br>FILTER
						</a>
					</div>									
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		
        <!-- page content -->
        <div class="right_col" role="main">			  
		  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recent Activities <small>Sessions</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fas fa-times"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
					<div id="show-data">
					
					</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		
<script src="<?php echo base_url(); ?>assets/js/general.js"></script>
<script>
$(document).ready(function(){
	get_data('<?php echo site_url($class); ?>');	
});
</script>

