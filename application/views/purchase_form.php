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

	    <div class="widget-box">
	    <div class="widget-header">
		    <h4 class="widget-title"><?=$title?></h4>
			<div class="widget-toolbar no-border" style="display:none;">
				<?
					if($q==1)
					{
				?>
				<button class="btn btn-xs btn-red bigger" id="BackButton">
					<i class="ace-icon fa fa-arrow-left"></i>
					Back
				</button>
				<?
					}
				?>

				<button class="btn btn-xs btn-yellow bigger" id="PrevButton">
					<i class="ace-icon fa fa-arrow-left"></i>
					Prev
				</button>

				<button class="btn btn-xs bigger btn-yellow dropdown-toggle" data-toggle="dropdown" aria-expanded="false"  id="NextButton">
					Next
					<i class="ace-icon fa fa-arrow-right"></i>
				</button>

			</div>

	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form" enctype="multipart/form-data">
        <input type="hidden" value="0" name="previd" id="previd" class="form-control" />
        <input type="hidden" value="0" name="nextid" id="nextid" class="form-control" />
        <input type="hidden" value="<?=$status?>" name="status" id="status" class="form-control" />
        <input type="hidden" value="<?=$id?>" name="sno" id="sno" class="form-control" />
        <input type="hidden" value="<?=$orderno?>" name="orderno" id="orderno" class="form-control" />
        <input type="hidden" value="<?=$vtype?>" name="vtype" id="vtype" class="form-control" />
		<div class="form-group">
		   
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Date</label>

			<div class="col-sm-3">
				<?php
					if($p_bdate==1)
					{
						echo '<input tabindex="1" type="text"  name="cdate" id="cdate" data-rule-required="true"  placeholder="Date" class="col-xs-10 col-sm-12 date-picker" list="0"/>';						
					}
					else
					{
						echo '<input readonly="readonly" tabindex="1" type="text"  name="cdate" id="cdate" data-rule-required="true"  placeholder="Date" class="col-xs-10 col-sm-12 date-picker" list="0"/>';						
					}
				?>

			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Party Name</label>

			<div class="col-sm-3">
				<input tabindex="2" type="text"  name="lname" id="lname" autocomplete="off" placeholder="Ledger Name" class="ledgerinfo col-xs-10 col-sm-12" list="0" onkeyup="GetParty();return false;" /><input type="hidden" id="ledger_id" name="ledger_id">
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1" > Jobcard No</label>
			
			<div class="col-sm-3" >
					<input type="text" tabindex="3" name="jobcard" id="jobcard" class="col-xs-10 col-sm-12" placeholder="Jobcard No" data-rule-required="true"/>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-5" id="cust_details"></div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1" > O.P.O.N.</label>
			
			<div class="col-sm-3" >
					<input type="text" name="pon" id="pon" class="col-xs-10 col-sm-12" placeholder=" O.P.O.N." data-rule-required="true"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Ref:</label>

			<div class="col-sm-10">
				<input tabindex="4" type="text"  name="ref_details" id="ref_details" autocomplete="off" placeholder="Ref:" class=" col-xs-10 col-sm-12" list="0"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Sub:</label>

			<div class="col-sm-10">
				<input tabindex="5" type="text"  name="sub_details" id="sub_details" autocomplete="off" placeholder="Sub:" class=" col-xs-10 col-sm-12" list="0"/>
			</div>
		</div>
		<div class="form-group hidden"  style="display:none;">
			<label class="col-sm-2 control-label no-padding-right " for="form-field-1"> State</label>

			<div class="col-sm-3">
					<input type="text" name="ledger_state" id="ledger_state" class="col-xs-10 col-sm-12" placeholder="State" readonly="readonly" />
			</div>
			
		</div>
		<br>
		<div class="form-group">
		<table id="TblRpt" class="table">
		 <thead>
		  <tr>
		   <th class="txt_item">Item Name</th>
		   <th>Specificatio</th>
		   <th>Qty</th>
		   <th>UOM</th>
		   <th>Unit Rate (In Rs.)</th>
		   <th>Total Amount (In Rs.)</th>
		   <th style="width:100px;">Action</th>
		  </tr>
		 </thead>
		 <tbody id="TblRptBody">
		  <tr>
           <td>
			   <select name="itemcode[]" id="item_id" onchange="GetRate(this);return false;" class="col-xs-10 col-sm-12 " >
			    <option value="0">Select Item Name</option>
			    <? foreach($itemlist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?> (<?=$row->specification?>)</option>
			     <? } ?>
			    </select>
				<input type="hidden" id="order_id" name="orderid_gen[]"/>
           </td>
           <td style="width:150px;"><input  type="text" placeholder="" name="item_remark[]" id="item_remark" placeholder="Specification" class="txt_cls"/></td>
           <td style="width:150px;"><input  type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>
           <td style="width:150px;"><input  type="text" name="unit[]" id="txt_unit"  class="txt_cls"/></td>
                    
           <td style="width:150px;"><input  type="text" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>
			<input  type="hidden"  name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>
			<input  type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/>
           
           <td style="width:150px;"><input  type="text" name="freight[]" id="txt_freight" class="freight txt_cls" readonly="true" onblur="TolFreight();" /></td>
           <td><button type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>
		  </tr>
		 </tbody>
		 <tfoot>
		 <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th><input type="text" id="tol_qtymt" name="tol_qtymt" readonly="true" class="txt_cls" /></th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th><input type="hidden" id="tol_qtybag" name="tol_qtybag" readonly="true" class="txt_cls" />Total Amount</th>
		   <th><input type="text" id="tol_freight" name="tol_freight" readonly="true" class="txt_cls" /></th>
		   <th>&nbsp;</th>
		  </tr>	
		 <tr>
		   <th>Packing & Forwarding :</th>
		   <th colspan="6"><input type="text" id="pakking_forwerding" name="pakking_forwerding" class="txt_cls" /></th>
		   <th>&nbsp;</th>
		  </tr>
		  <tr>
		   <th>Freight</th>
		   <th colspan="6"><input type="text" id="lr_freight" name="lr_freight" class="txt_cls"  /></th>
		   <!-- onblur="TolFreight();" onkeyup="TolFreight();" -->
		   <th>&nbsp;</th>
		  </tr>

		  <tr>
		   <th>Delivery Period : </th>
		   <th colspan="6"><input type="text" id="delivery_period" name="delivery_period" class="txt_cls"  /></th>
		   <th>&nbsp;</th>
		  </tr> 
		  <tr>
		   <th>Payment Terms : </th>
		   <th colspan="6"> <input type="text" id="payment_terms" name="payment_terms" class="txt_cls"  /></th>
		   <th>&nbsp;</th>
		  </tr> 
		  <tr>
		   <th >Warranty / Guarantee  : </th>
		   <th colspan="6"><input type="text" id="warranty_guarantee" name="warranty_guarantee" class="txt_cls"  /></th>
		   <th>&nbsp;</th>
		  </tr> 
		  <tr>
		   <th >LD Clause   : </th>
		   <th colspan="6"><input type="text" id="ld_clause" name="ld_clause" class="txt_cls"  /></th>
		   <th>&nbsp;</th>
		  </tr> 
		  <tr>
		   <th >Note  : </th>
		   <th colspan="6"><input type="text" id="remark" name="remark" class="txt_cls"  /></th>
		   <th>&nbsp;</th>
		  </tr> 
		  <tr>
		   <th >Purchase Manager Name  : </th>
		   <th colspan="6"><input type="text" id="designation" name="designation" class="txt_cls"  /></th>
		   <th>&nbsp;</th>
		  </tr>

		  <tr>
		   <th >Prepared By  : </th>
		   <th colspan="6"><input type="text" id="prepared_name" name="prepared_name" class="txt_cls"  /></th>
		   <th>&nbsp;</th>
		  </tr>
		  <tr>
		   <th >Designation  : </th>
		   <th colspan="6"><input type="text" id="designation" name="designation" class="txt_cls"  /></th>
		   <th>&nbsp;</th>
		  </tr>

		 </tfoot>
		</table>
		</div>
		<div class="form-group" style="display:none;">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Loading Person Name</label>
			<div class="col-sm-4">
				<input type="text"  name="loading_person_name" id="loading_person_name" placeholder="Loading Person Name" class="col-xs-11"/><!-- col-xs-10 col-sm-12 -->
			</div>	
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Remark</label>
			<div class="col-sm-4">
				<input type="text"  name="remark" id="remark" placeholder="Remark" class="col-xs-11"/><!-- col-xs-10 col-sm-12 -->
			</div>			
		</div>
		<div class="form-group" style="display:none;">
		<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> LR No.</label>

			<div class="col-sm-4">
				<input type="text"  name="lr_no" id="lr_no" placeholder="LR No." class="col-xs-11"/><!-- col-xs-10 col-sm-12 -->
			</div>	
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Transport</label>

			<div class="col-sm-4">
				<input type="text"  name="transport" id="transport" placeholder="Transport" class="col-xs-11"/><!-- col-xs-10 col-sm-12 -->
			</div>			
		</div>
		<div class="form-group" style="display:none;">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Checked By</label>
			<div class="col-sm-4">
				<input type="text"  name="checked_by" id="checked_by" placeholder="Checked By" class="col-xs-11"/>
			</div>	
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Transport Narration</label>

			<div class="col-sm-4"  style="display:none;">
				<input type="text"  name="transport_narration" id="transport_narration" placeholder="Transport Narration" class="col-xs-11"/><!-- col-xs-10 col-sm-12 -->
			</div>			
		</div>
		<div class="form-group" >
				<input type="hidden"  name="dispatch_through" id="dispatch_through" placeholder="Dispatch Through" class="col-xs-11"/>
			<label class="col-sm-2 control-label">Attach Signature PDF/JPG</label>
			<div class="col-sm-3">
				<input type='file' id='photo' name='photo' class='form-control' />
				<input type="hidden" id="filepath" name="filepath" readonly="readonly"/>
			 	<input type="hidden" id="filename" name="filename" readonly="readonly"/>
			 	 
			</div>  
		</div>

		<div class="form-group" style="display:none;">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> </label> 
			<label class="col-sm-2 control-label uploaded">Upload Doc</label>
			<div class="col-sm-6">
			 	
			 	<div class="uploaded" style="display: none;" id="uploaddoc"></div>
			</div>  
		</div>
		<!-- <div class="space-4"></div> -->

		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="15" class="btn btn-info" type="button" id="newsubmit" >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Submit
				</button>

				&nbsp; &nbsp; &nbsp;
				<button class="btn" type="button" onclick="DeleteRecord(); return false;">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Delete
				</button>
			</div>
		</div>

		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Created By</label>

			<div class="col-sm-3">
				<input type="text"  name="created_by" id="created_by" placeholder="Created By" class="col-xs-10 col-sm-12" readonly="true" />
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Last Modified By</label>

			<div class="col-sm-3">
				<input type="text"  name="modified_by" id="modified_by" placeholder="Last Modified By" class="col-xs-10 col-sm-12" readonly="true"/>
			</div>
		</div>
		<div class="loading"></div>

		<!-- <div class="hr hr-24"></div> -->
		</form>
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
		                alert("Invalid");
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
//                $('.cdate').datepicker({
//                    autoclose: true,
//                    todayHighlight: true,
//                    dateFormat: 'dd-mm-yy'
//                });
					           // CheckPermission(4);
