<?
	if (!defined('BASEPATH')) exit('No direct script access allowed');

	class userController extends CI_Controller {

	    function __construct() {
	        parent::__construct();
	    }

	    function index() {
	        // echo 'This is Helper Controller !';
	    }
		function user_permission_save()
	    {
	    	$this->load->model('user_model');
	    	$this->user_model->user_permission_save();
	    }
	    function user_permission_list()
	    {
	    	$this->load->model('user_model');
	    	$result=$this->user_model->user_permission_list();
	    	if(count($result)>0)
	    	{
	    		$permission_id=$this->input->get('permission_id');
		        echo '<table class="table table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Form Name</th>';
		        echo '            <th>Entry</th>';
		        echo '            <th>Modify</th>';
		        echo '            <th>Delete</th>';
		        echo '            <th>List</th>';
		        echo '            <th>Back Date</th>';
		        echo '            <th>RePrint</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->form_name . '<input type="hidden" name="form_id[]" value="'.$row->form_name.'" /></td>';	                
	                $est=$this->user_permission_check($permission_id,$row->form_name,'p_entry');
	                $mst=$this->user_permission_check($permission_id,$row->form_name,'p_modify');
	                $dst=$this->user_permission_check($permission_id,$row->form_name,'p_delete');
	                $list=$this->user_permission_check($permission_id,$row->form_name,'p_list');
	                $bdate=$this->user_permission_check($permission_id,$row->form_name,'p_bdate');
	                $reprint=$this->user_permission_check($permission_id,$row->form_name,'p_reprint');
	                echo '    <td><input type="checkbox" name="p_entry[]" value="1" '.$est.'/></td>';
	                echo '    <td><input type="checkbox" name="p_modify[]" value="1" '.$mst.'/></td>';
	                echo '    <td><input type="checkbox" name="p_delete[]" value="1" '.$dst.'/></td>';
	                echo '    <td><input type="checkbox" name="p_list[]" value="1" '.$list.'/></td>';
	                echo '    <td><input type="checkbox" name="p_bdate[]" value="1" '.$bdate.'/></td>';
	                echo '    <td><input type="checkbox" name="p_reprint[]" value="1" '.$reprint.'/></td>';
	                echo '</tr>';
		        }
		        echo '</tbody>';
		        echo '</table>';
	    	}
	    }
	    public function user_permission_check($permission_id,$form_id,$st){
	    	$query=$this->db->query('select '.$st.' from tbl_user_permission where permission_id='.$permission_id.' and form_id="'.$form_id.'" and '.$st.'=1');
	    	if($query->num_rows()>0){
             return 'checked';
            }else{
             return '';
            }
	    }
	    //Permission Form
	    function permission_form_list()
	    {
	    	$this->load->model('user_model');
	    	$result=$this->user_model->permission_form_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordere table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Form Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';
		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . ucwords($row->name) . '</td>';	                
	                echo '    <td>';
				echo '	    <div class="   btn-group">';
				echo '		    </button>';
				echo '		    <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
			    echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
				echo '		    </a>';
				echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
				echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
				echo '		    </button>';
				echo '	    </div>';
                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</tbody>';
		        echo '</table>';
	    	}
	    }
	    public function permission_form_get()
        {
          $this->load->model('user_model');
          $this->user_model->permission_form_get();
        }
        public function permission_form_save(){
        	$this->load->model('user_model');
        	$this->user_model->permission_form_save();
        }
        public function permission_get(){
        	$this->load->model('user_model');
        	$this->user_model->permission_get();
        }


	    public function user_inst_list()
		    {
	    	$this->load->model('user_model');
	    	$result=$this->user_model->user_inst_list();
	    	$a=array();
	    	if(count($result)>0){
	          foreach($result as $row){
	          	$a[]=$row->pid;
	          }
	    	}
	        echo '<select  tabindex="10" multiple="multiple" size="10" name="listbox[]" class="demo2 col-md-6" >';
	        $ins=$this->db->query('select company_id,company_name from m_company');
	        foreach($ins->result() as $data){
	        if (in_array($data->company_id, $a))
			echo '<option selected="selected" value="'.$data->company_id.'">'.$data->company_name.'</option>';    
			else
	        echo '<option value="'.$data->company_id.'">'.$data->company_name.'</option>';
	        }
	        echo '</select>' ;
	    }


	} //End Class