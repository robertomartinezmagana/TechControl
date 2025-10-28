<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Empleado</title>
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
  <main class="form-card">
    <div class="top-icon">👨‍💼</div>
    <h2>Registro</h2>
    <p class="sub">Cree una cuenta de Empleado</p>

    <form id="form-employee" action="../php/registrar_empleado.php" method="post" autocomplete="off">
      <input type="hidden" name="role" value="empleado">

    <div class="form-row"><label>Nombre(s):</label><input name="nombre" type="text" required /></div>
    <div class="form-row"><label>Apellidos:</label><input name="apellidos" type="text" required /></div>
    <div class="form-row"><label>Correo electrónico:</label><input name="correo" type="email" required /></div>
    <div class="form-row"><label>Teléfono:</label><input name="telefono" type="tel" /></div>

      <!-- Contraseña -->
      <div class="form-row">
        <label>Contraseña:</label>
        <div class="pwd-container">
          <input type="password" id="pass1-employee" name="password" required>
          <button type="button" class="toggle-pwd" data-target="pass1-employee">👁️</button>
        </div>
      </div>

      <!-- Verificación -->
      <div class="form-row">
        <label>Verifica Contraseña:</label>
        <div class="pwd-container">
          <input type="password" id="pass2-employee" name="password_verify" required>
          <button type="button" class="toggle-pwd" data-target="pass2-employee">👁️</button>
        </div>
      </div>

      <!-- Reglas de contraseña -->
      <div class="pwdReq">
        <p>Contraseña debe tener:</p>
        <p id="lengthReq-employee" class="req fail" data-text="entre 10 y 15 caracteres">❌ entre 10 y 15 caracteres</p>
        <p id="lowerReq-employee" class="req fail" data-text="al menos una letra minúscula">❌ al menos una letra minúscula</p>
        <p id="upperReq-employee" class="req fail" data-text="al menos una letra mayúscula">❌ al menos una letra mayúscula</p>
        <p id="specialReq-employee" class="req fail" data-text="al menos un carácter especial">❌ al menos un carácter especial</p>
        <p id="digitReq-employee" class="req fail" data-text="al menos un dígito (0-9)">❌ al menos un dígito (0-9)</p>
      </div>

      <button type="submit" id="submit-employee" class="submit-btn" enabled>Registrar Usuario</button>
    </form>

    <div class="form-footer">
      ¿Ya tiene una cuenta? <a href="login_empleado.php">Inicie sesión</a><br><br>
      <a href="../portal.php">Volver al portal</a>
    </div>
  </main>

  <!-- JavaScript -->
  <script src="../js/validacion_empleado.js"></script>
</body>
</html>



