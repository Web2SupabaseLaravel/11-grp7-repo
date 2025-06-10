import React from 'react';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';

const Home = () => {
  const navigate = useNavigate();

  const handleGetStarted = () => {
    navigate('/register');
  };

  return (
    <div style={{ height: '100vh', backgroundColor: '#f0f4f8', display: 'flex', flexDirection: 'column', fontFamily: 'Arial, sans-serif', overflow: 'hidden' }}>
      <div style={{ flex: '1', display: 'flex', alignItems: 'center', justifyContent: 'center', backgroundImage: "url('https://via.placeholder.com/1200x800')", backgroundSize: 'cover', backgroundPosition: 'center', position: 'relative' }}>
        <div style={{ background: 'linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(240, 248, 255, 0.95))', padding: '30px', borderRadius: '15px', boxShadow: '0 6px 20px rgba(0, 0, 0, 0.1)', width: '450px', border: '1px solid #e0e7ff', textAlign: 'center', animation: 'fadeIn 1s ease-in' }}>
          <h1 style={{ fontSize: '32px', fontWeight: '800', marginBottom: '15px', color: '#2d3748', textTransform: 'uppercase', letterSpacing: '1.5px' }}>Online Clinic Booking</h1>
          <p style={{ color: '#718096', fontSize: '18px', fontWeight: '500', marginBottom: '25px' }}>A seamless platform to book medical appointments, connect with healthcare professionals, and manage your health records effortlessly.</p>
          <ul style={{ textAlign: 'left', color: '#4a5568', fontSize: '16px', marginBottom: '25px', paddingLeft: '20px' }}>
            <li>Easy appointment scheduling</li>
            <li>24/7 access to doctors</li>
            <li>Secure health record management</li>
            <li>Real-time chat support</li>
          </ul>
          <button
            style={{ width: '100%', padding: '14px', backgroundColor: '#4299e1', color: '#ffffff', borderRadius: '25px', border: 'none', fontWeight: '600', boxShadow: '0 3px 6px rgba(66, 153, 225, 0.4)', transition: 'all 0.3s', cursor: 'pointer' }}
            onMouseOver={(e) => { e.target.style.backgroundColor = '#2b6cb0'; e.target.style.transform = 'scale(1.05)'; }}
            onMouseOut={(e) => { e.target.style.backgroundColor = '#4299e1'; e.target.style.transform = 'scale(1)'; }}
            onClick={handleGetStarted}
          >
            Get Started
          </button>
        </div>
      </div>
      <Footer />
    </div>
  );
};


const styles = `
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
`;
const styleSheet = document.styleSheets[0];
styleSheet.insertRule(styles, styleSheet.cssRules.length);

export default Home;