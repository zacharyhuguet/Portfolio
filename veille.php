<?php 
// Fonction pour charger les flux RSS avec cURL
function loadRSS($url) {
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $data = curl_exec($ch);
        curl_close($ch);
        
        if ($data) {
            libxml_use_internal_errors(true);
            $rss = simplexml_load_string($data);
            libxml_clear_errors();
            return $rss;
        }
    }
    return false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Veille Technologique - Zachary Huguet</title>
<link rel="stylesheet" href="css/index.css">

</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="competences.php">Compétences</a></li>
            <li><a href="projet.php">Projets</a></li>
            <li><a href="documentations.php">Documentations</a></li>
            <li><a href="veille.php">Veille</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>🔍 Thème de ma veille : Docker</h1>

        <div class="intro-box">
            <p style="font-size: 1.2rem; color: #555;">Suivez ma veille technologique sur Docker et les technologies de conteneurisation</p>
            <a target="_blank" href="https://docs.google.com/document/d/1Ng-jlCDywS3j7dyeRjgiUSVIFL9V2DkKyjOsHLsWgSk/edit?usp=sharing">📊 Voir mon tableau de veille</a>
        </div>

        <div class="tools-section">
            <h2>🛠️ Mes outils de veille</h2>
            <h3>📰 Flux RSS</h3>
            <h3>🎥 Vidéos Youtube</h3>
            <h3>📄 Articles</h3>
        </div>

        <!-- Flux RSS Docker Blog -->
        <div class="feed-section">
            <h1>📝 Flux RSS Docker Blog</h1>
            <p class="subtitle">Blog officiel Docker</p>
            <ul>
            <?php
            $url = "https://www.docker.com/blog/feed/";
            $rss = loadRSS($url);
            
            if ($rss !== false && isset($rss->channel)) {
                $count = 0;
                foreach ($rss->channel->item as $item) {
                    if ($count >= 10) break;
                    
                    $date = "Date non disponible";
                    if (isset($item->pubDate)) {
                        $datetime = date_create((string)$item->pubDate);
                        if ($datetime) {
                            $date = date_format($datetime, 'd M Y, H\hi');
                        }
                    }
                    
                    echo '<li>';
                    echo '<a href="'.(string)$item->link.'" target="_blank">'.htmlspecialchars($item->title).'</a>';
                    echo '<span class="feed-date">📅 '.$date.'</span>';
                    echo '</li>';
                    $count++;
                }
            } else {
                echo '<li class="error-message">⚠️ Impossible de charger le flux RSS Docker Blog actuellement.</li>';
            }
            ?>
            </ul>
        </div>


        <!-- Flux RSS Google Alerts -->
        <div class="feed-section">
            <h1>📡 Actualités Docker</h1>
            <p class="subtitle">Les dernières actualités Docker et conteneurisation</p>
            <p style="color: #666; padding: 1rem; background: rgba(99, 102, 241, 0.05); border-radius: 10px; margin-bottom: 1rem;">
                💡 <strong>Astuce :</strong> Pour configurer votre propre flux Google Alerts :
                <br/>1. Allez sur <a href="https://www.google.com/alerts" target="_blank" style="color: var(--primary);">Google Alerts</a>
                <br/>2. Créez une alerte pour "Docker" ou "conteneurisation"
                <br/>3. Choisissez "Flux RSS" comme type de diffusion
                <br/>4. Copiez l'URL du flux RSS et remplacez-la dans le code
            </p>
            <ul>
            <?php
            // Vous pouvez mettre à jour cette URL avec votre propre flux Google Alerts
            $url = "https://www.google.fr/alerts/feeds/04188850260744609975/2443302293342138815";
            $rss = loadRSS($url);
            
            if ($rss !== false) {
                $count = 0;
                foreach ($rss->entry as $item) {
                    if ($count >= 10) break;
                    
                    // Filtrer les articles pour ne garder que ceux en rapport avec Docker
                    $title = (string)$item->title;
                    $titleLower = strtolower($title);
                    
                    // Vérifier si le titre contient des mots-clés liés à Docker
                    if (strpos($titleLower, 'docker') !== false || 
                        strpos($titleLower, 'container') !== false || 
                        strpos($titleLower, 'conteneur') !== false ||
                        strpos($titleLower, 'kubernetes') !== false ||
                        strpos($titleLower, 'k8s') !== false) {
                        
                        $date = "Date non disponible";
                        if (isset($item->updated)) {
                            $datetime = date_create((string)$item->updated);
                            if ($datetime) {
                                $date = date_format($datetime, 'd M Y, H\hi');
                            }
                        } elseif (isset($item->published)) {
                            $datetime = date_create((string)$item->published);
                            if ($datetime) {
                                $date = date_format($datetime, 'd M Y, H\hi');
                            }
                        }
                        
                        $url_article = '';
                        if (isset($item->link['href'])) {
                            $url_article = (string)$item->link['href'];
                        } elseif (isset($item->link)) {
                            $url_article = (string)$item->link;
                        }
                        
                        echo '<li>';
                        echo '<a href="'.$url_article.'" target="_blank">'.htmlspecialchars($item->title).'</a>';
                        echo '<span class="feed-date">📅 '.$date.'</span>';
                        echo '</li>';
                        $count++;
                    }
                }
                
                // Si aucun article Docker n'a été trouvé
                if ($count == 0) {
                    echo '<li class="error-message">⚠️ Aucun article Docker trouvé récemment. Vérifiez la configuration de votre Google Alert.</li>';
                }
            } else {
                echo '<li class="error-message">⚠️ Impossible de charger le flux RSS actuellement. <a href="https://www.google.com/alerts" target="_blank" style="color: var(--primary);">Configurez votre Google Alert ici</a></li>';
            }
            ?>
            </ul>
        </div>

        <!-- YouTube -->
        <div class="feed-section">
            <h1>🎥 Vidéos YouTube</h1>
            <p class="subtitle">Chaîne officielle Docker - Notifications par email à chaque nouvelle vidéo</p>
            <a href="https://www.youtube.com/c/DockerIo/videos" target="_blank" class="youtube-link">📺 Visiter la chaîne YouTube Docker</a>
        </div>

        

        <!-- Articles -->
        <div class="feed-section">
            <h1>📄 Articles Docker</h1>
            <p class="subtitle">Blog officiel Docker - Ressources et actualités</p>
            <a href="https://www.docker.com/blog/" target="_blank" class="blog-link">📖 Visiter le blog Docker officiel</a>
        </div>
    </div>

<footer>
    <h3>📧 Contact</h3>
    <p>zacharyhuguet2222@gmail.com</p>
    <p>🌐 <a href="https://zacharyhuguet.alwaysdata.net/">zacharyhuguet.alwaysdata.net</a></p>
    <p style="margin-top: 2rem; opacity: 0.7;">© 2026 Zachary Huguet - Tous droits réservés</p>
    <p class="mentions-link"><a href="copyright.php">Mentions légales</a></p>
</footer>
</body>
</html>