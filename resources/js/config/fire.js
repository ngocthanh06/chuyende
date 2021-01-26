import firebase from 'firebase';
import 'firebase/firestore';
import 'firebase/database';

var config = {
    apiKey: "AIzaSyBCPDz9wwgDFYccEcIDK9daSUkPcPzvR8Q",
    authDomain: "fir-chat-2a7b8.firebaseapp.com",
    databaseURL: "https://fir-chat-2a7b8.firebaseio.com",
    projectId: "fir-chat-2a7b8",
    storageBucket: "fir-chat-2a7b8.appspot.com",
    messagingSenderId: "664788273868",
    appId: "1:664788273868:web:e3af8b4ec38248dca79069",
    measurementId: "G-107J5MYZJJ"
};

var fire = firebase.initializeApp(config);

export default fire;
