<?php
class Activator{
  private static $init;

  public static function init(){
    if(!isset(self::$init)){
      return self::$init = new self;
    }
    return self::$init;
  }
  public function __construct(){
    // $this->loadCore();
  }

  public function loadCore(){
    require_once('core-class.php');
  }

  public function renderMenu(){
    
  }

  public function test_activator(){
    return 'test activator class';
  }

}

?>
