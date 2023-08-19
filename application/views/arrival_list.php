<style>
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
filter: alpha(opacity=80);
opacity: 1;
}
.page-header{ display:none; }
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

<div id="data-form" style="display:none;">

<div class="widget-box" style="min-height:650px;">
<div class="widget-header">
<h4 class="widget-title"><?=$title?></h4>
</div>
<div class="widget-body">
<div class="widget-main">
<form action="#" class="form-horizontal form-input" id="userform" method="post">
<div class="space-4"></div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> From</label>

    <div class="col-sm-3">
         <input tabindex="1" type="text" name="from" id="from"  placeholder="From" class="col-xs-10 col-sm-12 udate" list="0" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> To</label>

    <div class="col-sm-3">
         <input tabindex="2" type="text" name="to" id="to"  placeholder="To" class="col-xs-10 col-sm-12 udate" list="0" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Source Name</label>

    <div class="col-sm-3">
    <select tabindex="3" id="source_id" name="source_id" class="col-xs-9">
     <option value="-">-</option>
     <? foreach($sourcelist as $row){ ?>
     <option value="<?=$row->id?>"><?=$row->name?></option>
     <? } ?>
    </select> 
    <select tabindex="4" id="source_st" name="source_st">
        <option>-</option>
        <option>Not</option>
    </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Item Name</label>

    <div class="col-sm-3">
    <select tabindex="5" id="item_id" name="item_id" class="col-xs-9">
    <option value="-">-</option>
     <? foreach($itemlist as $row){ ?>
     <option value="<?=$row->id?>"><?=$row->name?></option>
     <? } ?>
    </select> 
    <select tabindex="6" id="item_st" name="item_st">
        <option>-</option>
        <option>Not</option>
    </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Transporter Name</label>

    <div class="col-sm-3">
    <select tabindex="7" id="transporter_id" name="transporter_id" class="col-xs-9">
    <option value="-">-</option>
     <? foreach($transporterlist as $row){ ?>
     <option value="<?=$row->id?>"><?=$row->name?></option>
     <? } ?>
    </select> 
    <select tabindex="8" id="transporter_st" name="transporter_st">
        <option>-</option>
        <option>Not</option>
    </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Godown</label>

    <div class="col-sm-3">
    <select tabindex="9" id="godown_id" name="godown_id" class="col-xs-9">
    <option value="-">-</option>
     <? foreach($godownlist as $row){ ?>
     <option value="<?=$row->id?>"><?=$row->name?></option>
     <? } ?>
    </select> 
    <select tabindex="10" id="godown_st" name="godown_st">
        <option>-</option>
        <option>Not</option>
    </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Party Name</label>

    <div class="col-sm-3">
    <select tabindex="11" id="ledger_id" name="ledger_id" class="col-xs-9">
    <option value="-">-</option>
     <? foreach($partylist as $row){ ?>
     <option value="<?=$row->id?>"><?=$row->name?></option>
     <? } ?>
    </select> 
    <select tabindex="12" id="ledger_st" name="ledger_st">
        <option>-</option>
        <option>Not</option>
    </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Truck No</label>

    <div class="col-sm-3">
        <input type="text" tabindex="13" id="truckno" name="truckno" class="col-xs-10" placeholder="Truck No">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Order By</label>

    <div class="col-sm-3">
        <select tabindex="14" id="trucksort" name="trucksort" class="col-xs-10">
         <option>Datewise</option>
        </select>
    </div>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Type</label>

    <div class="col-sm-3">
        <select tabindex="15" id="type" name="type" class="col-xs-10">
         <option>SELF</option>
        </select>
    </div>

</div>
<div class="col-sm-12">
	<button  tabindex="16" class="btn btn-info" type="button" id="btn_print">
		<i class="ace-icon fa fa-print bigger-110"></i>
		Print
	</button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button  tabindex="17" class="btn btn-info" type="button" id="btn_email" data-toggle="modal" data-target="#myModal">
        <i class="ace-icon fa fa-envelope bigger-110"></i>
        E-Mail
    </button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button  tabindex="18" class="btn btn-info" type="submit" id="btn_excel" onclick="exportExcel();">
        <i class="ace-icon fa fa-check bigger-110"></i>
        Excel
    </button>    
</div>
</div>

<div class="hr hr-24"></div>
</form>
<div id="data-list">
<div class="loading"></div>
<div id="data-list-table">
</div>
</div>
</div>

