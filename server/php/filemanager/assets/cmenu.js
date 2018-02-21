var tname = "";
var menu = "";
var pm = "";
$("#box").on ("contextmenu", function(m){
  m.preventDefault();
  if ($(m.target).hasClass("folder")){
    $(".cmenu").hide();
    menu = $("#cmenu_folder_a");
    menu.show();
    positionMenu(m, menu);
    tname = "";
  }else if ($(m.target).hasClass("chit_folder")){
    $(".cmenu").hide();
    menu = $("#cmenu_folder");
    menu.show();
    positionMenu(m, menu);
    tname = encodeURIComponent($(m.target).attr("name"));
  }else if ($(m.target).hasClass("file")||$(m.target).hasClass("box")){
    $(".cmenu").hide();
    menu = $("#cmenu_file_a");
    menu.show();
    positionMenu(m, menu);
    tname = "";
  }else if ($(m.target).hasClass("chit_file")){
    $(".cmenu").hide();
    menu = $("#cmenu_file");
    menu.show();
    positionMenu(m, menu);
    pm = m;
    tname = encodeURIComponent(m.target.getAttribute("name"));
  }else{
    $(".cmenu").hide();
  }
});
$("#rename").click(function(){
  $(".modal_r").show();
  $("#gre").show();
  $("#newname").val(decodeURI(tname));
  });
$("#newname").on("keydown",function(e) {
  if(e.keyCode == 13) {
    $.ajax({
      url: "assets/MSFF.php?rename&path="+path+tname+"&newname="+encodeURIComponent($("#newname").val()),
    }).done(function(result) {
      $(result).prependTo('#notif').delay(4000).queue(function() { $(this).remove(); });
    });
    $("#newname").val("");
    $(".modal_r").hide();
    $("#gre").hide();
    send(path);
  }
});
$("#create").click(function(){
  $(".modal_c").show();
  $("#gre").show();
});
$("#create_name").on("keydown",function(e) {
  if(e.keyCode == 13) {
    $.ajax({
      url: "assets/MSFF.php?create&path="+path+tname+"&create_name="+$("#create_name").val(),
    }).done(function(result) {
      $(result).prependTo('#notif').delay(4000).queue(function() { $(this).remove(); });
    });
    $("#create_name").val("");
    $(".modal_c").hide();
    $("#gre").hide();
    send(path);
  }
});
$("#delete").click(function(){
  $.ajax({
    url: "assets/MSFF.php?delete&path="+path+tname,
  }).done(function(result) {
    $(result).prependTo('#notif').delay(4000).queue(function() { $(this).remove(); });
  });
  send(path);
});
$("#rename_f").click(function(){
  $(".modal_r_f").show();
  $("#gre").show();
  $("#newname_f").val(decodeURI(tname));
  });
$("#newname_f").on("keydown",function(e) {
  if(e.keyCode == 13) {
    $.ajax({
      url: "assets/MSFF.php?rename&path="+path+tname+"&newname="+encodeURIComponent($("#newname_f").val()),
    }).done(function(result) {
      $(result).prependTo('#notif').delay(4000).queue(function() { $(this).remove(); });
    });
    $("#newname_f").val("");
    $(".modal_r_f").hide();
    $("#gre").hide();
    send(path);
  }
});
$("#create_f").click(function(){
  $(".modal_c_f").show();
  $("#gre").show();
});
$("#create_name_f").on("keydown",function(e) {
  if(e.keyCode == 13) {
    $.ajax({
      url: "assets/MSFF.php?create_f&path="+path+tname+"&create_name="+encodeURIComponent($("#create_name_f").val()),
    }).done(function(result) {
      $(result).prependTo('#notif').delay(4000).queue(function() { $(this).remove(); });
    });
    $("#create_name_f").val("");
    $(".modal_c_f").hide();
    $("#gre").hide();
    send(path);
  }
});
$("#delete_f").click(function(){
  $.ajax({
    url: "assets/MSFF.php?delete_f&path="+path+tname,
  }).done(function(result) {
    $(result).prependTo('#notif').delay(4000).queue(function() { $(this).remove(); });
  });
  send(path);
});
$("#property").click(function(){
  $("#property_box").load("assets/MSFF.php?property&path="+path+tname);
  send(path);
  menu = $("#property_box");
  positionMenu(pm, menu);
  menu.show();
});
$("#fileToUpload").on("change",function(event){
       var files = $("#fileToUpload")[0].files;
       var formData = new FormData();
       for (var i = 0; i < files.length; i++) {
           formData.append('file', files[i]);
           $.ajax({
               url: "assets/MSFF.php?upload&path="+path,
               method: "post",
               data: formData,
               contentType: false,
               processData: false,
               success: function () {
                 console.log('Upload Completed');
                 $("#fileToUpload").val("");
               },
               error: function (error) { console.log("Error Upload : "+error); }
           }).done(function(result) {
             $(result).prependTo('#notif').delay(4000).queue(function() { $(this).remove(); });
           });
       }
   });
   $("#download").click(function(){
     $("#dl").attr("src", "assets/MSFF.php?download&path="+path+tname+"&fpath="+tname);
   });
$(window).on('click', function(m) {
  $(".cmenu").hide();
  if (m.target.classList.contains("elm-menu")||m.target.classList.contains("property_box")||m.target.classList.contains("p_elm")){
  }else {
    $("#property_box").hide();
  }
});
 function positionMenu(m, menu) {
    var clickCoords = getPosition(m);
    if ( (window.innerWidth - clickCoords.x) < menu.offsetWidth + 4 ) {
       menu.css("left", window.innerWidth - menu.offsetWidth + 4 + "px");
    } else {
       menu.css("left", clickCoords.x + "px");
    }
    if ( (window.innerHeight - clickCoords.y) < menu.offsetHeight + 4 ) {
       menu.css("top", window.innerHeight - menu.offsetHeight + 4 + "px");
    } else {
       menu.css("top", clickCoords.y + "px");
    }
  }
  function getPosition(e) {
     var posx = 0;
     var posy = 0;
     if (!e) var e = window.event;
     if (e.pageX || e.pageY) {
       posx = e.pageX;
       posy = e.pageY;
     } else if (e.clientX || e.clientY) {
       posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
       posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
     }
     return {
         x: posx,
         y: posy
     }
  }
