<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Screening;
use Illuminate\Http\Request;
use App\Models\Questionnaire;

class DashboardController extends Controller
{
    public function __construct() {

    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $questionnairesCount = Questionnaire::count();
        $screeningsCount = Screening::count();
        $rolesCount = Role::count();

        return view('dashboard', compact('questionnairesCount', 'screeningsCount', 'rolesCount'));
    }
}
