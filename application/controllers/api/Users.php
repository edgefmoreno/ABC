<?php 
	//https://github.com/chriskacerguis/codeigniter-restserver
	defined('BASEPATH') OR exit('No direct script access allowed');
	require APPPATH . '/libraries/REST_Controller.php'; 
	class Users extends REST_Controller {
		function __construct()
	    {
	        // Esta Clase contiene
	        // 	'us_type'=> Hace referencia al tipo de usuario  
	        //		0 => Admin: puede editar, eliminar, crear a otros usuarios de cualquier tipo. 
	        //		1 => human_usuario: solo puede ver los usuarios registrados.
	        //		2 => web_user: puede agregar y ver a los  human_usuarios registrados. 
	 		//	'id_user'=>  [unico] Identifica un usuario 
     		//	'us' =>  [unico] nickname del usuario  
		    //  'email'=> [unico]
		    //  'born'=> indica fecha de nacimiento del usuario
		    //  'status'=> indica el estado, para borrados lógicos
		    //  'pass'=>  indica el pass del usuario
	        parent::__construct();
	        $this->load->model("User_Model");
	    	$this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        	$this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        	$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
	    }
	    //esta funcion regresa todos los datos de los usuarios
	    public function index_get()
	    {	
        	$users=$this->User_Model->get_users();
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        
	    }
	    //esta funcion agrega un usuario a la base de datos, por metodo principal post
		public function index_post()
	    {
	 		$user= [
	 			'us_type'=>$this->post('post_type'),
	 			'id_user'=>$this->post('post_id'),
            	'us' => $this->post('post_us'),
	            'email'=> $this->post('post_email'),
	            'born'=> $this->post('post_born'),
	            'status'=> $this->post('post_status'),
	            'pass'=> $this->post('post_pass'),
        	];
        	$us=$this->User_Model->add_user($user);
        	if ($us) {
        		$this->response(array("code" =>200, "response"=>"Se agrego el usuario"+$user->us));
        	} else {
        		$this->response(array("code" =>204, "response"=>"NO se  agrego el usuario"+$user->us));
        	}
	    }
		public function index_put()
	    {
	    	$user=[
	    		'id_user'=>$this->post('post_id'),
	    		'pass'=> $this->post('post_pass'),
	    	];
	 		$users=$this->User_Model->update_pass($user);

        	if ($user) {
        		$this->response(array("code" =>200, "response"=>"Se modifico el usuario"));
        	} else {
        		$this->response(array("code"=>204, "response"=>"NO se  modifico el usuario"));
        	}
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