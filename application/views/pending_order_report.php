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
            <h4 class="widget-title">Pending Order</h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform2" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
        <!-- <input type="hidden" name="type" id="type" value="branch" /> -->
        <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Search By</label>

        <div class="col-sm-3">
                <select name="search_by" id="search_by" class="col-xs-10 col-sm-12" tabindex="1">
                  <option value="Party">Party Wise</option>    
                  <option value="Item">Item Wise</option>                
                </select>
        </div>
        <div class="col-sm-3">
          <button tabindex="5" type="button" id="btn_show" class="btn btn-primary" onclick="GetRpt();">Show</button></td>
        </div>
         
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
                    //GetList();
                });
            }
            function GetRpt() {                
                search_by=$('#search_by').val();
                var url="<?php echo base_url();?>index.php/transactionController/pending_order_report";
                data ="search_by="+search_by;
                $(".loading").show();
                $.ajax({
                    url: url,
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                      //alert(html);
                        $("#data-list-table").html(html);
//                        $('#from').select();
                        $(".loading").hide();
                        $('.show').show();
                        $('.hide').remove();
                        $('#search_by').val(search_by);
                       
                    }
                });
            }
            function ShowPrint(){
                search_by=$('#search_by').val();
                window.open($('#baseurl').val()+'index.php/transactionController/pending_order_print/'+search_by,'_blank');
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

              function exportExcel()
              {
                wise =$('#search_by').val();
                $("#TblList").table2excel({
                    // exclude CSS class
                    exclude: ".noExl",
                    name: "Pending Order "+wise+" Wise ",
                    filename:"Pending Order "+wise+" Wise"
                  });    
            //    $('.mytable').tableExport({type:'excel',escape:'false'});
              }


            </script>
