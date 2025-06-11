import React, { useEffect, useState } from "react";
import axios from "axios";
import "./ManageAppointments.css";

const ManageAppointments = () => {
  const [appointments, setAppointments] = useState([]);
  const [loading, setLoading] = useState(true);

  const getStatusClass = (status) => {
    switch (status?.toLowerCase()) {
      case "pending":
        return "status-pending";
      case "confirmed":
        return "status-confirmed";
      case "canceled":
        return "status-canceled";
      default:
        return "";
    }
  };

  useEffect(() => {
    const fetchAppointments = async () => {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/dataappointment");


        if (Array.isArray(response.data)) {
          setAppointments(response.data);
        } else if (response.data?.appointments) {
          setAppointments(response.data.appointments);
        } else {
          setAppointments([]);
        }
      } catch (error) {
        console.error("Error fetching appointments:", error);
        setAppointments([]);
      } finally {
        setLoading(false);
      }
    };

    fetchAppointments();
  }, []);

  return (
    <div className="page-container">
      <h1 className="page-title">Manage Appointments</h1>

      <div className="top-bar">
        <div className="search-bar">
          <span className="menu-icon">☰</span>
          <input type="text" placeholder="Hinted search text" className="search-input" />
          <span className="search-icon"></span>
        </div>
        <button className="new-appointment-btn">New Appointment ➤</button>
      </div>

      <div className="filters">
        <button className="filter-btn">Date</button>
        <button className="filter-btn">Doctor</button>
        <button className="filter-btn">Status</button>
      </div>

      <div className="table-container">
        {loading ? (
          <p>Loading appointments...</p>
        ) : appointments.length === 0 ? (
          <p>No appointments found.</p>
        ) : (
          <table className="appointments-table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Doctor</th>
                <th>Patient</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              {appointments.map((appt) => (
                <tr key={appt.appointment_id}>
                  <td>{appt.appointment_date}</td>
                  <td>{appt.appointment_time}</td>
                  <td>{appt.doctor_name || appt.practitioner_name || appt.practitioner_id || "Doctor"}</td>
                  <td>{appt.patient_name || appt.patient_id || "Patient"}</td>
                  <td className={getStatusClass(appt.status)}>{appt.status}</td>
                </tr>
              ))}
            </tbody>
          </table>
        )}
      </div>
    </div>
  );
};

export default ManageAppointments;
