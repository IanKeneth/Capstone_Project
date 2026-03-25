const conn = require('./conn');
const express = require ("express");
const app = express();
const session = require('express-session');

app.use(session({
    secret: "!an@12345678*",
    resave: false,
    saveUninitialized: false,
    cookie: { secure: false } 
}));

app.use(express.static("public"));
app.use(express.urlencoded({extended: true}));
app.set('view engine', 'ejs');

app.get('/', (req, res) => {
    res.render('index');
});

app.get('/index', (req, res) => {
    res.render('index');
});

app.get('/inventory',(req, res)=>{
    res.render('inventory');
})


app.get('/supplies',(req, res)=>{
    res.render('supplies');
})

app.get('/reports',(req, res)=>{
    res.render('reports');
})
app.get('/settings',(req, res)=>{
    res.render('settings');
})
app.get('/test-session', (req, res) => {
    req.session.test = "It works!";
    res.send(`Session Value: ${req.session.test}`);
});

app.get('/logout', (req, res) => {
    // Add a check to prevent the 'undefined' error
    if (req.session) {
        req.session.destroy((err) => {
            if (err) {
                console.error('Error destroying session:', err);
            }
            // Clear the cookie and redirect
            res.clearCookie('connect.sid'); 
            res.redirect('http://localhost/capstone/app/login.php');
        });
    } else {
        // Session was already gone or never existed
        res.redirect('http://localhost/capstone/app/login.php');
    }
});
app.get('/User-management', (req, res) => {
    const query = "SELECT * FROM users";
    conn.query(query,(err,mydata)=>{
        if(err) throw err;
        res.render('User-management',{
        title:"User Management",
        student:mydata
    });
    });
});
app.get("/update/:id", (req, res) => {
    const id_num= req.params.id;
    const sql = `SELECT * FROM users WHERE id = "${id}"`;

    conn.query(sql, (err, result) => {
        if (err) throw err;
        res.render("edit", { mydata: result[0] });
    });
});
app.get("/update", (req, res) => {
    const { id,name,email,role } = req.query;
    const sql = `UPDATE users SET name="${name}", email="${email}", role="${role}" WHERE id ="${id}"`;
    conn.query(sql, (err, result) => {
        if (err) throw err;
        console.log("Updated");
        res.redirect('/User-management');
    });
});
app.get("/delete/:id", (req, res) => {
    const id= req.params.id;
    const sql = `DELETE FROM users WHERE id = "${id}"`;
    conn.query(sql,(err, result) => {
        if (err) throw err;
        console.log(" deleted ");
        res.redirect('/User-management');
    });
    
})

app.listen(8000, () => {
    console.log('Listening on port 8000. Go to http://localhost:8000');
});