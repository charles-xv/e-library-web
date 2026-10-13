import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-analytics.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";
import { getFirestore } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-firestore.js";

// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey:"YOUR_API_KEY_HERE",
  authDomain: "horizons-52ab1.firebaseapp.com",
  projectId: "horizons-52ab1",
  storageBucket: "horizons-52ab1.firebasestorage.app",
  messagingSenderId: "730076053513",
  appId: "1:730076053513:web:8df96945d32fd733d6b8d8",
  measurementId: "G-PT61NRT7GL"
};
// Initialize Firebase
const app = initializeApp(firebaseConfig);
export const analytics = getAnalytics(app);
export const auth = getAuth(app);
export const db = getFirestore(app);