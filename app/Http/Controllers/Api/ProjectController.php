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

        // recupero i dati dal db e li impagino (default 10)
        // modificabile a piacimento
        $projects = Project::paginate(3); 

        // aggiungo il with per ottenere anche gli altri dati con le relazioni come nel db
        // ma dipende da come è settato il model
        // $projects = Project::with("user_id")->paginate(3);

        // restituisco i dati in formato json con la function dedicata
        return response()->json($projects);
        // testo api in postman aggiungendo /api/... dopo aver creato la rotta get in api.php
        // per la prima rotta sarà /api/projects
    }

    public function show($slug) {
        $project = Project::where("slug", $slug)->first();

        return response()->json($project);
    }
}
