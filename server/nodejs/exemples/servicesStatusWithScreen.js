const app = require('express')();
const child_process = require('child_process');

app.get('/', function (req, res) {
    return res.json({ msg: 'page home' });
});

app.get('/api/services/:name', function (req, res) {
    let statusobj = {};
    child_process.exec('systemctl --no-page show ' + req.params.name, (error, stdout, stderr) => {
        if (error) {
            return res.status(500).json({ msg: 'error 500 :', error: error, debug: stderr });
        }
        let txt = stdout.split('\n');
        for (let i = 0; i < txt.length; i++) {
            kv = txt[i].split("=");
            if (kv.length == 2) {
                statusobj[kv[0]] = kv[1]
            }
        }

        if (statusobj.MainPID === '0') {
            let lbltxt = ['%CPU', 'RSS', 'VSZ', '%MEM'];
            let psobj = {};
            for (let j = 0; j < lbltxt.length; j++) {
                psobj[lbltxt[j]] = 0;
            }
            return res.status(200).json({ msg: 'ok :', psobj: psobj, status: statusobj });
        }

        child_process.exec('readlink -f /proc/' + statusobj.MainPID + '/exe', (error, stdout, stderr) => {
            if (error) {
                return res.status(500).json({ msg: 'error screen 500 :', error: error, debug: stderr });
            }
            let pidparam = '--pid '
            if (stdout.replace(/\n$/i, '') == '/usr/bin/screen') {
                pidparam = '--ppid '
            }

            child_process.exec('ps ' + pidparam + statusobj.MainPID + ' -o %cpu,rss,vsz,%mem', (error, stdout, stderr) => {
                if (error) {
                    return res.status(500).json({ msg: 'error ps 500 :', error: error, debug: stderr });
                }
                let txt = stdout.replace(/\n$/i, "").split('\n');
                let lbltxt = txt[0].replace(/\s+/g, "@").split('@');
                let datatxt = txt[1].replace(/^\s+/g, '').replace(/\s+/g, "@").split('@');
                let psobj = {};
                for (let i = 0; i < lbltxt.length; i++)  {
                    psobj[lbltxt[i]] = datatxt[i];
                }
                return res.status(200).json({ msg: 'ok ps :', psobj: psobj, status: statusobj });
            });
        });
    });
});

app.get('/api/services/start/:name', function (req, res) {
    child_process.exec('systemctl start ' + req.params.name, (error, stdout, stderr) => {
        if (error) return res.status(500).json({ msg: 'error 500 :', errror: error });
        return res.status(200).json({ msg: 'server start :', stdout: stdout });
    });
});

app.get('/api/services/stop/:name', function (req, res) {
    child_process.exec('systemctl stop ' + req.params.name, (error, stdout, stderr) => {
        if (error) return res.status(500).json({ msg: 'error 500 :', error: error });
        return res.status(200).json({ msg: 'server stop :', stdout: stdout });
    });
});

app.listen(80);
