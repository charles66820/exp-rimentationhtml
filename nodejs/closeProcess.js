//disale program close
process.stdin.resume()
process.on('exit', ()=>console.log("oui"));

//catches ctrl+c event
process.on('SIGINT', ()=>process.exit());

//cathes kill pid
process.on('SIGUSR1', ()=>process.exit());
process.on('SIGUSR2', ()=>process.exit());

//cathes uncaughtException
process.on('uncaughtException', ()=>process.exit());
