<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<style>
    /*@page { size: A5 }*/
    body {
    /* A5 dimensions */
    /*height: 210mm;
    width: 148.5mm;

    margin: 0;*/
    text-align: justify;text-justify: inter-word;
    background:none;
}
/*
header {top: 0; position: fixed;padding-left:50px;padding-right:50px;padding-top:30px;width:93%;}
footer {bottom: 0px; position: fixed;padding-left:50px;padding-right:50px;padding-top:30px;width:93%;}
.container {margin: 0 auto; overflow: auto;}*/

@page { 
    /* switch to landscape */ 
/*   size: landscape; */
   /* set page margins */ 
/*   margin: 0.5cm; */
   /* Default footers */ 
   @bottom-left { 
     content: "Department of Strategy"; 
   } 
   @bottom-right { 
     content: counter(page) " of " counter(pages); 
  }
}

@media print {
       body{
        background:none;

        /*border-top: 8px solid #74a74b;
        border-left: 8px solid #74a74b;
        border-right: 8px solid #74a74b;*/
       }
}
/*margin-top: 100px;margin-bottom: 100px;*/

@page {}
      body {  padding: 2em;margin-left: 30px;margin-left: 50px;margin-bottom: 50px; }
      .header { position: fixed; top: 50px; left: 30px; right: 10px; padding: -0.5em; text-align: center; }
      .footer { position: fixed; bottom: -20px; left: 30px; right: 10px; padding: -0.5em; text-align: center; }
</style>
</head>
<!-- padding:50px; -->
<body style="background-color: white;">
    <?php 
    // builtyno,t.loading_person_name,t.remark,t.lr_freight,t.paid_build,t.quatation_no,t.semi_formal,t.header,t.taxes,t.scope_of_work,t.design_criteria,t.validity_of_offer,t.gst_tax,t.mobile_crane,t.scope_of_unloading,t.intrest_charge,t.cancellation,t.jurisdication,t.documents_provided,t.load_test,t.note,t.price,t.kindattn,t.performance_warranty,t.equipment_acceptance,t.supervision_commissioning,t.training,t.general_safety,t.spare_parts,t.chassis_equipment,t.checked_by,t.dispatch_through,t.ref_details,t.sub_details,t.pakking_forwerding,t.delivery_period,t.payment_terms,t.warranty_guarantee,t.prepare_by,t.ld_clause
      $query=$this->db->query('select t.cdate,l.name as lname,l.mobileno as mobileno,l.emailid as emailid,l.state as state,l.district as district,l.address as partyadd,t.ledger_mobno,t.id,t.tol_freight,t.* from tbl_trans1 t inner join m_ledger l on t.ledger_id=l.id  where t.company_id='.get_cookie('ae_company_id').' and t.id='.$id);
      $partyname="";
      $partymobile="";
      $partyemail="";
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
      $price='';
      $kindattn='';
      $gst_tax='';
      $mobile_crane='';
      $scope_of_unloading='';
      $intrest_charge='';
      $cancellation='';
      $jurisdication='';
      $documents_provided='';
      $load_test='';
      $prepared_by='';


      $payment_terms='';
      $delivery_period='';
      $erection_period='';
      $gst_tax='';
      $scope_of_contract='';
      $proposal_validity='';
      $erection_drw='';
      $specification_changes='';
      $change_in_scope='';
      $our_liablity='';
      $ownership='';
      $performance_warranty='';

      $scope_of_client='';
      $pakking_forwerding='';
      $assumptions_erection='';


      foreach($query->result() as $row)
      {
        $partyname=$row->lname;
        $partymobile=$row->mobileno;
        $partyemail=$row->emailid;

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
        $price=$row->price;
        $kindattn=$row->kindattn;
        $gst_tax=$row->gst_tax;
        $mobile_crane=$row->mobile_crane;
        $scope_of_unloading=$row->scope_of_unloading;
        $intrest_charge=$row->intrest_charge;
        $cancellation=$row->cancellation;
        $jurisdication=$row->jurisdication;
        $documents_provided=$row->documents_provided;
        $load_test=$row->load_test;
        $prepared_by=$row->prepare_by;

        $payment_terms=$row->payment_terms;
        $delivery_period=$row->delivery_period;
        $erection_period=$row->erection_period;
        $gst_tax=$row->gst_tax;
        $scope_of_contract=$row->scope_of_contract;
        $proposal_validity=$row->proposal_validity;
        $erection_drw=$row->erection_drw;
        $specification_changes=$row->specification_changes;
        $change_in_scope=$row->change_in_scope;
        $our_liablity=$row->our_liablity;
        $ownership=$row->ownership;
        $performance_warranty=$row->performance_warranty;

        $scope_of_client=$row->scope_of_client;
        $pakking_forwerding=$row->pakking_forwerding;
        $assumptions_erection=$row->assumptions_erection;



      }
    ?>


