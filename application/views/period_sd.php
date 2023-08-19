    <div id="data-form">
        <div class="done" style="display:none;">
            <h3>Record Saved.</h3>
        </div>

        <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">Price Wise SD</h4>
        </div>
        <?php if($p_list==1){?>
        <div class="widget-body">
            <div class="widget-main">
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
        <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">From</label>

            <div class="col-sm-2">
                <input tabindex="1" type="text"  name="from" id="from" data-rule-required="true"  placeholder="Date" class="col-xs-10 col-sm-12 cdate" list="0"/>

            </div>
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">To</label>

            <div class="col-sm-2">
                <input tabindex="2" type="text"  name="to" id="to" data-rule-required="true"  placeholder="Date" class="col-xs-10 col-sm-12 cdate" list="0"/>

            </div>
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> State Name</label>

            <div class="col-sm-2">
                <?php
                    $query=$this->db->query("select id,name from m_master where company_id=". get_cookie('ae_company_id') ."  and type='State' order by name");
                    echo "<select id='state_id' name='state_id' tabindex='3' class='col-xs-10 col-sm-12' data-placeholder='Select State Name...''>";
                    foreach($query->result() as $row)
                    {
                        echo "<option value=" . $row->id . "> " . $row->name . "</option>";
                    }
                    echo "</select>";
                ?>
            </div>
            <div class="col-sm-3">
                <button  tabindex="4" class="btn btn-info" type="button" id="btn_show" onclick="GetList();return false;" >
                    Show
                </button>
                
            </div>
         </div>  
         <?php }?> 
    
        <div class="space-4"></div>
        <div id="item-list"></div>
        <div class="loading"></div>

        <div class="hr hr-24"></div>
        </form>
    </div>

        <script type="text/javascript">
            function BlankForm() {
                $('#userform').find('input:text').val('');
                $('#userform').find('input:hidden').val('');
                $('#userform')[0].reset();
                $('#userform').find('input:password').val('');
                $('#status').val('add');
            }
  function hidebtn() {
              $('#state').show() 
              $('#btn_hide').hide() 
            }


            function GetList() {
                from=$('#from').val();
                to=$('#to').val();
                state_id=$('#state_id').val();

                data = "state_id="+state_id+"&from"+from+"&to"+to;
                $(".loading").show();
                $.ajax({
                    url: "<?php echo base_url();?>index.php/master_general/item_list_Periodsd",
                    type: "GET",
                    data: data,
                    cache: false,
                    success: function (html) {
                        $("#item-list").html(html);
                        $(".loading").hide();


                        //if submit button is clicked
                        $('#newsubmit').click(function () {
                            $("#userform").validate();
                            if ($("#userform").valid() == true) {
                                var data = $("#userform").serialize();
                                $('.loading').show();
                                $.ajax({
                                    url: "<?php echo base_url();?>index.php/master_general/item_state_Peroidsd",
                                    type: "POST",
                                    data: data,
                                    cache: false,
                                    success: function (html) {
                                        $('.loading').hide();
                                        $("#item-list").html("");
                                    }
                                });
                                return false;

                            }
                        });


                    }
                });
            }
           
            $(document).ready(function () {
                MoveTextBox('.form-input');
                $('#state').hide() 
                //GetParty();
                $('#from').focus();
                $('.cdate').mask("99-99-9999");
                $('.cdate').val(getCurDate());
                $('#from').val("01-03-2017");
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




            });


                </script>
