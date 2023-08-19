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
            <h4 class="widget-title">Amount Difference</h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">

        <form action="#" class="form-horizontal form-input" id="userform2" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
        <!-- <input type="hidden" name="type" id="type" value="branch" /> -->
        <?
            $sql = "SELECT t1.vtype,t1.cdate,l.name as ledgername,t1.builtyno,t2.id,t2.billno,t2.itemcode,i.name,t2.qtymt,t2.rate,t2.discount,t2.percent,round(t2.freight,2) as freight,round((t2.qtymt*(t2.rate-t2.discount))-((t2.qtymt*(t2.rate-t2.discount))*t2.percent/100),2) as diff FROM tbl_trans2 t2, tbl_trans1 t1,m_ledger l,m_item i where t1.id=t2.billno and t1.cdate>='2017-03-01' and t1.ledger_id=l.id and t2.itemcode=i.id and t2.freight<>(t2.qtymt*(t2.rate-t2.discount))-((t2.qtymt*(t2.rate-t2.discount))*t2.percent/100)  and t1.vtype='sales' order by t1.cdate,t2.id";
            $query=$this->db->query($sql);
            $result=$query->result();
            if($query->num_rows()>0)
            {
                  echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
                  echo '    <thead>';
                  echo '        <tr>';
                  echo '            <th>Date</th>';
                  echo '            <th>No</th>';
                  echo '            <th>PartyName</th>';
                  echo '            <th>Item Name</th>';
                  echo '            <th>Qty</th>';
                  echo '            <th>Rate</th>';
                  echo '            <th>Disc.</th>';
                  echo '            <th>%</th>';
                  echo '            <th>Amount 1</th>';
                  echo '            <th>Amount 2</th>';
                  echo '            <th>Difference</th>';
                  echo '            <th>Type</th>';
                  echo '        </tr>';
                  echo '    </thead>';
                  echo '    <tbody>';
                foreach($result as $row)
                {
                    $diff=number_format($row->freight-$row->diff,2,".","");

                    if($diff>5)
                    {
                        echo '<tr class="">';
                        echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                        echo '    <td>' . $row->builtyno . '</td>';
                        echo '    <td>' . $row->ledgername . '</td>';
                        echo '    <td>' . $row->name . '</td>';
                        echo '    <td>' . $row->qtymt . '</td>';
                        echo '    <td>' . $row->rate . '</td>';
                        echo '    <td>' . $row->discount . '</td>';
                        echo '    <td>' . $row->percent . '</td>';
                        echo '    <td>' . $row->freight . '</td>';
                        echo '    <td>' . $row->diff . '</td>';
                        echo '    <td>' . $diff . '</td>';
                        echo '    <td>' . $row->vtype . '</td>';
                        echo '</tr>';

                    }
                    if($diff<-5)
                    {
                        echo '<tr class="">';
                        echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                        echo '    <td>' . $row->builtyno . '</td>';
                        echo '    <td>' . $row->ledgername . '</td>';
                        echo '    <td>' . $row->name . '</td>';
                        echo '    <td>' . $row->qtymt . '</td>';
                        echo '    <td>' . $row->rate . '</td>';
                        echo '    <td>' . $row->discount . '</td>';
                        echo '    <td>' . $row->percent . '</td>';
                        echo '    <td>' . $row->freight . '</td>';
                        echo '    <td>' . $row->diff . '</td>';
                        echo '    <td>' . $diff . '</td>';
                        echo '    <td>' . $row->vtype . '</td>';
                        echo '</tr>';

                    }
                }
            }
            else
            {
                echo "No Data";
            }


            $sql = "SELECT t1.vtype,t1.cdate,l.name as ledgername,t1.builtyno,t2.id,t2.billno,t2.itemcode,i.name,t2.qtymt,t2.rate,t2.discount,t2.percent,round(t2.freight,2) as freight,round((t2.qtymt*(t2.rate-t2.discount))-((t2.qtymt*(t2.rate-t2.discount))*t2.percent/100),2) as diff FROM tbl_trans2 t2, tbl_trans1 t1,m_ledger l,m_item i where t1.id=t2.billno and t1.cdate>='2017-03-01' and t1.ledger_id=l.id and t2.itemcode=i.id and t2.freight<>(t2.qtymt*(t2.rate-t2.discount))-((t2.qtymt*(t2.rate-t2.discount))*t2.percent/100) and t1.vtype='sales return' order by t1.cdate,t2.id";
            $query=$this->db->query($sql);
            $result=$query->result();
            if($query->num_rows()>0)
            {
                  echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
                  echo '    <thead>';
                  echo '        <tr>';
                  echo '            <th>Date</th>';
                  echo '            <th>No</th>';
                  echo '            <th>PartyName</th>';
                  echo '            <th>Item Name</th>';
                  echo '            <th>Qty</th>';
                  echo '            <th>Rate</th>';
                  echo '            <th>Disc.</th>';
                  echo '            <th>%</th>';
                  echo '            <th>Amount 1</th>';
                  echo '            <th>Amount 2</th>';
                  echo '            <th>Difference</th>';
                  echo '            <th>Type</th>';
                  echo '        </tr>';
                  echo '    </thead>';
                  echo '    <tbody>';
                foreach($result as $row)
                {
                    $diff=number_format($row->freight-$row->diff,2,".","");

                    if($diff>5)
                    {
                        echo '<tr class="">';
                        echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                        echo '    <td>' . $row->builtyno . '</td>';
                        echo '    <td>' . $row->ledgername . '</td>';
                        echo '    <td>' . $row->name . '</td>';
                        echo '    <td>' . $row->qtymt . '</td>';
                        echo '    <td>' . $row->rate . '</td>';
                        echo '    <td>' . $row->discount . '</td>';
                        echo '    <td>' . $row->percent . '</td>';
                        echo '    <td>' . $row->freight . '</td>';
                        echo '    <td>' . $row->diff . '</td>';
                        echo '    <td>' . $diff . '</td>';
                        echo '    <td>' . $row->vtype . '</td>';
                        echo '</tr>';

                    }
                    if($diff<-5)
                    {
                        echo '<tr class="">';
                        echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                        echo '    <td>' . $row->builtyno . '</td>';
                        echo '    <td>' . $row->ledgername . '</td>';
                        echo '    <td>' . $row->name . '</td>';
                        echo '    <td>' . $row->qtymt . '</td>';
                        echo '    <td>' . $row->rate . '</td>';
                        echo '    <td>' . $row->discount . '</td>';
                        echo '    <td>' . $row->percent . '</td>';
                        echo '    <td>' . $row->freight . '</td>';
                        echo '    <td>' . $row->diff . '</td>';
                        echo '    <td>' . $diff . '</td>';
                        echo '    <td>' . $row->vtype . '</td>';
                        echo '</tr>';

                    }
                }
            }
            else
            {
                echo "No Data";
            }

        ?>

        <div class="loading"></div>

        <div class="hr hr-24"></div>
        </form>
        <!-- <div class="loading"></div> -->
        <div id="data-list-table">
            
            </div>
    </div>

        <script type="text/javascript">
            function ShowForm() {
                $('#data-list').fadeOut(500, function () {
                    $('#data-form2').fadeIn(500);
                    $("[tabindex='1']").focus();
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
                alert("No Permission");
                return;
                from=$('#from').val();
                to=$('#to').val();
                ledger_id=$('#ledger_id').val();
                data ="from="+from+"&to="+to+"&ledger_id="+ledger_id;
                $(".loading").show();
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/purchase_group_wise",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                        $("#data-list-table").html(html);
                        $('#from').select();
                        $(".loading").hide();
                        $('.show').show();
                        $('.hide').remove();
                        $('#from').val(from);
                        $('#to').val(to);
                        $('#from').focus();
                    }
                });
            }
            function ShowPrint(){
                from=$('#from').val();
                window.open($('#baseurl').val()+'index.php/transactionController/daily_freight_report_print/'+from,'_blank');
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
                MoveTextBox('.form-input');
                $("#data-list").hide();
                $("#data-form2").show();
                // GetList();
                GetParty();
                $('#from').focus();
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
                    name: "Purchase Group Wise",
                    filename:"Purchase Group Wise"
                  });    
            //    $('.mytable').tableExport({type:'excel',escape:'false'});
              }


            </script>
