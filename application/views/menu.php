<div id="sidebar" class="sidebar responsive">
	<script type="text/javascript">
	    try { ace.settings.check('sidebar', 'fixed') } catch (e) { }
	</script>

	<?php 
		$user_id=get_cookie('ae_user_id');
		$query=$this->db->query('select form_id,p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.'');
    ?>


	<ul class="nav nav-list">
		<li class="active">
			<a href="#" onclick="LoadForm('Dashboard');">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text"> Sales </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
			<!--start new menu add-->
			
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Quotation")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Quotation');">
									<i class="menu-icon fa fa-caret-right"></i>
									Quotation
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Customer Purchase Order")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Customer Purchase Order');">
									<i class="menu-icon fa fa-caret-right"></i>
									Customer Purchase Order
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
		</ul>
	</li>
        

		<li class="">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text"> Production  </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
			<!--start new menu add-->
			
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Jobcard")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Jobcard');">
									<i class="menu-icon fa fa-caret-right"></i>
									Jobcard
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Requisition Slip")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Requisition Slip');">
									<i class="menu-icon fa fa-caret-right"></i>
									Requisition Slip
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
		</ul>
	</li>


		<li class="">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text"> Purchase Order </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
			<!--start new menu add-->
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Purchase")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Purchase');">
									<i class="menu-icon fa fa-caret-right"></i>
								Purchase
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Work Order")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Work Order');">
									<i class="menu-icon fa fa-caret-right"></i>
								Work Order
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
			
		</ul>
	</li>

	<li class="">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text"> Accounts </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
			<!--start new menu add-->
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Invoice")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Invoice');">
									<i class="menu-icon fa fa-caret-right"></i>
								Invoice
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Voucher")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Voucher');">
									<i class="menu-icon fa fa-caret-right"></i>
									Voucher
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Receipt")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Receipt');">
									<i class="menu-icon fa fa-caret-right"></i>
									Receipt
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
			
		</ul>
	</li>
		<li class="" style="display:none;">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text"> TRANSACTION </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
			<!--start new menu add-->
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="PURCHASE ORDER TO SUPPLIER")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('PURCHASE ORDER TO SUPPLIER');">
									<i class="menu-icon fa fa-caret-right"></i>
									PURCHASE ORDER TO SUPPLIER
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
			
		    
		    
		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Sales Return")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Sales Return');">
									<i class="menu-icon fa fa-caret-right"></i>
									Sales Return
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Receipt")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Receipt');">
									<i class="menu-icon fa fa-caret-right"></i>
									Receipt
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
            
            <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Purchase")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Purchase');">
									<i class="menu-icon fa fa-caret-right"></i>
								Purchase
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    


            <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Purchase Return")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Purchase Return');">
									<i class="menu-icon fa fa-caret-right"></i>
								Purchase Return
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
            <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Payment")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Payment');">
									<i class="menu-icon fa fa-caret-right"></i>
								Payment
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Cr Note")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Cr Note');">
									<i class="menu-icon fa fa-caret-right"></i>
								Cr Note
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Dr Note")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Dr Note');">
									<i class="menu-icon fa fa-caret-right"></i>
								Dr Note
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Chalan")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Chalan');">
									<i class="menu-icon fa fa-caret-right"></i>
								Chalan
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Chalan")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Chalan Return');">
									<i class="menu-icon fa fa-caret-right"></i>
								Chalan Return
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Chalan Purchase")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Chalan Purchase');">
									<i class="menu-icon fa fa-caret-right"></i>
								Chalan Purchase
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Pending LR Entry")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Pending LR Entry');">
									<i class="menu-icon fa fa-caret-right"></i>
								Pending LR Entry
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Pending LR Entry")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Pending LR Return');">
									<i class="menu-icon fa fa-caret-right"></i>
								Pending LR Return
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Send Challan SMS")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Send Challan SMS');">
									<i class="menu-icon fa fa-caret-right"></i>
								Send Challan SMS
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>


		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Order")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Order');">
									<i class="menu-icon fa fa-caret-right"></i>
								Order
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

           	<!--end new menu add-->
				

			</ul>
		</li>
       

		<li class="">
				<a href="#" class="menu">
					<i class="menu-icon fa fa-list"></i>
					<span class="menu-text"> REPORTS </span>

					<b class="arrow fa fa-angle-down"></b>
				</a>

				<b class="arrow"></b>

				<ul class="submenu">


				<?php 
		          	foreach($query->result() as $row)
		          	{
		          		if($row->form_id=="Quotation Report")
		          		{
			          		$p_entry=$row->p_entry;
			          		$p_modify=$row->p_modify;
			          		$p_delete=$row->p_delete;
			          		$p_list=$row->p_list;
			          		$p_bdate=$row->p_bdate;

			    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
			    			{?>
				                <li class="">
									<a href="#" onclick="LoadForm('Quotation Report');">
										<i class="menu-icon fa fa-caret-right"></i>
									Quotation Report
									</a>
									<b class="arrow"></b>
								</li>
							 <? }
		          		}
		            }
			    ?>

			    <?php 
		          	foreach($query->result() as $row)
		          	{
		          		if($row->form_id=="Invoice Report")
		          		{
			          		$p_entry=$row->p_entry;
			          		$p_modify=$row->p_modify;
			          		$p_delete=$row->p_delete;
			          		$p_list=$row->p_list;
			          		$p_bdate=$row->p_bdate;

			    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
			    			{?>
				                <li class="">
									<a href="#" onclick="LoadForm('Invoice Report');">
										<i class="menu-icon fa fa-caret-right"></i>
									Invoice Report
									</a>
									<b class="arrow"></b>
								</li>
							 <? }
		          		}
		            }
			    ?>

			    <?php 
		          	foreach($query->result() as $row)
		          	{
		          		if($row->form_id=="Purchase Report")
		          		{
			          		$p_entry=$row->p_entry;
			          		$p_modify=$row->p_modify;
			          		$p_delete=$row->p_delete;
			          		$p_list=$row->p_list;
			          		$p_bdate=$row->p_bdate;

			    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
			    			{?>
				                <li class="">
									<a href="#" onclick="LoadForm('Purchase Report');">
										<i class="menu-icon fa fa-caret-right"></i>
									Purchase Report
									</a>
									<b class="arrow"></b>
								</li>
							 <? }
		          		}
		            }
			    ?>

			    <?php 
		          	foreach($query->result() as $row)
		          	{
		          		if($row->form_id=="Jobcard Report")
		          		{
			          		$p_entry=$row->p_entry;
			          		$p_modify=$row->p_modify;
			          		$p_delete=$row->p_delete;
			          		$p_list=$row->p_list;
			          		$p_bdate=$row->p_bdate;

			    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
			    			{?>
				                <li class="">
									<a href="#" onclick="LoadForm('Jobcard Report');">
										<i class="menu-icon fa fa-caret-right"></i>
									Jobcard Report
									</a>
									<b class="arrow"></b>
								</li>
							 <? }
		          		}
		            }
			    ?>

			    <?php 
		          	foreach($query->result() as $row)
		          	{
		          		if($row->form_id=="Requisition Report")
		          		{
			          		$p_entry=$row->p_entry;
			          		$p_modify=$row->p_modify;
			          		$p_delete=$row->p_delete;
			          		$p_list=$row->p_list;
			          		$p_bdate=$row->p_bdate;

			    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
			    			{?>
				                <li class="">
									<a href="#" onclick="LoadForm('Requisition Report');">
										<i class="menu-icon fa fa-caret-right"></i>
									Requisition Report
									</a>
									<b class="arrow"></b>
								</li>
							 <? }
		          		}
		            }
			    ?>


			    <?php 
		          	foreach($query->result() as $row)
		          	{
		          		if($row->form_id=="Voucher Report")
		          		{
			          		$p_entry=$row->p_entry;
			          		$p_modify=$row->p_modify;
			          		$p_delete=$row->p_delete;
			          		$p_list=$row->p_list;
			          		$p_bdate=$row->p_bdate;

			    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
			    			{?>
				                <li class="">
									<a href="#" onclick="LoadForm('Voucher Report');">
										<i class="menu-icon fa fa-caret-right"></i>
									Voucher Report
									</a>
									<b class="arrow"></b>
								</li>
							 <? }
		          		}
		            }
			    ?>
			</ul>
		</li>



		<li class=""  style="display:none;">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text"> DAILY REPORTS </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">


			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Day Book")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Day Book');">
									<i class="menu-icon fa fa-caret-right"></i>
								Day Book
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Daily Report Checking")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Daily Report Checking');">
									<i class="menu-icon fa fa-caret-right"></i>
								Daily Report Checking
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Daily Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Daily Report');">
									<i class="menu-icon fa fa-caret-right"></i>
								Daily Report
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

			
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="RG Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('RG Report');">
									<i class="menu-icon fa fa-caret-right"></i>
								    RG Report
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>
		    
		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Receipt Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('Receipt Report');">
									<i class="menu-icon fa fa-caret-right"></i>
								    Receipt Report
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="DrNote Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('DrNote Report');">
									<i class="menu-icon fa fa-caret-right"></i>
								    DrNote Report
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="CrNote Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('CrNote Report');">
									<i class="menu-icon fa fa-caret-right"></i>
								    CrNote Report
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Daily Freight Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('Daily Freight Report');">
									<i class="menu-icon fa fa-caret-right"></i>
								    Daily Freight Report
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

			</ul>
		</li>






		<li class="" style="display:none;">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text"> ACCOUNT REPORTS </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">


		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ledger Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('Ledger Report');">
									<i class="menu-icon fa fa-caret-right"></i>
								    Ledger Report
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>


		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ledger Report-Normal")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('Ledger Report-Normal');">
									<i class="menu-icon fa fa-caret-right"></i>
								    Ledger Report-Normal
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ledger Report-Multiple")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('Ledger Report-Multiple');">
									<i class="menu-icon fa fa-caret-right"></i>
								    Ledger Report-Multiple
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ledger Report-Line Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('Ledger Report-Line Wise');">
									<i class="menu-icon fa fa-caret-right"></i>
								    Ledger Report-Line Wise
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Line Summary")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('Line Summary');">
									<i class="menu-icon fa fa-caret-right"></i>
								    Line Summary
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Salesman Wise Summary")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			               <li class="">
								<a href="#" onclick="LoadForm('Salesman Wise Summary');">
									<i class="menu-icon fa fa-caret-right"></i>
								   Salesman Wise Report
								</a>

								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>


		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ageing Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Ageing Report');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Ageing Report
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ageing Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Ageing Report-State Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Ageing Report-State Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ageing Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Ageing Report-Line Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Ageing Report-Line Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

			</ul>
		</li>




		<li class=""  style="display:none;">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text"> STOCK REPORTS </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">



		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Stock Report Detail")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Stock Report Detail');">
									<i class="menu-icon fa fa-caret-right"></i>
								Stock Report Detail
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Stock Re-Order Detail")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Stock Re-Order Detail');">
									<i class="menu-icon fa fa-caret-right"></i>
								Stock Re-Order Detail
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Stock Report Damage")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Stock Report Damage');">
									<i class="menu-icon fa fa-caret-right"></i>
								Stock Report Damage
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>


			</ul>
		</li>




		<li class="" style="display:none;">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text"> SALES REPORTS </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">




			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Sales-Item Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			              <li class="">
							<a href="#" onclick="LoadForm('Sales-Item Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Sales-Item Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>	

			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Sales-Item Ledger")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			              <li class="">
							<a href="#" onclick="LoadForm('Sales-Item Ledger');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Sales-Item Ledger
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>	
			
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Sales-Category Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			              <li class="">
							<a href="#" onclick="LoadForm('Sales-Category Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Sales-Category Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>	


			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Sales-Master Category Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			              <li class="">
							<a href="#" onclick="LoadForm('Sales-Master Category Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Sales-Master Category Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>	

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Sales-Group Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Sales-Group Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Sales-Group Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Sales-Brand Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Sales-Brand Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Sales-Brand Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Value Wise Sales of Customer")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			              <li class="">
							<a href="#" onclick="LoadForm('Value Wise Sales of Customer');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Value Wise Sales of Customer
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>	
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Qty Item Wise Sales Summary")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			              <li class="">
							<a href="#" onclick="LoadForm('Qty Item Wise Sales Summary');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Qty Item Wise Sales Summary
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>	
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Group Wise Sales Summary")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			              <li class="">
							<a href="#" onclick="LoadForm('Group Wise Sales Summary');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Group Wise Sales Summary
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>	

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Pending Order Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			              <li class="">
							<a href="#" onclick="LoadForm('Pending Order Report');">
								<i class="menu-icon fa fa-caret-right"></i>
							   	Pendng Order Report
							</a>
							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>	




			</ul>
		</li>


		<li class=""  style="display:none;">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text"> PURCHASE REPORTS </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">




		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Purchase-Category Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Purchase-Category Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Purchase-Category Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Purchase-Master Category Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Purchase-Master Category Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Purchase-Master Category Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
			
		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Purchase-Group Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Purchase-Group Wise');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Purchase-Group Wise
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>


			</ul>
		</li>



		<li class="" style="display:none;">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text"> OTHER REPORTS </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">


		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Discount Report")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Discount Report');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Discount Report
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Scanner Option")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Scanner Option');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Scanner Option
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
				
			             <li class="">
							<a href="#" onclick="LoadForm('Rate Difference');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Rate Difference
							</a>

							<b class="arrow"></b>
						</li>

			             <li class="">
							<a href="#" onclick="LoadForm('Amount Difference');">
								<i class="menu-icon fa fa-caret-right"></i>
							    Amount Difference
							</a>

							<b class="arrow"></b>
						</li>

			</ul>
		</li>


        
		<li class="">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-pencil-square-o"></i>
				<span class="menu-text"> MASTERS </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Customer Master")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Customer Master');">
								<i class="menu-icon fa fa-caret-right"></i>
								Customer Master
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Supplier Master")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Supplier Master');">
								<i class="menu-icon fa fa-caret-right"></i>
								Supplier Master
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ledger Opening")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Ledger Opening');">
								<i class="menu-icon fa fa-caret-right"></i>
								Ledger Opening
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ledger Mobile No.")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Ledger Mobile No.');">
								<i class="menu-icon fa fa-caret-right"></i>
								Ledger Mobile No.
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

			

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Ledger Group")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			            <li class="">
							<a href="#" onclick="LoadForm('Ledger Group');">
								<i class="menu-icon fa fa-caret-right"></i>
								Ledger Group
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Area/Line Master")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Area/Line Master');">
								<i class="menu-icon fa fa-caret-right"></i>
								Area/Line Master
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
			
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Item")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			            <li class="">
							<a href="#" onclick="LoadForm('Item');">
								<i class="menu-icon fa fa-caret-right"></i>
								Item
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Item Category")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			            <li class="">
							<a href="#" onclick="LoadForm('Item Category');">
								<i class="menu-icon fa fa-caret-right"></i>
								Item Category
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
			
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Item Master Category")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('Item Master Category');">
								<i class="menu-icon fa fa-caret-right"></i>
								Item Master Category
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Item Group")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('Item Group');">
								<i class="menu-icon fa fa-caret-right"></i>
								Item Group
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Item Brand")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('Item Brand');">
								<i class="menu-icon fa fa-caret-right"></i>
								Item Brand
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="State Master")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('State Master');">
								<i class="menu-icon fa fa-caret-right"></i>
								State Master
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="District")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('District');">
								<i class="menu-icon fa fa-caret-right"></i>
								District
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
				
				
				
		<!--		<li class="">
					<a href="#" onclick="LoadForm('Party Wise Rate');">
						<i class="menu-icon fa fa-caret-right"></i>
						Party Wise Rate
					</a>

					<b class="arrow"></b>
				</li> -->
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Party Wise Discount")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('Party Wise Discount');">
								<i class="menu-icon fa fa-caret-right"></i>
								Party Wise Discount
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>


			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Price List State Wise")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('Price List');">
								<i class="menu-icon fa fa-caret-right"></i>
								Price List
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Content Master")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			             <li class="">
							<a href="#" onclick="LoadForm('Content Master');">
								<i class="menu-icon fa fa-caret-right"></i>
								Content Master
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Period Wise SD")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('Period Wise SD');">
								<i class="menu-icon fa fa-caret-right"></i>
								Period Wise SD
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
				
				
				
				<!-- <li class="">
					<a href="#" onclick="LoadForm('Source');">
						<i class="menu-icon fa fa-caret-right"></i>
						Source
					</a>

					<b class="arrow"></b>
				</li> -->
				<!-- <li class="">
					<a href="#" onclick="LoadForm('Destination');">
						<i class="menu-icon fa fa-caret-right"></i>
						Destination
					</a>

					<b class="arrow"></b>
				</li> -->
				 


			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="POS Location")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('POS Location');">
								<i class="menu-icon fa fa-caret-right"></i>
								POS Location
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Salesman")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('Salesman');">
								<i class="menu-icon fa fa-caret-right"></i>
								Salesman
							</a>
							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

				<!-- <li class="">
					<a href="#" onclick="LoadForm('Godown');">
						<i class="menu-icon fa fa-caret-right"></i>
						Godown
					</a>

					<b class="arrow"></b>
				</li> -->
				<!-- <li class="">
					<a href="#" onclick="LoadForm('District');">
						<i class="menu-icon fa fa-caret-right"></i>
						District
					</a>

					<b class="arrow"></b>
				</li> -->

			</ul>
		</li>

		<li class="">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text"> Employee </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
			<!--start new menu add-->
			
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Employee Registration")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Employee Registration');">
									<i class="menu-icon fa fa-caret-right"></i>
									Employee Registration
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Employee Attendance")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			                <li class="">
								<a href="#" onclick="LoadForm('Employee Attendance');">
									<i class="menu-icon fa fa-caret-right"></i>
									Employee Attendance
								</a>
								<b class="arrow"></b>
							</li>
						 <? }
	          		}
	            }
		    ?>

		    
		</ul>
	</li>
        
		<li class="">
			<a href="#" class="menu">
				<i class="menu-icon fa fa-tag"></i>
				<span class="menu-text"> OTHER</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<!-- <li class="">
					<a href="#" onclick="LoadForm('Order List Live');">
						<i class="menu-icon fa fa-caret-right"></i>
					    Pending Orders Live
					</a>

					<b class="arrow"></b>
				</li> -->
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Company")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('Company');">
								<i class="menu-icon fa fa-caret-right"></i>
								Company
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
				
				<li class="" style="display:none;">
					<a href="#" class='menu'>
						<i class="menu-icon fa fa-caret-right"></i>
						Maintenance
					</a>

					<ul class="submenu">
					<!--start new menu add-->
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Maintenance")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('Maintenance');">
								<i class="menu-icon fa fa-caret-right"></i>
								Ledger Maintenance
							</a>
							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Party Delete")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           
		                <li class="">
							<a href="#"  onclick="LoadForm('Party Delete');">
								<i class="menu-icon fa fa-caret-right"></i>
								Party Delete
							</a>
							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="All Delete")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           
		                <li class="">
							<a href="#"  onclick="LoadForm('All Delete');">
								<i class="menu-icon fa fa-caret-right"></i>
								All Delete
							</a>
							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
		                
		               
		                
					</ul>

					<b class="arrow"></b>
				</li>

			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Database Backup")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           
		                <li class="">
							<a href="#" onclick="LoadForm('Database Backup');">
								<i class="menu-icon fa fa-caret-right"></i>
								Database Backup
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="Company Split")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           
		                <li class="">
							<a href="#" onclick="LoadForm('Company Split');">
								<i class="menu-icon fa fa-caret-right"></i>
								Company Split
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
			
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="User Management")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           
		               <li class="">
							<a href="#" onclick="LoadForm('User Add');">
								<i class="menu-icon fa fa-caret-right"></i>
								User Add
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="User Management")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           
		               <li class="">
							<a href="#" onclick="LoadForm('User List');">
								<i class="menu-icon fa fa-caret-right"></i>
								User List
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="User Permission")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           
		               <li class="">
							<a href="#" onclick="LoadForm('User Permission');">
								<i class="menu-icon fa fa-caret-right"></i>
								User Permission
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

		    <?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="User Permission Form")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           
		               <li class="">
							<a href="#" onclick="LoadForm('User Permission Form');">
								<i class="menu-icon fa fa-caret-right"></i>
								User Permission Form
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>

				
			<?php 
	          	foreach($query->result() as $row)
	          	{
	          		if($row->form_id=="SMS Setting")
	          		{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;

		    			if($p_entry==1 || $p_modify==1 || $p_delete==1 || $p_list==1 || $p_bdate==1)
		    			{?>
			           <li class="">
							<a href="#" onclick="LoadForm('SMS Setting');">
								<i class="menu-icon fa fa-caret-right"></i>
								SMS Setting
							</a>

							<b class="arrow"></b>
						</li>
						 <? }
	          		}
	            }
		    ?>
				
				
				<li class="">
					<a href="#">
						<i class="menu-icon fa fa-caret-right"></i>
						-
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		

	</ul><!-- /.nav-list -->

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<script type="text/javascript">
	    try { ace.settings.check('sidebar', 'collapsed') } catch (e) { }
	</script>
</div>

