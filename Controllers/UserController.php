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

  case 'AuthUser':
    AuthUser();
    break;

  default:
    echo json_encode(array('erro' => true,
                        'description' => 'No action found.'));
    break;
}

function RegisterAccount()
{
  $fields = $_POST["fields"];
  $invalidFields = IsFormInvalid($fields);
  $erro = false;
  $responseErro = array('erro' => true, 'description' => 'Fields invalids');
  if($invalidFields)
  {
    $erro = true;
    $responseErro = $responseErro + array('invalidFields' => $invalidFields);
  }
  if(!IsEmailAvailable(safe_data($fields["email"])))
  {
    $erro = true;
    $responseErro = $responseErro + array('emailError' => true);
  }
  if(!IsPhoneAvailable(safe_data($fields["phone"])))
  {
    $erro = true;
    $responseErro = $responseErro + array('phoneError' => true);
  }
  if(!IsEmailValid($fields["email"]))
  {
    $erro = true;
    array_push($responseErro["invalidFields"], 'email');
  }
  if($fields['interestsInMen'] == "false" && $fields['interestsInWomen'] == "false")
  {
    array_push($responseErro["invalidFields"], 'interestsInMen');
    array_push($responseErro["invalidFields"], 'interestsInWomen');
  }
    if ($erro)
    {
      echo json_encode($responseErro);
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

/**
* Logs User
*
* @return boolean Returns true if login was successfull. Otherwise false.
*/
function AuthUser()
{
  $identification = safe_data($_POST['identification']);
  $password = safe_data($_POST['password']);

  $db = new DataBase();
  $user = new User($db);

  echo $user->AuthUser($identification, $password);
}

/**
* Validates the Form
*
* @return array Returns all invalid fields. Otherwise returns is an empty array
*/
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
* Checks if email is valid
*
* @return bool
**/
function IsEmailValid($email)
{
  if (filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    return true;
  }
  else
  {
    return false;
  }
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
