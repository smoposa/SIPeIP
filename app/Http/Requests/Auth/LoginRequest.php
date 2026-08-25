<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $usuario = User::with([
            'rol',
            'entidad',
        ])->where(
            'email',
            $this->input('email')
        )->first();

        /*
         * Usuario no existe o contraseña incorrecta.
         */
        if (
            !$usuario ||
            !Hash::check(
                $this->input('password'),
                $usuario->password
            )
        ) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        /*
         * Usuario deshabilitado.
         */
        if ($usuario->estado !== 'Activo') {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Su usuario se encuentra deshabilitado. Comuníquese con el administrador del sistema.',
            ]);
        }

        /*
         * Administradores globales y del sistema
         * pueden ingresar independientemente del
         * estado de su entidad.
         */
        $esAdministradorGlobal = in_array(
            $usuario->rol?->codigo,
            [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],
            true
        );

        /*
         * Usuarios institucionales requieren
         * una entidad activa.
         */
        if (
            !$esAdministradorGlobal &&
            (
                !$usuario->entidad ||
                $usuario->entidad->estado !== 'Activo'
            )
        ) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'La institución asociada a su usuario se encuentra deshabilitada. Comuníquese con el administrador del sistema.',
            ]);
        }

        /*
         * Autenticación final.
         */
        Auth::login(
            $usuario,
            $this->boolean('remember')
        );

        RateLimiter::clear(
            $this->throttleKey()
        );
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts(
            $this->throttleKey(),
            5
        )) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn(
            $this->throttleKey()
        );

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower(
                $this->string('email')
            ) . '|' . $this->ip()
        );
    }
}