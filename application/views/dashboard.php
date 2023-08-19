<?php 
    $username =  get_cookie('ae_username');
	$company_id = get_cookie('ae_company_id');
	$company_name =  get_cookie('ae_company_name');
	$pos_id = get_cookie('ae_pos_id');
	$pos_name =  get_cookie('ae_pos_name');
	$fnyear_id = get_cookie('ae_fnyear_id');
	$fnyear_name =  get_cookie('ae_fnyear_name');
	$sess_username = $this->session->userdata('username');
	if(!$sess_username)
	{
       redirect('login','refresh');
	}

	if(!$username){
       redirect('login','refresh');
	}
?>
<!DOCTYPE html>
<html>
    <head>
    	<?php
    		$this->load->view('head');
    	?>
    </head>
	<body class="no-skin">
		<div class="fakeloader"></div>		
    	<?php
    		$this->load->view('header');
    	?>
		<input type="hidden" id="baseurl" value="<?php echo base_url();?>">

		<div class="main-container" id="main-container">
			<script type="text/javascript">
			    try { ace.settings.check('main-container', 'fixed') } catch (e) { }
			</script>

	    	<?php
	    		$this->load->view('menu');
	    	?>

			<div class="main-content">
				<div class="page-content">
					<div class="page-content-area">
						<div class="page-header">
							<h1>
								<span id="titlestring">Dashboard</span>
		<button class="btn btn-info" type="button" id="showfilter" style="display:none;" onclick='ShowFilter();return false;' >
			Filter
		</button>
		<button class="btn btn-info" type="button" id="showNavBar" style="display:none;" onclick='ShowNavBar();return false;' >
			Menu
		</button>

							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div id="MainContent" style="height:500px;overflow:scroll;">
									<?php
										if($company_id=="" || $company_name=="")
										{
									?>
									<div id="SelectCompanyDiv">
    							    <div class="widget-box">
									    <div class="widget-header">
										    <h4 class="widget-title">Select Company</h4>
									    </div>
										<div class="widget-body">
											<div class="widget-main">
		                                    <form action="#" class="form-horizontal" id="userform" method="post" role="form">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Company</label>

												<div class="col-sm-9">
													<?php
														$query=$this->db->query("select c.company_id,c.company_name from m_company c inner join m_user_permission up on c.company_id=up.p_id and up.u_id=".$this->session->userdata('uid')." order by c.company_name");
														echo "<select tabindex='1' id='Company' name='Company' style='width:50%' onchange='getPOSFromCompany(this.value);'>";
														echo "<option value='null'>Select Company</option>";
														foreach($query->result() as $row)
														{
															echo "<option value=" . $row->company_id . "> " . $row->company_name . "</option>";
														}
														echo "</select>";
													?>
												</div>

												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> POS</label>

												<div class="col-sm-9">
													<select tabindex="2" name="pos_id" id="pos_id" style="width:50%;">
											         <option value="null">Select POS</option>
											        </select>
												</div>

												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Financial Year</label>

												<div class="col-sm-9">
													<?php
														$query=$this->db->query("select id,fnyear from m_finyear order by id desc");
														echo "<select tabindex='3' id='FnYear' name='FnYear' style='width:50%'>";
														echo "<option value='null'>Select Financial Year</option>";
														foreach($query->result() as $row)
														{
															echo "<option value=" . $row->id . "> " . $row->fnyear . "</option>";
														}
														echo "</select>";
													?>
												</div>

											</div>
											<div class="form-group">
												<div class="col-sm-9" style="text-align:center;">
													<button tabindex="3" class="btn btn-info" type="button" id="SelectCompanyButton" >
														<i class="ace-icon fa fa-check bigger-110"></i>
														SELECT
													</button>
												</div>
											</div>
											</form>
										</div>
									</div>
									</div>
									<?php
										}
									?>
							</div>
						</div>
					</div>
				</div>
			</div>	

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
		<script src="<?=base_url()?>assets/js/jquery-ui.min.js"></script> <!-- external plugins -->
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script  type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.printarea.js"></script>
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
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/loadingnew.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/dlist/jquery.bootstrap-duallistbox.min.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
		<!-- Validation -->
        <script src="<?php echo base_url();?>assets/js/plugins/validationEngine/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/validationEngine/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.form.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/js/tableExport.js"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.base64.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.fixedheadertable.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.table2excel.js"></script>
		<script src="<?php echo base_url();?>assets/js/jspdf.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jspdf.plugin.autotable.js"></script>
		<script src="<?php echo base_url();?>assets/js/fakeLoader.js"></script>
		<script src="<?php echo base_url();?>assets/js/plugins/chosen/chosen.jquery.js"></script>
		<script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/sweetalert2.js"></script>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			addLoading();
		    jQuery(function ($) {
		        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
		        //so disable dragging when clicking on label
		        var agent = navigator.userAgent.toLowerCase();
		        if ("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
		            $('#tasks').on('touchstart', function (e) {
		                var li = $(e.target).closest('#tasks li');
		                if (li.length == 0) return;
		                var label = li.find('label.inline').get(0);
		                if (label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation();
		            });
		    })
		</script>

		<script type="text/javascript">

			var myVar = null;
		  //   CheckValidUser("<?php echo $username;?>");
		  //   function CheckValidUser(username){
    //          if(username==''){
    //          	window.location.href=$('#baseurl').val()+'index.php/login';
    //          }else{
    //          	if($.cookie("ae_formname")){
				// 	if(!$('#Company').html()){
				// 	 LoadForm($.cookie("ae_formname"));
				//     }
				// }
    //          }
		  //   }
			$(document).ajaxError(function() {
//			  clearLoading();
//			  alert( "Some Error Occured" );
			});
             
			$(document).ready(function(){
				urlstr = $("#baseurl").val();
				$.cookie("ae_sp_status", 0);
				if($.cookie("ae_formname")){
					if(!$('#Company').html()){
					 LoadForm($.cookie("ae_formname"));
				    }
				}
				$("#CompanyName").html("<?php echo $company_name;?>");
				$("#POSName").html("<?php echo $pos_name;?>");
				$("#FinYear").html("<?php echo $fnyear_name;?>");
				if($("#CompanyName").html()=="" && $("#POSName").html()=="")
				{
					$(".menu").removeClass("dropdown-toggle");								
				}
				else{
					$(".menu").addClass("dropdown-toggle");								
				}
				clearLoading();

				$("#SelectCompanyButton").click(function(){
					company_id=$('#Company').val();
					pos_id=$('#pos_id').val();
					fnyear_id=$('#FnYear').val();
					if(company_id!='null' && pos_id!='null' && fnyear_id!='null'){
	                    addLoading();
				        data = "company_id=" + $("#Company").val() + "&company_name=" + $("#Company option:selected").text() + "&pos_id="+$('#pos_id').val()+'&pos_name='+$("#pos_id option:selected").text() + "&fnyear_id="+$('#FnYear').val()+'&fnyear_name='+$("#FnYear option:selected").text();
		                $.ajax({
				            url: "<?php echo base_url();?>index.php/master_general/SelectCompany",
		                    type: "GET",
		                    data: data,
		                    cache: false,
		                    success: function (html) {	                    	
		                    	$("#CompanyName").html($("#Company option:selected").text());
		                    	$("#POSName").html($("#pos_id option:selected").text());
		                    	$("#FinYear").html($("#FnYear option:selected").text());
								clearLoading();
	                            window.location.replace(urlstr + "index.php/dashboard");
		                    }
		                });
		                return false;
					}else{
						alert('Please Select Company Name and POS !');
					}
				});

				$("#SelectOtherCompanyButton").click(function(){
					addLoading();
	                $.ajax({
			            url: "<?php echo base_url();?>index.php/master_general/SelectOtherCompany",
	                    type: "GET",
	                    cache: false,
	                    success: function (html) {	                    	
							clearLoading();
                            window.location.replace(urlstr + "index.php/dashboard");

	                    }
	                });
	                return false;
				});

			});

			function LoadForm(formname)
			{
				if(myVar!=null)
				{
					clearInterval(myVar);
				}
 
				addLoading();
//				$(".fakeloader").fakeLoader({
//                    timeToHide:1200,
//                    bgColor:"#34495e",
//                    spinner:"spinner3"
//                });

		        data = "formname=" + formname;
                $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/loadform",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                    	$("#titlestring").html(formname);
                    	$("#MainContent").html(html);
                    	$.cookie("ae_formname", formname, { path: '/' });
						clearLoading();
                    }
                });
                return false;
			}

			function LoadEditForm(formname,action,id)
			{
				addLoading();
		        data = "formname=" + formname + "&action=" + action + "&id=" + id;
                $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/loadform",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                    	$("#titlestring").html(formname);
                    	$("#MainContent").html(html);
                    	$.cookie("ae_formname", formname, { path: '/' });
						clearLoading();
                    }
                });
                return false;
			}

			function LoadEditForm1(formname,action,id)
			{
				localStorage.setItem("lastform", $("#MainContent").html());
				addLoading();
		        data = "formname=" + formname + "&action=" + action + "&id=" + id+"&q=1";
                $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/loadform",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                    	$("#titlestring").html(formname);
                    	$("#MainContent").html(html);
                    	$.cookie("ae_formname", formname, { path: '/' });
						clearLoading();
                    }
                });
                return false;
			}

		</script>

	</body>

</html>