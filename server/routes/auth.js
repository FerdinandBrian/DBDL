const express = require('express');
const router = express.Router();
const pool = require('../db');
// const bcrypt = require('bcrypt'); // Disable bcrypt for simple plain text password check

router.post('/login', async (req, res) => {
  const { nrp, password, role } = req.body;
  if (!nrp || !password || !role) return res.status(400).json({ success: false, message: 'nrp, password, and role required' });

  try {
    // Perbaikan: Cari user berdasarkan NRP dan Role secara bersamaan.
    // Ini lebih akurat sesuai dengan skema database (UNIQUE KEY (nrp, role)).
    const [rows] = await pool.execute('SELECT nrp, password, role, redirect FROM users WHERE nrp = ? AND role = ? LIMIT 1', [nrp, role]);
    if (rows.length === 0) {
      return res.status(401).json({ success: false, message: 'Kombinasi NRP dan Role tidak ditemukan' });
    }

    const user = rows[0];
    // Peningkatan Keamanan: Bandingkan password yang diinput dengan hash di database
    // Simplified: Check password directly (plain text)
    const passwordMatch = password === user.password;

    if (!passwordMatch) {
      return res.status(401).json({ success: false, message: 'Password salah' });
    }

    return res.json({ success: true, nrp: user.nrp, role: user.role, redirect: user.redirect || '/' });
  } catch (err) {
    console.error(err);
    return res.status(500).json({ success: false, message: 'Server error' });
  }
});

module.exports = router;
