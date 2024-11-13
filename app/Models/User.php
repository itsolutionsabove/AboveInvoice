<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'image',
        'phone',
        'country_code',
        'gender',
        'subscription',
        'role',
        'provider',
        'provider_id'
    ];

    public array $formFields = [
        'name' => 'text',
        'email' => 'email',
        'password' => 'password',
        'confirm password' => 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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


    public function wishlist(): HasMany
    {
        return $this->hasMany(WishList::class);
    }

    public function scopeSearch($query, $search){
        if(!$search) return;
        $query->where('name', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%");
    }
}