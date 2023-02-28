<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\PermissionGroup;

class PermissionGroupController extends Controller
{
    public function store(ClientRequest $request) {
        $application = $request->application();
        $permGroup = PermissionGroup::firstOrCreate([
            'application_id' => $application->id,
            'name' => $request->get('name')
        ]);
        return $permGroup;
    }
}
