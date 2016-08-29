<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
	class User_Model extends CI_Model
	{		
		function __construct()
		{
			parent::__construct();
		}
		public function get_users()
		{
			$users=$this->db->get('users');
			if ($users->num_rows()>0) {
				return $users->result_array();
			}else{
				return null;
			}
		}
		public function get_user_id($id)
		{
			$user=$this->db->where('id_user',$id);
			if ($users->num_rows()>0) {
				return $users->result_array();
			}else{
				return null;
			}
		}
		public function add_user($us)
		{
			$user=$this->db->insert('users',$us);
			if ($user) {
				return $user;
			}else{
				return null;
			}
		}
		public function update_pass($id,$pass){

			$this->db->where('id_user', $id);
      		$usuario = $this->db->update('pass',$pass);
      if($usuario){
      	echo "update pass";
        return true;
      } else {
      	echo "NO update pass";
        return false;
      }
    }
	}
 ?>