<?php
// A few settings
$image = 'uri.png';
// Read image path, convert to base64 encoding
$imageData = base64_encode(file_get_contents($image));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

// Echo out a sample image
echo '<img src="', $src, '">';
?>
