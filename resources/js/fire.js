import firebase from 'firebase'
import 'firebase/firestore';

const firebaseConfig = {
    apiKey: "AIzaSyC3mTDVOAOgChz3Xudvj051_KHnQFzX1kQ",
    authDomain: "chuyende-4c214.firebaseapp.com",
    databaseURL: "https://chuyende-4c214.firebaseio.com",
    projectId: "chuyende-4c214",
    storageBucket: "chuyende-4c214.appspot.com",
    messagingSenderId: "451138326543",
    appId: "1:451138326543:web:7a974324e9df974ce0537a",
    measurementId: "G-N72KXWF20P"
};

firebase.initializeApp(firebaseConfig);

export default firebase;
