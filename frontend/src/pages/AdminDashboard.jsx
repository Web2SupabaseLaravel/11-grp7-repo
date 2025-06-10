import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import './AdminDashboard.css';
import statImage from '../assets/stat.png'; 
export default function AdminDashboard() {
  const [stats, setStats] = useState({
    users: 0,
    active: 0,
    newUsers: 0,
    totalAdmins: 0
  });

  useEffect(() => {
    axios.get("http://127.0.0.1:8000/api/dataAdmin/")
      .then(res => {
        setStats(res.data);
      })
      .catch(err => {
        console.error("error:", err);
      });
  }, []);

  return (
    <div className="dashboard">
      <aside className="sidebar">
        <h2 className="logo">Sofyan</h2>
        <ul className="menu">
          <li className="active"><Link to="/">Dashboard</Link></li>
          <li><Link to="/users">Manage Users</Link></li>
          <li><Link to="/settings">System Settings</Link></li>
          <li><Link to="/reports">View Reports</Link></li>
        </ul>
      </aside>

      <main className="main-content">
        <header className="header">
          <h1>Welcome back, Sofyan</h1>
        </header>

        <section className="cards">
          <div className="card card-users">
            <p className="card-number">{stats.users}</p>
            <p className="card-label">Users</p>
          </div>

          <div className="card card-active">
            <p className="card-number">{stats.active}</p>
            <p className="card-label">Active</p>
          </div>

          <div className="card card-newUsers">
            <p className="card-number">{stats.newUsers}</p>
            <p className="card-label">New Users</p>
          </div>

          <div className="card card-totalAdmins">
            <p className="card-number">{stats.totalAdmins}</p>
            <p className="card-label">Total Admins</p>
          </div>
        </section>

        <section className="bottom-section">
          <div className="statistics">

          
            <img 
              src={statImage}
              alt="Statistics"
              style={{ width: '100%', borderRadius: '12px', objectFit: 'cover' }}
            />
          </div>

          <div className="quick-links">
            <h2>Quick Links</h2>
            <ul>
              <li><Link to="/users">Manage Users</Link></li>
              <li><Link to="/settings">System Settings</Link></li>
              <li><Link to="/reports">View Reports</Link></li>
            </ul>
          </div>
        </section>
      </main>
    </div>
  );
}
