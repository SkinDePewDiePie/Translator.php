<?php
namespace Translator\Base;
                                                                                                                                                                                              
class TranslatorLogging{
  private $date;
  private $file;
                                                                                                                                                                                              
  function __construct($dir){
    $this->date = date("Y\-m\-d");
    $this->file = fopen($dir."/logs/".$this->date.".log", "a+");
  }                                                                                                                                                                                           
                                                                                                                                                                                              
  public function info($message){
    if(fwrite($this->file, "\n[Info]: ".$message) !== FALSE){
      return true;
    } else{
      return false;
    }                                                                                                                                                                                         
  }                                                                                                                                                                                           
                                                                                                                                                                                              
  public function warning($message){
    if(fwrite($this->file, "\n[Warning]: ".$message) !== FALSE){
      return true;
    } else{
      return false;
    }                                                                                                                                                                                         
  }                                                                                                                                                                                           
                                                                                                                                                                                              
  public function error($message){
    if(fwrite($this->file, "\n[Error]: ".$message) !== FALSE){
      return true;
    } else{
      return false;
    }                                                                                                                                                                                         
  }                                                                                                                                                                                           
}
