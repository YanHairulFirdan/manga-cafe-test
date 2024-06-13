<?php

namespace App\Supports\Models\Concerns;

use Illuminate\Support\Facades\Hash;

trait HasPassword
{
    /**
     * Initialize the soft deleting trait for an instance.
     *
     * @return void
     */
    public function initializeHasPassword()
    {
        if (! in_array('password', $this->fillable)) {
            $this->fillable[] = 'password';
        }

        if (! in_array('password', $this->hidden)) {
            $this->hidden[] = 'password';
        }
    }

    /**
     * Hash the user's password automatically.
     */
    protected function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::needsRehash($password)
            ? Hash::make($password)
            : $password;
    }
}
