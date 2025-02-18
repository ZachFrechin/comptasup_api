<?php

namespace App\Traits;

trait ServiceCallable
{
    // Stocke les instances des services
    private array $services = [];

    /**
     * Capture les appels de méthodes dynamiques pour retourner les services.
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($method, $arguments)
    {
        if (isset($this->services[$method])) {
            return $this->services[$method];
        }

        throw new \BadMethodCallException("Méthode {$method} non définie.");
    }

    /**
     * Enregistre les services dynamiquement.
     *
     * @param array $services Tableau des services ['nomMethode' => ServiceClass::class]
     * @return void
     */
    protected function registerServices(array $services): void
    {
        foreach ($services as $methodName => $serviceClass) {
            $this->services[$methodName] = new $serviceClass();
        }
    }
}
