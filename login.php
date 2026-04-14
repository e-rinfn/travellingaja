<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login - TravellingAja</title>

<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
  color:white;
}

.login-box {
  background: rgba(255,255,255,0.1);
  padding:30px;
  border-radius:15px;
  backdrop-filter: blur(10px);
  width:300px;
}

input {
  width:100%;
  padding:10px;
  margin:10px 0;
  border:none;
  border-radius:8px;
}

button {
  width:100%;
  padding:10px;
  background:#00c6ff;
  border:none;
  border-radius:8px;
  color:white;
  font-weight:bold;
}

.social {
  margin-top:15px;
}

.social button {
  margin-top:5px;
  background:white;
  color:black;
}
</style>
</head>

<body>

<div class="login-box">
<h2>Login</h2>

<form action="proses_login.php" method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>

<div class="social">
<div id="g_id_onload"
     data-client_id="647816211691-e22qe1qd1ram4mftqrecmgf5hmc52lk8.apps.googleusercontent.com"
     data-login_uri="http://localhost/TravellingAja/google_callback.php">
</div>

<div class="g_id_signin" data-type="standard"></div>

<button>Login dengan Facebook</button>
</div>

<p>Belum punya akun? <a href="register.php" style="color:#00c6ff;">Daftar</a></p>

</div>
<script src="https://accounts.google.com/gsi/client" async defer></script>

<div id="g_id_onload"
     data-client_id="647816211691-e22qe1qd1ram4mftqrecmgf5hmc52lk8.apps.googleusercontent.com"
     data-login_uri="http://localhost/TravellingAja/google_callback.php"
     data-auto_prompt="false">
</div>

<div class="g_id_signin" data-type="standard"></div>

</body>
</html>