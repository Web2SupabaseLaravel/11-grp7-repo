import React from 'react';

const Footer = () => {
  return (
    <footer style={{ backgroundColor: '#3182ce', padding: '20px', color: '#ffffff', fontFamily: 'Arial, sans-serif', textAlign: 'center' }}>
      <div style={{ maxWidth: '1200px', margin: '0 auto', display: 'flex', justifyContent: 'space-around', flexWrap: 'wrap', gap: '20px', padding: '10px' }}>
        <div>
          <h3 style={{ fontSize: '18px', fontWeight: '600', marginBottom: '10px' }}>For Patients</h3>
          <ul style={{ listStyle: 'none', padding: 0, textAlign: 'left' }}>
            <li style={{ marginBottom: '5px' }}>Search for Doctor</li>
            <li style={{ marginBottom: '5px' }}>Login</li>
            <li style={{ marginBottom: '5px' }}>Register</li>
            <li style={{ marginBottom: '5px' }}>Booking</li>
            <li>Patient Dashboard</li>
          </ul>
        </div>
        <div>
          <h3 style={{ fontSize: '18px', fontWeight: '600', marginBottom: '10px' }}>For Doctors</h3>
          <ul style={{ listStyle: 'none', padding: 0, textAlign: 'left' }}>
            <li style={{ marginBottom: '5px' }}>Appointments</li>
            <li style={{ marginBottom: '5px' }}>Chat</li>
            <li style={{ marginBottom: '5px' }}>Login</li>
            <li style={{ marginBottom: '5px' }}>Register</li>
            <li>Doctor Dashboard</li>
          </ul>
        </div>
        <div>
          <h3 style={{ fontSize: '18px', fontWeight: '600', marginBottom: '10px' }}>Contact Us</h3>
          <ul style={{ listStyle: 'none', padding: 0, textAlign: 'left' }}>
            <li style={{ marginBottom: '5px' }}>3566 Beech Street, San Francisco, CA 94108</li>
            <li style={{ marginBottom: '5px' }}>+1 315 369 5943</li>
            <li style={{ marginBottom: '5px' }}>doccure@example.com</li>
            <div style={{ display: 'flex', justifyContent: 'center', gap: '10px', marginTop: '10px' }}>
              <a href="#" style={{ color: '#ffffff', fontSize: '18px' }}><i className="fab fa-facebook-f"></i></a>
              <a href="#" style={{ color: '#ffffff', fontSize: '18px' }}><i className="fab fa-twitter"></i></a>
              <a href="#" style={{ color: '#ffffff', fontSize: '18px' }}><i className="fab fa-linkedin-in"></i></a>
              <a href="#" style={{ color: '#ffffff', fontSize: '18px' }}><i className="fab fa-instagram"></i></a>
            </div>
          </ul>
        </div>
      </div>
      <div style={{ marginTop: '20px', fontSize: '14px' }}>
        <p>Copyright © 2025 DocCure. All Rights Reserved</p>
        <p><a href="#" style={{ color: '#ffffff', textDecoration: 'underline' }}>Terms and Conditions</a> | <a href="#" style={{ color: '#ffffff', textDecoration: 'underline' }}>Policy</a></p>
      </div>
    </footer>
  );
};

export default Footer;