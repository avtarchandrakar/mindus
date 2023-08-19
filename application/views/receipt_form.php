
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
   	width:100% !important;
   }
   </style>

    <div id="data-form">
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

		        <table style="width:500px;" border=0>
		        	<tr>
		        		<td style="width:120px;text-align:right;padding:5px;">
							<label class="control-label no-padding-right" for="form-field-1"> Entry Date</label>
						</td>
						<td style="width:130px;">
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
						</td>
		        		<td style="width:120px;text-align:right;padding:5px;">
							<label class="control-label no-padding-right" for="form-field-1"> Salesman</label>
						</td>
						<td style="width:220px;">
			                <select name="salesman" id="salesman" class="col-xs-10 col-sm-12" style="width:100%;" tabindex="2">
			                     <option value=" ">Select Salesman</option>
			                     <? $query=$this->db->query('select m_ledger.name from m_ledger,m_ledger_group where m_ledger.group_id=m_ledger_group.id and m_ledger.company_id='.get_cookie('ae_company_id').' and m_ledger_group.name="Salesman" order by m_ledger.name'); ?>           
			                     <? if($query->num_rows()>0){ ?>
			                     <? foreach($query->result() as $row){ ?>  
			                     <option value="<?=$row->name?>"><?=$row->name?></option>
			                     <? } } ?>
			                </select>

						</td>
					</tr>
				</table>
				<br><br>
				<div style="width:1300px;" class="row">
					<div style="float:left;width:750px;">
						<table id="TblRpt" style="width:750px;table-layout:fixed;word-wrap:break-word;">
						 <thead>
						  <tr>
						   <th style="width:200px;">Party Name</th>
						   <th style="width:100px;">Rec.Date</th>
						   <th style="width:80px;">Amount</th>
						   <th style="width:50px;">CD</th>
						   <th style="width:80px;">Mode</th>
						   <th style="width:80px;">Remark</th>
						   <th style="width:100px;">Clear Date</th>
						   <th style="width:100px;">Action</th>
						  </tr>
						 </thead>
						 <tbody id="TblRptBody">
						  <tr>
				           	<td>
				           		<input tabindex="3" type="text" id="lname" class="partyinfo item" onkeyup="GetParty(this);" list="0"/>
							    <input type="hidden" class="ledger_id" name="ledger_id[]" id="ledger_id">
				           	</td>
				           <td><input tabindex="4" type="text" name="vdate[]" id="vdate" onblur="SetDate(this);" class="txt_cls vdate" list="0" /></td>
				           <td><input tabindex="5" type="text" name="tol_freight[]" id="tol_freight" class="tol_freight txt_cls" onblur="TolFreight();return false;"/></td>
				           <td><input tabindex="6" type="text" name="less_adv[]" id="less_adv" class="less_adv txt_cls" onblur="TolFreight();return false;"/></td>
				           <td>
							    <select name="mode_id[]" id="mode_id" class="col-xs-12 col-sm-12" tabindex="7">
							    <? foreach($modelist as $row){ ?>
							     <option value="<?=$row->id?>"><?=$row->name?></option>
							     <? } ?>
							    </select>
				           	</td>
							<td><input tabindex="8" type="text" name="remark[]" id="remark" class="txt_cls"/></td>
				           <td><input tabindex="9" type="text" name="cleardate[]" id="cleardate" class="txt_cls cleardate" list="0" /></td>
				           <td><button tabindex="10" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button tabindex="11" type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>
						  </tr>
						 </tbody>
						 <tfoot>	
						  <tr>
						   <th style="text-align:right;padding-right:5px;">TOTAL :</th>
						   <th><input type="text" id="tol_amount" name="tol_amount" readonly="true" class="txt_cls" /></th>
						   <th>&nbsp;</th>
						   <th>&nbsp;</th>
						  <!--  <th><b></b></th> -->
						   <th>&nbsp;</th>
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

						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button  tabindex="11" class="btn btn-info" type="button" id="newsubmit" >
									<i class="ace-icon fa fa-check bigger-110"></i>
									Submit
								</button>

								&nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									Reset
								</button>
							</div>
						</div>

					</div>
					<div style="float:left;max-width:400px;max-height:400px;overflow:auto;" id="ledger_report">
						sdsdfsdf
					</div>
				</div>

		<div class="loading"></div>

			</form>
	</div>
