<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login Page</title>
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <div id="invalid"></div>
  <div class="container">
    <h2>log-in</h2>

    <form id="myForm">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username">

      <label for="password">Password:</label>
      <div class="password-input">
        <input type="password" id="password" name="password">
        <span class="show-password" onclick="togglePasswordVisibility()"><img src="..\ICONS\ceye.svg" alt="" srcset="" id="eye"></span>
      </div>

      <button onclick="submitForm()" id="submit">Log-In</button>

      <div class="login-info" style="text-align: center;">
        <p><a href="forgot_password_form.php">forgot password</a></p>
        <p>dont have an account??<a href="signup_form.php">Sign-up</a></p>
      </div>
    </form>
  </div>

  <script>
    
    function submitForm() 
    {    
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;
      const message = document.getElementById("invalid");

      console.log(username,password);
      const formElement = document.getElementById("myForm");
      const formData = new FormData(formElement);
      fetch("../PostData/login_data.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
                // console.log(data);
                if(data.status == "fail")
                {
                    message.textContent = data.message;
                    message.style.display ="block";
                }
                else
                {
                  window.location.href = "../PAGES/mainpage.php";
                }

              })
              .catch(error => {
                console.error("Fetch error:", error);
            });

            event.preventDefault();
     }

     function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          document.getElementById("eye").src = "../ICONS/oeye.svg";
        } else {
          passwordInput.type = "password";
          document.getElementById("eye").src = "../ICONS/ceye.svg";
        }
    }
      </script>
</body>

</html>