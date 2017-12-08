$img = new Imagick('image.jpg');
$img = new Imagick('image1.jpg');

$img->setImageFormat("pdf");
$img->writeImage("file.pdf[0]");

$img1->setImageFormat("pdf");
$img1->writeImage("file.pdf[1]");
