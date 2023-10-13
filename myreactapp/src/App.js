import { useState } from "react";
import './App.css';
// import './Dashboard.css';
// import Dashboard from "./Dashboard";
import {useNavigate} from "react-router-dom";
function App(){
  const navigate=useNavigate();
  const [data, setData]= useState(
  {
    username:"",
    password:"",
  }
)

const{username,password}=data;
const changeHandler = (e) => {

  setData({ ...data, [e.target.name]: [e.target.value] });
}

const submitHandler= e =>{
  e.preventDefault();
  console.log(data);
  navigate("/dashboard");
}

return(
  <div className="container"> 
 
    <h1><b>Login Form</b> </h1>
  
    <form onSubmit={submitHandler}>
      <div className="inputgroup">
      <label htmlFor="username">Username: </label>
      <input type="text" id="uasename" name="username" value={username} onChange={changeHandler} placeholder="Enter username" required/><br/>
      </div>
      <div className="inputgroup">
      <label htmlFor="password">Password: </label>
      <input type="password" id="password" name="password" value={password} onChange={changeHandler} placeholder="Enter password"required/><br/>
      </div>
      
   <center>
   <input type="submit" name="submit"/>
   </center>
   
  </form>
  </div>

); 
}
export default App;
