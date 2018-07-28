const express = require('express')
const cookieParser = require('cookie-parser')
const fs = require('fs')
var app = express()

var User = require("./model/user.js");
var session = {
  users: []
}


app.use(cookieParser());
app.use(express.static('public'));

app.get('/', (req, res) => {
  var template = fs.readFileSync('views/home.html', 'utf8');
  res.writeHead(200, {'Content-Type': 'text/html'});
  template = template.replace(/\{\{\stitle\s\}\}/i, "loginSystem");

  let logcontent;
  var user = session.users.find(user => {return user.sessID == req.cookies.sessID});
  if (user) {
    logcontent = fs.readFileSync('views/usericon.html', 'utf8');
    console.log(user);
  } else {
    logcontent = fs.readFileSync('views/loginform.html', 'utf8');
  }
  template = template.replace(/\{\{\slog\s\}\}/i, logcontent);

  res.write(template);
  res.end()
})

app.post('/connexion', (req, res) => {
  let sessid = ((min, max) => {return Math.floor(Math.random()*(max-min)+min)})(99999999,10000000);
  res.cookie('sessID', sessid, { maxAge: 100000, httpOnly: true });
  var u = new User(sessid);
  u.psedo = "toto";
  session.users.push(u);

  res.redirect('/')
})



app.listen(6080, () => console.log('Login system launch!'))
