
<input type="hidden" id="baseurl" value="<?php echo base_url();?>">
<div id="navbar" class="navbar navbar-default" style="background-color: #f8f8f8;">
	<script type="text/javascript">
	    try { ace.settings.check('navbar', 'fixed') } catch (e) { }
	</script>

	<div class="navbar-container" id="navbar-container" >
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">
			<a href="#" class="navbar-brand">
				<img style="width: 50px;height: 50px;" src="<?php echo base_url();?>assets/img/logo2.png">
				<small>
					<?php

					if (get_cookie("ae_session_d")=="ungbdhyj_202223") {
						$sess = '2022-2023';
					}elseif (get_cookie("ae_session_d")=="ungbdhyj_202324") {
						$sess = '2023-2024';
					}else{
						$sess = '2022-2023';
					}

					 ?>
					<b style="color: #8bb176;">Metalite Industries  &nbsp;&nbsp;&nbsp;Session : <?=$sess?></b>
					<p style="color: black;font-size: 12px;margin-left: 50px;display: none;"></p>
				</small>
				
			</a>
		</div>
		<div style="width:500px;text-align:center;"  class="navbar-header pull-left">
			<a href="#" class="navbar-brand" style="font-size:16px;width:150%; color:yellow;display: none;">
					Company Name : <span id="CompanyName"></span>
					, POS Name : <span id="POSName"></span> 											
					, Fin.Year : <span id="FinYear"></span> 											
					<button class="btn btn-info" type="button" id="SelectOtherCompanyButton" style="padding:0px;background-color: #800080;" >
						<i class="ace-icon fa"></i>
						Select Other Company
					</button>

			        <? if(get_cookie('ae_userpermission')==1){ ?>
					<span style="width:200px;height:100px;" onclick="LoadForm('History');">
							&nbsp;&nbsp;&nbsp;&nbsp;
					</span>					
					<?}?>
			</a>
		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation" style="background-color: #800080;">
			<ul class="nav ace-nav">
				<li class="purple" style="display:none;">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="ace-icon fa fa-bell icon-animated-bell"></i>
						<span class="badge badge-important">8</span>
					</a>

					<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-exclamation-triangle"></i>
							8 Notifications
						</li>

						<li>
							<a href="#">
								<div class="clearfix">
									<span class="pull-left">
										<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
										New Comments
									</span>
									<span class="pull-right badge badge-info">+12</span>
								</div>
							</a>
						</li>

						<li>
							<a href="#">
								<i class="btn btn-xs btn-primary fa fa-user"></i>
								Bob just signed up as an editor ...
							</a>
						</li>


						<li class="dropdown-footer">
							<a href="#">
								See all notifications
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>

				<li class="green"  style="display:none;">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
						<span class="badge badge-success">5</span>
					</a>

					<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-envelope-o"></i>
							5 Messages
						</li>

						<li class="dropdown-content">
							<ul class="dropdown-menu dropdown-navbar">
								<li>
									<a href="#">
										<img src="<?php echo base_url();?>assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Alex:</span>
												Ciao sociis natoque penatibus et auctor ...
											</span>

											<span class="msg-time">
												<i class="ace-icon fa fa-clock-o"></i>
												<span>a moment ago</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="<?php echo base_url();?>assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Susan:</span>
												Vestibulum id ligula porta felis euismod ...
											</span>

											<span class="msg-time">
												<i class="ace-icon fa fa-clock-o"></i>
												<span>20 minutes ago</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="<?php echo base_url();?>assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Bob:</span>
												Nullam quis risus eget urna mollis ornare ...
											</span>

											<span class="msg-time">
												<i class="ace-icon fa fa-clock-o"></i>
												<span>3:15 pm</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="<?php echo base_url();?>assets/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Kate:</span>
												Ciao sociis natoque eget urna mollis ornare ...
											</span>

											<span class="msg-time">
												<i class="ace-icon fa fa-clock-o"></i>
												<span>1:33 pm</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="<?php echo base_url();?>assets/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Fred:</span>
												Vestibulum id penatibus et auctor  ...
											</span>

											<span class="msg-time">
												<i class="ace-icon fa fa-clock-o"></i>
												<span>10:09 am</span>
											</span>
										</span>
									</a>
								</li>
							</ul>
						</li>

						<li class="dropdown-footer">
							<a href="inbox.html">
								See all messages
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>

				<li class="light-blue">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<img class="nav-user-photo" src="<?php echo base_url();?>assets/img/logo.jpg" alt="Jason's Photo" />
						<span class="user-info">
							<small>Welcome,</small>
							MI User
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li style="display: none;"> 
							<a href="#">
								<i class="ace-icon fa fa-cog"></i>
								Settings
							</a>
						</li>

						<li  style="display: none;">
							<a href="profile.html">
								<i class="ace-icon fa fa-user"></i>
								Profile
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="<?php echo base_url();?>index.php/login/logout">
								<i class="ace-icon fa fa-power-off"></i>
								Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div><!-- /.navbar-container -->
</div>

