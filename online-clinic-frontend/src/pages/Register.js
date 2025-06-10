import React, { useState } from 'react';
import Navbar from '../components/Navbar';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import Footer from '../components/Footer';
const Register = () => {
  const [formData, setFormData] = useState({ role: 'patient', full_name: '', email: '', password: '', staff_id: '' });
  const [showPassword, setShowPassword] = useState(false); // حالة لعرض/إخفاء كلمة المرور
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    const data = { ...formData };
    if (formData.role === 'admin') delete data.full_name;
    else delete data.staff_id;
    try {
      await axios.post('http://localhost:8000/api/auth/register', data);
      alert('Success');
      navigate('/login');
    } catch (error) {
      alert(error.response?.data?.message || 'Registration failed');
    }
  };

  const togglePasswordVisibility = () => {
    setShowPassword(!showPassword);
  };

  return (
    <div style={{ height: '100vh', backgroundColor: '#f0f4f8', display: 'flex', flexDirection: 'column', fontFamily: 'Arial, sans-serif', overflow: 'hidden' }}>
    
      <div style={{ flex: '1', display: 'flex', alignItems: 'center', justifyContent: 'center', backgroundImage: "url('https://via.placeholder.com/1200x800')", backgroundSize: 'cover', backgroundPosition: 'center', position: 'relative' }}>
        <div style={{ background: 'linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(240, 248, 255, 0.95))', padding: '25px', borderRadius: '12px', boxShadow: '0 4px 15px rgba(0, 0, 0, 0.1)', width: '400px', border: '1px solid #e0e7ff' }}>
          <h2 style={{ fontSize: '26px', fontWeight: '700', marginBottom: '20px', textAlign: 'center', color: '#2d3748', textTransform: 'uppercase', letterSpacing: '1px' }}>Register</h2>
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
              <label style={{ display: 'block', color: '#2d3748', fontWeight: '500', marginBottom: '5px' }}>Name</label>
              <input
                type="text"
                style={{ width: '100%', padding: '10px', border: '1px solid #cbd5e0', borderRadius: '6px', backgroundColor: '#fff', fontSize: '14px', color: '#4a5568', boxShadow: 'inset 0 1px 2px rgba(0, 0, 0, 0.05)' }}
                value={formData.full_name}
                onChange={(e) => setFormData({ ...formData, full_name: e.target.value })}
                required={formData.role !== 'admin'}
              />
            </div>
            <div>
              <label style={{ display: 'block', color: '#2d3748', fontWeight: '500', marginBottom: '5px' }}>Email</label>
              <input
                type="email"
                style={{ width: '100%', padding: '10px', border: '1px solid #cbd5e0', borderRadius: '6px', backgroundColor: '#fff', fontSize: '14px', color: '#4a5568', boxShadow: 'inset 0 1px 2px rgba(0, 0, 0, 0.05)' }}
                value={formData.email}
                onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                required
              />
            </div>
            <div>
              <label style={{ display: 'block', color: '#2d3748', fontWeight: '500', marginBottom: '5px' }}>Create Password</label>
              <div style={{ display: 'flex', alignItems: 'center', position: 'relative' }}>
                <input
                  type={showPassword ? 'text' : 'password'}
                  style={{ width: '100%', padding: '10px', border: '1px solid #cbd5e0', borderRadius: '6px', backgroundColor: '#fff', fontSize: '14px', color: '#4a5568', boxShadow: 'inset 0 1px 2px rgba(0, 0, 0, 0.05)', paddingRight: '40px' }}
                  value={formData.password}
                  onChange={(e) => setFormData({ ...formData, password: e.target.value })}
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
            <div>
              <label style={{ display: 'block', color: '#2d3748', fontWeight: '500', marginBottom: '5px' }}>Staff ID</label>
              <input
                type="text"
                style={{ width: '100%', padding: '10px', border: '1px solid #cbd5e0', borderRadius: '6px', backgroundColor: '#fff', fontSize: '14px', color: '#4a5568', boxShadow: 'inset 0 1px 2px rgba(0, 0, 0, 0.05)' }}
                value={formData.staff_id}
                onChange={(e) => setFormData({ ...formData, staff_id: e.target.value })}
                required={formData.role === 'admin'}
              />
            </div>
            <button type="submit" style={{ width: '100%', padding: '12px', backgroundColor: '#4299e1', color: '#ffffff', borderRadius: '20px', border: 'none', fontWeight: '600', boxShadow: '0 2px 4px rgba(66, 153, 225, 0.3)', transition: 'background-color 0.3s' }} onMouseOver={(e) => (e.target.style.backgroundColor = '#2b6cb0')} onMouseOut={(e) => (e.target.style.backgroundColor = '#4299e1')}>
              Sign Up
            </button>
            <div style={{ textAlign: 'center', margin: '15px 0', color: '#718096', fontSize: '14px' }}>or</div>
            <button style={{ width: '100%', padding: '12px', backgroundColor: '#f56565', color: '#ffffff', borderRadius: '6px', border: 'none', fontWeight: '600', boxShadow: '0 2px 4px rgba(245, 101, 101, 0.3)', cursor: 'not-allowed', opacity: '0.7' }} disabled>
              Sign in with Google
            </button>
            <button style={{ width: '100%', padding: '12px', backgroundColor: '#4299e1', color: '#ffffff', borderRadius: '6px', border: 'none', fontWeight: '600', boxShadow: '0 2px 4px rgba(66, 153, 225, 0.3)', cursor: 'not-allowed', opacity: '0.7' }} disabled>
              Sign in with Facebook
            </button>
            <p style={{ textAlign: 'center', marginTop: '20px', color: '#718096', fontSize: '14px' }}>Already have account? <a href="/login" style={{ color: '#4299e1', textDecoration: 'none', fontWeight: '500' }}>Sign In</a></p>
          </form>
        </div>
      </div>
      <Footer />
    </div>
  );
};

export default Register;