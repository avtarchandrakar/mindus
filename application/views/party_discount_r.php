    <div id="data-form">
        <div class="done" style="display:none;">
            <h3>Record Saved.</h3>
        </div>

	    <div class="widget-box">
	    <div class="widget-header">
		    <h4 class="widget-title">Party Wise Discount</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
	<?php if($p_list==1){?>
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1">State</label>

			<div  class="col-sm-2">
				<?php
					$query=$this->db->query("select id,name from m_master where company_id=". get_cookie('ae_company_id') ."  and type='STATE' order by name");
					echo "<select id='state_id' name='state_id' tabindex='1' class='col-xs-10 col-sm-12' data-placeholder='Select State...''>";
					foreach($query->result() as $row)
					{
						echo "<option value='" . $row->name . "'> " . $row->name . "</option>";
					}
					echo "</select>";
				?>
			</div>

			<div class="col-sm-2" style="text-align:right;">
				<button  tabindex="2" class="btn btn-info" type="button" id="btn_show" onclick="GetList();return false;" >
					Show
				</button>
			</div>

		<div class="space-4"></div>
		<br>

		<div class="col-sm-12">
		<div id="item-list"></div>
		</div>
		
		<div class="loading"></div>

		<div class="hr hr-24"></div>
		</form>
		<?php }?>
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
		        item_id=$('#item_id').val();
		    	rate=$('#rate').val();
		        data = "state_id="+$("#state_id").val()+"&cat_id="+$("#cat_id").val();
		        $(".loading").show();
		        addLoading();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/discount_list_party_report",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $("#item-list").html(html);
		                $(".loading").hide();
		                clearLoading();
		                $(".cdate").mask('99-99-9999');
		                $('.cdate').val(getCurDate());

		            }
		        });
		    }

		    function ShowPrint(){
                state=$('#state_id').val();
                window.open($('#baseurl').val()+'index.php/transactionController/party_dis_print/'+state,'_blank');
            }


		    $(document).ready(function () {
		    	MoveTextBox('.form-input');
                $('#state').hide() 

                GetList();

		    });


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
