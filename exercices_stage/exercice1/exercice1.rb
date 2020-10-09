#On crée ici une fonction verrifiant que l'entrée de l'utilisateur soit bien un entier naturel compris entre 1 et 2147483647
#argument de la fonction: str: une chaine de caractères de type string
#valeur retournée: bool: un booléen true ou false
def check_input(str) 
    bool=true
    #on parcourt la chaine str
    for i in 0...(str.length) do
        #si jamais l'un des caractères de la chaine convertie en entier est égal à 0 et est différent de 0 alors str n'est pas un entier
        if ((str[i]).to_i  )==0 and str[i]!='0' 
            bool=false
        end
    end
    #si jamais on un bien un entier mais supérieur strictement à 2147483647 ou inférieur strictement à 1 on devra retourner false
    if (bool) and ((str.to_i)>2147483647 or (str.to_i)<1)
        bool=false
    end
    #si la valeur de bool n'a pas été modifiée on a bien un entier naturel compris entre 1 et 2147483647
    #On renvoie true
    #sinon false
    return bool
end


#Début du programme:
#Demander à l'utilisateur d'entrer un entier compris entre 1 et 2147483647
puts "entrez un nombre entier entre 1 et 2147483647"
input = gets.chomp
#Tant que l'entrée (:input) de l'utilisateur ne respecte pas les contraintes on lui demande d'entrer son entier
while !(check_input(input))
    puts "seul un nombre entier entre 1 et 2147483647 est accepté  (attention à ne pas mettre d'espace)"
    input = gets.chomp
end
#Déclaration et initialisation de différentes variables nécessaires pour la suite du programme:

#n stockant la conversion en entier de l'entrée de l'utilisateur
n= input.to_i
#n_binaire stockant conversion de l'entier entrée(:n), en valeur binaire,  elle-même converti en chaine de caractères
n_binaire= (n.to_s(2)).to_s
taille_n_binaire=n_binaire.length
#On initialise à 0 l'écart binaire le plus grand(:ecart_binaire_max) que nous afficherons en fin de programme
ecart_binaire_max=0
#comme un entier peut avoir plusieurs écarts binaires différents on déclare la variable ecart_binaire_tmp qui prendra successivement la valeur de tous les écarts binaires 
ecart_binaire_tmp=0
i=0
#Parcours de n_binaire
while i<taille_n_binaire
    #lorsque nous tombons sur un 1:
    if n_binaire[i]=='1'
        i+=1
        #tant que les caractères suivant ce 1 sont des 0:
        while n_binaire[i]=='0'
            i+=1
            #on incrémente notre écart binaire(:ecart_binaire_tmp)
            ecart_binaire_tmp+=1
        end
        #lorsque nous sortons de cette boucle et que nous tombons sur 1 et non la fin de n_binaire:
        #De plus si la valeur de notre écart binaire(:ecart_binaire_tmp) est supérieur à la variable ecart_binaire_max: 
        if (i!=(taille_n_binaire)) and (ecart_binaire_tmp > ecart_binaire_max)
            #ecart_binaire_max prend la valeur de notre ecart_binaire_tmp qui lui, prend la valeur de 0
            ecart_binaire_max=ecart_binaire_tmp
            ecart_binaire_tmp=0
        #sinon ecart_bianire_tmp prend la valeur de 0
        else
            ecart_binaire_tmp=0
        end
        i-=1
    end
    i+=1
end
#Finalement on affiche la valeur binaire de l'entrée de l'utilisateur ainsi que son écart binaire le plus grand:
puts "la valeur binaire de #{n} est #{n_binaire}"
puts "l'écart binaire le plus grand de #{n} est #{ecart_binaire_max}"

