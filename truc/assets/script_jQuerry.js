$(document).ready(function(){

	//attribute
	$("#btna").click(function(){
		$("#attr").text(" ").append($("#eattr").attr("yolo"));
	});
	$("#btnra").click(function(){
		$("#eattr").removeAttr("yolo");
		$("#attr").text(" ").append("attribut remouve");
	});

	//add before and after or move element
	$("#btnaddb").click(function(){
		$("#addb").prepend("<div>text</div>");
	});
	$("#btnaddtob").click(function(){
		$("#addtob").prependTo("#addtobe");
	});
	$("#btnadda").click(function(){
		$("#adda").append("<div>text</div>");
	});
	$("#btnaddtoa").click(function(){
		$("#addtoa").appendTo("#addtoae");
	});

	//remove, empty and warp element
	$("#btnrme").click(function(){
		$("#rm").remove();
	});
	$("#btnempty").click(function(){
		$("#empty").empty();
	});
	$("#wrap").click(function(){
		$("dew").wrap("<div style='border: 2px solid blue'></div>");
	});
	$("#unwrap").click(function(){
		$("dew").unwrap();
	});
	//input on square
	$("#square1").click(function(){
		$(this).toggle(1000);
	});

	$("#square2").dblclick(function(){
		$(this).toggle(1000);
	});

	$("#square3").mouseenter(function(){
		$(this).toggle(1000);
	});

	$("#square4").mouseleave(function(){
		$(this).toggle(1000);
	});

	$("#square5").mouseover(function(){
		$(this).toggle(1000);
	});

	$(document).keyup(function(){
		$("#square6").toggle(1000);
	});

	$(document).keydown(function(){
		$("#square7").toggle(1000);
	});

	//select
	$("#next").click(function(){
		$(".sel").removeClass("sel").next().addClass("sel");
	})
	$("#nextAll").click(function(){
		$(".sel").removeClass("sel").nextAll().addClass("sel");
	})
	$("#prev").click(function(){
		$(".sel").removeClass("sel").prev().addClass("sel");
	})
	$("#prevAll").click(function(){
		$(".sel").removeClass("sel").prevAll().addClass("sel");
	})
	$("#first").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().first().addClass("sel");
	})
	$("#last").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().last().addClass("sel");
	})
	$("#parent").click(function(){
		$(".sel").removeClass("sel").parent().addClass("sel");
	})
	$("#children").click(function(){
		$(".sel").removeClass("sel").children().addClass("sel");
	})
	$("#filterred").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().filter(function( index ) {
    	return this.style["background-color"] == "red";
  	}).addClass("sel");
	})
	$("#filtergreen").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().filter(function( index ) {
    	return this.style["background-color"] == "green";
  	}).addClass("sel");
	})
	$("#filteryellow").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().filter(function( index ) {
    	return this.style["background-color"] == "yellow";
  	}).addClass("sel");
	})
	$("#notred").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().not(function( index ) {
    	return this.style["background-color"] == "red";
  	}).addClass("sel");
	})
	$("#notgreen").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().not(function( index ) {
    	return this.style["background-color"] == "green";
  	}).addClass("sel");
	})
	$("#notyellow").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().not(function( index ) {
    	return this.style["background-color"] == "yellow";
  	}).addClass("sel");
	})

	//mousemove
	$( "#moveelm" ).on( "mousemove", function(e) {
		$( "#posep" ).text( "Par rapport a la pages => pageX: " + e.pageX + ", pageY: " + e.pageY );
		$( "#posec" ).text( "Par rapport a la feunétre => clientX: " + e.clientX + ", clientY: " + e.clientY );
		$( "#poses" ).text( "Par rapport a l'écran => screenX: " + e.screenX + ", screenY: " + e.screenY );
		$( "#poseo" ).text( "Par rapport a l'élément => offsetX: " + e.offsetX + ", offsetY: " + e.offsetY );
		$( "#posel" ).text( "Par rapport a ? => layerX: " + e.layerX + ", layerY: " + e.layerY );
		$( "#pose" ).text( "Par rapport a ? => x: " + e.x + ", y: " + e.y );
		$( "#posem" ).text( "Par rapport a ? => movementX: " + e.movementX + ", movementY: " + e.movementY );
	});

	//keys
	function inputget(){
		window.addEventListener('keydown', function (e) {
			e.preventDefault();
      inputget.keys = (inputget.keys || []);
      inputget.keys[e.keyCode] = (e.type == "keydown");
			document.getElementById("keyresult").innerHTML = e.keyCode;
		});
    	window.addEventListener('keyup', function (e) {
      inputget.keys[e.keyCode] = (e.type == "keydown");
    });
    setInterval(input, 10)
	}
	function input(){
    	if (inputget.keys && inputget.keys[37]) {document.getElementById("keyresult1").innerHTML = "left"; }
    	if (inputget.keys && inputget.keys[39]) {document.getElementById("keyresult1").innerHTML = "right"; }
    	if (inputget.keys && inputget.keys[38]) {document.getElementById("keyresult1").innerHTML = "up"; }
    	if (inputget.keys && inputget.keys[40]) {document.getElementById("keyresult1").innerHTML = "down"; }
	}
	inputget()
});
