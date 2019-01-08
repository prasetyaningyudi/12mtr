		<!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>			
              </div>
				<?php
					$notes = '';
					if(!empty($app_data)){
						foreach($app_data as $value) {
							$notes = $value->NOTES;
						}
					}
				?>			  
				<div class="marquee">
					<?php if ($notes != ''): ?>
						<?php echo $notes; ?>
					<?php else: ?> 
						d..... - .....b
					<?php endif; ?>				
				</div>	
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<?php if($this->session->PHOTO != null or $this->session->PHOTO != ''): ?>
						<img src="<?php echo $this->session->PHOTO; ?>" alt=""><?php echo $this->session->USERNAME; ?>
					<?php else: ?>
						<img src="<?php echo base_url(); ?>assets/images/avatar.png" alt=""><?php echo $this->session->USERNAME; ?>
					<?php endif; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
				    <li><a href="javascript:;">Login as <?php echo $this->session->ROLE_NAME; ?></a></li>
                    <li><a href="<?php echo base_url().'user/'; ?>"> Profile</a></li>
                    <!-- <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li> -->
                    <li><a href="<?php echo base_url().'authentication/logout/'; ?>"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                  </ul>
				  </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->