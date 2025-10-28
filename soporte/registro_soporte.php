<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Soporte Técnico</title>
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
  <main class="form-card">
    <div class="top-icon">🧰</div>
    <h2>Registro</h2>
    <p class="sub">Cree una cuenta de Soporte Técnico</p>

    <form id="form-support" action="../php/registrar_soporte.php" method="post" autocomplete="off">
      <input type="hidden" name="role" value="soporte">

      <div class="form-row">
        <label>Nombre(s):</label>
        <input type="text" name="nombre" required>
      </div>

      <div class="form-row">
        <label>Apellido Paterno:</label>
        <input type="text" name="apellido_p" required>
      </div>

      <div class="form-row">
        <label>Apellido Materno:</label>
        <input type="text" name="apellido_m">
      </div>

      <div class="form-row">
        <label>Usuario:</label>
        <input type="text" name="usuario" required>
      </div>

      <div class="form-row">
        <label>Correo electrónico:</label>
        <input type="email" name="correo" required>
      </div>

      <!-- Contraseña -->
      <div class="form-row">
        <label>Contraseña:</label>
        <div class="pwd-container">
          <input type="password" id="pass1-support" name="password" required>
          <button type="button" class="toggle-pwd" data-target="pass1-support">👁️</button>
        </div>
      </div>

      <!-- Verificación -->
      <div class="form-row">
        <label>Verifica Contraseña:</label>
        <div class="pwd-container">
          <input type="password" id="pass2-support" name="password_verify" required>
          <button type="button" class="toggle-pwd" data-target="pass2-support">👁️</button>
        </div>
      </div>

      <!-- Reglas de contraseña -->
      <div class="pwdReq">
        <p>Contraseña debe tener:</p>
        <p id="lengthReq-support" class="req fail" data-text="entre 10 y 15 caracteres">❌ entre 10 y 15 caracteres</p>
        <p id="lowerReq-support" class="req fail" data-text="al menos una letra minúscula">❌ al menos una letra minúscula</p>
        <p id="upperReq-support" class="req fail" data-text="al menos una letra mayúscula">❌ al menos una letra mayúscula</p>
        <p id="specialReq-support" class="req fail" data-text="al menos un carácter especial">❌ al menos un carácter especial</p>
        <p id="digitReq-support" class="req fail" data-text="al menos un dígito (0-9)">❌ al menos un dígito (0-9)</p>
      </div>

      <button type="submit" id="submit-support" class="submit-btn" enabled>Registrar Usuario</button>
    </form>

    <div class="form-footer">
      ¿Ya tiene una cuenta? <a href="login_admin.php">Inicie sesión</a><br><br>
      <a href="../portal.php">Volver al portal</a>
    </div>
  </main>

  <!-- JavaScript -->
  <script src="../js/validacion_soportetecnico.js"></script>
</body>
</html>



