import { auth, db } from "./firebase.js";
import {
  GoogleAuthProvider,
  signInWithPopup,
} from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";
import {
  doc,
  setDoc,
} from "https://www.gstatic.com/firebasejs/10.1.0/firebase-firestore.js";

// ----------------- GOOGLE LOGIN -----------------
const googleBtn = document.getElementById("firebase-google-login");
if (googleBtn) {
  googleBtn.addEventListener("click", async () => {
    const provider = new GoogleAuthProvider();
    try {
      const result = await signInWithPopup(auth, provider);
      const user = result.user;

      // Save user in Firestore
      await setDoc(doc(db, "users", user.uid), {
        name: user.displayName,
        email: user.email,
        createdAt: new Date(),
      }, { merge: true });

      // Get Firebase ID token
      const idToken = await user.getIdToken();

      // Send token to PHP backend
      const response = await fetch("../php/firebase-login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ idToken }),
      });

      const data = await response.json();
      if (data.success) {
        window.location.href = "../php/myBooks.php";
      } else {
        alert("Server verification failed: " + data.message);
      }

    } catch (error) {
      console.error("Google login error:", error.message);
      alert(error.message);
    }
  });
}

// ----------------- TRADITIONAL LOGIN -----------------
// We remove Firebase interception for traditional PHP login
// The form submits normally to login.php
const loginForm = document.getElementById("loginForm");
if (loginForm) {
  loginForm.addEventListener("submit", (e) => {
    // Allow default PHP form submission
    // e.preventDefault(); // <-- make sure this line is commented or removed
    // Do NOT call signInWithEmailAndPassword here
  });
}
