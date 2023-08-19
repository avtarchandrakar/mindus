    <div id="data-list">
            <input id="permission" type="hidden" value="" /> 
            <input id="p_modify" type="hidden" value="<?=$p_modify?>" /> 
            <input id="p_delete" type="hidden" value="<?=$p_delete?>" /> 
           <?php if($p_entry==1){ ?>
			<button class="btn btn-xs btn-primary btn_entry" onclick="ShowForm(); BlankForm();  return false;">
			    ADD NEW
		    </button>
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
		    <h4 class="widget-title">User Management</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="uname" id="uname" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Name</label>

			<div class="col-sm-3">
				<input tabindex="1" type="text"  name="username" id="username" data-rule-required="true"  placeholder="User Name" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Password</label>

			<div class="col-sm-3">
				<input tabindex="2" type="password"  name="password" id="password" data-rule-required="true"  placeholder="Password" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<!-- <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> User Type</label>

			<div class="col-sm-3">
				<select tabindex="3" name="type" id="type" data-rule-required="true"  class="col-xs-10 col-sm-12">
				<option>Select User Type</option>
				 <option>ALL</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> User Permission</label>

			<div class="col-sm-3">
				<select tabindex="4" name="permission" id="permission" data-rule-required="true"  class="col-xs-10 col-sm-12">
				<option>Select User Permission</option>
				 <option value="1">Admin</option>
				 <option value="2">Manager</option>
				 <option value="3">Operator</option>
				</select>
			</div>
		</div> -->
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Back Date</label>

			<div class="col-sm-3">
				<select tabindex="5" name="back_date" id="back_date" data-rule-required="true"  class="col-xs-10 col-sm-12">
				<option>Select</option>
				 <option>Yes</option>
				 <option>No</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> IP Address (blank for all)</label>

			<div class="col-sm-3">
				<input tabindex="5" type="text"  name="ip_address" id="ip_address" placeholder="IP Address" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mobile 1</label>

			<div class="col-sm-3">
				<input tabindex="6" type="text"  name="mobile1" id="mobile1" placeholder="Mobile No." class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mobile 2</label>

			<div class="col-sm-3">
				<input tabindex="7" type="text"  name="mobile2" id="mobile2" placeholder="Mobile No." class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mobile 3</label>

			<div class="col-sm-3">
				<input tabindex="8" type="text"  name="mobile3" id="mobile3" placeholder="Mobile No." class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> OTP Mobile No.</label>

			<div class="col-sm-3">
				<input tabindex="9" type="text"  name="otp" id="otp" placeholder="OTP" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label for="duallist" class="col-sm-3 control-label no-padding-top"> Assign To Company</label>

			<div class="col-sm-10 multi_inst">
                     <select  tabindex="10" multiple="multiple" size="10" name="listbox[]" class='demo2 col-md-6' >
                     <? $query=$this->db->query('select company_id,company_name from m_company'); ?>
                     <? if($query->num_rows()>0){ ?>
                     <? foreach($query->result() as $row){ ?>
                     <option value="<?=$row->company_id?>"><?=$row->company_name?></option>
                     <? } } ?>
                     </select>
		   </div>
		</div>

		<div class="space-4"></div>



		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="11" class="btn btn-info" type="button" id="newsubmit" >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Submit
				</button>

				&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
			</div>
		</div>
		<div class="loading"></div>

		<div class="hr hr-24"></div>
		</form>
	</div>

		<script type="text/javascript">
		    dlist();
		    function dlist(){
		    	var demo2 = $('.demo2').bootstrapDualListbox({
                nonselectedlistlabel: 'free',
                selectedlistlabel: 'selected',
                preserveselectiononmove: 'moved',
                moveonselect: false,
                initialfilterfrom: ''
            	});
		    }
		    function ShowForm() {
		        $('#data-list').fadeOut(500, function () {
		            $('#data-form').fadeIn(500);
				    $("[tabindex='1']").focus();
		        });
		    }
		    function BlankForm() {
		        $('#userform').find('input:text').val('');
		        $('#userform').find('input:hidden').val('');
		        $('#userform').find('input:password').val('');
		        $('#status').val('add');
		    }


		    $(document).ready(function () {
		    	MoveTextBox('.form-input');
		        $("#data-form").show();
		        $("#data-list").hide();
		        ShowForm();

		        $('#userform').validate({
		            errorElement: 'div',
		            errorClass: 'help-block',
		            focusInvalid: false,
		            rules: {
		                name: {
		                    required: true,
		                    minlength: 3
		                }
		            },

		            messages: {
		                name: {
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
		           type=$('#type option:selected').text();
                   if(type!='Select User Type'){
		            if ($("#userform").valid() == true) {
		                var status = $('input[name=status]');
		                var data = $("#userform").serialize();
		                $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/master_general/user_save/id",
		                    type: "POST",
		                    data: data,
		                    cache: false,
		                    success: function (html) {
		                        $('.loading').hide();
		                        if (html == 1) {
		                            $("html, body").animate({ scrollTop: 0 }, "slow");
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
		          }else{ alert('Please Select Any One User Type !'); } // End Check User Type
		        });


		    });


		    function GetRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/master_general/user_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#username").val(report_obj.username);
		                $("#uname").val(report_obj.username);
		                $("#mobile1").val(report_obj.mobile1);
		                $("#mobile2").val(report_obj.mobile2);
		                $("#mobile3").val(report_obj.mobile3);
		                $("#otp").val(report_obj.otp);
//		                $("#openpass").val(report_obj.openpass);
		                //$("#type").val(report_obj.type);
		                //$("#permission").val(report_obj.permission);
		                $("#back_date").val(report_obj.back_date);
		                $("#ip_address").val(report_obj.ip_address);
		                $("#sno").val(report_obj.id);
		                $("#status").val("edit");
		                getInstitute(report_obj.id); //get institte
		                ShowForm();
		            }
		            else {
		                alert("Invalid");
		            }
		        });
		    }




              function getInstitute(ID){
              $('.multi_inst').html('');
              data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/userController/user_inst_list?id="+ID,
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $(".multi_inst").html(html);
		                dlist();
		                $(".loading").hide();
		            }
		        });
              }

				</script>
