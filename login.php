<?php
session_start();

if (isset($_POST)) {

  require_once "includes/conexion.php";

  // Validación de entrada
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

  // Consulta SQL con prepared statement
  $stmt = $db->prepare("SELECT * FROM USUARIOS WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
    $verify = password_verify($password, $usuario['password']);

    if ($verify) {
      $_SESSION['usuario'] = $usuario;
      unset($_SESSION['error_login']);
    } else {
      $_SESSION['error_login'] = "Contraseña incorrecta";
    }
  } else {
    $_SESSION['error_login'] = "Usuario no encontrado";
  }

  $stmt->close();

  header("Location: index.php");
}
?>