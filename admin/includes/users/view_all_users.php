<!--View all posts-->

<div class="col-xs-12">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Image</th> 
            <th></th>       
            <th></th>   
            <th></th>
            <th></th>
        </tr>
        <tbody>
        <?php    
            $query="SELECT * FROM users";
            $result=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($result)){
                $id=$row['id'];
                $first_name=$row['first_name'];
                $last_name=$row['last_name'];
                $username=$row['username'];
                $email=$row['email'];
                $role=$row['role'];
                $image=$row['image'];
                
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$username</td>";
                echo "<td>$first_name</td>";
                echo "<td>$last_name</td>";
                echo "<td>$email</td>";
                
                echo "<td>$role</td>";
                echo "<td><img src='images/users/$image' height='70px' width='120px'></td>";
                
                echo "<td><a class='btn btn-success' href='users.php?make_admin=$id'><span class='fa fa-check'> Make Admin</a></td>";
                echo "<td><a class='btn btn-warning' href='users.php?make_subscriber=$id'><span class='fa fa-remove'> Make Subscriber</a></td>";
                echo "<td><a class='btn btn-primary' href='users.php?source=edit_users&e_id=$id'><span class='fa fa-pencil'> Edit</a></td>";
                echo "<td><a class='btn btn-danger' data-toggle='modal' data-target='#myModal$id' ><span class='fa fa-trash'></a></td>";
                echo "</tr>";
            ?>
               
                <div id="myModal<?php echo $id;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <h4 class="modal-title">Are you sure you want to delete this data?</h4>
                            </div>
                           <div class="modal-footer">
                              <a href="users.php?delete=<?php echo $id;?>" type="button" class="btn btn-success">Yes</a>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>        
                          </div>
                       </div>
                   </div>
                </div>
            <?php
            }
        ?>
        </tbody>
    </table>
    <?php
        
        if(isset($_GET['make_admin'])){
            $approve_comment_id=$_GET['make_admin'];
            $query = "UPDATE users SET role='admin' where id=$approve_comment_id";
            $result=mysqli_query($connection,$query);
            header("Location: users.php");
        }
        
        if(isset($_GET['make_subscriber'])){
            $unapprove_comment_id=$_GET['make_subscriber'];
            $query = "UPDATE users SET role='subscriber' where id=$unapprove_comment_id";
            $result=mysqli_query($connection,$query);
            header("Location: users.php");
        }
    
    
        if(isset($_GET['delete'])){
            $delete_comment_id=$_GET['delete'];         
            $query = "delete from users where id=$delete_comment_id";
            $delete_query=mysqli_query($connection,$query);
            header("Location: users.php");
        }
    ?>
</div>
<!--End view all posts-->