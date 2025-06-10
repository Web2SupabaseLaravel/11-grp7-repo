import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import AdminDashboard from './pages/AdminDashboard';
import ManageUsers from './pages/ManageUsers';
import SystemSettings from './pages/SystemSettings';
import AddUser from './pages/AddUser';  

function App() {
  return (
    <Router>
      <div>
        <nav style={{ padding: '10px', background: '#eee' }}>
          <Link to="/" style={{ margin: '10px' }}>Dashboard</Link>
          <Link to="/users" style={{ margin: '10px' }}>Manage Users</Link>
          <Link to="/settings" style={{ margin: '10px' }}>System Settings</Link>
        </nav>

        <Routes>
          <Route path="/" element={<AdminDashboard />} />
          <Route path="/users" element={<ManageUsers />} />
          <Route path="/settings" element={<SystemSettings />} />
          <Route path="/add-user" element={<AddUser />} />  
        </Routes>
      </div>
    </Router>
  );
}

export default App;
