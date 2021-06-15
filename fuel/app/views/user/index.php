<h2 ><a href="/fuelblog/public/User/create">Create</a> </h2>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
<table  >
<tr><th>User Id</th><th>User Roll No</th><th>User Name</th><th>Action</th><tr>
<?php foreach ($users  as $user): ?>
    <tr>
    <td><?php echo  $user->id;  ?> </td> 
    <td><?php echo  $user->name;  ?></td> 
    <td><?php echo  $user->email; ?> </td> 
    <td>
        <a href="/fuelblog/public/user/view/<?php echo  $user->id; ?> " >View </a>
        <a href="/fuelblog/public/user/edit/<?php echo  $user->id; ?>" >Edit </a>
        <a href="/fuelblog/public/user/delete/<?php echo  $user->id; ?>" >Delete</a>
    </td> 
    </tr>
<?php endforeach; ?>
</table>