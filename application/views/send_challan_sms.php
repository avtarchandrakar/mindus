    <style type="text/css">
    .loading_print {
        background:url("<?php echo base_url();?>assets/css/images/loading.gif") no-repeat 1px; 
        height:40px; 
        width:40px; 
    }

    </style>   
    <div id="data-form" style="display:none;">
        <div class="done" style="display:none;">
            <h3>Record Saved.</h3>
        </div>

	    <div class="widget-box">
	    <div class="widget-header">
		    <h4 class="widget-title">Send Challan SMS</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
	
		<div class="space-4"></div>

		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="1" class="btn btn-info" type="button" id="SendSMS_id" onclick="SendSMS();" >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Send
				</button>
			</div>
		</div>

            <div id="data-list-table">
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
				GetSummary();
		        //if submit button is clicked
		        $('#newsubmit').click(function () {
		        	return;
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



            function GetSummary() {
                $(".loading").show();
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/send_sms_summary",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                        $("#data-list-table").html(html);
                        if(html=="")
                        {
	                        $("#data-list-table").html("No Data");
                        }
//                        $('#to').select();
                        $(".loading").hide();
                        $('html, body').animate({
                            scrollTop: $("#TblList").offset().top
                        }, 500);

                        $('.show').show();
                        $('.hide').remove();
//                        $('#to').focus();
                    }
                });
            }

            function SendSMS()
            {
				    var w = $(window);
					$('#SendSMS_id').prop('disabled', true);            	
                    $('#TblList > tbody  > tr').each(function(i,tr) {
                        cRow=$(this);
				        w.scrollTop( cRow.offset().top - (w.height()/2) );

                        console.log(i+'  '+$(this).find('#tid').val());
                        $(this).find('#last_col').addClass('loading_print');
                        $(this).find('#last_col').css('background-color','#ffcccc');
						$('#SendSMS_id').html(i);            	

                        var tid=$(this).find('#tid').val();
                        data = "tid="+tid+"";

                        $.ajax({
                            url: "<?php echo base_url();?>index.php/transactionController/send_sms",
                            async:false,
                            type: "GET",
                            data: data,
                            cache: false,
                            success: function (html) {
                                cRow.find('#last_col').removeClass('loading_print');
                                cRow.find('#last_col').html(html);
                            }
                        });

                    });

					$('#SendSMS_id').prop('disabled', false);            	
					$('#SendSMS_id').html("Send");            	
					alert("SMS Sent");
					GetSummary();
                //});

            }

				</script>
