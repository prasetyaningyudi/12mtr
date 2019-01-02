		<!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>assets/images/img.jpg" alt=""><?php echo $this->session->USERNAME; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
				    <li><a href="javascript:;">Login as <?php echo $this->session->ROLE_NAME; ?></a></li>
                    <li><a href="<?php echo base_url().'user/profile'; ?>"> Profile</a></li>
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