<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {
    // voglio fare in modo di ricevere le richieste tramite api
    // e restituire i miei progetti alla pagina in formato json
    public function index() {
        // recupero i dati dal db
        $projects = Project::all();

        // restituisco i dati in formato json con la function dedicata
        return response()->json($projects);
        // testo api in postman aggiungendo /api/... dopo aver creato la rotta get in api.php
        // per la prima rotta sarà /api/projects
    }

}
