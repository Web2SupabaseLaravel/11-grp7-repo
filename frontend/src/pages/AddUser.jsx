import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

export default function AddUser() {
  const navigate = useNavigate();

  const [formData, setFormData] = useState({
    user_id: '',
    name: '',
    email: '',
    role: '',
    status: ''
  });

  const [message, setMessage] = useState('');

  function handleChange(e) {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  }

  function handleSubmit(e) {
    e.preventDefault();

    axios.post("http://127.0.0.1:8000/api/datauser", formData)
      .finally(() => {
        setMessage("User added successfully!");
        setTimeout(() => {
          navigate('/users');
        }, 1500);
      });
  }

  return (
    <div style={{ maxWidth: 500, margin: '20px auto' }}>
      <h2>Add New User</h2>

      {message && (
        <p style={{ 
          color: 'black', 
          fontWeight: 'bold', 
          backgroundColor: '#f0f0f0', 
          padding: '10px',
          borderRadius: '8px'
        }}>
          {message}
        </p>
      )}

      <form onSubmit={handleSubmit}>
        <label>User ID:</label>
        <input
          type="text"
          name="user_id"
          value={formData.user_id}
          onChange={handleChange}
          required
        />

        <label>Username:</label>
        <input
          type="text"
          name="name"
          value={formData.name}
          onChange={handleChange}
          required
        />

        <label>Email:</label>
        <input
          type="email"
          name="email"
          value={formData.email}
          onChange={handleChange}
          required
        />

        <label>Role:</label>
        <input
          type="text"
          name="role"
          value={formData.role}
          onChange={handleChange}
          required
        />

        <label>Status:</label>
        <input
          type="text"
          name="status"
          value={formData.status}
          onChange={handleChange}
          required
        />

        <button type="submit" style={{ marginTop: 15 }}>Save User</button>
      </form>
    </div>
  );
}
