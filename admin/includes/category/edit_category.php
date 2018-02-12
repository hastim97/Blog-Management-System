<!--Edit Cateogory form-->
<div class="col-xs-6">

    <?php

        editCategory();
    ?>

    <?php
        $edit_title=fetchCategory();
    ?>

    <?php                            
        if(isset($edit_title))
        {                                    
    ?>
            <h3>Edit</h3>
            <form action="" method="post" >
                <div class="form-group">
                    <label for="cat_title">Category Title</label>
                    <input id="cat_title" type="text" name="cat_title" class="form-control" value="<?php echo $edit_title;?>">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="edit" value="Edit Category">
                </div>

            </form>

    <?php
        }
    ?>
<!--End of Edit Cateogory form-->