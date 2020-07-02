<?php
for($i = 0; $i < 3; $i++){
  if($i = 3) $i = 0;
}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Translator SQL Setup</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <header style="width: 1600px; height: 800px;">
      <img src="image/logo.png" style="width: 1600px; height: 800px; align: center;" alt="Translator Logo">
    </header>
    <p>We need to collect some infos<?= $i = 1 ? "." : "" ?><?= $i = 2 ? ".." : "" ?><?= $i = 3 ? "..." : "" ?></p>
</html>
