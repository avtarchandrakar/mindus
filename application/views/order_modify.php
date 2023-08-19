<?php
	//List :
	// 	Function : transactionController/order_modify_list

	//Save :
	// 	Function : transactionController/getsingleorderdetail?id=

?>
    <style type="text/css">
    	.flash{
    		background-color:#ffcccc;
    	}
    	.hidecol
    	{
    		display: none;
    	}

	.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:10019;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(optionpacity=80);
	opacity: 1;
	}
	.white_content {
	display: none;
	position: absolute;
	top: 0%;
	left: 10%;
	width: 80%;
	height: 90%;
	padding: 4px;
	background-color: white;
	z-index:10029333;
	overflow: auto;
	-webkit-box-shadow: 0 0 10px #000;
	box-shadow: 0 0 10px #000;
	}
	#myModal{width: 100%;left:0%;right:0%;top:30%;}
	</style>

<!-- Order Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" style="width:700px;">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">ORDER MODIFY</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" id="v_id" value="">
					<div class="box-content nopadding vehicle-content" style="text-align:center;">
						<div class="placer-detail">
		                    <h2>Order Details</h2>
		                    <center>
		                    <table style="width:500px;">
		                      <tr>
		                        <td style="font-weight:bold;width:200px;">Order ID</td>
		                        <td id="v_orderid"></td>
		                      </tr>
		                      <tr>
		                        <td style="font-weight:bold;">User</td>
		                        <td id="v_user"></td>
		                      </tr>
		                      <tr>
		                        <td style="font-weight:bold;">Order Date</td>
		                        <td id="v_orderdate"></td>
		                      </tr>
		                      <tr>
		                        <td style="font-weight:bold;">Party Name</td>
		                        <td id="v_partyname"></td>
		                      </tr>
		                      <tr>
		                        <td style="font-weight:bold;">Godown</td>
		                        <td id="v_godown"></td>
		                      </tr>
		                      <tr>
		                        <td style="font-weight:bold;">Item Name</td>
		                        <td id="v_itemname"></td>
		                      </tr>
		                      <tr>
		                        <td style="font-weight:bold;">Order Qty. (MT)</td>
		                        <td><input type="text" name="v_qty" id="v_qty"></td>
		                      </tr>
		                    </table>
						</div>
		                  <br>

		                <div class="controls">                
					        <button type="button" class="btn btn-primary" id="btn_order_modify">SAVE</button>
		                 </div>
					</div>
				</div>
		</div>
	</div>
</div>
</div>
              <!-- Order Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Email</h4>
      </div>
      <div class="modal-body">
        <p id="alert"></p>
        <lable class="col-sm-3 control-label no-padding-right">Enter Email ID</lable><input type="text" id="emailid" name="emailid" class="col-xs-8"/>
        <br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_mail">Send Mail</button>
      </div>
    </div>
  </div>
