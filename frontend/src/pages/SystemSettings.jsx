import React, { useEffect, useState } from 'react';
import axios from 'axios';
import './SystemSettings.css';

export default function SystemSettings() {
  const [settings, setSettings] = useState({
    siteTitle: '',         
    adminEmail: '',       
    itemsPerPage: '10',    
    maintenanceMode: false 
  });

  const [settingsId, setSettingsId] = useState(null); 
  const [loading, setLoading] = useState(true);
  const [saving, setSaving] = useState(false);
  const [message, setMessage] = useState('');

  useEffect(() => {
    axios.get("http://127.0.0.1:8000/api/dataSystem")
      .then(res => {
        const data = res.data;
        setSettings({
          siteTitle: data.site_name || '',
          adminEmail: data.site_email || '',
          itemsPerPage: data.items_per_page ? String(data.items_per_page) : '10',
          maintenanceMode: data.maintenance_mode || false,
        });
        setSettingsId(data.settings_id);
        setLoading(false);
      })
      .catch(err => {
        console.error("error:", err);
        setLoading(false);
      });
  }, []);

  function handleChange(e) {
    const { name, value, type, checked } = e.target;
    setSettings(prev => ({
      ...prev,
      [name]: type === 'checkbox' ? checked : value
    }));
  }

  function handleSubmit(e) {
    e.preventDefault();
    if (!settingsId) {
      setMessage('Error: Settings ID not found.');
      return;
    }
    setSaving(true);
    setMessage('');

    
    const payload = {
      site_name: settings.siteTitle,
      site_email: settings.adminEmail,
      items_per_page: settings.itemsPerPage,
      maintenance_mode: settings.maintenanceMode,
    };

    axios.put(`http://127.0.0.1:8000/api/dataSystem/${settingsId}`, payload)
      .then(res => {
        setMessage('Settings saved successfully!');
        setSaving(false);
      })
      .catch(err => {
        console.error("error:", err);
        setMessage('Error saving settings.');
        setSaving(false);
      });
  }

  if (loading) return <div>Loading settings...</div>;

  return (
    <div className="system-settings">
      <h2>System Settings</h2>

      <form onSubmit={handleSubmit}>
        <label>
          Site Name:
          <input
            type="text"
            name="siteTitle"
            value={settings.siteTitle}
            onChange={handleChange}
          />
        </label>

        <label>
          Admin Email:
          <input
            type="email"
            name="adminEmail"
            value={settings.adminEmail}
            onChange={handleChange}
          />
        </label>

        <label>
          Items per page:
          <select
            name="itemsPerPage"
            value={settings.itemsPerPage}
            onChange={handleChange}
          >
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
          </select>
        </label>

        <label className="checkbox-label">
          Maintenance Mode
          <input
            type="checkbox"
            name="maintenanceMode"
            checked={settings.maintenanceMode}
            onChange={handleChange}
          />
        </label>

        <button type="submit" disabled={saving}>
          {saving ? 'Saving...' : 'Save Settings'}
        </button>

        {message && <p>{message}</p>}
      </form>
    </div>
  );
}
