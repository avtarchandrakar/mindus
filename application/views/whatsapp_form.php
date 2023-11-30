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
   .modal-dialog{
   	width:80% !important;
   }
   </style>

		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/loadingnew.js"></script>


	<div id="data-form">
        <div class="done" style="display:none;">
            <h3>Record Saved.</h3>
        </div>

        <div class="widget-header">
		    <h4 class="widget-title"><?=$title?></h4>
	    </div>

		<div class="widget-body">
		<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form" enctype="multipart/form-data">
        <input type="hidden" value="0" name="previd" id="previd" class="form-control" />
        <input type="hidden" value="<?=$ledger_id?>"  name="ledger_id" id="ledger_id" class="form-control" />
        <input type="hidden" value="<?=$quatation_selected?>"  name="quatation_selected" id="quatation_selected" class="form-control" />
        <input type="hidden" value="<?=$gid?>" name="gid" id="gid" class="form-control" />

        <input type="hidden" value="<?=$status?>" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
        <input type="hidden" value="<?=$vtype?>" name="vtype" id="vtype" class="form-control" />
        <input type="hidden" value="" name="q_number" id="q_number" class="form-control" />

	
		
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right " for="form-field-1">Mail Body</label>
			
			<div class="col-sm-9" >
					<textarea type="text"  name="body" id="body" class="col-xs-10 col-sm-12" placeholder="Whatsapp Body" rows="10" data-rule-required="true"><?=$mailbody?></textarea>
			</div>
		</div>
		
		<!-- <div class="space-4"></div> -->

		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="15" class="btn btn-info" type="button" id="newsubmit" >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Send WhatsApp
				</button>
			</div>
		</div>

		<div class="loading"></div>

		<!-- <div class="hr hr-24"></div> -->
		</form>
	</div>
