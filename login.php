<?php 
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: admin.php");
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username =='admin' && $password == 123) {
        $_SESSION['username'] = $username;
        header("Location: admin.php");
    } else {
        $err = 'Username Atau Password Salah';
    }
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin | Login</title>
</head>
<body> 
    <div class="flex justify-center items-center h-screen">
        <form  method="POST" class="bg-slate-200 rounded-md p-32">
            <h1 class="text-4xl font-semibold text-center mb-5">Login</h1>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" class="mb-3 border-2 rounded-md px-4 py-2" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" class=" border-2 rounded-md px-4 py-2" required>
            </div>
            <div class="px-3 py-1 bg-blue-500 mt-5 text-center text-white ">
                <button name="submit" class="btn">Login</button>
            </div>
            <div class="text-red-500 mt-5"><?php echo $err; ?></div>
        </form>
    </div>
</body>
</html>