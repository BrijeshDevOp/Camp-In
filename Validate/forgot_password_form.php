<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css">  
</head>
<body>
  <div id="invalid"></div>
  <div class="container">
    <form id="myForm">
      <div id="sendOTP">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
    
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <button type="button" onclick="submitEmail()" id="getOTP">Submit email</button>
      </div>
    
      <div id="verifyOTP">
        <label for="otp">OTP</label>
        <input type="text" id="otp" name="otp">
        <button type="button" onclick="verifyOTP()" id="checkOTP">Submit OTP</button>
        <a href="forgot_password_form.php">Resend OTP</a>
      </div>

      <div id="confermPassword">
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
           <button onclick="setPassword()" id="change">Conferm</button>
      </div>
    </form>
  </div>
  <script>
    function submitEmail() {
      // Get form data
      const formData = new FormData(document.getElementById("myForm"));
      console.log("email");
      // Make the POST request using fetch
      fetch("../PostData/email_otp.php", {
        method: "POST",
        body: formData
      })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then((data) => {
        // Request successful, do something with the response data
        if(data == "fail")
        {
          message.style.display = "block";
          message.textContent ="Invalid Username/Password";          
        }
        else
        {
          email.style.display="none";
          otp.style.display="block";
        }
      })
      .catch((error) => {
        // Request failed, handle the error
        console.error("Fetch error:", error);
      });
    }
    
    var submit = document.getElementById("getOTP");
    var email =   document.getElementById("sendOTP");
    var otp =   document.getElementById("verifyOTP");
    var conferm = document.getElementById("confermPassword");
    var pwd = document.getElementById("password");
    var cpwd = document.getElementById("cpassword");
    var changePwdBtn = document.getElementById("change");
    const message = document.getElementById("invalid");
  
  function verifyOTP() {
    const messageValue = document.getElementById("otp").value;
    
    // Prepare the data to be sent in the request body
    const data = new URLSearchParams();
    data.append("name", messageValue);
    
    fetch("../PostData/verify_otp.php", {
      method: "POST",
      body: data
    })
    .then(response => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.text();
    })
    .then(responseText => {
      // Process the response from the PHP file (if needed)
      console.log(responseText);
      if(responseText == "yes")
      {
        // window.location.href = "welcome.php";
        email.style.display="none";
        otp.style.display="none";
        conferm.style.display = "block";
      }
      else
      {
      }
    })
    .catch(error => {
      // Handle any errors
      console.error("Fetch error:", error);
    });
  }
  
  // console.log(password,change);
function setPassword() {
    // Get form data
              const password = document.getElementById("password").value;
              const cpassword = document.getElementById("cpassword").value;
              const formPWD = document.getElementById("myForm");
              const setPWD = new FormData(formPWD);
              if(password.trim() !== '' && password.length >= 5 && /^\d+$/.test(password) && cpassword.trim() !== '' && cpassword.length >= 5 && /^\d+$/.test(cpassword))
              {
                if(password == cpassword)
                {
                  fetch("../PostData/updatePassword.php", {
                    method: "POST",
                    body: setPWD 
                  })
                  .then(response => response.json())
                  .then(data => {
                            console.log(data);
                            if(data.status == "fail")
                            {
                              message.style.display = "block";
                              message.textContent = data.message;
                            }
                            else
                            {
                              window.location.href ="login_form.php";
                            }
                          })
                          .catch(error => {
                            console.error("Fetch error:", error);
                  });

                }
                else
                {
                  message.style.display = "block";
                  message.textContent = "password doesnt match";
                }
              }
              else
              {
                message.style.display = "block";
              message.textContent = "Password should contain minimum 5 digits and should not be a non-numeric(a-z,A-Z) characters and special characters(@,$,%)";
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
</body>
</html>