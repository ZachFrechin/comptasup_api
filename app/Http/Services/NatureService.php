<?php

namespace App\Http\Services;

use App\Models\NoteHistory;
use App\Http\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Nature;

class NatureService extends Service
{
    private UserService $userService;
    
    public function __construct()
    {
        $this->userService = new UserService();
    }

    private function userService() : UserService
    {
        return $this->userService;
    }

    public function create(string $name, string $numero, string $descriptor) : Nature
    {
        return Nature::create([
            'nom' => $name,
            'numero' => $numero,
            'descriptor' => $descriptor,
            'user_id' => $this->userService()->getByID(1)->id
        ]);
    }
}
