<?php

function crawl_page($url, $depth = 5) {
    if($depth > 0) {
        $html = file_get_contents($url);

        preg_match_all('~<a.*?href="(.*?)".*?>~', $html, $matches);

        foreach($matches[1] as $newurl) {
            crawl_page($newurl, $depth - 1);
        }

        file_put_contents('results.txt', $newurl."\n\n".$html."\n\n", FILE_APPEND);
    

    preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches ); 
   $values=[];
    foreach($matches[1] as $matches) {
       
        if(in_array($matches, $values)){continue;}
        $image = imagecreatefrompng($matches);
        imagepng($image,"C:\Users\Charlie\Desktop\crawler-deposit\{$image}.png");
        $values[] = $matches;
        $image = imagecreatefromjpeg($matches);
        imagejpeg($image, "C:\Users\Charlie\Desktop\crawler-deposit\{$image}.jpg");

       
    }
    
}  
}

crawl_page('https://www.gateworld.net/news/2021/03/stargate-hd-1080p-bluray-picture-better-than-dvds/', 1);

?>