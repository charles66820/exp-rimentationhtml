var express = require('express');
const child_process = require('child_process');
var app = express();

app.listen('80');

app.get('/', function(req, res) {
    res.send("test");
});

app.get('/spawnls', function(req, res) {
  const ls = child_process.spawn('ls', ['-lh', '/usr']);

  ls.stdout.on('data', (data) => {
    res.send("test :" + data);
  });

  ls.stderr.on('data', (data) => {
    console.log(`stderr: ${data}`);
  });

  ls.on('close', (code) => {
    console.log(`child process exited with code ${code}`);
  });
});

app.get('/serverterrariastatus', function(req, res) {
    var statusobj = {};
    child_process.exec('systemctl --no-page show terraria', (error, stdout, stderr) => {
      if (error) {
        console.error(`exec error: ${error}`);
        return;
      }
      var txt = stdout.split('\n');
      for (var i = 0; i< txt.length; i++) {
        kv = txt[i].split("=");
        if (kv.length == 2) {
          statusobj[kv[0]] = kv[1]
        }
      }
      //console.log(`stderr: ${stderr}`);
      res.send(JSON.stringify(statusobj.ActiveState) + "</br>" + JSON.stringify(statusobj.SubState));
    });
});
