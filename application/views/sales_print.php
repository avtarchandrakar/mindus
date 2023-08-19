<!DOCTYPE html>
<html>
<head>
</head>
<body style="margin:0px;">
    <? 
      $query=$this->db->query('select t.cdate,l.name as lname,t.ledger_mobno,t.id,t.builtyno,t.loading_person_name,t.remark from tbl_trans1 t inner join m_ledger l on t.ledger_id=l.id  where t.company_id='.get_cookie('ae_company_id').' and t.id='.$id);
      $partyname="";
      $cdate="";
      $builtyno=0;
      $loading_person_name="";
      $remark="";
      $ledger_mobno="";
      foreach($query->result() as $row)
      {
        $partyname=$row->lname;
        $cdate=$row->cdate;
        $builtyno=$row->builtyno;
        $loading_person_name=$row->loading_person_name;
        $remark=$row->remark;
        $ledger_mobno=$row->ledger_mobno;
      }
    ?>

  <table border="1" style="width:100%;" cellpadding="0" cellspacing="0">
    <tr>
      <td style="border:1px; solid black">
        <table border="0" style="width:100%;font-family:verdana;">
          <tr>
            <td style="border:0px;">
              <table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="width:33%;text-align:left;font-size:10px;">
                    &nbsp;
                  </td>
                  <td style="width:33%;text-align:center;font-size:12px;font-weight:bold;">
                    CHALLAN
                  </td>
                  <td style="width:33%;text-align:right;font-size:10px;">
                    &nbsp;
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td style="width:100%;" >
              <table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="width:50%;text-align:left;font-size:10px;">
                    No. : <? echo $builtyno;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:10px;">
                    Date : <? echo date('d-m-Y',strtotime($row->cdate));?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:10px;">
                    Party Name : <? echo $partyname;?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:10px;">
                    Vehicle No. : <? echo $ledger_mobno;?>
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
                  <td style="border-top:1px solid black;border-bottom:1px solid black;width:5%;text-align:center;font-size:10px;">
                    Sr.
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;width:68%;text-align:center;font-size:10px;">
                    Item(s)
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:27%;text-align:center;font-size:10px;">
                    Qty.
                  </td>
                </tr>

                <? 
                  $query=$this->db->query('select i.name as item, t.qtymt,m.vat pkg from tbl_trans2 t inner join m_item i on t.itemcode=i.id inner join m_master m on i.group_id=m.id  where  t.billno='.$id . ' order by t.id');
                  $totqty=0;
                  $totbox=0;
                  $i=0;
                  foreach($query->result() as $row)
                  {?>
                    <tr>
                      <td style="width:5%;text-align:left;font-size:10px;padding:3px;font-family:Arial;">
                        <? echo $i+1;?>
                      </td>
                      <td style="border-left:1px solid;width:68%;text-align:left;font-size:9px;padding:3px;font-family:Arial;letter-spacing: 1px;">
                        <? echo $row->item;?>
                      </td>
                      <td style="border-left:1px solid;width:27%;text-align:center;font-size:9px;padding:3px;font-family:Arial;">
                        <? echo number_format($row->qtymt,0);?>
                        <?
                          if($row->pkg!=0)
                          {
                            echo "/ ".number_format($row->qtymt/$row->pkg,0,".","");
                            $totbox=$totbox+number_format($row->qtymt/$row->pkg,0,".","");
                            $totqty=$totqty+($row->qtymt);
                          }
                          else
                          {
                            echo "/ 0";
                            $totqty=$totqty+($row->qtymt);
                            $totbox=$totbox+0;
                          }
                        ?>
                      </td>
                    </tr>
                <?$i++;
                  }
                  if($i<12)
                  {
                    for($c=0;$c<12-$i;$c++)
                    {?>
                      <tr>
                        <td style="width:5%;text-align:left;font-size:10px;padding:5px;">
                          &nbsp;
                        </td>
                        <td style="border-left:1px solid;width:68%;text-align:left;font-size:10px;padding:5px;">
                          &nbsp;
                        </td>
                      <td style="border-left:1px solid;width:27%;text-align:center;font-size:10px;padding:5px;">
                          &nbsp;
                        </td>
                      </tr>
                    <?}
                  }
                ?>
                <tr>
                  <td colspan="2" style="border-top:1px solid;width:70%;text-align:left;font-size:10px;padding:5px;">
                    <? echo $i ." Items ";?>
                  </td>
                  <td style="border-top:1px solid;width:20%;text-align:center;font-size:10px;padding:5px;">
                    <? echo number_format($totqty,0);?>
                    <?
                        echo "/ ".$totbox;
                    ?>
                  </td>
                </tr>

                <tr>
                  <td colspan="3" style="border-top:1px solid;width:100%;text-align:left;font-size:10px;padding:5px;">
                    Loading Person : <? echo $loading_person_name;?><br>
                    Remarks :  <? echo $remark;?>
                  </td>
                </tr>

              </table>
            </td>
          </tr>


        </table>  
      </td>
    </tr>
  </table>
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