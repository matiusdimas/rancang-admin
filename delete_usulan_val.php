
<?php  


if(isset($_GET['del']))
include_once 'control.php';

$sql = "DELETE FROM valid_usulan WHERE id='" . $_GET["del"] . "'";

if (mysqli_query($conn, $sql)) {

    header("location:admin_usulan.php");

} else {

    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);

?>