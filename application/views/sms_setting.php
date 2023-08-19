    <div id="data-form" style="display:none;">
        <div class="done" style="display:none;">
            <h3>Record Saved.</h3>
        </div>

	    <div class="widget-box">
	    <div class="widget-header">
		    <h4 class="widget-title">SMS Setting</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
		<div class="form-group">
			<div class="col-sm-12">
				<input tabindex="1" style="text-transform:none;" type="text"  name="sms_value" id="sms_value" data-rule-required="true" value="<? echo $sms_value;?>"  placeholder="SMS Value" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="space-4"></div>



		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="2" class="btn btn-info" type="button" id="newsubmit" >
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

		        //if submit button is clicked
		        $('#newsubmit').click(function () {
		           $("#userform").validate();
		                var data = $("#userform").serialize();
		                $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/master_general/sms_setting",
		                    type: "POST",
		                    data: data,
		                    cache: false,
		                    success: function (html) {
		                        $('.loading').hide();
	                            $("html, body").animate({ scrollTop: 0 }, "slow");
	                            $('#sms_value').focus();
	                            $('.done').html("<h4>Record Saved.</h4>");
	                            $('.done').fadeIn('slow', function () { });
	                            $('.done').delay(600).fadeOut('slow', function () { });
		                    }
		                });
		                return false;

		        });


		    });


				</script>
