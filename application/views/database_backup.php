    <div id="data-list">		    
			<div class="done"></div>
			<form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
			<button type="submit" class="btn btn-primary" id="newsubmit">Backup Databae</button>
			</form>
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
		    <h4 class="widget-title">Database Backup</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">

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
		        $("#userform").find('input:text,input:hidden').val('');
		        $("#userform").find('#status').val('add');
		        $("#userform").find('#type').val('caste');
		        $('#userform').validationEngine('hideAll');
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
		            url: "<?php echo base_url();?>index.php/login/db_list",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
		                $(".loading").hide();
		            }
		        });
		    }

		    $(document).ready(function () {
		    	MoveTextBox('.form-input');
		        $("#data-list").show();
		        $("#data-form").hide();
		        GetList();
		        $("#userform").validationEngine();

		        //if submit button is clicked
		        $('#newsubmit').click(function () {
		            	if ($('#userform').validationEngine('validate')) {
		                var status = $('input[name=status]');
		                var data = $("#userform").serialize();
		                $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/login/db_backup",
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
		                            GetList();
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
		        var url = "<?php echo base_url();?>index.php/siteController/m_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#name").val(report_obj.name);
		                $("#type").val(report_obj.type);
		                $("#sortorder").val(report_obj.sortorder);
		                $("#shortname").val(report_obj.shortname);
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
		                    url: "<?php echo base_url();?>index.php/helperController/delete/tbl_db/id",
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
