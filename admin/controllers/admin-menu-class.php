<?php
class Admin_Menu{
  private static $init;

  public static function init(){
    if(!isset(self::$init)){
      self::$init = new self;
    }
    return self::$init;
  }

  public function __construct(){
    // $this->renderAdminMenu();
  }

  public function renderAdminMenu(){
    return $this->add_admin_menu();
  }

  public function add_admin_menu(){
    return Menu::test_menu_class();
  }

}
?>
