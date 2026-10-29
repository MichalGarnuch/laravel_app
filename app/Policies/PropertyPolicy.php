<?php
namespace App\Policies;
use App\Models\Property;
use App\Models\User;
final class PropertyPolicy
{
 public function viewAny(User $user): bool { return true; }
 public function create(User $user): bool { return true; }
 public function view(User $user, Property $property): bool { return $property->user_id !== null && (int)$property->user_id === (int)$user->id; }
 public function update(User $user, Property $property): bool { return $this->view($user,$property); }
 public function delete(User $user, Property $property): bool { return $this->view($user,$property); }
 public function deleteAny(User $user): bool { return false; }
}
