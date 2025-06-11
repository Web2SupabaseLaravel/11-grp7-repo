import React from 'react';
import { FaUserMd, FaUsers, FaCalendarAlt } from 'react-icons/fa';
import DoctorsTable from './DoctorsTable';
import PatientsTable from './PatientsTable';
import AppointmentsTable from './AppointmentsTable';

const StatsCard = ({ icon, label, value, color }) => (
  <div className="col-md-4">
    <div className="card border-primary shadow-sm rounded-4 h-100">
      <div className="card-body text-center py-4">
        <div className={`mb-2 display-5 ${color}`}>{icon}</div>
        <div className="fw-bold fs-5 mb-1">{label}</div>
        <div className="fs-2 fw-bold">{value}</div>
      </div>
    </div>
  </div>
);

const Reports = () => (
  <div className="container py-4">
    {/* Statistic Cards */}
    <div className="row g-4 mb-4">
      <StatsCard icon={<FaUserMd />} label="Doctors" value="5" color="text-primary" />
      <StatsCard icon={<FaUsers />} label="Patients" value="13" color="text-info" />
      <StatsCard icon={<FaCalendarAlt />} label="Appointments" value="13" color="text-success" />
    </div>

    {/* Tables */}
    <div className="row g-4 mb-4">
      <div className="col-lg-6">
        <div className="card shadow-sm rounded-4 h-100">
          <div className="card-header bg-white fw-bold">Doctors Table</div>
          <div className="card-body p-0">
            <DoctorsTable />
          </div>
        </div>
      </div>
      <div className="col-lg-6">
        <div className="card shadow-sm rounded-4 h-100">
          <div className="card-header bg-white fw-bold">Patients Table</div>
          <div className="card-body p-0">
            <PatientsTable />
          </div>
        </div>
      </div>
    </div>

    <div className="card shadow-sm rounded-4">
      <div className="card-header bg-white fw-bold">Appointments</div>
      <div className="card-body p-0">
        <AppointmentsTable />
      </div>
    </div>
  </div>
);

export default Reports; 