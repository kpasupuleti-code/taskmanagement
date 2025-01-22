import React, {useRef, useState} from "react";
import '../style.css';
import axios from "axios";
import {Link} from "react-router-dom";

function Register(){
    //hooks to capture data and send
    const emailvalue = useRef();
    const pwdvalue = useRef();
    //hook for register message
    const [message,setmessage] = useState('');
    //function to change values
    const submitform = (e) =>{
        e.preventDefault();
        
    //api to send data
    axios.post('http://localhost/APDi/Backend/registration.php', {
        email: emailvalue.current.value,
        password: pwdvalue.current.value
    })
    .then((response) => {
        console.log(response.data);
        setmessage(response.data.mess);
        emailvalue.current.value = '';
        pwdvalue.current.value = '';
    })
    .catch((error) => {
        setmessage("error occurred");
    });
    };

    return(
        <div className="registrationbox">
        <form >
            <label id="usbox" htmlFor="email">E-mail :</label><br></br>
            <input type="text" id="usernamebox" name="email" ref={emailvalue} required/><br></br>
            <label id="pwdbox" htmlFor="password">password :</label><br></br>
            <input type="password" id="passwordbox" name="password" ref={pwdvalue} required/><br></br>
            <button id="registerbutton" onClick={submitform}>register</button>
            <p style={{marginLeft:'50px'}}>{message}</p>
            <p> have account? <Link to="/">Login here</Link></p>
        </form>
        </div>
    );
}

export default Register;