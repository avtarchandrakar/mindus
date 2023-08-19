<!DOCTYPE html>
<html>
<head>
	<title>Pending Orders</title>
	<style type="text/css" media="screen">
		#TblRpt{width: 100%;margin-left:4%;}
		#TblRpt thead tr{font-weight: bold;}
		h1{font-size: 16px;text-decoration: underline;}
        #TblRpt{font-size: 12px;}
	</style>
</head>
<body>
    <center><h1><?=$title?></h1></center>
<?//=$subsql?>
<table id="TblRpt" cellpadding="5" cellspacing="0" style="font-size:8px; width:750px;" border=1>
 <thead>
    <tr>
        <td style="width:20px;">SNO</td>
        <td style="width:50px;">Date</td>
        <td style="width:40px;">User</td>
        <td style="width:30px;">Order ID</td>
        <td style="width:100px;">Party Name</td>
        <td style="width:60px;">Godown</td>
        <td style="width:100px;">Item Name</td>
        <td style="width:40px;">Pending Qty.</td>
        <td>Remarks</td>
        <td>Del.Date</td>
    </tr>
 </thead>
 <tbody>
 <? $i=1;?>
 <? 
  $query=$this->db->query('select o.*, (select sum(qtymt) from tbl_trans2,m_item,tbl_trans1  where tbl_trans1.id=tbl_trans2.billno and tbl_trans2.itemcode=m_item.id and  tbl_trans2.orderid_gen=o.orderid_gen and o.itemname=m_item.name and tbl_trans1.vtype="Dispatch") as dispqty from orders o, m_item i, m_master c where o.itemname=i.name and i.itemcompany_id=c.id  '.$srch.' order by o.timestamp desc');
 ?>
 <? if($query->num_rows()>0){ ?>
<?
          $orderid_gen="";
          $timestamp="";
          $totqty=0;
          $totpqty=0;

?>
 <? foreach($query->result() as $row){ ?>
 <?
              $pending_qty = (int)($row->qty)- (int)($row->dispqty);
              $pending_qty = (int)($pending_qty)- (int)($row->adjustmentqty);
              if($pending_qty!=0)
              {

 ?>
 	<tr>
      <td><?=$i++?></td>  
      <td><?=$row->date?></td>  
      <td><?=$row->name?></td>  
      <td><?=$row->orderid?></td>  
      <td><?=$row->partyname?></td>  
      <td><?=$row->godown?></td>  
      <td><?=$row->itemname?></td>  
      <td><?=$pending_qty?></td>  
      <td><?=$row->remarks?></td>  
      <td><?=$row->deldate?></td>  
    </tr>
 <?
    $totqty=$totqty+$row->qty;
    $totpqty=$totpqty+$pending_qty;


   } }} ?>

  <tr>
      <td><?=$i++?></td>  
      <td>&nbsp;</td>  
      <td>&nbsp;</td>  
      <td>&nbsp;</td>  
      <td>&nbsp;</td>  
      <td>&nbsp;</td>  
      <td>TOTAL :</td>  
      <td><?=$totpqty?></td>  
      <td>&nbsp;</td>  
      <td>&nbsp;</td>  
    </tr>

 </tbody>
</table>
</body>
</html>