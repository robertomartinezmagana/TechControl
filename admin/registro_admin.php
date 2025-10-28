<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Administrador</title>
  <link rel="stylesheet" href="../css/estilos.css">
  <style>
    /* Recomendado para ver los colores de validación */
    .req.ok { color: green; }
    .req.fail { color: red; }
  </style>
</head>
<body>
  <div class="form-card">
    <div class="top-icon">🛡️</div>
    <h2>Registro</h2>
    <p class="sub">Cree una cuenta de Administrador</p>

    <form action="../php/registrar_admin.php" method="post" novalidate>
      <input type="hidden" name="role" value="administrador" />

      <div class="form-row"><label>Nombre(s):</label><input name="nombre" type="text" required /></div>
      <div class="form-row"><label>Apellidos:</label><input name="apellidos" type="text" required /></div>
      <div class="form-row"><label>Correo electrónico:</label><input name="correo" type="email" required /></div>
      <div class="form-row"><label>Teléfono:</label><input name="telefono" type="tel" /></div>

      <!-- Contraseña -->
      <div class="form-row">
        <label>Contraseña:</label>
        <div class="pwd-container">
          <input type="password" id="pass1-admin" name="password" required>
          <button type="button" class="toggle-pwd" data-target="pass1-admin">👁️</button>
        </div>
      </div>

      <!-- Confirmar contraseña -->
      <div class="form-row">
        <label>Verifica Contraseña:</label>
        <div class="pwd-container">
          <input type="password" id="pass2-admin" name="password_verify" required>
          <button type="button" class="toggle-pwd" data-target="pass2-admin">👁️</button>
        </div>
      </div>

      <!-- Reglas de la contraseña -->
      <div class="pwdReq">
        <p id="lengthReq-admin" class="req fail" data-text="entre 10 y 15 caracteres">❌ entre 10 y 15 caracteres</p>
        <p id="lowerReq-admin" class="req fail" data-text="al menos una letra minúscula">❌ al menos una letra minúscula</p>
        <p id="upperReq-admin" class="req fail" data-text="al menos una letra mayúscula">❌ al menos una letra mayúscula</p>
        <p id="specialReq-admin" class="req fail" data-text="al menos un carácter especial">❌ al menos un carácter especial</p>
        <p id="digitReq-admin" class="req fail" data-text="al menos un dígito (0-9)">❌ al menos un dígito (0-9)</p>
      </div>

      <br>

      <button type="submit" id="submit-admin" class="submit-btn" enabled>Registrar Usuario</button>
    </form>

    <div class="form-footer">
      ¿Ya tiene una cuenta? <a href="login_admin.php">Inicie sesión</a><br><br>
      <a href="../portal.php">Volver al portal</a>
    </div>
  </div>

  <script src="../js/validacion_admin.js"></script>
</body>
</html>