</div>

    <div id="data-list">
		<form action="#" class="form-horizontal form-input" id="showform" method="post" role="form">

		<div class="space-4"></div>
		<div class="form-group">
			<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Godown</label>
			<div class="col-sm-2">
			    <select id="godown" name="godown" class="col-xs-10 col-sm-12">
			     <option value="-">ALL</option>
			     <? 
			     $query=$this->db->query('select name from m_master where company_id='.get_cookie("ae_company_id") . ' and type="source"');
			     if($query->num_rows()>0){
			     foreach($query->result() as $row){
			     ?>
			     <option value="<?=$row->name?>"><?=$row->name?></option>
			     <? } } ?>
			    </select>
			</div>
			<label class="col-sm-1 control-label no-padding-right" for="form-field-1">Company</label>
			<div class="col-sm-2">
			    <select id="company" name="company" class="col-xs-10 col-sm-12">
			     <option value="-">ALL</option>
			     <? 
			     $query=$this->db->query('select name from m_master where company_id='.get_cookie("ae_company_id") . ' and type="Item Company"');
			     if($query->num_rows()>0){
			     foreach($query->result() as $row){
			     ?>
			     <option value="<?=$row->name?>"><?=$row->name?></option>
			     <? } } ?>
			    </select>
			</div>
			<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> UserName</label>
			<div class="col-sm-2">
			    <select id="username" name="username" class="col-xs-10 col-sm-12">
			     <option value="-">ALL</option>
			     <? 
			     $query=$this->db->query('select username as name from m_user order by username');
			     if($query->num_rows()>0){
			     foreach($query->result() as $row){
			     ?>
			     <option value="<?=$row->name?>"><?=$row->name?></option>
			     <? } } ?>
			    </select>
			</div>

			<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Item Name</label>
			<div class="col-sm-2">
			    <select id="itemname" name="itemname" class="col-xs-10 col-sm-12">
			     <option value="-">ALL</option>
			     <? 
			     $query=$this->db->query('select name from m_item where company_id='.get_cookie("ae_company_id") . ' order by name');
			     if($query->num_rows()>0){
			     foreach($query->result() as $row){
			     ?>
			     <option value="<?=$row->name?>"><?=$row->name?></option>
			     <? } } ?>
			    </select>
			</div>

			<div class="col-sm-12" style="margin-top:20px;">
				<center>
				<button  tabindex="4" class="btn btn-info" type="button" id="newsubmit" onclick='GetList();return false;' >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Show
				</button>
			</center>
			</div>
		</div>
		</form>


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
		    <h4 class="widget-title">Order List</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="uname" id="uname" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Name</label>

			<div class="col-sm-3">
				<input tabindex="1" type="text"  name="name" id="name" data-rule-required="true"  placeholder="Name" class="col-xs-10 col-sm-12" />
			</div>
		</div>

		<div class="space-4"></div>

		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button  tabindex="2" class="btn btn-info" type="button" id="newsubmit" >
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
		        $('#userform').find('input:hidden').val('');
		        $('#userform').find('input:password').val('');
		        $('#status').val('add');
		    }
		    function ShowList() {
		        $('#data-form').fadeOut(500, function () {
		            $('#data-list').fadeIn(500);
		            GetList();
		        });
		    }


		    function GetList() {

		        data = $("#showform").serialize();
		        data=data+"&list=list";
		        $(".loading").show();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/order_modify_list",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $("#data-list-table").html(html);
		                $(".loading").hide();
//						StartTime();						
					}
		        });
		    }


		    function StartTime()
		    {
				myVar = setInterval(function(){ GetUpdated() }, 10000);
		    }
		    function StopTime()
		    {
		    	clearInterval(myVar);
		    	myVar=null;
		    }
		    function GetUpdated(){
		    	StopTime();
		        data = "timestamp="+$('#TblList tr:first-child td:last-child').html();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/transactionController/take_order_update",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		            	if(html!="")
		            	{
							$("#TblList tbody").prepend(html);		            
							$("#lasttime").val=$("#lasttime1").val();
							setTimeout(function(){
	            				$('tr').removeClass('flash');
	            				StartTime();
	        				},20000);						
		            	}
		            	else{
            				StartTime();
		            	}
					}
		        });

		    }
		    $(document).ready(function () {
		    	MoveTextBox('.form-input');
		        $("#data-list").show();
		        $("#data-form").hide();
		        GetList();

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



    				///////////////////////////
			    $('#btn_mail').click(function () {
			        urlstr=$('#baseurl').val();
			        email=$('#emailid').val();
			        data = $("#showform").serialize();
			        data=data+"&email=" + email;
		            $('.loading').show();
		            $.ajax({
			            url: "<?php echo base_url();?>index.php/transactionController/order_mail",
		                type: "POST",
		                data: data,
		                dataType: "html",
		                cache: false,
		                success: function (html) {
		                	alert("Mail Sent");
		                    $(".loading").hide();
		                	$('#myModal').modal('hide');
		                }
		            });
		            return false;
			    });
    				///////////////////////////

    			//////////////////
    			$("#btn_order_modify").click(function(){
			        v_id=$('#v_id').val();
			        v_qty=$('#v_qty').val();
		            var data = "id=" + v_id+"&qty="+v_qty;
		            $('.loading').show();
		            $.ajax({
			            url: "<?php echo base_url();?>index.php/transactionController/order_modify_save",
		                type: "POST",
		                data: data,
		                dataType: "html",
		                cache: false,
		                success: function (html) {
			                $("#data-list-table").html("");
		                	$('#orderModal').modal('hide');
		                	GetList();
		                }
		            });
		            return false;
    			});

		    });


		    function GetRecord(ID) {
		        var url = "<?php echo base_url();?>index.php/master_general/godown_get?id=" + ID;
		        $.get(url, function (data) {
		            var report_obj = JSON.parse(data);
		            if (report_obj.Message == "Success") {
		                $("#name").val(report_obj.name);
		                $("#uname").val(report_obj.name);
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
		                    url: "<?php echo base_url();?>index.php/helperController/delete/m_master/id",
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

		    function OrderModify(id)
		    {
		         $.ajax({
		                url: "<?php echo base_url();?>index.php/transactionController/getsingleorderdetail?id="+id,
		                type: "GET",
		                cache: false,
		                success: function (html) {
		                  var report_obj = JSON.parse(html);
		                  if (report_obj.Message == "Success") {
		                    $("#v_orderid").html(report_obj.orderid);
		                    $("#v_user").html(report_obj.name);
		                    $("#v_orderdate").html(report_obj.date);
		                    $("#v_partyname").html(report_obj.partyname);
		                    $("#v_godown").html(report_obj.godown);
		                    $("#v_itemname").html(report_obj.itemname);
		                    $("#v_qty").val(report_obj.qty);
		                    $("#v_id").val(report_obj.id);
		                  }
		                  $("#orderModal").modal("show");
		                },
		                error: function(){
		                  $("#orderModal").modal("hide");
		                }
		            });
		    }

			  function exportExcel(){
			    $("#TblList").table2excel({
			        // exclude CSS class
			        exclude: ".noExl",
			        name: "Dispatch List",
			        filename:"Dispatch List"
			      });    
			//    $('.mytable').tableExport({type:'excel',escape:'false'});
			  }

			  function exportPDF(){
				$('#TblList').tableExport({type:'pdf',pdfFontSize:'4',escape:'false',ignoreColumn: [10,11]});
			  }

				</script>
