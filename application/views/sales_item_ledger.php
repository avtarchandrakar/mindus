<?
  $cdate=date('d-m-Y');
  $query=$this->db->query("select max(cdate) as cdate from tbl_trans1 where company_id=".get_cookie("ae_company_id"));
  $result=$query->result();
  if($query->num_rows()>0)
  {
    foreach($result as $row)
    {
      $cdate = date('d-m-Y',strtotime($row->cdate));
    }
  }


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
    .voucherform{
        overflow: hidden;
    }
    </style>   

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




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
            <h4 class="widget-title">Sales Item Ledger</h4>
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
          <td style="width:60px;">From</td><td  style="width:250px;"><input tabindex="1" type="text"  name="from" id="from" placeholder="From" value="<?echo $cdate;?>" class="cdate col-xs-6 col-sm-6" list="0"/></td>
          <td  style="width:60px;">To</td><td style="width:250px;"><input tabindex="2" type="text"  name="to" id="to" placeholder="To" value="<?echo $cdate;?>" class="cdate col-xs-6 col-sm-6" list="0"/></td>
          <td style="width:100px;">Item Group</td>
          <td style="width:250px;">
                <?php
                    $query=$this->db->query("select id,name from m_master where type='Item Group' and company_id=". get_cookie('ae_company_id') ." order by name");
                    echo "<select id='group_id' name='group_id' tabindex='2' class='col-xs-10 col-sm-12' data-placeholder='Select Group Name...''>";
                    foreach($query->result() as $row)
                    {
                        echo "<option value=" . $row->id . "> " . $row->name . "</option>";
                    }
                    echo "</select>";
                ?>
          </td>
          <td style="width:100px;">Party Name</td>
          <td style="width:250px;">
                <select name="ledger_id" id="ledger_id" class="col-xs-10 col-sm-12" tabindex="4">
                <option value="0">ALL</option>
                <? foreach($partylist as $row){ ?>
                 <option value="<?=$row->id?>"><?=$row->name?></option>
                 <? } ?>
                </select>
          </td>
          <td><button tabindex="5" type="button" id="btn_show" class="btn btn-primary" onclick="GetRpt();">Show</button></td>
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
        <!-- <div class="loading"></div> -->
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
                ledger_id=$('#ledger_id').val();
                group_id=$('#group_id').val();
                data ="from="+from+"&to="+to+"&ledger_id="+ledger_id+"&group_id="+group_id;
                $(".loading").show();
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/sales_item_ledger",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                        $("#data-list-table").html(html);
//                        $('#from').select();
                        $(".loading").hide();
                        $('.show').show();
                        $('.hide').remove();
                        $('#from').val(from);
                        $('#to').val(to);
//                        $('#from').focus();
                    }
                });
            }
            function ShowPrint(){
                from=$('#from').val();
                to=$('#to').val();
                ledger_id=$('#ledger_id').val();
                window.open($('#baseurl').val()+'index.php/transactionController/sale_group_wise_print/'+from+'/'+to+'/'+ledger_id,'_blank');
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
                $('.cdate').datepicker({
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

              function exportExcel(){
                $("#TblList").table2excel({
                    // exclude CSS class
                    exclude: ".noExl",
                    name: "Sales Group Wise",
                    filename:"Sales Group Wise"
                  });    
            //    $('.mytable').tableExport({type:'excel',escape:'false'});
              }

            function GetRecord(vtype,ID) {
                $('#modal_form').modal('show');
                if(vtype.toUpperCase()=="SALES")
                {
                    scroll = $(window).scrollTop();
                    $.ajax({
                        url: "<?php echo base_url();?>index.php/formController/sales_form",
                        type: "GET",
                        cache: false,
                        success: function (html) {
                            $(".modal-body").html(html);
                            MoveTextBox('.form-input');
                            GetPreviousRecord(ID);
    //                      $('.cdate').val(getCurDate());
                            $(".cdate").mask("99-99-9999");
                            $(".loading").hide();
                            $(window).scrollTop(scroll);

                        }
                    });             
                }
                if(vtype.toUpperCase()=="RECEIPT")
                {
                    scroll = $(window).scrollTop();
                    $.ajax({
                        url: "<?php echo base_url();?>index.php/formController/receipt_form",
                        type: "GET",
                        cache: false,
                        success: function (html) {
                            $(".modal-body").html(html);
                            MoveTextBox('.form-input');
                            GetPreviousRecord(ID);
    //                      $('.cdate').val(getCurDate());
                            $(".cdate").mask("99-99-9999");
                            $(".loading").hide();
                            $(window).scrollTop(scroll);
                        }
                    });             
                }
                if(vtype.toUpperCase()=="RGSALE")
                {
                    scroll = $(window).scrollTop();
                    $.ajax({
                        url: "<?php echo base_url();?>index.php/formController/sales_return_form",
                        type: "GET",
                        cache: false,
                        success: function (html) {
                            $(".modal-body").html(html);
                            MoveTextBox('.form-input');
                            GetPreviousRecord(ID);
    //                      $('.cdate').val(getCurDate());
                            $(".cdate").mask("99-99-9999");
                            $(".loading").hide();
                            $(window).scrollTop(scroll);

                        }
                    });             
                }
            }

//////////////////////

            </script>
