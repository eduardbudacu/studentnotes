<?php

namespace App\Http\Controllers;


class NotesController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAll() {
        return [
            ['title' => 'A note', 'body' => '#markdown', 'date' => '2021-08-10']
        ];
    }
}