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
		    <h4 class="widget-title">Manage Items</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="uname" id="uname" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Item Name</label>

			<div class="col-sm-3">
				<input tabindex="1" type="text"  name="name" id="name" data-rule-required="true"  placeholder="Item Name" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Specification</label>
			<div class="col-sm-3">
				<input tabindex="2" type="text"  name="specification" id="specification" data-rule-required="true"  placeholder="Specification" class="col-xs-10 col-sm-12" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Item Group</label>

			<div class="col-sm-3">
				<?php
					$query=$this->db->query("select id,name from m_master where type='Item Group' and company_id=". get_cookie('ae_company_id') ." order by name");
					echo "<select id='group_id' name='group_id' tabindex='3' class='col-xs-10 col-sm-12' data-placeholder='Select Group Name...''>";
					foreach($query->result() as $row)
					{
						echo "<option value=" . $row->id . "> " . $row->name . "</option>";
					}
					echo "</select>";
				?>
			</div>
		</div>
		

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Alert Qty.</label>

			<div class="col-sm-3">
				<input tabindex="4" type="text"  name="reorder" id="reorder" data-rule-required="true" value="10" placeholder="Alert Qty." class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Unit</label>

			<div class="col-sm-3">
				<input tabindex="5" type="text"  name="unit" id="unit" value="1" placeholder="Unit" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Unit Type</label>
			<div class="col-sm-3">
				<select tabindex="6" name="unittype" id="unittype" data-rule-required="true"  class="col-xs-10 col-sm-12" >
					<option value="PC">PC</option>
					<option value="KG">KG</option>
					<option value="METER">METER</option>
					<option value="DOZON">DOZON</option>
					<option value="MM">MM</option>
					<option value="LITER">LITER</option>

				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Unit Rate</label>

			<div class="col-sm-3">
				<input tabindex="7" type="text"  name="unitrate" id="unitrate" value="0.00" placeholder="Unit Rate" class="col-xs-10 col-sm-12" />
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">HSN No</label>
			<div class="col-sm-3">
				<input tabindex="8" type="text"  name="hsn_no" id="hsn_no"   placeholder="HSN No" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Description</label>
			<div class="col-sm-3">
				<input tabindex="9" type="text"  name="description" id="description" data-rule-required="true"  placeholder="Description" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="space-4"></div>
		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="10" class="btn btn-info" type="button" id="newsubmit" >
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
		            url: "<?php echo base_url();?>index.php/master_general/item_list",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		            	// alert(html);
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
		                    url: "<?php echo base_url();?>index.php/helperController/m_insert_wt/m_item/id",
		                    type: "POST",
		                    data: data,
		                    cache: false,
		                    success: function (html) {
		                    	// console.log(html);
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
		        var url = "<?php echo base_url();?>index.php/master_general/item_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#name").val(report_obj.name);
		                $("#group_id").val(report_obj.group_id);
		                $("#desptype").val(report_obj.desptype);
		                $("#reorder").val(report_obj.reorder);
		                $("#sno").val(report_obj.id);
		                $("#unit").val(report_obj.unit);
		                $("#opn_bal").val(report_obj.opn_bal);
		                $("#hsn_no").val(report_obj.hsn_no);
		                $("#unitrate").val(report_obj.unitrate);
		                $("#unittype").val(report_obj.unittype);
		                $("#specification").val(report_obj.specification);
		                $("#opn_bal").val(report_obj.opn_bal);
		                $("#description").val(report_obj.description);
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
				</script>
