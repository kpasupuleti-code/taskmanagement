import React, { useRef, useState, useEffect } from "react";
import "../style.css";
import axios from "axios";
import { useLocation } from "react-router-dom";

function TasksBox() {
  const location = useLocation();
  const { email } = location.state || {};
  const [tasks, setTasks] = useState([]); // Initialize tasks as an array
  const [status, text] = [useRef(), useRef()];
  
  const submitform = (e) => {
    e.preventDefault();
    axios
      .post("http://localhost/APDi/Backend/postdata.php", {
        Status: status.current.value,
        Description: text.current.value,
        email: email,
      })
      .then((response) => {
        if (response.data.status === "success") {
          setTasks((prevTasks) => [
            ...prevTasks,
            {
              Status: status.current.value,
              Description: text.current.value,
            },
          ]); 
          status.current.value = "";
          text.current.value = "";
        }
      })
      .catch((error) => {
        console.error("Error submitting task:", error);
      });
  };
  useEffect(() => {
      axios
        .post("http://localhost/APDi/Backend/retrivedata.php", { email })
        .then((response) => {
          if (response.data && Array.isArray(response.data.tasks)) {
            setTasks(response.data.tasks);
          } else {
            setTasks([]);
          }
        })
        .catch((error) => {
          console.error("Error fetching tasks:", error);
          setTasks([]);
        });
  }, [email, submitform]);

  return (
    <div className="container">
      <div className="tasksbox">
        <table>
          <thead>
            <tr>
              <th>Task Description</th>
              <th style={{ width: "50px" }}>Task Status</th>
            </tr>
          </thead>
          <tbody>
            {Array.isArray(tasks) && tasks.map((task, index) => (
              <tr key={index}>
                <td>{task.Description}</td>
                <td>{task.Status}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
      <div className="features">
          <label id="st">Status:</label>
          <input
            type="text"
            placeholder="Enter Status"
            ref={status}
            required
          />
          <br />
          <label>Description :</label>
          <br />
          <textarea
            id="ta"
            placeholder="Text here...."
            ref={text}
            required
          ></textarea>
          <br />
          <button style={{ marginLeft: "150px" }} onClick={submitform}>
            ADD
          </button>
        </div>
    </div>
  );
}

export default TasksBox;
