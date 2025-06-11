import React from 'react';

const PatientsTable = () => {
  const patients = [
    {
      id: 1,
      name: 'John Smith',
      email: 'john.smith@email.com',
      phone: '(555) 111-2222',
      lastVisit: '15/03/2024'
    },
    {
      id: 2,
      name: 'Emma Davis',
      email: 'emma.davis@email.com',
      phone: '(555) 222-3333',
      lastVisit: '14/03/2024'
    },
    {
      id: 3,
      name: 'Robert Johnson',
      email: 'robert.johnson@email.com',
      phone: '(555) 333-4444',
      lastVisit: '13/03/2024'
    },
    {
      id: 4,
      name: 'Maria Garcia',
      email: 'maria.garcia@email.com',
      phone: '(555) 444-5555',
      lastVisit: '12/03/2024'
    },
    {
      id: 5,
      name: 'David Lee',
      email: 'david.lee@email.com',
      phone: '(555) 555-6666',
      lastVisit: '11/03/2024'
    }
  ];

  return (
    <div className="table-responsive">
      <table className="table table-bordered table-hover mb-0 align-middle">
        <thead className="table-light">
          <tr>
            <th>Patient Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Last Visit</th>
          </tr>
        </thead>
        <tbody>
          {patients.map((patient) => (
            <tr key={patient.id}>
              <td>
                <a href="#" className="text-primary text-decoration-none fw-semibold">
                  {patient.name}
                </a>
              </td>
              <td>{patient.email}</td>
              <td>{patient.phone}</td>
              <td>{patient.lastVisit}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default PatientsTable; 