// import './Dashboard.css';
const Dashboard = () => {
    return (
      <div className="container">
        
            <h><b>Welcome to your Dashboard</b></h>
            
            <form>
            <div>
            <center>
            <div className="inputgroup">
            <label>Full Name:</label>
                <input type="text" name="fullname" ></input><br/>
            </div>
             <div className="inputgroup">
             <label>Age:</label>
                <input type="text" name="age"></input><br/>
                </div>   
                
                </center>
            </div>
            </form>
      </div>
      
      
        
    );
  };
  export default Dashboard;