'script_jQuerry.js'
$(document).ready(function(){

	//hide/show block
	var b=0;
	$("#btnh").click(function(){
		if (b==0) {
			$("#block").hide();
			$("#btnh").html("show");
      b=1;
		}else {
      $("#block").show();
			$("#btnh").html("hide");
			b=0;
		}
	});

	//attribute
	$("#btna").click(function(){
		$("#attr").text(" ").append($("#eattr").attr("yolo"));
	});
	$("#btnra").click(function(){
		$("#eattr").removeAttr("yolo");
		$("#attr").text(" ").append("attribut remouve");
	});

	//comment
	var edit=true;
	$("#btnc").click(function(){
		if (edit) {
			$("#comment").attr("contentEditable", "false");
			$("#btnc").text("modifier");
			$("#comment").toggleClass("commentedit");
    	edit=false;
		}else {
			$("#comment").attr("contentEditable", "true");
			$("#btnc").text("valider");
			$("#comment").toggleClass("commentedit");
			edit=true;
		}
	});

	//add html tag
	$("#btnhtml").click(function(){
		$("inir").html("<TheText>tag add</TheText>");
	});

	//get value
	$("#btnval").click(function(){
		$("valrep").text(" : ").append($("#val").val());
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

	//internet
	setInterval(conet, 1000);
	function conet(){
		if(navigator.onLine==true){
			$("#internetstatue").text(" il y a internet");
		}else{
			$("#internetstatue").text(" il n'y a pas internet");
		}
	}

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
		$("#blocknav").children().filter(".blockr").addClass("sel");
	})
	$("#filtergreen").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().filter(".blockg").addClass("sel");
	})
	$("#filteryellow").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().filter(".blocky").addClass("sel");
	})
	$("#notred").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().not(".blockr").addClass("sel");
	})
	$("#notgreen").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().not(".blockg").addClass("sel");
	})
	$("#notyellow").click(function(){
		$(".sel").removeClass("sel");
		$("#blocknav").children().not(".blocky").addClass("sel");
	})

	//mousemove
	$( "#moveelm" ).on( "mousemove", function( event ) {
		$( "#posep" ).text( "pageX: " + event.pageX + ", pageY: " + event.pageY );
  	$( "#posec" ).text( "clientX: " + event.clientX + ", clientY: " + event.clientY );
		$( "#poses" ).text( "screenX: " + event.screenX + ", screenY: " + event.screenY );
	});

	//resize
	var x=0;
	window.addEventListener("resize", function(){
		document.getElementById("result").innerHTML = "resize : "+x;
		x++
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
