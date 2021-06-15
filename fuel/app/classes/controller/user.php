<?php 


class Controller_User extends Controller_Template
{
	public function action_index()
	{
		$data = []; 
	    $data['users'] = Model_User::find('all');
	    // print"<pre>";
	    // print_r($data);exit();
	    $this->template->title="user List";
	    $this->template->content=View::forge('user/index',$data,false);
	}

	public function action_view($id)
    {
        $user = Model_User::find('first',
            array(
                'where' => array(
                    'id' =>  $id
                )
            )
        );
        
        if($user==null){
             throw new HttpNotFoundException();
        }
        $data=array('user' => $user);
        $this->template->title="User Detail";
        $this->template->content=View::forge('user/view',$data,false);
    }

    public function action_create()
    {
        $data = array();
        
        //button create clicked
        if(Input::post('create')){
            
            $val = Validation::forge();

           	$val->add('name', 'Name')->add_rule('required')
           	->add_rule('min_length', 3)
           	->add_rule('max_length', 10);

			$val->add('phone', 'phone')->add_rule('required')
			->add_rule('min_length', 3)
			->add_rule('max_length', 10);

			$val->add('email', 'email')->add_rule('required')
			->add_rule('min_length', 3)
			->add_rule('max_length', 40);

			$val->add('address', 'address')->add_rule('required')
			->add_rule('min_length', 3)
			->add_rule('max_length', 1000);

            // validation Succeed
            if($val->run()){
                // get an array of successfully validated fields => value pairs
                $validatedFields  = $val->validated();
                //create user model and save to db    
                $user = new Model_User();
                $user->phone  = $validatedFields['phone'];
                $user->name   = $validatedFields['name'];
                $user->email   = $validatedFields['email'];
                $user->address   = $validatedFields['address'];
                $user->created_at   = date("Y-m-d H:i:s");
                $user->save();
                //redirect to user List
                Response::redirect('/fuelblog/public/user');
            }
            // validation failed
            //redirect back with error message
            else{
                // get an array of validation errors as field => error pairs
                $data['errors']= $val->error();
                $this->template->title="Create User";
                $this->template->content=View::forge('user/create',$data,false);
            }

        }
        // show form on new page load
        else{
            $this->template->title="Create User";
            $this->template->content=View::forge('user/create',$data,false);     
        }
    }
    
    public function action_edit($id)
    {
        $data = array();
        //check user exist in db or not
        $user = Model_User::find('first',
        array(
            'where' => array(
                'id' =>  $id
            )
        )
        );
        
        if($user==null){
             throw new HttpNotFoundException();
        }
        
        //button update clicked
        if(Input::post('update')){
            
            $val = Validation::forge();

           	$val->add('name', 'Name')->add_rule('required')
           	->add_rule('min_length', 3)
           	->add_rule('max_length', 10);

			$val->add('phone', 'phone')->add_rule('required')
			->add_rule('min_length', 3)
			->add_rule('max_length', 10);

			$val->add('email', 'email')->add_rule('required')
			->add_rule('min_length', 3)
			->add_rule('max_length', 40);

			$val->add('address', 'address')->add_rule('required')
			->add_rule('min_length', 3)
			->add_rule('max_length', 1000);

            // validation Succeed
            if($val->run()){
                // get an array of successfully validated fields => value pairs
                $validatedFields  = $val->validated();
                //update existing user model values and save to db    
                $user->phone  = $validatedFields['phone'];
                $user->name   = $validatedFields['name'];
                $user->email   = $validatedFields['email'];
                $user->address   = $validatedFields['address'];
                $user->created_at   = date("Y-m-d H:i:s");
                $user->save();
                //redirect to user List
                Response::redirect('/fuelblog/public/user');
            }
            // validation failed
            //redirect back with error message
            else{
                // get an array of validation errors as field => error pairs
                //set error
                $data['errors']= $val->error();
                //set user value to last filled values
                $user->roll_no = Input::post('roll_no');
                $user->name = Input::post('name');
                $data['user']= $user;
                $this->template->title="Edit user";
                $this->template->content=View::forge('user/edit',$data,false);
            }

        }
        // show form on new page load
        else{
            //set user from db
            $data['user']= $user;
            $this->template->title="Edit user";
            $this->template->content=View::forge('user/edit',$data,false);     
        }
    }
    
    public function action_delete($id)
    {
        //check user exist in db or not
        $user = Model_User::find('first',
        array(
            'where' => array(
                'id' =>  $id
            )
        )
        );
        
        if($user==null){
             throw new HttpNotFoundException();
        }
        //delete user
        $user->delete();
        //redirect to user List
        Response::redirect('/fuelblog/public/user');
    }
}