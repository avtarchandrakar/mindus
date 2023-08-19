<?
if (!defined('BASEPATH')) exit('No direct script access allowed');

class operation extends CI_Model {

     public function approve_save($tableName,$data,$id,$full_path,$file_name)
    {
        // echo 'fghgf';
          date_default_timezone_set('Asia/Kolkata');
          $tableName1='tbl_trans3';
          $status = $this->input->post("status");
          $fields = $this->db->field_data($tableName1);
          foreach ($fields as $field)
          {
            if($field->primary_key==1)
              continue;
            $value=$this->input->post($field->name);
            if(!empty($value))
            {
                $data[$field->name]=$value;
            }
          }

          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['company_id'] = get_cookie("ae_company_id");
          $data['filename']=$file_name;
          $data['fullpath']=$full_path;

          $cdate = date('Y-m-d',strtotime($this->input->post('cdate')));
          $company_id = get_cookie("ae_company_id");

            $this->db->trans_begin();
            $this->db->insert($tableName1,$data); // insert trans1
            $id=$this->db->insert_id();
            echo $id; 
        }
}



// date_default_timezone_set('Asia/Kolkata');
//           $tableName1='tbl_trans3';
//           $tableName3='tbl_trans1';

//           $status = $this->input->post("status");
//           $fields = $this->db->field_data($tableName1);
//           foreach ($fields as $field)
//           {
//             if($field->primary_key==1)
//               continue;
//             $value=$this->input->post($field->name);
//             if(!empty($value))
//             {
//                 $data[$field->name]=$value;
//             }
//           }

//           $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
//           $data['company_id'] = get_cookie("ae_company_id");
//           $data['filename']=$file_name;
//           $data['fullpath']=$full_path;

//           $cdate = date('Y-m-d',strtotime($this->input->post('cdate')));
//           $company_id = get_cookie("ae_company_id");

//           $this->db->trans_begin();
//           $this->db->insert($tableName1,$data); // insert trans1
//           $id=$this->db->insert_id();
//           $q_number=$this->input->post('q_number');
//           $updata['if_approve']='1';
//           $this->db->where('id',$q_number);
//           $this->db->update($tableName3,$updata);
//           echo $id; 


// date_default_timezone_set('Asia/Kolkata');
//           $tableName1='tbl_trans3';
//           $status = $this->input->post("status");
//           $fields = $this->db->field_data($tableName1);
//           foreach ($fields as $field)
//           {
//             if($field->primary_key==1)
//               continue;
//             $value=$this->input->post($field->name);
//             if(!empty($value))
//             {
//                 $data[$field->name]=$value;
//             }
//           }

//           $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
//           $data['company_id'] = get_cookie("ae_company_id");
//           $data['filename']=$file_name;
//           $data['fullpath']=$full_path;

//           $cdate = date('Y-m-d',strtotime($this->input->post('cdate')));
//           $company_id = get_cookie("ae_company_id");
//           $filename=$file_name;
//           $fullpath=$full_path;

     
//           if($status=="add")
//             {
//             try{
//             $maxsno=0;
//             $query=$this->db->query("select max(cpo_sno) as maxsno from tbl_trans1");
//             $result=$query->result();
//             if($query->num_rows()>0)
//             {
//               foreach($result as $row)
//               {
//                 $maxsno = intval($row->maxsno)+1;
//               }
//             }
//             $data['cpo_sno']=$maxsno;
//             $cpo_sno=$maxsno;

//             $maxsno1='';
//             if(strlen($maxsno)==1){
//               $maxsno1="00".$maxsno;
//             }elseif (strlen($maxsno)==2) {
//               $maxsno1="0".$maxsno;
//             }else{
//               $maxsno1=$maxsno;
//             }
//             $data['cpo']='CPO/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;
//             $cpo='CPO/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;
//       // echo 'dfgfdh';die();
//             $this->db->trans_begin();
//             $query=$this->db->query("insert into tbl_trans3(filename,fullpath,cdate,company_id,cpo,cpo_sno) values('$filename','$fullpath','$cdate','$company_id','$cpo','$cpo_sno')");
//             // $result=$query->result();
//             $id=$this->db->insert_id();
//             echo $query;echo $id;die();
//             $this->db->insert($tableName1,$data); // insert trans1
//             // $this->db->trans_commit();
//             $id=$this->db->insert_id();
//             echo $id; 

//             }catch(Exception $e){
//             $this->db->trans_rollback();
//             echo "0";       
//             }
//         }
//         if($status=="edit")
//           {
//           try{
//               $this->db->trans_begin();  
//               $id=$this->input->post('sno');
//               $data['modified_by'] = get_cookie('ae_username');
//               $data['modi_datetime'] = date('Y-m-d h:i:s');

//               $this->db->where('id',$id);
//               $this->db->update($tableName1,$data); // update trans 1
//               echo $id;       
//           }catch(Exception $e){
//               $this->db->trans_rollback();
//               echo "0";       
//           }
//         }











/// controller


//  $opt=$this->input->post('status');
       //  $this->load->model('operation');
       //  $file_ext='';
       //  $rename_file_name='';
       //  $i=1;
       //  $path="./uploads";
       //      //print_r($_FILES);die;
       //  if(is_dir($path)==false)
       //  {
       //      $structure = $path;
    
       //      if(!mkdir($structure, 0, true)) {
    
       //      }
       //  }
       // // print_r($_FILES['photo']);die;
       //  try{
       //      if(!empty($_FILES['photo']["name"]))
       //      {
       //          $temp_file_name = $_FILES['photo']['name'];
       //          $r=date('d-m-Y-H-i-s');
       //          $file_ext = substr(strrchr($temp_file_name,'.'),1);
       //          $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
       //          $config['upload_path'] = $path;
       //          $config['allowed_types'] = 'jpeg|jpg|png|pdf';
       //          $config['file_name'] = $file_name;
    
       //          $this->load->library('upload');
       //          $this->upload->initialize($config);
       //          $path=$path."/".$file_name;
       //          // echo $path;die();
       //          if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
       //          {
       //              $error = array('error' => $this->upload->display_errors());
        
       //              foreach ($error as $d){
       //                  echo $d;
       //              }
       //          }
       //          else
       //          {
       //              $data = $this->upload->data();
       //              $full_path=base_url().'uploads/'.$data['file_name'];
       //              // echo $full_path;echo $data;die();
       //              $status = $this->operation->approve_save($tableName, null, $id,$full_path,$data['file_name']);
       //              // echo " dfhdf";
       //              echo $status;
       //          }
       //      }
       //      else if(isset($_POST['filepath'])){
       //          $full_path=$_POST['filepath'];
       //          $fullname=$_POST['filename'];
       //          $status = $this->operation->approve_save($tableName, null, $id,$full_path,$fullname);
       //          echo $status;
       //      }
       //      else
       //      {
       //        $full_path=base_url().'uploads/'.'unknown.jpg';
       //        $fullname='unknown.jpg';
       //        $status = $this->operation->approve_save($tableName, null, $id,$full_path,$fullname);
       //        echo $status;
       //      }
       //  }
       //  catch(Exception $e){
       //      $this->db->trans_rollback();
       //      echo "2";  
       //  }