//		    	$('.cdate').val(getCurDate());
//		    	$(".cdate").mask("99-99-9999");
                $("#userform").validationEngine();
		        
		    	status=$('#status').val();
				checkAction(status);

           //      $('#cdate').blur(function(){
			        // data = "cdate=" + $("#cdate").val();
	          //       $.ajax({
			        //     url: "<?php echo base_url();?>index.php/master_general/CheckFinYear",
	          //           type: "GET",
	          //           data: data,
	          //           cache: false,
	          //           success: function (html) {	                    	
	          //           	if(html=="0")
	          //           	{
	          //           		alert("Date Out of Financial Year");
	          //           		$("#cdate").val("");
	          //           		$("#cdate").focus();
		         //        		return false;
	          //           	}
	          //           }
	          //       });
           //      });

			    
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
		    	// if($("#vtype").val())
	        	// {
	        	// 	alert($("#vtype").val());
	        	// 	return;
	        	// }
		        company_id=$.cookie('ae_company_id');
		      //  var rowCount = $('#TblRpt tbody tr').length;		        
		        if(company_id=='' || company_id==0){
                   alert('Unexpected Error ! Login Again .');
		        }
		        else
		        { 

                //data = "list=list";
                if ($('#userform').validationEngine('validate')) 
                {

                	var ledger_id = $('#ledger_id').val();
                	if (ledger_id==0 || ledger_id=='') {
                   		alert('Please Select Party Name');return;
                	}
                    modified_by=$.cookie('ae_username');		            
	                var status = $('input[name=status]');
	                var data = $("#userform").serialize();
	                $('.loading').show();
	                $('button').prop('disabled','disabled');                  
                    var target="<?php echo base_url();?>index.php/transactionController/purchases_save/tbl_trans1/id";
                    $('#userform').ajaxSubmit({url:target,
                            type: "POST",
                            data: data,
                            cache: false,
                            success: function (html) 
                            {
                                 $('.loading').hide();
		                        $('button').removeAttr('disabled');
		                        if(html=="-99")
		                        {
		                        	alert("Credit Limit Crossed");
		                        }
		                        if (html > 0) 
		                        {
		                        	//alert(html);
									var r = confirm("Do You Want to Print");
									if(r==true)
									{
						                window.open("<?php echo base_url();?>index.php/transactionController/purchase_bill_print/"+html,'_blank');
									}	
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
		                                alert('Already Exists');
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


		        //if submit button is clicked
	       //  $('#newsubmit').click(function () {
	       //  	if($("#ledger_mobno").val()=="")
	       //  	{
	       //  		alert("Enter Vehicle No.");
	       //  		return;
	       //  	}
		      //   company_id=$.cookie('ae_company_id');
		      // //  var rowCount = $('#TblRpt tbody tr').length;		        
		      //   if(company_id=='' || company_id==0){
        //            alert('Unexpected Error ! Login Again .');
		      //   }else{ // Valid Company Id
		      //   	//  if(rowCount>1){
		      //       	if ($('#userform').validationEngine('validate')) {
		      //       	modified_by=$.cookie('ae_username');		            
		      //           var status = $('input[name=status]');
		      //           var data = $("#userform").serialize();
		      //           $('.loading').show();
		      //           $('button').prop('disabled','disabled');
		      //           $.ajax({
		      //               url: "<?php echo base_url();?>index.php/transactionController/sales_save",
		      //               type: "POST",
		      //               data: data,
		      //               cache: false,
		      //               success: function (html) {
		      //                   $('.loading').hide();
		      //                   $('button').removeAttr('disabled');
		      //                   if(html=="-99")
		      //                   {
		      //                   	alert("Credit Limit Crossed");
		      //                   }
		      //                   if (html > 0) 
		      //                   {
		      //                   	//alert(html);
								// 	var r = confirm("Do You Want to Print");
								// 	if(r==true)
								// 	{
						  //               window.open("<?php echo base_url();?>index.php/transactionController/sales_bill_print/"+html,'_blank');
								// 	}	
		      //                       if (status.val() == "edit") {
								// 		$('#modal_form').modal('hide');
								// 		return;
		      //                       }
		      //                       else {

		      //                       }
		      //                       $("html, body").animate({ scrollTop: 0 }, "slow");
		      //                       BlankForm();
		      //                       $("[tabindex='1']").focus();
		      //                       $('.done').html("<h4>Record Saved.</h4>");
		      //                       $('.done').fadeIn('slow', function () { });
		      //                       $('.done').delay(600).fadeOut('slow', function () { });
		      //                   } else {
		      //                       if (html == 0) {
		      //                           alert('Already Exists');
		      //                       } else {
		      //                           alert('Sorry, unexpected error. Please try again later.');
		      //                       }
		      //                   }
		      //               }
		      //           });
		      //           return false;
		      //         }
		      //       /* }else{
		      //        	alert('Please add at least one item !');
		      //        }*/
		      //       } // End Check Company
		      //   });





		    });


		    function GetPreviousRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/transactionController/sales_get?id=" + ID;
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
						GetItemList(report_obj.id);
		                $("#sno").val(report_obj.id);
		                $("#status").val("edit");
		                $("#filepath").val(report_obj.file_path);
						$("#filename").val(report_obj.file_name);	
						if (report_obj.file_path!='') 
						{
							$(".uploaded").show();
							$("#uploaddoc").html('<a target="_blank" href="'+report_obj.file_path+'">'+report_obj.file_path+'</a>');	
						}
						

		                CalcAmount();
		            }
		            else {
		                alert("Invalid");
		            }
		        });
		    }

		    function GetState(ID) {
		        var url = "<?php echo base_url();?>index.php/helperController/getstate?id="+ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
						$('#ledger_state').val(report_obj.state);
		            }
		            else{
						$('#ledger_state').val("");
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

		    function GetRate(param) {
//		    	addLoading();
            	cRow=$(param).parent().parent();
				item_id=$(cRow).find('#item_id').val();
				cdate=$('#cdate').val();
				ledger_id = $('#ledger_id').val();
		        var url = "<?php echo base_url();?>index.php/master_general/party_rate_get_single?item_id="+item_id+"&cdate="+cdate+"&ledger_id="+ledger_id;
				$.ajax({
					url : url,
					type:"get",
					async:false,
					success:function(data)
					{
						//alert(data);
			            var report_obj = JSON.parse(data);
						$(cRow).find('#txt_rate').val(report_obj.rate);
						$(cRow).find('#txt_unit').val(report_obj.unit);
						$(cRow).find('#item_remark').val(report_obj.specification);
						
									
						CalcAmount(param);					
//						clearLoading();

					}
				});		        
		    }



		    function GetDiscount(param,party_id,item_id) {
//		    	addLoading('data-form');
            	cRow=$(param).parent().parent();
		        var url = "<?php echo base_url();?>index.php/master_general/party_discount_get?party_id=" + party_id+"&item_id="+item_id;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
					$(cRow).find('#txt_discountrs').val(report_obj.discountrs);
					$(cRow).find('#txt_discountper').val(report_obj.discountper);
					CalcAmount(param);					
		        });
		    }


            function DeleteRecord() {
            	ID=$("#sno").val();
		        var r = confirm("Do You Want to Delete");
		        if (r == true) {
		            $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/transactionController/voucher_delete/"+ID,
		                    type: "POST",
		                    data: {ID: ID},
		                    cache: false,
		                    success: function (html) {
		                        $('.loading').hide();
		                        if(html==1){
									$('#modal_form').modal('hide');
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
		      function GetOrderRecord(id){
                var url = "<?php echo base_url();?>index.php/transactionController/pending_order_get?id=" + id;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $.each(report_obj, function(key, value) {
						    if(key=='Message' || key=='sno' || key=='status'){ 
                               //declare manually
						    }else{
						    $("#"+key).val(value);
						    }
						});
						GetItemListOrder(id);
		                $("#status").val("add");
		                ShowForm();
		            }
		            else {
		                alert("Invalid");
		            }
		        });
		      }
		      function GetActualAmt(){
		      	act_freight=$('#act_freight').val();
		      	if(act_freight==''){
		      		act_freight=0;
		      	}
		         act_amt=act_freight*20;
		      	 $('#act_rate').val(act_amt);
		      	 GetDifference();
		      }
		      function GetDifference(){
		      	appr_freight=$('#freight_rate').val();
		      	act_freight=$('#act_rate').val();
		      	if(act_freight==''){
		      		act_freight=0;
		      	}
		      	dif=appr_freight-act_freight;
		      	$('#difference').val(dif);
		      }
/*
		      function ItemAdd(){
		      	itemname=$('#txt_item').val();
		      	itemid=$('#item_id').val();
		      	qtymt=$('#txt_qtymt').val();
		      	qtybag=$('#txt_qtybag').val();
		      	type=$('#txt_type').val();
		      	rate=$('#txt_rate').val();
		      	freight=$('#txt_freight').val();
		      	if(itemname!='' && qtymt!=''){
			      	$('#TblRpt tbody').append('<tr class="edit">'
			      	+ '<td>'+itemname+'<input type="hidden" name="itemcode[]" value="'+itemid+'"></td>'
			      	+ '<td class="qtymt">'+qtymt+'<input type="hidden" class="qtymt" name="qtymt[]" value="'+qtymt+'"></td>'
			      	+ '<td class="qtybag">'+qtybag+'<input type="hidden" name="qtybag[]" value="'+qtybag+'"></td>'
			      	+ '<td>'+rate+'<input type="hidden" name="rate[]" value="'+rate+'"></td>'
			      	+ '<td class="freight">'+freight+'<input type="hidden" class="freight" name="freight[]" value="'+freight+'"></td>'
			      	+ '<td><button type="button" class="del btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>'
			      	+'</tr>');
			      	ClnTxt();
			      	TolQtyMT();
			      	TolQtyBag();
			      	TolFreight();
			      	$('#txt_item').focus();
		        }else{
		        	alert('Please Fill Item name and Quantity !');
		        	$('#txt_item').focus();
		        }
		      }*/
		      function ClnTxt(){
		      	$('#txt_item,#item_id,#txt_qtymt,#txt_qtybag,#txt_stkno,#txt_rate,#txt_freight').val('');
		      	$('.type').prop('selectedIndex',-1);
		      }
		      function TolQtyMT(){
                var sum = 0;
				$(".qtymt").each(function() {
				    var value = $(this).val();
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				    }
				    $('#tol_qtymt').val(sum);
				});
		      }
		      //////////////
		      function TolQtyBag(){
			      var sum = 0;
					$(".qtybag").each(function() {
					    var value = $(this).val();
					    if(!isNaN(value) && value.length != 0) {
					        sum += parseFloat(value);
					    }
					    $('#tol_qtybag').val(sum);
					});	
		      }

		        $('#NextButton').click(function () {
		        	if($("#nextid").val()!="" && $("#nextid").val()!="0")
		        	{
//			        	addLoading();
			        	GetRecord($("#nextid").val());
//			        	clearLoading();
		        	}
		        	else
		        	{
		        		BlankForm();
		        	}
		        });

		        $('#PrevButton').click(function () {
		        	if($("#previd").val()!="" && $("#previd").val()!="0")
		        	{
//			        	addLoading();
			        	GetRecord($("#previd").val());
//			        	clearLoading();
		        	}
		        	else
		        	{
		        		BlankForm();
		        	}
		        });

		        $('#BackButton').click(function () {
		        	$("#MainContent").html(localStorage.getItem("lastform"));					
		        	GetRpt();
		        });

	            function CalcAmount(param){
	            	cRow=$(param).parent().parent();

	            	rate=parseFloat($(cRow).find('#txt_rate').val())|| 0;
	            	qtybag=parseFloat($(cRow).find('#txt_qtymt').val())|| 0;
	            	if(isNaN(rate) || rate=='' || rate==0){
	            		$(cRow).find('#txt_freight').val('0');
	            	}
	            	freight=parseFloat(rate)*parseFloat(qtybag);
	            	discount=parseFloat($(cRow).find('#txt_discountper').val())|| 0;
	            	discountrs=parseFloat($(cRow).find('#txt_discountrs').val())|| 0;
	            	tot_disc=parseFloat(discountrs)*parseFloat(qtybag)
	            	var sub = 0;
	            	sub=(parseFloat(freight)- parseFloat(tot_disc).toFixed(2))*parseFloat(discount)/100;
	            	freight=parseFloat(parseFloat(freight)-parseFloat(sub)).toFixed(2) - parseFloat(tot_disc).toFixed(2);

                    $(cRow).find('#txt_freight').val(freight);

                    TolFreight();
	           			}


		     // function tolamount(){
	      //      	Tolqty=parseFloat($('#txt_qtymt').val()) || 0.00;
	      //      	Tolrate=parseFloat($('#txt_rate').val()) || 0.00;
	      //      	totalamount=parseFloat(Tolqty)*parseFloat(Tolrate);
	      //      	$('#txt_freight').val(totalamount);
	      //      }

		      function TolFreight(){
		      	var sum = 0;
		      	var freight=0;
		      	freight = $("#lr_freight").val();

		      	paid_build = $("#paid_build").val() || 0.00;

				$(".freight").each(function() {
				    var value = $(this).val();

				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				    }				   
				});
			    if(!isNaN(freight) && freight.length != 0) {
			        sum += parseFloat(freight);
			    }

			    sum = parseFloat(sum)+parseFloat(paid_build);
			    $('#tol_freight').val(parseFloat(sum,2));
				GetBal();
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
	         // }else{
          //       //alert('Please Select Category !');
          //       $('#txt_item,#item_id');
          //       return false;
	         // }
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

	           function GetBal(){
	           	tolfreight=parseFloat($('#tol_freight').val()) || 0.00;
	           	lessadv=parseFloat($('#lessadv').val()) || 0.00;
	           	tolbal=parseFloat(tolfreight)-parseFloat(lessadv);
	           	$('#balfreight').val(tolbal);
	           }
                $(document).on('click','.del',function(){
                  $(this).closest('tr').remove();
                  TolQtyMT();
                  TolQtyBag();
                  // tolamount();
                  TolFreight();
                });
                $(document).on('dblclick','.edit',function(){
                status=$('#status').val();
                  iname=$(this).closest('tr').find('td:eq(0)').text();
                  icode=$(this).closest('tr').find('td:eq(0) input:hidden').val();
                  qtymt=$(this).closest('tr').find('td:eq(1)').text();
                  qtybag=$(this).closest('tr').find('td:eq(2)').text();
                  rate=$(this).closest('tr').find('td:eq(3)').text();
                  discount=$(this).closest('tr').find('td:eq(4)').text();
                  freight=$(this).closest('tr').find('td:eq(5)').text();
                  $('#txt_item').val(iname);
                  $('#item_id').val(icode);
                  $('#txt_qtymt').val(qtymt);
                  $('#txt_qtybag').val(qtybag);
                  $('#txt_rate').val(rate);
                  $('#txt_discount').val(discount);
                  $('#txt_freight').val(freight);
                  $(this).closest('tr').remove();
                  TolQtyMT();
                  TolQtyBag();
                  // tolamount();
                  TolFreight();
                });
                function ResetItemTable(){
                 $('#TblRpt tbody tr:not(:first)').remove();	
                 $('#txt_item,#item_id,#txt_qtymt,txt_qtybag,#txt_rate,#txt_freight,#tol_qtymt,#tol_qtybag,#tol_freight').val('');
                }
			    	////////////
			  function ItemAddNew(currentRow){
			  	 var x=document.getElementById('TblRptBody');
			  	 // alert(x);
			  	 var new_row = x.rows[0].cloneNode(true);
			  	 var lastrow=x.rows.length-1;
			  	 var ti=0;
			  	 // console.log(currentRow);
			  	 if(currentRow.parentNode.parentNode.rowIndex-1!=lastrow)
			  	 {
			  	 	return;
			  	 }
			  	 // console.log(lastrow);
			  	 // console.log(x.rows[lastrow].innerHTML);
			  	 // ti = x.rows[lastrow].cells[8].getElementsByTagName('button')[0].tabIndex;
			  	 // console.log(x.rows[lastrow].cells[8].getElementsByTagName('button')[0].tabIndex);
			  	 item_name = x.rows[lastrow].cells[0].getElementsByTagName('select')[0].value;
			  	 if(item_name=="")
			  	 {
			  	 	alert("Please Enter Item Name");
			  	 	x.rows[lastrow].cells[0].getElementsByTagName('select')[0].focus();
			  	 	return;
			  	 }
			  	 for(i=0;i<new_row.cells.length;i++)
			  	 {
					var inp1 = new_row.cells[i].getElementsByTagName('select')[0];
					// console.log(new_row.cells[i].getElementsByTagName('select')[0]);
					if(inp1!=undefined)
					{
						ti++;
					    inp1.value = '';
					    // inp1.tabIndex=ti;
					}
					else
					{
						var inp1 = new_row.cells[i].getElementsByTagName('input')[0];
						if(inp1!=undefined)
						{
								ti++;
							    inp1.value = '';
							    // inp1.tabIndex=ti;
							    // inp1.readOnly=false;
							    // if(i==0)
							    // {
								// 	var i1 = x.rows[lastrow].cells[0].getElementsByTagName('input')[0];
								// 	i1.readOnly=true;
							    // }
						}
						else
						{
							// var inp1 = new_row.cells[i].getElementsByTagName('button')[0];
							// if(inp1!=undefined)
							// {
							// 	ti++;
							//     inp1.value = '';
							//     // inp1.tabIndex=ti;
							// }
						}
					}
			  	 }
			  	 // ti++;
			  	 // ti++;
			  	 // $("#remark").attr("tabindex",ti);
			  	 // ti++;
			  	 // $("#newsubmit").attr("tabindex",ti);
			  	 x.appendChild( new_row );
                TolQtyMT();
                TolQtyBag();
                TolFreight();
		    	MoveTextBoxRefresh('.form-input');
		    	// $('.chosen-select').chosen({width: "100%"});
				// x.rows[x.rows.length-1].cells[0].getElementsByTagName('select')[0].focus();

			  }
			  /////////////////
			  function deleteRow(row)
				{
			    var i=row.parentNode.parentNode.rowIndex-1;
			    document.getElementById('TblRptBody').deleteRow(i);
			    TolQtyMT();
                TolQtyBag();
                // tolamount();
                TolFreight();
				}  	

//////////////////////
               function checkAction(status){
	              if(status=='edit'){
	              	id=$('#sno').val();
	              	GetRecord(id);
	              } 
				}

	 	function GetParty(){
                $(".ledgerinfo").autocomplete({
                    source: urlstr +"index.php/helperController/get_partyinfo_cmpt",
                    minLength: 1,
                    focus: function (event, ui) {
                    $(event.target).val(ui.item.label);             
                    $('#ledger_id').val(ui.item.id);
                    getcust_details(ui.item.id);
                    GetState(ui.item.id);
                    return false;
                    },
                    select: function (event, ui) {
                    $(event.target).val(ui.item.label);
                    $('#ledger_id').val(ui.item.id);
                    GetState(ui.item.id);                    
                    getcust_details(ui.item.id);
                    return false;
                    },
                });
             }
             function getcust_details(ID) {
		        var url = "<?php echo base_url();?>index.php/helperController/getcust_details?id="+ID;
		        $.get(url, function (data) {
		            
						$('#cust_details').html(data);
		        });
		    }
        $(document).ready(function() {
            // $('.chosen-select').chosen({width: "100%"});
		});
</script>
