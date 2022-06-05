<?php
include "../forAll/nav.php";
include "../forAll/condigDataBase.php";
if(isset($_POST['send'])){
    $name=$_POST['name'];
    $level=$_POST['level'];
    $teacherid=$_POST['teacherid'];
    $password =$_POST['password'];

     /* Code image */   
    $image_name =  $_FILES['image']['name'];
    $image_type = $_FILES['image']['type']; 
    $image_path = $_FILES['image']['tmp_name'];
    $location = "uploads/";
    $mih=move_uploaded_file($image_path , $location . $image_name );
/* Code image ; */

    /* INSERT in database sudent and user table */
    $insert="INSERT INTO `students` VALUES (NULL,'$name',$level,'$image_name',$teacherid)";
    $i = mysqli_query($conn,$insert);
    $f=getid("students","studentid");
    $insertuser="INSERT INTO `user` VALUES (NULL,'$name','student','slist','$password',$f)";
    $io = mysqli_query($conn,$insertuser);
    testmessage($i,"record added");
    testmessage($io,"username = $name and password = $password ");
    /*end INSERT in database sudent and user table */
}


$name="";
$level="";
$teacherid="";
$editmode=false;
if(isset($_GET['Edit'])){/*edit mode in add.php file  */
    $id=$_GET['Edit'];
    $show="SELECT * FROM `students` where studentid= $id"  ;
    $s = mysqli_query($conn,$show);
    $row=mysqli_fetch_assoc($s);
    $name=$row['name'];
    $level=$row['level'];
    $teacherid=$row['teacherid'];
    $editmode=true;
    if(isset($_POST['sendEdit'])){
        $name=$_POST['name'];
        $level=$_POST['level'];
        $teacherid=$_POST['teacherid'];
        $update="UPDATE `students` SET name='$name', level=$level, teacherid=$teacherid WHERE studentid=$id";
        $u = mysqli_query($conn,$update);
        testmessage($u,"record modified");
        header("location: /amit/students/list.php");
    }
}
?>
<?php if(isset($_SESSION['Validity'])){ ?>
    <?php if($_SESSION['Validity']=="full"){ ?>
<?php if($editmode): ?>
    <h1 class="text-center text-primary">Edit students</h1>
<?php else:?>
    <h1 class="text-center text-primary">Add students</h1>
<?php endif ?>


<div class="container bg-dark p-5 text-center mt-5">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="namet">name</label>
            <input type="text" required value="<?php echo $name ?>" name="name" class="form-control" id="namet" placeholder="student name">
        </div>
        <div class="form-group">
            <label for="levelt">level</label>
            <input type="number" min="1" max="12" required  value="<?php echo $level ?>" name="level" class="form-control" id="levelt" placeholder="level">
        </div>
        <?php if(!$editmode){ ?>
        <div class="form-group">
                    <label>Image</label>
                    <input type="file" required name="image" id="test" class="form-control" placeholder="teacher salary">
        </div>
        <?php } ?>
        <div class="form-group">
            <label for="teachersIDt">teachersID</label>
            <select name="teacherid" class="form-control" id="teachersIDt">
                <?php
                 $show1="SELECT * FROM `teacher`";
                 $s1 = mysqli_query($conn,$show1);
                 foreach($s1 as $data){
                 ?>
                <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <?php if(!$editmode){ ?>
        <div class="form-group">
            <label for="passwordt">password</label>
            <input required type="password"  name="password" class="form-control" id="levelt" placeholder="password">
        </div>
        <?php }?>
        <div class="form-group">
            <?php if($editmode){ ?>
                <button name="sendEdit" class="btn btn-info w-50 mx-auto">Edit student</button>
            <?php }else{ ?>
                <button name="send" class="btn btn-primary w-50 mx-auto">Add student</button>
            <?php } ?>
        </div>
    </form>
</div>
<?php }else{
echo "<h1 class='text-center text-primary my-3'>not authorized</h1>";
}
}else{ ?>

    <h1 class="text-center text-primary">create account</h1>

<div class="container bg-dark p-5 text-center mt-5">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="namet">name</label>
            <input type="text" required value="<?php echo $name ?>" name="name" class="form-control" id="namet" placeholder="student name">
        </div>
        <div class="form-group">
            <label for="levelt">level</label>
            <input type="text" required  value="<?php echo $level ?>" name="level" class="form-control" id="levelt" placeholder="level">
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" required name="image" id="test" class="form-control" placeholder="teacher salary">
        </div>
        <div class="form-group">
            <label for="teachersIDt">teachersID</label>
            <select name="teacherid" class="form-control" id="teachersIDt">
                <?php
                 $show1="SELECT * FROM `teacher`";
                 $s1 = mysqli_query($conn,$show1);
                 foreach($s1 as $data){
                 ?>
                <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="passwordt">password</label>
            <input required type="password"  name="password" class="form-control" id="passwordt" placeholder="password">
        </div>
        <div class="form-group">
                <button name="send" class="btn btn-primary w-50 mx-auto">Add student</button>
        </div>
    </form>
</div>
<?php
}
include "../forAll/footer.php";
?>