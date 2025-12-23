let currentRole = 'mahasiswa';

function selectRole(role, el) {
    currentRole = role;
    document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
    if (el && el.classList) el.classList.add('active');
}

async function handleLogin(event) {
    event.preventDefault();
    const nrp = document.getElementById('nrp').value;
    const password = document.getElementById('password').value;

    try {
        // Using Laravel API
        const API_BASE_URL = 'http://localhost:8000';
        const res = await fetch(`${API_BASE_URL}/api/login`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nrp, password, role: currentRole })
        });
        const data = await res.json();
        if (res.ok && data.success) {
            localStorage.setItem('userRole', data.role);
            localStorage.setItem('nrp', data.nrp);
            window.location.href = data.redirect || (data.role === 'mahasiswa' ? './dashboard-mhs.html' : data.role === 'dosen' ? './dashboard-dosen.html' : './dashboard-admin.html');
        } else {
            alert(data.message || 'Gagal login');
        }
    } catch (err) {
        console.error(err);
        alert('Tidak dapat terhubung ke server. Pastikan backend berjalan.');
    }
}
