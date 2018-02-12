<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form method="post" action="search.php">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
            </div>
            <!-- /.input-group -->
        </form>
    </div>
    
    <div class="well">
        <h4>Login</h4>
        <form method="post" action="includes/login.php">
           <div class="form-group">
                <input type="text" placeholder="Enter User Name" name="username" class="form-control">
           </div>
           <div class="form-group">
                <input name="password" placeholder="Enter Password" type="password" class="form-control">
           </div>
           <div class="form-group">
                <button name="login" class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-user"></span> Login</button>
           </div>
            <!-- /.input-group -->
        </form>
    </div>

    <?php
        $query="SELECT * FROM categories";
        $result=mysqli_query($connection,$query);
    ?>
    
    
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php    
                        while($row=mysqli_fetch_assoc($result)){
                            $cat_id=$row['cat_id'];
                            $cat_title=$row['cat_title'];
                            echo "<li>
                                    <a href='categories.php?c_id=$cat_id'>$cat_title</a>
                                </li>";
                        }
                    ?>
                   
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>