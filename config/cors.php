<?php

return [

    'paths' => ['api/*'], // Applique le CORS aux routes de l'API

    'allowed_methods' => ['*'], // Permet tous les types de requêtes (GET, POST, etc.)

    'allowed_origins' => ['*'], // Permet les requêtes de toutes les origines (à restreindre en production)

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Permet tous les en-têtes

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
