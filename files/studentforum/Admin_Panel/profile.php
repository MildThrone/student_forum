<?php
include 'inc/header.php';
Session::CheckSession();

?>

<?php

if (isset($_GET['id'])) {
    $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
//    $userid = $_GET['id'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateUser = $users->updateUserByIdInfo($userid, $_POST);
//    var_dump($_POST);

}

if (isset($updateUser)) {
    echo $updateUser;
//    var_dump($updateUser);
}




?>

<div class="card ">
    <div class="card-header">
        <h3>User Profile <span class="float-right"> <a href="index.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getUinfo = $users->getUserInfoById($userid);
        if ($getUinfo) {






            ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" name="first_name" value="<?php echo $getUinfo->first_name; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Other Names</label>
                        <input type="text" name="other_names" value="<?php echo $getUinfo->other_names; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Index Number</label>
                        <input type="text" id="mobile" name="index_number" value="<?php echo $getUinfo->index_number; ?>" class="form-control">
                    </div>

                    <?php if (Session::get("roleid") == '1') {  ?>

                        <div class="form-group
                          <?php if (Session::get("roleid") == '1' && Session::get("id") == $getUinfo->id) {
                                        echo "d-none";
                                    } ?>
                        ">
                            <div class="form-group">
                                <label for="sel1">Select User Type</label>
                                <select class="form-control" name="type" id="id">

                                    <?php

                                    if($getUinfo->type == "STUDENT"){?>
                                        <option value="STUDENT" selected='selected'>Student</option>
                                        <option value="LECTURER">Lecturer</option>
                                    <?php } elseif($getUinfo->type == "LECTURER"){?>
                                        <option value="STUDENT">Student</option>
                                        <option value="LECTURER" selected='selected'>Lecturer</option>
                                    <?php
                                        }
                                    ?>

                                </select>
                            </div>
                        </div>

                    <?php }else{?>
                        <input type="hidden" name="roleid" value="<?php echo $getUinfo->type; ?>">
                    <?php } ?>

                    <?php if (Session::get("id") == $getUinfo->id) {?>


                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Password change</a>
                        </div>
                    <?php } elseif(Session::get("roleid") == '1') {?>


                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Password change</a>
                        </div>
                    <?php } elseif(Session::get("roleid") == '2') {?>


                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-success">Update</button>

                        </div>

                    <?php   }else{ ?>
                        <div class="form-group">

                            <a class="btn btn-primary" href="index.php">Ok</a>
                        </div>
                    <?php } ?>


                </form>
            </div>

        <?php }else{

            header('Location:index.php');
        } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>
