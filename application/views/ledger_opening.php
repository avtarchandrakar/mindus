    <div id="data-form">

        <div class="done" style="display:none;">
            <h3>Record Saved.</h3>
        </div>

	    <div class="widget-box">
	    <div class="widget-header">
		    <h4 class="widget-title">Ledger Opening</h4>
	    </div>
		<div class="widget-body">
			<div class="widget-main">
	<?php if($p_list==1){?>
        <form action="#" class="form-horizontal form-input" id="userform" method="post" role="form">
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> District</label>

			<div  class="col-sm-2">
				<?php
					$query=$this->db->query("select id,name from m_master where company_id=". get_cookie('ae_company_id') ."  and type='DISTRICT' order by name");
					echo "<select id='district' name='district' tabindex='1' class='col-xs-10 col-sm-12' data-placeholder='Select District...''>";
					foreach($query->result() as $row)
					{
						echo "<option> " . $row->name . "</option>";
					}
					echo "</select>";
				?>
			</div>
			<div class="col-sm-1" style="text-align:right;">
				<button  tabindex="2" class="btn btn-info" type="button" id="btn_show" onclick="GetList();return false;" >
					Show
				</button>
			</div>


			<br>


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
		        data = "district="+$("#district").val();
		        $(".loading").show();
		        addLoading();
		        $.ajax({
		            url: "<?php echo base_url();?>index.php/master_general/ledger_opening",
		            type: "GET",
		            data: data,
		            cache: false,
		            success: function (html) {
		                $("#item-list").html(html);
		                $(".loading").hide();
		                clearLoading();
		                $(".cdate").mask('99-99-9999');
		                $('.cdate').val(getCurDate());

				        //if submit button is clicked
				        $('#newsubmit').click(function () {
				                var data = $("#userform").serialize();
								$('input[type="text"').attr('disabled',true);
								$('#newsubmit').attr('disabled',true);

				                $('.loading').show();
				                $.ajax({
				                    url: "<?php echo base_url();?>index.php/master_general/ledger_opening_save",
				                    type: "POST",
				                    data: data,
				                    cache: false,
				                    success: function (html) {
				                        $('.loading').hide();
				                        $("#item-list").html("");
				                    }
				                });
				                return false;
				        });


		            }
		        });
		    }




		    function CopyCol(index) {
		    	var colindex=0;
				var rows = $("#price1 tbody").children("tr");
				rows.each(function(idx, row) {
					$("#price1 tr:nth-child("+idx+") td").each(function(colindex1){
						if ($(this).find('input').length) { 
						    colindex=colindex1
						    return false;
						}					
					});

					if(idx>=1)
					{
						return false;
					}
				});

				$('#price1 td:nth-child('+(++index)+')').each(function(idx){
					var rate;
					rate=$(this).text();
						var td1=$("#price1 tr:nth-child("+(idx+1)+") td:nth-child("+(colindex+1)+")");

						td1.find('input[name="rate[]"]').val(rate.trim());
//				    $(this).parent('tr').prepend('<td>'+$(this).text()+'</td>');
				});
		    }


		    $(document).ready(function () {
		    	MoveTextBox('.form-input');

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
