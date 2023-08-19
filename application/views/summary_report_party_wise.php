<style>
#data-list-table{
    width: 100%;
    height: 600px;
    overflow-x: scroll;
}

@media print {
#data-list-table{
    width: 100%;
    height: auto;
    overflow: visible;
}
#btn_excel{
    display: none;
}
#btn_pdf{
    display: none;
}

}

.mytable{
    font-size:11px;
}
.mytable thead {
    font-weight:bold;
    text-align:center;
    border:2px solid solid;
}

#btn_pdf{
    display: none;
}

#btn_excel{
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

<div id="data-form" style="display:none;">

<div class="widget-box" style="min-height:650px;">
<div class="widget-header">
<h4 class="widget-title">Summary Report Party Wise</h4>
</div>
<div class="widget-body">
<div class="widget-main">
<form action="#" class="do-not-print form-horizontal form-input" id="userform" method="post">
<div class="space-4"></div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Report On </label>

    <div class="col-sm-3">
    <select tabindex="1" id="report_on" name="report_on" class="col-xs-10 col-sm-12">
     <option value="cdate">Dispatch Date</option>
     <option value="billdate">Bill Date</option>
    </select> 
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> From</label>

    <div class="col-sm-3">
         <input tabindex="2" type="text" name="from" id="from"  placeholder="From" class="col-xs-10 col-sm-12 udate" list="0" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> To</label>

    <div class="col-sm-3">
         <input tabindex="3" type="text" name="to" id="to"  placeholder="To" class="col-xs-10 col-sm-12 udate" list="0" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Item Company</label>

    <div class="col-sm-3">
         <select tabindex="4" name="company_id" id="company_id" class="col-xs-10 col-sm-12" >
          <option value="%">All</option>
          <? $query=$this->db->query('select id,name from m_master where type="Item Company" '); ?>
          <? if($query->num_rows()>0){ ?>
          <? foreach($query->result() as $row){ ?>
          <option value="<?=$row->id?>"><?=$row->name?></option>
          <? }} ?>
         </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Category</label>

    <div class="col-sm-3">
         <select tabindex="5" name="cat_id" id="cat_id" class="col-xs-10 col-sm-12" >
          <option value="%">All</option>
          <? $query=$this->db->query('select id,name from m_master where type="Item Group" and company_id='.get_cookie('ae_company_id')); ?>
          <? if($query->num_rows()>0){ ?>
          <? foreach($query->result() as $row){ ?>
          <option value="<?=$row->id?>"><?=$row->name?></option>
          <? }} ?>
         </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Party Name</label>

    <div class="col-sm-3">
         <select tabindex="6" name="ledger_id" id="ledger_id" class="col-xs-10 col-sm-12" >
          <option value="%">All</option>
          <? $query=$this->db->query('select l.*, g.name as group_name from m_ledger as l left outer join m_ledger_group as g on (l.group_id=g.id) where company_id=' . get_cookie("ae_company_id") .' order by l.name'); ?>
          <? if($query->num_rows()>0){ ?>
          <? foreach($query->result() as $row){ ?>
          <option value="<?=$row->id?>"><?=$row->name?></option>
          <? }} ?>
         </select>
    </div>
</div>

<div class="col-sm-12">
	<button  tabindex="7" class="btn btn-info" type="button" id="btn_show" style="margin-left:22%;">
		<i class="ace-icon fa fa-eye bigger-110"></i>
		Show
	</button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button  tabindex="8" class="btn btn-info" type="submit" id="btn_print" onclick="window.print();">
        <i class="ace-icon fa fa-check bigger-110"></i>
        Print
    </button>    
</div>
</div>

<div class="hr hr-24"></div>
</form>
<div id="data-list">
<button class="btn btn-success do-not-print" type="button" id="btn_excel" onclick="exportExcel();">
        <i class="ace-icon fa fa-file-excel-o bigger-110"></i>
        Excel
</button>
<button class="btn btn-success" type="button" id="btn_pdf" onclick="exportPdf();">
        <i class="ace-icon fa fa-file-pdf-o bigger-110"></i>
        PDF
</button>
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
    $('#from').val('01-05-2015');
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
    $('#btn_show').click(function () {
        $('#btn_excel').hide();
        $('#btn_pdf').hide();
        sp=$.cookie("ae_sp_status", 1);
        // alert(sp);
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
                url: "<?php echo base_url();?>index.php/transactionController/summary_report_party_wise",
                type: "POST",
                data: data +'&list=list',
                dateType: "html",
                cache: false,
                success: function (html) {
                    $('html, body').animate({
                            scrollTop: $("#data-list-table").offset().top
                        }, 2000);

                    $('#data-list-table').html('').html(html);
                    var sum = 0;
                    var i=0;
                    cnt=$('#data-list-table table tbody tr:first td').length;
                    tfoot='<td>Total</td>';
                    for(i=2;i<cnt+1;i++){
                        sum=0;
                         $('#data-list-table tbody tr td:nth-child('+ i +')').each(function(){
                            var value = $(this).text();
                            // add only if the value is number
                            if(!isNaN(value) && value.length != 0) {
                                sum += parseFloat(value);
                            }
                        });
                     tfoot=tfoot+'<td>'+ sum +'</td>';
                    }

                    $('#data-list-table table tbody').append('<tr>'+tfoot+'</tr>');

                    $('#data-list-table table tr').append('<td>new</td>')
                    $('#data-list-table table thead tr:first td:last').html("TOTAL");

                    $('#data-list-table table thead tr:first').css("background-color","#D8D8D8");

                    var sum = 0;
                    var i=0;
                    var j=0;
                    cntrow=$('#data-list-table table tbody tr').length;
                    for(i=1;i<cntrow+1;i++){
                        sum=0;
                        j=0;
                        cnt=$('#data-list-table table tbody tr:nth-child('+i+') td').length;
                        for(j=2;j<cnt;j++)
                        {
                             $('#data-list-table tbody tr:nth-child('+i+') td:nth-child('+ j +')').each(function(){
                                var value = $(this).text();
                                // add only if the value is number
                                if(!isNaN(value) && value.length != 0) {
                                    sum += parseFloat(value);
                                }
                            });
                        }
                        $('#data-list-table table tbody tr:nth-child('+i+') td:last').html(sum);

                        $('#data-list-table table tbody tr:last').css("background-color","#D8D8D8");

                    }

                    $(".loading").hide();
                    $('#btn_excel').show();
                    $('#btn_pdf').show();
                    $.removeCookie("ae_sp_status");
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
    $(".mytable").table2excel({
        // exclude CSS class
        exclude: ".noExl",
        name: "Summary_Report_Party_Wise",
        filename:"Summary_Report_Party_Wise"
      });    
  }


  function exportPdf(){
    var doc = new jsPDF('p', 'pt','a4',true);
    var elem = document.getElementById("mytable");
    var res = doc.autoTableHtmlToJson(elem);
    console.log(res);
    doc.autoTable(res.columns, res.data, {
        startY: 60,
        styles: {
          overflow: 'linebreak',
          fontSize: 6,
          rowHeight: 18,
          columnWidth: 'wrap'
        },
        columnStyles: {
          0: {columnWidth: 'auto'}
        }
      });
    doc.save('table.pdf');

  }
</script>


