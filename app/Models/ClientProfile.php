<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class ClientProfile extends Model
{
    //
    protected $fillable = [
        'user_id',
        'company_name',
        'contact_person',
        'phone',
    ];

      /**
     * Profile belongs to a user.
     */

     public function user(){
        return $this->belongsTo(User::class);
     }

}
