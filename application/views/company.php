    <div id="data-list">
            <input id="permission" type="hidden" value="" /> 
            <input id="p_modify" type="hidden" value="<?=$p_modify?>" /> 
            <input id="p_delete" type="hidden" value="<?=$p_delete?>" /> 
           <?php if($p_entry==1){ ?>
			<!-- <button class="btn btn-xs btn-primary btn_entry" onclick="ShowForm(); BlankForm();  return false;">
			    ADD NEW
		    </button> -->
		    <?php }?>
		   
		   
            <br />
			<div class="loading"></div>
			<?php if($p_list==1){ ?>
            <div id="data-list-table">
            <?php }?>
            </div>
    </div>
    <div id="data-form" style="display:none;">
        <div class="done" style="display:none;">
            <h3>Record Saved.</h3>
        </div>

	    <div class="widget-box">
	    <div class="widget-header">
		    <h4 class="widget-title">Manage Company</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="uname" id="uname" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Company Name</label>

			<div class="col-sm-3">
				<input  type="text"  name="name" id="name" data-rule-required="true"  placeholder="Name" class="col-xs-10 col-sm-12" />
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Contact Person</label>

			<div class="col-sm-3">
				<input  type="text" name="cperson" id="cperson"  placeholder="Contact Person" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Address</label>

			<div class="col-sm-3">
				<input  type="text" name="address" id="address"  placeholder="Address" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> State</label>

			<div class="col-sm-3">
				<input  type="text"  name="state" id="state" data-rule-required="true"  placeholder="State" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> District</label>

			<div class="col-sm-3">
				<input  type="text" name="district" id="district"  placeholder="District" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mobile No. 1</label>

			<div class="col-sm-3">
				<input  type="text"  name="mobileno" id="mobileno" data-rule-required="true"  placeholder="Mobile No." class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Land Line</label>

			<div class="col-sm-3">
				<input  type="text" name="landline" id="landline"  placeholder="Land Line" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mobile No. 2</label>

			<div class="col-sm-3">
				<input  type="text"  name="mobileno2" id="mobileno2" data-rule-required="true"  placeholder="Mobile No. 2" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Company Slogen</label>

			<div class="col-sm-3">
				<input  type="text" name="slogen" id="slogen"  placeholder="Company Slogen" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Company Logo</label>
			<div class="col-sm-3">
				<input type='file' id='logo' name='logo' class='form-control' />
				<input type="hidden" id="logofilepath" name="logofilepath" readonly="readonly"/>
			 	<input type="hidden" id="logofilename" name="logofilename" readonly="readonly"/>
			 	 
			</div> 
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Company Header</label>
			<div class="col-sm-3">
				<input type='file' id='header1' name='header1' class='form-control' />
				<input type="hidden" id="headerfilepath" name="headerfilepath" readonly="readonly"/>
			 	<input type="hidden" id="headerfilename" name="headerfilename" readonly="readonly"/>
			</div> 

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Company Footer</label>
			<div class="col-sm-3">
				<input type='file' id='footer' name='footer' class='form-control' />
				<input type="hidden" id="footerfilepath" name="footerfilepath" readonly="readonly"/>
			 	<input type="hidden" id="footerfilename" name="footerfilename" readonly="readonly"/>
			</div> 
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> GSTN Type</label>

			<div class="col-sm-3">
				<input  type="text" name="gstntype" id="gstntype"  placeholder="GSTN Type" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> GSTN NO</label>

			<div class="col-sm-3">
				<input  type="text"  name="gstn" id="gstn" data-rule-required="true"  placeholder="GSTN NO" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Udyog Aadhaar Number </label>

			<div class="col-sm-3">
				<input  type="text" name="cin" id="cin"  placeholder="CIN" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gmail</label>

			<div class="col-sm-3">
				<input  type="text"  name="gmail" id="gmail" data-rule-required="true"  placeholder="Gmail" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Website</label>

			<div class="col-sm-3">
				<input  type="text" name="website" id="website"  placeholder="http://" class="col-xs-10 col-sm-12" />
			</div>

		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Account Holder 1</label>

			<div class="col-sm-3">
				<input  type="text" name="ac_holder" id="ac_holder"  placeholder="Account Holder" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bank Name 1</label>

			<div class="col-sm-3">
				<input  type="text"  name="bankname" id="bankname" data-rule-required="true"  placeholder=" Bank Name" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Account No. 1</label>

			<div class="col-sm-3">
				<input  type="text" name="ac_no" id="ac_no"  placeholder="A/C No" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> IFSC Code 1</label>

			<div class="col-sm-3">
				<input  type="text"  name="ifsccode" id="ifsccode" data-rule-required="true"  placeholder=" IFSC Code" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Account Holder 2</label>

			<div class="col-sm-3">
				<input  type="text" name="ac_holder2" id="ac_holder2"  placeholder="Account Holder" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bank Name 2</label>

			<div class="col-sm-3">
				<input  type="text"  name="bankname2" id="bankname2" data-rule-required="true"  placeholder=" Bank Name" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Account No. 2</label>

			<div class="col-sm-3">
				<input  type="text" name="ac_no2" id="ac_no2"  placeholder="A/C No" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> IFSC Code 2</label>

			<div class="col-sm-3">
				<input  type="text"  name="ifsccode2" id="ifsccode2" data-rule-required="true"  placeholder=" IFSC Code" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Terms & Condition</label>

			<div class="col-sm-8">
				<textarea  type="text" name="termcondition" id="termcondition"  placeholder="Terms & Condition" class="col-xs-10 col-sm-12" ></textarea>
			</div>

		</div>
		<div class="space-4"></div>



		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  class="btn btn-info" type="button" id="newsubmit" >
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

		<script type="text/javascript">
		    function ShowForm() {
		        $('#data-list').fadeOut(500, function () {
		            $('#data-form').fadeIn(500);
				    $("[tabindex='1']").focus();
		        });
		    }
		    function BlankForm() {
		        $('#userform').find('input:text').val('');
		        $('#userform').find('input:hidden').val('');
		        $('#userform')[0].reset();
		        $('#userform').find('input:password').val('');
		        $('#status').val('add');
		    }
		    function ShowList() {
		        $('#data-form').fadeOut(500, function () {
		            $('#data-list').fadeIn(500);
		            GetList();
		        });
		    }

		    function GetList() {
		    	p_modify=$('#p_modify').val();
		        p_delete=$('#p_delete').val();
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/company_list",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
		                $('#data-list-table table').DataTable( {
					        "fnDrawCallback": function( oSettings ) {
					           //CheckPermission(11);
					        }
					    } );
					    if(p_modify!=1)
					    {
					    	$('.btn_modify').css('visibility','hidden');
					    }
					    if(p_delete!=1)
					    {
					    	$('.btn_delete').css('visibility','hidden');
					    }
		                $(".loading").hide();
		            }
		        });
		    }

		    $(document).ready(function () {
					            CheckPermission(11);
		    	MoveTextBox('.form-input');
		        $("#data-list").show();
		        $("#data-form").hide();
		        GetList();

		        $('#userform').validate({
		            errorElement: 'div',
		            errorClass: 'help-block',
		            focusInvalid: false,
		            rules: {
		                name: {
		                    required: true,
		                    minlength: 3
		                },
		                district: {
		                    required: true
		                }
		            },

		            messages: {
		                name: {
		                    required: "Please provide Name.",
		                    minlength: "Name Should be min. 3 characters."
		                },
		                district: {
		                    required: "Please provide District."
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
		                $('#userform').ajaxSubmit({
		                    url: "<?php echo base_url();?>index.php/master_general/company_save",
		                    type: "POST",
		                    data: data,
		                    cache: false,
		                    success: function (html) {
		                    	console.log(html);
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
		        var url = "<?php echo base_url();?>index.php/master_general/company_get?id=" + ID;
		        $.get(url, function (data) {
		        	console.log(report_obj);
		            var report_obj = JSON.parse(data);

		            if (report_obj.Message == "Success") {
		                $("#name").val(report_obj.name);
		                $("#uname").val(report_obj.name);
		                $("#address").val(report_obj.address);
		                $("#cperson").val(report_obj.cperson);
		                $("#state").val(report_obj.state);
		                $("#district").val(report_obj.district);
		                $("#mobileno").val(report_obj.mobileno);
		                $("#landline").val(report_obj.landline);
		                $("#mobileno2").val(report_obj.mobileno2);
		                $("#slogen").val(report_obj.slogen);
		                $("#gstntype").val(report_obj.gstntype);
		                $("#gstn").val(report_obj.gstn);
		                $("#termcondition").val(report_obj.termcondition);
		                $("#logofilepath").val(report_obj.logofilepath);
		                $("#logofilename").val(report_obj.logofilename);
		                $("#headerfilepath").val(report_obj.headerfilepath);
		                $("#headerfilename").val(report_obj.headerfilename);
		                $("#footerfilepath").val(report_obj.footerfilepath);
		                $("#footerfilename").val(report_obj.footerfilename);

		                $("#cin").val(report_obj.cin);
		                $("#gmail").val(report_obj.gmail);
		                $("#website").val(report_obj.website);
		                $("#ac_holder").val(report_obj.ac_holder);
		                $("#bankname").val(report_obj.bankname);
		                $("#ac_no").val(report_obj.ac_no);
		                $("#ifsccode").val(report_obj.ifsccode);
		                
		                $("#sno").val(report_obj.id);
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
		            $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/helperController/delete/m_company/company_id",
		                    type: "POST",
		                    data: {ID: ID},
		                    cache: false,
		                    success: function (html) {
		                        $('.loading').hide();
		                        if(html==1){
		                        	ShowList();
		                            GetList();
		                            $('.done').html("<h4>Record Deleted.</h4>");
		                            $('.done').fadeIn('slow', function () { });
		                            $('.done').delay(600).fadeOut('slow', function () { });
		                        }
		                        else if(html==2){
                                    alert('Sorry Delete Operation Failed !');
		                        }
		                        else{
		                        	alert('Sorry, unexpected error. Please try again later.');
		                        }	
		                    }
		                });
		                return false;
		        }
		      }

				</script>
