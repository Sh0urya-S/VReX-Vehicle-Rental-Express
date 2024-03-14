document.addEventListener("DOMContentLoaded", function () {
  const loginToggle = document.getElementById("signup-toggle");
  const signupToggle = document.getElementById("login-toggle");
  const card = document.getElementById("card");

  loginToggle.addEventListener("click", function (event) {
    event.preventDefault();
    card.style.transform = "rotateY(180deg)";
    card.classList.add("active-signup"); // Add class to indicate signup
  });

  signupToggle.addEventListener("click", function (event) {
    event.preventDefault();
    card.style.transform = "rotateY(0deg)";
    card.classList.remove("active-signup"); // Remove signup class
  });
});