<table style="width:100%;">
<thead><tr><th>
  <header style="">
    <img src="<?php echo base_url();?>assets/images/header.jpg" style="height:auto;width: 100%;margin-top: 5%">
    <table border="0" style="width:98%;border-top:2px solid green;padding-bottom: 20px;font-family:poppins;;">
    <tr>
      <td>
      </td>
    </tr>
  </table>
  </header>
</th></tr></thead>
<tbody><tr><td>
  <table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
    <tr>
      <td style="width:3%;text-align:left;font-size:15px;">
        &nbsp;
      </td>
      <td style="width:94%;text-align:left;font-size:17px;font-weight:bold;color: black;">
        PROPOSAL NO : <?php echo $quatation_no;?>
      </td>
      <td style="width:3%;text-align:right;font-size:15px;">
        &nbsp;
      </td>
    </tr>
  </table>
  <pre>


  </pre>

<table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
    <tr style="display: none;">
      <td style="width:50%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
         <?php echo $quatation_no;?>
      </td>
      <td style="width:50%;text-align:right;font-size:13px;color: darkblue;font-weight: bold;">
        Date : <?php echo date('d-m-Y',strtotime($row->cdate));?>
      </td>
    </tr>
    <tr>
      <td style="width:60%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
        <i>To</i>,
      </td>
      <td style="width:40%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
         Offer Date:- <?php echo date('d-m-Y',strtotime($row->cdate));?>
      </td>

    </tr>
    <tr>
      <td style="width:60%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
          <?php echo $partyname;?>
      </td>
      <td style="width:40%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
        Offer No.:- <?php echo $quatation_no;?>
      </td>
    </tr>

    <tr>
      <td style="width:60%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
         <?php echo $partyadd;?>,<?php echo $district;?>,<?php echo $state;?>
      </td>
      <td style="width:40%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
        <?php if ($ref_details!='') { ?>
        Reference:- <?php echo $ref_details;?>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td style="width:60%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
        <!-- Customer -->
      </td>
      <td style="width:40%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
        <?php if ($sub_details!='') { ?>
        Subject:- <?php echo $sub_details;?>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td style="width:60%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
         <?php if ($kindattn!='') { ?>
         Kind Att:- <?php echo $kindattn;?><br>
         <?php } ?>
         Mo. No.:- +91 <?php echo $partymobile;?><br>
         Email I.D.:- <?php echo $partyemail;?>
      </td>
      <td style="width:40%;text-align:left;font-size:13px;color: darkblue;font-weight: bold;">
      </td>
    </tr>

    <tr>
      <td colspan="2" style="width:100%;text-align:left;font-size:13px;font-weight: bold;">
        <br>
        <pre>
        





      </pre>
      </td>
    </tr>
    <tr>
    <td  colspan="2" style="width:100%;text-align:left;font-size:22px;color: darkblue;border:2px solid green;background-color: #ccffeb;">
      
      Proposal for Supply, Fabrication & Erection of Steel
      structural members, Z-sections, C-sections, Profiled
      sheeting & miscellaneous items for your PEB Shed 

    </td>
  </tr>
  <tr>
      <td colspan="2" style="width:100%;text-align:left;font-size:15px;">
        <pre>
                






        </pre>
        <span style="color:black;font-size: 17px;font-weight: bold;margin-top: 100px;"><u>Prepared & Submitted By</u> </span><br>
        <?php echo $prepared_by;?>
       <pre>
                









        </pre>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="width:100%;text-align:left;font-size:15px;text-align: justify;text-justify: inter-word;">
      <div>
        <u style="color:black;font-weight: bold;"> BRIEF INTRO</u> <br><br><br>
         <span>
          About us, we at <b>METALITE INDUSTRIES</b> are an ISO 9001-2015 certified multi-faceted
          engineering company based in Central India. Incepted in the year 2020, we are engaged in
          various engineering activities from design to manufacturing to services in India. Our area of
          expertise is in complete design, manufacture, installation & commissioning of Structural Heavy
          Fabrication & Pre-Engineered Building. 

         </span>
         <br><br><br>
         <span>
          We have a state of art manufacturing facility for complete design to manufacturing, testing &
          dispatch services to cut down dependency on sub-contractors, thus ensuring timely supplies at
          competitive rates.
          </span><br><br><br>
          <span>
          We hope you’ll find our offer in line with your requirement & place your valued PO on us giving us
          an opportunity to serve you. 
          </span><br><br><br>
          <span>
          However, please feel free to contact us for any sort of additional information that you may feel is
          required pertaining to this offer. We assure you our best support at all times!
          </span><br><br><br><br>
          <span style="color:darkblue">
          For Metalite Industries, India 
          </span>
        <pre>
        </pre>
        <?php echo $prepared_by;?>
        <pre>
            











          
        </pre>
      </div>
    </td>
  </tr>

  <?php if ($semi_formal!='') { ?>
  <tr>
    <td colspan="2" style="width:100%;text-align:left;font-size:15px;">
      Dear <?php echo ucwords(strtolower($semi_formal));?>,<br><br>
    </td>
  </tr>
  <?php } ?>
  <?php if ($header!='') { ?>
  <!-- <tr>
    <td colspan="2" style="width:100%;text-align:left;font-size:15px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($header))?><br><br>
    </td>
  </tr> -->
  <?php } ?>
  
  <?php if ($scope_of_work!='') { ?>
  <tr>
    <td colspan="2" style="width:100%;text-align:left;font-size:15px;text-align: justify;text-justify: inter-word;">
      <b><u>Scope of Work</u></b>: <br><?php echo ucwords(strtolower($scope_of_work));?><br><br>
    </td>
  </tr>
  <?php } ?>
  <?php if ($design_criteria!='') { ?>
  <tr>
    <td colspan="2" style="width:100%;text-align:left;font-size:15px;text-align: justify;text-justify: inter-word;">
      <b><u>Design Criteria</u></b>: <?php echo ucwords(strtolower($design_criteria));?><br><br>
    </td>
  </tr>
<?php } ?>
  </table>  

  <table style="width:100%;" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
      <th colspan="6" style="border-left: 1px solid;border-right: 1px solid;border-top:1px solid black;width:100%;text-align:center;font-size:16px;font-weight: bold;">
        COMMERCIAL PRICE PART
      </th>
    </tr>
    <tr>
      <th style="border-left: 1px solid;border-top:1px solid black;border-bottom:1px solid black;width:5%;text-align:center;font-size:15px;">
        S. N. 
      </th>
      <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:50%;text-align:center;font-size:15px;">
        Description
      </th>
      <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:25%;text-align:center;font-size:15px;">
        BLD
      </th>
      <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;font-size:15px;">
        Quantity
      </th>
      <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;font-size:15px;">
        Offer Amount- Rs 
      </th>
      <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;font-size:15px;border-right: 1px solid;">
        Remarks
      </th>
    </tr>
    </thead>
    <tbody>
    <? 
      $query=$this->db->query('select t.item_name as item, t.qtymt, t.item_bld, t.item_remark, t.moc,t.rate, t.freight, t.percent,t.discount,t.remark,t.unit from tbl_trans2 t where  t.billno='.$id  . ' order by t.id');
      $totqty=0;
      $totbox=0;
      $i=0;
      foreach($query->result() as $row)
      {?>
        <tr>
          <td style="border-bottom: 1px solid;border-left: 1px solid;width:5%;text-align:left;font-size:15px;padding:5px;">
            <?php echo $i+1;?>
          </td>
          <td style="border-bottom: 1px solid;border-left:1px solid;width:50%;text-align:left;font-size:16px;padding:5px;">
            <?php echo ucwords(strtolower($row->item));?>
          </td>   
          <td style="border-bottom: 1px solid;border-left:1px solid;width:20%;text-align:left;font-size:15px;padding:5px;">
            <?php echo ucwords(strtolower($row->item_bld));?>
          </td>    
          <td style="border-bottom: 1px solid;border-left:1px solid;width:10%;text-align:left;font-size:15px;padding:5px;">
            <?php echo ucwords(strtolower($row->moc));?>
          </td>                
          <td style="border-bottom: 1px solid;border-left:1px solid;width:10%;text-align:center;font-size:15px;padding:5px;">
            <?php echo number_format($row->rate,2);?>
          </td>
          <td style="border-bottom: 1px solid;border-left:1px solid;width:10%;text-align:left;font-size:15px;padding:5px;border-right: 1px solid;">
            <?php echo ucwords(strtolower($row->item_remark));?>
          </td>  
            
        </tr>
        
    <?$i++;
      }
      if($i<8)
      {
        for($c=0;$c<8-$i;$c++)
        {?>
        <?}
      }
    ?>
    <tr>
      <td colspan="6" style="border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid black;width:100%;text-align:left;font-size:16px;">
         Above mentioned rates are quoted on the basis of inputs received and designed accordingly.<br>
         The above quoted rates are including transportation and excluding GST @ 18%.<br>
         Weight may vary as per actual site conditions and requirement and ±5 on final design. <br>

      </td>
    </tr>
    </tbody>
    </table>
  <h3 style="text-align:center;">COMMERCIAL TERMS & CONDITIONS</h3>
<table style="width:100%;border: 1px solid; margin-top: 20px;" cellpadding="0" cellspacing="0">
  <thead>
    
  <tr>
    <th style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      S. N.
    </th>
    <th style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Item
    </th>
    <th style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;border-right: 0.1px solid grey;">
      Commercial Terms & Conditions
    </th>
  </tr>
  </thead>
  <tbody>
  <?php $i=1;

   if ($payment_terms!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      PAYMENT TERMS
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($payment_terms))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php
   if ($delivery_period!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      DELIVERY PERIOD
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($delivery_period))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php
   if ($erection_period!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      ERECTION PERIOD 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($erection_period))?>
    </td>
  </tr>
  <?php $i++;

   } ?>
 

 <?php
   if ($gst_tax!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      GST 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($gst_tax))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php
   if ($scope_of_contract!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      SCOPE OF CONTRACT 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($scope_of_contract))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php
   if ($proposal_validity!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      PROPOSAL VALIDITY 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($proposal_validity))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php
   if ($erection_drw!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      ERECTION DRW.
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($erection_drw))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php
   if ($specification_changes!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      SPECIFICATION CHANGES
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($specification_changes))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php
   if ($change_in_scope!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      CHANGE IN SCOPE
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($change_in_scope))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php
   if ($our_liablity!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      OUR LIABILITY
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($our_liablity))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php
   if ($ownership!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      OWNERSHIP OF UNAPPROVED MATERIAL AT SITE
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($ownership))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php
   if ($performance_warranty!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      WARRANTY
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($performance_warranty))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


  </tbody>
</table>

<?php 
      $query=$this->db->query('select t.* from q3_rest t where t.billid='.$id);
      $building_no="";
      $building_desc="";
      $building_area="";
      $building_set="";
      $basic_frame_type="";
      $basic_width="";
      $basic_length="";
      $basic_clear_height="";
      $basic_brick_wall="";
      $basic_interior_column="";
      $basic_roof_slope="";
      $basic_bay_spacing="";
      $basic_end_wall="";
      $basic_end_frames="";
      $basic_wind_bracing="";
      $basic_roof_cladding="";
      $basic_wall_cladding="";
      $basic_north_wall="";
      $basic_sorth_wall="";
      $basic_east_wall="";
      $basic_west_wall="";
      $basic_curved_eaves="";
      $basic_gutters="";
      $basic_eave_trim="";
      $basic_downspouts="";
      $standard_location="";
      $standard_framed_openings="";
      $steel_welding="";
      $steel_built_up="";
      $steel_purlins="";
      $steel_profile_sheets="";
      $design_dead_load="";
      $design_live_load="";
      $design_collateral="";
      $design_wind_load="";
      $design_seismic_load="";

       foreach($query->result() as $row)
      {
        $building_no=$row->building_no;
        $building_desc=$row->building_desc;
        $building_area=$row->building_area;
        $building_set=$row->building_set;
        $basic_frame_type=$row->basic_frame_type;
        $basic_width=$row->basic_width;
        $basic_length=$row->basic_length;
        $basic_clear_height=$row->basic_clear_height;
        $basic_brick_wall=$row->basic_brick_wall;
        $basic_interior_column=$row->basic_interior_column;
        $basic_roof_slope=$row->basic_roof_slope;
        $basic_bay_spacing=$row->basic_bay_spacing;
        $basic_end_wall=$row->basic_end_wall;
        $basic_end_frames=$row->basic_end_frames;
        $basic_wind_bracing=$row->basic_wind_bracing;
        $basic_roof_cladding=$row->basic_roof_cladding;
        $basic_wall_cladding=$row->basic_wall_cladding;
        $basic_north_wall=$row->basic_north_wall;
        $basic_sorth_wall=$row->basic_sorth_wall;
        $basic_east_wall=$row->basic_east_wall;
        $basic_west_wall=$row->basic_west_wall;
        $basic_curved_eaves=$row->basic_curved_eaves;
        $basic_gutters=$row->basic_gutters;
        $basic_eave_trim=$row->basic_eave_trim;
        $basic_downspouts=$row->basic_downspouts;
        $standard_location=$row->standard_location;
        $standard_framed_openings=$row->standard_framed_openings;
        $steel_welding=$row->steel_welding;
        $steel_built_up=$row->steel_built_up;
        $steel_purlins=$row->steel_purlins;
        $steel_profile_sheets=$row->steel_profile_sheets;
        $design_dead_load=$row->design_dead_load;
        $design_live_load=$row->design_live_load;
        $design_collateral=$row->design_collateral;
        $design_wind_load=$row->design_wind_load;
        $design_seismic_load=$row->design_seismic_load;

      }

      ?>


 <h3 style="text-align:center;">SCOPE OF SUPPLY</h3>
 <h4>BRIEF DETAILS</h4>
<table style="width:100%;border: 1px solid; margin-top: 20px;" cellpadding="0" cellspacing="0">
  <!-- <thead>
    
  <tr>
    <th style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      S. N.
    </th>
    <th style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Item
    </th>
    <th style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;border-right: 0.1px solid grey;">
      Commercial Terms & Conditions
    </th>
  </tr>
  </thead> -->
  <tbody>
  <?php $i=1;

   if ($building_no!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      BUILDING NO.
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($building_no))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($building_desc!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      BUILDING DESCRIPTION
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($building_desc))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($building_area!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      BUILDING AREA (SQM) 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($building_area))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($building_set!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      QUANTITY
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($building_set))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

     </tbody>
</table>


 <h4>BASIC BUILDING DESCRIPTION </h4>
<table style="width:100%;border: 1px solid; margin-top: 20px;" cellpadding="0" cellspacing="0">
  <thead>
    
  <tr>
    <th style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      S. N.
    </th>
    <th style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      DESCRIPTION 
    </th>
    <th style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;border-right: 0.1px solid grey;">
      Canopy * Staircase
    </th>
  </tr>
  </thead> 
  <tbody>
  <?php $i=1;

   if ($basic_frame_type!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Frame Type 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_frame_type))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($basic_width!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Width (M) 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_width))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($basic_length!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Length (M) 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_length))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($basic_clear_height!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Clear Height (M) 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_clear_height))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_brick_wall!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Brick wall Height (M)  
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_brick_wall))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_interior_column!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Interior column spacing (m)
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_interior_column))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_roof_slope!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Roof slope 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_roof_slope))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_bay_spacing!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Bay spacing (m)
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_bay_spacing))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_end_wall!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      End wall column Spacing (m)
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_end_wall))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_end_frames!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Type of end frames 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_end_frames))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_wind_bracing!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Wind bracing 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_wind_bracing))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_roof_cladding!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Roof cladding
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_roof_cladding))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_wall_cladding!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Wall cladding  
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_wall_cladding))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_north_wall!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Openings at North wall 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_north_wall))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_sorth_wall!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Openings at South wall 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_sorth_wall))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($basic_east_wall!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Openings at East wall
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_east_wall))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_west_wall!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Openings at West wall
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_west_wall))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_curved_eaves!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Curved eaves
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_curved_eaves))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_gutters!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Gutters
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_gutters))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

   <?php 

   if ($basic_eave_trim!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Eave trim
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_eave_trim))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($basic_downspouts!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Downspouts 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($basic_downspouts))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

     </tbody>
