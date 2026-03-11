const express = require ("express");
const app = express();

app.use(express.static("public"));
app.use(express.urlencoded({extended: true}));
app.set('view engine', 'ejs');

app.get('/', (req, res) => {
    res.render('index');
});
// This fixes the "Cannot GET /" error
app.get('/index.ejs', (req, res) => {
    res.render('index');
});

app.get('/tables.ejs',(req, res)=>{
    res.render('tables');
})

app.get('/product.ejs',(req, res)=>{
    res.render('product');
})

app.get('/supply.ejs',(req, res)=>{
    res.render('supply');
})

app.get('/sales.ejs',(req, res)=>{
    res.render('sales');
})


app.get('/logout', (req, res) => {
    // If using express-session
    req.session.destroy((err) => {
        // After destroying session, redirect back to the PHP login page
        res.redirect('http://localhost/your_project/login.php');
    });
});

app.listen(8000, () => {
    console.log('Listening on port 8000. Go to http://localhost:8000');
});