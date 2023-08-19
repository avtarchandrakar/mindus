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
		    <h4 class="widget-title">Manage Custome</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="uname" id="uname" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Ref</label>

			<div class="col-sm-10">
				<input type="text"  name="ref" id="ref" data-rule-required="true"  placeholder="Ref" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Sub</label>

			<div class="col-sm-10">
				<input type="text"  name="sub" id="sub" data-rule-required="true"  placeholder="Sub" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Header</label>

			<div class="col-sm-10">
				<input type="text"  name="header" id="header" data-rule-required="true"  placeholder="Header" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Taxes</label>

			<div class="col-sm-10">
				<input type="text"  name="taxes" id="taxes" data-rule-required="true"  placeholder="Taxes" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Scope of Work</label>

			<div class="col-sm-10">
				<input type="text"  name="scope_of_work" id="scope_of_work" data-rule-required="true"  placeholder="Scope of Work" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Design Criteria</label>

			<div class="col-sm-10">
				<input type="text"  name="design_criteria" id="design_criteria" data-rule-required="true"  placeholder="Design Criteria" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Delivery Period</label>

			<div class="col-sm-10">
				<input type="text"  name="delivery_period" id="delivery_period" data-rule-required="true"  placeholder="Delivery Period" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Payment Terms</label>
			<div class="col-sm-10">
				<input type="text"  name="payment_terms" id="payment_terms" data-rule-required="true"  placeholder="Payment Terms" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Validity of offer</label>
			<div class="col-sm-10">
				<input type="text"  name="validity_of_offer" id="validity_of_offer" data-rule-required="true"  placeholder="Validity of offer" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Note</label>
			<div class="col-sm-10">
				<input type="text"  name="note" id="note" data-rule-required="true"  placeholder="Note" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Performance Warranty</label>
			<div class="col-sm-10">
				<input type="text"  name="performance_warranty" id="performance_warranty" data-rule-required="true"  placeholder="Performance Warranty" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Equipment Acceptance</label>
			<div class="col-sm-10">
				<input type="text"  name="equipment_acceptance" id="equipment_acceptance" data-rule-required="true"  placeholder="Equipment Acceptance" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Supervision of Erection &amp; Commissioning</label>
			<div class="col-sm-10">
				<input type="text"  name="supervision_commissioning" id="supervision_commissioning" data-rule-required="true"  placeholder="Supervision of Erection &amp; Commissioning:" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Training</label>
			<div class="col-sm-10">
				<input type="text"  name="training" id="training" data-rule-required="true"  placeholder="Training" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">General Safety</label>
			<div class="col-sm-10">
				<input type="text"  name="general_safety" id="general_safety" data-rule-required="true"  placeholder="General Safety" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Spare Parts</label>
			<div class="col-sm-10">
				<input type="text"  name="spare_parts" id="spare_parts" data-rule-required="true"  placeholder="Spare Parts" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Transportation of chassis &amp; equipment</label>
			<div class="col-sm-10">
				<input type="text"  name="chassis_equipment" id="chassis_equipment" data-rule-required="true"  placeholder="Transportation of chassis &amp; equipment" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">GST Tax</label>
			<div class="col-sm-10">
				<input type="text"  name="gst_tax" id="gst_tax" data-rule-required="true"  placeholder="GST Tax" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Mobile Crane</label>
			<div class="col-sm-10">
				<input type="text"  name="mobile_crane" id="mobile_crane" data-rule-required="true"  placeholder="Mobile Crane" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Scope Of Unloading</label>
			<div class="col-sm-10">
				<input type="text"  name="scope_of_unloading" id="scope_of_unloading" data-rule-required="true"  placeholder="Scope Of Unloading" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Overdue Intrest & Wherehousing Charge</label>
			<div class="col-sm-10">
				<input type="text"  name="intrest_charge" id="intrest_charge" data-rule-required="true"  placeholder="Overdue Intrest & Wherehousing Charge" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Cancellation</label>
			<div class="col-sm-10">
				<input type="text"  name="cancellation" id="cancellation" data-rule-required="true"  placeholder="Cancellation" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Jurisdication</label>
			<div class="col-sm-10">
				<input type="text"  name="jurisdication" id="jurisdication" data-rule-required="true"  placeholder="Jurisdication" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Documents Provided During Delivery</label>
			<div class="col-sm-10">
				<input type="text"  name="documents_provided" id="documents_provided" data-rule-required="true"  placeholder="Documents Provided During Delivery" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Load Test</label>
			<div class="col-sm-10">
				<input type="text"  name="load_test" id="load_test" data-rule-required="true"  placeholder="Load Test" class="col-xs-10 col-sm-12" />
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
			        Back
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
		            url: "<?php echo base_url();?>index.php/master_general/custome_list",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		            	// console.log(html);
		                $("#data-list-table").html(html);
		                $('#data-list-table table').DataTable( {
					        "fnDrawCallback": function( oSettings ) {
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
	            CheckPermission(14);
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
		            if ($("#userform").valid() == true) {
		                var status = $('input[name=status]');
		                var data = $("#userform").serialize();
		                $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/helperController/m_insert_custome/m_custome/id",
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
		        var url = "<?php echo base_url();?>index.php/master_general/custome_get?id=" + ID;
		        $.get(url, function (data) {
		        	// console.log(data);
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#ref").val(report_obj.ref);
		                $("#sub").val(report_obj.sub);
		                $("#header").val(report_obj.header);
		                $("#taxes").val(report_obj.taxes);
		                $("#sno").val(report_obj.id);
		                $("#scope_of_work").val(report_obj.scope_of_work);
		                $("#design_criteria").val(report_obj.design_criteria);
		                $("#delivery_period").val(report_obj.delivery_period);
		                $("#payment_terms").val(report_obj.payment_terms);
		                $("#validity_of_offer").val(report_obj.validity_of_offer);
		                $("#note").val(report_obj.note);
		                $("#performance_warranty").val(report_obj.performance_warranty);
		                $("#equipment_acceptance").val(report_obj.equipment_acceptance);
		                $("#supervision_commissioning").val(report_obj.supervision_commissioning);
		                $("#training").val(report_obj.training);
		                $("#general_safety").val(report_obj.general_safety);
		                $("#spare_parts").val(report_obj.spare_parts);
		                $("#chassis_equipment").val(report_obj.chassis_equipment);
		                $("#gst_tax").val(report_obj.gst_tax);
		                $("#mobile_crane").val(report_obj.mobile_crane);
		                $("#scope_of_unloading").val(report_obj.scope_of_unloading);
		                $("#intrest_charge").val(report_obj.intrest_charge);
		                $("#cancellation").val(report_obj.cancellation);
		                $("#jurisdication").val(report_obj.jurisdication);
		                $("#documents_provided").val(report_obj.documents_provided);
		                $("#load_test").val(report_obj.load_test);
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
		                    url: "<?php echo base_url();?>index.php/helperController/delete/m_custome/id",
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
