<?php

    namespace Database\Seeders;

    use App\Models\Profil;
    use App\Models\Role;
    use App\Models\User;
    use App\Models\Nature;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    use App\Models\Permission;
    use App\Models\Service;
    use App\Models\Etat;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */

        public function createAdmin(int $nb, array $payload) : User {
            $user = User::factory()->create([
                'email' => 'example' .$nb .'@example.com',
                'password' => Hash::make('password'),
            ]);

            Profil::create([
                'nom' => 'nomExample',
                'prenom' => 'prenomExample',
                'naissance' => '1980-01-01',
                'telephone' => '0612345678',
                'code_postal' => '73000',
                'ville' => 'Chambéry',
                'pays' => 'France',
                'rue' => 'rue Sommeiller',
                'numero_de_rue' => 1,
                'user_id' => $user->id,
                'service_id'=> $payload[$nb % 2]->id,
            ]);

            return $user;
        }
        public function run(): void
        {

            $serviceCompta = Service::create(["nom" => "Comptabilité", "description" => "Comptabilité", "numero" => "01"]);
            $serviceMangement = Service::create(["nom" => "Mangement", "description" => "Mangement", "numero" => "02"]);

            $payload = [$serviceCompta, $serviceMangement];

            $select_role = Permission::create(["nom" => "select_roles"]);
            $create_role = Permission::create(["nom" => "create_roles"]);
            $update_role = Permission::create(["nom" => "update_roles"]);
            $delete_role = Permission::create(["nom" => "delete_roles"]);
            $manage_role = Permission::create(["nom" => "manage_roles"]);
            $select_user = Permission::create(["nom" => "select_users"]);
            $create_user = Permission::create(["nom" => "create_users"]);
            $update_user = Permission::create(["nom" => "update_users"]);
            $delete_user = Permission::create(["nom" => "delete_users"]);
            $manage_user = Permission::create(["nom" => "manage_users"]);
            $administrator_permission = Permission::create(["nom" => "administrator"]);

            $employee = Role::create(["nom" => "Employé", "color" => "#FF6352"]);
            $validator = Role::create(["nom" => "Validateur", "color" => "#95E01C"]);
            $controller = Role::create(["nom" => "Contrôleur", "color" => "#FFD600"]);
            $manager = Role::create(["nom" => "Gestionnaire", "color"=> "#FF7DF2"]);
            $adminRole = Role::create(["nom" => "Administrateur", "color"=> "#39B8FF"]);

            // Attacher les permissions par ID
            $validator->permissions()->attach($select_user->id);
            $controller->permissions()->attach($select_user->id);
            $manager->permissions()->attach([$select_user->id, $select_role->id]);
            $adminRole->permissions()->attach($administrator_permission->id);

            $roleArray = [
                $validator,
                $controller,
                $manager,
                $adminRole
            ];

            $j = 0;
            for ($i = 0; $i < 10; $i++) {
                $user = $this->createAdmin($i, $payload);
                $user->roles()->attach($roleArray[$j++ % 4]->id);
                $user->roles()->attach($employee->id);
            }

            Nature::create([
                "nom" => "Carburant",
                "numero" => "1",
                "descriptor" => "{\n    \"prixAuLitre\": {\n        \"type\": \"number\",\n        \"title\": \"Prix au litre\",\n        \"required\": true,\n        \"min\": 0.5,\n        \"max\": 10\n    },\n    \"distance\": {\n        \"type\": \"number\",\n        \"title\": \"Distance\",\n        \"required\": true,\n        \"min\": 0,\n        \"max\": 100000\n    },\n    \"file\": {\n        \"type\":\"file\",\n        \"title\":\"Justificatif\",\n        \"size\":10,\n        \"ext\":[\"image/png\",\"image/jpeg\",\"application/pdf\"],\n        \"required\":true\n    }\n}"
            ]);

            Nature::create([
                "nom" => "Parking",
                "numero" => "2",
                "descriptor" => "{\n    \"dateDebut\": {\n        \"type\": \"date\",\n        \"title\": \"Date début stationnement\",\n        \"required\": true\n    },\n    \"dateFin\": {\n        \"type\": \"date\",\n        \"title\": \"Date fin stationnement\",\n        \"required\": true\n    },\n    \"file\": {\n        \"type\":\"file\",\n        \"title\":\"Justificatif\",\n        \"size\":10,\n        \"ext\":[\"image/png\",\"image/jpeg\",\"application/pdf\"],\n        \"required\":true\n    }\n}"
            ]);

            Nature::create([
                "nom" => "Péage",
                "numero" => "3",
                "descriptor" => "{\n    \"dateDebut\": {\n        \"type\": \"date\",\n        \"title\": \"Date début\",\n        \"required\": true\n    },\n    \"lieuDepart\": {\n        \"type\": \"text\",\n        \"title\": \"Lieu départ\",\n        \"size\": 50,\n        \"placeholder\": \"Ex: Annecy\",\n        \"required\": true\n    },\n    \"dateFin\": {\n        \"type\": \"date\",\n        \"title\": \"Date fin\",\n        \"required\": true\n    },\n    \"lieuArrivee\": {\n        \"type\": \"text\",\n        \"title\": \"Lieu arrivée\",\n        \"size\": 50,\n        \"placeholder\": \"Ex: Chambéry\",\n        \"required\": true\n    },\n    \"file\": {\n        \"type\":\"file\",\n        \"title\":\"Justificatif\",\n        \"size\":10,\n        \"ext\":[\"image/png\",\"image/jpeg\",\"application/pdf\"],\n        \"required\":true\n    }\n}"
            ]);

            Nature::create([
                "nom" => "Transport",
                "numero" => "4",
                "descriptor" => "{\n    \"dateDebut\": {\n        \"type\": \"date\",\n        \"title\": \"Date début\",\n        \"required\": true\n    },\n    \"lieuDepart\": {\n        \"type\": \"text\",\n        \"title\": \"Lieu départ\",\n        \"size\": 50,\n        \"placeholder\": \"Ex: Annecy\",\n        \"required\": true\n    },\n    \"dateFin\": {\n        \"type\": \"date\",\n        \"title\": \"Date fin\",\n        \"required\": true\n    },\n    \"lieuArrivee\": {\n        \"type\": \"text\",\n        \"title\": \"Lieu arrivée\",\n        \"size\": 50,\n        \"placeholder\": \"Ex: Chambéry\",\n        \"required\": true\n    },\n    \"file\": {\n        \"type\":\"file\",\n        \"title\":\"Ticket\",\n        \"size\":10,\n        \"ext\":[\"image/png\",\"image/jpeg\",\"application/pdf\"],\n        \"required\":true\n    }\n}"
            ]);

            Nature::create([
                "nom" => "Fourniture - Administratif",
                "numero" => "5",
                "descriptor" => "{\n    \"file\": {\n        \"type\":\"file\",\n        \"title\":\"Ticket\",\n        \"size\":10,\n        \"ext\":[\"image/png\",\"image/jpeg\",\"application/pdf\"],\n        \"required\":true\n    }\n}"
            ]);

            Nature::create([
                "nom" => "Entretien véhicule",
                "numero" => "6",
                "descriptor" => "{\n    \"file\": {\n        \"type\":\"file\",\n        \"title\":\"Ticket\",\n        \"size\":10,\n        \"ext\":[\"image/png\",\"image/jpeg\",\"application/pdf\"],\n        \"required\":true\n    }\n}"
            ]);

            Nature::create([
                "nom" => "Equipement stock",
                "numero" => "7",
                "descriptor" => "{\n    \"file\": {\n        \"type\":\"file\",\n        \"title\":\"Ticket\",\n        \"size\":10,\n        \"ext\":[\"image/png\",\"image/jpeg\",\"application/pdf\"],\n        \"required\":true\n    }\n}"
            ]);

            Nature::create([
                "nom" => "Autre",
                "numero" => "8",
                "descriptor" => "{\n    \"file\": {\n        \"type\":\"file\",\n        \"title\":\"Ticket\",\n        \"size\":10,\n        \"ext\":[\"image/png\",\"image/jpeg\",\"application/pdf\"],\n        \"required\":true\n    }\n}"
            ]);

            Etat::create(["nom" => "not validated"]);
            Etat::create(["nom" => "rejected"]);
            Etat::create(["nom" => "canceled"]);
            Etat::create(["nom" => "not_controled"]);
            Etat::create(["nom" => "validated"]);
            Etat::create(["nom" => "archived"]);
        }
    }
