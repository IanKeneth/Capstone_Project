const express = require('express');
const app = express();
const conn = require('./conn'); 
app.use(express.static("public"));
app.use(express.urlencoded({extended: true}));
app.set('view engine', 'ejs');

app.get('/User-management', (req, res) => {
    const query = "SELECT * FROM users";
    conn.query(query,(err,user)=>{
        if(err) throw err;
        res.render('User-management',{
        title:"User Management",
        users:user
    });
    });

});