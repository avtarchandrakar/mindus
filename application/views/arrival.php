   <style type="text/css">
   .form-group {
    margin-bottom: 0px;
   }
   </style>
   <div id="data-list">
   			<input type="hidden" id="permission" value=""/>
		    <button class="btn btn-xs btn-primary " onclick="ShowForm(); BlankForm();  return false;">
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
        <input type="hidden" value="<?=$vtype?>" name="vtype" id="vtype" class="form-control" />
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Date</label>

			<div class="col-sm-3">
				<input tabindex="2" type="text"  name="cdate" id="cdate" data-rule-required="true"  placeholder="Date" class="col-xs-10 col-sm-12 cdate validate[required]" list="0"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Source</label>

			<div class="col-sm-3">
			    <select name="source_id" id="source_id" class="col-xs-10 col-sm-12" tabindex="3">
			    <? foreach($sourcelist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
		</div>
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Item Name</label>

			<div class="col-sm-3">
			    <select name="item_id" id="item_id" class="col-xs-10 col-sm-12" tabindex="4">
			    <? foreach($itemlist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Invoice NO</label>

			<div class="col-sm-3">
			 <input tabindex="5" type="text"  name="invoiceno" id="invoiceno" placeholder="Invoice No" class="col-xs-10 col-sm-12"/>   
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Invoice Date</label>

			<div class="col-sm-3">
			 <input tabindex="6" type="text"  name="invoicedate" id="invoicedate" placeholder="Invoice Date" class="col-xs-10 col-sm-12 cdate" list="0"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> GP NO</label>

			<div class="col-sm-3">
			 <input tabindex="7" type="text"  name="gpno" id="gpno" placeholder="GP No" class="col-xs-10 col-sm-12 validate[required]"/>   
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> GPDate</label>

			<div class="col-sm-3">
			 <input tabindex="8" type="text"  name="gpdate" id="gpdate" data-rule-required="true"  placeholder="GP Date" class="col-xs-10 col-sm-12 cdate" list="0"/>
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Qty (MT)</label>

			<div class="col-sm-3">
				<input tabindex="9" type="text"  name="qtymt" id="qtymt" placeholder="Qty (MT)" class="col-xs-10 col-sm-12 validate[required]"/>
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Shortage</label>

			<div class="col-sm-3">
				<input tabindex="10" type="text"  name="shortage" id="shortage" placeholder="Shortage" class="col-xs-10 col-sm-12"/>
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Damage</label>

			<div class="col-sm-3">
				<input tabindex="11" type="text"  name="damage" id="damage" placeholder="Damage" class="col-xs-10 col-sm-12" value=""/>
			</div>
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Qty (Bag)</label>

			<div class="col-sm-3">
				<input tabindex="12" type="text"  name="qtybag" id="qtybag" placeholder="Qty (Bag)" class="col-xs-10 col-sm-12" readonly="true"/>
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Truck No</label>

			<div class="col-sm-3">
				<input tabindex="13" type="text"  name="truckno" id="truckno" placeholder="Truck" class="col-xs-10 col-sm-12 validate[required,minSize[10],maxSize[10]] "/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Transporter</label>

			<div class="col-sm-3">
			    <select name="transporter_id" id="transporter_id" class="col-xs-10 col-sm-12" tabindex="14">
			    <? foreach($transporterlist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"><input type="checkbox" id="load" name="load" value="no"/> Unloading</label>

			<div class="col-sm-3">
				<input tabindex="15" type="text"  name="l_qty" id="l_qty"  placeholder="Qty (MT)" class="col-xs-10 col-sm-12">
			</div>
			<label class="col-sm-2 control-label no-padding-right optional1" for="form-field-1"> Godown</label>

			<div class="col-sm-3 optional1">
				<select name="l_godown_id" id="l_godown_id" class="col-xs-10 col-sm-12" tabindex="">
			    <option value="0">-</option>
			    <? foreach($godownlist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"><input type="checkbox" id="cross" name="cross" value="no"/> Crossing</label>

			<div class="col-sm-3">
				<input tabindex="16" type="text"  name="c_qty" id="c_qty"  placeholder="Qty(MT)" class="col-xs-10 col-sm-12">
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Truck No</label>

			<div class="col-sm-3">
				<input tabindex="17" type="text"  name="c_truckno" id="c_truckno"  placeholder="Truck No" class="col-xs-10 col-sm-12 validate[required,minSize[10],maxSize[10]]">
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"><input type="checkbox" id="direct" name="direct" value="no"/> Direct</label>

			<div class="col-sm-3">
				<input tabindex="18" type="text"  name="d_qty" id="d_qty"  placeholder="Qty (MT)" class="col-xs-10 col-sm-12">
			</div>
			<label class="col-sm-2 control-label no-padding-right optional2" for="form-field-1"> Party Name</label>

			<div class="col-sm-3">
				<select name="d_ledger_id" id="d_ledger_id" class="col-xs-10 col-sm-12 optional2" tabindex="">
				<option value="0">-</option>
			    <? foreach($partylist as $row){ ?>
			     <option value="<?=$row->id?>"><?=$row->name?></option>
			     <? } ?>
			    </select>
			</div>
		</div>
		<div class="space-4"></div>

		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="19" class="btn btn-info" type="button" id="newsubmit" >
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
				    $("[tabindex='2']").focus();
		        });
		    }
		    function BlankForm() {
		        $('#userform').find('input:text').val('');
		        $('#userform').find('input:password').val('');
		        $('#userform').find('#load').removeAttr('checked').val('no');
		        $('#userform').find('#cross').removeAttr('checked').val('no');
		        $('#userform').find('#direct').removeAttr('checked').val('no');
		        $('#userform')[0].reset(); // RESET DROPDOWN
		        $('.optional1,.optional2').hide();
		        $('.cdate').val(getCurDate());		        
		        $('#created_by').val($.cookie('ae_username'));
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
		            url: "<?php echo base_url();?>index.php/transactionController/arrival_list",
		            type: "GET",
		            data: data+'&vtype='+$('#vtype').val(),
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
		           //      $('#data-list-table table').DataTable( {
					        // "fnDrawCallback": function( oSettings ) {
					            CheckPermission(1);
					    //     }
					    // } );
		                $(".loading").hide();
		            }
		        });
		    }

		    $(document).ready(function () {
		    	MoveTextBox('.form-input');
		    	$('.cdate').val(getCurDate());
		    	$(".cdate").mask("99-99-9999");
		        $("#data-list").show();
		        $("#data-form").hide();
		        GetList();
		        
		        $("#userform").validationEngine();

                $('#qtymt,#shortage,#damage').blur(function(){
                  GetQtyBag();
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

                $('#load,#cross,#direct').click(function(){
                id=$(this).attr('id');
				if($(this).is(':checked')){
				    $(this).val('yes');  // checked
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
		        //if submit button is clicked
		        $('#newsubmit').click(function () {
		        company_id=$.cookie('ae_company_id');
		        if(company_id=='' || company_id==0){
                   alert('Unexpected Error ! Login Again .');
		        }else{ // Valid Company Id
		            	if ($('#userform').validationEngine('validate')) {
		            	modified_by=$.cookie('ae_username');
		                var status = $('input[name=status]');
		                var data = $("#userform").serialize();
		                $('.loading').show();
		                $.ajax({
		                    url: "<?php echo base_url();?>index.php/helperController/insert/tbl_trans/id",
		                    type: "POST",
		                    data: data+'&load='+$('#load').val()+'&cross='+$('#cross').val()+'&direct='+$('#direct').val()+'&modified_by='+modified_by,
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
		                            BlankForm();
		                            $('#cdate').focus();
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
		          } // End Check Company
		        });
		    }); // end document


		    function GetRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/transactionController/trans_get?id=" + ID;
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

						$('.optional1,.optional2').hide();
						if(report_obj.appr_freight=='YES'){
                           $('#appr_freight').prop('checked', 'checked');
						}else{
                           $('#appr_freight').removeAttr('checked');
						}
						if(report_obj.act_freight=='YES'){
							$('#act_freight').prop('checked', 'checked');
						}else{
                            $('#act_freight').removeAttr('checked');  
						}
						if(report_obj.load=='YES'){
							$('#load').prop('checked', 'checked');
							$('.optional1').show();
						}else{
                            $('#load').removeAttr('checked');  
						}
						if(report_obj.cross=='YES'){
							$('#cross').prop('checked', 'checked');
						}else{
                            $('#cross').removeAttr('checked');  
						}
						if(report_obj.direct=='YES'){
							$('#direct').prop('checked', 'checked');
							$('.optional2').show();
						}else{
                            $('#direct').removeAttr('checked');  
						}
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
		      function GetQtyBag(){
		      	qtymt=$('#qtymt').val();
		      	shortage=$('#shortage').val();
		      	damage=$('#damage').val();
		      	qtybag=(qtymt*20)-shortage;
		      	qtybag=qtybag-damage;
		      	$('#qtybag').val(qtybag);
		      }
				</script>
