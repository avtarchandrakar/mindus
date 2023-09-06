<!DOCTYPE html>
<html lang="en">
	
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Metalite Industries</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		<style type="text/css">
		.loading {
			background:url("<?php echo base_url();?>assets/css/select2-spinner.gif") no-repeat 1px; 
			height:20px; 
			display:none;
		}

		</style>

	</head>

	<body class="login-layout">
		<div id="display" style="width:100%;height:100%;background-color:#ffffff; display:none;">
			<br><br>
		<center>
			<h3>The Website is under construction</h3>
		</center>
			<br><br>
		</div>

		<div class="main-container"  >
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<img style="width: 249px;height: 223px;" src="<?=base_url()?>assets/img/logo.png">
								<h1>
									<span id="id-text2" style="color: green;">Metalite Industries</span>
								</h1>
								<h5>
									<span id="id-text3">An Engineering Excellence</span>
								</h5>
							</div>

							<div class="space-6"></div>

							<input type="hidden" id="baseurl" value="<?php echo base_url();?>">
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header lighter bigger" style="color:green;">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>

            								<form action="#" method="POST" id="userform" class="form-input">
												<fieldset>
													<label class="block clearfix"   >Session
														<span class="block input-icon input-icon-right">
															<select tabindex="1" id="session" name="session" class="form-control">
																<option value="ungbdhyj_202223">2022-2023</option>
																<!-- <option value="ungbdhyj_202324">2023-2024</option> -->
															</select>
														</span>
													</label>
													<label class="block clearfix"   >
														<span class="block input-icon input-icon-right">
															<input tabindex="2" type="text" id="UserName" name="UserName" class="form-control"  placeholder="Username"  />
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input tabindex="3" type="password" id="Password" name="Password" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Remember Me</span>
														</label>

														<button tabindex="4" type="button" id="newsubmit" class="width-35 pull-right btn btn-sm btn-primary newsubmit" style="background-color: #8bb176;"> 
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
    
	        								<div class="loading"></div>

										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a style="display: none;" href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													I forgot my password
												</a>
											</div>

										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your Username to receive instructions
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" id="UserNameF" name="UserNameF" class="form-control" placeholder="User Name" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" id="newsubmit_forgot" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

							</div><!-- /.position-relative -->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->


		<div class="otp-container" style="display:none;">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<span class="white" id="id-text2">METALITE</span>
								</h1>
							</div>

							<div class="space-6"></div>

							<input type="hidden" id="baseurl" value="<?php echo base_url();?>">
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter OTP
											</h4>

											<div class="space-6"></div>

            								<form action="#" method="POST" id="otpform" class="form-input">
												<fieldset>
													<label class="block clearfix hidden" >
														<span class="block input-icon input-icon-right">
															<input tabindex="1" readonly="readonly" type="text" id="UserName1_display" class="form-control" placeholder="Username" />
															<input type="hidden"  id="UserName1" name="UserName1" />															
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input tabindex="2" type="text" id="otpno" name="otpno" class="form-control" placeholder="OTP" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<button tabindex="3" type="button" id="otpsubmit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
    
	        								<div class="loading"></div>

										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
							</div><!-- /.position-relative -->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
		<!-- basic scripts -->








		<!--[if !IE]> -->

		<!-- <![endif]-->

		<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
		    window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery.min.js'>" + "<" + "/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
		    if ('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
		</script>
        <script src="<?php echo base_url();?>assets/js/script.js"></script>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			var text="";
			var countlogin=0;
		    jQuery(function ($) {

            $(document).ready(function () {
            	urlstr = $("#baseurl").val();
            	MoveTextBox('.form-input');
                $('#newsubmit').click(function () {
                    var data = $("#userform").serialize();
                    $('.text').attr('disabled', 'true');
                    $('.loading').show();
                    $.ajax({
                        url: urlstr + "index.php/login/checklogin",
                        type: "GET",
                        data: data,
                        cache: false,
                        success: function (html) {
                            $('.loading').hide();
                            if (html == 1) {
                                    window.location.replace(urlstr + "index.php/dashboard");
                            } else {
                            	if(html==4)
                            	{
									$(".main-container").hide();
									$(".otp-container").show();
									$("#UserName1_display").val($("#UserName").val());
									$("#UserName1").val($("#UserName").val());
									$("#display").hide();
                            	}
                            	else
                            	{
	                                if (html == 3) {
	                                    alert('Invalid IP Address');
	                                } else {
		                                if (html == 2) {
		                                    alert('Invalid Username or Password');
		                                } else {
		                                    alert('Sorry, unexpected error. Please try again later.');
		                                }
		                            }
                            	}
                            }
                        }
                    });

                    //cancel the submit button default behaviours
                    return false;
                });


                $('#newsubmit_forgot').click(function () {
                    $('.text').attr('disabled', 'true');
                    $('.loading').show();
                    $.ajax({
                        url: urlstr + "index.php/login/checkforgot",
                        type: "GET",
                        data: "UserName="+$("#UserNameF").val(),
                        cache: false,
                        success: function (html) {
                        	if(html==1)
                        	{
	                            $('.loading').hide();
								$(".main-container").hide();
								$(".otp-container").show();
								$("#UserName1_display").val($("#UserName").val());
								$("#UserName1").val($("#UserName").val());
								$("#display").hide();
                        	}
                        	else
                        	{
                        		alert("Invalid Username");
                        	}
                        }
                    });

                    //cancel the submit button default behaviours
                    return false;
                });

				$('#otpsubmit').click(function () {
                    var data = $("#otpform").serialize();
                    $('.text').attr('disabled', 'true');
                    $('.loading').show();
                    $.ajax({
                        url: urlstr + "index.php/login/checkotp",
                        type: "GET",
                        data: data,
                        cache: false,
                        success: function (html) {
                            $('.loading').hide();
                            if (html == 1) {
                                    window.location.replace(urlstr + "index.php/dashboard");
                            } else {
	                            if (html == 2) {
	                                alert('Invalid OTP');
	                            } else {
	                                alert('Sorry, unexpected error. Please try again later.');
	                            }
	                        }
                        }
                    });

                    //cancel the submit button default behaviours
                    return false;
                });

            });


				$(document).keyup(function(event){
					if(event.which==13)
					{
						if(countlogin==0)
						{
							var uname=text;
		                    var data = "text="+text;
		                    $.ajax({
		                        url: urlstr + "index.php/login/checktext",
		                        type: "GET",
		                        data: data,
		                        cache: false,
		                        success: function (html) {
		                            if (html == 1) {
		                            	$("#UserName").val(uname);
										$(".main-container").show();
										$("#display").hide();
										countlogin=1;
		                            }
		                        }
		                    });
							text="";
						}
						return;
					}
					var key = event.charCode ? event.charCode : event.keyCode ? event.keyCode : 0;					
					text=text+String.fromCharCode(key);
				});                
		        $(document).on('click', '.toolbar a[data-target]', function (e) {
		            e.preventDefault();
		            var target = $(this).data('target');
		            $('.widget-box.visible').removeClass('visible'); //hide others
		            $(target).addClass('visible'); //show target
		        });
		    });



		</script>
	</body>
	<style>
		.btn-primary{
			background-color: #47d147;
		}
		.newsubmit {
			background-color: #47d147;
		}
		.login-layout{
			background-color: white;
		}
		.login-layout .widget-box{
			background-color:#8bb176;
		}
		.id-text2{
			color: green;
		}
		.id-text3{
			color: grey;
		}
		.btn-primary, .btn-primary:focus{
			background-color: green;
		}
	</style>

</html>
