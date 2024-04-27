<?php

use App\Models\Album;

function albums($id){
    $albums = Album::where('id','!=',$id)->get();
    return $albums;
}
if (!function_exists('successResponseMessage')) {
    function successResponseMessage($message = 'Success', $status = 200)
    {
        return response()->json([
            'statusType' => true,
            'status'     => $status,
            'message'    => $message,
        ], $status);
    }
}
if (!function_exists('errorResponseMessage')) {
    function errorResponseMessage($error, $status = 400)
    {
        return response()->json([
            'statusType' => false,
            'status'     => $status,
            'error'      => $error,
        ], $status);
    }
}function remove_invalid_charcaters($str)
    {
        return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
    }

if(!function_exists('user')){
    function user(){
        return auth()->guard('web')->user();
    }

}



function url_beautify ($title)
{
    $url = str_replace(' ', '-', $title);
    $url = str_replace('/', '-', $url);
    $url = str_replace('?', '', $url);
    $url = str_replace('#', '', $url);
    $url = str_replace('.', '-', $url);
    $url = str_replace('/', '', $url);
    $url = str_replace('\\', '', $url);
    $url = str_replace(',', '', $url);
    $url = str_replace('--', '-', $url);

    return $url;
}




if (!function_exists('video_iframe'))
{
    function video_iframe ($url)
    {
        $parse = parse_url($url);
        $domain = $parse['host'];
        if($domain == "www.youtube.com" || $domain == "youtube.com")
        {
            $step1 = explode('v=', $url);
            if(count($step1) > 1)
            {
                $step2 = explode('&',$step1[1]);
                $video_id = $step2[0];
                ?>
<iframe src="https://www.youtube.com/embed/<?php echo $video_id; ?>" width="640" height="360" frameborder="0"
    webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<?php
            }
            else
            {
                echo "<a href='".$url."' target='_blank' class='btn btn-success'>فيديو</a>";
            }
        }
        elseif($domain == "www.youtu.be" || $domain == "youtu.be")
        {
            $step1 = explode('youtu.be/', $url);
            if(count($step1) > 1)
            {
                $video_id = $step1[1];
                ?>
<iframe src="https://www.youtube.com/embed/<?php echo $video_id; ?>" width="640" height="360" frameborder="0"
    webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<?php
            }
            else
            {
                echo "<a href='".$url."' target='_blank' class='btn btn-success'>فيديو</a>";
            }
        }
        else if($domain == 'www.vimeo.com' || $domain == 'vimeo.com')
        {
            $video_id = explode('/', $url);
            ?>
<iframe src="https://player.vimeo.com/video/<?php echo $video_id[count($video_id) - 1]; ?>?" width="640" height="360"
    frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0" webkitallowfullscreen
    mozallowfullscreen allowfullscreen></iframe>
<script src="https://player.vimeo.com/api/player.js"></script>
<?php
        }
        else
        {
            echo "<a href='".$url."' target='_blank' class='btn btn-success'>فيديو</a>";
        }
    }
}






?>
