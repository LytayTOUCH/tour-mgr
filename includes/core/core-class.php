<?php
class Core{
  private static $init;
  public static function init(){
    if(!isset(self::$init)){
      return self::$init = new self;
    }
    return self::$init;
  }
  public function __construct(){
    $this->loadDependencies();
  }
  public function loadDependencies(){
    require_once('autoloader-class.php');
  }
  public function testCore(){
    return " Test Core Class";
  }

}
?>
