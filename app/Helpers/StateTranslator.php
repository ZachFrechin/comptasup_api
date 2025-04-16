<?php

namespace App\Helpers;

use App\Models\Etat;

class StateTranslator
{
    private static $translations = [
        Etat::NOT_VALIDATED => 'En attente de valideur',
        Etat::NOT_CONTROLED => 'En attente de contrôleur',
        Etat::VALIDATED => 'Validée',
        Etat::REJECTED => 'Rejetée',
        Etat::CANCELED => 'Annulée',
        Etat::ARCHIVED => 'Archivée'
    ];

    public static function translate($state)
    {
        if (is_object($state) && isset($state->id)) {
            return self::$translations[$state->id] ?? $state->nom;
        }
        return self::$translations[$state] ?? $state;
    }
} 