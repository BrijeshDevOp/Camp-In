function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      document.getElementById("eye1").src = "../Assets/icons/oeye.svg";
    } else {
      passwordInput.type = "password";
      document.getElementById("eye1").src = "../Assets/icons/ceye.svg";
    }
}

  function toggleCPasswordVisibility() {
    const passwordInput = document.getElementById("cpassword");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      document.getElementById("eye2").src = "../Assets/icons/oeye.svg";
    } else {
      passwordInput.type = "password";
      document.getElementById("eye2").src = "../Assets/icons/ceye.svg";
    }
  }