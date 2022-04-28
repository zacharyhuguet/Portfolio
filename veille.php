<?php 
include('includes/header.php');
?>

</br><h1>Thème ma veille : Docker</h1></br>
<h2>Mes outils de veille :</h2></br>
<h3 style='padding:0px 30px;'>- Flux RSS</h3>
  <h3 style='padding:0px 30px;'>- Alertes Google par mail (Google Alerts)</h3>
  

</br></br>

<?php

/*
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
*/

echo "<h1 style='padding:0px 20px;'>Flux RSS</h1>";
$url = "https://www.google.fr/alerts/feeds/04188850260744609975/2443302293342138815"; 
$rss = simplexml_load_file($url);
echo '<ul>';

foreach ($rss->entry as $item){
 $datetime = date_create($item->pubDate);
 $date = date_format($datetime, 'd M Y, H\hi');
 $url = $item->link; //TODO Utiliser une RegEx pour extraire l'URL
 echo '<li><a href="'.$url.'">'.$item->title.'</a> ('.$date.')</li>';
}
echo '</ul>';

echo "</br></br>";

echo "<h1 style='padding:0px 20px;'>Google Alerts</h1>";
echo '<p><a href="https://www.youtube.com/c/DockerIo/videos">Chaine YouTube </a> envoie de mail à chaque nouvelle vidéo</p>';




// echo "<h1 style='padding:0px 20px;'>Flux RSS</h1>";
// $url = "https://www.lemondeinformatique.fr/flux-rss/thematique/virtualisation/rss.xml
// "; 
// $rss = simplexml_load_file($url);
// echo '<ul>';

// foreach ($rss->item as $item){
//  $datetime = date_create($item->pubDate);
//  $date = date_format($datetime, 'd M Y, H\hi');
//  $url = $item->link; //TODO Utiliser une RegEx pour extraire l'URL
//  echo '<li><a href="'.$url.'">'.$item->title.'</a> ('.$date.')</li>';
// }
// echo '</ul>';



echo "</br></br>";
echo "<h1 style='text-align:center;'>FLUX RSS</h1>";
echo "<h1 style='padding:0px 20px;'>lemondeinformatique</h1>";
$url = "https://www.lemondeinformatique.fr/flux-rss/thematique/virtualisation/rss.xml"; 
$rss = simplexml_load_file($url);
echo '<ul>';
foreach ($rss->item as $item){
 $datetime = date_create($item->pubDate);
 $date = date_format($datetime, 'd M Y, H\hi');
 echo '<li><a href="'.$item->link.'">'.$item->title.'</a> ('.$date.')</li>';
}
echo '</ul>';


include('includes/footer.php');



?>