</table>


 <h4>STANDARD BUILDING ADDITIONS [CANOPY / FASCIA / LINER / PARTITIONS]  </h4>
<table style="width:100%;border: 1px solid; margin-top: 20px;" cellpadding="0" cellspacing="0">
  <thead>
    
  <tr>
    <th style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      S. N.
    </th>
    <th style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      DESCRIPTION 
    </th>
    <th style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;border-right: 0.1px solid grey;">
      PEB Shed
    </th>
  </tr>
  </thead> 
  <tbody>
  <?php $i=1;

   if ($standard_location!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Canopy– location / description 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($standard_location))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($standard_framed_openings!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Framed Openings  
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($standard_framed_openings))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


        </tbody>
</table>



 <h4>STEEL WORK FINISH  </h4>
<table style="width:100%;border: 1px solid; margin-top: 20px;" cellpadding="0" cellspacing="0">
  <thead>
    
  <tr>
    <th style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      S. N.
    </th>
    <th style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      DESCRIPTION 
    </th>
    <th style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;border-right: 0.1px solid grey;">
      PEB Shed
    </th>
  </tr>
  </thead> 
  <tbody>
  <?php $i=1;

   if ($steel_welding!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      WELDING 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($steel_welding))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($steel_built_up!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Frames, Built-Up / HR sections/Bracings  
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($steel_built_up))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($steel_purlins!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Purlins / Girts 
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($steel_purlins))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($steel_profile_sheets!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Profile Sheets  
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($steel_profile_sheets))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

  </tbody>
