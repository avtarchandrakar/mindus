    <div id="data-list">
            <div class="done" style="display:none;">
                 <h3>Record Saved.</h3>
            </div> 
            <input type="hidden" id="permission" value=""/>            
            <form action="#" class="form-horizontal form-input" id="billform" method="post" role="form">            
		    <button id="btn_bill_generate" class="btn btn-primary btn_entry" onclick="GenerateBill();return false;">
			    <i class="fa fa-check"></i> &nbsp;GENERATE BILL
		    </button>
		    </form>
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
		    <h4 class="widget-title">Generate Bill</h4>
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
				<input tabindex="1" type="text"  name="name" id="name" data-rule-required="true"  placeholder="Name" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Item Group</label>

			<div class="col-sm-3">
				<?php
					$query=$this->db->query("select id,name from m_master where type='Item Group' and company_id=". get_cookie('ae_company_id') ." order by name");
					echo "<select id='group_id' name='group_id' tabindex='2' class='col-xs-10 col-sm-12' data-placeholder='Select Group Name...''>";
					foreach($query->result() as $row)
					{
						echo "<option value=" . $row->id . "> " . $row->name . "</option>";
					}
					echo "</select>";
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Company</label>

			<div class="col-sm-3">
				<?php
					$query=$this->db->query("select id,name from m_master where type='Item Company' and company_id=". get_cookie('ae_company_id') ." order by name");
					echo "<select id='itemcompany_id' name='itemcompany_id' tabindex='3' class='col-xs-10 col-sm-12' data-placeholder='Select Company Name...''>";
					foreach($query->result() as $row)
					{
						echo "<option value=" . $row->id . "> " . $row->name . "</option>";
					}
					echo "</select>";
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Desp.Type</label>

			<div class="col-sm-3">
					<select id='desptype' name='desptype' tabindex='4' class='col-xs-10 col-sm-12'>
						<option>FOR</option>
						<option>EX</option>
					</select>
			</div>
		</div>


		<div class="space-4"></div>



		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="5" class="btn btn-info" type="button" id="newsubmit" >
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
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/item_list",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
		                $('#data-list-table table').DataTable();
		                $(".loading").hide();
		            }
		        });
		    }

		    $(document).ready(function () {
		    	MoveTextBox('.form-input');
		    	CheckPermission(6);
		        $("#data-list").show();
		        $("#data-form").hide();
		        //GetList();

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
		                    url: "<?php echo base_url();?>index.php/helperController/m_insert_wt/m_item/id",
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
		        var url = "<?php echo base_url();?>index.php/master_general/item_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#name").val(report_obj.name);
		                $("#uname").val(report_obj.name);
		                $("#group_id").val(report_obj.group_id);
		                $("#itemcompany_id").val(report_obj.itemcompany_id);
		                $("#desptype").val(report_obj.desptype);
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
		                    url: "<?php echo base_url();?>index.php/helperController/delete/m_item/id",
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
		      function GenerateBill(){
		      	$('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/transactionController/generate_bill",
		                    type: "POST",
		                    data: data,
		                    cache: false,
		                    success: function (html) {
		                    	count=html.length;
		                    	rst=html.substring(0,1);
		                    	cond=html.substring(1,count-3);
		                        $('.loading').hide();
		                        if (rst == 1) {
		                            $("html, body").animate({ scrollTop: 0 }, "slow");
		                            $('.done').html("<h4>Record Saved.</h4>");
		                            $('.done').fadeIn('slow', function () { });
		                            $('.done').delay(600).fadeOut('slow', function () { });
		                            GetGenerateList(cond);
		                        } else {
		                            if (rst == 2) {
		                                alert('No Record Find !');
		                                $("#data-list-table").html('');
		                            } else {
		                            	$("#data-list-table").html('');
		                                //alert('Sorry, unexpected error. Please try again later.');
		                            }
		                        }
		                    }
		                });
		                return false;
		      }
		      function GetGenerateList(d) {
			    data='cond='+d;
			    $(".loading").show();
			    $.ajax({
			        url: "<?php echo base_url();?>index.php/transactionController/generate_bill_last_list",
			        type: "GET",
			        data: data,
			        cache: false,
			        success: function (html) {
			            $("#data-list-table").html(html);
			            // totalamt();
			            $('#itemTbl').DataTable();
			            $(".loading").hide();
			        }
			    });
			  }
				</script>