<div id="light" class="white_content"> 
<? //echo $this->load->view('sales_rpt');?>
</div>
<div id="fade" class="black_overlay"></div>
<script type="text/javascript">
function ShowForm() {
    $('#data-list').fadeOut(500, function () {
        $('#data-form').fadeIn(500);
	    $("[tabindex='1']").focus();
    });
}
function BlankForm() {
    $('#userform').find('input:text').val('');
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
        url: "<?php echo base_url();?>index.php/transactionController/paymentFreight_list",
        type: "GET",
        data: data,
        cache: false,
        success: function (html) {
            $("#data-list-table").html(html);
            totalamt();
            $('#itemTbl').DataTable();
            $(".loading").hide();
        }
    });
}
function GetItemList(ID) {
    data = "list=list";
    $(".loading").show();
    $.ajax({
        url: "<?php echo base_url();?>index.php/transactionController/dispacth_get_item",
        type: "POST",
        data: data+ '&id='+ID,
        cache: false,
        success: function (html) {
        	$('#itemTable tbody').html('');
            $('#itemTable tbody').append(html);
            totalamt();
            $(".loading").hide();
        }
    });
}
$(document).ready(function () {
	MoveTextBox('.form-input');
    $("#data-list").show();
    $("#data-form").show();
    $('#from').focus();
    $(".udate").mask("99-99-9999");
    $('.udate').val(getCurDate());
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
    //if submit button is clicked
    $('#btn_print,#btn_mail').click(function () {
        id=$(this).attr('id');
        $('#data-list-table').html('');
        $("#userform").validate();
        urlstr=$('#baseurl').val();
        email=$('#emailid').val();
        if ($("#userform").valid() == true) {
            var status = $('input[name=status]');
            var data = $("#userform").serialize();
            $('.loading').show();
            $.ajax({
                url: "<?php echo base_url();?>index.php/transactionController/arrival_print_preview",
                type: "POST",
                data: data +'&list=list',
                dateType: "html",
                cache: false,
                success: function (html) {
                    if(id=='btn_print'){
                    window.open(urlstr+'PDF/'+html+'.pdf','_blank');
                    }else if(id=='btn_mail'){
                    sendMail(email,html);
                    }
                    $(".loading").hide();
                }
            });
            return false;

        }
    });

}); // End Doc
function print_rpt()
{
    var prtContent = document.getElementById("data-list-table");
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write('<link href="css/print-style.css" type="text/css" rel="stylesheet" media="screen,print">');
    WinPrint.document.write(prtContent.innerHTML);
}
function totalamt(){
	var sum = 0;
	$(".price").each(function() {

	    var value = $(this).text();
	    
	    if(!isNaN(value) && value.length != 0) {
	        sum += parseFloat(value);
	    }
	    $('.total').html(sum.toFixed(2));
	});
}
function GetRecord(ID){
  LoadEditForm('Payment Freight','edit',ID);
}
function GetReport(id){
  baseurl=$('#baseurl').val();
  window.open(baseurl+'index.php/transactionController/paymentFreight_rpt/'+id,'_newtab');
}
function showmodal(){
	$('#light').css('display','block');
}
function hidemodal(){
	$('#light,#fade').css('display','none');
}
function DeleteRecord(ID) {
    var r = confirm("Do You Want to Delete");
    if (r == true) {
        $('.loading').show();
            $.ajax({
                url: "<?php echo base_url();?>index.php/transactionController/t_delete/tbl_trans1/tbl_trans2/id/billno",
                type: "POST",
                data: {ID: ID},
                cache: false,
                success: function (html) {
                    $('.loading').hide();
                    if(html==1){
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
  function DispatchPrint(){
    urlstr=$('#baseurl').val();
    from=$('#from').val();
    to=$('#to').val();
    window.open(urlstr+'index.php/transactionController/dispatch_print_preview','_blank');
  }
  function sendMail(email,html){
   data='email='+email+'&filename='+html+'.pdf';
   $.ajax({
        url: "<?php echo base_url();?>index.php/transactionController/sendMail",
        type: "POST",
        data: data,        
        success: function (html) {
           $('#alert').addClass('alert alert-success').show().html('Successfully send mail !').hide(2000);
           $('#emailid').val('');
        }
    });
    return false;
  }
  function exportExcel(){
   data=$('#userform').serialize(); 
   from=$('#from').val();
   to=$('#to').val();
   $.ajax({
        url: "<?php echo base_url();?>index.php/transactionController/arrival_query",
        type: "POST",
        data: data,
        success: function (html) {
           window.open('<?php echo base_url();?>index.php/transactionController/arrival_excel/'+from+'/'+to+'/'+html,'_blank');
        }
    });
    return false;
  }
</script>


