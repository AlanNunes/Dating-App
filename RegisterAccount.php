<html lang="pt">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 	<!-- <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/logo/fav.ico"> -->
	<title> Dating App - Register Account </title>

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background: #fff9f7;">
  <div class="panel">
    <h4>Find your Love now !</h4>
    <br/>
    <form>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Email" required>
          <div class="invalid-feedback" id="emailMsgError">Your email must to be valid</div>
        </div>
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password" required>
          <div class="invalid-feedback">Your password must be up to 7 characters</div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstname" placeholder="First Name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="LastName">Last Name</label>
          <input type="text" class="form-control" id="lastname" placeholder="Last Name" required>
          <div class="invalid-feedback">Don't forget your name :)</div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="age">Age</label>
          <input type="number" class="form-control" id="age" placeholder="Age" required>
          <div class="invalid-feedback">Tell us your age</div>
        </div>
        <div class="col">
          <label for="gender">Gender</label>
          <select id="gender" class="form-control" required>
            <option value='m'>Man</option>
            <option value='f'>Woman</option>
          </select>
          <div class="invalid-feedback">Report your gender</div>
        </div>
      </div>
      <br/>
      <p>I'm interested in</p>
      <div class="form-row">
        <div class="col">
          <div class="custom-control custom-checkbox" style="margin-left: 5px">
            <input type="checkbox" class="custom-control-input" id="interestsInMen">
            <label class="custom-control-label" for="interestsInMen">Men</label>
          </div>
        </div>
        <div class="col">
          <div class="custom-control custom-checkbox" style="margin-left: 5px">
            <input type="checkbox" class="custom-control-input" id="interestsInWomen">
            <label class="custom-control-label" for="interestsInWomen">Women</label>
          </div>
        </div>
        <div class="invalid-feedback">Tell us what you are interested in ;)</div>
      </div>
      <br/>
      <div class="row">
        <div class="col">
          <input type="phone" class="form-control" id="phone" placeholder="Phone" required>
          <div class="invalid-feedback">This phone number is not valid ;(</div>
        </div>
      </div>
      <br/>
      <p>
        <button type="button" class="btn btn-primary btn-block" onclick="RegisterAccount(GetFormFields())" style="background: #ff5d4f;">Ready !</button>
      </p>
    </form>
  </div>
</body>
<!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="JSControllers/login.js"></script>
    <script>
    /*
    * Returns all fields of form
    */
    function GetFormFields(){
      data = {
        'email' : $("#email").val(),
        'password' : $("#password").val(),
        'firstname' : $("#firstname").val(),
        'lastname' : $("#lastname").val(),
        'age' : $("#age").val(),
        'gender' : $("#gender").val(),
        'interestsInMen' : $("#interestsInMen").is(":checked"),
        'interestsInWomen' : $("#interestsInWomen").is(":checked"),
        'phone' : $("#phone").val()
      };
      return data;
    }

    /*
    * Registers user accounts
    */
    function RegisterAccount(data){
      $.ajax({
          type: "POST",
          dataType: "json",
          url: "Controllers/UserController.php",
          data: {action:'RegisterAccount', 'fields':data},
          success: function(data) {
            console.log(data);
            $('input').addClass('is-valid');
            $('select').addClass('is-valid');
            $('checkbox').addClass('is-valid');
            $('input').removeClass('is-invalid');
            $('select').removeClass('is-invalid');
            $('checkbox').removeClass('is-invalid');
            try
            {
              if(data.erro)
              {
                if(data.invalidFields)
                {
                  for(i = 0; i < data.invalidFields.length; i++)
                  {
                    $('#'+data.invalidFields[i]).removeClass('is-valid');
                    $('#'+data.invalidFields[i]).addClass('is-invalid');
                  }
                }
                if (data.emailError)
                {
                  $('#email').removeClass('is-valid');
                  $('#email').addClass('is-invalid');
                  $('#emailMsgError').html('This email is already being used');
                }
                if (data.phoneError)
                {
                  $('#phone').removeClass('is-valid');
                  $('#phone').addClass('is-invalid');
                  $('#phoneMsgError').html('This phone is already being used');
                }
              }
              else
              {
                // Account was Registered
                if (AuthUser(data.phone, data.password))
                {
                  console.log('Youre logged in');
                  if (typeof(Storage) !== "undefined")
                  {
                    localStorage.setItem("phone", data.phone);
                    window.location = 'index.html';
                  }
                  else
                  {
                    alert("Your browser doesn't support Local Storages");
                  }
                }
                else
                {
                  console.warn('User was not logged in');
                }
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
    </script>
</html>
