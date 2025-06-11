import React, { useEffect, useState } from "react";
import axios from "axios";
import "./DoctorReports.css";

const DoctorReports = () => {
  const [reports, setReports] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchReports = async () => {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/datareport");
        console.log("API Response reports:", response.data);

        if (response.data && Array.isArray(response.data.report)) {
          setReports(response.data.report);
        } else {
          setReports([]);
        }
        setLoading(false);
      } catch (error) {
        console.error("Error fetching reports:", error);
        setLoading(false);
      }
    };

    fetchReports();
  }, []);

  const sortedReports = [...reports].sort((a, b) => a.report_id - b.report_id);

  return (
    <div className="reports-container">
      <h1 className="reports-title">Doctor Reports</h1>

      <div className="stats-cards">
        <div className="stat-card">
          <div className="stat-number">{reports.length}</div>
          <div className="stat-label">Reports this month</div>
        </div>
        <div className="stat-card">
          <div className="stat-number">10</div>
          <div className="stat-label">Lab this month</div>
        </div>
        <div className="stat-card">
          <div className="stat-number">6</div>
          <div className="stat-label">Treatment Plan</div>
        </div>
      </div>

      <div className="report-table-wrapper">
        {loading ? (
          <p>Loading reports...</p>
        ) : (
          <table className="report-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Type</th>
                <th>Patient</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              {sortedReports.length > 0 ? (
                sortedReports.map((report) => (
                  <tr key={report.report_id}>
                    <td>{report.report_id}</td>
                    <td>{report.report_date || "N/A"}</td>
                    <td>{report.report_type || "N/A"}</td>
                    <td>{report.patient_name || "N/A"}</td>
                    <td>
                      <button className="view-btn">View</button>
                    </td>
                    <td>
                      <button className="download-btn">Download</button>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="6">No reports found.</td>
                </tr>
              )}
            </tbody>
          </table>
        )}
      </div>
    </div>
  );
};

export default DoctorReports;
