
<?php  


if(isset($_GET['confirm']))
include_once 'control.php';

$sql = "DELETE FROM usulan WHERE id='" . $_GET["confirm"] . "'";
$confirm = "INSERT INTO valid_usulan (id_users, data_usulan) select id_users, usulan from usulan where id = '" . $_GET["confirm"] . "'";
if (mysqli_query($conn, $confirm)) {
    if (mysqli_query($conn, $sql)) {
        header("location:admin_usulan.php");
    }
} else {

    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);

?>