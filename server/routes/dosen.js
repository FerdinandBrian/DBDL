const express = require('express');
const router = express.Router();
const pool = require('../db');

router.get('/profile', async (req, res) => {
  const nrp = req.query.nrp;
  if (!nrp) return res.status(400).json({ success: false, message: 'nrp required' });

  try {
    const [rows] = await pool.execute('SELECT nrp, nama, departemen FROM dosen WHERE nrp = ? LIMIT 1', [nrp]);
    if (rows.length === 0) return res.status(404).json({ success: false, message: 'Dosen tidak ditemukan' });
    return res.json({ success: true, data: rows[0] });
  } catch (err) {
    console.error(err);
    return res.status(500).json({ success: false, message: 'Server error' });
  }
});

module.exports = router;
