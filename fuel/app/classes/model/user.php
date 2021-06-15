<?php

class Model_User extends Orm\Model
{
	 protected static $_table_name = 'users'; 
         protected static $_properties = array ('id','name','email','phone','address','created_at');
}