<?php
function issetAndNotEmpty($variable){
  return isset($variable) && !empty($variable) ? true : false;
}

$error = "";
$success = "";

if(isset($_POST["databaseConnect"])){
  if(issetAndNotEmpty($_POST["databaseType"]) && issetAndNotEmpty($_POST["databaseHost"]) && issetAndNotEmpty($_POST["databaseName"]) && issetAndNotEmpty($_POST["databaseUser"]) && issetAndNotEmpty($_POST["databaseUserPassword"]) && issetAndNotEmpty($_POST["databaseTable"])){
    $databaseType = htmlspecialchars(strip_tags($_POST["databaseType"])) != "null" ? htmlspecialchars(strip_tags($_POST["databaseType"])) : null;
    $databaseHost = htmlspecialchars(strip_tags($_POST["databaseHost"]));
    $databaseName = htmlspecialchars(strip_tags($_POST["databaseName"]));
    $databaseUser = htmlspecialchars(strip_tags($_POST["databaseUser"]));
    $databaseUserPassword = htmlspecialchars(strip_tags($_POST["databaseUserPassword"]));
    $databaseTable = htmlspecialchars(strip_tags($_POST["databaseTable"]));

    $testDatabaseConnect = new PDO($databaseType.":host=".$databaseHost.";dbname=".$databaseName, $databaseUser, $databaseUserPassword);

    if($testDatabaseConnect){
      $tableCreateRequest = $testDatabaseConnect->prepare("CREATE TABLE ".$databaseTable." IF NOT EXISTS ( textKey VARCHAR(255), translatedKey VARCHAR(255), language VARCHAR(255))");
      if($tableCreateRequest->execute()){
        $translatorTest = fopen(dirname(__FILE__)."/translatorTest.php", "a+");
        fwrite($translatorTest, "<?php\n");
        fwrite($translatorTest, "require(dirname(__FILE__).\"/Translator.php/TranslatorFunctions.php\");\n\n");
        fwrite($translatorTest, "$translator = new \\Translator\\Base\\TranslatorFunctions(dirname(__FILE__));\n");
        if(extension_enabled("geoip")) fwrite($translatorTest, "$translator->__automaticallyDetectLanguage();");
        fwrite($translatorTest, "$translator->__connectToDatabase(\"".$databaseType."\", \"".$databaseHost."\", \"".$databaseName."\", \"".$databaseUser."\", \"".$databaseUserPassword."\", \"".$databaseTable."\")");
        fclose($translatorTest);

        $success = "Created the translatorTest.php file located at: ".dirname(__FILE__)."/translatorTest.php !";
      } else{
        $error = "Cannot create the table ! Check if the user have permission `CREATE TABLE`";
      }
    } else{
      $error = "Cannot connect to the database !";
    }
  } else{
    $error = "One/more fields must be completed !";
  }
}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Translator SQL Setup</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <header id="header">
      <img src="image/logo.png" id="logo" alt="Translator Logo">
    </header>
    <p id="collectInfos">We need to collect some infos</p>
    <form method="POST">
      <label for="databaseType">Database Type: </label>
      <select id="databaseType" name="databaseType" id="databaseType">
        <option value="null" selected id="databaseTypeChoose">-- Choose --</option>
        <option value="mysql">MySQL/MariaDB</option>
      </select><br>
      <label for="databaseHost">Database Host: </label><input type="text" name="databaseHost" id="databaseHost" placeholder="Database Host" value="<?= !isset($error) ? $_POST["databaseHost"] : "" ?>"><br>
      <label for="databaseName">Database Name: </label><input type="text" name="databaseName" id="databaseName" placeholder="Database Name" value="<?= !isset($error) ? $_POST["databaseName"] : "" ?>"><br>
      <label for="databaseUser">Database User: </label><input type="text" name="databaseUser" id="databaseUser" placeholder="Database User" value="<?= !isset($error) ? $_POST["databaseUser"] : "" ?>"><br>
      <label for="databaseUserPassword">Database User Password: </label><input type="password" name="databaseUserPassword" id="databaseUserPassword" placeholder="Database User Password"><br>
      <label for="databaseTable">Database Table: </label><input type="text" name="databaseTable" id="databaseTable" placeholder="Database Table" value="<?= !isset($error) ? $_POST["databaseTable"] : "" ?>">
      <input type="submit" name="databaseConnect" value="Send.">
    </form>
    <p id="<?= $error ? "error" : "success" ?>"><?= $error ? $error : $success ?></p>
    <script src="js/script.js"></script>
  </body>
</html>
