import React, { useRef, useState } from "react";
import {Link, useNavigate} from "react-router-dom";
import axios from "axios";


function Login(){
    const [mess,setmess] = useState('');
    const emailvalue = useRef();
    const pwdvalue = useRef();
    const navigate = useNavigate();
    const submitform = (e) => {
        e.preventDefault();

        axios.post("http://localhost/APDi/Backend/login.php", 
                  { email: emailvalue.current.value,
                    password: pwdvalue.current.value})
        .then((response) => {
                emailvalue.current.value = '';
                pwdvalue.current.value = '';
                if(response.data.status === 'success')
                {

                    navigate('/TasksBox' , {state: {email : response.data.email}});
                }
                else{
                    setmess(response.data.message);
                }
                })
        .catch((error) => {
                
        });
    };
    return(
        <div className="loginbox"> 
            <form >
            <label id="usbox" htmlFor="email">E-mail :</label><br></br>
            <input type="text" id="loginnamebox" name="email" ref={emailvalue} required/><br></br>
            <label id="pwdbox" htmlFor="password">password :</label><br></br>
            <input type="password" id="passwordbbox" name="password" ref={pwdvalue} required/><br></br>
            <button id="loginbutton" onClick={submitform} >login</button>
            <p style={{display:'inline',marginLeft:'30px'}}><Link to="/Register">register here</Link></p>
            <p >{mess}</p>
            </form>
        </div>
    );
}

export default Login;