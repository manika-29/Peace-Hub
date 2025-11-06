
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getFirestore, collection, addDoc, serverTimestamp } from "firebase/firestore";


const firebaseConfig = {
  apiKey: "AIzaSyCNpE0GcidvyCjDxUhxK5N3_3Y1qVVCcEg",
  authDomain: "peacehub-f0f34.firebaseapp.com",
  projectId: "peacehub-f0f34",
  storageBucket: "peacehub-f0f34.firebasestorage.app",
  messagingSenderId: "772247097377",
  appId: "1:772247097377:web:d95e85903f4bb64de51360",
  measurementId: "G-TZBZW9262V"
};


const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);


const db = getFirestore(app);
export { db, collection, addDoc, serverTimestamp };