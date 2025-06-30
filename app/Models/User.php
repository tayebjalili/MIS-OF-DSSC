<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var // list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var // list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getSingle($id)
    {
        return User::find($id);
        // return User::find(1);
    }
    static public function getRecord()
    {

        return User::select('users.*', 'roles.name as role_name')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->orderBy('users.id', 'desc')
            ->get();
    }

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }

    // public function hasPermission($permission)
    // {
    //     if (empty($this->permissions)) {
    //         return false;
    //     }

    //     // Example: if you store permissions in a JSON column named 'permissions'
    //     $permissions = json_decode($this->permissions, true);

    //     if (!is_array($permissions)) {
    //         return false;
    //     }
    //     $permissions = array_map('trim', $permissions);
    //     $permission = trim($permission); // Ensure input is trimmed too



    //     return is_array($permissions) && in_array($permission, $permissions);
    // }
    // public function hasPermission($permission)
    // {
    //     // Logic to check if the user has the required permission
    //     return in_array($permission, $this->permissions); // Example
    // }

    /**
     * Check if the user has a specific permission.
     */
    public function hasPermission($permission)
    {
        // First, check if the user has any permissions directly (if applicable)
        if (!empty($this->permissions) && in_array($permission, $this->permissions)) {
            return true;
        }

        // If no direct permission, check the permissions associated with the user's role
        return $this->roleHasPermission($permission);
    }

    /**
     * Check if the user's role has a specific permission.
     */
    public function roleHasPermission($permission)
    {
        // Get the role's permissions
        $rolePermissions = PermissionRoleModel::getPermission($permission, $this->role_id);

        return $rolePermissions > 0;
    }
}
