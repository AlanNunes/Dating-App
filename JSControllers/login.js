/**
* Parameters
* @var identification Means email or phone number
* @var password Passwor
*
* @return boolean Return true if login was successfull. Otherwise false.
*/

function AuthUser(identification, password)
{
  $.ajax({
      type: "POST",
      dataType: "json",
      url: "Controllers/UserController.php",
      data: {action : 'AuthUser', 'identification' : identification, 'password' : password},
      success: function(result) {
        try
        {
          if(result)
          {
            return identification;
          }
          else
          {
            return false;
          }
        }
        catch (e)
        {
          console.warn(e);
        }
      },
      error: function(e) {
        console.warn(e);
      }
  });
}
