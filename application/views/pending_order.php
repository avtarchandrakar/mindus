   <style type="text/css">
   .form-group {
    margin-bottom: 0px;
   }
   </style>
   <input type="hidden" id="permission" value=""/>
   <div id="data-list">
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
		    <h4 class="widget-title"><?=$title?></h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
		    <input type="hidden" id="vtype" name="vtype" value="<?=$vtype?>">
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
		        $('#userform').find('input:password').val('');
		        $('#userform')[0].reset();
		        $('#cdate').val(getCurDate());
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
		            url: "<?php echo base_url();?>index.php/transactionController/pending_order_list",
		            type: "GET",
		            data: data+'&vtype='+$('#vtype').val(),
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
		           //      $('#data-list-table table').DataTable( {
					        // "fnDrawCallback": function( oSettings ) {
					            CheckPermission(3);
					    //     }
					    // } );
		                $(".loading").hide();
		            }
		        });
		    }

		    $(document).ready(function () {
		    	MoveTextBox('.form-input');
		        $("#data-list").show();
		        GetList();
            });
		    function GetRecord(ID) {
		        LoadEditForm('Dispatch','pending',ID);
		    }
				</script>
