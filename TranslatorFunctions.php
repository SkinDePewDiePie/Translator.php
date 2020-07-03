<?php
namespace Translator\Base;

class Functions{
  private $logDir;
  private $languagesDir;
  private $logger;
  private $databaseConnect;
  private $databaseConnectInitalized;
  private $databaseRequest;
  private $databaseTable;
  private $language;
 
  function __construct($dir){
    require(dirname(__FILE__) . "/TranslatorLogging.php");
                                                                                                                                         
    $this->logDir = $dir;
    $this->languagesDir = $dir;
    $this->logger = new TranslatorLogging($this->logDir);
    $this->databaseConnect = "";
    $this->databaseConnectInitalized = 0;
    $this->databaseRequest = "";
    $this->databaseTable = "";
    $this->language = "";
  }
  
  public function __automaticallyDetectLanguage(){
    $geoip = geoip_region_by_name($_SERVER["REMOTE_ADDR"]);
    $this->language = strtolower($geoip["country_code"])."_".strtoupper($geoip["region"]);
  }

  public function __automaticallyDetectLanguage(){
    if(!extension_loaded("geoip")) return $this->logger->error("You need to enable GeoIP module !");
    $geoip = geoip_region_by_name($_SERVER["REMOTE_ADDR"]);
    $this->language = strtolower($geoip["country_code"])."_".strtoupper($geoip["region"]);
  }                                                                                                                                                                                           
                                                                                                                                                                                              
  public function __connectToDatabase($databaseType, $databaseHost, $databaseName, $databaseUser, $databaseUserPassword, $databaseTable){
    if($databaseType === "" || $databaseHost === "" || $databaseName === "" || $databaseUser === "" || $databaseUserPassword === "" || $d
    $this->databaseConnect = new \PDO($databaseType.":host=".$databaseHost.";dbname=".$databaseName, $databaseUser, $databaseUserPassword
                                                                                                                                                                                              
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
    if($this->language !== "") $language = $this->language;
                                                                                                                                                                                              
    $this->databaseRequest = $this->databaseConnect->prepare("SELECT translatedKey FROM ".$this->databaseTable." WHERE textKey = '$key' AND language = '$language'");
    $this->databaseRequest->execute();
                                                                                                                                                                                              
    return $this->databaseRequest->fetchAll(\PDO::FETCH_ASSOC)[0]["translatedKey"];
  }                                                                                                                                                                                           
                                                                                                                                                                                              
  public function __getTranslateWithJSON($key, $language){
    if($this->language !== "") $language = $this->language;
                                                                                                                                                                                              
    $jsonFileName = $this->languagesDir."/languages/".$language.".json";
    $jsonFile = fopen($jsonFileName, "a+");
    $jsonContent = json_decode(fread($jsonFile, filesize($jsonFileName)), true);
    fclose($jsonFile);
    return $jsonContent[$key];
  }                                                                                                                                                                                           
}     
