# exercisces_stage
Ce github contient le fichier exercices_stage regroupant les 2 exercices qui m'ont été demandé de réaliser

*exercice 1:*</br>
Pour la réalisation du programme de l'exercice 1, le code a été fait en ruby afin de me familiariser avec ce langage.</br>
La stratégie globale consiste à parcourir la valeur binaire de l'entier entré par un utilisateur pour déterminer l'ensemble des écarts binaires de cet entier.</br> 
Finalement seul le plus grand écart binaire est sauvegardé et affiché en fin de programme.</br></br>

*exercice 2:*</br>
Pour la réalisation du site internet de l'exercice 2, le code a été fait en html,php,sql et css.
Dans le fichier exercice2 sont regroupés un fichier .css et un fichier .php
le fichier .css gère le style de la page web générée par le fichier .php
Le processus global se résume en 2 phases ainsi qu'une base de donnée:
- la base de donnée permet de stocker les urls à raccourcir ou à personnaliser et les faire corespondre à des urls raccourcies ou personalisées:</br>
  *son fonctionement se base sur la table ratatineur constitué de 4 colonnes:</br>
    1.id(la clé primaire) de type entier</br>
    2.ongURL de type text permettant de stocker l'url à raccourcir</br>
    3.shortURL de type text permettant de stocker une url plus courte liée à l'url à raccourcir</br>
    4.urlID de type text permettant de lié l'url courte ou personnalisée stockée dans shortURL à l'url à raccourcir stockée dans longURL</br>
- la première phase consiste à indiquer à l'utilisateur comment raccourcir ou personaliser une url</br>
  *si l'utilisateur décide de raccourcir son url:</br>
    1.on génère aléatoirement un identifiant jamais généré au paravant pour créer la nouvelle url</br>
    2.on construit l'url raccourcie: composée de:</br>
          l'url de mon site internet:https://ratatineurl.000webhostapp.com</br>
          suivi de /?url=(l'identifiant de la nouvelle url)"</br>
          et enfin on stocke cette nouvelle url dans notre base de donnée en l'associant à l'url entrée par l'utilisateur
     Ainsi cela permettra la redirection vers notre site internet lorsque la nouvelle url sera mise dans la base de recherche et on passera alors à la deuxième phase du processus
   *si l'utilisateur décide de raccourcir son url:</br>
