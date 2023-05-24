
<?php  


if(isset($_GET['del']))
include_once 'control.php';

$sql = "DELETE FROM usulan WHERE id='" . $_GET["del"] . "'";

if (mysqli_query($conn, $sql)) {

    echo "Record deleted successfully";
    header("location:admin_usulan.php");

} else {

    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);

?>