<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	// This can be removed if you use __autoload() in config.php OR use Modular Extensions
	require APPPATH . '/libraries/REST_Controller.php'; 
	class Usuarios extends REST_Controller {
		function __construct()
	    {
	        // Construct the parent class
	        parent::__construct();
	    	$this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        	$this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        	$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

	    }
	    public function index_get()
	    {
	    	$us=$this->db->get('usuarios');

	    	if ($us->num_rows()>0) {
	    		var_dump($us->result_array());
	    		return $us->result_array();
	    	 	# code...
	    	 } else {
	    	 	return null;
	    	 	# code...
	    	 }
	    }

		public function index_post()
	    {
	 	$user= [
	 		'id_usuario'=>$this->post('post_id'),
            'us' => $this->post('post_us'),
            'email'=> $this->post('post_email'),
            'born'=> $this->post('post_born'),
            'status'=> $this->post('post_status'),
            'pass'=> $this->post('post_pass'),
        ];
			echo 'id_usuario: '. $user['id_usuario']."\n";
         	echo 'us: '.$user['us']."\n";
            echo 'email: '.$user['email']."\n";
            echo 'born: '.$user['born']."\n";
            echo 'status: '.$user['status']."\n";
            echo 'pass: '.$user['pass']."\n";
	    }
		public function index_put()
	    {
	    	echo "---usuarios.php put---"; 
	    }
	    public function index_patch()
	    {
	    	echo "---usuarios.php patch---"; 
	    }
   	    public function index_delete()
	    {
	    	echo "---usuarios.php delete---"; 
	    }
	}
?>