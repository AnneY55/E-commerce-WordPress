


# Site Les sensations gourmandes

Le site est une boutique e-commerce pour vendre des cupcakes.
J'ai installé Local Fly Wheel pour pouvoir gérer et générer  le Word Press de mon site.
J'ai utilisé un template que j'ai ensuite adapté à mon site (couleurs, menus, pages, produits, etc.).

----------------------------------------------------------------------------

## Les extensions utilisées (plugins installés)

**WooCommerce** : pour site e-commerce
**Elementor** : pour site responsive
**Yoast SEO** : pour référencement SEO
**WP Globus** : pour accès multilingue
**GPDR Cookie Consent** : pour RGPD.

---------------------------------------

## Sidebar

La barre de navigation comporte :
***Accueil** : donne accès à la page d'accueil avec un historique des cupcakes
***Blog** : donne accès à la page blog avec recettes cupcakes
***Contact** : donne accès à un formulaire de contact pour les clients avec la boutique. En anglais mais possibilité de le traduire en français en faisant un click droit
***Icône shop** : donne accès à la boutique et aux produits
***Icône cart** : donne accès au panier client
***Icône my account** : compte client donne accès à sa page et à ses informations adresses, commandes, favoris, etc. En anglais mais possibilité traduction en français avec click droit.
****Autres icônes** : accès général facebook, twitter, youtube 

-----

### Shop

La boutique présente tous les produits accessibles. En cliquant sur chaque produit, on accède à la fiche produit avec un descriptif, images (prises sur Pixabay toutes libres de droit). Possibilité de l'ajouter à son panier avec Add to cart et possibilité de l'ajouter à ses Favoris avec Add to WishList et la catégorie est indiquée (2 catégories créés : *Cupcake Chocolat ou Cupcake Crème.*)

--------

### Cart
* Jeux de test :
Le panier client comporte tous les produits sélectionnés par le client et l'accès en cliquant sur checkout au détail de sa facture et de sa commande. Le paiement est fictif et ne fonctionne pas car je n'ai pas rentré de process de paiement puisque site fictif.

----


## Footer

Le footer comporte :

* **Titre du site** en indiquant que les droits sont réservés
* **Conditions utilisation** : donne accès au document pdf avec les conditions générales d'utilisation (CGU) du site. Je les ai créés grâce à site LegalPlace. 
	Exemple : article 3, j'ai précisé que le site ne collectait aucune 	donnée. Article 7 :  Cookies, en naviguant sur le site, l'utilisateur accepte les cookies et il peut les désactiver par l'intermédiaire de paramètres figurant au sein de son logiciel de navigation.
* **Word Press** : en cliquant amène vers page qui dirige vers les modèles de Word Press.

-------------------

## Base de données My SQL

Elle s'est générée automatiquement et j'y ai accès avec Local Fly Wheel en cliquant sur DataBase et Open Adminer
Par exemple pour compte utilisateur client et administrateur : cliquer à gauche sur select wp_users, donne accès à la table wp_users et ensuite afficher les données, le tableau s'affiche avec 1 administrateur et 1 client. Dans wp_wc_customers_lookup, 1 client est créé. Pour ajouter cliquer sur nouvel élément.
Autre exemple, pour les produits cliquer à gauche sur select wp_wc_product_meta_look up, donne accès à table des produits puis afficher les données, le tableau s'affiche avec tous les produits et si besoin d'ajouter cliquer sur nouvel élément.

Bonne navigation sans modération !



