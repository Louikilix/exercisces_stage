# Rapport concernant les exercices réalisés:
Ce github contient le fichier exercices_stage regroupant les 2 exercices qui m'ont été demandés de réaliser:

## exercice 1:</br>
Pour la réalisation du programme de l'exercice 1, le code a été fait en ruby afin de me familiariser avec ce langage.</br>
La stratégie globale consiste à parcourir la valeur binaire de l'entier entré par un utilisateur pour déterminer l'ensemble des écarts binaires de cet entier.</br> 
Finalement seul le plus grand écart binaire est sauvegardé et affiché en fin de programme.</br></br></br>

## exercice 2:</br>
Pour la réalisation du site internet de l'exercice 2, le code a été fait en HTML, Php, Sql et Css.</br>
Le site internet ainsi que la base de données liée à ce dernier sont hébergés par 000webhost.com:  </br>
lien vers le site internet: https://ratatineurl.000webhostapp.com .</br>
Dans le fichier exercice2 sont regroupés un fichier .css et un fichier .php</br>
Le fichier .css gère le style de la page web générée par le fichier .php</br>
Le processus global se résume en 2 phases et repose sur l'utilisation d'une base de données:
- La base de données permet de stocker les urls à raccourcir ou à personnaliser et les faire correspondre à des urls raccourcies ou personnalisées à l'aide d'identifiants:</br>
  * Son fonctionnement se base sur la table ratatinée constituée de 4 colonnes:</br>
    1. id(la clé primaire) de type int</br>
    2. longURL de type text permettant de stocker l'url à raccourcir</br>
    3. shortURL de type text permettant de stocker une URL plus courte ou personalisée liée à l'URL à raccourcir</br>
    4. urlID de type text permettant de lier l'url courte ou personnalisée stockée dans shortURL à l'URL à raccourcir stockée dans longURL</br></br>
- La première phase consiste à indiquer à l'utilisateur comment raccourcir ou personnaliser une url</br>
  * Si l'utilisateur décide de raccourcir son url:</br>
    1. on génère aléatoirement un identifiant jamais généré auparavant pour créer la nouvelle URL</br>
    2. on construit l'URL raccourcie: composée de:</br>
          - l'URL de mon site internet:https://ratatineurl.000webhostapp.com</br>
          - suivi de /?url=(l'identifiant de la nouvelle URL)"</br>
          - et enfin on stocke cette nouvelle URL dans notre base de données en l'associant à l'URL à raccourcir entrée par l'utilisateur.
            Ainsi cela permettra la redirection vers notre site internet lorsque la nouvelle URL sera mise dans la barre de recherche et on passera alors à la deuxième phase du processus.
   * Si l'utilisateur décide de personnaliser son URL:</br> 
     on suit le même processus que pour raccourcir une URL, mais cette fois-ci l'identifiant de la nouvelle URL sera généré par l'utilisateur</br>
- La deuxième phase consiste à gérer la redirection de l'utilisateur vers une URL qu'il a raccourcie ou personnalisée lorsque celui-ci a cliqué sur sa nouvelle URL.</br>
   * Lorsque l'utilisateur clique sur la nouvelle URL, il est redirigé vers notre site comme déjà expliqué précédemment.
   * Cependant ici, l'URL de notre site fini par /?url=(identifiant de l'URL vers laquelle il faut rediriger l'utilisateur).
   * Ainsi avec $_GET['url'] on peut récupérer l'identifiant de l'URL vers laquelle il faut rediriger l'utilisateur.
   * Avec cet identifiant, on peut donc retrouver l'URL correspondant à l'URL raccourcie ou personnalisée entrée par l'utilisateur et finalement rediriger ce dernier vers l'URL de base.</br></br></br>
   
*Précision sur les codes rendus:*</br>
ils sont tous commentés pour aider à leur compréhension.
