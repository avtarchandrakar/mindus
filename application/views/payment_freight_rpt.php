<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<style type="text/css">
	#itemTbl{
		width: 100%;
		/*border-top: 1px solid #000;
		border-bottom: 1px solid #000;*/
	}
	#itemTbl tr th{
		font-size:14px;
	}
  #itemTbl thead th{
    border-top:1px solid;
    border-bottom:1px solid;
    padding: 0.5%;
  }
  #itemTbl tfoot{
    border-top:1px solid;
    padding: 0.5%;
  }
	.item-txt{
		text-align: center;
		width: 100%;
	}
	body{
		border: 1px solid #000;
		margin:2%;
		/*padding:2%;*/
	}
	.footer{
		width: 100%;
		position: absolute;
		bottom:0px;
		text-align: center;
	}
  .cdate{
    text-align: right;
    padding-right:5%;
  }
	</style>
</head>
<body>
    <center>DEBIT VOUCHER</center>
    <h2>Atul Enterprises</h2>
    <? $query=$this->db->query('select t.cdate,a.name aname,t.netamt,t.tdsamt,t.tds,t.lessamt,t.addamt,ls.name lsname,ad.name adname from tbl_payment_freight t inner join m_ledger a on t.achead_id=a.id inner join m_ledger ls on t.less_id=ls.id inner join m_ledger ad on t.add_id=ad.id where t.company_id='.get_cookie('ae_company_id').' and t.id='.$maxid); ?>
    <? $netamt=0;$tds=0;$tdsamt=0;$addamt=0;$lessamt=0; ?>
    <? foreach($query->result() as $data1){ ?>
    <p class="cdate">Date :  <?=date('d-m-Y',strtotime($data1->cdate))?> </p>
    Account Head : <?=$data1->aname?>
    <? $tdsamt=$data1->tdsamt; ?>
    <? $lessamt=$data1->lessamt; ?>
    <? $addamt=$data1->addamt; ?>
    <? $tds=$data1->tds; ?>
    <? $netamt=$data1->netamt; ?>
    <? $addname=$data1->adname; ?>
    <? $lsname=$data1->lsname; ?>
    <? } ?>
    <table id="itemTbl" cellpadding="0" cellspacing="0">
    <thead>
     <tr>
      <th>BuiltyNo</th>
      <th>Sub Dealer</th>
      <th>Qty(MT)</th>
      <th>Destination</th>
      <th>Amount</th>
     </tr>
    </thead>
    <? $query2=$this->db->query('select * from tbl_payment_freight_detail where billno='.$maxid); ?>
    <? $qty=0;$amt=0 ?>
    <? foreach($query2->result() as $data2){ ?>
     <tbody>
       <tr class="item-txt">
        <td><?=$data2->builtyno?></td>
        <td><?=$data2->sub_dealer_id?></td>
        <td><?=$data2->qtymt?></td>
        <td><?=$data2->destination_id?></td>
        <td><?=$data2->amtpaid?></td>
       </tr>
        <? $qty=bcadd($qty,$data2->qtymt,2); ?>
        <? $amt=bcadd($amt,$data2->amtpaid,2); ?>
       <? } ?>  
     </tbody>
     <tfoot>
     <tr class="item-txt">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><?=$qty?></td>
      <th>Total</th>
      <td><?=$amt?></td>
     </tr>
     <tr class="item-txt">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <th>Less TDS</th>
      <th><?=$tds?></th>
      <td><?=$tdsamt?></td>
     </tr>
     <tr class="item-txt">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <th>Less Amt.</th>
      <td><?=$lsname?></td>
      <td><?=$lessamt?></td>
     </tr>
     <tr class="item-txt">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <th>Add Amt</th>
      <td><?=$addname?></td>
      <td><?=$addamt?></td>
     </tr>
     <tr class="item-txt">
      <td colspan="3" style="text-align:left;">&nbsp;</td>
      <th>Net Total</th>
      <td><?=$netamt?></td>
     </tr>
     </tfoot>
    </table>
    <footer>
     <table class="footer">
      <tr>
       <td style="text-align:left;">Paid By</td>
       <td>Checked By</td>
       <td style="text-align:right;">Receiver's Signature</td>
      </tr>
     </table>
    </footer>
</body>
</html>