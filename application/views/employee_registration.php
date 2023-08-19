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
		    <h4 class="widget-title">Manage </h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="uname" id="uname" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
        <h3 style="text-align:center;margin: 30px;">Personal Information</h3>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Client/Customer Name</label>

			<div class="col-sm-3">
				<input type="text"  name="name" id="name" data-rule-required="true"  placeholder="Client/Customer Name" class="col-xs-10 col-sm-12" />
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Address</label>

			<div class="col-sm-3">
				<input type="text" name="address" id="address"  placeholder="Address" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> State</label>

			<div class="col-sm-3">
				<select name="state" id="state" data-rule-required="true" class="col-xs-10 col-sm-12">
				     <option value=" ">Select State</option>
	                 <? $query=$this->db->query('select name from m_master where company_id='.get_cookie('ae_company_id').' and type="State"'); ?>			  
	                 <? if($query->num_rows()>0){ ?>
	                 <? foreach($query->result() as $row){ ?>  
	                 <option value="<?=$row->name?>"><?=$row->name?></option>
	                 <? } } ?>
				</select>
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> District</label>

			<div class="col-sm-3">
				<select name="district" id="district" data-rule-required="true" class="col-xs-10 col-sm-12">
				     <option value=" ">Select District</option>
	                 <? $query=$this->db->query('select name from m_master where company_id='.get_cookie('ae_company_id').' and type="District" order by name'); ?>			  
	                 <? if($query->num_rows()>0){ ?>
	                 <? foreach($query->result() as $row){ ?>  
	                 <option value="<?=$row->name?>"><?=$row->name?></option>
	                 <? } } ?>
				</select>
			</div>
		</div>

		<div class="form-group">

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mobile No. 1</label>

			<div class="col-sm-3">
				<input type="text" name="mobileno" id="mobileno"  placeholder="Mobile No." class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mobile No. 2</label>

			<div class="col-sm-3">
				<input type="text" name="mobileno2" id="mobileno2"  placeholder="Mobile No." class="col-xs-10 col-sm-12" />
			</div>

		</div>

		<div class="form-group">

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Email ID</label>

			<div class="col-sm-3">
				<input  type="text" name="emailid" id="emailid"  placeholder="Email ID" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Current Salary</label>

			<div class="col-sm-3">
				<input  type="text" name="csalary" id="csalary"  placeholder="Current Salary" class="col-xs-10 col-sm-12" />
			</div>

		</div>

		<div class="form-group">

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Previous Salary</label>

			<div class="col-sm-3">
				<input  type="text" name="psalary" id="psalary"  placeholder="Previous Salary" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Hourly Charge</label>

			<div class="col-sm-3">
				<input  type="text" name="hourcharge" id="hourcharge"  placeholder="Hourly Charge" class="col-xs-10 col-sm-12" />
			</div>

		</div>

		<h3 style="text-align:center;margin: 30px;">Bank Details</h3>

		<div class="form-group">

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> A/C Number</label>

			<div class="col-sm-3">
				<input  type="text" name="acno" id="acno"  placeholder="A/C Number" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> IFSC Code</label>

			<div class="col-sm-3">
				<input  type="text" name="ifsccode" id="ifsccode" placeholder="IFSC Code" class="col-xs-10 col-sm-12" />
			</div>

		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bank Name</label>

			<div class="col-sm-3">
				<input  type="text" name="bankname" id="bankname" placeholder="Bank Name" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> A/C Holder Name</label>

			<div class="col-sm-3">
				<input  type="text" name="acholder" id="acholder" placeholder="A/C Holder Name" class="col-xs-10 col-sm-12" />
			</div>

			
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bank Branch Address</label>

			<div class="col-sm-3">
				<input  type="text" name="branchname" id="branchname" placeholder="Bank Branch Address" class="col-xs-10 col-sm-12" />
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> PAN No </label>

			<div class="col-sm-3">
				<input  type="text" name="pan_no" id="pan_no" placeholder="PAN No" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="space-4"></div>


		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button   class="btn btn-info" type="button" id="newsubmit" >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Save
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
		            url: "<?php echo base_url();?>index.php/master_general/employee_list",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
		                $('#data-list-table11 table').DataTable( {
					        "fnDrawCallback": function( oSettings ) {
					            CheckPermission(11);
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
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/helperController/m_employee/m_employee/id",
		                    type: "POST",
		                    data: data,
		                    cache: false,
		                    success: function (html) {
		                    	// alert(html);
		                    	ShowList();
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
		        var url = "<?php echo base_url();?>index.php/master_general/employee_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#name").val(report_obj.name);
		                $("#uname").val(report_obj.name);
		                $("#alias").val(report_obj.alias);
		                $("#print_name").val(report_obj.print_name);
		                $("#group_id").val(report_obj.group_id);
		                $("#line_id").val(report_obj.line_id);
		                $("#opbalance").val(report_obj.opbalance);
		                $("#optype").val(report_obj.optype);
		                $("#address").val(report_obj.address);
		                $("#district").val(report_obj.district);
		                $("#state").val(report_obj.state);
		                $("#pincode").val(report_obj.pincode);
		                $("#cperson").val(report_obj.cperson);
		                $("#phoneno").val(report_obj.phoneno);
		                $("#mobileno").val(report_obj.mobileno);
		                $("#faxno").val(report_obj.faxno);
		                $("#emailid").val(report_obj.emailid);
		                $("#panno").val(report_obj.panno);
		                $("#cstno").val(report_obj.cstno);
		                $("#tinno").val(report_obj.tinno);
		                $("#exciseno").val(report_obj.exciseno);
		                $("#sertaxno").val(report_obj.sertaxno);
		                $("#mobilenosms").val(report_obj.mobilenosms);
		                $("#sapcode").val(report_obj.sapcode);
		                $("#climit").val(report_obj.climit);
		                $("#sno").val(report_obj.id);
		                $("#salesman").val(report_obj.salesman);
		                $("#opbalancermk").val(report_obj.opbalancermk);
		                $("#acno").val(report_obj.acno);
		                $("#ifsccode").val(report_obj.ifsccode);
		                $("#acholder").val(report_obj.acholder);
		                $("#bankname").val(report_obj.bankname);
		                $("#branchname").val(report_obj.branchname);
		                $("#gstntype").val(report_obj.gstntype);
		                $("#gstn_id").val(report_obj.gstn_id);
		                $("#pan_no").val(report_obj.pan_no);
		                $("#mobileno2").val(report_obj.mobileno2);
		                $("#contactpersone").val(report_obj.contactpersone);
		                $("#website").val(report_obj.website);
		                $("#companyname").val(report_obj.companyname);
		                $("#psalary").val(report_obj.psalary);
		                $("#csalary").val(report_obj.csalary);
		                $("#hourcharge").val(report_obj.hourcharge);
		                

		                $("#status").val("edit");
		                ShowForm();
		            }
		            else {
		                alert("Invalid");
		            }
		        });
		    }


              function exportExcel(){
                $("#TblList").table2excel({
                    // exclude CSS class
                    exclude: ".noExl",
                    name: "Employee",
                    filename:"Employee"
                  });    
            //    $('.mytable').tableExport({type:'excel',escape:'false'});
              }

		    function DeleteRecord(ID) {
		        var r = confirm("Do You Want to Delete");
		        if (r == true) {
		            $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/helperController/delete/m_employee/id",
		                    type: "POST",
		                    data: {ID: ID},
		                    cache: false,
		                    success: function (html) {
		                    	// alert(html);
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
