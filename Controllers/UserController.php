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
  case 'RegisterAccount':
    RegisterAccount();
    break;

  default:
    echo json_encode(array('erro' => true,
                        'description' => 'No action found.'));
    break;
}

function RegisterAccount()
{
  $fields = $_POST["fields"];
  $formResponse = IsFormInvalid($fields);
  if($formResponse){
    echo json_encode(array('erro' => true, 'description' => 'Fields invalids',
                              'invalidFields' => $formResponse));
  }
  else if ($fields["interestsInMen"] == "false" && $fields["interestsInWomen"] == "false")
  {
    echo json_encode(array('erro' => true, 'description' => 'Fields invalids',
                              'invalidFields' =>
                                array('interestsInMen', 'interestsInWomen')));
  }
  else
  {
    if(!IsEmailAvailable($fields["email"]))
    {
      echo json_encode(array('erro' => true, 'description' => 'This email is
                                already being used.', 'emailError' => true));
    }
    else if (!IsPhoneAvailable($fields["phone"]))
    {
      echo json_encode(array('erro' => true, 'description' => 'This phone is
                                already being used.', 'phoneError' => true));
    }
    else
    {
      $db = new DataBase();
      $user = new User($db);
      $user->Email = safe_data($fields["email"]);
      $user->Password = safe_data($fields["password"]);
      $user->FirstName = safe_data($fields["firstname"]);
      $user->LastName = safe_data($fields["lastname"]);
      $user->Age = safe_data($fields["age"]);
      $user->Gender = safe_data($fields["gender"]);
      $user->InterestsInMen = safe_data($fields["interestsInMen"]);
      $user->InterestsInWomen = safe_data($fields["interestsInWomen"]);
      $user->Phone = safe_data($fields["phone"]);

      if($user->RegisterAccount())
      {
        echo json_encode(array('erro' => false,
                                  'description' => 'Account was registered.'));
      }
      else
      {
        echo json_encode(array('erro' => true,
                                  'description' => 'Account was not registered.'));
      }
    }
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

/**
* Checks if the email is available
*
* @return bool
**/
function IsEmailAvailable($email)
{
  $db = new DataBase();
  $user = new User($db);

  return $user->IsEmailAvailable($email);
}

/**
* Checks if the phone is available
*
* @return bool
**/
function IsPhoneAvailable($phone)
{
  $db = new DataBase();
  $user = new User($db);

  return $user->IsPhoneAvailable($phone);
}

/**
* Prevents SQL injection
*
* @return data
**/
function safe_data($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

 ?>