</table>

 <h4>DESIGN LOADS  </h4>
<table style="width:100%;border: 1px solid; margin-top: 20px;" cellpadding="0" cellspacing="0">
  <thead>
    
  <tr>
    <th style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      S. N.
    </th>
    <th style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      DESCRIPTION 
    </th>
    <th style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;border-right: 0.1px solid grey;">
      PEB Shed
    </th>
  </tr>
  </thead> 
  <tbody>
  <?php $i=1;

   if ($design_dead_load!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Dead load  
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($design_dead_load))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($design_live_load!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      live load  
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($design_live_load))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($design_collateral!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Collateral Load
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($design_collateral))?>
    </td>
  </tr>
  <?php $i++;

   } ?>


   <?php 

   if ($design_wind_load!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Wind load (Kmph or m/sec)   
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($design_wind_load))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

    <?php 

   if ($design_seismic_load!='') { ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i?>
    </td>
    <td style="width:25%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Seismic load (zone no.)   
    </td>
    <td style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      <?php echo ucwords(strtolower($design_seismic_load))?>
    </td>
  </tr>
  <?php $i++;

   } ?>

  </tbody>
</table>


  <h3 style="text-align:center;">APPLICABLE CODES</h3>
 <p> MEPL Steel Buildings are designed applying & complying to the following codes:</p>
