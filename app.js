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

app.get('/supplies',(req, res)=>{
    res.render('supplies');
})

app.get('/track&reports',(req, res)=>{
    res.render('track&reports');
})
app.get('/settings',(req, res)=>{
    res.render('settings');
})
app.get('/logout',(req, res)=>{
    if(req.session){
        req.session.destroy((err)=>{
            if(err){
                console.error('Error destroy session:',err);
            }
            res.clearCookie('connect.sid');
            res.redirect('http://localhost/capstone/app/login.php');
        });
    }else{
        res.redirect('http://localhost/capstone/app/login.php');
    }
})
//inevtory function
app.get('/inventory', (req, res) => {
    const query = "SELECT * FROM products ";
    conn.query(query, (err, myData) => {
        if(err) throw err;
        res.render('inventory', {
            title: "Inventory",
            products:myData
        });
    });
});


app.post('/add', (req, res) => {
    const {id, product_name, category, price, quantity, max_quantity } = req.body;
    const stock = (quantity / max_quantity) * 100;
    const sql = `INSERT INTO products (id, product_name, category, price, quantity, max_quantity, stock_percent)
        VALUES (?, ?, ?, ?, ?, ?,?)`;
    conn.query(sql, [id, product_name, category, price, quantity, max_quantity, stock], (err, result) => {
        if (err) {
            console.error(err);
            return res.status(500).send("Database error");
        }
        console.log("Data inserted");
        res.redirect('inventory');
    });
});

app.get("/edit", (req, res) => {
    const { id,product_name,category,price,quantity,max_quantity } = req.query;
    const sql = `UPDATE products SET  product_name="${product_name}", category="${category}",
    price="${price}", quantity="${quantity}",max_quantity="${max_quantity}" WHERE id ="${id}"`;
    conn.query(sql, (err, result) => {
        if (err) throw err;
        console.log("Updated");
        res.redirect('/inventory');
    });
});

app.get("/edit/:id", (req, res) => {
    const id= req.params.id;
    const sql = `SELECT * FROM products WHERE id = "${id}"`;

    conn.query(sql, (err, result) => {
        if (err) throw err;
        res.render("update", { myData: result[0] });
    });
});

app.get("/delete/:id", (req, res) => {
    const id= req.params.id;
    const sql = `DELETE FROM products WHERE id = "${id}"`;
    conn.query(sql,(err, result) => {
        if (err) throw err;
        console.log(" deleted ");
        res.redirect('/inventory');
    });
    
})
//----------------------------------------------------------

//user management function
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
    const id= req.params.id;
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
//----------------------------------------------------------------------
app.listen(8000, () => {
    console.log('Listening on port 8000. Go to http://localhost:8000');
});