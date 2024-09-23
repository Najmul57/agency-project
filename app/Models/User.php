<?php

namespace App\Models;

use App\Models\Expensive;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'role_id', 'phone', 'photo', 'email', 'city', 'country', 'signature', 'nid', 'cgpa', 'regis__country', 'regis__university', 'regis__program', 'regis__course', 'regis__uni__course', 'o_level', 'a_level', 'graduate', 'post_graduate', 'others', 'system_id', 'password', 'f_name', 'm_name', 'dob', 'address', 'referance', 'is_primium', 'amount', 'method', 'txt_number'];



    public function role()
    {
        return $this->belongsTo('App\Models\UserAccess');
    }
    public function programType()
    {
        return $this->belongsTo(ProgramType::class, 'regis__program', 'id');
    }
    public function premiumCountry()
    {
        return $this->belongsTo(PrimiumCountry::class, 'regis__country', 'id');
    }
    public function premiumUniversity()
    {
        return $this->belongsTo(PrimiumUniversity::class, 'regis__university', 'id');
    }
    public function department()
    {
        return $this->belongsTo(PrimiumCourse::class, 'regis__course', 'id');
    }
    public function course()
    {
        return $this->belongsTo(PrimiumUniversityCourse::class, 'regis__uni__course', 'id');
    }
    // public function country()
    // {
    //     return $this->belongsTo(StudentCountry::class);
    // }
    public function ticketRequest()
    {
        return $this->belongsTo(TicketForm::class);
    }
    public function studentTicket()
    {
        return $this->belongsTo(StudentTicket::class);
    }

    public function travelguideline()
    {
        return $this->hasOne(TravelGuideline::class, 'user_id'); // Adjust the foreign key if necessary
    }

    public function expensive()
    {
        return $this->hasOne(Expensive::class, 'auth_id');
    }

    public static function getPermissionGroup()
    {
        $permission_group = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_group;
    }
    public static function getPermissionByGroupName($group_name)
    {
        $permissions = DB::table('permissions')->select('name', 'id')->where('group_name', $group_name)->get();
        return $permissions;
    } // end method

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
            return $hasPermission;
        }
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function generateSystemId()
    {
        $currentYear = date('Y');

        if (!session()->has('systemIdIncrement')) {
            session(['systemIdIncrement' => 0]);
        }

        // $increment = session('systemIdIncrement');
        // $increment++;

        // session(['systemIdIncrement' => $increment]);

        // Concatenate $currentYear and '25020' as strings, then add $increment
        // $systemId = $currentYear . '25020' . $increment;
        // $currentYear = date("Y");
        $uniqueId = sprintf('%04d', mt_rand(0, 9999)); // Generate a random 4-digit number
        // $systemId = $currentYear . '25020' . $uniqueId;
        $systemId = '25020' . $uniqueId;

        return $systemId;
    }

    public function ticketStatus()
    {
        return $this->hasOne(TicketStatus::class);
    }
}
