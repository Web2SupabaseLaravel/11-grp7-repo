import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const ForgotPassword = () => {
  const [formData, setFormData] = useState({ role: 'patient', email: '' });
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!formData.email) {
      alert('Please enter an email address.');
      return;
    }
    try {
      const response = await axios.post('http://localhost:8000/api/auth/forgot-password', formData);
      const resetCode = response.data.reset_code;
      if (resetCode) {
        alert(`Reset code: ${resetCode}`);
        navigate('/reset-password');
      } else {
        alert('No reset code received from server.');
      }
    } catch (error) {
      alert(error.response?.data?.message || 'Failed to generate reset code');
    }
  };

  return (
    <div style={{ minHeight: '100vh', backgroundColor: '#f0f4f8', display: 'flex', flexDirection: 'column', fontFamily: 'Arial, sans-serif' }}>
     
      <div style={{ flex: 1, display: 'flex', alignItems: 'center', justifyContent: 'center', backgroundImage: "url('https://via.placeholder.com/1200x800')", backgroundSize: 'cover', backgroundPosition: 'center', position: 'relative' }}>
        <div style={{ background: 'linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(240, 248, 255, 0.95))', padding: '25px', borderRadius: '12px', boxShadow: '0 4px 15px rgba(0, 0, 0, 0.1)', width: '400px', border: '1px solid #e0e7ff' }}>
          <h2 style={{ fontSize: '26px', fontWeight: '700', marginBottom: '20px', textAlign: 'center', color: '#2d3748', textTransform: 'uppercase', letterSpacing: '1px' }}>Forgot Password</h2>
          <p style={{ color: '#718096', fontSize: '14px', fontWeight: '500', marginBottom: '20px', textAlign: 'center' }}>Enter your email to reset your password.</p>
          <form onSubmit={handleSubmit} style={{ display: 'flex', flexDirection: 'column', gap: '18px' }}>
            <div>
              <label style={{ display: 'block', color: '#2d3748', fontWeight: '500', marginBottom: '5px' }}>Role:</label>
              <select
                value={formData.role}
                onChange={(e) => setFormData({ ...formData, role: e.target.value })}
                style={{ width: '100%', padding: '10px', border: '1px solid #cbd5e0', borderRadius: '6px', backgroundColor: '#fff', fontSize: '14px', color: '#4a5568', boxShadow: 'inset 0 1px 2px rgba(0, 0, 0, 0.05)' }}
              >
                <option value="patient">Patient</option>
                <option value="practitioner">Practitioner</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            <div>
              <label style={{ display: 'block', color: '#2d3748', fontWeight: '500', marginBottom: '5px' }}>Email:</label>
              <input
                type="email"
                style={{ width: '100%', padding: '10px', border: '1px solid #cbd5e0', borderRadius: '6px', backgroundColor: '#fff', fontSize: '14px', color: '#4a5568', boxShadow: 'inset 0 1px 2px rgba(0, 0, 0, 0.05)' }}
                value={formData.email}
                onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                required
              />
            </div>
            <button type="submit" style={{ width: '100%', padding: '12px', backgroundColor: '#4299e1', color: '#ffffff', borderRadius: '20px', border: 'none', fontWeight: '600', boxShadow: '0 2px 4px rgba(66, 153, 225, 0.3)', transition: 'background-color 0.3s' }} onMouseOver={(e) => (e.target.style.backgroundColor = '#2b6cb0')} onMouseOut={(e) => (e.target.style.backgroundColor = '#4299e1')}>
              Send Reset Code
            </button>
          </form>
        </div>
      </div>
    </div>
  );
};

export default ForgotPassword;