<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
  <style>
    /*@page { size: A5 }*/
    body {
    /* A5 dimensions */
    /*height: 210mm;
    width: 148.5mm;

    margin: 0;*/
}
</style>

</head>
<body style="padding:10px;">
    <?php 
      $query=$this->db->query('select t.cdate,l.name as lname,l.state as state,l.district as district,l.address as partyadd,t.ledger_mobno,t.id,t.tol_freight,t.builtyno,t.loading_person_name,t.remark,t.lr_freight,t.paid_build,t.quatation_no,t.semi_formal,t.header,t.taxes,t.scope_of_work,t.design_criteria,t.validity_of_offer,t.note,t.performance_warranty,t.equipment_acceptance,t.supervision_commissioning,t.training,t.general_safety,t.spare_parts,t.chassis_equipment,t.checked_by,t.dispatch_through,t.ref_details,t.sub_details,t.pakking_forwerding,t.delivery_period,t.payment_terms,t.warranty_guarantee,t.ld_clause from tbl_trans1 t inner join m_ledger l on t.ledger_id=l.id  where t.company_id='.get_cookie('ae_company_id').' and t.id='.$id);
      $partyname="";
      $quatation_no='';
      $cdate="";
      $tol_freight=0;
      $builtyno=0;
      $loading_person_name="";
      $remark="";
      $ledger_mobno="";
      $ref_details="";
      $sub_details="";
      $pakking_forwerding="";
      $delivery_period="";
      $payment_terms="";
      $warranty_guarantee="";
      $ld_clause="";

      $lr_freight=0;
      $checked_by='';
      $dispatch_through='';
      $paid_build='';
      $partyadd='';
      $district='';
      $state='';
      $semi_formal='';
      $header='';
      $taxes='';
      $scope_of_work='';
      $design_criteria='';
      $validity_of_offer='';
      $note='';
      $performance_warranty='';
      $equipment_acceptance='';
      $supervision_commissioning='';
      $training='';
      $general_safety='';
      $spare_parts='';
      $chassis_equipment='';

      foreach($query->result() as $row)
      {
        $partyname=$row->lname;
        $partyadd=$row->partyadd;
        $district=$row->district;
        $state=$row->state;
        $cdate=$row->cdate;
        $tol_freight=$row->tol_freight;
        $builtyno=$row->builtyno;
        $loading_person_name=$row->loading_person_name;
        $remark=$row->remark;
        $ledger_mobno=$row->ledger_mobno;
        $pakking_forwerding=$row->pakking_forwerding;
        $ref_details=$row->ref_details;
        $sub_details=$row->sub_details;
        $pakking_forwerding=$row->pakking_forwerding;
        $delivery_period=$row->delivery_period;
        $payment_terms=$row->payment_terms;
        $warranty_guarantee=$row->warranty_guarantee;
        $ld_clause=$row->ld_clause;
        $lr_freight=$row->lr_freight;
        $checked_by=$row->checked_by;
        $dispatch_through=$row->dispatch_through;
        $paid_build=$row->paid_build;
        $quatation_no=$row->quatation_no;

        $semi_formal=$row->semi_formal;
        $header=$row->header;
        $taxes=$row->taxes;
        $scope_of_work=$row->scope_of_work;
        $design_criteria=$row->design_criteria;
        $validity_of_offer=$row->validity_of_offer;
        $note=$row->note;
        $performance_warranty=$row->performance_warranty;
        $equipment_acceptance=$row->equipment_acceptance;
        $supervision_commissioning=$row->supervision_commissioning;
        $training=$row->training;
        $general_safety=$row->general_safety;
        $spare_parts=$row->spare_parts;
        $chassis_equipment=$row->chassis_equipment;


      }
    ?>
  <header>
    <img src="<?php echo base_url();?>assets/images/header.jpg" style="height:auto;width: 100%;">
  </header>
  <div class="clearfix" style="background: #74a74b;height: 5px;width: 100%;"></div>
  <div style="margin-top: 30px;">
     <table border="0" style="width:100%;font-family:verdana">
          <tr>
            <td style="border:0px;">
              <table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="width:33%;text-align:left;font-size:15px;">
                    &nbsp;
                  </td>
                  <td style="width:33%;text-align:center;font-size:17px;font-weight:bold;">
                    QUOTATION
                  </td>
                  <td style="width:33%;text-align:right;font-size:15px;">
                    &nbsp;
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
  </div>
  <table border="0" style="width:100%;" cellpadding="0" cellspacing="0" >
    <tr>
      <td style="border:1px; solid black">
        <table border="0" style="width:100%;font-family:verdana">
          <tr>
            <td style="width:100%;" >
              <table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="width:50%;text-align:left;font-size:15px;font-weight: bold;">
                     <?php echo $quatation_no;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:15px;font-weight: bold;">
                    Date : <?php echo date('d-m-Y',strtotime($row->cdate));?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;font-weight: bold;">
                    <br>To,
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;font-weight: bold;">
                     <?php echo $partyname;?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;font-weight: bold;">
                     <?php echo $partyadd;?>,<?php echo $district;?>,<?php echo $state;?>
                  </td>
                </tr>

                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;font-weight: bold;">
                    <br>
                  </td>
                </tr>

                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;font-weight: bold;">
                    <u>Kind Attn</u>:<br><br>
                  </td>
                </tr>

                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;">
                    <b><u>Ref</u></b>: <?php echo ucwords(strtolower($ref_details));?><br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;">
                    <b><u>Sub</u></b>: <?php echo ucwords(strtolower($sub_details));?><br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;">
                    Dear <?php echo ucwords(strtolower($semi_formal));?>,<br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;">
                    <?php echo ucwords(strtolower($header))?><br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:15px;font-weight: bold;">
                    <u>Price</u>:<br><br>
                  </td>
                </tr>
              </table>
              <br>
            </td>
          </tr>

          <tr>
            <td style="width:100%;">
              <table style="width:100%;" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;width:5%;text-align:center;font-size:15px;">
                    Sr. No.
                  </td>
                  <td style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:60%;text-align:center;font-size:15px;">
                    Particulars
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;font-size:15px;">
                    Quantity
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;font-size:15px;">
                    1
                  </td>
                </tr>

                <? 
                  $query=$this->db->query('select i.name as item, t.qtymt,m.vat pkg,t.rate,t.freight,t.percent,t.discount,t.remark,t.unit from tbl_trans2 t inner join m_item i on t.itemcode=i.id inner join m_master m on i.group_id=m.id  where  t.billno='.$id  . ' order by t.id');
                  $totqty=0;
                  $totbox=0;
                  $i=0;
                  foreach($query->result() as $row)
                  {?>
                    <tr>
                      <td style="width:5%;text-align:left;font-size:15px;padding:5px;">
                        <?php echo $i+1;?>
                      </td>
                      <td style="border-left:1px solid;width:60%;text-align:left;font-size:15px;padding:5px;">
                        <?php echo $row->item;?>
                      </td>                     
                      <td style="border-left:1px solid;width:10%;text-align:center;font-size:15px;padding:5px;">
                        <?php echo number_format($row->qtymt,0);?>
                        <?
                          if($row->pkg!=0)
                          {
                            // echo "/ ".number_format($row->qtymt/$row->pkg,0,".","");
                            $totbox=$totbox+number_format($row->qtymt/$row->pkg,0,".","");
                            $totqty=$totqty+($row->qtymt);
                          }
                          else
                          {
                            // echo "/ 0";
                            $totqty=$totqty+($row->qtymt);
                            $totbox=$totbox+0;
                          }
                        ?>
                      </td>

                      <td style="border-left:1px solid;width:10%;text-align:center;font-size:15px;padding:5px;">
                        
                      </td>
                    </tr>
                <?$i++;
                  }
                  if($i<8)
                  {
                    for($c=0;$c<8-$i;$c++)
                    {?>
                      <tr>
                        <td style="width:5%;text-align:left;font-size:15px;padding:5px;">
                          &nbsp;
                        </td>
                        <td style="border-left:1px solid;width:60%;text-align:left;font-size:15px;padding:5px;">
                          &nbsp;
                        </td>
                        <td style="border-left:1px solid;width:10%;text-align:left;font-size:15px;padding:5px;">
                          &nbsp;
                        </td>
                        <td style="border-left:1px solid;width:10%;text-align:center;font-size:15px;padding:5px;"> &nbsp;
                        </td>
                      </tr>
                    <?}
                  }
                ?>
                
                <tr>
                  <td style="border-top:1px solid;width:5%;text-align:left;font-size:15px;padding:5px;">
                    <?php echo $i ." Items ";?>
                  </td>
                  <td style="border-top:1px solid;width:60%;text-align:center;font-size:15px;padding:5px;">
                    <?php echo number_format($totqty,0);?>
                    <?
                        // echo "/ ".$totbox;
                    ?>
                  </td>
                  <td style="border-top:1px solid;width:10%;text-align:center;font-size:15px;padding:5px;">
                    &nbsp;
                  </td>
                  <td style="border-top:1px solid;width:10%;text-align:center;font-size:15px;padding:5px;">
                    &nbsp;
                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="border-top:1px solid;width:100%;text-align:left;padding:5px;font-size:15px;">
                    <b><u>Taxes</u></b>: <?php echo ucwords(strtolower($taxes))?><br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="width:100%;text-align:left;padding:5px;font-size:15px;">
                    <b><u>Delivery Period</u></b>: <?php echo ucwords(strtolower($delivery_period))?><br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="width:100%;text-align:left;padding:5px;font-size:15px;">
                    <b><u>Payment Terms</u></b>:<br>
                    <?php echo ucwords(strtolower($payment_terms))?><br><br>

                  </td>
                </tr>

                <tr>
                  <td colspan="4" style="width:100%;text-align:left;padding:5px;font-size:15px;">
                    <b><u>Validity of offer</u></b>: <?php echo ucwords(strtolower($validity_of_offer))?><br><br>

                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="width:100%;text-align:left;padding:5px;font-size:15px;">
                    <b><u>Note</u></b>: <?php echo ucwords(strtolower($note))?><br><br>

                  </td>
                </tr>
               <!--  <tr>
                  <td colspan="4" style="width:100%;text-align:left;padding:5px;font-size:15px;">
                    <?php echo $header?><br><br>

                  </td>
                </tr> -->
                <tr>
                  <td colspan="4" style="width:100%;text-align:left;padding:5px;font-size:15px;">
                    Warm Regards,<br>
                    Venketeshwar Agrawal<br>
                    Metalite Industries<br>
                    Contact: +91 7052899999<br>


                  </td>
                </tr>


              </table>
            </td>
          </tr>


        </table>  
      </td>
    </tr>
  </table>
  <footer>
    <img src="<?php echo base_url();?>assets/images/footer.jpg" style="height:auto;width: 100%;margin-bottom: 0px;position: fixed;left: 0;bottom: 0;">
  </footer>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery.min.js'>" + "<" + "/script>");
    </script>

      <script type="text/javascript">
        $(document).ready(function(){
          window.print();
        });
      </script>
</body>
</html>