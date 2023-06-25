<?php

session_start();
if(isset($_SESSION['user'])){
  header("location: index.php");
}
$conn = mysqli_connect('localhost', 'root', '', 'login_signup');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // // Retrieve form data
  $email = $_POST["email"];
  $password = $_POST["pass"];
  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

  $check = "SELECT * FROM `users` WHERE email = '$email' AND password = '$hashedPassword'";
  $res = mysqli_query($conn, $check);

  if ($email == '' || $password == '') {
    $error = "Please fill all fields";
  } elseif ($password != '') {


    $checkPass = "SELECT * FROM `users` WHERE email = '$email'";
    $resPass = mysqli_query($conn, $checkPass);

    // Retrieve the stored hash from the database or any other storage
    $storedHash = mysqli_fetch_assoc($resPass); // Replace '...' with the actual stored hash
    if(mysqli_num_rows($resPass)){

   
    // Verify the password
    if (password_verify($password, $storedHash['password']) AND $storedHash['email'] == $email) {
      // sending to index
        header("Location: index.php");
        $_SESSION['user'] = $storedHash['name'];

  } else {
    $error = "Incorrect username or passowrd";
  }
}else{
  $error = "Email doesn't exist";
}
}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign Up Form by Colorlib</title>

  <!-- <link rel="stylesheet" href="assets/font.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="assets/style.css">
  <meta name="robots" content="noindex, follow">
  <script nonce="8126608d-808d-48e0-82ee-a81224e27259">
    (function(w, d) {
      ! function(dK, dL, dM, dN) {
        dK[dM] = dK[dM] || {};
        dK[dM].executed = [];
        dK.zaraz = {
          deferred: [],
          listeners: []
        };
        dK.zaraz.q = [];
        dK.zaraz._f = function(dO) {
          return function() {
            var dP = Array.prototype.slice.call(arguments);
            dK.zaraz.q.push({
              m: dO,
              a: dP
            })
          }
        };
        for (const dQ of ["track", "set", "debug"]) dK.zaraz[dQ] = dK.zaraz._f(dQ);
        dK.zaraz.init = () => {
          var dR = dL.getElementsByTagName(dN)[0],
            dS = dL.createElement(dN),
            dT = dL.getElementsByTagName("title")[0];
          dT && (dK[dM].t = dL.getElementsByTagName("title")[0].text);
          dK[dM].x = Math.random();
          dK[dM].w = dK.screen.width;
          dK[dM].h = dK.screen.height;
          dK[dM].j = dK.innerHeight;
          dK[dM].e = dK.innerWidth;
          dK[dM].l = dK.location.href;
          dK[dM].r = dL.referrer;
          dK[dM].k = dK.screen.colorDepth;
          dK[dM].n = dL.characterSet;
          dK[dM].o = (new Date).getTimezoneOffset();
          if (dK.dataLayer)
            for (const dX of Object.entries(Object.entries(dataLayer).reduce(((dY, dZ) => ({
                ...dY[1],
                ...dZ[1]
              })), {}))) zaraz.set(dX[0], dX[1], {
              scope: "page"
            });
          dK[dM].q = [];
          for (; dK.zaraz.q.length;) {
            const d_ = dK.zaraz.q.shift();
            dK[dM].q.push(d_)
          }
          dS.defer = !0;
          for (const ea of [localStorage, sessionStorage]) Object.keys(ea || {}).filter((ec => ec.startsWith("_zaraz_"))).forEach((eb => {
            try {
              dK[dM]["z_" + eb.slice(7)] = JSON.parse(ea.getItem(eb))
            } catch {
              dK[dM]["z_" + eb.slice(7)] = ea.getItem(eb)
            }
          }));
          dS.referrerPolicy = "origin";
          dS.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(dK[dM])));
          dR.parentNode.insertBefore(dS, dR)
        };
        ["complete", "interactive"].includes(dL.readyState) ? zaraz.init() : dK.addEventListener("DOMContentLoaded", zaraz.init)
      }(w, d, "zarazData", "script");
    })(window, document);
  </script>
</head>

<body>
  <div class="main">


    <section class="sign-in">
      <div class="container">
        <div class="signin-content">
          <div class="signin-image">
            <figure><img src="assets/images/signin-image.jpg" alt="sing up image"></figure>
            <a href="register.php" class="signup-image-link">Create an account</a>
          </div>
          <div class="signin-form">
            <h2 class="form-title">Login In</h2>
            <p style="color:red;"></p><?php echo @$error; ?></p>
            <form method="POST" class="register-form" id="login-form">
              <div class="form-group">
                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                <input type="email" name="email" id="your_name" placeholder="Your Email" autocomplete="off" />
              </div>
              <div class="form-group">
                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                <input type="password" name="pass" id="your_pass" placeholder="Password"  autocomplete="off"/>
              </div>
              <div class="form-group">
                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
              </div>
              <div class="form-group form-button">
                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
              </div>
            </form>
            <div class="social-login">
              <span class="social-label">Or login with</span>
              <ul class="socials">
                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>

  <script src="assets/jquery.min.js"></script>
  <script src="js/main.js"></script>

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
  </script>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816" integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw==" data-cf-beacon='{"rayId":"7d5871397a9e40ce","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.4.0","si":100}' crossorigin="anonymous"></script>
</body>

</html>