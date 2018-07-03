var https = require('https');
var fs = require('fs');


var options = {
  key: fs.readFileSync('/var/www/code/ssl/private.key', 'utf8'),
  cert: fs.readFileSync('/var/www/code/ssl/public.crt', 'utf8')
};

var test = {
    value: 0,
    name:"charles"
};

https.createServer(options, function (req, res) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write('<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" href="http://ppe2.ddns.net/assets/img/logoIcon.gif" type="image/gif"></head><form method="POST"><input type="text" name="test" value="truc"><input type="submit" value="Submit"></form> test : '+test.value+"<br/><pre>"+JSON.stringify(test)+"</pre><br/>");
    var POST = {};
    if (req.method == 'POST') {
        req.on('data', function(data) {
            data = data.toString();
            data = data.split('&');
            for (var i = 0; i < data.length; i++) {
                var onedata = data[i].split("=");
                POST[onedata[0]] = onedata[1];
            }
            console.log(data);
        })
    }
    test.value++;
}).listen(6080);
