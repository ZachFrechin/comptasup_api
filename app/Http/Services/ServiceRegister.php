<?php

namespace App\Http\Services;

class ServiceRegister
{
    /**
     * Enregistre les services et génère les méthodes correspondantes dans la classe cible.
     *
     * @param object $classInstance Instance de la classe cible (ex: Controller)
     * @param array $services Tableau associatif [nom_méthode => ClasseService::class]
     * @return void
     */
    public static function registerServices(object $classInstance, array $services): void
    {
        if (!property_exists($classInstance, 'services')) {
            throw new \Exception("La classe cible doit contenir une propriété privée \$services.");
        }

        foreach ($services as $methodName => $serviceClass) {
            $classInstance->services[$methodName] = new $serviceClass();
        }
    }
}
