<?
  $cdate=date('d-m-Y');

?>
    <style type="text/css">
    font{
        margin-left:12px; 
        font-weight: bold;
        font-size: 14px;
    }
    .right{
        text-align: right;
    }
    .modal{
     position: fixed;
     top:10%;
     left:35%;
     width: 900px;
     height: 100%;
     overflow-x: hidden;
     overflow-y: hidden;
    }
    .voucherform{
        overflow: hidden;
    }
    </style>   
    <!-- New Voucher -->
    <div class="modal fade" id="newvoucher">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">New Voucher</h4>
          </div>
          <div class="modal-body">
            <div class="voucherform"></div>

          </div>
          <div class="modal-footer hidden">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Voucher -->
    
    <div id="data-list">
            <!-- <button class="btn btn-xs btn-primary" onclick="ShowForm(); BlankForm();  return false;">
                ADD NEW
            </button> -->
            <br />
            <!-- <div class="loading"></div>
            <div id="data-list-table">
            
            </div> -->
    </div>
    <div id="data-form2" style="display:none;">

        <div class="widget-box">
        <div class="widget-header"> 
            <h4 class="widget-title">RG Report</h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform2" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
        <!-- <input type="hidden" name="type" id="type" value="branch" /> -->
        <div class="form-group">
        <table class="table">
         <tr>
          <td>From</td><td>
          <?php
                    if($p_bdate==1)
                    {
                        echo '<input tabindex="1" type="text"  name="from" id="from" placeholder="From" value="'.$cdate.'" class="cdate dtp col-xs-6 col-sm-6" list="0"/>';                       
                    }
                    else
                    {
                        echo '<input readonly="readonly" tabindex="1" type="text"  name="from" id="from" placeholder="From" value="'.$cdate.'" class="cdate col-xs-6 col-sm-6" list="0"/>';                       
                    }
            ?>

            </td>
          <td>To</td>
          <td>
          <?php
                    if($p_bdate==1)
                    {
                        echo '<input tabindex="2" type="text"  name="to" id="to" placeholder="To" value="'.$cdate.'" class="cdate dtp col-xs-6 col-sm-6" list="0"/>';                       
                    }
                    else
                    {
                        echo '<input readonly="readonly" tabindex="2" type="text"  name="to" id="to" placeholder="To" value="'.$cdate.'" class="cdate col-xs-6 col-sm-6" list="0"/>';                       
                    }
            ?>
            </td>
          <td><button tabindex="4" type="button" id="btn_show" class="btn btn-primary" onclick="GetRpt();">Show</button></td>
          <td>
          <?php if($p_delete==1){ ?>
            <div style="float:right;display:none;" id="del">
                <button class="btn btn-xs btn-primary deleteselected" onclick="DeleteSelected();return false;">
                    Delete
                </button>
            </div>
           <?php }?>
          </td>
         </tr>
        </table>
        </div>
        <div class="stud_detail form-group"></div>

        <div class="space-4"></div>



        <div class="clearfix form-actions hidden">
            <div class="col-md-offset-3 col-md-9">
                <button  tabindex="5" class="btn btn-info" type="button" id="newsubmit" >
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Submit
                </button>

                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset" onclick="BlankForm();">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Reset
                </button>
                &nbsp; &nbsp; &nbsp;
                <button class="btn btn-primary" onclick="ShowList();BlankForm();return false;">
                    LIST
                </button>
            </div>
        </div>
        <div class="loading"></div>

        <div class="hr hr-24"></div>
        </form>
        <div class="loading"></div>
            <?php if($p_list==1){ ?>
            <div id="data-list-table">
            <?php }?>
            
            </div>
    </div>

        <script type="text/javascript">
            function ShowForm() {
                $('#data-list').fadeOut(500, function () {
                    $('#data-form2').fadeIn(500);
//                    $("[tabindex='1']").focus();
                });
            }
            function BlankForm() {
                $("#userform2").find('input:text,input:hidden').val('');
                $("#userform2").find('#status').val('add');
                $("#userform2").find('#type').val('branch');
                $('#userform2').validationEngine('hideAll');
            }
            function ShowList() {
                $('#data-form2').fadeOut(500, function () {
                    $('#data-list').fadeIn(500);
                    GetList();
                });
            }
            function GetRpt() {
                from=$('#from').val();
                to=$('#to').val();
                lname=$('#lname').val();
                data ="from="+from+'&to='+to;
                $(".loading").show();
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/rg_report",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                        $("#data-list-table").html(html);
//                        $('#from').select();
                        $(".loading").hide();
                        $('.show').show();
                        $('.hide').remove();
                        //Set Enter Value
                        $('#from').val(from);
                        $('#to').val(to);
                        $('#lname').val(lname);
//                        $('#from').focus();


                        $("input[type='checkbox'].chk").change(function(){
                            var a = $("input[type='checkbox'].chk");
                            var b = a.filter(":checked").length;
                            if(b == 0){
                                $("#del").hide();
                                $(".deleteselected").html("More D");
                            }
                            else
                            {
                                $("#del").show();
                                $(".deleteselected").html("More D  ("+b+")");
                            }
                        });

                    }
                });
            }
            function ShowPrint(){
                from=$('#from').val();
                to=$('#to').val();
                window.open($('#baseurl').val()+'index.php/transactionController/rg_report_print/'+from+'/'+to,'_blank');
            }
            //M-1 :
                function GetParty(){
                $(".ledgerinfo").autocomplete({
                    source: urlstr +"index.php/helperController/get_partyinfo_cmpt",
                    minLength: 1,
                    focus: function (event, ui) {
                    $(event.target).val(ui.item.label);             
                    $('#party_id').val(ui.item.id);
                    return false;
                    },
                    select: function (event, ui) {
                    $(event.target).val(ui.item.label);
                    $('#party_id').val(ui.item.id);
                    return false;
                    },
                });
             }
            //M-2
      //       function GetLedger(){
      //        $(".partyinfo").autocomplete({
            //         source: urlstr +"index.php/helperController/get_partyinfo_cmpt",
            //         minLength: 1,
            //         focus: function (event, ui) {
            //         $(event.target).val(ui.item.label);              
         //            $('#party_id').val(ui.item.id);
            //         return false;
            //         },
            //         select: function (event, ui) {
            //         $(event.target).val(ui.item.label);
            //         $('#l_id').val(ui.item.id);
            //         return false;
            //      },
            //     });
            // }
            $(document).ready(function () {
                $('.dtp').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    dateFormat: 'dd-mm-yy'
                });

                MoveTextBox('.form-input');
                $("#data-list").hide();
                $("#data-form2").show();
                // GetList();
                GetParty();
