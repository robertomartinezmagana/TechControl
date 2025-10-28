<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Inicio de Sesión: Empleado</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
  <div class="form-card">
    <div class="top-icon">👨‍💼</div>
    <h2>Inicio de Sesión: Empleado</h2>
    <p class="sub">Ingrese su usuario y contraseña</p>

    <form action="../php/login.php" method="post">
      <input type="hidden" name="role" value="empleado" />
      <div class="form-row">
        <label for="usuario">Usuario:</label>
        <input id="usuario" name="usuario" type="text" required />
      </div>

      <div class="form-row pw-row">
        <label for="password">Contraseña:</label>
        <input id="password" name="password" type="password" required />
        <span class="pw-toggle" data-target="#password"></span>
      </div>

      <button class="submit-btn" type="submit">Iniciar sesión</button>
    </form>

    <div class="form-footer">
      ¿No tiene una cuenta? <a href="registro_empleado.php">Regístrese aquí</a><br>
    </div>
  </div>
</body>
</html>