<p>1. Frame members are designed in accordance with AISC-LRFD ( American Institute of Steel Construction)</p>
<p>2. Cold Formed members are designed in accordance with the AISI For Use Of Cold-Formed Light Gauge
Steel Structural Member’s In General Building Construction “</p>
<p>3. Deflection as per MBMA</p>
<p>4. All welding is done in accordance with the 2000 Edition of the American Welding Society (AWS D1.1)</p>
<p>5. Structural Welding Code-Steel. All Welders are qualified for the type of welds performed.</p>
<p>6. Manufacturing dimensional tolerances are in accordance with the requirements of the 1996 Edition of
the Metal Building Manufacturer Association (MBMA)of the USA.;” Low rise building systems Manual”. </p>

  <h3 style="text-align:center;">EXCLUSIONS</h3>
<p>1. Supply of Insert plates/Shim plates/Embedded plates in Concrete </p>
<p>2. Any Doors, Stainless steel works & Glazing works & supporting sub frame systems for
Glazing, Civil work</p>

 <h3 style="text-align:center;">PRODUCT STANDARD CODES</h3>
<!-- <h4>DESIGN LOADS  </h4> -->
<table style="width:100%;border: 1px solid; margin-top: 20px;" cellpadding="0" cellspacing="0">
  <thead>
    
  <tr>
    <th style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      S. N.
    </th>
    <th style="width:50%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      STRUCTURAL COMPONENTS 
    </th>
    <th style="width:15%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      -
    </th>
    <th style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;border-right: 0.1px solid grey;">
      CODES
    </th>
  </tr>
  </thead> 
  <tbody>
    <?php $i=1; ?>
  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i++;?>
    </td>
    <td style="width:50%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Built up sections ( SAIL, JINDAL,JSW,BUSHANTATA) 
    </td>
    <td style="width:15%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      -  
    </td>
    <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      IS 2062 :2011, E350 A
    </td>
  </tr>

  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i++;?>
    </td>
    <td style="width:50%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Hot Rolled Sections ( RINL, SANVIJAY, SAIL)  
    </td>
    <td style="width:15%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Channels<br>Angles<br>Pipes
    </td>
    <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      IS: 2062 / a 572, Grade 36, Min. Y.S. 250 MPA<br>IS: 2062 / a 572, Grade 36, Min. Y.S. 250 MPA<br>IS: 1161, IS: 1239 / A 572, Grade 36, Min. Y.S. 250 MPA 
    </td>
  </tr>

  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i++;?>
    </td>
    <td style="width:50%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      ‘Z & C” Section Purlins/Girts made out of high strength Galvanized 
    </td>
    <td style="width:15%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Cold form 
    </td>
    <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      ASTM 653, Min. Y.S. 345 MPA 120 GSM
    </td>
  </tr>

  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i++;?>
    </td>
    <td style="width:50%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Bare Galvalume Sheets – 0.47 mm thk ( JSW, BUSHAN, UTTAM ) 
    </td>
    <td style="width:15%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Roof
    </td>
    <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      ASTM A 792 M, Minimum Y.S. 550 MPA, AZ70
    </td>
  </tr>

  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i++;?>
    </td>
    <td style="width:50%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Colour coated Galvalume Sheets -0.5 mm thk ( JSW, BUSHAN, UTTAM , AM-NS) 
    </td>
    <td style="width:15%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;"> Cladding  
    </td>
    <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      ASTM A 792 M, Minimum Y.S. 550 MPA, AZ 70
    </td>
  </tr>

  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i++;?>
    </td>
    <td style="width:50%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Anchor bolts
    </td>
    <td style="width:15%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      -  
    </td>
    <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      IS 2062 E250A.
    </td>
  </tr>

  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i++;?>
    </td>
    <td style="width:50%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Primary Connection bolts Electroplated/ Pre galvanised 
    </td>
    <td style="width:15%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      -  
    </td>
    <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      High Strength Bolts, IS: 1367 / 8.8 Grade or ASTM A325 
    </td>
  </tr>

  <tr>
    <td style="width:5%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      <?=$i++;?>
    </td>
    <td style="width:50%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      Secondary connection bolts Pre galvanised  
    </td>
    <td style="width:15%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;">
      -  
    </td>
    <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;border-right: 0.1px solid grey;font-size:15px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
      Bolt as per ASTM A 325, Grade 4.6 
    </td>
  </tr>


  </tbody>
