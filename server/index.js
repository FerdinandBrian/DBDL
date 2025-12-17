const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const dotenv = require('dotenv');

dotenv.config();

const authRoutes = require('./routes/auth');
const mhsRoutes = require('./routes/mhs');
const dosenRoutes = require('./routes/dosen');
const adminRoutes = require('./routes/admin');

const app = express();
const PORT = process.env.PORT || 3000;

app.use(cors());
app.use(bodyParser.json());

app.use('/api', authRoutes);
app.use('/api/mhs', mhsRoutes);
app.use('/api/dosen', dosenRoutes);
app.use('/api/admin', adminRoutes);

app.get('/', (req, res) => res.json({ message: 'EduTrack API running' }));

app.listen(PORT, () => console.log(`Server listening on port ${PORT}`));
