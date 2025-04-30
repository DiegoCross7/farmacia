<?php
session_start(); // Movido al inicio - antes de cualquier salida HTML
include('./constant/layout/head.php');
include('./constant/connect.php');
?>
<link rel="stylesheet" href="assets/css/popup_style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }

  body {
    background-color: #f9f9f9;
    position: relative;
    min-height: 100vh;
    overflow-x: hidden;
  }

  #main-wrapper {
    padding: 0;
    margin: 0;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(16, 43, 73, 0.9), rgba(39, 55, 77, 0.85));
  }

  .unix-login {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
  }

  .container-fluid {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
  }

  .container-fluid::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(16, 43, 73, 0.8), rgba(92, 74, 199, 0.7));
    z-index: 1;
  }

  .row {
    position: relative;
    width: 100%;
    z-index: 2;
    display: flex;
    justify-content: center;
  }

  .login-content {
    max-width: 450px;
    width: 90%;
    padding: 20px;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
    animation: fadeIn 0.8s ease-in-out;
    transform: translateY(0);
    transition: all 0.4s ease;
  }

  .login-content:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .login-form {
    padding: 20px;
  }

  .login-form img {
    margin-bottom: 10px;
    transition: transform 0.3s ease;
  }

  .login-form img:hover {
    transform: scale(1.05);
  }

  .form-group {
    margin-bottom: 25px;
    position: relative;
  }

  .form-group label {
    display: block;
    color: #102b49;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 14px;
    transform: translateY(0);
    transition: all 0.3s;
  }

  .form-control {
    width: 100%;
    padding: 15px 20px;
    font-size: 14px;
    border: none;
    border-radius: 10px;
    background-color: #f0f4f8;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
  }

  .form-control:focus {
    background-color: #fff;
    box-shadow: 0 0 0 3px rgba(92, 74, 199, 0.2);
    outline: none;
  }

  .form-group i {
    position: absolute;
    right: 15px;
    top: 14px;
    color: #102b49;
  }

  button[type="submit"] {
    width: 100%;
    padding: 15px 20px;
    background: linear-gradient(135deg, #102b49, #5c4ac7);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    box-shadow: 0 10px 20px rgba(92, 74, 199, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  button[type="submit"]:hover {
    background: linear-gradient(135deg, #5c4ac7, #102b49);
    box-shadow: 0 15px 25px rgba(92, 74, 199, 0.4);
    transform: translateY(-3px);
  }

  button[type="submit"]:active {
    transform: translateY(1px);
    box-shadow: 0 5px 15px rgba(92, 74, 199, 0.4);
  }

  button[type="submit"]::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
  }

  button[type="submit"]:hover::before {
    left: 100%;
  }

  footer {
    padding: 15px 0;
    background: linear-gradient(to right, #102b49, #5c4ac7);
    color: white;
    font-size: 14px;
    width: 100%;
    position: fixed;
    bottom: 0;
    z-index: 1000;
  }

  footer a {
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  footer a:hover {
    color: #f0f4f8;
    text-decoration: underline;
  }

  /* Pop-up Styles Enhancement */
  .popup {
    z-index: 1050;
  }

  .popup__content {
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    animation: popIn 0.5s ease-out;
  }

  @keyframes popIn {
    0% {
      transform: scale(0.5);
      opacity: 0;
    }

    100% {
      transform: scale(1);
      opacity: 1;
    }
  }

  .popup_content_title {
    font-weight: 700;
    color: #102b49;
  }

  .popup--icon.-success .popup__content {
    background-color: #f0faf0;
    border-left: 6px solid #28a745;
  }

  .popup--icon.-error .popup__content {
    background-color: #fff0f0;
    border-left: 6px solid #dc3545;
  }

  .button--error {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .button--error:hover {
    background-color: #c82333;
    transform: translateY(-2px);
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .login-content {
      width: 95%;
      padding: 15px;
    }

    .form-control {
      padding: 12px 15px;
    }

    button[type="submit"] {
      padding: 12px 15px;
    }
  }

  /* Animated Background */
  .animated-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    overflow: hidden;
  }

  .animated-bg span {
    position: absolute;
    display: block;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: move 8s linear infinite;
  }

  @keyframes move {
    0% {
      transform: translateY(0) rotate(0deg);
      opacity: 1;
      border-radius: 0;
    }

    100% {
      transform: translateY(-1000px) rotate(720deg);
      opacity: 0;
      border-radius: 50%;
    }
  }

  /* Ocultar cualquier footer o copyright generado dinámicamente */
  .footer-copy,
  .copyright,
  .site-info,
  .copy-text,
  .footer-bottom,
  footer p,
  footer div,
  .footer1,
  .footer p,
  [class*="mayuri"],
  [class*="copy"],
  [class*="right"],
  div[style*="position: fixed"][style*="bottom: 0"] {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    height: 0 !important;
    padding: 0 !important;
    margin: 0 !important;
  }

  /* Añadir nuestro propio footer */
  body::after {
    content: "Copyright © 2025 Project Developed by Diego Centeno";
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: #f5f5f5;
    color: #5c4ac7;
    text-align: center;
    padding: 10px 0;
    z-index: 999999;
    font-size: 14px;
    border-top: 1px solid #eee;
  }
</style>
<?php

include('./constant/layout/head.php');
include('./constant/connect.php');
session_start();

if (isset($_SESSION['userId'])) {
  //header('location:'.$store_url.'login.php');   
}

$errors = array();

if ($_POST) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    if ($email == "") {
      $errors[] = "email is required";
    }

    if ($password == "") {
      $errors[] = "Password is required";
    }
  } else {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $connect->query($sql);

    if ($result->num_rows == 1) {
      $password = md5($password);
      // exists
      $mainSql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
      $mainResult = $connect->query($mainSql);

      if ($mainResult->num_rows == 1) {
        $value = $mainResult->fetch_assoc();
        $user_id = $value['user_id'];

        // set session
        $_SESSION['userId'] = $user_id; ?>



        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup_content_title">
              Login Exitoso
            </h3>
            <p>Acceso Exitoso</p>
            <p>
              <script>
                // Redirección más robusta
                setTimeout(function() {
                  window.location.href = 'dashboard.php';
                }, 1500);
              </script>
            </p>
          </div>
        </div>
      <?php  } else {
      ?>


        <div class="popup popup--icon -error js_error-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup_content_title">
              Error
            </h3>
            <p>Correo o Contraseña Incorrectos</p>
            <p>
              <a href="login.php"><button class="button button--error" data-for="js_error-popup">Cerrar</button></a>
            </p>
          </div>
        </div>

      <?php } // /else
    } else { ?>
      <div class="popup popup--icon -error js_error-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
          <h3 class="popup_content_title">
            Error
          </h3>
          <p>Correo no existe</p>
          <p>
            <a href="login.php"><button class="button button--error" data-for="js_error-popup">Cerrar</button></a>
          </p>
        </div>
      </div>

<?php } // /else
  } // /else not empty email // password

} // /if $_POST

?>

<div id="main-wrapper">
  <div class="unix-login">
    <div class="container-fluid" style="background-image: url('assets/uploadImage/Logo/banner3.jpg');">
      <!-- Animated Background Elements -->
      <div class="animated-bg">
        <?php for ($i = 0; $i < 10; $i++) {
          $size = rand(10, 30);
          $left = rand(0, 100);
          $top = rand(0, 100);
          $duration = rand(5, 15);
          echo '<span style="width:' . $size . 'px; height:' . $size . 'px; left:' . $left . '%; top:' . $top . '%; animation-duration:' . $duration . 's;"></span>';
        } ?>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="login-content">
            <div class="login-form">
              <center>
                <img src="./assets/uploadImage/Logo/logo.png" style="width: 250px;" alt="Logo">
              </center>
              <h4 class="text-center mt-4 mb-4" style="color: #102b49; font-weight: 600;">Acceso al Sistema</h4>

              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm" class="row">
                <div class="form-group col-md-12">
                  <label class="control-label">Correo Electrónico</label>
                  <div class="input-group">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Ingresa tu correo" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Dirección de correo inválida" required>
                    <i class="fas fa-envelope"></i>
                  </div>
                </div>

                <div class="form-group col-md-12">
                  <label>Contraseña</label>
                  <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                    <i class="fas fa-lock"></i>
                  </div>
                </div>

                <div class="col-md-12">
                  <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">
                    <i class="fas fa-sign-in-alt mr-2"></i> Ingresar al Sistema
                  </button>
                </div>
              </form>

              <div class="text-center mt-4">
                <p style="color: #102b49; font-size: 13px;">Sistema de Gestión Empresarial</p>
                <div class="social-auth mt-3">
                  <a href="#" class="btn btn-outline-primary btn-sm" style="margin-right: 10px; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                  <a href="#" class="btn btn-outline-info btn-sm" style="margin-right: 10px; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#" class="btn btn-outline-danger btn-sm" style="border-radius: 50%; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fab fa-google"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./assets/js/lib/jquery/jquery.min.js"></script>
<script src="./assets/js/lib/bootstrap/js/popper.min.js"></script>
<script src="./assets/js/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/js/jquery.slimscroll.js"></script>
<script src="./assets/js/sidebarmenu.js"></script>
<script src="./assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="./assets/js/custom.min.js"></script>

<script>
  // Animación mejorada para el formulario
  $(document).ready(function() {
    $('.form-group').each(function(index) {
      $(this).delay(100 * index).animate({
        opacity: 1,
        top: 0
      }, 500);
    });

    // Agregar efecto de enfoque para los campos
    $('.form-control').focus(function() {
      $(this).parent().addClass('focused');
    }).blur(function() {
      if ($(this).val() === '') {
        $(this).parent().removeClass('focused');
      }
    });
  });
</script>
<script>
  // Este script se ejecutará después de que todos los demás scripts hayan cargado
  window.addEventListener('load', function() {
    // Esperar un poco para asegurarnos de que todo se ha cargado y renderizado
    setTimeout(function() {
      // Buscar y ocultar cualquier elemento que pueda contener el copyright
      var elements = document.querySelectorAll('footer, .footer, .copyright, .site-info, [class*="footer"], [class*="copy"]');
      elements.forEach(function(el) {
        el.style.display = 'none';
      });

      // Crear nuestro propio footer
      var newFooter = document.createElement('div');
      newFooter.innerHTML = 'Copyright © 2025 Project Developed by Diego Centeno';
      newFooter.style.position = 'fixed';
      newFooter.style.bottom = '0';
      newFooter.style.left = '0';
      newFooter.style.width = '100%';
      newFooter.style.background = '#f5f5f5';
      newFooter.style.color = '#5c4ac7';
      newFooter.style.textAlign = 'center';
      newFooter.style.padding = '10px 0';
      newFooter.style.zIndex = '999999';
      newFooter.style.fontSize = '14px';
      newFooter.style.borderTop = '1px solid #eee';

      document.body.appendChild(newFooter);
    }, 500);
  });
</script>
</body>

</html>