</div>
</div>

		<script type="text/javascript">
		    function BlankForm() {
		        $('#userform').find('input:text').val('');
		        $('#userform').find('input:password').val('');
		        $('#userform').find('#orderno').val('0');
		        $('#userform')[0].reset();
		         $('#TblRpt tbody tr:not(:first)').remove();
		        $('#TblRpt tbody tr:first').find('input:text').val('');
		        $('#created_by').val($.cookie('ae_username'));
//		        $('.cdate').val(getCurDate());
		        $('#status').val('add');
		        GetAuto($("#vtype").val());
		        $(".uploaded").hide();
		    }
            function GetFreight(id){
            	if(id==''){
                $('#appr_freight').val('0.00');
            	}else{
                var url = "<?php echo base_url();?>index.php/transactionController/destination_freight_get?id=" + id;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#appr_freight").val(report_obj.freight);
		            }
		            else {
		                // alert("Invalid");
		            }
		        });
		        }
            }
		    function GetItemList(ID) {
//		    	addLoading();
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/sales_get_item",
		            type: "GET",
		            data: data+'&vtype='+$('#vtype').val()+'&id='+ID,
		            cache: false,
		            success: function (html) {
		                $('#TblRptBody').html("");
		                $('#TblRptBody').html(html);
//		                clearLoading();
//		                $('#TblRpt tbody tr:not(:first)').remove();
//		                $('#TblRpt tbody').append(html);
				    	MoveTextBoxRefresh('.form-input');

					  	 var x=document.getElementById('TblRptBody');
					  	 var lastrow=x.rows.length-1;
					  	 var ti=0;

					  	 ti = x.rows[lastrow].cells[8].getElementsByTagName('button')[0].tabIndex;

					  		ti++;
					  	 //$("#lessadv").attr("tabindex",ti);
					  	 $("#loading_person_name").attr("tabindex",ti);
					  	 ti++;
					  	 $("#remark").attr("tabindex",ti);
					  	
					  	 ti++;
					  	 $("#newsubmit").attr("tabindex",ti);

		                TolQtyMT();
		                //TolQtyBag();
		                TolFreight();
		                CalcAmount();
		                $(".loading").hide();
		            }
		        });
		    }

		    function GetItemListOrder(ID) {
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/pending_order_get_item",
		            type: "GET",
		            data: data+'&vtype='+$('#vtype').val()+'&id='+ID,
		            cache: false,
		            success: function (html) {
		                $('#TblRptBody').html("");
		                $('#TblRptBody').html(html);
//		                $('#TblRpt tbody tr:not(:first)').remove();
//		                $('#TblRpt tbody').append(html);
				    	MoveTextBoxRefresh('.form-input');

					  	 var x=document.getElementById('TblRptBody');
					  	 var lastrow=x.rows.length-1;
					  	 var ti=0;

					  	 ti = x.rows[lastrow].cells[7].getElementsByTagName('button')[0].tabIndex;

					  	 ti++;
					  	 // $("#lessadv").attr("tabindex",ti);
					  	 ti++;
					  	 $("#loading_person_name").attr("tabindex",ti);
					  	 ti++;
					  	 $("#remark").attr("tabindex",ti);

					  	 ti++;
					  	 $("#newsubmit").attr("tabindex",ti);

		                TolQtyMT();
		               // TolQtyBag();
		                TolFreight();
		                $(".loading").hide();
		            }
		        });
		    }
		    
		    $(document).ready(function () {

                $("#userform").validationEngine();
		        
		    	status=$('#status').val();
				// checkAction(status);

			    
			    $("#cdate").keyup(function(event){
			    		if($("#cdate").val().length==2)
			    		{
			    			$("#cdate").val($("#cdate").val()+"-");
			    		}
			    		if($("#cdate").val().length==5)
			    		{
			    			$("#cdate").val($("#cdate").val()+"-");
			    		}
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
			    });

			    $('#act_freight').keyup(function(){
			    	GetActualAmt();
			    });


			$('#newsubmit').click(function () 
		    {    
				//old 
		        company_id=$.cookie('ae_company_id');	        
		        if(company_id=='' || company_id==0){
                   alert('Unexpected Error ! Login Again .');
		        }
		        else
		        { 
                if ($('#userform').validationEngine('validate')) 
                {
                    modified_by=$.cookie('ae_username');		            
	                var status = $('input[name=status]');
	                var data = $("#userform").serialize();
	                $('.loading').show();
	                $('button').prop('disabled','disabled');                  
                    var target="<?php echo base_url();?>index.php/transactionController/quotation_whatsapp";
                    $('#userform').ajaxSubmit({url:target,
                            type: "POST",
                            data: data,
                            cache: false,
                            success: function (html) 
                            {
                            	// console.log(html);
								$('#modal_form').modal('hide');
                            	
                                 $('.loading').hide();
		                        $('button').removeAttr('disabled');
		                        
		                        if (html > 0) 
		                        {
		                        	
		                            if (status.val() == "edit") {
										$('#modal_form').modal('hide');
										return;
		                            }
		                            else {

		                            }
		                            $("html, body").animate({ scrollTop: 0 }, "slow");
		                            BlankForm();
		                            $("[tabindex='1']").focus();
		                            $('.done').html("<h4>Record Saved.</h4>");
		                            $('.done').fadeIn('slow', function () { });
		                            $('.done').delay(600).fadeOut('slow', function () { });
		                        } else {
		                            if (html == 0) {
		                                alert('Already Approve');
		                            } else {
		                                alert('Sorry, unexpected error. Please try again later.');
		                            }
		                        }
                            }
                        });
                        return false;  
	                } 
	            }
            });



		    });
	


			function GetQuatationRecord(ID) {
				// alert(ID);
		        var url = "<?php echo base_url();?>index.php/transactionController/sales_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);

		            if (report_obj.Message == "Success") {
		                $.each(report_obj, function(key, value) {
						    if(key=='Message' || key=='sno' || key=='status'){ 
						    }else{
						    $("#"+key).val(value);
						    }
						});
						$('#vtype').val('cpo');
		            }
		            else {
		                // alert("Invalid");
		            }
		        });
		    }



		    function GetPreviousRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/transactionController/cpo_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            // console.log(data);
		            if (report_obj.Message == "Success") {
		                $.each(report_obj, function(key, value) {
						    if(key=='Message' || key=='sno' || key=='status'){ 
                               //declare manually
						    }else{
						    $("#"+key).val(value);

						    }
						});
						$('#tol_qtymt,#tol_qtybag').val('');
						// GetItemList(report_obj.id);
		                $("#sno").val(report_obj.id);
		                $("#quatation_no").val(report_obj.id);
		                $("#filepath").val(report_obj.fullpath);
						$("#filename").val(report_obj.filename);	
						if (report_obj.fullpath!='') 
						{
							$(".uploaded").show();
							$("#uploaddoc").html('<a target="_blank" href="'+report_obj.fullpath+'">'+report_obj.file_path+'</a>');	
						}
						

		                // CalcAmount();
		            }
		            else {
		                // alert("Invalid");
		            }
		        });
		    }

		  

		    function GetAuto(vtype) {
		        var url = "<?php echo base_url();?>index.php/transactionController/GetAuto?vtype=" + vtype;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#cdate").val(report_obj.cdate);
		                $("#builtyno").val(report_obj.builtyno);
		                $("#previd").val(report_obj.previd);
		            }
		        });
		    }

		      function getItemAutoCompt(q){
            	cRow=$(q).parent().parent();
		       // cat=$('#cat_id').val();
         //       if(cat>0){
	            $(".item").autocomplete({
	            source: urlstr+"index.php/helperController/get_item3",
	            //source: urlstr+"index.php/helperController/get_item2?cat="+cat,
	            minLength: 1,
	            focus: function (event, ui) {
	            $(event.target).val(ui.item.label);
				$(cRow).find('#item_id').val(ui.item.id);
				$(cRow).find('#txt_rate').val(ui.item.rate);
//				$(this).closest('tr').find('.item_id').val(ui.item.id);
//				$(this).closest('tr').find('#txt_rate').val(ui.item.rate);
	            return false;
	            },
	            select: function (event, ui) {
	            $(event.target).val(ui.item.label);
				$(cRow).find('#item_id').val(ui.item.id);
				$(cRow).find('#txt_rate').val(ui.item.rate);
//				$(this).closest('tr').find('.item_id').val(ui.item.id);
//				$(this).closest('tr').find('#txt_rate').val(ui.item.rate);
	            return false;
	        	},
	            });
	        }
	            function GetQtyBag(param){
	            	cRow=$(param).parent().parent();
	            	qtymt=parseFloat($(cRow).find('#txt_qtymt').val())|| 0;
	            	rate=parseFloat($(cRow).find('#txt_rate').val())|| 0;
//	            	if(rate==0)
//	            	{
//		            	GetRate(param,$("#ledger_id").val(),$(cRow).find('#item_id').val());
		            	GetDiscount(param,$("#ledger_id").val(),$(cRow).find('#item_id').val());
//	            	}

                    TolQtyMT();
					CalcAmount(param);                   
	           			}

	           ////////////
				$("#tol_freight,#lessadv").change(function(){
					GetBal();
				});


	 	function GetParty(){
                $(".ledgerinfo").autocomplete({
                    source: urlstr +"index.php/helperController/get_partyinfo_cmpt",
                    minLength: 1,
                    focus: function (event, ui) {
                    $(event.target).val(ui.item.label);             
                    $('#ledger_id').val(ui.item.id);
                    GetState(ui.item.id);
                    return false;
                    },
                    select: function (event, ui) {
                    $(event.target).val(ui.item.label);
                    $('#ledger_id').val(ui.item.id);
                    GetState(ui.item.id);
                    return false;
                    },
                });
             }
        $(document).ready(function() {
            // $('.chosen-select').chosen({width: "100%"});
		});
</script>
