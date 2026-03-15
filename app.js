const express = require ("express");
const app = express();

app.use(express.static("public"));
app.use(express.urlencoded({extended: true}));
app.set('view engine', 'ejs');

app.get('/', (req, res) => {
    res.render('index');
});

app.get('/index.ejs', (req, res) => {
    res.render('index');
});

app.get('/inventory.ejs',(req, res)=>{
    res.render('inventory');
})


app.get('/supplies.ejs',(req, res)=>{
    res.render('supplies');
})

app.get('/orders.ejs',(req, res)=>{
    res.render('orders');
})

app.get('/reports.ejs',(req, res)=>{
    res.render('reports');
})

app.get('/settings.ejs',(req, res)=>{
    res.render('settings');
})

app.get('/logout', (req, res) => {
    req.session.destroy((err) => {
        res.redirect('http://localhost/capsotone/login.php');
    });
});

app.listen(8000, () => {
    console.log('Listening on port 8000. Go to http://localhost:8000');
});