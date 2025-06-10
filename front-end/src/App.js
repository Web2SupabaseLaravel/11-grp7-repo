import React from 'react';
import './App.css';

import ManagePatients from './Component/ManagePatients';
import ManageAppointments from './Component/ManageAppointments';
import DoctorReports from './Component/DoctorReports';

function App() {
  return (
    <div className="App">
      <ManagePatients />
      <hr />
      <ManageAppointments />
      <hr />
      <DoctorReports />
    </div>
  );
}

export default App;
