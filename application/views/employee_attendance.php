    <div id="data-list">
            <input id="permission" type="hidden" value="" /> 
            <input id="p_modify" type="hidden" value="<?=$p_modify?>" /> 
            <input id="p_delete" type="hidden" value="<?=$p_delete?>" /> 
           <?php if($p_entry==14){ ?>
			<button class="btn btn-xs btn-primary btn_entry" onclick="ShowForm(); BlankForm();  return false;">
			    ADD NEW
		    </button>
		    <?php }?>
		   	 
		   	<div class="form-group">
				<label class="col-sm-1 control-label no-padding-right text-right" for="form-field-1"> Date</label>

				<div class="col-sm-2">
					<input type="text" value="" name="from" list="0" id="cdate" data-rule-required="true" class="cdate date-picker form-control col-xs-10 col-sm-12" />
				</div>
			</div>
            <br />
            <br />
            <br />
			<div class="loading"></div>
			<?php if($p_list==1){ ?>
            <!-- <div id="data-list-table"> -->
            	<form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
            		<div id="data-list-table">
            	<div class="loading"></div>
				<div class="hr hr-24"></div>
				</form>
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
		            $('.cdate').datepicker({
		                autoclose: true,
		                todayHighlight: true,
		                dateFormat: 'dd-mm-yy'
		            });

		            $('.cdate').val(getCurDate());
				   	$(".cdate").mask("99-99-9999");
		        });
		    }

		    function GetList() {
		    	p_modify=$('#p_modify').val();
		        p_delete=$('#p_delete').val();
		        date=$('#cdate').val();
		        // alert(date);
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/emp_list",
		            type: "GET",
		            data: data+'&date='+date,
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
		                $(".loading").hide();
					   	$(".cdate").mask("99-99-9999");
						
			           }
		        });
		    }

		    $(document).ready(function () {
				CheckPermission(11);
		    	MoveTextBox('.form-input');
		        $("#data-list").show();
		        $("#data-form").hide();
		        
		            $('.cdate').datepicker({
		                autoclose: true,
		                todayHighlight: true,
		                dateFormat: 'dd-mm-yy'
		            });

		            $('.cdate').val(getCurDate());
				   	$(".cdate").mask("99-99-9999");
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


		        $("#cdate").keyup(function(event){
			    		if($("#cdate").val().length==2)
			    		{
			    			$("#cdate").val($("#cdate").val()+"-");
			    		}
			    		if($("#cdate").val().length==5)
			    		{
			    			$("#cdate").val($("#cdate").val()+"-");
			    		}
			    		GetList();
			    });

			    $("#cdate").blur(function(event){
		    			var d = new Date();
						var month = d.getMonth()+1;
						var day = d.getDate();
						var year = d.getFullYear();
						if(month<10)
						{
							month="0"+month;
						}
			    		if($("#cdate").val().length==1)
			    		{
			    			$("#cdate").val("0"+$("#cdate").val()+"-"+month+"-"+year);
			    		}
			    		if($("#cdate").val().length==2)
			    		{
			    			$("#cdate").val($("#cdate").val()+"-"+month+"-"+year);
			    		}
			    		if($("#cdate").val().length==3)
			    		{
			    			$("#cdate").val($("#cdate").val()+month+"-"+year);
			    		}
			    		if($("#cdate").val().length==4)
			    		{
			    			$("#cdate").val($("#cdate").val().substring(0,2)+"-0"+$("#cdate").val().substring(3)+"-"+year);
			    		}
			    		if($("#cdate").val().length==5)
			    		{
			    			$("#cdate").val($("#cdate").val()+"-"+year);
			    		}
			    		if($("#cdate").val().length==6)
			    		{
			    			$("#cdate").val($("#cdate").val()+year);
			    		}

			    		GetList();
			    });

			    $("#cdate").change(function(event){
			    	GetList();
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
