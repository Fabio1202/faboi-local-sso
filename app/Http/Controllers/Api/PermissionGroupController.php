<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest as Request;
use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class PermissionGroupController extends Controller
{
    public function store(Request $request): PermissionGroup
    {
        $application = $request->application();

        return PermissionGroup::firstOrCreate([
            'application_id' => $application->id,
            'name' => $request->get('name'),
        ]);
    }

    public function index(Request $request): Collection
    {
        $application = $request->application();

        return $application->permissionGroups;
    }

    /**
     * @return array<PermissionGroup>
     */
    public function update(Request $request): array
    {
        $application = $request->application();
        $permGroups = request()->input('permission_groups');
        $permGroupUniqueNames = Collection::make($permGroups)->pluck('unique_name')->toArray();
        $result = [];
        PermissionGroup::whereNotIn('unique_name', $permGroupUniqueNames)->where('application_id', $application->id)->delete();
        foreach ($permGroups as $permGroup) {
            $tmp = PermissionGroup::where('application_id', $application->id)->where('unique_name', $permGroup['unique_name'])->first();
            if (! $tmp) {
                $tmp = PermissionGroup::create([
                    'application_id' => $application->id,
                    'name' => $permGroup['name'],
                    'description' => $permGroup['description'],
                    'unique_name' => $permGroup['unique_name'],
                ]);
            } else {
                $tmp->name = $permGroup['name'];
                $tmp->description = $permGroup['description'];
                $tmp->save();
            }
            $result[] = $tmp;
        }

        return $result;
    }

    public function updatePermissions(Request $request, string $permgrp): Collection|JsonResponse
    {
        $application = $request->application();
        $permissionGroup = PermissionGroup::where('application_id', $application->id)->where('unique_name', $permgrp)->first();
        $permissions = request()->input('permissions');
        $permissionUniqueNames = Collection::make($permissions)->pluck('unique_name')->toArray();
        $result = [];
        $permissionGroup->permissions()->whereNotIn('unique_name', $permissionUniqueNames)->delete();
        // Check for duplicates
        $uniqueNames = [];
        foreach ($permissions as $permission) {
            if (in_array($permission['unique_name'], $uniqueNames)) {
                return response()->json([
                    'id' => 'duplicate_permission_unique_name',
                    'error' => 'Duplicate permission unique name: '.$permission['unique_name'],
                ], 400);
            }
            $uniqueNames[] = $permission['unique_name'];
        }
        foreach ($permissions as $permission) {
            $tmp = $permissionGroup->permissions()->where('unique_name', $permission['unique_name'])->first();

            if (! $tmp instanceof Permission) {
                $tmp = $permissionGroup->permissions()->create([
                    'name' => $permission['name'],
                    'description' => $permission['description'],
                    'unique_name' => $permission['unique_name'],
                ]);
            } else {
                $tmp->name = $permission['name'];
                $tmp->description = $permission['description'];
                $tmp->save();
            }
            $result[] = $tmp->setHidden(['id', 'permission_group_id', 'permission_group']);
        }

        return Collection::make($result)->map(function ($item) {
            return $item->withoutRelations();
        });
    }

    public function permissions(Request $request, string $permgrp): Collection
    {
        $application = $request->application();
        $permissionGroup = PermissionGroup::where('application_id', $application->id)->where('unique_name', $permgrp)->first();

        return $permissionGroup->permissions;
    }
}