</div>
</div>

		<script type="text/javascript">
		    function BlankForm() {
		        $('#ledger_report').html("");
		        $('#userform').find('input:text').val('');
		        $('#userform').find('input:password').val('');
		        $('#userform').find('#orderno').val('0');
		        $('#userform')[0].reset();
		         $('#TblRpt tbody tr:not(:first)').remove();
		        $('#TblRpt tbody tr:first').find('input:text').val('');
		        $('#created_by').val($.cookie('ae_username'));
//		        $('.cdate').val(getCurDate());
//		    	$('.cleardate').val(getCurDate());
		    	$(".cleardate").mask("99-99-9999");
		    	$(".vdate").mask("99-99-9999");
		        $('#status').val('add');
		        GetAuto($("#vtype").val());
		    }
		    $(document).ready(function () {
                $('.cdate').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    dateFormat: 'dd-mm-yy'
                });

		    	MoveTextBox('.form-input');
//		    	$('.cdate').val(getCurDate());
		    	$(".cdate").mask("99-99-9999");
                $("#userform").validationEngine();
		        

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
		                    url: "<?php echo base_url();?>index.php/transactionController/receipt_save",
		                    type: "POST",
		                    data: data+'&modified_by='+modified_by,
		                    cache: false,
		                    success: function (html) {
		                    	//alert(html);
		                        $('.loading').hide();
		                        $('button').removeAttr('disabled');
		                        if (html>0) {

		                        	var r = confirm("Do You Want to Print");
									if(r==true)
									{
						                window.open("<?php echo base_url();?>index.php/transactionController/receipt_print/"+html,'_blank');
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
		                                alert('Sorry, unexpected error. Please try again later.');
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

            function GetRpt_Ledger(l_id) {
                data ="l_id="+l_id;
                if(l_id=="" || l_id==0)
                {
                	return;
                }
                $(".loading").show();
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/ledger_report_receipt",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                        $("#ledger_report").html(html);
                        $(".loading").hide();
                    },
                    error:function(html){

                    }
                });
            }


		    function GetPreviousRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/transactionController/receipt_get?id=" + ID;
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
						GetItemList(ID);
		                $("#sno").val(ID);
		                $("#status").val("edit");
		                // CalcAmount();
		            }
		            else {
		                alert("Invalid");
		            }
		        });
		    }

		    function GetItemList(ID) {
		        data = "list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/receipt_get_item",
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

					  		//ti++;
					  	 ti++;
					  	 $("#newsubmit").attr("tabindex",ti);
		    	$(".vdate").mask("99-99-9999");
		                TolFreight();
		                $(".loading").hide();
		            }
		        });
		    }


            function DeleteRecord(ID) {
		        var r = confirm("Do You Want to Delete");
		        if (r == true) {
		            $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/transactionController/receipt_delete",
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

		     $("#txt_qtymt,#txt_rate").change(function(){
		     		CalcAmount(this);
				});


	            function CalcAmount(param){
	            	cRow=$(param).parent().parent();

	            	rate=parseFloat($(cRow).find('#txt_rate').val())|| 0;
	            	qtybag=parseFloat($(cRow).find('#txt_qtymt').val())|| 0;
	            	if(isNaN(rate) || rate=='' || rate==0){
	            		$(cRow).find('#txt_freight').val('0');
	            	}
	            	freight=parseFloat(rate)*parseFloat(qtybag);
                    $(cRow).find('#txt_freight').val(freight);
	           			}

		     // function tolamount(){
	      //      	Tolqty=parseFloat($('#txt_qtymt').val()) || 0.00;
	      //      	Tolrate=parseFloat($('#txt_rate').val()) || 0.00;
	      //      	totalamount=parseFloat(Tolqty)*parseFloat(Tolrate);
	      //      	$('#txt_freight').val(totalamount);
	      //      }

		      function getItemAutoCompt(q){
		       // cat=$('#cat_id').val();
         //       if(cat>0){
	            $(".item").autocomplete({
	            source: urlstr+"index.php/helperController/get_item2",
	            //source: urlstr+"index.php/helperController/get_item2?cat="+cat,
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
	         // }else{
          //       //alert('Please Select Category !');
          //       $('#txt_item,#item_id');
          //       return false;
	         // }
	        }

		      function TolFreight(){
		      	var sum = 0;
				$(".tol_freight").each(function() {
				    var value = $(this).val();
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				    }
				   
				    $('#tol_amount').val(sum);
				});
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
			  	 ti = x.rows[lastrow].cells[7].getElementsByTagName('button')[0].tabIndex;

			  	 party = x.rows[lastrow].cells[0].getElementsByTagName('input')[0].value;
			  	 	if(party=="")
					{
						alert("Please Enter Party Name");
						x.rows[lastrow].cells[0].getElementsByTagName('input')[0].focus();
						return;
					}
			  	 // if(ledger_id=="" || ledger_id==0)
			  	 // {
			  	 // 	alert("Please Select Party");
			  	 // 	x.rows[lastrow].cells[0].getElementsByTagName('select')[0].focus();
			  	 // 	return;
			  	 // }
			  	 mode_id = x.rows[lastrow].cells[4].getElementsByTagName('select')[0].value;
			  	 if(mode_id=="" || mode_id==0)
			  	 {
			  	 	alert("Please Select Mode");
			  	 	x.rows[lastrow].cells[4].getElementsByTagName('select')[0].focus();
			  	 	return;
			  	 }

			  	 amount = x.rows[lastrow].cells[2].getElementsByTagName('input')[0].value;
			  	 if(amount=="" || amount==0)
			  	 {
			  	 	alert("Please Enter Amount");
			  	 	x.rows[lastrow].cells[2].getElementsByTagName('input')[0].focus();
			  	 	return;
			  	 }

			  	 vdate = x.rows[lastrow].cells[1].getElementsByTagName('input')[0].value;
			  	 if(vdate=="")
			  	 {
			  	 	alert("Please Enter Rec. Date");
			  	 	x.rows[lastrow].cells[1].getElementsByTagName('input')[0].value="00-00-0000";
			  	 	return;
			  	 }

			  	 cleardate = x.rows[lastrow].cells[6].getElementsByTagName('input')[0].value;
			  	 if(cleardate=="")
			  	 {
//			  	 	alert("Please Enter Clear Date");
			  	 	x.rows[lastrow].cells[6].getElementsByTagName('input')[0].value="00-00-0000";
//			  	 	return;
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
						var inp1 = new_row.cells[i].getElementsByTagName('select')[0];
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
					if(i==4)
					{
//				    	new_row.cells[i].getElementsByTagName('input')[0].mask("99-99-9999");
//						console.log(inp1.id);
					}
			  	 }
			  	 ti++;
			  	 // $("#lessadv").attr("tabindex",ti);
			  	 $("#newsubmit").attr("tabindex",ti);
			  	 x.appendChild( new_row );
                // tolamount();
		    	$(".cleardate").mask("99-99-9999");
		    	$(".vdate").mask("99-99-9999");
                TolFreight();
		    	MoveTextBoxRefresh('.form-input');

				//x.rows[x.rows.length-1].cells[0].getElementsByTagName('select')[0].focus();
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

			function ShowPrint(id){
                window.open($('#baseurl').val()+'index.php/transactionController/receipt_print/'+id,'_blank');
            }

            function SetDate(id)
            {
				var d = new Date();
				var n = d.getMonth()+1;            	
				var y = d.getFullYear();            	

				var dval=id.value;
				var dday=dval.substring(0,2);
				var dmonth=dval.substr(3,2);
				var dyear=dval.substr(6,4);

				if(dday.includes("_")==true)
				{
					dday="0"+dval.substring(0,1);					
				}
				if(dmonth.includes("__")==true)
				{
					dmonth=n;					
					if(dmonth<10)
					{
						dmonth="0"+dmonth;
					}
				}
				if(dmonth.includes("_")==true)
				{
					dmonth="0"+dval.substr(3,1);
				}
				if(dyear.includes("__")==true)
				{
					dyear=y;					
					if(dyear<99)
					{
						dyear="20"+dyear;
					}
				}
				id.value=dday+'-'+dmonth+'-'+dyear;
            }

	        	function GetParty(q){
					$('.ui-autocomplete').css('fontSize', '16px');
					$('.ui-autocomplete').css('background-color', '#ffcccc');
					// cat=$('#cat_id').val();
					//       if(cat>0){
					$(".partyinfo").autocomplete({
						source: urlstr+"index.php/helperController/get_partyinfo_cmpt",
						//source: urlstr+"index.php/helperController/get_item2?cat="+cat,
						minLength: 1,
						focus: function (event, ui) {
							$(event.target).val(ui.item.label);
							$(this).closest('tr').find('.ledger_id').val(ui.item.id); 
							GetRpt_Ledger(ui.item.id);
							return false;
						},
						select: function (event, ui) {
							$(event.target).val(ui.item.label);
							$(this).closest('tr').find('.ledger_id').val(ui.item.id); 
							GetRpt_Ledger(ui.item.id);
							return false;
						},
					});
					// }else{
					//       //alert('Please Select Category !');
					//       $('#txt_item,#item_id');
					//       return false;
					// }
				} 

				 

</script>
