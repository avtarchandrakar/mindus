    <div id="data-form">
        <div class="done" style="display:none;">
            <h3>Record Saved.</h3>
        </div>

	    <div class="widget-box">
	    <div class="widget-header">
		    <h4 class="widget-title">Party Wise Discount</h4>
	    </div>
	    <?php if($p_list==1){?>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Party Name</label>

			<div class="col-sm-3">
				<?php
					$query=$this->db->query("select id,name from m_ledger where company_id=". get_cookie('ae_company_id') ." order by name");
					echo "<select id='party_id' name='party_id' tabindex='1' class='col-xs-10 col-sm-12' data-placeholder='Select Party Name...''>";
					foreach($query->result() as $row)
					{
						echo "<option value=" . $row->id . "> " . $row->name . "</option>";
					}
					echo "</select>";
				?>
			</div>
			<div class="col-sm-7">
				<button  tabindex="2" class="btn btn-info" type="button" id="btn_show" onclick="GetList();return false;" >
					Show
				</button>
			</div>
		</div>
		<?php }?>
		<div class="space-4"></div>
		<div id="item-list"></div>
		<div class="loading"></div>

		<div class="hr hr-24"></div>
		</form>
	</div>

		<script type="text/javascript">
		    function BlankForm() {
		        $('#userform').find('input:text').val('');
		        $('#userform').find('input:hidden').val('');
		        $('#userform')[0].reset();
		        $('#userform').find('input:password').val('');
		        $('#status').val('add');
		    }
		    function GetList() {
		        data = "party_id="+$("#party_id").val();
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/item_list_discount",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $("#item-list").html(html);
		                $(".loading").hide();


				        //if submit button is clicked
				        $('#newsubmit').click(function () {
				            $("#userform").validate();
				            if ($("#userform").valid() == true) {
				                var data = $("#userform").serialize();
				                $('.loading').show();
				                $.ajax({
				                    url: "<?php echo base_url();?>index.php/master_general/item_party_savediscount",
				                    type: "POST",
				                    data: data,
				                    cache: false,
				                    success: function (html) {
				                        $('.loading').hide();
				                        $("#item-list").html("");
				                    }
				                });
				                return false;

				            }
				        });


		            }
		        });
		    }
		    $(document).ready(function () {
		    	MoveTextBox('.form-input');

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




		    });


				</script>
