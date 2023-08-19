<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class login extends CI_Controller {
	
	    function __construct() {
	        parent::__construct();
	        $this->load->helper('common_helper');
	    }
	
	    function index() {
	    	$username=get_cookie('ae_username');
//	    	if($username=='')
//	    	{
		        $this->load->view('login');
//	    	}
//	    	else{
//	    		$this->session->set_userdata('username',$username);
//		        $this->load->view('dashboard');
//	    	}
	    }

	    function checklogin(){
			date_default_timezone_set('Asia/Kolkata');

	    	$username= $this->input->get('UserName');
	    	$password= $this->input->get('Password');
	    	$password=md5($password);
	    	$user_ip='';
	    	$back_date='';
	    	$mobile1="";
	    	$mobile2="";
	    	$mobile3="";
	    	$otp="";
	    	$sql ="select * from m_user where username='$username' and password='$password'";
	    	$query = $this->db->query($sql);
	    	$result = $query->result();
	    	$usertype='';
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
	    			$usertype=$row->type;
	    			$user_id=$row->id;
	    			$userpermission=$row->permission;
	    			$user_ip=$row->ip_address;
	    			$back_date=$row->back_date;
	    			$mobile1=$row->mobile1;
	    			$mobile2=$row->mobile2;
	    			$mobile3=$row->mobile3;
	    			$otp=$row->otp;
	    			$this->session->set_userdata('uid',$row->id);
	    		}

	    		if($mobile1!="" || $mobile2!="" || $mobile3!="")
	    		{
	    			$mobilenosms="";
	    			if($mobile1!="")
	    			{
	    				if($mobilenosms!="")
	    				{
			    			$mobilenosms=",".$mobile1;
	    				}
	    				else
	    				{
			    			$mobilenosms=$mobile1;
	    				}
	    			}
	    			if($mobile2!="")
	    			{
	    				if($mobilenosms!="")
	    				{
			    			$mobilenosms=$mobilenosms.",".$mobile2;
	    				}
	    				else
	    				{
			    			$mobilenosms=$mobile2;
	    				}
	    			}
	    			if($mobile3!="")
	    			{
	    				if($mobilenosms!="")
	    				{
			    			$mobilenosms=$mobilenosms.",".$mobile3;
	    				}
	    				else
	    				{
			    			$mobilenosms=$mobile3;
	    				}
	    			}
	    			$message="User : " . $username . "\r\nLogged in at ".date('d-m-Y h:i:s');
	    			sendsms($message,$mobilenosms);
	    		}
	    		if($otp!="")
	    		{
	    			$otpno=mt_rand(1001,9999);

			    	$sql ="update m_user set otpno=".$otpno." where username='$username'";
			    	$query = $this->db->query($sql);
	    			$message="OTP for user : ".$username."\r\nis : " . $otpno . "\r\nat ".date('d-m-Y h:i:s');
	    			sendsms($message,$otp);
	    		}
				if ( isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP'])) {
				    $ip = $_SERVER['HTTP_CLIENT_IP'];
				} elseif ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
				    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				}

				$ip = filter_var($ip, FILTER_VALIDATE_IP);
				$ip = ($ip === false) ? '0.0.0.0' : $ip;

				if(($user_ip=="" || strpos($user_ip, $ip) !== false) && $otp=="") 
				{
		    		// set cookie
					$cookie = array(
					'name'   => 'username',
					'value'  => $username,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);

					 
					set_cookie($cookie);

					$cookie1 = array(
					'name'   => 'usertype',
					'value'  => $usertype,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					set_cookie($cookie1);

					$cookie2 = array(
					'name'   => 'userpermission',
					'value'  => $userpermission,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					set_cookie($cookie2);

		    		// set cookie
					$cookie3 = array(
					'name'   => 'ip_address',
					'value'  => $ip,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					 
					set_cookie($cookie3);

		    		// set cookie
					$cookie4 = array(
					'name'   => 'back_date',
					'value'  => $back_date,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					 
					set_cookie($cookie4);

					$cookie5 = array(
					'name'   => 'user_id',
					'value'  => $user_id,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					set_cookie($cookie5);

		    		$this->session->set_userdata('username',$username);
		    		echo "1";

				}
				else
				{
					if($otp!="")
					{
						echo "4";
					}
					else
					{
						echo "3";
					}
				}
	    	}
	    	else{
	    		echo "2";
	    	}

	    }


	    function checktext(){
			date_default_timezone_set('Asia/Kolkata');

	    	$text= $this->input->get('text');
	    	$sql ="select * from m_user where username='$text'";
	    	$query = $this->db->query($sql);
	    	$result = $query->result();
	    	if($query->num_rows()>0)
	    	{
	    		echo "1";
	    	}
	    	else{
	    		echo "2";
	    	}

	    }

	    function checkforgot(){
			date_default_timezone_set('Asia/Kolkata');

	    	$username= $this->input->get('UserName');
	    	$mobile1="";
	    	$otp="";
	    	$sql ="select * from m_user where username='$username'";
	    	$query = $this->db->query($sql);
	    	$result = $query->result();
	    	$usertype='';
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
	    		}

    			$otpno=mt_rand(1001,9999);

		    	$sql ="update m_user set otpno=".$otpno." where username='$username'";
		    	$query = $this->db->query($sql);
    			$message="OTP for Password Reset for user : ".$username."\r\nis : " . $otpno . "\r\nat ".date('d-m-Y h:i:s');
    			sendsms($message,"9826152600");

	    		echo "1";

	    	}
	    	else{
	    		echo "2";
	    	}

	    }

	    function checkotp(){
			date_default_timezone_set('Asia/Kolkata');

	    	$username= $this->input->get('UserName1');
	    	$otpno= $this->input->get('otpno');
	    	$otpno=mysql_real_escape_string($otpno);

	    	$sql ="select * from m_user where username='$username' and otpno='$otpno'";
	    	$query = $this->db->query($sql);
	    	$result = $query->result();
	    	$usertype='';
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
	    			$usertype=$row->type;
	    			$user_id=$row->id;
	    			$userpermission=$row->permission;
	    			$user_ip=$row->ip_address;
	    			$back_date=$row->back_date;
	    			$mobile1=$row->mobile1;
	    			$mobile2=$row->mobile2;
	    			$mobile3=$row->mobile3;
	    			$otp=$row->otp;
	    		}

				if ( isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP'])) {
				    $ip = $_SERVER['HTTP_CLIENT_IP'];
				} elseif ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
				    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				}

				$ip = filter_var($ip, FILTER_VALIDATE_IP);
				$ip = ($ip === false) ? '0.0.0.0' : $ip;

				if(($user_ip=="" || strpos($user_ip, $ip) !== false)) 
				{
		    		// set cookie
					$cookie = array(
					'name'   => 'username',
					'value'  => $username,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);

					 
					set_cookie($cookie);

					$cookie1 = array(
					'name'   => 'usertype',
					'value'  => $usertype,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					set_cookie($cookie1);

					$cookie2 = array(
					'name'   => 'userpermission',
					'value'  => $userpermission,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					set_cookie($cookie2);

		    		// set cookie
					$cookie3 = array(
					'name'   => 'ip_address',
					'value'  => $ip,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					 
					set_cookie($cookie3);

		    		// set cookie
					$cookie4 = array(
					'name'   => 'back_date',
					'value'  => $back_date,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					 
					set_cookie($cookie4);

					$cookie5 = array(
					'name'   => 'user_id',
					'value'  => $user_id,
					'expire' => time()+86500,
					'path'   => '/',
					'prefix' => 'ae_',
					);
					set_cookie($cookie5);

		    		$this->session->set_userdata('username',$username);
		    		echo "1";

				}
				else
				{
					echo "3";
				}
	    	}
	    	else{
	    		echo "2";
	    	}

	    }
	    function logout()
	    {
	    	$this->session->unset_userdata('username');
			// $cookie = array(
			//     'name'   => 'username',
			//     'value'  => '',
			//     'expire' => '0',
			//     'prefix' => 'ae_'
			//     );			    
			delete_cookie('ae_username');
			delete_cookie('ae_company_id');
			delete_cookie('ae_company_name');
			delete_cookie('ae_formname');
			delete_cookie('ae_pos_id');
			delete_cookie('ae_pos_name');
			delete_cookie('ae_userpermission');
			delete_cookie('ae_back_date');
			delete_cookie('ci_session');
			redirect('login','refresh');
		}
		//Start By Ram(24-04-2015)
		public function db_backup()
		   {	
	       $this->load->dbutil();   
	       $backup =& $this->dbutil->backup();  
	       $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
	       $this->load->helper('file');
	       $status=write_file('db_backup/'.$db_name, $backup); 
		       if($status==1){
		       	 $data=array(
		       	 	'name'=>$db_name
		       	 	);
		       	 $this->db->insert('tbl_db',$data);
	             echo "1";
		       }else{
	             echo "2";
		       }
		   }
		   public function db_list()
		    {
	    	$query=$this->db->query('select * from tbl_db order by cdate desc');
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Date</th>';
		        echo '            <th>Database Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
	                echo '    <td><a target="_blank" href="'.base_url() .'db_backup/'. $row->name . '">'.$row->name.'</a></td>';
	                echo '    <td>';
					echo '		    <button class="btn btn-xs btn-danger" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
		//End By Ram(24-04-2015)
	}
?>