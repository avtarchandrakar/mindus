<style type="text/css">
   .form-group {
    margin-bottom: 0px;
   }
   .txt_cls{
   	width: 100%;
   }
   .txt_item{
   	width: 400px;
   }
   </style>



<!-- Bootstrap modal -->
<div class="modal fade bd-example-modal-sm" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- hii -->


   <div id="data-list">
            <input id="permission" type="hidden" value="" /> 
            <input id="p_modify" type="hidden" value="<?=$p_modify?>" /> 
            <input id="p_delete" type="hidden" value="<?=$p_delete?>" /> 
	        <input type="hidden" value="<?=$vtype?>" name="vtype" id="vtype" class="form-control" />

           <?php if($p_entry==1){ ?>
			<button class="btn btn-xs btn-primary btn_entry" onclick="ShowForm(); return false;">
			    ADD NEW
		    </button>
		    <?php }?>
		   	
        <form action="#" class="form-horizontal form-input" id="userform_search" method="post" role="form">
        <div class="form-group">
        <table class="table">
         <tr>
          <td>From</td><td><input type="text"  name="from" id="from" placeholder="From" class="cdateago col-xs-6 col-sm-6" value="<?=date('d-m-Y', strtotime('-1 month'))?>" list="0"/></td>
          <td>To</td><td><input type="text"  name="to" id="to" placeholder="To" class="cdate col-xs-6 col-sm-6" list="0"/></td>
          <td><button type="button" id="btn_show" class="btn btn-primary" onclick="GetList();">Show</button></td>
         </tr>
        </table>
        </div>
	    </form>

            <br />
			<div class="loading"></div>
			<?php if($p_list==1){ ?>
            <div id="data-list-table">
            <?php }?>
            </div>
    </div>

		<script type="text/javascript">
		    function ShowForm() {
				$('#modal_form').modal('show');
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/formController/jobform_form",
		            type: "GET",
		            cache: false,
		            success: function (html) {
		                $(".modal-body").html(html);
				    	MoveTextBox('.form-input');
				    	BlankForm();
//				    	$('.cdate').val(getCurDate());
				    	$(".cdate").mask("99-99-9999");

//			            $('#data-form').fadeIn(500);
					    $("[tabindex='1']").focus();
		                $(".loading").hide();
		            }
		        });				
		    }
		    function ShowList() {
		        $('#data-form').fadeOut(500, function () {
		            $('#data-list').fadeIn(500);
	                $('#TblRptBody').html("");
		            GetList();
		        });
		    }


		    $(document).ready(function () {
                $('.cdate').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    dateFormat: 'dd-mm-yy'
                });

				$('#modal_form').on('hidden.bs.modal', function(){
				    //$(this).removeData('bs.modal');
				    GetList();
				});

					           // CheckPermission(4);
		    	MoveTextBox('.form-input');
		    	$('.cdate').val(getCurDate());
		    	$(".cdate").mask("99-99-9999");

		    	status=$('#status').val();
				checkAction(status);
				$(".cdateago").mask("99-99-9999");
				$('.cdateago').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    dateFormat: 'dd-mm-yy',
                });
				GetList();

		    });


 		    function GetList() {
                from=$('#from').val();
                to=$('#to').val();
                data ="from="+from+'&to='+to;
		        vtype=$('#vtype').val();
		        // alert(vtype);
		        p_modify=$('#p_modify').val();
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/jobcard_list",
		            type: "GET",
		            data: data+'&vtype='+$('#vtype').val(),
		            cache: false,
		            success: function (html) {
		            	// alert(html);
		                $("#data-list-table").html(html);
		                $('#data-list-table1 table').DataTable( {
					        "fnDrawCallback": function( oSettings ) {
					        	if(vtype=='sales')
					        	{
					           // CheckPermission(4);
					            }
					            if(vtype=='transfer'){
					            //CheckPermission(22);	
					            }
					        }
					    } );
					    if(vtype=='transfer'){
					           // CheckPermission(22);	
					    }
					    if(p_modify!=1)
					    {
					    	$('.btn_modify').css('visibility','hidden');
					    }

		                $(".loading").hide();
		            }
		        });
		    }

		    function GetRecord(ID) {
				$('#modal_form').modal('show');
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/formController/jobform_form",
		            type: "GET",
		            cache: false,
		            success: function (html) {
		                $(".modal-body").html(html);
				    	MoveTextBox('.form-input');
				    	GetPreviousRecord(ID);
//				    	$('.cdate').val(getCurDate());
				    	$(".cdate").mask("99-99-9999");
					    $("[tabindex='1']").focus();
		                $(".loading").hide();
		            }
		        });				
		    }

		    function GetReport(ID) {
	            window.open("<?php echo base_url();?>index.php/transactionController/job_bill_print/"+ID,'_blank');
		    }

//////////////////////
               function checkAction(status){
	              if(status=='edit'){
	              	id=$('#sno').val();
	              	GetRecord(id);
	              } 
				}

  
 	function GetChangeStatus(ID) {
				$('#modal_form').modal('show');
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/formController/approval_form",
		            type: "GET",
		            cache: false,
		            success: function (html) {
		                $(".modal-body").html(html);
				    	MoveTextBox('.form-input');
				    	GetPreviousRecord(ID);
				    	$(".cdate").mask("99-99-9999");
					    $("[tabindex='1']").focus();
		                $(".loading").hide();
		            }
		        });				
		    }
        	
        </script>