</table>

  <p>Painting process for Primary & Secondary members to be followed as mentioned below:-</p>
  <p> Primer and Finish Paint : 1 coats of red oxide paint of 25-30 micron over one coat of Synthetic enamel finish of 25-
30 microns of approved make Berger / Shalimar/ Asian or dtm paints</p>
  <p> Connection bolts-Auto black/ electroplated /Pre-galvanised.</p>
  <p> Surface Preparation – Mechanical Cleaning </p>

  <h3 style="text-align:center;">DRAWING & DELIVERY</h3>

  <p>1. Preliminary column reactions & Centre line/Anchor bolt diagram for the design of Foundations will be submitted
within one week from the date of signing contract/ Purchase Order and receipt of advance payment.</p>
<p>2. MI will issue Approval Drawings within 1 week from date of signing contract/issue of Purchase Order and receipt
of advance payment.</p>
<p>3. BUYER must return the accepted approval drawings preferably within 1 week thereafter; otherwise, may result in
revision to delivery commitment.</p>
<p>4. Anchor bolts & Layout drawings for fixing anchor bolts will be provided within 10 days from the date of receipt of
Signed approval drawings.</p>
<p>5. Dispatch of materials will start within 15days from the date of receipt of signed Approval drawings with receipt of
payment as per agreed terms whichever is later.</p>

