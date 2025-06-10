import React from 'react';
import { Link } from 'react-router-dom';

const Navbar = () => {
  return (
    <nav style={{ backgroundColor: '#ffffff', padding: '15px', borderBottom: '2px solid #e6f0fa', boxShadow: '0 4px 12px rgba(0, 0, 0, 0.05)', position: 'sticky', top: '0', zIndex: '1000', transition: 'background-color 0.3s' }} onMouseOver={(e) => (e.target.style.backgroundColor = '#f7fafc')} onMouseOut={(e) => (e.target.style.backgroundColor = '#ffffff')}>
      <div style={{ maxWidth: '1200px', margin: '0 auto', display: 'flex', justifyContent: 'center', alignItems: 'center', flexWrap: 'wrap', gap: '20px', fontFamily: 'Arial, sans-serif' }}>
        <div style={{ color: '#3182ce', fontSize: '28px', fontWeight: '700', letterSpacing: '1.5px', textShadow: '0 1px 2px rgba(49, 130, 206, 0.2)' }}>DOCURE</div>
        <div style={{ display: 'flex', gap: '25px', flexWrap: 'wrap', justifyContent: 'center' }}>
          <Link to="/" style={{ color: '#2d3748', textDecoration: 'none', fontSize: '17px', fontWeight: '600', padding: '8px 15px', borderRadius: '5px', transition: 'all 0.3s', position: 'relative' }} onMouseOver={(e) => { e.target.style.color = '#4299e1'; e.target.style.backgroundColor = '#edf2f7'; }} onMouseOut={(e) => { e.target.style.color = '#2d3748'; e.target.style.backgroundColor = 'transparent'; }}>Home</Link>
          <Link to="/login" style={{ color: '#2d3748', textDecoration: 'none', fontSize: '17px', fontWeight: '600', padding: '8px 15px', borderRadius: '5px', transition: 'all 0.3s', position: 'relative' }} onMouseOver={(e) => { e.target.style.color = '#4299e1'; e.target.style.backgroundColor = '#edf2f7'; }} onMouseOut={(e) => { e.target.style.color = '#2d3748'; e.target.style.backgroundColor = 'transparent'; }}>Login</Link>
          <Link to="/register" style={{ color: '#2d3748', textDecoration: 'none', fontSize: '17px', fontWeight: '600', padding: '8px 15px', borderRadius: '5px', transition: 'all 0.3s', position: 'relative' }} onMouseOver={(e) => { e.target.style.color = '#4299e1'; e.target.style.backgroundColor = '#edf2f7'; }} onMouseOut={(e) => { e.target.style.color = '#2d3748'; e.target.style.backgroundColor = 'transparent'; }}>Register</Link>
          <Link to="/forgot-password" style={{ color: '#2d3748', textDecoration: 'none', fontSize: '17px', fontWeight: '600', padding: '8px 15px', borderRadius: '5px', transition: 'all 0.3s', position: 'relative' }} onMouseOver={(e) => { e.target.style.color = '#4299e1'; e.target.style.backgroundColor = '#edf2f7'; }} onMouseOut={(e) => { e.target.style.color = '#2d3748'; e.target.style.backgroundColor = 'transparent'; }}>Forgot Password</Link>
          <Link to="/reset-password" style={{ color: '#2d3748', textDecoration: 'none', fontSize: '17px', fontWeight: '600', padding: '8px 15px', borderRadius: '5px', transition: 'all 0.3s', position: 'relative' }} onMouseOver={(e) => { e.target.style.color = '#4299e1'; e.target.style.backgroundColor = '#edf2f7'; }} onMouseOut={(e) => { e.target.style.color = '#2d3748'; e.target.style.backgroundColor = 'transparent'; }}>Reset Password</Link>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;