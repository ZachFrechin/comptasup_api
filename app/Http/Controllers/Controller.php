<?php

namespace App\Http\Controllers;

use App\Http\Services\NoteService;
use App\Http\Services\NoteHistoryService;

abstract class Controller
{
    private NoteService $noteService;
    private NoteHistoryService $noteHistoryService;

    public function __construct()
    {
        $this->noteService = new NoteService();
        $this->noteHistoryService = new NoteHistoryService();
    }

    protected function noteService(): NoteService
    {
        return $this->noteService;
    }

    protected function noteHistoryService(): NoteHistoryService
    {
        return $this->noteHistoryService;
    }
}
