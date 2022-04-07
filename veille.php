<?php 
include('includes/header.php');



echo "<h1>Flux RSS Laravel</h1>";
$url = "https://laracasts.com/feed";
$rss = simplexml_load_file($url);
echo '<ul>';
foreach ($rss->entry as $item){
 $datetime = date_create($item->pubDate);
 $date = date_format($datetime, 'd M Y, H\hi');
 echo '<li><a href="'.$item->link.'">'.$item->title.'</a> ('.$date.')</li>';
}
echo '</ul>';


echo "<h1 style='padding:0px 20px;'>Google Alerts</h1>";
$url2 = "https://www.google.fr/alerts/feeds/04188850260744609975/2443302293342138815"; 
$rss = simplexml_load_file($url2);
echo '<ul>';

foreach ($rss->entry as $item){
 $datetime = date_create($item->pubDate);
 $date = date_format($datetime, 'd M Y, H\hi');
 echo '<li><a href="'.$item->link.'">'.$item->title.'</a> ('.$date.')</li>';
}
echo '</ul>';

include('includes/footer.php');
?>