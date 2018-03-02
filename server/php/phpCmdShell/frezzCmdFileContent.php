<?php

$ctx = stream_context_create();
stream_context_set_params($ctx, array("notification" => "stream_notification_callback"));
$fileData = @file_get_contents('http://192.168.1.87/Human.Resource.Machine.zip',false,$ctx);

function stream_notification_callback($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max) {
    static $filesize = null;
    switch($notification_code) {
    case STREAM_NOTIFY_FILE_SIZE_IS:
        $filesize = $bytes_max;
        break;
    case STREAM_NOTIFY_CONNECT:
        echo "Connected...\n";
        sleep(10);
        break;
    case STREAM_NOTIFY_PROGRESS:
        if ($bytes_transferred > 0 && $filesize >= 8192) {
            $bytes_transferred += 8192;
            if (!isset($filesize)) {
                printf("\rUnknown filesize.. %2d kb done..", $bytes_transferred/1024);
            } else {
                $length = (int)(($bytes_transferred/$filesize)*100);
                printf("\r[%-100s] %d%% (%2d/%2d kb)", str_repeat("=", $length). ">", $length, ($bytes_transferred/1024), $filesize/1024);
            }
        }
        break;
    }
}
?>
