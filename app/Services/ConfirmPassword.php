<?php


namespace App\Services;


use Illuminate\Support\Facades\Hash;

class ConfirmPassword
{
    public function confirm($columnName)
    {
        if (!$this->check($columnName)) {
            return back()->withErrors([
                $columnName => ['The provided password does not match our records.']
            ]);
        }
    }

    public function check($columnName)
    {
        return Hash::check(request()->{$columnName}, request()->user()->password);
    }
}
