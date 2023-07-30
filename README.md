# Teste_laravel_Source_dart
Teste laravel Source dart

# Note
after cloning project you need to execute commands
cd Teste_laravel_Source_dart
composer install 
# after instaling to run project 
php artisan serve

# CLI 
pour créer une catégorie depuis la ligne de commande => php artisan app:add-category << name (required) >> << parent_category (optional) >>

# example
php artisan app:add-category 'category1' || or || php artisan app:add-category 'category2' 'category1'

# CLI 
pour supprimer une catégorie depuis la ligne de commande => php artisan app:delete-category << nameOrid (required) >>

# example
php artisan app:delete-category 'category1' || or || php artisan app:add-category 1

# CLI 
pour créer une produit depuis la ligne de commande => php artisan app:add-product << name (required) >> << description (required) >> << price (required - decimal) >> << image (required) >>

# example
php artisan app:add-product 'product1' 'product description' 75 'image1.png'

# CLI 
pour supprimer une produit depuis la ligne de commande => php artisan app:delete-product << nameOrid (required) >>

# example
php artisan app:delete-category 'product1' || or || php artisan app:add-category 1

# Concepte de la application

Nous avons deux catégories de tables et produit la relation entre eux est plusieurs à plusieurs .
Dans cette application, nous pouvons contrôler toutes les informations des tables .

# La première page => product

La première page nous permet de voir tous les produits avec la possibilité d'ajouter le produit,
ainsi que de les trier par prix ou par nom, avec un moyen d'afficher les produits selon chaque catégorie.
Bien sûr, avec la possibilité de modifier et de supprimer chaque produit, ainsi que de visualiser les catégories qui lui sont associées,
ainsi que le contrôle des catégories associées au produit, telles que la suppression et l'ajout de catégories .

# La deuxième page => category

La deuxième page nous permet de voir toutes les catégories existantes avec la possibilité d'ajouter la catégorie.  
Bien sûr, avec la possibilité de modifier et de supprimer chaque catégorie, ainsi que de visualiser les produits qui y sont associés,
ainsi que de les contrôler, comme la numérisation et l'ajout de produits pour chaque catégorie déterminée.