//                $('#from').focus();
                $('.cdate').mask("99-99-9999");
                $("#userform2").validationEngine();

            });


            function GetRecord(ID) {
                var url = "<?php echo base_url();?>index.php/siteController/m_get?id=" + ID;
                $.get(url, function (data) {
                    var report_obj = JSON.parse(data);
                    if (report_obj.Message == "Success") {
                        $("#name").val(report_obj.name);
                        $("#type").val(report_obj.type);
                        $("#sortorder").val(report_obj.sortorder);
                        $("#shortname").val(report_obj.shortname);
                        $("#parent_id").val(report_obj.parent_id);
                        $("#sno").val(report_obj.id);
                        $("#status").val("edit");
                        ShowForm();
                    }
                    else {
                        alert("Invalid");
                    }
                });
            }


            function DeleteRecord(vtype,vsno,lid) {
                //alert(vtype+','+vsno+','+lid);
                data='vtype='+vtype+'&vsno='+vsno+'&lid='+lid;
                var r = confirm("Do You Want to Delete");
                if (r == true) {
                    $('.loading').show();
                        $.ajax({
                            url: "<?php echo base_url();?>index.php/staffController/voucher_delete",
                            type: "POST",
                            data: data,
                            cache: false,
                            success: function (html) {
                                $('.loading').hide();
                                if(html==1){
                                    // ShowList();
                                 //    GetList();
                                    GetRpt();
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
              function GetContent(){
              
              }
              function LoadVoucherForm(vtype,jt)
              {
                v1=$(jt).attr('id');
                if(v1=='btn_journal_dr'){
                   jtype='Dr';
                }else if(v1=='btn_journal_cr'){
                   jtype='Cr';
                }else{
                   jtype='Not';
                }
                formname='Voucher Entry Modal';
                data = "formname=" + formname+'&vtype='+vtype+'&lid='+$('#party_id').val()+'&jtype='+jtype;
                $.ajax({
                    url: "<?php echo base_url();?>index.php/master_general/loadform",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                        $(".voucherform").html('').html(html);
                        $("[tabindex='100']").focus();
                    }
                });
                return false;
              }
              function LoadVoucherEditForm(vtype,id,lid)
              {
                formname='Voucher Entry Edit Modal';
                data = "formname=" + formname+'&vtype='+vtype+'&sno='+id;
                $.ajax({
                    url: "<?php echo base_url();?>index.php/master_general/loadform",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                        $('.modal').modal('show');
                        $(".voucherform").html('').html(html);
                        $("[tabindex='100']").focus();
                    }
                });
                return false;
              }
              $(document).keypress(function(e) {
                    console.log('Pressed !');
                    if(e.which == 13) {
                        //alert('You pressed enter!');
                    }
              });


            function DeleteSelected() {
                var myCheckboxes = new Array();
                        $("input:checked").each(function() {
                           myCheckboxes.push($(this).val());
                        });
                data="checkbox="+myCheckboxes;
                $(".loading").show();
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/ledger_deleteselected",
                    type: "POST",
                    data: data,
                    cache: false,
                    success: function (html) {
                        alert("OK");
                        $("#del").hide();
                        $(".deleteselected").html("More D");
                        GetRpt();
                        $(".loading").hide();
                    }
                });
            }

              function exportExcel(){
                $("#TblList").table2excel({
                    // exclude CSS class
                    exclude: ".noExl",
                    name: "Ledger",
                    filename:"Ledger"
                  });    
            //    $('.mytable').tableExport({type:'excel',escape:'false'});
              }

            </script>
