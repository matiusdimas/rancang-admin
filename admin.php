<?php 
include('control.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
$sqllaporan = "SELECT * FROM laporan order by id desc";
$sqlusulan = "SELECT * FROM usulan order by id desc";
$resultlaporan = $conn->query($sqllaporan);
$resultusulan = $conn->query($sqlusulan);
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Admin | Karang Taruna</title>
</head>
<body>
<section class="h-screen overflow-auto">
    <!-- nav start -->
    <nav class="w-full flex bg-[#0A4D68] text-white items-center gap-16 py-4 sticky top-0">
        <h1 class="text-2xl font-bold ml-10">Admin Karang Taruna</h1>
        <ul class="flex gap-3 font-semibold">
            <li><a href="admin_laporan.php" class="px-4 py-2 text-lg block" >Data Laporan</a></li>
            <li><a href="admin_usulan.php" class="px-4 py-2 text-lg block" >Data Usulan</a></li>
            <li><a href="index.php" class="px-4 py-2 text-lg block" >Ke Page Karang Taruna</a></li>
            <li><a href="logout.php" class="px-4 py-2 text-lg block" >Logout</a></li>
        </ul>
    </nav>
    <!-- nav end -->
    
<div class=" p-4 border-2 ">

</div>

</section>
</body>
</html>
