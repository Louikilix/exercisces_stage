<?php
/*
DEUXIEME PHASE DU PROCESSUS:
l'utilisateur clique sur la nouvelle URL ou la colle dans sa barre de recherche et appuie sur entrer:
Le bout de code qui suit permet la redirection vers l'URL raccourcie ou personnalisée: 
*/
//Or l'adresse est composée de l'adresse de mon site internet suivi de /?url=(l'id de la nouvelle URL)
//Ainsi avec $_GET['url'] on peut récupérer l'id de la nouvelle URL
//on vérifie donc que nous somme bien dans la deuxième phase du processus:
if(isset($_GET['url'])){
    //Si oui: on récupère l'id de la nouvelle URL
    $id  = $_GET['url'];
    //On se connecte ensuite à notre base de données:
    $servername = "localhost";
    $username = "id15058141_louikilix";
    $password = "Shoutman//92";
    $database = "id15058141_ratatineur";
    try
        {
            $bdd =new mysqli($servername, $username, $password, $database);
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
            exit();
        }
    $bdd -> set_charset("utf8");
    //À l'aide d'une requête Sql on récupère l'URL de base associée à l'id de la nouvelle URL dans la table ratatineur
    $row = $bdd->query("SELECT longURL FROM ratatineur WHERE urlID = '$id'");
    //On récupère cette URL de base:
    $url = $row->fetch_assoc()['longURL'];
    //Et on redirige finalement l'utilisateur vers l'URL de base:
    header('Location: ' . $url);
}

