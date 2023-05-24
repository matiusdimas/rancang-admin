
<?php  


if(isset($_GET['confirm']))
include_once 'control.php';

$sql = "DELETE FROM laporan WHERE id='" . $_GET["confirm"] . "'";
$confirm = "INSERT INTO valid_laporan (id_users, data_laporan) select id_users, data_laporan from laporan where id = '" . $_GET["confirm"] . "'";
if (mysqli_query($conn, $confirm)) {
    if (mysqli_query($conn, $sql)) {
        header("location:admin_laporan.php");
    }
} else {

    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);

?>