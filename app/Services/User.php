<?php
namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable {

    /**
     * The user's ID.
     *
     * @var string
     */
    protected $id;

    public function getAuthIdentifierName()
    {
        return 'id'; // Assuming 'id' is your primary key
    }

    public function getAuthIdentifier()
    {
        return $this->id; // Assuming 'id' is your primary key
    }

    /**
     * The user's password.
     *
     * @var string
     */
    protected $password;

    public function getAuthPasswordName()
    {
        return 'password';
    }

    public function getAuthPassword()
    {
        return $this->password; // Assuming 'password' is the hashed password
    }

    /**
     * The remember token.
     *
     * @var string|null
     */
    protected $rememberToken;

    public function getRememberTokenName()
    {
        return 'rememberToken';
    }

    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * Set the remember token for the user.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
