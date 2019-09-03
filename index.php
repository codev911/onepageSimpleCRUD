<?php
    $db = mysqli_connect('localhost','root','','crud');
    $query="SELECT * FROM data";
    $getData = mysqli_query($db,$query);

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $query="SELECT nama FROM data WHERE id = $id";
        $getDataForInput = mysqli_query($db,$query);
        $fetchForInput = mysqli_fetch_array($getDataForInput);
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $query="DELETE FROM data WHERE id = $id";
        mysqli_query($db,$query);
        header("location: index.php");
    }
    
    if(isset($_POST['post']) && isset($_GET['edit'])){
        $data = $_POST['nama'];
        $id = $_GET['edit'];
        $query="UPDATE data SET nama = '$data' WHERE id = $id";
        mysqli_query($db,$query);
        header("location: index.php");
    }else if(isset($_POST['post'])){
        $data = $_POST['nama'];
        $query="INSERT INTO data VALUES(NULL,'$data')";
        mysqli_query($db,$query);
        header("location: index.php");
    }
?>
<form action="" method="post">
    <input type="text" name="nama" maxlength="150" <?php if(isset($_GET['edit'])){ ?>value="<?php echo $fetchForInput['nama'] ?>"<?php } ?>/>
    <input type="submit" name="post" value="simpan"/>
</form>
<br/>
<table border="1">
    <tr>
        <td>ID</td>
        <td colspan="2">Nama</td>
    <tr>
    <?php
        while($fetchData = mysqli_fetch_array($getData)){
    ?>
    <tr>
        <td><?php echo $fetchData['id']; ?></td>
        <td><?php echo $fetchData['nama']; ?></td>
        <td>
            <a href="?edit=<?php echo $fetchData['id']; ?>">edit</a>
            <a href="?delete=<?php echo $fetchData['id']; ?>">Delete</a>
        </td>
    <tr>
    <?php } ?>
</table>