<?php 
include('includes/header.php');


echo "<h1>L'informaticien</h1>";
$url = "https://www.linformaticien.com/magazine/cybersecurite.html?format=feed&type=rss";
$rss = simplexml_load_file($url);
echo '<ul>';
foreach ($rss->channel->item as $item){
 $datetime = date_create($item->pubDate);
 $date = date_format($datetime, 'd M Y, H\hi');
 echo '<li><a href="'.$item->link.'">'.$item->title.'</a> ('.$date.')</li>';
}
echo '</ul>';




include('includes/footer.php');
?>