<h3 style="text-align:center;">ERECTION – ASSUMPTION & SCOPES </h3>

<table>
<?php if ($assumptions_erection!='') { ?>
  <tr>
    <td colspan="1" style="width:100%;text-align:left;font-size:18px;text-align: justify;text-justify: inter-word;">
      Assumptions made for Erection
    </td>
  </tr>
  <tr>
    <td colspan="1" style="width:100%;text-align:left;font-size:15px;text-align: justify;text-justify: inter-word;">
      <?php echo $assumptions_erection;?>
    </td>
  </tr>
<?php } ?>
<tr>
    <td colspan="1" style="width:100%;text-align:left;font-size:18px;text-align: justify;text-justify: inter-word;">
      &nbsp;
    </td>
  </tr>

<?php if ($pakking_forwerding!='') { ?>
  <tr>
    <td colspan="1" style="width:100%;text-align:left;font-size:18px;text-align: justify;text-justify: inter-word;">
      Scope of Work for Contractor
    </td>
  </tr>
  <tr>
    <td colspan="1" style="width:100%;text-align:left;font-size:15px;text-align: justify;text-justify: inter-word;">
      <?php echo $pakking_forwerding;?>
    </td>
  </tr>
<?php } ?>
<tr>
    <td colspan="1" style="width:100%;text-align:left;font-size:18px;text-align: justify;text-justify: inter-word;">
      &nbsp;
    </td>
  </tr>
