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
   <input type="hidden" id="permission" value=""/>
   <div id="data-list">
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
		    <h4 class="widget-title"><?=$title?></h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
        <input type="hidden" value="<?=$orderno?>" name="orderno" id="orderno" class="form-control" />
        <input type="hidden" value="<?=$vtype?>" name="vtype" id="vtype" class="form-control" />
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bill No.</label>

			<div class="col-sm-3">
				<input tabindex="1" type="text"  name="billno" id="billno" data-rule-required="true"  placeholder="Bill No." readonly="readonly" class="col-xs-10 col-sm-12"/> <input  type="hidden"  name="cat_id" id="cat_id"/>
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Date</label>

			<div class="col-sm-3">
				<input tabindex="2" type="text"  name="cdate" id="cdate" data-rule-required="true"  placeholder="Date" class="col-xs-10 col-sm-12 cdate" list="0"/>
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Builty No.</label>

			<div class="col-sm-3">
				<input tabindex="3" type="text"  name="builtyno" id="builtyno" placeholder="Builty No" class="col-xs-10 col-sm-12 validate[required]"/>
			</div>

			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Truck No</label>

			<div class="col-sm-3">
				<input tabindex="4" type="text"  name="truckno" id="truckno" placeholder="Truck" class="col-xs-10 col-sm-12 validate[minSize[10]]"/>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Type</label>

			<div class="col-sm-3">
				<select tabindex="5" id="type" name="type" class="col-xs-10 col-sm-12 validate[required]">
				 <option selected>SELF</option>
				 <option>PARTY</option>
				 <option>TRANSPORTER</option>
				</select>
			</div>
	   </div>
	   
	    <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Source</label>

			<div class="col-sm-3">
			    <select name="source_id" id="source_id" class="col-xs-10 col-sm-12" tabindex="6">
			    <? foreach($sourcelist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Party Name</label>

			<div class="col-sm-3">
			    <select name="ledger_id" id="ledger_id" class="col-xs-10 col-sm-12" tabindex="7">
			    <? foreach($partylist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Party Mob No</label>

			<div class="col-sm-3">
				<input type="text" tabindex="8" name="ledger_mobno" id="ledger_mobno" class="col-xs-10 col-sm-12" placeholder="Party Mob No"/>
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Consignee Name</label>

			<div class="col-sm-3">
				<input type="text" tabindex="9" name="consignee_name" id="consignee_name" class="col-xs-10 col-sm-12" placeholder="Consignee Name"/>
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Consignee Mob No</label>

			<div class="col-sm-3">
				<input type="text" tabindex="10" name="consignee_mobno" id="consignee_mobno" class="col-xs-10 col-sm-12" placeholder="Consignee Mob No"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Destination</label>

			<div class="col-sm-3">
			    <select name="destination_id" id="destination_id" class="col-xs-10 col-sm-12 validate[required]" tabindex="11">
			    <option value="">-</option>
			    <? foreach($destinationlist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
		</div>
		<div class="form-group">
		<table id="TblRpt" class="table">
		 <thead>
		  <tr>
		   <th class="txt_item">Item Name</th>
		   <th>Qty(M.T.)</th>
		   <th>Qty(Bags)</th>
		   <th>Deal Rate</th>
		   <th>Freight</th>
		   <th>Auth. Rate</th>
		   <th>Actual Rate</th>
		   <th>Amount</th>
		   <th>Action</th>
		  </tr>
		 </thead>
		 <tbody>
		  <tr>
           <td><input tabindex="12" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt();" list="0"/><input type="hidden" id="item_id" name="item_id"/><input type="hidden" id="order_id"  name="order_id"/></td>
           <td><input tabindex="13" type="text" id="txt_qtymt" class="txt_cls" onblur="GetQtyBag();return false;"/></td>
           <td><input tabindex="14" type="text" id="txt_qtybag" class="txt_cls" readonly="true"/></td>           
           <td><input tabindex="15" type="text" id="txt_rate" class="txt_cls" onblur="GetAmount();return false;"/></td>
           <td><input tabindex="16" type="text" id="txt_freight" class="txt_cls" onblur="GetAmount();return false;"/></td>
           <td><input tabindex="17" type="text" id="txt_auth_rate" class="txt_cls" onblur="GetAmount();return false;"/></td>
           <td><input tabindex="18" type="text" id="txt_actual_rate" class="txt_cls" onblur="GetAmount();return false;"/></td>
           <td><input tabindex="19" type="text" id="txt_amt" class="txt_cls"/></td>
           <td><button tabindex="20" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAdd();return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button></td>
		  </tr>
		 </tbody>
		 <tfoot>	
		  <tr>
		   <th>&nbsp;</th>
		   <th><input type="text" id="tol_qtymt" name="tol_qtymt" readonly="true" class="txt_cls" /></th>
		   <th><input type="text" id="tol_qtybag" name="tol_qtybag" readonly="true" class="txt_cls" /></th>
		   <th>&nbsp;</th>
		   <th colspan="2" style="text-align:right;"><b>Total Freight</b></th>
		   <th colspan="2"><input type="text" id="tol_freight" name="tol_freight" readonly="true" class="txt_cls" /></th>
		  </tr>
		  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th colspan="2" style="text-align:right;"><b>Less Advance</b></th>
		   <th colspan="2"><input tabindex="21" type="text" id="lessadv" name="lessadv"  class="txt_cls validate[custom[number]]" onblur="GetBal();" /></th>
		  </tr>
		  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th colspan="2" style="text-align:right;"><b>Balance Freight</b></th>
		   <th colspan="2"><input type="text" id="balfreight" name="balfreight" readonly="true" class="txt_cls" /></th>
		  </tr>
		  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		  </tr>
		  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th colspan="2" style="text-align:right;"><b>Total Amount</b></th>
		   <th colspan="2"><input type="text" id="tol_amt" name="tol_amt" readonly="true" class="txt_cls" /></th>
		  </tr>
		  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th colspan="2" style="text-align:right;"><b>VAT @<input type="text" id="vat_percent" name="vat_percent" readonly="true" style="width:50px;" />%</b></th>
		   <th colspan="2"><input type="text" id="vat_amt" name="vat_amt" readonly="true" class="txt_cls" /></th>
		  </tr>
		  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th><b>Net Total</b></th>
		   <th colspan="2"><input type="text" id="net_tol" name="net_tol" readonly="true" class="txt_cls" /></th>
		  </tr>
		 </tfoot>
		</table>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Remark</label>

			<div class="col-sm-10">
				<input type="text" tabindex="22" name="remark" id="remark" placeholder="Remark" class="col-xs-11"/><!-- col-xs-10 col-sm-12 -->
			</div>			
		</div>
		<div class="space-4"></div>

		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="23" class="btn btn-info" type="button" id="newsubmit" >
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
		        $('#userform').find('input:password').val('');
		        $('#userform').find('#orderno').val('0');
		        $('#userform')[0].reset();
		         $('#TblRpt tbody tr:not(:first)').remove();
		         $('#created_by').val($.cookie('ae_username'));
		        $('.cdate').val(getCurDate());
		        $('#status').val('add');
		    }
		    function ShowList() {
		        $('#data-form').fadeOut(500, function () {
		            $('#data-list').fadeIn(500);
		            GetList();
		        });
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
 		    function GetList() {
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/invoice_list",
		            type: "GET",
		            data: data+'&vtype='+$('#vtype').val(),
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
			               $('#data-list-table table').DataTable( {
					        "fnDrawCallback": function( oSettings ) {
					            CheckPermission(7);
					        }
					    } );
		                $(".loading").hide();
		            }
		        });
		    }
		    function GetItemList(ID) {
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/invoice_get_item",
		            type: "GET",
		            data: data+'&vtype='+$('#vtype').val()+'&id='+ID,
		            cache: false,
		            success: function (html) {
		                $('#TblRpt tbody tr:not(:first)').remove();
		                $('#TblRpt tbody').append(html);
		                TolQtyMT();
		                TolQtyBag();
		                TolFreight();
		                GetBal();
		                $(".loading").hide();
		            }
		        });
		    }
            function SetCancel(t){
            	ID=$(t).attr('rel');
                lname=$(t).parent().parent().parent().find('td').eq(4).text();
            	r=confirm('Do You want to cancel Record ? If Yes Click Ok Button .');
            	if(!r){
                  //false
            	}else{
            		data='ID='+ID+'&Remark='+lname;
	          	    $('.loading').show();
	                $.ajax({
	                    url: "<?php echo base_url();?>index.php/transactionController/invoice_cancel_by_id",
	                    type: "POST",
	                    data: data,
	                    cache: false,
	                    success: function (html) {
	                        $('.loading').hide();
	                        if(html==1){;
	                        	ShowList();
	                            GetList();
	                            $('.done').html("<h4>Record Cancel.</h4>");
	                            $('.done').fadeIn('slow', function () { });
	                            $('.done').delay(600).fadeOut('slow', function () { });
	                        }
	                        else if(html==2){
	                            alert('Sorry Cancel Operation Failed !');
	                        }
	                        else{
	                        	alert('Sorry, unexpected error. Please try again later.');
	                        }
	                    }
	                });
	                return false;
		        }
            }
		    $(document).ready(function () {
		    	CheckForm($('#orderno').val());
		    	MoveTextBox('.form-input');
		    	$('.cdate').val(getCurDate());
		    	$(".cdate").mask("99-99-9999");
                $("#userform").validationEngine();
		        
                $('#load,#cross,#direct').click(function(){
				id=$(this).attr('id');
				if($(this).is(':checked')){
				    $(this).val('YES');  // checked
				    if(id=='load'){
				    	$('.optional1').show();
				    }else if(id=='direct'){
				    	$('.optional2').show();
				    }
				}
				else{
				    $(this).val('no');  // unchecked
				    if(id=='load'){
				    	$('.optional1').hide();
				    }else if(id=='direct'){
				    	$('.optional2').hide();
				    }
			    }
			    });

                $('#cdate').blur(function(){
			        data = "cdate=" + $("#cdate").val();
	                $.ajax({
			            url: "<?php echo base_url();?>index.php/master_general/CheckFinYear",
	                    type: "GET",
	                    data: data,
	                    cache: false,
	                    success: function (html) {	                    	
	                    	if(html=="0")
	                    	{
	                    		alert("Date Out of Financial Year");
	                    		$("#cdate").val("");
	                    		$("#cdate").focus();
		                		return false;
	                    	}
	                    }
	                });
                });

			    $('#stop_builty').click(function(){
			    	if($(this).is(':checked'))
			    		{
                          $(this).val('YES');
			    		}else{
                          $(this).val('no');
			    		}
			    });
			    $('#act_freight').keyup(function(){
			    	GetActualAmt();
			    });
		        //if submit button is clicked
		        $('#newsubmit').click(function () {
		        company_id=$.cookie('ae_company_id');
		        var rowCount = $('#TblRpt tbody tr').length;		        
		        if(company_id=='' || company_id==0){
                   alert('Unexpected Error ! Login Again .');
		        }else{ // Valid Company Id
		        	  if(rowCount>1){
		            	if ($('#userform').validationEngine('validate')) {	
		            	modified_by=$.cookie('ae_username');		            	            
		                var status = $('input[name=status]');
		                var data = $("#userform").serialize();
		                $('.loading').show();
		                $('button').prop('disabled','disabled');
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/transactionController/invoice_save",
		                    type: "POST",
		                    data: data+'&modified_by='+modified_by,
		                    cache: false,
		                    success: function (html) {
		                        $('.loading').hide();
		                        $('button').removeAttr('disabled');
		                        if (html == 1) {
		                            $("html, body").animate({ scrollTop: 0 }, "slow");
		                            if (status.val() == "edit") {
		                                ShowList();
		                                GetList();
		                            }
		                            else {

		                            }
		                            BlankForm();
		                            $("[tabindex='1']").focus();
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
		             }else{
		             	alert('Please add at least one item !');
		             }
		            } // End Check Company
		        });


		    });


		    function GetRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/transactionController/invoice_get?id=" + ID;
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
						$('#tol_qtymt,#tol_qtybag').val('');
						GetItemList(report_obj.id);
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
		                    url: "<?php echo base_url();?>index.php/transactionController/dispatch_delete/tbl_trans1/tbl_trans2/id/billno",
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
		      function CheckForm(id){
		      	if(id==0){
                    $("#data-list").show();
		        	$("#data-form").hide();
		        	GetList();
		      	}else{
		        	GetOrderRecord(id);
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
						if($('#d_ledger_id').val()==0){
                          $('.optional2').hide();
						}else{
						  $('.optional2').show();
						}
                        if($('#l_godown_id').val()==0){
                          $('.optional1').hide();
						}else{
						  $('.optional1').show();
						}
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

		      function ItemAdd(){
		      	itemname=$('#txt_item').val();
		      	itemid=$('#item_id').val();
		      	order_id=$('#order_id').val();
		      	qtymt=$('#txt_qtymt').val();
		      	qtybag=$('#txt_qtybag').val();
		      	type=$('#txt_type').val();
		      	rate=$('#txt_rate').val();
		      	freight=$('#txt_freight').val();
		      	auth_rate=$('#txt_auth_rate').val();
		      	actual_rate=$('#txt_actual_rate').val();
		      	amt=$('#txt_amt').val();
		      	if(itemname!='' && qtymt!='' && amt!=''){
			      	$('#TblRpt tbody').append('<tr class="edit">'
			      	+ '<td>'+itemname+'<input type="hidden" name="itemcode[]" value="'+itemid+'"><input type="hidden" name="orderid_gen[]" class="order_id" value="'+order_id+'"></td>'
			      	+ '<td class="qtymt">'+qtymt+'<input type="hidden" class="qtymt" name="qtymt[]" value="'+qtymt+'"></td>'
			      	+ '<td class="qtybag">'+qtybag+'<input type="hidden" name="qtybag[]" value="'+qtybag+'"></td>'
			      	+ '<td>'+rate+'<input type="hidden" name="rate[]" value="'+rate+'"></td>'
			      	+ '<td class="freight">'+freight+'<input type="hidden" class="freight" name="freight[]" value="'+freight+'"></td>'
			      	+ '<td class="auth_rate">'+auth_rate+'<input type="hidden" class="auth_rate" name="auth_rate[]" value="'+auth_rate+'"></td>'
			      	+ '<td class="actual_rate">'+actual_rate+'<input type="hidden" class="actual_rate" name="actual_rate[]" value="'+actual_rate+'"></td>'
			      	+ '<td class="amt">'+amt+'<input type="hidden" class="amt" name="amt[]" value="'+amt+'"></td>'
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
		      }
		      function ClnTxt(){
		      	$('#txt_item,#item_id,#txt_qtymt,#txt_qtybag,#txt_stkno,#txt_rate,#txt_freight,#txt_auth_rate,#txt_actual_rate,#txt_amt').val('');
		      	$('.type').prop('selectedIndex',-1);
		      }
		      function TolQtyMT(){
                var sum = 0;
				$(".qtymt").each(function() {
				    var value = $(this).text();
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				    }
				    $('#tol_qtymt').val(sum);
				});
		      }
		      function TolQtyBag(){
			      var sum = 0;
					$(".qtybag").each(function() {
					    var value = $(this).text();
					    if(!isNaN(value) && value.length != 0) {
					        sum += parseFloat(value);
					    }
					    $('#tol_qtybag').val(sum);
					});	
		      }
		      function TolFreight(){
		      	var sum = 0;
				$(".freight").each(function() {
				    var value = $(this).text();
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				    }
				    $('#tol_freight').val(sum);
				});


		      	var sum = 0;
				$(".amt").each(function() {
				    var value = $(this).text();
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				    }
				    $('#tol_amt').val(sum);
				});

	        	vat_percent=parseFloat($('#vat_percent').val())|| 0;

                vat_amt=parseFloat(sum)*parseFloat(vat_percent)/100;
            	vat_amt=parseFloat(vat_amt).toFixed(2);
                $('#vat_amt').val(vat_amt);

                    
                net_tol=parseFloat(sum)+parseFloat(vat_amt);
            	net_tol=parseFloat(net_tol).toFixed(2);
                $('#net_tol').val(net_tol);


		      }
		      function getItemAutoCompt(){
		       cat=$('#cat_id').val();
               if(cat>0){
	            $(".item").autocomplete({
	            source: urlstr+"index.php/helperController/get_item2?cat="+cat,
	            minLength: 1,
	            focus: function (event, ui) {
	            $(event.target).val(ui.item.label);
	            $('#item_id').val(ui.item.id);	            
	            return false;
	            },
	            select: function (event, ui) {
	            $(event.target).val(ui.item.label);
	            $('#item_id').val(ui.item.id);
	            return false;
	        	},
	            });
	         }else{
                alert('Please Select Category !');
                $('#txt_item,#item_id');
                return false;
	         }
	        }
	            function GetQtyBag(){
	            	qtymt=parseFloat($('#txt_qtymt').val())|| 0;
	            	qtybag=parseFloat($('#txt_qtybag').val())|| 0;
	            	if(isNaN(qtymt) || qtymt=='' || qtymt==0){
	            		$('#txt_qtybag').val('0');
	            	}
	            	tolbag=parseFloat(qtymt)*20;
	            	tolbag=parseFloat(tolbag).toFixed(2);
                    $('#txt_qtybag').val(tolbag);

                    GetAmount();
	           }

	            function GetAmount(){
	            	qtybag=parseFloat($('#txt_qtybag').val())|| 0;
	            	auth_rate=parseFloat($('#txt_auth_rate').val())|| 0;
	            	freight=parseFloat($('#txt_freight').val())|| 0;
	            	vat_percent=parseFloat($('#vat_percent').val())|| 0;
	            	freightbag=0;

	            	if(isNaN(qtybag) || qtybag=='' || qtybag==0){
		            	freightbag=0;
	            	}else{
	            		if(vat_percent=="14.00" || vat_percent=="14.50")
	            		{
		            		freightbag = parseFloat(freight)/parseInt(qtybag);
						}
	            	}
	            	rate = parseFloat(auth_rate)-parseFloat(freightbag);
	            	rate = parseFloat(rate)*100/(100+parseFloat(vat_percent));
	            	rate = parseFloat(rate).toFixed(2);
                    $('#txt_actual_rate').val(rate);

	            	amt=parseFloat(qtybag)*parseFloat(rate);
	            	amt=parseFloat(amt).toFixed(2);
                    $('#txt_amt').val(amt);
                    
	           }

	           function GetBal(){
	           	tolfreight=$('#tol_freight').val();
	           	lessadv=$('#lessadv').val();
	           	if(tolfreight!='' && lessadv!=''){
		           	tolbal=parseInt(tolfreight)-parseInt(lessadv);
		           	$('#balfreight').val(tolbal);
		           	return false;
	            }
	           }
                $(document).on('click','.del',function(){
                  $(this).closest('tr').remove();
                  TolQtyMT();
                  TolQtyBag();
                  TolFreight();
                });
                $(document).on('dblclick','.edit',function(){
                status=$('#status').val();
                  iname=$(this).closest('tr').find('td:eq(0)').text();
                  icode=$(this).closest('tr').find('td:eq(0) input:hidden').val();
                  order_id=$(this).closest('tr').find('td:eq(0) .order_id').val();
                  qtymt=$(this).closest('tr').find('td:eq(1)').text();
                  qtybag=$(this).closest('tr').find('td:eq(2)').text();
                  rate=$(this).closest('tr').find('td:eq(3)').text();
                  freight=$(this).closest('tr').find('td:eq(4)').text();
                  auth_rate=$(this).closest('tr').find('td:eq(5)').text();
                  actual_rate=$(this).closest('tr').find('td:eq(6)').text();
                  amt=$(this).closest('tr').find('td:eq(7)').text();
                  $('#txt_item').val(iname);
                  $('#item_id').val(icode);
                  $('#order_id').val(order_id);
                  $('#txt_qtymt').val(qtymt);
                  $('#txt_qtybag').val(qtybag);
                  $('#txt_rate').val(rate);
                  $('#txt_freight').val(freight);
                  $('#txt_auth_rate').val(auth_rate);
                  $('#txt_actual_rate').val(actual_rate);
                  $('#txt_amt').val(amt);
                  $(this).closest('tr').remove();
                  TolQtyMT();
                  TolQtyBag();
                  TolFreight();
                  GetBal();
                });
                function ResetItemTable(){
                 $('#TblRpt tbody tr:not(:first)').remove();	
                 $('#txt_item,#item_id,#txt_qtymt,txt_qtybag,#txt_rate,#txt_freight,#txt_auth_rate,#txt_actual_rate,#txt_amt,#tol_qtymt,#tol_qtybag,#tol_freight').val('');
                }
				</script>
