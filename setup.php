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
    <p id="collectInfos">We need to collect some infos</p>
    <form method="POST">
      <label for="databaseType">Database Type: </label>
      <select id="databaseType" name="databaseType">
        <option value="null" id="databaseTypeSelected" selected>-- Choose --</option>
        <option value="mysql">MySQL/MariaDB</option>
      </select><br>
      <label for="databaseName">Database Name: </label><input type="text" name="databaseName" id="databaseName" placeholder="Database Name" value="<?= $_POST["databaseName"] ?>">
      <label for="databaseUser">Database User: </label><input type="text" name="databaseUser" id="databaseUser" placeholder="Database User" value="<?= $_POST["databaseUser"] ?>">
      <label for="databaseUserPassword">Database User Password: </label><input type="password" name="databaseUserPassword" id="databaseUserPassword" placeholder="Database User Password">
      <label for="databaseTable">Database Table: </label><input type="text" name="databaseTable" id="databaseTable" placeholder="Database Table" value="<?= $_POST["databaseTable"] ?>">
    </form>
    <script src="js/script.js"></script>
  </body>
</html>
