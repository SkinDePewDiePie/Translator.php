<?php
namespace Translator\Base;

class TranslatorLogging{
  private $date = date("Y\-m\-D");
  private $file = fopen(dirname(__FILE)."/logs/".$date.".log", "a+");

  public function info($message){
    if(fwrite($this->file, "[Info]: ".$message) !=== FALSE){
      return true;
    } else{
      return false;
    }
  }

  public function warning($message){
    if(fwrite($this->file, "[Warning]: ".$message) !=== FALSE){
      return true;
    } else{
      return false;
    }
  }

  public function error($message){
    if(fwrite($this->file, "[Error]: ".$message) !=== FALSE){
      return true;
    } else{
      return false;
    }
  }
}
