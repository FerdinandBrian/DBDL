const roles = {
    mahasiswa: {
        label: 'Mahasiswa',
        username: '2472021',
        password: 'ferdinand11@',
        redirect: './dashboard-mhs.html'
    },
    dosen: {
        label: 'Dosen',
        username: 'dosen01',
        password: 'password123',
        redirect: './dashboard-dosen.html'
    },
    admin: {
        label: 'Admin',
        username: 'admin01',
        password: 'password123',
        redirect: './dashboard-admin.html'
    }
};

let currentRole = 'mahasiswa';

function selectRole(role) {
    currentRole = role;
    
    document.querySelectorAll('.role-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
}

function handleLogin(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const roleData = roles[currentRole];
    
    if (username === roleData.username && password === roleData.password) {
        localStorage.setItem('userRole', currentRole);
        localStorage.setItem('username', username);
        
        window.location.href = roleData.redirect;
    } else {
        alert('Username atau password salah!');
    }
}
