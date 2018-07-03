var http = require('http');
const fs = require('fs');

var test = {
    value: 0,
    name:"charles"
};

//var template = fs.readFileSync('home.html');

http.createServer(function (req, res) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write('<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" href="http://ppe2.ddns.net/assets/img/logoIcon.gif" type="image/gif"></head><form method="POST"><input type="text" name="test" value="truc"><input type="submit" value="Submit"></form> test : '+test.value+"<br/><pre>"+JSON.stringify(test)+"</pre><br/>");
    //res.write(template);
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
    res.end();
    test.value++;
}).listen(6080);
