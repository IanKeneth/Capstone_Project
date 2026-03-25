const mysql =require('mysql');

const conn = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'issa_system'
});

conn.connect((err) => {
    if (err) {
        console.error('Error connecting to the database:', err);
        return;
    }else{
    console.log('Connected to the  database.');
    }
});
module.exports=conn;