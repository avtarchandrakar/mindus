<!DOCTYPE html>
<html>
<head>
	<title>Dispatch List</title>
	<style type="text/css" media="screen">
		#TblRpt{width: 100%;margin-left:4%;}
		#TblRpt thead tr{font-weight: bold;font-size: 16px;}
        #TblRpt tbody tr{text-align: center;}
		h1{font-size: 16px;text-decoration: underline;}
        #TblRpt{font-size: 12px;}
	</style>
</head>
<body>
    <center><h1><?=$title?></h1></center>
<?//=$subsql?>
<table id="TblRpt" cellpadding="0" cellspacing="0">
 <thead>
 	<tr>
     <th>SNO</th>
     <th>Date</th>
     <th>Party Name</th>
     <th>Destination</th>
     <th>&nbsp;</th> <!-- Sub Dealer -->
     <th>Consignee Name</th>
     <th>Turck No</th>
     <th>Builty No</th>
    </tr>
 </thead>
 <tbody>
 <? $i=1;$ar=array();?>
 <? 
 $from=date('Y-m-d',strtotime($this->input->post('from')));
 $to=date('Y-m-d',strtotime($this->input->post('to')));
 //$sql1=$this->db->query('select t.id,d.name dname,l.name lname,sd.name sdname,t.consignee_name,t.truckno,t.cdate,t.builtyno,p.name pname from tbl_trans1 t inner join m_master p on t.pos_id=p.id inner join m_ledger l on t.ledger_id=l.id inner join m_master d on t.destination_id=d.id inner join m_ledger sd on t.sub_dealer_id=sd.id where t.company_id='.get_cookie('ae_company_id').' and t.vtype="DISPATCH" '.$subsql1.' and(t.cdate between "'.$from.'" and "'.$to.'")'); 
 $sql1=$this->db->query('select t.id,d.name dname,l.name lname,t.consignee_name,t.truckno,t.cdate,t.builtyno,p.name pname from tbl_trans1 t inner join m_master p on t.pos_id=p.id inner join m_ledger l on t.ledger_id=l.id inner join m_master d on t.destination_id=d.id where t.company_id='.get_cookie('ae_company_id').' and t.vtype="DISPATCH" '.$subsql1.' and(t.cdate between "'.$from.'" and "'.$to.'")'); 
 ?>
 <? if($query->num_rows()>0){ ?>
 <? foreach($sql1->result() as $row){ ?>
 	<tr>
     <td><?=$i++?></td>
     <td><?=date('d-m-Y',strtotime($row->cdate))?></td>
     <td><?=$row->lname?></td>
     <td><?=$row->dname?></td>
     <td>&nbsp;</td> <? //echo $row->sdname ;?>
     <td><?=$row->consignee_name?></td>
     <td><?=$row->truckno?></td>
     <td><?=$row->builtyno?></td>
    </tr>

    <tr>
     <th>&nbsp;</th>
     <th>&nbsp;</th>
     <th>#</th>
     <th>Item Name</th>
     <th>Qty(MT)</th>
     <th>Qty(Bag)</th>
     <th>Type</th>
     <th>Freight</th>
    </tr>
    <? $j=1; ?>
     <? if($subsql2==2){ ?>
     <? $sql2=$this->db->query('select t2.qtymt,t2.qtybag,t2.type,freight,i.name iname from tbl_trans2 t2 inner join m_item i on t2.itemcode=i.id and billno='.$row->id); ?>
     <? }else{ ?>
     <? $sql2=$this->db->query('select t2.qtymt,t2.qtybag,t2.type,freight,i.name iname from tbl_trans2 t2 inner join m_item i on t2.itemcode=i.id where '.$subsql2.' and billno='.$row->id); ?>
     <? } ?>
     <? if($query->num_rows()>0){ ?> 
     <? foreach($sql2->result() as $row){ ?>
     <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td><?=$j++?></td>
         <td><?=$row->iname?></td>
         <td><?=$row->qtymt?></td>
         <td><?=$row->qtybag?></td>
         <td><?=$row->type?></td>
         <td><?=$row->freight?></td>
     </tr>
     <? }} ?>

 <? }} ?>
 </tbody>
</table>
</body>
</html>