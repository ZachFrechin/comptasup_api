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
    use App\Models\Note;
    use App\Models\Depense;

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
            $serviceMangement = Service::create(["nom" => "Management", "description" => "Mangement", "numero" => "02"]);

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

            $validator->permissions()->attach($select_user->id);
            $controller->permissions()->attach($select_user->id);
            $manager->permissions()->attach([$select_user->id, $select_role->id]);
            $adminRole->permissions()->attach($administrator_permission->id);

//            $roleArray = [
//                $validator,
//                $controller,
//                $manager,
//                $adminRole
//            ];
//
//
//
//            $j = 0;
//            for ($i = 0; $i < 10; $i++) {
//                $user = $this->createAdmin($i, $payload);
//                $user->roles()->attach($roleArray[$j++ % 4]->id);
//                $user->roles()->attach($employee->id);
//            }

            $this->call([
                UserSeeder::class,
            ]);

            Nature::create([
                "nom" => "Carburant",
                "numero" => "1",
                "descriptor" => json_encode([
                    "prixAuLitre" => [
                        "type" => "number",
                        "position" => 0,
                        "title" => "Prix au litre",
                        "required" => true,
                        "min" => 0.5,
                        "max" => 10
                    ],
                    "quantite" => [
                        "type" => "number",
                        "position" => 1,
                        "title" => "Quantité",
                    ],
                    "distance" => [
                        "type" => "number",
                        "position" => 1,
                        "title" => "Distance",
                        "required" => true,
                        "min" => 0,
                        "max" => 100000
                    ],
                    "file" => [
                        "type" => "file",
                        "position" => 2,
                        "title" => "Justificatif",
                        "size" => 10,
                        "ext" => ["image/png", "image/jpeg", "application/pdf"],
                        "required" => true
                    ]
                ])
            ]);

            Nature::create([
                "nom" => "Parking",
                "numero" => "2",
                "descriptor" =>  json_encode([
                    "dateDebut" => [
                        "type" => "date",
                        "position" => 0,
                        "title" => "Date début stationnement",
                        "required" => true
                    ],
                    "dateFin" => [
                        "type" => "date",
                        "position" => 1,
                        "title" => "Date fin stationnement",
                        "required" => true
                    ],
                    "file" => [
                        "type" => "file",
                        "position" => 2,
                        "title" => "Justificatif",
                        "size" => 10,
                        "ext" => ["image/png", "image/jpeg", "application/pdf"],
                        "required" => true
                    ]
                ])
            ]);

            Nature::create([
                "nom" => "Péage",
                "numero" => "3",
                "descriptor" => json_encode([
                    "dateDebut" => [
                        "type" => "date",
                        "position" => 0,
                        "title" => "Date début",
                        "required" => true
                    ],
                    "lieuDepart" => [
                        "type" => "text",
                        "position" => 1,
                        "title" => "Lieu départ",
                        "size" => 50,
                        "placeholder" => "Ex: Annecy",
                        "required" => true
                    ],
                    "dateFin" => [
                        "type" => "date",
                        "position" => 2,
                        "title" => "Date fin",
                        "required" => true
                    ],
                    "lieuArrivee" => [
                        "type" => "text",
                        "position" => 3,
                        "title" => "Lieu arrivée",
                        "size" => 50,
                        "placeholder" => "Ex: Chambéry",
                        "required" => true
                    ],
                    "file" => [
                        "type" => "file",
                        "position" => 4,
                        "title" => "Justificatif",
                        "size" => 10,
                        "ext" => ["image/png", "image/jpeg", "application/pdf"],
                        "required" => true
                    ]
                ])
            ]);

            Nature::create([
                "nom" => "Transport",
                "numero" => "4",
                "descriptor" => json_encode([
                    "dateDebut" => [
                        "type" => "date",
                        "position" => 0,
                        "title" => "Date début",
                        "required" => true
                    ],
                    "lieuDepart" => [
                        "type" => "text",
                        "position" => 1,
                        "title" => "Lieu départ",
                        "size" => 50,
                        "placeholder" => "Ex: Annecy",
                        "required" => true
                    ],
                    "dateFin" => [
                        "type" => "date",
                        "position" => 2,
                        "title" => "Date fin",
                        "required" => true
                    ],
                    "lieuArrivee" => [
                        "type" => "text",
                        "position" => 3,
                        "title" => "Lieu arrivée",
                        "size" => 50,
                        "placeholder" => "Ex: Chambéry",
                        "required" => true
                    ],
                    "file" => [
                        "type" => "file",
                        "position" => 4,
                        "title" => "Ticket",
                        "size" => 10,
                        "ext" => ["image/png", "image/jpeg", "application/pdf"],
                        "required" => true
                    ]
                ])
            ]);

            Nature::create([
                "nom" => "Fourniture - Administratif",
                "numero" => "5",
                "descriptor" => json_encode([
                    "file" => [
                        "type" => "file",
                        "position" => 0,
                        "title" => "Ticket",
                        "size" => 10,
                        "ext" => ["image/png", "image/jpeg", "application/pdf"],
                        "required" => true
                    ]
                ])
            ]);

            Nature::create([
                "nom" => "Repas salarié",
                "numero" => "6",
                "descriptor" => json_encode([
                    "accompagnement" => [
                        "type" => "dropdown",
                        "position" => 0,
                        "title" => "Accompagnement",
                        "options" => [
                            [
                                "key" => "seul",
                                "value" => "Seul",
                            ],
                            [
                                "key" => "accompagne",
                                "value" => "Accompagné",
                            ]
                        ],
                        "required" => true
                    ],
                    "collaborateurs" => [
                        "type" => "collaborateur",
                        "title" => "Accompagnant(s)",
                        "position" => 2,
                        "need" => [
                            "key" => "accompagnement",
                            "value" => "accompagne",
                        ]
                    ]
                ])
            ]);

            Nature::create([
                "nom" => "Repas invité",
                "numero" => "6",
                "descriptor" => json_encode([
                    "collaborateurs_present" => [
                        "type" => "dropdown",
                        "position" => 0,
                        "title" => "Collaborateur(s) invité(s)",
                        "options" => [
                            [
                                "key" => "oui",
                                "value" => "Oui",
                            ],
                            [
                                "key" => "non",
                                "value" => "Non",
                            ]
                        ],
                        "required" => true
                    ],
                    "collaborateurs" => [
                        "type" => "collaborateur",
                        "title" => "Accompagnant(s)",
                        "position" => 1,
                        "need" => [
                            "key" => "collaborateurs_present",
                            "value" => "oui",
                        ]
                    ],
                    "invites" => [
                        "type" => "invite-informations",
                        "title" => "Invité(s) externe(s)",
                        "position" => 2,
                    ],
                    "motif" => [
                        "type" => "text",
                        "position" => 3,
                        "title" => "Motif du repas",
                        "placeholder" => "",
                        "size" => 80,
                        "required" => true
                    ],
                    "file" => [
                        "type" => "file",
                        "position" => 4,
                        "title" => "Justificatif",
                        "size" => 10,
                        "ext" => ["image/png", "image/jpeg", "application/pdf"],
                        "required" => true
                    ]
                ])
            ]);

            Nature::create([
                "nom" => "Entretien véhicule",
                "numero" => "6",
                "descriptor" => json_encode([
                    "file" => [
                        "type" => "file",
                        "position" => 0,
                        "title" => "Ticket",
                        "size" => 10,
                        "ext" => ["image/png", "image/jpeg", "application/pdf"],
                        "required" => true
                    ]
                ])
            ]);

            Nature::create([
                "nom" => "Equipement stock",
                "numero" => "7",
                "descriptor" => json_encode([
                    "file" => [
                        "type" => "file",
                        "position" => 0,
                        "title" => "Ticket",
                        "size" => 10,
                        "ext" => ["image/png", "image/jpeg", "application/pdf"],
                        "required" => true
                    ]
                ])
            ]);

            Nature::create([
                "nom" => "Autre",
                "numero" => "8",
                "descriptor" => json_encode([
                    "file" => [
                        "type" => "file",
                        "position" => 0,
                        "title" => "Ticket",
                        "size" => 10,
                        "ext" => ["image/png", "image/jpeg", "application/pdf"],
                        "required" => true
                    ]
                ])
            ]);



            Etat::create(["nom" => "not validated"]);
            Etat::create(["nom" => "rejected"]);
            Etat::create(["nom" => "canceled"]);
            Etat::create(["nom" => "not_controled"]);
            Etat::create(["nom" => "validated"]);
            Etat::create(["nom" => "archived"]);

//            Note::create([
//                "commentaire" => "",
//                "user_id" => 1,
//                "etat_id" => 1,
//                "validateur_id" => 1
//            ]);
//            Depense::create([
//                "nom" => "exemple",
//                "note_id" => 1,
//                "totalTTC" => 360,
//                "date" => "2025/01/01",
//                "tiers" => "riotGame",
//                "nature_id" => 1,
//                "details" => json_encode([
//                        "prixAuLitre" => 2,
//                        "quantite" => 180,
//                        "distance" => 2,
//                        "file" => "zeubi.png"
//                ])
//            ]);
//            Depense::create([
//                "nom" => "exemple",
//                "note_id" => 1,
//                "totalTTC" => 360,
//                "date" => "2025/01/01",
//                "tiers" => "riotGame",
//                "nature_id" => 1,
//                "details" => json_encode([
//                        "prixAuLitre" => 2,
//                        "quantite" => 180,
//                        "distance" => 2,
//                        "file" => "zeubi.png"
//                ])
//            ]);
        }
    }
