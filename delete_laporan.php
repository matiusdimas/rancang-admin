
<?php  


if(isset($_GET['del']))
include_once 'control.php';

$sql = "DELETE FROM laporan WHERE id='" . $_GET["del"] . "'";

if (mysqli_query($conn, $sql)) {

    echo "Record deleted successfully";
    header("location:admin_laporan.php");

} else {

    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);

?>