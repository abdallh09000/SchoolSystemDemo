<?php
include "../forAll/nav.php";
include "../forAll/condigDataBase.php";
if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $courseID = $_POST['courseID'];
    $password = $_POST['password'];
    /* Code image ; 
    1-name
    2-type
    3-path
    4-location
    */   
    $image_name =  $_FILES['image']['name'];
    $image_type = $_FILES['image']['type']; 
    $image_path = $_FILES['image']['tmp_name'];
    $location = "uploads/";
    $mih=move_uploaded_file($image_path , $location . $image_name );
      if($mih){
         echo "Image uploadet True";
     }else{
        echo "Image uploadet false";
     }
/* Code image ; */
/* INSERT in database sudent and user table */
    $insert = "INSERT INTO `teacher` VALUES (NULL,'$name',$salary ,'$image_name',$courseID)";
    $i = mysqli_query($conn, $insert);
    testmessage($i, "record added");
    $f = getid("teacher", "id");
    $insertuser = "INSERT INTO `user` VALUES (NULL,'$name','teacher','tlist','$password',$f)";
    $io = mysqli_query($conn, $insertuser);
    testmessage($io, "username = $name and password = $password ");
    /* end INSERT in database sudent and user table */
}


$name = "";
$salary = "";
$courseID = "";
$editmode = false;
if (isset($_GET['Edit'])) {/*edit mode in add.php file  */
    $id = $_GET['Edit'];
    $show = "SELECT * FROM `teacher` where id= $id";
    $s = mysqli_query($conn, $show);
    $row = mysqli_fetch_assoc($s);
    $name = $row['name'];
    $salary = $row['salary'];
    $courseID = $row['courseid'];
    $editmode = true;
    if (isset($_POST['sendEdit'])) {
        $name = $_POST['name'];
        $salary = $_POST['salary'];
        $courseID = $_POST['courseID'];
        $update = "UPDATE `teacher` SET name='$name', salary=$salary, courseid=$courseID WHERE id=$id";
        $u = mysqli_query($conn, $update);
        testmessage($u, "record modified");
        header("location: /amit/teachers/list.php");
    }
}

?>
<?php if (isset($_SESSION['Validity'])) { ?>
    <?php if ($_SESSION['Validity'] == "full") { ?>
        <?php if ($editmode) { ?>
            <h1 class="text-center text-primary \">Edit teacher</h1>
        <?php } else { ?>
            <h1 class="text-center text-primary \">Add teacher</h1>
        <?php } ?>

        <div class="container bg-dark p-5 text-center mt-5">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="namet">name</label>
                    <input type="text" required value="<?php echo $name ?>" name="name" class="form-control" id="namet" placeholder="teacher name">
                </div>
                <div class="form-group">
                    <label for="salaryt">salary</label>
                    <input type="text" required value="<?php echo $salary ?>" name="salary" class="form-control" id="salaryt" placeholder="teacher salary">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" required name="image" id="test" class="form-control" placeholder="teacher salary">
                </div>
                <div class="form-group">
                    <label for="courseIDt">courseID</label>
                    <select name="courseID" class="form-control" id="courseIDt">
                        <?php
                        $show1 = "SELECT * FROM `courses`";
                        $s1 = mysqli_query($conn, $show1);
                        foreach ($s1 as $data) {
                        ?>
                            <option value="<?php echo $data['courseid'] ?>"><?php echo $data['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php if (!$editmode) { ?>
                    <div class="form-group">
                        <label for="passwordt">password</label>
                        <input type="password" required name="password" class="form-control" id="levelt" placeholder="password">
                    </div>
                <?php } ?>
                <div class="form-group">
                    <?php if ($editmode) { ?>
                        <button name="sendEdit" class="btn btn-info w-50 mx-auto">Edit teacher</button>
                    <?php } else { ?>
                        <button name="send" class="btn btn-primary w-50 mx-auto">Add teacher</button>
                    <?php } ?>
                </div>
            </form>
        </div>
<?php }else{?>
<h1 class="text-center text-primary my-3">not authorized</h1>
<?php } }?>
<?php
include "../forAll/footer.php";
?>