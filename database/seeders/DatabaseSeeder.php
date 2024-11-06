<?php

    namespace Database\Seeders;

    use App\Models\Profil;
    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    use App\Models\Permission;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */

        public function createAdmin(int $nb) : User {
            $user = User::factory()->create([
                'email' => 'example' .$nb .'@example.com',
                'password' => Hash::make('password'),
            ]);

            Profil::create([
                'nom' => 'nomExample',
                'prenom' => 'prenomExample',
                'naissance' => '1980-01-01',
                'code_postal' => '73000',
                'ville' => 'Chambéry',
                'pays' => 'France',
                'rue' => 'rue Sommeiller',
                'numero_de_rue' => 1,
                'user_id' => $user->id,
            ]);


            
            return $user;
        }
        public function run(): void
        {
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
            
            $employee = Role::create(["nom" => "employee"]);
            $validator = Role::create(["nom" => "validator"]);
            $controller = Role::create(["nom" => "controller"]);
            $manager = Role::create(["nom" => "manager"]);
            $adminRole = Role::create(["nom" => "administrator"]);

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
                $user = $this->createAdmin($i);
                $user->roles()->attach($roleArray[$j++ % 4]);
            }
        }
    }
