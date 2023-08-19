<!DOCTYPE html>
<html>
<head>
	<title>Dispatch List</title>
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
<table id="TblRpt" cellpadding="0" cellspacing="0">
 <thead>
    <tr>
        <td>SNO</td>
        <td>Date</td>
        <td>Source Name</td>
        <td>Item Name</td>
        <td>QTY(MT)</td>
        <td>QTY(Bag)</td>
        <td>Truck No</td>
        <td>Transporter</td>
        <td>Unloading</td>
        <td>Crossing</td>
        <td>Direct</td>
    </tr>
 </thead>
 <tbody>
 <? $i=1;?>
 <? 
 $from=date('Y-m-d',strtotime($this->input->post('from')));
 $to=date('Y-m-d',strtotime($this->input->post('to')));
 $query=$this->db->query('select t.cdate,t.qtymt,t.qtybag,t.truckno,t.l_qty,t.c_qty,t.d_qty,s.name sname,i.name iname,trans.name tname from tbl_trans t inner join m_master s on t.source_id=s.id inner join m_item i on t.item_id=i.id inner join m_ledger trans on t.transporter_id=trans.id where t.company_id='.get_cookie('ae_company_id').' and t.vtype="ARRIVAL" '.$subsql.' and(t.cdate between "'.$from.'" and "'.$to.'")');
 ?>
 <? if($query->num_rows()>0){ ?>
 <? foreach($query->result() as $row){ ?>
 	<tr>
      <td><?=$i++?></td>  
      <td><?=$row->cdate?></td>  
      <td><?=$row->sname?></td>  
      <td><?=$row->iname?></td>  
      <td><?=$row->qtymt?></td>  
      <td><?=$row->qtybag?></td>  
      <td><?=$row->truckno?></td>  
      <td><?=$row->tname?></td>  
      <td><?=$row->l_qty?></td>  
      <td><?=$row->c_qty?></td>  
      <td><?=$row->d_qty?></td>     
    </tr>
 <? }} ?>
 </tbody>
</table>
</body>
</html>