<?php if ($scope_of_client!='') { ?>
  <tr>
    <td colspan="1" style="width:100%;text-align:left;font-size:18px;text-align: justify;text-justify: inter-word;">
      Scope of Client
    </td>
  </tr>
  <tr>
    <td colspan="1" style="width:100%;text-align:left;font-size:15px;text-align: justify;text-justify: inter-word;">
      <?php echo $scope_of_client;?>
    </td>
  </tr>
<?php } ?>
  </table> 

  <h3 style="text-align:center;">XXXXXXXXXX</h3> 
 
  </td></tr></tbody>
<tfoot><tr><td>
  <div style="padding-top:70px;padding-left:50px;padding-right:50px;">
    <img src="<?php echo base_url();?>assets/images/footer.jpg" style="height:auto;width: 88%;margin-left:50px;margin-right:50px;">
  </div>
</td></tr></tfoot>
</table>
<!--   <div style="padding-top:50px;padding-left:50px;padding-right:50px;">
    <img src="<?php echo base_url();?>assets/images/footer.jpg" style="height:auto;width: 100%;margin-bottom: 0px;position: fixed;left: 0;bottom: 0;">
  </div> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery.min.js'>" + "<" + "/script>");
    </script>

      <script type="text/javascript">
        $(document).ready(function(){
          // window.print();
        });
      </script>
</body>
</html>