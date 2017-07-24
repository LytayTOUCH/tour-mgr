<?php
class Book{
  private static $init;
  public static function init(){
    if(!isset(self::$init)){
      return self::$init = new self;
    }
    return self::$init;
  }

  public function __construct(){

  }
  public function test_book_controller(){
    return 'test_book_controller';
  }
  public function get_person_table_class(){
    $person = new Person_Test();
    return $person->test_person_class();
  }
  public function get_nonstatic_method(){
    return 'get_nonstatic_method';
  }
}
?>
