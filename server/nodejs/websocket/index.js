const express = require('express');
const fs = require('fs');
var app = express();
var io = require('socket.io')(require('http').Server(app).listen(6080));

app.get('/', function (req, res) {
  res.send(fs.readFileSync(__dirname + '/index.html', 'utf8'));
});

app.get('/chat', function (req, res) {
  res.send(__dirname);
  res.send("hello");
});

// namspace /
io.on('connection', function (socket) {
  socket.emit('news', { hello: 'world' });
  socket.on('my other event', function (data) {
    console.log('data of "/" namspace from client : ', data);
  });
});

// namspace /messager
var messager = io.of('/messager');
messager.on('connection', function(socket) {
  socket.emit('hi', { msg: 'you are connected, you can write a message' }); // send message to self connexion
  //messager.emit('hi', { msg: 'someone connected' }); //send message to all member connected on the namespace

  socket.on('onemessage', function(data) {
    messager.emit('hi', data);
  });
});
