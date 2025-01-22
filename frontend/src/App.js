import React from "react";
import { BrowserRouter, Routes, Route} from "react-router-dom";
import Register from "./components/Register";
import Login from "./components/Login";
import TasksBox from "./components/TasksBox";
import './style.css';

function App() {

  return (
   <BrowserRouter>
      <Routes>
            <Route path="/" element={<Login />} />
            <Route path="/Register" element={<Register />} />
            <Route path="/TasksBox" element={<TasksBox />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
