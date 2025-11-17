<?php 
include('includes/header.php');
?>

</br><h1>Thème ma veille : Docker</h1></br>

<a target="_blank" href="https://docs.google.com/document/d/1Ng-jlCDywS3j7dyeRjgiUSVIFL9V2DkKyjOsHLsWgSk/edit?usp=sharing">Mon tableau de veille</a>
</br></br>

<h2>Mes outils de veille :</h2></br>
<h3 style='padding:0px 30px;'>- Flux RSS</h3>
<h3 style='padding:0px 30px;'>- Vidéo Youtube</h3>
<h3 style='padding:0px 30px;'>- Article</h3>


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

echo "<h1 style='padding:0px 20px;'>Flux RSS Google</h1>";
$url = "https://www.google.fr/alerts/feeds/04188850260744609975/2443302293342138815"; 
$rss = simplexml_load_file($url);
echo '<ul>';

foreach ($rss->entry as $item){
 $datetime = date_create($item->pubDate);
 $date = date_format($datetime, 'd M Y, H\hi');
 $url = $item->link['href']; //TODO Utiliser une RegEx pour extraire l'URL

  echo '<li><a href="'.$url.'">'.$item->title.'</a> ('.$date.')</li>';
}
echo '</ul>';

echo "</br></br>";

echo "<h1 style='padding:0px 20px;'>Vidéos Youtube</h1>";
echo '<p><a href="https://www.youtube.com/c/DockerIo/videos">Chaine YouTube </a> envoie de mail à chaque nouvelle vidéo</p>';





echo "</br></br>";
echo "<h1 style='padding:0px 20px;'>FLUX RSS lemondeinformatique</h1>";
$url = "https://kubernetes.io/blog/rss.xml"; 
$rss = simplexml_load_file($url);
echo '<ul>';
foreach ($rss->item as $item){
 $datetime = date_create($item->pubDate);
 $date = date_format($datetime, 'd M Y, H\hi');
 echo '<li><a href="'.$item->link.'">'.$item->title.'</a> ('.$date.')</li>';
}
echo '</ul>';
echo "</br></br>";


echo "</br></br>";
echo "<h1 style='padding:0px 20px;'>FLUX RSS sreeninet</h1>";
$url = "https://sreeninet.wordpress.com/category/docker/feed/"; 
$rss = simplexml_load_file($url)->channel;
echo '<ul>';
foreach ($rss->item as $item){
 $datetime = date_create($item->pubDate);
 $date = date_format($datetime, 'd M Y, H\hi');
 echo '<li><a href="'.$item->link.'">'.$item->title.'</a> ('.$date.')</li>';
}
echo '</ul>';
echo "</br></br>";





echo "<h1 style='padding:0px 20px;'>Article</h1>";
echo '<p><a href="https://www.docker.com/blog/">Blog Docker, </a>Les derniers articles publier sur Docker</p>';
echo "</br></br>";


include('includes/footer.php');



?>