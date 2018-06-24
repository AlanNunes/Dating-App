<?php
/**
 *
 * @category   User Controller
 * @author     Alan Nunes da Silva <alann.625@gmail.com>
 *
 * 23/06/2018
 */

include("../Classes/DataBase/DataBase.php");
include("../Classes/Users/Users.php");

switch ($_POST["action"]) {
  case 'registerAccount':
    registerAccount();
    break;

  default:
    return json_encode(array('erro' => true,
                        'description' => 'No action found.'));
    break;
}

function registerAccount()
{
  $fields = $_POST["fields"];
  $formResponse = IsFormInvalid($fields);
  if($formResponse){
    return json_encode(array('erro' => true, 'description' => 'Fields invalids',
                              'invalidFields' => $formResponse));
  }
  else
  {
    $db = new DataBase();

    $user = new User($db);
    $user->Username = "alan";
    $user->Password = "123";
    $user->FirstName = "Alan";
    $user->LastName = "Nunes";
    $user->Email = "alann.625@gmail.com";
    $user->Age = 18;
    $user->Gender = 'M';
    $user->InterestsInMen = 0;
    $user->InterestsInWomen = 1;

    return json_encode(array('erro' => $user->RegisterAccount(),
                              'description' => 'Account was not registered.'));
  }
}

function IsFormInvalid($fields)
{
  $size = sizeof($fields);
  $invalidFields = [];
  foreach ($fields as $key => $value) {
    if(empty($value) OR !isset($value))
    {
      array_push($invalidFields, $key);
    }
  }

  return $invalidFields;
}

 ?>
