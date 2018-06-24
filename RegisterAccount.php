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
    <form>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstname" placeholder="First Name">
        </div>
        <div class="form-group col-md-6">
          <label for="LastName">Last Name</label>
          <input type="text" class="form-control" id="lastname" placeholder="Last Name">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="age">Age</label>
          <input type="number" class="form-control" id="age" placeholder="Age">
        </div>
        <div class="col">
          <label for="gender">Gender</label>
          <select id="gender" class="form-control">
            <option value='m'>Man</option>
            <option value='f'>Woman</option>
          </select>
        </div>
      </div>
      <br/>
      <p>I'm interested in</p>
      <div class="row">
        <div class="col">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="interestsInMen"> Men
            </label>
          </div>
        </div>
        <div class="col">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="interestsInWomen"> Women
            </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <input type="phone" class="form-control" id="phone" placeholder="Phone">
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
            $('input').removeClass('is-invalid');
            $('select').removeClass('is-invalid');
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
