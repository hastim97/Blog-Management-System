
    <!--Add Cateogory form-->
    <div class="col-xs-6">
       <h3>Add</h3>
        <?php
            addCategory();
        ?>


        <form action="" method="post">
            <div class="form-group">
                <label for="cat_title">Category Title</label>
                <input id="cat_title" type="text" name="cat_title" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
            </div>

        </form>
    </div>
    <!--End of Add Cateogory form-->
