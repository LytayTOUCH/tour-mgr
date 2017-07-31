<?php
// This class is used to include all php file in multiple direcotry structure.
class Autoloader{

  private $plugin_dir;
  private static $init;

  public static function init(){
    if(!isset(self::$init)){
      return self::$init = new self;
    }
    return self::$init;
  }

  public function __construct(){
    $this->plugin_dir = plugin_dir_path(dirname(dirname(__FILE__)));
  }

  public function loadCore($classname){
    return $this->loadDependencies($classname, 'includes/core/','-class', '.php' );
  }
  public function loadAdminController($classname){
    return $this->loadDependencies($classname, 'admin/controllers/','-class', '.php' );
  }
  public function loadAdminModels($classname){
    return $this->loadDependencies($classname, 'admin/models/','-class', '.php' );
  }
  public function loadAdminViews($classname){
    return $this->loadDependencies($classname, 'admin/views/','-class', '.php' );
  }
  public function loadAdminLibs($classname){
    return $this->loadDependencies($classname, 'admin/libs/','-class', '.php' );
  }
  public function loadTables($classname){
    return $this->loadDependencies($classname, 'includes/database/tables/','-class', '.php' );
  }

  public function loadDependencies($classname, $dir_path, $alias_name, $extension){
    $filename = str_replace(array('_'), array('-'), strtolower($classname)).$alias_name.$extension;
    $file = $this->plugin_dir.$dir_path.$filename;
    if (file_exists($file)){
        if(!class_exists($classname)){
          require_once $file;
        }
    }
    return $file;
  }

}

spl_autoload_register(function($className){
  Autoloader::init()->loadCore($className);
  Autoloader::init()->loadAdminController($className);
  Autoloader::init()->loadAdminModels($className);
  Autoloader::init()->loadAdminViews($className);
  Autoloader::init()->loadAdminLibs($className);
  Autoloader::init()->loadTables($className);
});
?>
