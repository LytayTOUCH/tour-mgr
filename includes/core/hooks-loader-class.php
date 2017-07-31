<?php
class Hooks_Loader{
  // Description #Description
  // Actions are the hooks that the WordPress core launches at specific points during execution, or when specific events occur. Plugins can specify that one or more of its PHP functions are executed at these points, using the Action API.

  // add_action( string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1 )
  // Parameters #Parameters

  // $tag
  // (string) (Required) The name of the action to which the $function_to_add is hooked.
  // $function_to_add
  // (callable) (Required) The name of the function you wish to be called.
  // $priority
  // (int) (Optional) Used to specify the order in which the functions associated with a particular action are executed. Lower numbers correspond with earlier execution, and functions with the same priority are executed in the order in which they were added to the action.
  // Default value: 10
  // $accepted_args
  // (int) (Optional) The number of arguments the function accepts.
  // Default value: 1

  public function add_action(){

  }

  // Description #Description
  // WordPress offers filter hooks to allow plugins to modify various types of internal data at runtime.

  // add_filter( string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1 )

  // Parameters #Parameters
  // $tag
  // (string) (Required) The name of the filter to hook the $function_to_add callback to.
  // $function_to_add
  // (callable) (Required) The callback to be run when the filter is applied.
  // $priority
  // (int) (Optional) Used to specify the order in which the functions associated with a particular action are executed. Lower numbers correspond with earlier execution, and functions with the same priority are executed in the order in which they were added to the action.
  // Default value: 10
  // $accepted_args
  // (int) (Optional) The number of arguments the function accepts.
  // Default value: 1

  public function add_filter(){

  }
  public static function test_hook_loader(){
    return "test_hook_loader @ include core";
  }
}

?>
