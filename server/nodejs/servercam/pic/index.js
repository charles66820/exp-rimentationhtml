var NodeWebcam = require( "node-webcam" );
var fs = require("fs");

/*var opts = {
    width: 1280,
    height: 720,
    quality: 100,
    delay: 0,
    saveShots: true,
    output: "jpeg",
    device: false,
    callbackReturn: "location",
    verbose: false
};

var Webcam = NodeWebcam.create( opts );
Webcam.capture( "test_picture", function( err, data ) {});*/

var opts1 = {
    width: 1280,
    height: 720,
    quality: 100,
    delay: 0,
    saveShots: false,
    output: "jpeg",
    device: false,
    verbose: false,
    callbackReturn: "base64"
};

NodeWebcam.capture( "test_picture", opts1, function( err, data ) {
    var imagehtml = "<img src='" + data + "'>";
    fs.writeFile("image.html", imagehtml, (err) => { if(err) throw err });

    console.log("html save :" + data);
});
