#!/bin/bash

# Limpa tudo que pode estar em cache
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Opcional: Otimiza para produção de novo
php artisan optimize

# Sobe o servidor
php artisan serve --host=0.0.0.0 --port=8000
