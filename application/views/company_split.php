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
            <h4 class="widget-title">Company Split</h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform2" method="post" role="form">
        <input type="hidden" value="add" name="status" id="status" class="form-control" />
        <input type="hidden" value="" name="sno" id="sno" class="form-control" />
        <!-- <input type="hidden" name="type" id="type" value="branch" /> -->
        <div class="form-group">
        <table class="table" style="width:400px;">
         <tr>
            <td style="width:140px;">
                Existing Company : 
            </td>
            <td>
                <?
                    echo get_cookie('ae_company_name');
                ?>
            </td>
         </tr>
         <tr>
            <td>
                Data From : 
            </td>
            <td>
                <?
                  $query=$this->db->query("select min(cdate) as cdate from tbl_trans1 where cdate>'1970-01-01' and company_id=".get_cookie("ae_company_id"));
                  $result=$query->result();
                  if($query->num_rows()>0)
                  {
                    foreach($result as $row)
                    {
                      $cdate = date('d-m-Y',strtotime($row->cdate));
                    }
                  }
                  echo $cdate;
                ?>
            </td>
         </tr>
         <tr>
            <td>
                Data To : 
            </td>
            <td>
                <?
                  $query=$this->db->query("select max(cdate) as cdate from tbl_trans1 where cdate>'1970-01-01' and company_id=".get_cookie("ae_company_id"));
                  $result=$query->result();
                  if($query->num_rows()>0)
                  {
                    foreach($result as $row)
                    {
                      $cdate = date('d-m-Y',strtotime($row->cdate));
                    }
                  }
                  echo $cdate;
                ?>
            </td>
         </tr>
         <tr>
            <td>
                New Company Name
            </td>
            <td>
                <input type="text" name="newname" id="newname">
            </td>
         </tr>
         <tr>
            <td>
                From Date
            </td>
            <td>
                <input type="text"  name="cdate" id="cdate" data-rule-required="true"  placeholder="Date" class="date-picker" list="0" value="<? echo $cdate;?>"/>';                       
            </td>
         </tr>
         <tr>
            <td>
                &nbsp;
            </td>
            <td>
                <button type="button" name="btn_show" id="btn_show" class="btn btn-primary" onclick="CompanySplit();">SUBMIT</button>            </td>
         </tr>
        </table>

        </div>
        <div class="stud_detail form-group"></div>

        <div class="space-4"></div>



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
                l_id=$('#party_id').val();
                type=$('#type').val();
                report_type=$('#report_type').val();
                clear_date=$('#clear_date').val();
                data ="from="+from+'&to='+to+'&l_id='+l_id+'&type='+type+'&report_type='+report_type+'&clear_date='+clear_date;
                $(".loading").show();
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/party_delete",
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
                        $('#type').val(type);
                        $('#l_id').val(l_id);
//                        $('#from').focus();


                        $("input[type='checkbox'].chk").change(function(){
                            var a = $("input[type='checkbox'].chk");
                            var b = a.filter(":checked").length;
                            if(b == 0){
                                $("#del").hide();
                                $(".hideselected").html("Hide");
                            }
                            else
                            {
                                $("#del").show();
                                $(".hideselected").html("Hide  ("+b+")");
                            }
                        });

                    }
                });
            }
            function CompanySplit(){
                    newname=$('#newname').val();
                    cdate=$('#cdate').val();
                    if(newname=="")
                    {
                        alert("Enter New Company Name");
                        return;
                    }
                s=confirm("Are You Sure");
                if(s)
                {
                    $("#btn_show").hide();
                    $(".loading").show();
                    $(".stud_detail").append("Started");
                    data ="newname="+newname+'&cdate='+cdate;
                    $.ajax({
                        url: "<?php echo base_url();?>index.php/transactionController/split_company_create",
                        type: "POST",
                        data:data,
                        cache: false,
                        success: function (html) {
                            $(".stud_detail").append("<br>Company Created");
                            $(".loading").hide();
                            CreateMaster(html);
                        }
                    });
                }

            }
            function CreateMaster(newcompany)
            {
                $(".loading").show();
                $(".stud_detail").append("<br>Copying Master");
                data ="newcompany="+newcompany;
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/split_master_create",
                    type: "POST",
                    data:data,
                    cache: false,
                    success: function (html) {
                        $(".stud_detail").append("<br>Masters Copied");
                        $(".loading").hide();
                        CreateItem(newcompany);
                    }
                });
            }

            function CreateItem(newcompany)
            {
                $(".loading").show();
                $(".stud_detail").append("<br>Copying Items");
                data ="newcompany="+newcompany;
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/split_item_create",
                    type: "POST",
                    data:data,
                    cache: false,
                    success: function (html) {
                        $(".stud_detail").append("<br>Items Copied");
                        $(".loading").hide();
                        CreateLedger(newcompany);
                    }
                });
            }

            function CreateLedger(newcompany)
            {
                $(".loading").show();
                $(".stud_detail").append("<br>Copying Ledger");
                data ="newcompany="+newcompany;
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/split_ledger_create",
                    type: "POST",
                    data:data,
                    cache: false,
                    success: function (html) {
                        $(".stud_detail").append("<br>Ledgers Copied");
                        $(".loading").hide();
                        CreateOpBalance(newcompany);
                    }
                });
            }

            function CreatePriceList(newcompany)
            {
                $(".loading").show();
                $(".stud_detail").append("<br>Copying Price List");
                data ="newcompany="+newcompany;
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/split_pricelist_create",
                    type: "POST",
                    data:data,
                    cache: false,
                    success: function (html) {
                        $(".stud_detail").append("<br>Price List Copied");
                        $(".loading").hide();
                        CreateStockOpening(newcompany);
                    }
                });
            }

            function CreateStockOpening(newcompany)
            {
                $(".loading").show();
                $(".stud_detail").append("<br>Copying Stock");
                data ="newcompany="+newcompany;
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/split_stock_create",
                    type: "POST",
                    data:data,
                    cache: false,
                    success: function (html) {
                        $(".stud_detail").append("<br>Stock Copied");
                        $(".loading").hide();
                    }
                });
            }

            function CreateOpBalance(newcompany)
            {
                cdate=$('#cdate').val();
                $(".loading").show();
                $(".stud_detail").append("<br>Copying Opening Balance");
                data ="newcompany="+newcompany+"&cdate="+cdate;
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/split_opbalance_create",
                    type: "POST",
                    data:data,
                    cache: false,
                    success: function (html) {
                        $(".stud_detail").append("<br>Opening Balance Copied");
                        $(".loading").hide();
                        CreatePriceList(newcompany);
                    }
                });
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

                MoveTextBox('.form-input');
                $("#data-list").hide();
                $("#data-form2").show();
                // GetList();
                GetParty();
//                $('#from').focus();
                $('.cdate').mask("99-99-9999");
                $('.cdate').val(getCurDate());
                $('#from').val("01-03-2017");
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


            function HideSelected() {
                var myCheckboxes = new Array();
                        $("input:checked").each(function() {
                           myCheckboxes.push($(this).val());
                        });
                data="checkbox="+myCheckboxes;
                $(".loading").show();
                $.ajax({
                    url: "<?php echo base_url();?>index.php/transactionController/ledger_hideselected",
                    type: "POST",
                    data: data,
                    cache: false,
                    success: function (html) {
                        alert("OK");
                        $("#del").hide();
                        $(".hideselected").html("Hide");
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
