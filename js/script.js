let charles = 'new york';
let charlesData = ['london', 'paris','Amsterdern', 'florida','utah',]
console.log(charlesData)

let charles_Person = {
   name: 'charles',
   agender: 'to snatch it , grab it, and run',
   lga: 'uta',
}
console.log(charles_Person,charlesData)
// Grab ?redirect=... from the URL
const params = new URLSearchParams(window.location.search);
const redirectTarget = params.get("redirect");

if (redirectTarget) {
  // Save it temporarily
  localStorage.setItem("redirectAfterSignup", redirectTarget);
}

// Simulate signup button click
document.querySelector("#signupBtn")?.addEventListener("click", function(e) {
  e.preventDefault();

  // After signup, check where to send the user
  const redirect = localStorage.getItem("redirectAfterSignup");

  if (redirect) {
    // Example: send to dashboard with content loaded
    window.location.href = `myBooks.php?content=${redirect}`;
  } else {
    // Default fallback
    window.location.href = "board.php";
  }
});


let isLoggedIn = false; // fake login state

  document.querySelectorAll(".book-card").forEach(card => {
    card.addEventListener("click", () => {
      if (isLoggedIn) {
        window.open(card.dataset.link, "_blank"); 
      } else {
        // redirect to login page
        window.location.href = "login.php";
      }
    });
  });