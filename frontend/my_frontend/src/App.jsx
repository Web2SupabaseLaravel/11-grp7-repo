import React from 'react';
import Reports from './components/Reports/Reports';
import './App.css';

function App() {
  return (
    <div className="min-h-screen bg-gray-100">
      <div className="container mx-auto px-4 py-8">
        <h1 className="text-3xl font-bold text-gray-800 mb-8">Report Page</h1>
        <Reports />
      </div>
    </div>
  );
}

export default App;
