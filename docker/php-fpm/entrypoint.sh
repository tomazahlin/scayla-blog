#!/bin/sh

# Build params based on Variables
composer build-params

php-fpm --allow-to-run-as-root