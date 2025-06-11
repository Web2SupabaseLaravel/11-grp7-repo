import React from 'react';

const StatusBadge = ({ status }) => (
  <span className={`badge ${status === 'Active' ? 'bg-success' : 'bg-secondary'}`}>{status}</span>
);

const AppointmentsTable = () => {
  const appointments = [
    {
      id: 1,
      doctorName: 'Dr. Sarah Johnson',
      speciality: 'Cardiology',
      patientName: 'John Smith',
      appointmentTime: '15/03/2024 09:00 AM',
      status: 'Active',
      amount: '$150'
    },
    {
      id: 2,
      doctorName: 'Dr. Michael Chen',
      speciality: 'Neurology',
      patientName: 'Emma Davis',
      appointmentTime: '15/03/2024 10:30 AM',
      status: 'Active',
      amount: '$200'
    },
    {
      id: 3,
      doctorName: 'Dr. Emily Brown',
      speciality: 'Pediatrics',
      patientName: 'Robert Johnson',
      appointmentTime: '15/03/2024 11:00 AM',
      status: 'Inactive',
      amount: '$120'
    },
    {
      id: 4,
      doctorName: 'Dr. James Wilson',
      speciality: 'Orthopedics',
      patientName: 'Maria Garcia',
      appointmentTime: '15/03/2024 02:00 PM',
      status: 'Active',
      amount: '$180'
    },
    {
      id: 5,
      doctorName: 'Dr. Lisa Martinez',
      speciality: 'Dermatology',
      patientName: 'David Lee',
      appointmentTime: '15/03/2024 03:30 PM',
      status: 'Active',
      amount: '$160'
    },
    {
      id: 6,
      doctorName: 'Dr. Sarah Johnson',
      speciality: 'Cardiology',
      patientName: 'Sarah Wilson',
      appointmentTime: '15/03/2024 04:00 PM',
      status: 'Inactive',
      amount: '$150'
    },
    {
      id: 7,
      doctorName: 'Dr. Michael Chen',
      speciality: 'Neurology',
      patientName: 'Michael Brown',
      appointmentTime: '16/03/2024 09:00 AM',
      status: 'Active',
      amount: '$200'
    },
    {
      id: 8,
      doctorName: 'Dr. Emily Brown',
      speciality: 'Pediatrics',
      patientName: 'Emily Davis',
      appointmentTime: '16/03/2024 10:30 AM',
      status: 'Active',
      amount: '$120'
    },
    {
      id: 9,
      doctorName: 'Dr. James Wilson',
      speciality: 'Orthopedics',
      patientName: 'James Smith',
      appointmentTime: '16/03/2024 11:00 AM',
      status: 'Inactive',
      amount: '$180'
    },
    {
      id: 10,
      doctorName: 'Dr. Lisa Martinez',
      speciality: 'Dermatology',
      patientName: 'Lisa Johnson',
      appointmentTime: '16/03/2024 02:00 PM',
      status: 'Active',
      amount: '$160'
    }
  ];

  return (
    <div className="table-responsive">
      <table className="table table-bordered table-hover mb-0 align-middle">
        <thead className="table-light">
          <tr>
            <th>Doctor Name</th>
            <th>Speciality</th>
            <th>Patient Name</th>
            <th>Appointment Time</th>
            <th>Status</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          {appointments.map((a) => (
            <tr key={a.id}>
              <td>{a.doctorName}</td>
              <td>{a.speciality}</td>
              <td>{a.patientName}</td>
              <td>{a.appointmentTime}</td>
              <td><StatusBadge status={a.status} /></td>
              <td>{a.amount}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default AppointmentsTable; 