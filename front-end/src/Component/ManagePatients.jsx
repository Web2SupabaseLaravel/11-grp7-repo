import React, { useEffect, useState } from "react";
import axios from "axios";
import "./ManagePatients.css";

const ManagePatients = () => {
  const [patients, setPatients] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchPatients = async () => {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/datapatient");
        const patientsData = Array.isArray(response.data.patient)
          ? response.data.patient
          : [];

        setPatients(patientsData);
        setLoading(false);
      } catch (error) {
        console.error("Error fetching patients:", error);
        setLoading(false);
      }
    };

    fetchPatients();
  }, []);

  return (
    <div className="page-container">
      <h1 className="page-title">Manage Patients</h1>

      <div className="top-bar">
        <div className="search-bar">
          <span className="menu-icon">☰</span>
          <input type="text" placeholder="Search patients..." className="search-input" />
          <span className="search-icon">🔍</span>
        </div>

        <button className="new-patient-btn">New Patient ➤</button>
      </div>

      <div className="table-container">
        {loading ? (
          <p>Loading patients...</p>
        ) : (
          <table className="patients-table">
            <thead>
              <tr>
                <th>Patient Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Phone</th>
              </tr>
            </thead>
            <tbody>
              {patients.length > 0 ? (
                patients.map((p) => (
                  <tr key={p.patient_id}>
                    <td>{p.full_name || "N/A"}</td>
                    <td>{p.date_of_birth || "N/A"}</td>
                    <td>{p.gender || "N/A"}</td>
                    <td>{p.phone || "N/A"}</td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="4">No patients found.</td>
                </tr>
              )}
            </tbody>
          </table>
        )}
      </div>
    </div>
  );
};

export default ManagePatients;
