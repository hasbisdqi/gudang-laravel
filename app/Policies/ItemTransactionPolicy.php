<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ItemTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemTransactionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ItemTransaction');
    }

    public function view(AuthUser $authUser, ItemTransaction $itemTransaction): bool
    {
        return $authUser->can('View:ItemTransaction');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ItemTransaction');
    }

    public function update(AuthUser $authUser, ItemTransaction $itemTransaction): bool
    {
        return $authUser->can('Update:ItemTransaction');
    }

    public function delete(AuthUser $authUser, ItemTransaction $itemTransaction): bool
    {
        return $authUser->can('Delete:ItemTransaction');
    }

    public function restore(AuthUser $authUser, ItemTransaction $itemTransaction): bool
    {
        return $authUser->can('Restore:ItemTransaction');
    }

    public function forceDelete(AuthUser $authUser, ItemTransaction $itemTransaction): bool
    {
        return $authUser->can('ForceDelete:ItemTransaction');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ItemTransaction');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ItemTransaction');
    }

    public function replicate(AuthUser $authUser, ItemTransaction $itemTransaction): bool
    {
        return $authUser->can('Replicate:ItemTransaction');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ItemTransaction');
    }

}