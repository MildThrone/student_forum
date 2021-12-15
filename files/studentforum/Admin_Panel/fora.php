<?php
include 'inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
    echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
    echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php

if (isset($_GET['remove'])) {
    $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
    $removeForum = $forums->removeForumbyId($remove);
}

if (isset($removeForum)) {
    echo $removeForum;
}
if (isset($_GET['deactive'])) {
    $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
    $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
    echo $deactiveId;
}
if (isset($_GET['active'])) {
    $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
    $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
    echo $activeId;
}


?>
    <div class="card ">
        <div class="card-header">
            <h3><i class="fas fa-users mr-2"></i>Forum List<span class="float-right">Welcome! <strong>
            <span class="badge badge-lg badge-secondary text-white">
<?php
$username = Session::get('username');
if (isset($username)) {
    echo $username;
}
?></span>

          </strong></span></h3>
        </div>
        <div class="card-body pr-2 pl-2">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th  class="text-center">SL</th>
                    <th  class="text-center">Forum Name</th>
                    <!--                      <th  class="text-center">Username</th>-->
                    <th  class="text-center">Slogan</th>
                    <th  class="text-center">Creator</th>
                    <th  class="text-center">Date Created</th>
                    <!--                      <th  class="text-center">Status</th>-->
                    <!--                      <th  class="text-center">Created</th>-->
                    <th  width='25%' class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //                        include "../account/dbh/dbh.php";
                include "../account/dbh/db_functions.php";
                //                      $allForums = $users->selectAllUserData();
                $allForums = select_all('forums');

                //                        var_dump($allForums);
                if ($allForums) {
                    $i = 0;
                    foreach ($allForums as $value) {
                        $i++;

                        ?>

                        <tr class="text-center"
                            <?php /*if (Session::get("id") == $value['id']) {
                                echo "style='background:#d9edf7' ";
                            } */?>
                        >

                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['forum_name']; ?></td>
                            <!--                        <td><?php /*echo $value->username; */?> <br>
                          <?php /*if ($value->roleid  == '1'){
                          echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                        } elseif ($value->roleid == '2') {
                          echo "<span class='badge badge-lg badge-dark text-white'>Lecturer</span>";
                        }elseif ($value->roleid == '3') {
                            echo "<span class='badge badge-lg badge-dark text-white'>Student</span>";
                        } */?></td>
-->
                            <td><?php echo $value['purpose']; ?></td>
<!--                            <td>--><?php //echo Forums::getCreator($value['user_id']); ?><!--</td>-->
                            <td><?php
                                $forum = new Forums();
                                echo $forum->getCreator($value['user_id']);
                            ?></td>

                            <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value['date_created']; ?></span></td>
                            <!--                        <td>
                          <?php /*if ($value->isActive == '0') { */?>
                          <span class="badge badge-lg badge-info text-white">Active</span>
                        <?php /*}else{ */?>
                    <span class="badge badge-lg badge-danger text-white">Deactive</span>
                        <?php /*} */?>

                        </td>
-->
                            <!--                          <td><span class="badge badge-lg badge-secondary text-white"><?php /*echo $users->formatDate($value->created_at);  */?></span></td>
-->
                            <td>
                                <?php if ( Session::get("roleid") == '1') {?>
                                    <a class="btn btn-success btn-sm
                            " href="../account/forum.php?id=<?php echo $value['forum_id'];?>">View</a>
<!--                                    <a class="btn btn-info btn-sm " href="../account/forum.php?id=--><?php //echo $value['forum_id'];?><!--">Edit</a>-->
                                    <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    <?php if (Session::get("id") == $value['user_id']) {
                                        echo "disabled";
                                    } ?>
                             btn-sm " href="?remove=<?php echo $value['forum_id'];?>">Remove</a>

                                    <?php /*if ($value->isActive == '0') {  */?><!--
                               <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning
                       <?php /*if (Session::get("id") == $value->id) {
                         echo "disabled";
                       } */?>
                                btn-sm " href="?deactive=<?php /*echo $value->id;*/?>">Disable</a>
                             <?php /*} elseif($value->isActive == '1'){*/?>
                               <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary
                       <?php /*if (Session::get("id") == $value->id) {
                         echo "disabled";
                       } */?>
                                btn-sm " href="?active=<?php /*echo $value->id;*/?>">Active</a>
                             --><?php /*} */?>




                                <?php  }elseif(Session::get("id") == $value['id']  && Session::get("roleid") == '2'){ ?>
                                    <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                                    <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                                <?php  }elseif( Session::get("roleid") == '2'){ ?>
                                    <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                                        echo "disabled";
                                    } ?>
                          " href="profile.php?id=<?php echo $value->id;?>">View</a>
                                    <a class="btn btn-info btn-sm
                          <?php if ($value->roleid == '1') {
                                        echo "disabled";
                                    } ?>
                          " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                                <?php }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '3'){ ?>
                                    <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                                    <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                                <?php }else{ ?>
                                    <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                                        echo "disabled";
                                    } ?>
                          " href="profile.php?id=<?php echo $value->id;?>">View</a>

                                <?php } ?>

                            </td>
                        </tr>
                    <?php }}else{ ?>
                    <tr class="text-center">
                        <td>No forums available!</td>
                    </tr>
                <?php } ?>

                </tbody>

            </table>


        </div>
    </div>



<?php
include 'inc/footer.php';

?>
<?php
