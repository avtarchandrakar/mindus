<!DOCTYPE html>
<html>
    <head>
    	<?php
    		$this->load->view('head');
    	?>
    </head>

	<body class="no-skin">
    	<?php
    		$this->load->view('header');
    	?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
			    try { ace.settings.check('main-container', 'fixed') } catch (e) { }
			</script>

	    	<?php
	    		$this->load->view('menu');
	    	?>





			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
					    try { ace.settings.check('breadcrumbs', 'fixed') } catch (e) { }
					</script>

					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="#">Home</a>
						</li>
						<li class="active">Area</li>
					</ul><!-- /.breadcrumb -->

					<div class="nav-search" id="nav-search">
						<form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="ace-icon fa fa-search nav-search-icon"></i>
							</span>
						</form>
					</div><!-- /.nav-search -->
				</div>

				<div class="page-content">
					<div class="page-content-area">
						<div class="page-header">
							<h1>
								Area
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                <div id="data-list">
									    <button class="btn btn-xs btn-primary" onclick="ShowForm(); BlankForm();  return false;">
										    ADD NEW
									    </button>
                                        <br />
                        				<div class="loading"></div>
                                        <div id="data-list-table">
                                        </div>
                                </div>
                                <div id="data-form" style="display:none;">
		                            <div class="done" style="display:none;">
			                            <h3>Record Saved.</h3>
		                            </div>

    							    <div class="widget-box">
								    <div class="widget-header">
									    <h4 class="widget-title">Manage Area</h4>
								    </div>
									<div class="widget-body">
										<div class="widget-main">
                                    <form action="#" class="form-horizontal" id="userform" method="post" role="form">
                                    <input type="hidden" value="add" name="status" id="status" class="form-control" />
                                    <input type="hidden" value="" name="sno" id="sno" class="form-control" />
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name</label>

										<div class="col-sm-9">
											<input type="text" name="area_name" id="area_name" data-rule-required="true"  placeholder="Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="space-4"></div>



									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="button" id="newsubmit" >
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
											&nbsp; &nbsp; &nbsp;
									        <button class="btn btn-primary" onclick="ShowList(); return false;">
										        LIST
									        </button>
										</div>
									</div>
                    				<div class="loading"></div>

									<div class="hr hr-24"></div>
								</form>
                                        
                                        </div>
                                    </div>
                                </div>
                                </div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content-area -->
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->

	    	<?php
	    		$this->load->view('footer');
	    	?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
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
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script  type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<!--<script  type="text/javascript" src="assets/js/jquery.easypiechart.min.js"></script>
		<script  type="text/javascript" src="assets/js/jquery.sparkline.min.js"></script>
		<script  type="text/javascript" src="assets/js/flot/jquery.flot.min.js"></script>
		<script  type="text/javascript" src="assets/js/flot/jquery.flot.pie.min.js"></script>
		<script  type="text/javascript" src="assets/js/flot/jquery.flot.resize.min.js"></script>
        -->
		<!-- ace scripts -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/ace.min.js"></script>


		<script type="text/javascript">
		    function ShowForm() {
		        $('#data-list').fadeOut(500, function () {
		            $('#data-form').fadeIn(500);
		        });
		    }
		    function BlankForm() {
		        $('#userform').find('input:text').val('');
		        $('#userform').find('input:password').val('');
		    }
		    function ShowList() {
		        $('#data-form').fadeOut(500, function () {
		            $('#data-list').fadeIn(500);
		            GetList();
		        });
		    }

		    function GetList() {
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/area_list",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
		                $(".loading").hide();
		            }
		        });
		    }

		    $(document).ready(function () {
		        $("#data-list").show();
		        $("#data-form").hide();
		        GetList();

		        $('#userform').validate({
		            errorElement: 'div',
		            errorClass: 'help-block',
		            focusInvalid: false,
		            rules: {
		                area_name: {
		                    required: true,
		                    minlength: 3
		                }
		            },

		            messages: {
		                area_name: {
		                    required: "Please provide Name.",
		                    minlength: "Name Should be min. 3 characters."
		                }
		            },
		            highlight: function (e) {
		                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
		            },
		            success: function (e) {
		                $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
		                $(e).remove();
		            },
		            errorPlacement: function (error, element) {
		                if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
		                    var controls = element.closest('div[class*="col-"]');
		                    if (controls.find(':checkbox,:radio').length > 1) controls.append(error);
		                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
		                }
		                else if (element.is('.select2')) {
		                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
		                }
		                else if (element.is('.chosen-select')) {
		                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
		                }
		                else error.insertAfter(element.parent());
		            },

		            submitHandler: function (form) {
		            },
		            invalidHandler: function (form) {
		            }
		        });



		        //if submit button is clicked
		        $('#newsubmit').click(function () {
		            $("#userform").validate();
		            if ($("#userform").valid() == true) {
		                var status = $('input[name=status]');
		                var data = $("#userform").serialize();
		                $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/master_general/area_save",
		                    type: "POST",
		                    data: data,
		                    cache: false,
		                    success: function (html) {
		                        $('.loading').hide();
		                        if (html == 1) {
		                            $("html, body").animate({ scrollTop: 0 }, "slow");
		                            if (status.val() == "edit") {
		                                ShowList();
		                                GetList();
		                            }
		                            else {

		                            }
		                            $('#userform').find('input:text').val('');
		                            $('#userform').find('input:password').val('');
		                            $('#Name').focus();
		                            $('.done').html("<h4>Record Saved.</h4>");
		                            $('.done').fadeIn('slow', function () { });
		                            $('.done').delay(600).fadeOut('slow', function () { });
		                        } else {
		                            if (html == 2) {
		                                alert('Already Exists');
		                            } else {
		                                alert('Sorry, unexpected error. Please try again later.');
		                            }
		                        }
		                    }
		                });
		                return false;

		            }
		        });


		    });


		    function GetRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/master_general/area_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#area_name").val(report_obj.area_name);
		                $("#sno").val(report_obj.area_id);
		                $("#status").val("edit");
		                ShowForm();
		            }
		            else {
		                alert("Invalid");
		            }
		        });
		    }


		    function DeleteRecord(ID) {
		        var r = confirm("Do You Want to Delete");
		        if (r == true) {
		            alert("Not Allowed to delete");
		        }
		    }

				</script>

	</body>

</html>