/*
PREMIERE PHASE DU PROCESSUS:
l'utilisateur arrive sur la page de notre site internet pour la première fois:
le code HTML suivant permet de générer une page indiquant à l'utilisateur comment raccourcir ou personnaliser son URL au travers de 2 formulaires.
*/
?>
<html>
    <head>
        <title>
            Le ratatineurl de louis
        </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="index.css" />
    </head>
    <body>
        <h1> Ratatineur d'url </h1>
        <div class=mon_block >
            <div class=div>
                <?php //formulaire pour raccourcir une URL donnée ?>
                <form method="post" action="index.php">
                    <h5> Ratatinez ici votre URL </h5>
                    <input class= champs1 type="=text" name="longURL" placeholder="entrez ici l'URL à ratatiner"/><br>
                    <input class=entrer1 type="submit" name="ratatineur" value="ratatiner">
                </form>
            </div>
            <div class=div>
                <?php //formulaire pour personnaliser une URL donnée ?>
                <form method="post" action="index.php">
                    <h2> Option: personnaliser votre url </h2>
                    <input class= champs2 type="=text" name="longURL" placeholder="entrez ici l'URL à personnaliser"/><br>
                    <p>https://ratatineurl.000webhostapp.com/?url=suivi de:</p><input class= champs2 type="=text" name="idURLperso" placeholder="entrez ici votre URL personalisé"/><br>
                    <input class=entrer2 type="submit" name="option" value="personalliser">
                </form>
                <h4> Votre nouvelle URL apparaitra en rose ci-dessous sur ce magnifique fond bleu:</h4>
            </div>
        </div>
    <?php
    //connexion à la base de données
    $servername = "localhost";
    $username = "id15058141_louikilix";
    $password = "Shoutman//92";
    $database = "id15058141_ratatineur";
    try
        {
            $bdd =new mysqli($servername, $username, $password, $database);
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
            exit();
        }
    $bdd -> set_charset("utf8");
    
    //Lorsque l'utilisateur a complété l'un des 2 formulaires, on traite les informations qu'il a entrées
    //Si l'utilisateur souhaite unquement raccourcir son URL:
    if (isset($_POST['ratatineur']))
        {
            //On récupère son url à raccoursir
            $url=$_POST['longURL'];
            //On essaye de l'ouvrir avec @fopen($url,"r");
            $F=@fopen($url,"r");
            //Si l'utilisateur a cliqué sur ratatiner sans entrer d'URL, on lui envoie un medsage d'erreur:
            if (empty($url))
                {
                    echo "<h3>erreur: vous n'avez pas rentré d'url</h3>";
                }
            //Si l'utilisateur a entré une URL invalide (@fopen($url,"r") a renvoyé false), on lui envoie un message d'erreur:
            elseif (!$F) 
                {
                    echo "<h3>erreur: URL invalide ou non publique</h3>";
                }
            else
                {
                    //Si aucune erreur n'a été detectée:
                    //On ferme l'URL qui a été ouverte pour sa vérification de validité.
                    fclose($F);
                    //Et on traite l'url à raccoursir:
                    //première étape: on vérifie à l'aide d'une requête SQL que cette URL n'ait pas été déjà raccourcie en vérifiant qu'elle ne soit pas déjà dans notre base de données
                    $query = "SELECT * FROM ratatineur WHERE longURL='$url' ";
                    $result = $bdd->query($query);
                    //Si c'est le cas: on affiche l'url raccourcie correspondante:
                    if (($result->num_rows)>0)
                        {
                            $row = $result->fetch_assoc();
                            $shorturl=$row['shortURL'];
                            echo "<a class=url href='${shorturl}' > ${shorturl} </a>";
                            $result->free();
                        }
                    //Sinon on passe à la deuxième étape:
                    else 
                    {
                        //On crée aléatoirement un identifiant pour l'URL de l'utilisateur
                        $id=mt_rand();
                        //Tant que cet identifiant correspond déjà à une autre URL (déjà raccourci ou personnalisé) de notre base de données on génère un identifiant différent
                        $query2 = "SELECT * FROM ratatineur WHERE urlID='$id' ";
                        $result2 = $bdd->query($query2);
                        while (($result2->num_rows)>0)
                            {
                                $id=mt_rand();
                                $result2 = $bdd->query($query2);
                            }
                        //troisième étape: on construit l'URL raccourcie: composée de:
                            //l'URL de mon site internet:https://ratatineurl.000webhostapp.com
                            //suivie de /?url=(l'id de la nouvelle URL)
                        //=> Cela permettra la redirection vers notre site internet lorsque la nouvelle URL sera mise dans la barre de recherche=> On passera alors à la deuxième phase du processus
                        $shorturl= 'https://ratatineurl.000webhostapp.com/?url='.$id;
                        //quatrième étape: on l'enregistre dans notre base de données
                        $bdd->query('INSERT INTO ratatineur (longURL,shortURL,urlID) VALUES ("'.$url. '","'.$shorturl. '","'.$id. '")');
                        //dernière étape: on l'affiche à l'utilisateur
                        echo "<a class=url href='${shorturl}'> ${shorturl} </a>";
                        $result2->free();
        
                    }
                }
        }
    //Si l'utilisateur souhaite personnaliser son URL:
    if (isset($_POST['option']))
        {
            //On récupère son url à personaliser
            $url=$_POST['longURL'];
            //On récupère l'identifiant personnalisé de l'URL que l'utilisateur a entrée.
            $urlperso=$_POST['idURLperso'];
            //Puis processus de vérification similaire à celui précisé dans le cas d'un raccourcissement simple d'URL
            $F=@fopen($url,"r");
            if (empty($url) or empty($urlperso) )
                {
                    echo "<h3>erreur:au moins un des 2 champs est vide</h3>";
                }
            elseif (!$F) 
                {
                    echo "<h3>erreur: URL invalide ou non publique</h3>";
                }
            else
                {
                    fclose($F);
                    //Si aucune erreur n'est détectée, on traite l'URL à raccourcir:
                    //première étape: on vérifie à l'aide d'une requête SQL l'id personnalisé donnée par l'utilisateur n'est pas déjà utilisé: en vérifiant qu'il ne soit pas déjà dans notre base de données
                    $query = "SELECT * FROM ratatineur WHERE urlID='$urlperso' ";
                    $result = $bdd->query($query);
                    if (($result->num_rows)>0)
                        {
                            //Si c'est le cas: nous rendons unique l'id personnalisé de l'utilisateur: 
                            $nb_random=mt_rand();
                            $urlpersoUnique=$urlperso.$nb_random;
                            //Tant que cet identifiant correspond déjà à une autre URL (déjà personnalisé) de notre base de données on recommence:
                            $query2 = "SELECT * FROM ratatineur WHERE urlID='$urlpersoUnique' ";
                            $result2 = $bdd->query($query2);
                            while (($result2->num_rows)>0)
                                {
                                    $nb_random=mt_rand();
                                    $urlpersoUnique=$urlperso.$nb_random;
                                    $result2 = $bdd->query($query2);
                                }
                            //on passe à la deuxième étape:
                            //on construit l'URL raccourcie de la même manière que dans le cas d'un raccourcissement simple d'URL mais cette fois-ci en utilisant l'id personnalisé de l'utilisateur rendu unique
                            $shorturl= 'https://ratatineurl.000webhostapp.com/?url='.$urlpersoUnique;
                            //troisième étape: on l'enregistre dans notre base de données
                            $bdd->query('INSERT INTO ratatineur (longURL,shortURL,urlID) VALUES ("'.$url. '","'.$shorturl. '","'.$urlpersoUnique. '")');
                            //dernière étape: on l'affiche à l'utilisateur
                            echo "<a class=url href='${shorturl}' > ${shorturl} </a>";
                            $result2->free();
                        }
                    //Sinon on passe à la deuxième étape alternative:
                    else 
                        {
                            //on construit l'URL raccourcie de la même manière que dans le cas d'un raccourcissement simple d'URL mais cette fois-ci en utilisant l'id personnalisé de l'utilisateur
                            $shorturl= 'https://ratatineurl.000webhostapp.com/?url='.$urlperso;
                            //troisième étape alternative: on l'enregistre dans notre base de données
                            $bdd->query('INSERT INTO ratatineur (longURL,shortURL,urlID) VALUES ("'.$url. '","'.$shorturl. '","'.$urlperso. '")');
                            //dernière étape alternative: on l'affiche à l'utilisateur
                            echo "<a class=url href='${shorturl}'> ${shorturl} </a>";
                        }
                    $result->free();
                }                    
        }
    /* Fermeture de la connexion à notre base de données */
    $bdd->close();
    ?>
    </body>
</html>
