<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Laravel\Passport\Token;

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

    public function index(Request $request) {
        $application = Client::where('id',$request->input('client_id'))->first()->application;
        $permGroup = PermissionGroup::where('application_id', $application->id)->first();
        return $permGroup;
    }

    public function update(Request $request) {
        $application = Client::where('id',$request->input('client_id'))->first()->application;
        $permGroups = $request->get('permission_groups');
        $permGroupUniqueNames = Collection::make($permGroups)->pluck('unique_name')->toArray();
        PermissionGroup::whereNotIn('unique_name', $permGroupUniqueNames)->where('application_id', $application->id)->delete();
        foreach ($permGroups as $permGroup) {
            $tmp = PermissionGroup::where('application_id', $application->id)->where('unique_name', $permGroup['unique_name'])->first();
            if(!$tmp) {
                PermissionGroup::create([
                    'application_id' => $application->id,
                    'name' => $permGroup['name'],
                    'description' => $permGroup['description'],
                    'unique_name' => $permGroup['unique_name']
                ]);
            } else {
                $tmp->name = $permGroup['name'];
                $tmp->description = $permGroup['description'];
                $tmp->save();
            }
        }
        return $permGroups;
    }
}
