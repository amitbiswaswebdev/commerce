# commerce
Laravel package for e-commerce

# To register
composer config repositories.product '{"type": "path", "url": "./package/easy/product"}' --file composer.json
composer require

1. theme
2. customer
3. admin
4. category
5. product
6. inventory

# To publish Content (follow the sequence)
1. php artisan vendor:publish --tag=theme --force
2. php artisan vendor:publish --tag=customer --force
3. php artisan vendor:publish --tag=admin --force
4. php artisan vendor:publish --tag=category --force
5. php artisan vendor:publish --tag=product --force
6. php artisan vendor:publish --tag=inventory --force
