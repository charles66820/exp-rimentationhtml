const express = require('express')
const app = express()
const fs = require('fs')

app.use(express.static('public'))

app.get('/', (req, res) => {
  var template = fs.readFileSync('views/home.html', 'utf8');
  res.writeHead(200, {'Content-Type': 'text/html'});
  template = template.replace(/\{\{\stitle\s\}\}/i, "loginSystem");
  res.write(template);
  res.end()
})

app.post('/connexion', (req, res) => {
  res.cookie('test', ((min, max) => {return Math.floor(Math.random()*(max-min)+min)})(9999,1000), { maxAge: 9000, httpOnly: true })
  res.redirect('/')
})

app.listen(6080, () => console.log('Login system launch!'))
