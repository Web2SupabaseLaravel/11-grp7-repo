import React from 'react';

const DoctorsTable = () => {
  const doctors = [
    {
      id: 1,
      name: 'Dr. Sarah Johnson',
      email: 'sarah.johnson@medical.com',
      phone: '(555) 123-4567',
      speciality: 'Cardiology'
    },
    {
      id: 2,
      name: 'Dr. Michael Chen',
      email: 'michael.chen@medical.com',
      phone: '(555) 234-5678',
      speciality: 'Neurology'
    },
    {
      id: 3,
      name: 'Dr. Emily Brown',
      email: 'emily.brown@medical.com',
      phone: '(555) 345-6789',
      speciality: 'Pediatrics'
    },
    {
      id: 4,
      name: 'Dr. James Wilson',
      email: 'james.wilson@medical.com',
      phone: '(555) 456-7890',
      speciality: 'Orthopedics'
    },
    {
      id: 5,
      name: 'Dr. Lisa Martinez',
      email: 'lisa.martinez@medical.com',
      phone: '(555) 567-8901',
      speciality: 'Dermatology'
    }
  ];

  return (
    <div className="table-responsive">
      <table className="table table-bordered table-hover mb-0 align-middle">
        <thead className="table-light">
          <tr>
            <th>Dr. Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Speciality</th>
          </tr>
        </thead>
        <tbody>
          {doctors.map((doctor) => (
            <tr key={doctor.id}>
              <td>
                <a href="#" className="text-primary text-decoration-none fw-semibold">
                  {doctor.name}
                </a>
              </td>
              <td>{doctor.email}</td>
              <td>{doctor.phone}</td>
              <td>{doctor.speciality}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default DoctorsTable; 