<?php
/*
DEUXIEME PHASE DU PROCESSUS:
l'utilisateur clique sur la nouvelle url ou la colle dans sa barre de recherce et appuie sur entrer:
Le bout de code qui suit permet la redirection vers l'url raccourcie ou personnalisée: 
*/
//Comme vue dans la première phase: l'adresse est composée de l'adresse de mon site internet suivi de /?url=(l'id de la nouvelle url)
//Ainsi avec $_GET['url'] on peur récupérer l'id de la nouvelle url
//on vérifie donc que nous somme bien dans la deuxième phase du processus:
if(isset($_GET['url'])){
    //Si oui: on récupère l'id de la nouvelle url
    $id  = $_GET['url'];
    //On se connecte ensuite à notre base de donnée:
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
    //A l'aide d'une requette sql on récupère l'url de base associé à l'id de la nouvelle url dans la table ratatineur
    $row = $bdd->query("SELECT longURL FROM ratatineur WHERE urlID = '$id'");
    //On récupère cette url de base:
    $url = $row->fetch_assoc()['longURL'];
    //Et on redirige finalement l'utilisateur vers l'url de base:
    header('Location: ' . $url);
}

/*
PREMIERE PHASE DU PROCESSUS:
l'utilisateur arrive sur la page de notre site internet pour la première fois:
le code html suivant permet de générer une page indiquant à l'utilisateur comment raccourcir ou personalliser son url au travers de 2 formulaires.
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
                <?php //formulaire pour raccourcir une url donnée ?>
                <form method="post" action="index.php">
                    <h5> Ratatinez ici votre URL </h5>
                    <input class= champs1 type="=text" name="longURL" placeholder="entrez ici l'URL à ratatiner"/><br>
                    <input class=entrer1 type="submit" name="ratatineur" value="ratatiner">
                </form>
            </div>
            <div class=div>
                <?php //formulaire pour personnaliser une url donnée ?>
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
    //connexion à la base de donnée
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
    
    //Lorsque l'utilisateur a complété l'un des 2 formulaires, on traite les informations qu'il a entré
    //Si l'utilisateur souhaite unquement raccourcir son url:
    if (isset($_POST['ratatineur']))
        {
            //On récupère son url à raccoursir
            $url=$_POST['longURL'];
            //On essaye de l'ouvrir avec @fopen($url,"r");
            $F=@fopen($url,"r");
            //Si l'utilisateur a cliqué sur ratatiner sans rentrer d'url, on lui envoie un mesage d'erreur:
            if (empty($url))
                {
                    echo "<h3>erreur: vous n'avez pas rentré d'url</h3>";
                }
            //Si l'utilisateur a entré une url invalide (@fopen($url,"r") a renvoyé false), on lui envoie un mesage d'erreur:
            elseif (!$F) 
                {
                    echo "<h3>erreur: url invalide</h3>";
                }
            else
                {
                    //Si aucune erreur n'a été detectée:
                    //On ferme l'url qui a été ouverte pour sa verification de validité.
                    fclose($F);
                    //Et on traite l'url à raccoursir:
                    //première étape: on vérifie à l'aide d'une requete SQL que cette url n'ait pas été déjà raccourcie en verrifiant qu'elle ne soit pas déjà dans notre base de donnée
                    $query = "SELECT * FROM ratatineur WHERE longURL='$url' ";
                    $result = $bdd->query($query);
                    //Si c'est le cas: on affiche l'url raccourcie correspondante:
                    if (($result->num_rows)>0)
                        {
                            $row = $result->fetch_assoc();
                            $shorturl=$row['shortURL'];
                            echo "<h3> vous avez déjà fait raccourcir ou personaliser cette url:</h3>";
                            echo "<a class=url href='${shorturl}' > ${shorturl} </a>";
                            $result->free();
                        }
                    //Sinon on passe à la deuxième étape:
                    else 
                    {
                        //On crée alléatoirement un identifiant pour l'url de l'utilisateur
                        $id=mt_rand();
                        //Tant que cette identifiant correspond déjà à une autre url (déja raccourci ou personalisé) de notre base de donnée on génère un identifiant différent
                        $query2 = "SELECT * FROM ratatineur WHERE urlID='$id' ";
                        $result2 = $bdd->query($query2);
                        while (($result2->num_rows)>0)
                            {
                                $id=mt_rand();
                                $result2 = $bdd->query($query2);
                            }
                        //troisième étape: on construit l'url raccourcie: composée de:
                            //l'url de mon site internet:https://ratatineurl.000webhostapp.com
                            //suivi de /?url=(l'id de la nouvelle url)
                        //=> Cela permettra la redirection vers notre site internet lorsque la nouvelle url sera mise dans la base de recherche=> On passera alors à la deuxième phase du processus
                        $shorturl= 'https://ratatineurl.000webhostapp.com/?url='.$id;
                        //quatrième étape: on l'enregistre dans notre base de donnée
                        $bdd->query('INSERT INTO ratatineur (longURL,shortURL,urlID) VALUES ("'.$url. '","'.$shorturl. '","'.$id. '")');
                        //dernière étape: on l'affiche à l'utilisateur
                        echo "<a class=url href='${shorturl}'> ${shorturl} </a>";
                        $result2->free();
        
                    }
                }
        }
    //Si l'utilisateur souhaite personalisé son url:
    if (isset($_POST['option']))
        {
            //On récupère son url à personaliser
            $url=$_POST['longURL'];
            //On récupère l'identifiant personalisé de l'url que l'utilisateur a entré.
            $urlperso=$_POST['idURLperso'];
            //Puis processus de verrification similaire à celui précisé dans le cas d'un raccourcissement simple d'url
            $F=@fopen($url,"r");
            if (empty($url) or empty($urlperso) )
                {
                    echo "<h3>erreur:au moins un des 2 champs est vide</h3>";
                }
            elseif (!$F) 
                {
                    echo "<h3>erreur: url invalide</h3>";
                }
            else
                {
                    fclose($F);
                    //Si aucune erreur n'est detectée, on traite l'url à raccoursir:
                    //première étape: on vérifie à l'aide d'une requete SQL que cette url n'ait pas été déja raccourcie en verrifiant qu'elle ne soit pas déjà dans notre base de donnée
                    $query = "SELECT * FROM ratatineur WHERE longURL='$url' ";
                    $result = $bdd->query($query);
                    //Si c'est le cas: on affiche l'url raccourcie correspondante
                    if (($result->num_rows)>0)
                        {
                            $row = $result->fetch_assoc();
                            $shorturl=$row['shortURL'];
                            echo "<h3> vous avez déjà fait raccourcir ou personaliser cette url:</h3>";
                            echo "<a class=url href='${shorturl}' > ${shorturl} </a>";
                            $result->free();
                        }
                    //Sinon on passe à la deuxième étape:
                    else 
                        {
                            //on construit l'url raccourcie de la meme manière que dans le cas d'un raccourcissement simple d'url mais cette fois-ci en utilisant l'id personnalisé de l'utilisateur
                            $shorturl= 'https://ratatineurl.000webhostapp.com/?url='.$urlperso;
                            //troisième étape: on l'enregistre dans notre base de donnée
                            $bdd->query('INSERT INTO ratatineur (longURL,shortURL,urlID) VALUES ("'.$url. '","'.$shorturl. '","'.$urlperso. '")');
                            //dernière étape: on l'affiche à l'utilisateur
                            echo "<a class=url href='${shorturl}'> ${shorturl} </a>";
                        }
                }                    
        }
    /* Fermeture de la connexion à notre base de donnée */
    $bdd->close();
    ?>
    </body>
</html>