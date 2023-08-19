   <style type="text/css">
   .form-group {
    margin-bottom: 0px;
   }
   .txt_builty{
   	margin-left: 1%;
   	width: 100%;
   }
   </style>
   <input type="hidden" id="permission" value=""/>
   <div id="data-list">
		    <button class="btn btn-xs btn-primary" onclick="ShowForm(); BlankForm();  return false;">
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
        <input type="hidden" value="<?=$status?>" name="status" id="status" class="form-control" />
        <input type="hidden" value="<?=$id?>" name="sno" id="sno" class="form-control" />
        <input type="hidden" value="<?=$vtype?>" name="vtype" id="vtype" class="form-control" />
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> POS</label>

			<div class="col-sm-3">
			    <select name="pos_id" id="pos_id" class="col-xs-10 col-sm-12" tabindex="1">
			    <? foreach($poslist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Date</label>

			<div class="col-sm-3">
				<input tabindex="2" type="text"  name="cdate" id="cdate" data-rule-required="true"  placeholder="Date" class="col-xs-10 col-sm-12" list="0"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> A/c Head</label>

			<div class="col-sm-3">
			    <select tabindex="3" name="achead_id" id="achead_id" class="col-xs-10 col-sm-12">
			    <? foreach($indirect_expenses_list as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
		</div>
		<div class="form-group">
		<table id="itemTbl" class="table table-striped">
			<thead>
			 <tr>
			  <th>Builty No.</th>
			  <th>Party Name</th>
			  <th>Freight Amt.</th>
			  <th>Truck No.</th>
			  <th>Qty(MT)</th>
			  <th>Destination</th>
			  <th>Advance</th>
			  <th>Amount Paid</th>
			 </tr>
			</thead>
			<tbody>
			 <td><input tabindex="4" type="text" id="builtyno" class="txt_builty" /></td>
			 <td><input tabindex="5" type="text" id="subdealername" class="txt_builty"/></td>
			 <td><input tabindex="6" type="text" id="freightamt" class="txt_builty"/></td>
			 <td><input tabindex="7" type="text" id="truckno" class="txt_builty"/></td>
			 <td><input tabindex="8" type="text" id="qtymt" class="txt_builty"/></td>
			 <td><input tabindex="9" type="text" id="destination" class="txt_builty"/></td>
			 <td><input tabindex="10" type="text" id="advamt" class="txt_builty"/></td>
			 <td><input tabindex="11" type="text" id="amtpaid" class="txt_builty"/></td>
			</tbody> 
			<tfoot style="text-align:center;">
			 <tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td class="tolfreight">0.00</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>Total</td>
			  <td class="tolamt">0.00</td>
			 </tr>
			</tfoot>
		</table>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Remark</label>

			<div class="col-sm-3">
             <input tabindex="12" type="text"  name="remark" id="remark" placeholder="Remark" class="col-xs-10 col-sm-12"/>
			</div>
			<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> TDS %</label>

			<div class="col-sm-2">
             <input tabindex="13" type="text"  name="tds" id="tds"  placeholder="TDS" class="col-xs-10"/>
			</div>
			<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Amount</label>

			<div class="col-sm-2">
             <input tabindex="14" type="text"  name="tdsamt" id="tdsamt"  placeholder="Amount" class="col-xs-10 col-sm-12"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Payment Head</label>

			<div class="col-sm-3">
             <select tabindex="15" name="payhead_id" id="payhead_id" class="col-xs-10 col-sm-12">
			    <? foreach($cash_in_hand_list as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
			<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Less</label>

			<div class="col-sm-2">
             <select tabindex="16" name="less_id" id="less_id" class="col-xs-10 col-sm-12">
			    <? foreach($indirect_expenses_list as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
			<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Amount</label>

			<div class="col-sm-2">
             <input tabindex="17" type="text"  name="lessamt" id="lessamt" placeholder="Amount" class="col-xs-10 col-sm-12"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> .</label>

			<div class="col-sm-3">
             &nbsp;
			</div>
			<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Add</label>

			<div class="col-sm-2">
             <select tabindex="18" name="add_id" id="add_id" class="col-xs-10 col-sm-12">
			    <? foreach($indirect_expenses_list as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
			<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Amount</label>

			<div class="col-sm-2">
             <input tabindex="19" type="text"  name="addamt" id="addamt" placeholder="Amount" class="col-xs-10 col-sm-12"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-9 control-label no-padding-right" for="form-field-1"> Net Total</label>

			<div class="col-sm-2">
             <input tabindex="20" type="text"  name="netamt" id="netamt" placeholder="Net Total" class="col-xs-10 col-sm-12" readonly="true" />
			</div>
		</div>

		<div class="space-4"></div>

		<div class="btn_entry">
		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="21" class="btn btn-info" type="button" id="newsubmit" >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Submit
				</button>

				&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
				&nbsp; &nbsp; &nbsp;
		        <button class="btn btn-primary" onclick="PrintRpt(); return false;">
		        <i class="ace-icon fa fa-print bigger-110"></i>
			        Print
		        </button>
			</div>
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
		        $('#userform').find('#act_freight').removeAttr('checked').val('no');
		        $('#userform').find('#appr_freight').removeAttr('checked').val('no');
		        $('#userform').find('#load').removeAttr('checked').val('no');
		        $('#userform').find('#cross').removeAttr('checked').val('no');
		        $('#userform').find('#direct').removeAttr('checked').val('no');
		        $('#userform')[0].reset();
		        $('#created_by').val($.cookie('ae_username'));
		        $('.optional1,.optional2').hide();
		        $('#cdate').val(getCurDate());
		        $('#status').val('add');
		    }
		    function ShowList() {
		        $('#data-form').fadeOut(500, function () {
		            $('#data-list').fadeIn(500);
		            GetList();
		        });
		    }

		    function GetList(ID) {
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/paymentFreight_get_item",
		            type: "POST",
		            data: data+ '&id='+ID,
		            cache: false,
		            success: function (html) {
		                $('#itemTbl tbody').append(html);
		                tolAmt();
		                tolFreight();
		                $(".loading").hide();
		            }
		        });
		    }

		    $(document).ready(function () {
		    	$('#data-list-table table').DataTable( {
					        "fnDrawCallback": function( oSettings ) {
					            CheckPermission(8);
					        }
					    } );
		    	status=$('#status').val();
		    	checkAction(status);
		    	MoveTextBox('.form-input');
		    	$('#cdate').val(getCurDate());
		    	$("#cdate").mask("99-99-9999");
		        $("#data-list").hide();
		        $("#data-form").show();
		        $('#pos_id').focus();
		        //GetList();

		        $('#userform').validate({
		            errorElement: 'div',
		            errorClass: 'help-block',
		            focusInvalid: false,
		            rules: {
		                name: {
		                    required: true,
		                    minlength: 3
		                }
		            },

		            messages: {
		                name: {
		                    required: "Please provide Name.",
		                    minlength: "Name Should be min. 3 characters."
		                }
		            },
		            highlight: function (e) {
		                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
		            },
		            success: function (e) {
		                $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
		                $(e).remove();
		            },
		            errorPlacement: function (error, element) {
		                if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
		                    var controls = element.closest('div[class*="col-"]');
		                    if (controls.find(':checkbox,:radio').length > 1) controls.append(error);
		                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
		                }
		                else if (element.is('.select2')) {
		                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
		                }
		                else if (element.is('.chosen-select')) {
		                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
		                }
		                else error.insertAfter(element.parent());
		            },

		            submitHandler: function (form) {
		            },
		            invalidHandler: function (form) {
		            }
		        });
   				$('#amtpaid').blur(function(){
                  addItem();
   				});
   				$('#advamt').blur(function(){
                advamt=$(this).val();
                amtpaid=$('#freightamt').val()-advamt;
                $('#amtpaid').val(amtpaid);
   				});
   				$('#tds').blur(function(){
                  id=$(this).val();
                  if(id==''){
                  $('#tdsamt').val('0.00');
                  }else{
                  	amt=$('.tolamt').html()*id/100;
                  	$('#tdsamt').val(amt);
                  	tolNetAmt();
                  }
   				});
   				$('#lessamt').blur(function(){
                  id=$(this).val();
                  if(id==''){
                  $('#lessamt').val('0.00');
                  }else{
                  	$('#lessamt').val(id);
                  	tolNetAmt();
                  }
   				});
   				$('#addamt').blur(function(){
                  id=$(this).val();
                  if(id==''){
                  $('#addamt').val('0.00');
                  }else{
                  	$('#addamt').val(id);
                  	tolNetAmt();
                  	netamt=parseFloat(id)+parseFloat($('#netamt').val());
                    $('#netamt').val(netamt);
                  }
   				});
   				$('#builtyno').blur(function(){
   					ID=$(this).val();
   					if(ID==''){
                     //alert('Enter Builty No .');
   					}else{
                    var url = "<?php echo base_url();?>index.php/transactionController/builty_detail_get?id=" + ID;
			        $.get(url, function (data) {
			            var report_obj = JSON.parse(data);
			            if (report_obj.Message == "Success") {
			            	if(report_obj.stop_builty=='NO'){
			                $("#subdealername").val(report_obj.lname);
			                $("#destination").val(report_obj.dname);
			                $("#freightamt").val(report_obj.freightamt);
			                $("#truckno").val(report_obj.truckno);
			                $("#qtymt").val(report_obj.qtymt);
			                $("#advamt").val(report_obj.adv_freight);
			                $("#amtpaid").val(report_obj.freightamt);
			                }else{
			                	clnTxt();
			                	alert('Stop Payment !');
			                }
			            }
			            else {
			                alert("Invalid or To Pay !");
			                clnTxt();
			                $(this).focus();
			            }
			        });
			        } // End If
   				});
		        //if submit button is clicked
		        $('#newsubmit').click(function () {
		            $("#userform").validate();
		            if ($("#userform").valid() == true) {
		                var status = $('input[name=status]');
		                var data = $("#userform").serialize();
		                $('.loading').show();
		                modified_by=$.cookie('ae_username');		            
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/transactionController/paymentFreight_save",
		                    type: "POST",
		                    data: data+'&tolamt='+$('.tolfreight').html()+'&modified_by='+modified_by,
		                    cache: false,
		                    success: function (html) {
		                        $('.loading').hide();
		                        if (html == 1) {
		                            $("html, body").animate({ scrollTop: 0 }, "slow");
		                            if (status.val() == "edit") {
		                                LoadForm('Dispatch List');
		                            }
		                            else {
                                  
		                            }
		                            $('.tolfreight,.tolamt').html('0.00');
		                            $('#userform').find('input:text').val('');
		                            $('#userform').find('input:password').val('');
		                            $("#itemTbl tbody tr:not(:first)").remove();
		                            $('.tolfreight').val('0.00');
		                            $('.tolamt').val('0.00');
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
		     var url = "<?php echo base_url();?>index.php/transactionController/paymentFreight_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $.each(report_obj, function(key, value) {
						    if(key=='Message' || key=='sno' || key=='status'){ //console.log(key, value);
                               //declare manually
						    }else{
						    $("#"+key).val(value);
						    }
						});
						$(".tolamt").html(report_obj.total);
		                $("#sno").val(report_obj.id);
		                $("#status").val("edit");
		                ShowForm();
		                GetList(report_obj.id);
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
		                    url: "<?php echo base_url();?>index.php/helperController/delete/tbl_trans/id",
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
		      function addItem(){
		      	builtyno=$('#builtyno').val();
		      	subdealername=$('#subdealername').val();
		      	freightamt=$('#freightamt').val();
		      	truckno=$('#truckno').val();
		      	qtymt=$('#qtymt').val();
		      	destination=$('#destination').val();
		      	advamt=$('#advamt').val();
		      	amtpaid=$('#amtpaid').val();

		      	$('#itemTbl tbody').append('<tr>'
		      	+'<td>'+builtyno+'<input type="hidden" name="builtyno[]" value="'+builtyno+'" /></td>'
		      	+'<td>'+subdealername+'<input type="hidden" name="sub_dealer_id[]" value="'+subdealername+'" /></td>'
		      	+'<td class="freight">'+freightamt+'<input type="hidden" name="freightamt[]" value="'+freightamt+'" /></td>'
		      	+'<td>'+truckno+'<input type="hidden" name="truckno[]" value="'+truckno+'" /></td>'
		      	+'<td>'+qtymt+'<input type="hidden" name="qtymt[]" value="'+qtymt+'" /></td>'
		      	+'<td>'+destination+'<input type="hidden" name="destination_id[]" value="'+destination+'" /></td>'
		      	+'<td>'+advamt+'<input type="hidden" name="advamt[]" value="'+advamt+'" /></td>'
		      	+'<td class="price">'+amtpaid+'<input type="hidden" name="amtpaid[]" value="'+amtpaid+'" /></td>'
		      	+'</tr>');
		      	tolAmt();
		      	tolFreight();
		      	tolNetAmt();
		      	clnTxt();
		      }
		      function tolAmt(){
		      	var sum = 0;
				// iterate through each td based on class and add the values
				$(".price").each(function() {
				    var value = $(this).text();
				    // add only if the value is number
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				        $('.tolamt').html(sum);
				    }
				});
		      }
		      function tolFreight(){
		      	var sum = 0;
				// iterate through each td based on class and add the values
				$(".freight").each(function() {
				    var value = $(this).text();
				    // add only if the value is number
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				        $('.tolfreight').html(sum);
				    }
				});
		      }
		      function clnTxt(){
		      	$('#builtyno,#subdealername,#freightamt,#truckno,#qtymt,#destination,#advamt,#amtpaid').val('');
		      	$('#builtyno').focus();
		      }
		      function tolNetAmt(){
		      	tolamt=$('.tolamt').html();
		      	$('#netamt').val(tolamt);
		      	tdsamt=$('#tdsamt').val();
		      	lessamt=$('#lessamt').val();
		      	addamt=$('#addamt').val();
		      	if(tdsamt==''){
		      		tdsamt=0;
		      	}else if(lessamt==''){
                    lessamt=0;
		      	}else if(addamt==''){
                    addamt=0;
		      	}
		      	netamt=tolamt-tdsamt-lessamt;
		      	$('#netamt').val(netamt);
		      }
               function PrintRpt(){
               	baseurl=$('#baseurl').val();
                window.open(baseurl+'index.php/transactionController/paymentFreight_last_print','_blank');
               }
               function checkAction(status){
	              if(status=='edit'){
	              	id=$('#sno').val();
	              	GetRecord(id);
	              } 
				}
				</script>
