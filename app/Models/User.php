<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute; // <-- Importante añadir esta línea

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario',
        'username',
        'password',
        'tipo_usuario',
        'otp',
        'otp_expires_at',
        'is_verified',
        'avatar' // <-- Agregado por si decides añadir subida de imágenes en el futuro
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Obtiene la URL del avatar del usuario.
     * Si no tiene una foto cargada, genera iniciales basadas en su nombre de 'usuario'.
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: function () {

                $nombreParaAvatar = urlencode(
                    $this->usuario ?? $this->username ?? 'User'
                );

                $colores = [
                    ['background' => '79EFF7', 'color' => '183133'],
                    ['background' => 'B8F2E6', 'color' => '183133'],
                    ['background' => 'F7D6E0', 'color' => '183133'],
                    ['background' => 'D9C2F0', 'color' => '183133'],
                    ['background' => 'FFE5B4', 'color' => '183133'],
                    ['background' => 'C7CEEA', 'color' => '183133'],
                ];

                $indice = $this->id % count($colores);
                $color = $colores[$indice];

                return "https://ui-avatars.com/api/?" .
                    "name={$nombreParaAvatar}" .
                    "&background={$color['background']}" .
                    "&color={$color['color']}";
            }
        );
    }
}
