<?php
namespace Translator\Base;

class Functions{
  private $logger = new TranslatorLogging;
  private $databaseConnect = "";
  private $databaseConnectInitalized = 0;
  private $databaseRequest = "";
  private $databaseTable = "";
 
  public function __connectToDatabase($databaseType, $databaseHost, $databaseName, $databaseUser, $databaseUserPassword, $databaseTable){
    if($databaseType === "" || $databaseHost === "" || $databaseName === "" || $databaseUser === "" || $databaseUserPassword === "" || $databaseTable === "") return $this->logger->error("SQL Connect is not valid !");
    $this->databaseConnect = new PDO($databaseType."host=".$databaseHost."dbname=".$databaseName, $databaseUser, $databaseUserPassword);

    if(@$this->databaseConnect){
      $this->logger->info("Successfully connected to the SQL Database !");

      if($this->databaseConnect->prepare("SELECT * FROM ".$databaseTable)->execute()){
        $this->databaseTable = $databaseTable;
        $this->databaseConnectInitalized = 1;
        return $this->logger->info("SQL Table exists !");
      } else{
        return $this->logger->error("SQL Table doesn't exists !");
      }
    } else{
      return $this->logger->error("SQL Error: ".$this->databaseConnect->errorInfo());
    }
  }

  public function __getTranslateWithSQL($key, $language){
    if(!$this->databaseConnectInitalized) return $this->logging->error("SQL Connection is not initalized !");

    $this->databaseRequest = $this->databaseConnect->prepare("SELECT translatedKey FROM ".$this->databaseTable." WHERE key = ".$key." AND language = ".$language);
    $this->databaseRequest->execute();
    return $this->databaseRequest->fetchAll(PDO::FETCH_ASSOC)[0]["translatedKey"];
  }

  public function __getTranslateWithJSON($key, $language){
    $jsonFileName = dirname(__FILE__)."/languages/".$language.".json"
    $jsonFile = fopen($jsonFileName, "a+");
    $jsonContent = json_decode(fread($jsonFile, filesize($jsonFileName)));
    return $jsonContent[$key];
  }
}
