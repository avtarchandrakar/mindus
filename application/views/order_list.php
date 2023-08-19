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
.page-header{display: none;}
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
</style>
<div id="data-form" style="display:none;">
<div class="widget-box" style="min-height:650px;">
<div class="widget-header">
<h4 class="widget-title"><?=$title?></h4>
</div>
<div class="widget-body">
<div class="widget-main">
<form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
<input type="hidden" name="" value="">
<div class="space-4"></div>
<div class="form-group">
<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> From</label>

<div class="col-sm-2">
     <input tabindex="1" type="text" name="from" id="from"   placeholder="From" class="col-xs-10 col-sm-12 udate" list="0" />
</div>
<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> To</label>

<div class="col-sm-2">
	<input tabindex="2" type="text" name="to" id="to"  placeholder="To" class="col-xs-10 col-sm-12 udate" list="0" />
</div>
<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Ledger By</label>
<div class="col-sm-2">
    <select tabindex="3" id="ledger_id" name="ledger_id" class="col-xs-10 col-sm-12">
     <option value="-">ALL</option>
     <? 
     $query=$this->db->query('select id,name from m_ledger where company_id='.get_cookie("ae_company_id"));
     if($query->num_rows()>0){
     foreach($query->result() as $row){
     ?>
     <option value="<?=$row->id?>"><?=$row->name?></option>
     <? } } ?>
    </select>
</div>
<div class="col-sm-2">
	<button  tabindex="4" class="btn btn-info" type="button" id="newsubmit" >
		<i class="ace-icon fa fa-check bigger-110"></i>
		Search
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
        url: "<?php echo base_url();?>index.php/transactionController/order_list_get?vtype=ORDER",
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
    $("#data-list-table input[type='search']").keyup( function (e) {
    e.preventDefault();
    alert('Press !');    
    });
    //if submit button is clicked
    $('#newsubmit').click(function () {
        $("#userform").validate();
        if ($("#userform").valid() == true) {
            var status = $('input[name=status]');
            var data = $("#userform").serialize();
            $('.loading').show();
            $.ajax({
                url: "<?php echo base_url();?>index.php/transactionController/order_list_by_search",
                type: "POST",
                data: data +'&list=list',
                dateType: "html",
                cache: false,
                success: function (html) {
                    $("#data-list-table").html(html);
                    totalamt();
                    $('#itemTbl').DataTable();
            		$(".loading").hide();
            		$('#from').focus();	                        
                }
            });
            return false;

        }
    });


});
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
  LoadEditForm('Order','edit',ID);
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
</script>


