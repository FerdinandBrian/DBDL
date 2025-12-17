const pool = require('./db');

async function seedUsers() {
    try {
        // ---- KONFIGURASI USER DI SINI ----
        // Anda bisa mengubah data ini sesuai keinginan
        const users = [
            {
                nrp: '2472021',
                password: 'ferdinand11@',
                role: 'mahasiswa',
                nama: 'Mahasiswa Demo', // Opsional, untuk tabel mahasiswa
                prodi: 'Teknik Informatika' // Opsional
            },
            {
                nrp: '0072201',
                password: 'juan123',
                role: 'dosen',
                nama: 'Dosen',
                departemen: 'Teknik Informatika'
            },
            {
                nrp: '001001',
                password: 'bc123',
                role: 'admin',
                nama: 'Administrator'
            }
        ];
        // ----------------------------------

        console.log('Mulai proses seeding...');

        for (const user of users) {
            // 1. Insert/Update ke tabel users (untuk login)
            // Menggunakan INSERT ... ON DUPLICATE KEY UPDATE agar bisa mengubah password jika user sudah ada
            await pool.execute(
                `INSERT INTO users (nrp, password, role) 
         VALUES (?, ?, ?) 
         ON DUPLICATE KEY UPDATE password = VALUES(password), role = VALUES(role)`,
                [user.nrp, user.password, user.role]
            );
            console.log(`✅ Login untuk ${user.role} (${user.nrp}) berhasil diperbarui/dibuat.`);

            // 2. Insert/Update ke tabel data detail (mahasiswa/dosen/admin) agar profil tidak error
            if (user.role === 'mahasiswa') {
                await pool.execute(
                    `INSERT INTO mahasiswa (nrp, nama, prodi, angkatan) 
           VALUES (?, ?, ?, '2023') 
           ON DUPLICATE KEY UPDATE nama = VALUES(nama), prodi = VALUES(prodi)`,
                    [user.nrp, user.nama || 'Mahasiswa', user.prodi || 'Umum']
                );
                console.log(`   Detailed profile untuk mahasiswa ${user.nrp} OK.`);
            }
            else if (user.role === 'dosen') {
                await pool.execute(
                    `INSERT INTO dosen (nrp, nama, departemen) 
           VALUES (?, ?, ?) 
           ON DUPLICATE KEY UPDATE nama = VALUES(nama), departemen = VALUES(departemen)`,
                    [user.nrp, user.nama || 'Dosen', user.departemen || 'Umum']
                );
                console.log(`   Detailed profile untuk dosen ${user.nrp} OK.`);
            }
            else if (user.role === 'admin') {
                // Pastikan tabel admin ada (sesuai schema.sql)
                await pool.execute(
                    `INSERT INTO admin (nrp, nama) 
           VALUES (?, ?) 
           ON DUPLICATE KEY UPDATE nama = VALUES(nama)`,
                    [user.nrp, user.nama || 'Admin']
                );
                console.log(`   Detailed profile untuk admin ${user.nrp} OK.`);
            }
        }

        console.log('🎉 Selesai! Sekarang Anda bisa login dengan data di atas.');
        process.exit(0);
    } catch (error) {
        console.error('❌ Terjadi error:', error);
        process.exit(1);
    }
}

seedUsers();
