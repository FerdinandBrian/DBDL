const mysql = require('mysql2/promise');
const fs = require('fs');
const path = require('path');
const dotenv = require('dotenv');

dotenv.config();

async function setupDatabase() {
    try {
        // 1. Connect without database selected
        const connection = await mysql.createConnection({
            host: process.env.DB_HOST || 'localhost',
            user: process.env.DB_USER || 'root',
            password: process.env.DB_PASSWORD || '',
        });

        console.log('Connected to MySQL server.');

        // 2. Create Database
        await connection.query(`CREATE DATABASE IF NOT EXISTS edutrack`);
        console.log('Database "edutrack" created or already exists.');

        // 3. Use Database
        await connection.query(`USE edutrack`);

        // 4. Read and Execute Schema
        const schemaPath = path.join(__dirname, 'schema.sql');
        const schemaSql = fs.readFileSync(schemaPath, 'utf8');

        // Split by semicolon to execute statements individually
        // (mysql2 execute/query usually handles one statement at a time nicely, 
        // but for safety with multiple statements we enable multipleStatements: true 
        // OR split manually. Let's try splitting manually for robustness without changing connection config deeply)

        // Actually, let's just create a new connection with multipleStatements: true for the schema
        await connection.end();

        const dbConnection = await mysql.createConnection({
            host: process.env.DB_HOST || 'localhost',
            user: process.env.DB_USER || 'root',
            password: process.env.DB_PASSWORD || '',
            database: 'edutrack',
            multipleStatements: true
        });

        console.log('Applying schema...');
        await dbConnection.query(schemaSql);
        console.log('Schema applied successfully.');

        await dbConnection.end();
        console.log('🎉 Setup complete!');
        process.exit(0);

    } catch (error) {
        console.error('❌ Error during setup:', error);
        process.exit(1);
    }
}

setupDatabase();
