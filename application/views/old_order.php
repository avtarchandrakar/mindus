
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
            <input id="p_modify" type="hidden" value="<?=$p_modify?>" /> 
            <input id="p_delete" type="hidden" value="<?=$p_delete?>" /> 
            <input id="p_reprint" type="hidden" value="<?=$p_reprint?>" /> 
           <?php if($p_entry==1){ ?>
			<button class="btn btn-xs btn-primary btn_entry" onclick="ShowForm(); BlankForm();  return false;">
			    ADD NEW
		    </button>
		    <?php }?>
		   
        <form action="#" class="form-horizontal form-input" id="userform_search" method="post" role="form">
        <div class="form-group">
        <table class="table">
         <tr>
          <td>From</td><td><input type="text"  name="from" id="from" placeholder="From" class="cdate col-xs-6 col-sm-6" list="0"/></td>
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
    <div id="data-form" style="display:none;">
        <div class="done" style="display:none;">
            <h3>Record Saved.</h3>
        </div>

	    <div class="widget-box">
	    <div class="widget-header">
		    <h4 class="widget-title"><?=$title?></h4>
			<div class="widget-toolbar no-border" style="display:none;">
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
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
        <input type="hidden" value="0" name="previd" id="previd" class="form-control" />
        <input type="hidden" value="0" name="nextid" id="nextid" class="form-control" />
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
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
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">  No.</label>

			<div class="col-sm-3">
				<input tabindex="2" type="text"  name="builtyno" id="builtyno" placeholder="No" class="col-xs-10 col-sm-12 validate[required]"/>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Party Name</label>

			<div class="col-sm-3">
			    <select name="ledger_id" id="ledger_id" class="col-xs-10 col-sm-12 validate[required]" tabindex="3" onchange="GetState(this.value);return false;">
			    <option value="">Select Party Name</option>
			    <? foreach($partylist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> State</label>

			<div class="col-sm-3">
					<input type="text" name="ledger_state" id="ledger_state" class="col-xs-10 col-sm-12" placeholder="State" readonly="readonly" />
			</div>
			
		</div>
		<br>
		<div class="form-group" style="width:650px;">
		<table id="TblRpt" class="table" style="margin-bottom:0px;border:0px;width:540px;">
		 <thead >
		  <tr>
		   <th style="width:320px;border:0px;" class="txt_item">Item Name</th>
		   <th style="width:120px;border:0px;">Qty</th>
		   <!-- <th>Qty(Bags)</th> -->
		  </tr>
		 </thead>
		 <tbody>
		  <tr>
           <td style="border:0px;"><input tabindex="4" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" onblur="GetQtyBag();return false;" list="0"/><input type="hidden" id="item_id" /><input type="hidden" id="order_id"/></td>
           <td style="border:0px;"><input tabindex="5" type="text" id="txt_qtymt" class="txt_cls"/>

           <input  type="hidden" id="txt_rate" class="txt_cls"/>

			<input  type="hidden" id="txt_discountper" class="txt_cls"/>

           <input  type="hidden" id="txt_discountrs" class="txt_cls"/>
       
           <input  type="hidden" id="txt_freight" class="txt_cls" readonly="true" onblur="TolFreight();" />
			</td>           
		  </tr>
		 </tbody>
		</table>

		<table class="table table-bordered" style="border-collapse:unset;width:600px;table-layout:fixed;word-wrap:break-word;" id="items-datatable">
        <thead>
            <tr  style="background-color:#ddd;">
                <th style="width:390px;">
                    Item Name
                </th>
                <th style="width:120px;">
                    Qty
                </th>
                <th style="width:50px;"></th>
            </tr>
        </thead>
        <tbody id="TblRptBody"></tbody>
		 <tfoot>	
		  <tr>
		   <th>&nbsp;</th>
		   <th><input type="text" id="tol_qtymt" name="tol_qtymt" readonly="true" class="txt_cls" />
		   	<input type="hidden" id="tol_qtybag" name="tol_qtybag" readonly="true" class="txt_cls" />
		   <input type="hidden" id="tol_freight" name="tol_freight" readonly="true" class="txt_cls" />
		   </th>
		   <th>&nbsp;</th>
		  </tr>
		 <!--  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th><b>Less Advance</b></th>
		   <th><input tabindex="11" type="text" id="lessadv" name="lessadv"  class="txt_cls validate[custom[number]]" /></th>
		   <th>&nbsp;</th>
		  </tr> -->
		 <!--  <tr>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
		   <th><b>Balance Amount</b></th>
		   <th><input type="text" id="balfreight" name="balfreight" readonly="true" class="txt_cls" /></th>
		   <th>&nbsp;</th>
		  </tr> -->
		 </tfoot>
		</table>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Remark</label>

			<div class="col-sm-4">
				<input type="text" tabindex="15" name="remark" id="remark" placeholder="Remark" class="col-xs-11"/><!-- col-xs-10 col-sm-12 -->
			</div>			
		</div>
		<!-- <div class="space-4"></div> -->

		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="16" class="btn btn-info" type="button" id="newsubmit" >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Submit
				</button>

				&nbsp; &nbsp; &nbsp;
				<button class="btn" type="button" onclick="DeleteRecord(); return false;">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Delete
				</button>
				&nbsp; &nbsp; &nbsp;
		        <button class="btn btn-primary" onclick="ShowList(); return false;">
			        LIST
		        </button>
			</div>
		</div>
		<!-- <div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Created By</label>

			<div class="col-sm-3">
				<input type="text"  name="created_by" id="created_by" placeholder="Created By" class="col-xs-10 col-sm-12" readonly="true" />
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Last Modified By</label>

			<div class="col-sm-3">
				<input type="text"  name="modified_by" id="modified_by" placeholder="Last Modified By" class="col-xs-10 col-sm-12" readonly="true"/>
			</div>
		</div> -->
		<div class="loading"></div>

		<!-- <div class="hr hr-24"></div> -->
		</form>
	</div>

		<script type="text/javascript">
				var otherChargesDataTableOptions = {
				            "sScrollY": '200px',
				            "bPaginate": false,
				            "bScrollCollapse": false,
				            "bLengthChange": false,
				            "bFilter": false,
				            "bSort": false,
				            "bInfo": true,
				            "bAutoWidth": false,
				            "bDestroy": true,
				            "bInfo": false,
				            "createdRow": function (row, data, index) {
				                $('td', row).css({ "padding-top": "5px", "padding-bottom": "5px", "padding-right": "3px", "padding-left": "3px" });
				                $('td', row).eq(1).css("text-align", "left");
				                $('td', row).eq(2).css("text-align", "center");
				            },
						    "columnDefs": [
						      { "width": "300px", "targets": 0 },
						      { "width": "100px", "targets": 1 },
						      { "width": "50px", "targets": 2 }
						    ]

				        };

		        var items_datatable = $("#items-datatable").dataTable(otherChargesDataTableOptions);

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
		        $('#TblRpt tbody tr:first').find('input:hidden').val('');
		         $('#items-datatable').dataTable().fnClearTable();
		        $('#created_by').val($.cookie('ae_username'));
		        $('.cdate').val(getCurDate());
		        $('#status').val('add');
		        GetAuto($("#vtype").val());
		        BlankItemAddNew();
		    }

			  function BlankItemAddNew(){
			  	 var x=document.getElementById('TblRptBody');
				var i1 = x.rows[0].cells[0].getElementsByTagName('input')[0];
				var i2 = x.rows[0].cells[0].getElementsByTagName('input')[1];
				i1.readOnly=false;
				i2.readOnly=false;
			  }
			  /////////////////

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
                from=$('#from').val();
                to=$('#to').val();
                data ="from="+from+'&to='+to;
		        vtype=$('#vtype').val();
		        p_modify=$('#p_modify').val();
		        p_delete=$('#p_delete').val();
		        p_reprint=$('#p_reprint').val();
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/order_list",
		            type: "GET",
		            data: data+'&vtype='+$('#vtype').val(),
		            cache: false,
		            success: function (html) {
		            	 // alert(html);
		                $("#data-list-table").html(html);
		                $('#data-list-table11 table').DataTable( {
					        "fnDrawCallback": function( oSettings ) {
					        	if(vtype=='order'){
					            //CheckPermission(4);
					            }
					            if(vtype=='transfer'){
					            //CheckPermission(22);	
					            }
					        }
					    } );
					    if(vtype=='transfer'){
					            //CheckPermission(22);	
					    }
					    if(p_modify!=1)
					    {
					    	$('.btn_modify').css('visibility','hidden');
					    }
					     if(p_delete!=1)
					    {
					    	$('.btn_delete').css('visibility','hidden');
					    }
					     if(p_reprint!=1)
					    {
					    	$('.btn-print').css('visibility','hidden');
					    }
		                $(".loading").hide();
		            }
		        });
		    }
		    function GetItemList(ID) {
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/order_get_item",
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

					  	 ti = x.rows[lastrow].cells[2].getElementsByTagName('button')[0].tabIndex;

					  	// ti++;
					  	 // $("#lessadv").attr("tabindex",ti);
					  	  ti++;
					  	 $("#truckno").attr("tabindex",ti);
					  	  ti++;
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

					  	 ti = x.rows[lastrow].cells[5].getElementsByTagName('button')[0].tabIndex;

					  	 ti++;
					  	 $("#truckno").attr("tabindex",ti);
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
                $('.cdate').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    dateFormat: 'dd-mm-yy'
                });
					            //CheckPermission(4);
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

			    $('#stop_builty').click(function(){
			    	if($(this).is(':checked'))
			    		{
                          $(this).val('YES');
			    		}else{
                          $(this).val('no');
			    		}
			    });

				$("#txt_qtymt").keydown(function (event) {
				    if (event.which === 13) {
						FinalCalculation();				    	
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
		                    url: "<?php echo base_url();?>index.php/transactionController/order_save",
		                    type: "POST",
		                    data: data,
		                    cache: false,
		                    success: function (html) {
		                        $('.loading').hide();
		                        $('button').removeAttr('disabled');
		                        if(html=="-99")
		                        {
		                        	alert("Credit Limit Crossed");
		                        	return;
		                        }
		                        if (html > 0) {
		                        	//alert(html);
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
		            /* }else{
		             	alert('Please add at least one item !');
		             }*/
		            } // End Check Company
		        });





		    });


		    function GetRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/transactionController/order_get?id=" + ID;
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
		                CalcAmount();
		                ShowForm();
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

		    function GetReport(ID) {
//	            window.open("<?php echo base_url();?>index.php/transactionController/sales_print/"+ID,'_blank');
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

		    function GetRate(param,party_id,item_id) {
		    	addLoading();

            	cRow=$(param).parent().parent();
		        var url = "<?php echo base_url();?>index.php/master_general/party_rate_get?party_id=" + party_id+"&item_id="+item_id;
		        $.get(url, function (data) {
		        	
		            var report_obj = JSON.parse(data);
					$(cRow).find('#txt_rate').val(report_obj.rate);
					
					clearLoading();					
					CalcAmount();					
		        });
		    }



		    function GetDiscount(param,party_id,item_id) {
		    	addLoading();
//            	cRow=$(param).parent().parent();
		        var url = "<?php echo base_url();?>index.php/master_general/party_discount_get?party_id=" + party_id+"&item_id="+item_id;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
					$('#txt_discountrs').val(report_obj.discountrs);
					$('#txt_discountper').val(report_obj.discountper);
					CalcAmount();					
					clearLoading();
					
		        });
		    }


		      

            function DeleteRecord() {
            	ID=$("#sno").val();
		        var r = confirm("Do You Want to Delete");
		        if (r == true) {
		            $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/transactionController/order_delete/"+ID,
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
                $("#data-list").show();
	        	$("#data-form").hide();
	        	GetList();
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
			        	addLoading();
			        	GetRecord($("#nextid").val());
			        	clearLoading();
		        	}
		        	else
		        	{
		        		BlankForm();
		        	}
		        });

		        $('#PrevButton').click(function () {
		        	if($("#previd").val()!="" && $("#previd").val()!="0")
		        	{
			        	addLoading();
			        	GetRecord($("#previd").val());
			        	clearLoading();
		        	}
		        	else
		        	{
		        		BlankForm();
		        	}
		        });

	            function CalcAmount(){
	            	rate=parseFloat($('#txt_rate').val())|| 0;
	            	qtybag=parseFloat($('#txt_qtymt').val())|| 0;
	            	if(isNaN(rate) || rate=='' || rate==0){
	            		$('#txt_freight').val('0');
	            	}
	            	freight=parseFloat(rate)*parseFloat(qtybag);
	            	discount=parseFloat($('#txt_discountper').val())|| 0;
	            	discountrs=parseFloat($('#txt_discountrs').val())|| 0;
	            	tot_disc=parseFloat(discountrs)*parseFloat(qtybag)
	            	var sub = 0;
	            	sub=(parseFloat(freight)- parseFloat(tot_disc).toFixed(2))*parseFloat(discount)/100;
	            	freight=parseFloat(parseFloat(freight)-parseFloat(sub)).toFixed(2) - parseFloat(tot_disc).toFixed(2);

	            	console.log(freight);
                    $('#txt_freight').val(freight);

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
				$(".freight").each(function() {
				    var value = $(this).val();
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				    }
				   
				    $('#tol_freight').val(sum);
				});
				TolQtyMT();
				GetBal();
		      }

		      function getItemAutoCompt(q){
            	//cRow=$(q).parent().parent();
		       // cat=$('#cat_id').val();
         //       if(cat>0){
	            $(".item").autocomplete({
	            source: urlstr+"index.php/helperController/get_item3_date?cdate="+$("#cdate").val(),
	            //source: urlstr+"index.php/helperController/get_item2?cat="+cat,
	            minLength: 1,
	            focus: function (event, ui) {
	            $(event.target).val(ui.item.label);
				$('#item_id').val(ui.item.id);
				$('#txt_rate').val(ui.item.rate);
//				$(this).closest('tr').find('.item_id').val(ui.item.id);
//				$(this).closest('tr').find('#txt_rate').val(ui.item.rate);
	            return false;
	            },
	            select: function (event, ui) {
	            $(event.target).val(ui.item.label);
				$('#item_id').val(ui.item.id);
				$('#txt_rate').val(ui.item.rate);
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
	            function GetQtyBag(){
	            	if($('#item_id').val()=="")
	            	{
	            		return;
	            	}
//	            	cRow=$(param).parent().parent();

	            	qtymt=parseFloat($('#txt_qtymt').val())|| 0;
	            	rate=parseFloat($('#txt_rate').val())|| 0;
	            	GetDiscount(null,$("#ledger_id").val(),$('#item_id').val());

                    TolQtyMT();
					CalcAmount();                   
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
			  	 var new_row = x.rows[0].cloneNode(true);
			  	 var lastrow=x.rows.length-1;
			  	 var ti=0;

			  	 if(currentRow.parentNode.parentNode.rowIndex-1!=lastrow)
			  	 {
			  	 	return;
			  	 }
			  	 // alert(lastrow);
			  	 // alert(x.rows[lastrow].innerHTML);
			  	 ti = x.rows[lastrow].cells[2].getElementsByTagName('button')[0].tabIndex;

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
						    inp1.readOnly=false;
						    if(i==0)
						    {
								var i1 = x.rows[lastrow].cells[0].getElementsByTagName('input')[0];
								var i2 = x.rows[lastrow].cells[0].getElementsByTagName('input')[1];
								i1.readOnly=true;
								i2.readOnly=true;
						    }
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
			  	 // $("#lessadv").attr("tabindex",ti);
			  	 ti++;
			  	 $("#remark").attr("tabindex",ti);
			  	 ti++;
			  	 $("#newsubmit").attr("tabindex",ti);
			  	 x.appendChild( new_row );
                TolQtyMT();
                TolQtyBag();
                // tolamount();
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
                // tolamount();
                TolFreight();
				}  	

				function FinalCalculation()
				{
	            	party_id=$("#ledger_id").val();
	            	item_id=$('#item_id').val();

			    	addLoading();
			        var url = "<?php echo base_url();?>index.php/master_general/party_discount_get?party_id=" + party_id+"&item_id="+item_id;
			        $.get(url, function (data) {
			            var report_obj = JSON.parse(data);
						$('#txt_discountrs').val(report_obj.discountrs);
						$('#txt_discountper').val(report_obj.discountper);
						CalcAmount();					
						clearLoading();
						
						AddItemsToTable();						
			        });
				}

				function AddItemsToTable() {
		            var item_name = $(".item").val();
		            var item_id = $("#item_id").val();
		            var order_id = $("#order_id").val();
		            var qtymt = Number($("#txt_qtymt").val());
		            var rate = Number($("#txt_rate").val());
		            var discountrs = Number($("#txt_discountrs").val());
		            var discountper = Number($("#txt_discountper").val());
		            var freight = Number($("#txt_freight").val());


		            var delete_row_html = "<button tabindex='-1' type='button' class='btn btn-xs btn-danger delete-tr' style='padding:2px;margin:0;'><i class='ace-icon fa fa-trash-o bigger-120' style='padding-right:0;'></i></button>";

		            if (item_id == "" || item_id == "0") {
		                alert("Error : Enter Item Name.");
		                $(".item").focus();
		                return;
		            }
		            else {
		                item_name_html = "<input type='hidden' name='itemcode[]' value='" + item_id + "'/>";
		                item_name_html += "<input type='hidden' name='orderid_gen[]' value='" + order_id + "'/>";
		                item_name_html += item_name;
		            }

		            if (isNaN(qtymt) || qtymt == 0) {
		                alert("Error : Invalid Amount.");
		                $("#txt_qtymt").focus();
		                return;
		            }

		            var qty_html = "<input type='hidden' name='qtymt[]' value='" + qtymt + "' class='qtymt'/>";
		            qty_html += "<input type='hidden' name='rate[]' value='" + rate + "'/>";
		            qty_html += "<input type='hidden' name='discountper[]' value='" + discountper + "'/>";
		            qty_html += "<input type='hidden' name='discountrs[]' value='" + discountrs + "'/>";
		            qty_html += "<input type='hidden' name='freight[]' value='" + freight + "' class='freight'/>";
		            qty_html += qtymt;


		            var tr_index = items_datatable.fnAddData([
		            item_name_html,
		            qty_html,
		            delete_row_html
		            ]);

		            $(".dataTables_scrollFootInner").css("padding-right", 0);

		            $(".delete-tr").unbind("click").click(function () {
		                var target_row = $(this).closest("tr").get(0);
		                var aPos = items_datatable.fnGetPosition(target_row);
		                items_datatable.fnDeleteRow(aPos);
			            TolFreight();
		            });

		            TolFreight();


		            ClnTxt();

		            window.setTimeout(function () {
		                $(".item").focus();
		            }, 100);
		        }

</script>
