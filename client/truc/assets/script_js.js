//hide/show block
var b=0;
function hsbtn(){
	if (b==0) {
		document.getElementById("block").style.display = "none";
		document.getElementById("btnh").innerHTML = "show";
    b=1;
	}else {
    document.getElementById("block").style.display = "block";
		document.getElementById("btnh").innerHTML = "hide";
		b=0;
	}
}

//comment
var x=1;
function cbtn(){
	if (x==0) {
		document.getElementById("comment").contentEditable = "false";
		document.getElementById("btnc").innerHTML = "modifier";
		document.getElementById("comment").classList.remove("commentedit");
    x=1;
	}else {
    document.getElementById("comment").contentEditable = "true";
		document.getElementById("btnc").innerHTML = "valider";
		document.getElementById("comment").classList.add("commentedit");
		x=0;
	}
}

//internet connection
setInterval(conet, 1000);
function conet(){
	if(navigator.onLine){
		document.getElementById("internetstatue").innerHTML = "il y a internet";
	}else{
		document.getElementById("internetstatue").innerHTML = "il n'y a pas internet";
	}
}

//clock
var time;
setInterval(function(){
	time = new Date();
	document.getElementById("clock").innerHTML = time.toUTCString();
}, 1000);


//timer
var y = 0;
var sec;
var min;
var hs;
var hs0;
var min0;
var sec0;
var inter0;
function timerbtn(){
	if(y==0){
		document.getElementById("stopstart").innerHTML = "stop";
		inter0 = setInterval(function(){
			++sec
			if(sec==60){
				sec=0;
				++min;
			}else if(min==60){
				min=0;
				++hs;
			}
			hs0="";
			min0="";
			sec0="";
			if(hs<10){
				hs0="0"+hs;
			}else{
				hs0=hs;
			}
			if(min<10){
				min0="0"+min;
			}else{
				min0=min;
			}
			if(sec<10){
				sec0="0"+sec;
			}else{
				sec0=sec;
			}
			document.getElementById("timer").innerHTML = hs0+":"+min0+":"+sec0;
		}, 1000);
		sec=0;
		min=0;
		hs=0;
		y=1;
	}else{
		document.getElementById("stopstart").innerHTML = "start";
		window.clearInterval(inter0);//ne fonctionne pas
		y=0;
	}
}
//tempo
var j = 0;
function tempo(){
	if(j==0){
		document.getElementById("tcblock").innerHTML = "le décompte commense dans 5 seconde";
		document.getElementById("tempobtn").disabled = true;
		document.getElementById("tempobtn").innerHTML = "reset";
		setTimeout(tc,5000);
		function tc(){
			var inter1 = setInterval(tci,1000);
			var a=5;
			function tci(){
				if(a!=0){
					document.getElementById("tcblock").innerHTML = "plus que : "+a;
					--a;
				}else{
					document.getElementById("tcblock").innerHTML = "";
					document.getElementById("tcblock").className = "block";
					document.getElementById("tempobtn").disabled = false;
					clearInterval(inter1);
				}
			}
		}
		j=1;
	}else{
		document.getElementById("tempobtn").innerHTML = "start";
		document.getElementById("tcblock").className = "";
		document.getElementById("tcblock").innerHTML = "...";
		j=0;
	}
}

//cookie
var slang;
var expires;
function setCookie(cname, cvalue, exdays) {
    time = new Date();
    time.setTime(time.getTime() + (exdays * 24 * 60 * 60 * 1000));
    expires = "expires="+time.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(cname) == 0) {
    	return c.substring(name.length, c.length);
    }
  }
  return "";
}

function sellang(){
	setCookie("lang", document.getElementById("langselect").value, 1);
	document.getElementById("lang").innerHTML = getCookie("lang");
}
setCookie("lang", "en", 1);
document.getElementById("lang").innerHTML = getCookie("lang");

//log
function logb(){
var logb = document.getElementById('logb').value;
var loga = document.getElementById('loga').value;
var rx = Math.log(loga)/Math.log(logb);
document.getElementById('result').innerHTML = rx;
}

//decimal to fraction
function test(){
	var lol = document.getElementById('lolz').value;
	var value = lol;
	var best_numer = 1;
	var best_denom = 1;
	var best_err = Math.abs(value - best_numer / best_denom);
	for (var denom = 1; denom <= 10000; denom++) {
    	var numer = Math.round(value * denom);
    	var err = Math.abs(value - numer / denom);
    	if (err < best_err) {
        	best_numer = numer;
        	best_denom = denom;
        	best_err = err;
        	console.log(best_numer + " / " + best_denom + " = " + (best_numer/best_denom));
			document.getElementById("result1").innerHTML = "result:" + best_numer + " / " + best_denom + " = " + (best_numer/best_denom);
    	}
	}
}
