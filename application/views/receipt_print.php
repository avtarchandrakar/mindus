<!DOCTYPE html>
<html style="margin:10px;margin-left:20px;">
<head>
<style type="text/css">
  
</style>
</head>
<body>
    <? 
      $query=$this->db->query('select t.cdate,l.name as lname,t.ledger_mobno,t.id,t.tol_freight,t.salesman, t.remark, t.edate from tbl_trans1 t inner join m_ledger l on t.ledger_id=l.id  where t.company_id='.get_cookie('ae_company_id').' and t.builtyno='.$id);
      $partyname="";
      $cdate="";
      $salesman="";
      $remark="";
      foreach($query->result() as $row)
      {
        $partyname=$row->lname;
        $salesman=$row->salesman;
        $cdate=$row->cdate;
        $remark=$row->remark;
      }
    ?>

  <table style="width:100%;font-size:12px;" cellpadding="0" cellspacing="0">
    <tr>
      <td style="border:1px; solid black">
        <table border="0" style="width:100%;">
          <tr>
            <td style="width:100%;">
              <table border="0" style="width:100%;" cellpadding="0" cellspacing="0">                
                <tr>

                  <td style="width:50%;text-align:center">
                    Entry Date : <? echo date('d-m-Y',strtotime($cdate));?>
                  </td>
                  <td style="width:50%;text-align:left">
                   Sales Person : <?=$salesman?> &nbsp;&nbsp;&nbsp;
                  </td>
                  
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td style="width:100%; padding:5px">
              <table style="width:100%;" cellpadding="0" cellspacing="0" 
              >
                <tr>
                  <td style="border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;width:5%;text-align:center;border-left:1px solid;padding:1px">
                    Sr.
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;width:25%;text-align:center;padding:1px">
                   Party Name
                  </td>
                  <td style="border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:15%;text-align:center;padding:1px">
                    Receipt Date
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;padding:1px">
                    Amount
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;padding:1px">
                    CD
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;padding:1px">
                    Mode
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:15%;text-align:center;padding:1px">
                    Remark
                  </td>
                  <td style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:15%;text-align:center; border-right:1px solid;padding:1px">
                    Clear Date
                  </td>
                </tr>

                <? 
                  $query2=$this->db->query('select t.cdate,l.name as lname,t.salesman,t.id,t.tol_freight,t.tol_amount, t.remark,t.ref_ledger_id, t.edate,t.lessadv, t.vamount,t.cleardate from tbl_trans1 t inner join m_ledger l on t.ledger_id=l.id  where t.company_id='.get_cookie('ae_company_id').' and t.builtyno='.$id.' and t.vtype="receipt" order by t.id');
                  
                  $total=0;
                  $i=1;
                  foreach($query2->result() as $row1)
                  {
                    $total=$total+$row1->tol_freight;
                    $ledger_name='';
                    $query3=$this->db->query("select name from m_ledger where id=".$row1->ref_ledger_id."");
                    $result=$query3->result();
                    foreach ($result as $row3) 
                    {
                      $ledger_name=$row3->name;
                    }

                    ?>
                    <tr>
                      <td style="text-align:left;padding-left:5px;padding-top:0px;border-left:1px solid;">
                        <? echo $i++;?>
                      </td>
                      <td style="border-left:1px solid;text-align:left;padding-left:5px;padding-top:0px;">
                      <?=$row1->lname;?> 
                      </td>
                      <td style="border-left:1px solid;text-align:center;padding-left:5px;padding-top:0px;">
                        <? echo date('d-m-Y', strtotime($row1->cdate))?>
                      </td>
                      <td style="border-left:1px solid;text-align:right;padding-left:5px;padding-right:20px;padding-top:0px;">
                        <? echo $row1->tol_freight;?>
                      </td>
                      <td style="border-left:1px solid;text-align:right;padding-left:5px;padding-right:20px;padding-top:0px;">
                        <?=$row1->lessadv?>
                        
                      </td>
                      <td style="border-left:1px solid;text-align:right;padding-left:5px;padding-right:20px;">
                        <?=$ledger_name;?>
                      </td>
                      <td style="border-left:1px solid;text-align:right;padding-left:5px;padding-right:20px;">
                        <?=$row1->remark;?>
                      </td>
                      <td style="border-left:1px solid;text-align:right;padding-left:5px;padding-right:20px; border-right:1px solid;">
                        <?
                          if($row1->cleardate!="0000-00-00")
                          {
                            echo date('d-m-Y', strtotime($row1->cleardate));
                          }
                        ?>
                      </td>
                    </tr>
                <?
                  }
                ?>
                
                <tr>
                 
                  <td style="border-left:1px solid;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;padding-left:5px;padding-right:20px; padding:2px" colspan="3">
                    <b>Net Total : </b>
                  </td>
                  <td style="border-left:1px solid;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;padding-right:20px;padding:2px">
                    <b><? echo number_format($total,2);?></b>
                  </td>
                  <td style="border-left:1px solid;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;padding-right:20px;" colspan="4">
                    
                  </td>
                </tr>

              </table>
            </td>
          </tr>


        </table>  
      </td>
    </tr>
  </table>
</body>
</html>


      <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery.min.js'>" + "<" + "/script>");
    </script>

      <script type="text/javascript">
        $(document).ready(function(){
          window.print();
        });
      </script>