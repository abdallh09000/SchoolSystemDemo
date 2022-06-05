<?php
include "../forAll/nav.php";
include "../forAll/condigDataBase.php";

    $showData="SELECT * FROM `teacher`";/* get all teacher data to list */
    $s = mysqli_query($conn,$showData);


if(isset($_GET['delete'])){/*delete section */
    $delete=$_GET['delete'];
    $deleteData="DELETE FROM `teacher` where id = $delete ";
    $ss = mysqli_query($conn,$deleteData);
    $deleteData="DELETE FROM `user` where id = $delete ";
    $ss = mysqli_query($conn,$deleteData);
    testmessage($ss,"record deleted");
    testmessage($ss,"record deleted");
    header("location: /amit/teachers/list.php");
}
?>
<?php if(isset($_SESSION['Validity'])): ?>
<?php if($_SESSION['Validity']=="full" ||$_SESSION['Validity']=="slist"): ?>
<h1 class="text-center text-primary my-3">list teacher</h1>

<div class="container">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <?php if($_SESSION['Validity']=="full"){ ?>
                <th scope="col">salary</th>
                <?php } ?>
                <th scope="col">Images</th>
                <th scope="col">courseid</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($s as $data){ ?>
            <tr>
                <th scope="row"><?php echo $data['id'] ?></th>
                <td><?php echo $data['name'] ?></td>
                <?php if($_SESSION['Validity']=="full"){ ?>
                <td><?php echo $data['salary'] ?></td>
                <td> <img width="100" src="uploads/<?php echo $data['image'] ?>" alt=""> </td>
                <?php } ?>
                <td><?php echo $data['courseid'] ?></td>
                <?php if(isset($_SESSION['Validity'])){ ?>
                <?php if($_SESSION['Validity']=="full"){ ?>
                <td><a onclick="return confirm('are you want to delete thise record note username and password not change')"
                        href="/amit/teachers/list.php?delete='<?php echo $data['id'] ?>'"
                        class="mr-2 btn btn-danger">Delete</a><a
                        href="/amit/teachers/add.php?Edit='<?php echo $data['id'] ?>'" class="btn btn-info">Edit</a>
                </td>
                <?php }else{ ?>
                <td><button disabled class="mr-2 btn btn-danger">Delete</button><button disabled
                        class="btn btn-info">Edit</button></td>
                <?php }} ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php else: ?><!-- authorized validation -->
    <h1 class="text-center text-primary my-3">not authorized</h1>
<?php endif; ?>

<?php endif; ?>


<?php
include "../forAll/footer.php"

?>