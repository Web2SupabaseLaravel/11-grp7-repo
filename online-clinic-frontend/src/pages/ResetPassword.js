import React, { useState } from 'react';
import Navbar from '../components/Navbar';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import Footer from '../components/Footer';
const ResetPassword = () => {
  const [formData, setFormData] = useState({ role: 'patient', email: '', new_password: '', reset_code: '' });
  const [showPassword, setShowPassword] = useState(false); // حالة لعرض/إخفاء كلمة المرور
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!formData.email || !formData.reset_code || !formData.new_password) {
      alert('Please fill all fields.');
      return;
    }
    try {
      await axios.post('http://localhost:8000/api/auth/reset-password', formData);
      alert('Password reset successfully!');
      navigate('/login');
    } catch (error) {
      alert(error.response?.data?.message || 'Failed to reset password');
    }
  };

  const togglePasswordVisibility = () => {
    setShowPassword(!showPassword);
  };

  return (
    <div style={{ height: '100vh', backgroundColor: '#f0f4f8', display: 'flex', flexDirection: 'column', fontFamily: 'Arial, sans-serif', overflow: 'hidden' }}>
     
      <div style={{ flex: '1', display: 'flex', alignItems: 'center', justifyContent: 'center', backgroundImage: "url('https://via.placeholder.com/1200x800')", backgroundSize: 'cover', backgroundPosition: 'center', position: 'relative' }}>
        <div style={{ background: 'linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(240, 248, 255, 0.95))', padding: '25px', borderRadius: '12px', boxShadow: '0 4px 15px rgba(0, 0, 0, 0.1)', width: '400px', border: '1px solid #e0e7ff' }}>
          <h2 style={{ fontSize: '26px', fontWeight: '700', marginBottom: '20px', textAlign: 'center', color: '#2d3748', textTransform: 'uppercase', letterSpacing: '1px' }}>Reset Password</h2>
          <p style={{ color: '#718096', fontSize: '14px', fontWeight: '500', marginBottom: '20px', textAlign: 'center' }}>Enter the details to reset your password.</p>
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
            <div>
              <label style={{ display: 'block', color: '#2d3748', fontWeight: '500', marginBottom: '5px' }}>Reset Code:</label>
              <input
                type="text"
                style={{ width: '100%', padding: '10px', border: '1px solid #cbd5e0', borderRadius: '6px', backgroundColor: '#fff', fontSize: '14px', color: '#4a5568', boxShadow: 'inset 0 1px 2px rgba(0, 0, 0, 0.05)' }}
                value={formData.reset_code}
                onChange={(e) => setFormData({ ...formData, reset_code: e.target.value })}
                required
              />
            </div>
            <div>
              <label style={{ display: 'block', color: '#2d3748', fontWeight: '500', marginBottom: '5px' }}>New Password:</label>
              <div style={{ display: 'flex', alignItems: 'center', position: 'relative' }}>
                <input
                  type={showPassword ? 'text' : 'password'}
                  style={{ width: '100%', padding: '10px', border: '1px solid #cbd5e0', borderRadius: '6px', backgroundColor: '#fff', fontSize: '14px', color: '#4a5568', boxShadow: 'inset 0 1px 2px rgba(0, 0, 0, 0.05)', paddingRight: '40px' }}
                  value={formData.new_password}
                  onChange={(e) => setFormData({ ...formData, new_password: e.target.value })}
                  required
                />
                <button
                  type="button"
                  onClick={togglePasswordVisibility}
                  style={{ position: 'absolute', right: '10px', background: 'none', border: 'none', color: '#4299e1', cursor: 'pointer', fontSize: '14px' }}
                >
                  {showPassword ? 'Hide' : 'Show'}
                </button>
              </div>
            </div>
            <button type="submit" style={{ width: '100%', padding: '12px', backgroundColor: '#4299e1', color: '#ffffff', borderRadius: '20px', border: 'none', fontWeight: '600', boxShadow: '0 2px 4px rgba(66, 153, 225, 0.3)', transition: 'background-color 0.3s' }} onMouseOver={(e) => (e.target.style.backgroundColor = '#2b6cb0')} onMouseOut={(e) => (e.target.style.backgroundColor = '#4299e1')}>
              Reset Password
            </button>
          </form>
        </div>
      </div>
      <Footer />
    </div>
  );
};

export default ResetPassword;