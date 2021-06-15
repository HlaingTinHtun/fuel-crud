<?php
if(isset($errors)) {  
    echo '<ul style="color:red"> Errors ';

    foreach($errors as $error)
    {
        echo '<li>'. $error .'</li>';
    }

   echo '</ul>';
} 
?> 

<?php echo Form::open('/fuelblog/public/user/edit/'.$user->id); ?>

<div >
<?php echo Form::label('phone No',"phone"); ?>
<?php echo Form::input('phone',
        Input::post('phone',isset($user)?$user->phone:''));
?>
</div>

<div>
<?php echo Form::label('Name',"name"); ?>
<?php echo Form::input('name',
        Input::post('name',isset($user)?$user->name:''));
?>
</div>

<div>
<?php echo Form::label('Email',"email"); ?>
<?php echo Form::input('email',
        Input::post('email',isset($user)?$user->email:''));
?>
</div>

<div>
<?php echo Form::label('address',"address"); ?>
<?php echo Form::input('address',
        Input::post('address',isset($user)?$user->address:''));
?>
</div>
<div>
<?php echo Form::submit('update'); ?>
</div>

<?php echo Form::close();?>

<a href="/fuelblog/public/user/" >Back To List</a>