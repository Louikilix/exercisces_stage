# Rapport concernant les exercices réalisées:
Ce github contient le fichier exercices_stage regroupant les 2 exercices qui m'ont été demandés de réaliser:

## exercice 1:</br>
Pour la réalisation du programme de l'exercice 1, le code a été fait en ruby afin de me familiariser avec ce langage.</br>
La stratégie globale consiste à parcourir la valeur binaire de l'entier entré par un utilisateur pour déterminer l'ensemble des écarts binaires de cet entier.</br> 
Finalement seul le plus grand écart binaire est sauvegardé et affiché en fin de programme.</br></br></br>

## exercice 2:</br>
Pour la réalisation du site internet de l'exercice 2, le code a été fait en html,php,sql et css.</br>
le site internet ainsi que la base de donnée liée à se dernier sont hébérgés par 000webhost.com </br>
lien vers le site internet: https://ratatineurl.000webhostapp.com </br>
Dans le fichier exercice2 sont regroupés un fichier .css et un fichier .php</br>
le fichier .css gère le style de la page web générée par le fichier .php</br>
Le processus global se résume en 2 phases et repose sur l'utilisation d'une base de donnée:
- la base de donnée permet de stocker les urls à raccourcir ou à personnaliser et les faire corespondre à des urls raccourcies ou personalisées à l'aide d'identifiants:</br>
  * son fonctionement se base sur la table ratatineur constitué de 4 colonnes:</br>
    1. id(la clé primaire) de type int</br>
    2. longURL de type text permettant de stocker l'url à raccourcir</br>
    3. shortURL de type text permettant de stocker une url plus courte ou personalisée liée à l'url à raccourcir</br>
    4. urlID de type text permettant de lier l'url courte ou personnalisée stockée dans shortURL à l'url à raccourcir stockée dans longURL</br></br>
- la première phase consiste à indiquer à l'utilisateur comment raccourcir ou personaliser une url</br>
  * si l'utilisateur décide de raccourcir son url:</br>
    1. on génère aléatoirement un identifiant jamais généré au paravant pour créer la nouvelle url</br>
    2. on construit l'url raccourcie: composée de:</br>
          - l'url de mon site internet:https://ratatineurl.000webhostapp.com</br>
          - suivi de /?url=(l'identifiant de la nouvelle url)"</br>
          - et enfin on stocke cette nouvelle url dans notre base de donnée en l'associant à l'url à raccourcir entrée par l'utilisateur.
            Ainsi cela permettra la redirection vers notre site internet lorsque la nouvelle url sera mise dans la barre de recherche et on passera alors à la deuxième phase du processus.
   * si l'utilisateur décide de personnalisé son url:</br> 
     On suit le même processus que pour raccourcir une url, mais cette fois-ci l'identifiant de la nouvelle url sera généré par l'utilisateur</br>
   * Précision: une url ne peut être raccourcie ou personalisée qu'une seul fois. Si l'on s'apperçoit qu'une url a déjà était raccourcie ou personnalisée on affiche à l'utilisateur son url raccourcie ou personalisée corespondante </br></br>
- la deuxième phase consiste à gérer la redirection de l'utilisateur vers une url qu'il a raccourcie ou personnaliser lorsque celui-ci a cliqué sur sa nouvelle url.</br>
   * Lorsque l'utilisateur clique sur la nouvelle url, il est redirigé vers notre site comme déjà expliqué précedemment.
   * Cependant ici, l'url de notre site finit par /?url=(identifiant de l'url vers laquelle il faut rediriger l'utilisateur).
   * Ainsi avec $_GET['url'] on peur récupérer l'identifiant de l'url vers laquelle il faut rediriger l'utilisateur.
   * Avec cette identifiant, on peut donc retrouver l'url correspondant à l'url raccourcie ou personalisée entrée par l'utilisateur et finalement rediriger ce dernier vers l'url de base. </br></br></br>
   
*Précision sur les codes rendus:*</br>
ils sont tous commentés pour aider à leur compréhension.
