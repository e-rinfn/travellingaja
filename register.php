<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar - TravellingAja</title>
</head>

<body style="background:#111; color:white; font-family:Poppins; display:flex; justify-content:center; align-items:center; height:100vh;">

<div style="background:#222; padding:30px; border-radius:10px;">
<h2>Daftar</h2>

<form action="proses_register.php" method="POST">
<input type="text" name="nama" placeholder="Nama" required><br><br>
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>

<button type="submit">Daftar</button>
</form>

<p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>

</body>
</html>