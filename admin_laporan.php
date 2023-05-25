<?php
include('control.php');

$datahal = 4;
// navi halaman valid usulan
$mysqli = mysqli_query($conn, "SELECT data_laporan FROM valid_laporan");
$jumlahdata = mysqli_num_rows($mysqli);
$jumlahHalaman = ceil($jumlahdata / $datahal);

$halamanaktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
$awaldata = ($datahal * $halamanaktif) - $datahal;

// navi halaman temp usulan
$mysqlitemp = mysqli_query($conn, "SELECT data_laporan FROM laporan");
$jumlahdatatemp = mysqli_num_rows($mysqlitemp);
$jumlahHalamantemp = ceil($jumlahdatatemp / $datahal);

$halamanaktiftemp = (isset($_GET['haltemp'])) ? $_GET['haltemp'] : 1;
$awaldatatemp = ($datahal * $halamanaktiftemp) - $datahal;

$sqllaporan = "SELECT users.nama, users.username, laporan.id, laporan.data_laporan 
FROM users, laporan
WHERE users.id = laporan.id_users order by id desc limit $awaldatatemp,$datahal";

$sqlvallaporan = "SELECT users.nama, users.username, valid_laporan.id, valid_laporan.data_laporan 
FROM users, valid_laporan
WHERE users.id = valid_laporan.id_users order by id desc limit $awaldata,$datahal";
$resultlaporan = $conn->query($sqllaporan);
$resultvallaporan = $conn->query($sqlvallaporan);

?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Admin | Warga</title>
</head>

<body>
  <section class="h-screen overflow-auto">
    <!-- nav start -->
    <nav class="w-full flex bg-[#0A4D68] text-white items-center gap-16 py-4 sticky top-0">
      <h1 class="text-2xl font-bold ml-10">Admin Karang Taruna</h1>
      <ul class="flex gap-3 font-semibold">
        <li><a href="admin_laporan.php" class="px-4 py-2 bg-red-500 text-lg block">Data Laporan</a></li>
        <li><a href="admin_usulan.php" class="px-4 py-2 text-lg block">Data Usulan</a></li>
        <li><a href="index.php" class="px-4 py-2 text-lg block">Ke Page Warga</a></li>
      </ul>
    </nav>
    <!-- nav end -->
    <form method="post" class="flex justify-evenly">
      <div class="w-1/2 m-4">
        <h1 class="px-5">Data Laporan Yang Belum Di Konfirmasi</h1>
        <h1 class="px-5">Total Data <?php echo $jumlahdatatemp ?></h1>
        <?php
        if ($resultlaporan->num_rows > 0) {
          // output data of each row
          while ($row = $resultlaporan->fetch_assoc()) {
        ?>
            <div class="p-5 border-b-2">
              <p class="mb-1">Username <?php echo $row['username'] ?></p>
              <p class="mb-2">Nama <?php echo $row['nama'] ?></p>
              <p>Laporan :</p>
              <p class="mb-5"><?php echo $row['data_laporan'] ?></p>
              <a class="px-4 py-2 rounded-lg bg-red-500 text-white hover:opacity-80" href="delete_laporan.php?del=<?php echo $row['id'] ?>">delete</a>
              <a class="px-4 py-2 rounded-lg bg-blue-500 text-white hover:opacity-80" href="confirm_laporan.php?confirm=<?php echo $row['id'] ?>">confirm</a>
            </div>

        <?php
          }
        }
        ?>
        <div class="flex justify-center gap-2 ">
          <?php if ($halamanaktiftemp > 1 && $resultlaporan->num_rows > 0) : ?>
            <a class="bg-blue-500 rounded-lg px-3 py-1 text-white" href="?haltemp=<?= $halamanaktiftemp - 1 ?>&hal=<?= $halamanaktif  ?> ">&lt;</a>
          <?php endif ?>
          <?php for ($s = 1; $s <= $jumlahHalamantemp; $s++) : ?>
            <?php if ($s == $halamanaktiftemp) : ?>
              <a class="bg-red-500 rounded-lg px-3 py-1 text-white" href="?haltemp=<?= $s ?>&hal=<?= $halamanaktif  ?>"><?= $s ?></a>
            <?php else : ?>
              <a class="bg-blue-500 rounded-lg px-3 py-1 text-white" href="?haltemp=<?= $s ?>&hal=<?= $halamanaktif  ?>"><?= $s ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($halamanaktiftemp < $jumlahHalamantemp) : ?>
            <a class="bg-blue-500 rounded-lg px-3 py-1 text-white" href="?haltemp=<?= $halamanaktiftemp + 1 ?>&hal=<?= $halamanaktif  ?>">&gt;</a>
          <?php endif ?>
        </div>
      </div>

      <div class="w-1/2   m-4">
        <h1 class="px-5">Data Laporan Yang Sudah Di Konfirmasi</h1>
        <h1 class="px-5">Total Data <?php echo $jumlahdata ?></h1>
        <?php
        if ($resultvallaporan->num_rows > 0) {
          // output data of each row
          while ($row = $resultvallaporan->fetch_assoc()) {
        ?>
            <div class="p-5 border-b-2">
              <p class="mb-1">Username <?php echo $row['username'] ?></p>
              <p class="mb-2">Nama <?php echo $row['nama'] ?></p>
              <p>Laporan :</p>
              <p class="mb-5"><?php echo $row['data_laporan'] ?></p>
              <a class="px-4 py-2 rounded-lg bg-red-500 text-white hover:opacity-80" href="delete_laporan_val.php?del=<?php echo $row['id'] ?>">delete</a>
            </div>

        <?php
          };
        }
        ?>
        <div class="flex justify-center gap-2">
          <?php if ($halamanaktif > 1 && $resultvallaporan->num_rows > 0) : ?>
            <a class="bg-blue-500 rounded-lg px-3 py-1 text-white" href="?hal=<?= $halamanaktif - 1 ?>&haltemp=<?= $halamanaktiftemp  ?>">&lt;</a>
          <?php endif ?>
          <?php for ($s = 1; $s <= $jumlahHalaman; $s++) : ?>
            <?php if ($s == $halamanaktif) : ?>
              <a class="bg-red-500 rounded-lg px-3 py-1 text-white" href="?hal=<?= $s ?>&haltemp=<?= $halamanaktiftemp  ?>"><?= $s ?></a>
            <?php else : ?>
              <a class="bg-blue-500 rounded-lg px-3 py-1 text-white" href="?hal=<?= $s ?>&haltemp=<?= $halamanaktiftemp  ?>"><?= $s ?></a>
            <?php endif ?>
          <?php endfor; ?>
          <?php if ($halamanaktif < $jumlahHalaman) : ?>
            <a class="bg-blue-500 rounded-lg px-3 py-1 text-white" href="?hal=<?= $halamanaktif + 1 ?>&haltemp=<?= $halamanaktiftemp  ?>">&gt;</a>
          <?php endif ?>
        </div>
      </div>

    </form>
  </section>
</body>

</html>