<?php
include "../forAll/nav.php";
include "../forAll/condigDataBase.php";

    $showData="SELECT * FROM `students`";/* get all students data to list */
    $s = mysqli_query($conn,$showData);


if(isset($_GET['delete'])){/*delete section */
    $delete=$_GET['delete'];
    $deleteData="DELETE FROM `students` where studentid = $delete ";
    $ss = mysqli_query($conn,$deleteData);
    $deleteData="DELETE FROM `user` where id = $delete ";
    $ss = mysqli_query($conn,$deleteData);
    testmessage($ss,"record deleted");
    header("location: /amit/students/list.php");
}
?>
<?php if(isset($_SESSION['Validity'])): ?>
<?php if($_SESSION['Validity']=="full" ||$_SESSION['Validity']=="tlist"): ?>
    <h1 class="text-center text-primary my-3">list studebts</h1>

<div class="container">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">level</th>
                <th scope="col">teachersID</th>
                <th scope="col">Images</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($s as $data){ ?>
            <tr>
                <th scope="row"><?php echo $data['studentid'] ?></th>
                <td><?php echo $data['name'] ?></td>
                <td><?php echo $data['level'] ?></td>
                <td><?php echo $data['teacherid'] ?></td>
                <td><img width="100" src="uploads/<?php echo $data['image'] ?>" alt="name: <?php echo $data['name'] ?>"></td>
                <?php if(isset($_SESSION['Validity'])){ ?>
                <?php if($_SESSION['Validity']=="full"){ ?>
                <td><a onclick="return confirm('are you want to delete thise record')"
                        href="/amit/students/list.php?delete='<?php echo $data['studentid'] ?>'"
                        class="mr-2 btn btn-danger">Delete</a><a
                        href="/amit/students/add.php?Edit='<?php echo $data['studentid'] ?>'"
                        class="btn btn-info">Edit</a></td>
                <?php }else{ ?>
                <td><button disabled class="mr-2 btn btn-danger">Delete</button><button disabled class="btn btn-info">Edit</button></td>
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
include "../forAll/footer.php";
?>