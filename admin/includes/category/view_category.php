


<?php 
    include_once('includes/category/add_category.php');
    include_once('includes/category/edit_category.php');
?>



<!--available or Inserted Categories-->

</div>
<div class="col-xs-12">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Category Title</th>
            <th></th>
            <th></th>
        </tr>

        <tbody>
            <?php   
            
                $query="SELECT * FROM categories";
                $result=mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($result)){
                    $cat_id=$row['cat_id'];
                    $cat_title=$row['cat_title'];
                    echo "<tr>";
                    echo "<td>$cat_id</td>";
                    echo "<td>$cat_title</td>";
                    echo "<td><button data-toggle='modal' data-target='#myModal".$cat_id."' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>";

            ?>
                <div id="myModal<?php echo $cat_id;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <h4 class="modal-title">Are you sure you want to delete this data?</h4>
                            </div>
                           <div class="modal-footer">
                              <a href="categories.php?delete=<?php echo $cat_id;?>" type="button" class="btn btn-success">Yes</a>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>                   
                          </div>
                       </div>
                   </div>
                </div>

            <?php

                echo "<td><a href='categories.php?edit=$cat_id' class='btn btn-primary'><span class='fa fa-pencil'> Edit</a></td>";

                echo "</tr>";
            }

                if(isset($_GET['delete'])){
                    $delete_id=$_GET['delete'];
                    $query="DELETE FROM categories WHERE cat_id=$delete_id";
                    $delete_result=mysqli_query($connection,$query);
                    header("Location: categories.php");
                }
            ?>
        </tbody>
    </table>
</div>