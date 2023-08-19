   
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
   <div id="data-list">
            <input id="permission" type="hidden" value="" />
		    <button class="btn btn-xs btn-primary btn_entry" onclick="ShowForm(); BlankForm();  return false;">
			    ADD NEW
		    </button>
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
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Category</label>

			<div class="col-sm-3">
			    <select name="cat_id" id="cat_id" class="col-xs-10 col-sm-12 validate[required]" tabindex="1" onchange="ResetItemTable();">
			    <option value="">-</option>
			    <? foreach($categorylist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
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
		   <th style="width:100px;">Action</th>
		  </tr>
		 </thead>
		 <tbody id="TblRptBody">
		  <tr>
           <td><input tabindex="12" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>
           <td><input tabindex="13" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>
           <td><input tabindex="14" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           
           <td><input tabindex="15" type="text" name="rate[]" id="txt_rate" class="txt_cls"/></td>
           <td><input tabindex="16" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>
           <td><button tabindex="17" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button tabindex="18" type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>
		  </tr>
		 </tbody>
		 <tfoot>	
		  <tr>
		   <th>&nbsp;</th>
		   <th><input type="text" id="tol_qtymt" name="tol_qtymt" readonly="true" class="txt_cls" /></th>
		   <th><input type="text" id="tol_qtybag" name="tol_qtybag" readonly="true" class="txt_cls" /></th>
		   <th><b>Total Freight</b></th>
		   <th><input type="text" id="tol_freight" name="tol_freight" readonly="true" class="txt_cls" /></th>
		   <th>&nbsp;</th>
		  </tr>
		  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th><b>Less Advance</b></th>
		   <th><input tabindex="18" type="text" id="lessadv" name="lessadv"  class="txt_cls validate[custom[number]]" /></th>
		   <th>&nbsp;</th>
		  </tr>
		  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th><b>Balance Freight</b></th>
		   <th><input type="text" id="balfreight" name="balfreight" readonly="true" class="txt_cls" /></th>
		   <th>&nbsp;</th>
		  </tr>
		 </tfoot>
		</table>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Remark</label>

			<div class="col-sm-10">
				<input type="text" tabindex="19" name="remark" id="remark" placeholder="Remark" class="col-xs-11"/><!-- col-xs-10 col-sm-12 -->
			</div>			
		</div>
		<div class="space-4"></div>

		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="20" class="btn btn-info" type="button" id="newsubmit" >
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
		        $('#TblRpt tbody tr:first').find('input:text').val('');
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
		        vtype=$('#vtype').val();
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/dispatch_list",
		            type: "GET",
		            data: data+'&vtype='+$('#vtype').val(),
		            cache: false,
		            success: function (html) {
                                if(vtype=='dispatch'){
                                CheckPermission(4);
                                }
                                if(vtype=='transfer'){
                                CheckPermission(22);
                                }

		                $("#data-list-table").html(html);
		                $('#data-list-table table').DataTable( {
					        "fnDrawCallback": function( oSettings ) {
					        	if(vtype=='dispatch'){
					            CheckPermission(4);
					            }
					            if(vtype=='transfer'){
					            CheckPermission(22);	
					            }
					        }
					    } );
					    if(vtype=='transfer'){
					            CheckPermission(22);	
					    }
		                $(".loading").hide();
		            }
		        });
		    }
		    function GetItemList(ID) {
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/dispatch_get_item",
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

					  	 ti = x.rows[lastrow].cells[5].getElementsByTagName('button')[0].tabIndex;

					  	 ti++;
					  	 $("#lessadv").attr("tabindex",ti);
					  	 ti++;
					  	 $("#remark").attr("tabindex",ti);
					  	 ti++;
					  	 $("#newsubmit").attr("tabindex",ti);

		                TolQtyMT();
		                TolQtyBag();
		                TolFreight();
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

					  	 ti = x.rows[lastrow].cells[5].getElementsByTagName('button')[0].tabIndex;

					  	 ti++;
					  	 $("#lessadv").attr("tabindex",ti);
					  	 ti++;
					  	 $("#remark").attr("tabindex",ti);
					  	 ti++;
					  	 $("#newsubmit").attr("tabindex",ti);

		                TolQtyMT();
		                TolQtyBag();
		                TolFreight();
		                $(".loading").hide();
		            }
		        });
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
		      //  var rowCount = $('#TblRpt tbody tr').length;		        
		        if(company_id=='' || company_id==0){
                   alert('Unexpected Error ! Login Again .');
		        }else{ // Valid Company Id
		        	//  if(rowCount>1){
		            	if ($('#userform').validationEngine('validate')) {
		            	modified_by=$.cookie('ae_username');		            
		                var status = $('input[name=status]');
		                var data = $("#userform").serialize();
		                $('.loading').show();
		                $('button').prop('disabled','disabled');
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/transactionController/dispatch_save",
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
		            /* }else{
		             	alert('Please add at least one item !');
		             }*/
		            } // End Check Company
		        });


		    });


		    function GetRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/transactionController/dispatch_get?id=" + ID;
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
		      function TolFreight(){
		      	var sum = 0;
				$(".freight").each(function() {
				    var value = $(this).val();
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				    }
				    $('#tol_freight').val(sum);
				});
				GetBal();
		      }
		      function getItemAutoCompt(q){
		       cat=$('#cat_id').val();
               if(cat>0){
	            $(".item").autocomplete({
	            source: urlstr+"index.php/helperController/get_item2?cat="+cat,
	            minLength: 1,
	            focus: function (event, ui) {
	            $(event.target).val(ui.item.label);
				$(this).closest('tr').find('.item_id').val(ui.item.id);
	            return false;
	            },
	            select: function (event, ui) {
	            $(event.target).val(ui.item.label);
				$(this).closest('tr').find('.item_id').val(ui.item.id);
	            return false;
	        	},
	            });
	         }else{
                alert('Please Select Category !');
                $('#txt_item,#item_id');
                return false;
	         }
	        }
	            function GetQtyBag(param){
	            	cRow=$(param).parent().parent();

	            	qtymt=parseFloat($(cRow).find('#txt_qtymt').val())|| 0;
	            	qtybag=parseFloat($(cRow).find('#txt_qtybag').val())|| 0;
	            	if(isNaN(qtymt) || qtymt=='' || qtymt==0){
	            		$(cRow).find('#txt_qtybag').val('0');
	            	}
	            	tolbag=parseFloat(qtymt)*20;
	            	tolbag=parseFloat(tolbag).toFixed(2);
                    $(cRow).find('#txt_qtybag').val(tolbag);
                    TolQtyMT();
                    TolQtyBag();
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
                  TolFreight();
                });
                $(document).on('dblclick','.edit',function(){
                status=$('#status').val();
                  iname=$(this).closest('tr').find('td:eq(0)').text();
                  icode=$(this).closest('tr').find('td:eq(0) input:hidden').val();
                  qtymt=$(this).closest('tr').find('td:eq(1)').text();
                  qtybag=$(this).closest('tr').find('td:eq(2)').text();
                  rate=$(this).closest('tr').find('td:eq(3)').text();
                  freight=$(this).closest('tr').find('td:eq(4)').text();
                  $('#txt_item').val(iname);
                  $('#item_id').val(icode);
                  $('#txt_qtymt').val(qtymt);
                  $('#txt_qtybag').val(qtybag);
                  $('#txt_rate').val(rate);
                  $('#txt_freight').val(freight);
                  $(this).closest('tr').remove();
                  TolQtyMT();
                  TolQtyBag();
                  TolFreight();
                });
                function ResetItemTable(){
                 $('#TblRpt tbody tr:not(:first)').remove();	
                 $('#txt_item,#item_id,#txt_qtymt,txt_qtybag,#txt_rate,#txt_freight,#tol_qtymt,#tol_qtybag,#tol_freight').val('');
                }
			    	////////////
			  function ItemAddNew(currentRow){
			  	 var x=document.getElementById('TblRptBody');
			  	 var new_row = x.rows[0].cloneNode(true);
			  	 var lastrow=x.rows.length-1;
			  	 var ti=0;

			  	 if(currentRow.parentNode.parentNode.rowIndex-1!=lastrow)
			  	 {
			  	 	return;
			  	 }
			 	 alert(lastrow);
			  	 alert(x.rows[lastrow].innerHTML);
			  	 ti = x.rows[lastrow].cells[5].getElementsByTagName('button')[0].tabIndex;

			  	 item_name = x.rows[lastrow].cells[0].getElementsByTagName('input')[0].value;
			  	 if(item_name=="")
			  	 {
			  	 	alert("Please Enter Item Name");
			  	 	x.rows[lastrow].cells[0].getElementsByTagName('input')[0].focus();
			  	 	return;
			  	 }
			  	 for(i=0;i<new_row.cells.length;i++)
			  	 {
					var inp1 = new_row.cells[i].getElementsByTagName('input')[0];
					if(inp1!=undefined)
					{
							ti++;
						    inp1.value = '';
						    inp1.tabIndex=ti;
					}
					else
					{
						var inp1 = new_row.cells[i].getElementsByTagName('button')[0];
						if(inp1!=undefined)
						{
							ti++;
						    inp1.value = '';
						    inp1.tabIndex=ti;
						}
					}
			  	 }
			  	 ti++;
			  	 $("#lessadv").attr("tabindex",ti);
			  	 ti++;
			  	 $("#remark").attr("tabindex",ti);
			  	 ti++;
			  	 $("#newsubmit").attr("tabindex",ti);
			  	 x.appendChild( new_row );
                TolQtyMT();
                TolQtyBag();
                TolFreight();
		    	MoveTextBoxRefresh('.form-input');

				x.rows[x.rows.length-1].cells[0].getElementsByTagName('input')[0].focus();

			  }
			  /////////////////
			  function deleteRow(row)
				{
			    var i=row.parentNode.parentNode.rowIndex-1;
			    document.getElementById('TblRptBody').deleteRow(i);
			    TolQtyMT();
                TolQtyBag();
                TolFreight();
				}  	
				</script>
