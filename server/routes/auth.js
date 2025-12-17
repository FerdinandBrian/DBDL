const express = require('express');
const router = express.Router();
const pool = require('../db');

router.post('/login', async (req, res) => {
  const { nrp, password, role } = req.body;
  if (!nrp || !password || !role) return res.status(400).json({ success: false, message: 'nrp, password, and role required' });

  try {
    // Perbaikan: Cari user berdasarkan NRP saja, karena role tidak ada di tabel users.
    // Kita akan memvalidasi role setelahnya.
    const [rows] = await pool.execute('SELECT nrp, password, role, redirect FROM users WHERE nrp = ? LIMIT 1', [nrp]);
    if (rows.length === 0) {
      return res.status(401).json({ success: false, message: 'NRP tidak ditemukan' });
    }

    const user = rows[0];
    // Tambahan: Validasi apakah role yang dipilih di frontend cocok dengan role user di database
    if (user.role !== role) {
      return res.status(401).json({ success: false, message: `NRP ini tidak terdaftar sebagai ${role}` });
    }
    if (user.password !== password) {
      return res.status(401).json({ success: false, message: 'Password salah' });
    }

    return res.json({ success: true, nrp: user.nrp, role: user.role, redirect: user.redirect || '/' });
  } catch (err) {
    console.error(err);
    return res.status(500).json({ success: false, message: 'Server error' });
  }
});

module.exports = router;
