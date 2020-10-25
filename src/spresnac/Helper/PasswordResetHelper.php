<?php

namespace App\Helper;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class PasswordResetHelper.
 */
class PasswordResetHelper
{
    /**
     * Returns a new password reset token for the given user and makes this new token the only valid one.
     *
     * @param User $user
     * @param int $token_lenght
     * @return string
     */
    public static function getNewResetTokenByUser(User $user, int $token_lenght = 255): string
    {
        $token = Str::random($token_lenght);
        DB::table('password_resets')
            ->where('email', '=', $user->getEmailForPasswordReset())
            ->delete();
        DB::table('password_resets')
            ->insert([
                'email' => $user->getEmailForPasswordReset(),
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]);

        return $token;
    }

    /**
     * Same as PasswordResetHelper::getNewResetTokenByUser() but with an id instead of the user object.
     *
     * @param int $user_id
     * @param int $token_lenght
     * @return string
     * @see PasswordResetHelper::getNewResetTokenByUser()
     */
    public static function getNewResetTokenByUserId(int $user_id, int $token_lenght = 255): string
    {
        $user = User::findOrFail($user_id);

        return self::getNewResetTokenByUser($user, $token_lenght);
    }
}
