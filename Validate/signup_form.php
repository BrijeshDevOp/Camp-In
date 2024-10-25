<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-Up Page</title>
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <div id="invalid"></div>
  <div class="container">
    <h2>Sign-Up</h2>

    <form id="myForm">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username">

      <label for="email">Email:</label>
      <input type="email" id="email" name="email">

      <label for="password">Password:</label>
      <div class="password-input">
        <input type="password" id="password" name="password">
        <span class="show-password" onclick="togglePasswordVisibility()"><img src="../ICONS/ceye.svg" alt="" srcset="" id="eye1"></span>
      </div>

      <label for="cpassword">Confirm Password:</label>
      <div class="password-input">
        <input type="password" id="cpassword" name="cpassword">
        <span class="show-password" onclick="toggleCPasswordVisibility()"><img src="../ICONS/ceye.svg" alt="" srcset="" id="eye2"></span>
      </div>

      <button onclick="submitForm()" id="submit">Sign-Up</button>

      <div class="login-info" style="text-align: center;">
        <p>Already logged-in?<a href="login_form.php">Login</a></p>
      </div>
    </form>
  </div>

  <script>
    
    function submitForm() 
    {    
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;
      const cpassword = document.getElementById("cpassword").value;
      const message = document.getElementById("invalid");

      console.log(username,password,cpassword);
      if(username.trim() !== '' && username.length <= 20)
      {
          if(password.trim() !== '' && password.length >= 5 && /^\d+$/.test(password) && cpassword.trim() !== '' && cpassword.length >= 5 && /^\d+$/.test(cpassword))
          {
            if(password == cpassword)
            {

              const formElement = document.getElementById("myForm");
              const formData = new FormData(formElement);
              fetch("../PostData/signup_data.php", {
                method: "POST",
                body: formData
              })
              .then(response => response.json())
              .then(data => {
                        if(data.status == "fail" )
                        {
                          // console.log(data.message);
                          message.style.display = "block";
                          message.textContent = data.message;
                        }
                        else
                        {
                          window.location.href = "login_form.php";
                        }
                      })
                      .catch(error => {
                        console.error("Fetch error:", error);
                    });
              }
              else
              {
                message.style.display = "block";
                message.textContent = "Password does not match"; 
              }
            }
            else
            {
              message.style.display = "block";
              message.textContent = "Password should contain minimum 5 digits and should not be a non-numeric(a-z,A-Z) characters and special characters(@,$,%)";
            }
        }
        else
        {
             message.style.display = "block";
             message.textContent = "Username should contain maximum 15 characters";
        }

        event.preventDefault();
    }

    function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      document.getElementById("eye1").src = "../ICONS/oeye.svg";
    } else {
      passwordInput.type = "password";
      document.getElementById("eye1").src = "../ICONS/ceye.svg";
    }
}

  function toggleCPasswordVisibility() {
    const passwordInput = document.getElementById("cpassword");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      document.getElementById("eye2").src = "../ICONS/oeye.svg";
    } else {
      passwordInput.type = "password";
      document.getElementById("eye2").src = "../ICONS/ceye.svg";
    }
  }
      </script>
      <!-- <script src="../js/password.js"></script> -->
</body>

</html>