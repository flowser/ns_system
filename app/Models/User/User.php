<?php

namespace App\Models\User;

use App\Traits\Uuids;
use App\Models\Admin\Hod;
use App\Models\Admin\Dhod;
use App\Models\Admin\Staff;
use App\Models\User\Client;
use App\Models\Survey\Entry;
use App\Models\User\Profile;
use App\Models\Admin\Lecturer;
use App\Models\Admin\Instadmin;
use App\Models\Admin\Principal;
use App\Models\Admin\Admindeputy;
use App\Models\Admin\Classmaster;
use App\Models\Survey\Participant;
use Laravel\Passport\HasApiTokens;
use App\Models\Admin\Academicdeputy;
use App\Models\Admin\Instsuperadmin;
use App\Models\Institution\Department;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Institution\Institution;
use Illuminate\Notifications\Notifiable;
use App\Models\Institution\Departmentlecturer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Uuids;
    use HasApiTokens, HasRoles, HasFactory, Notifiable;
    // HasRelationships;

    protected $guard_name = 'api';
    // protected $keyType = 'string';
    // protected $primaryKey = 'id';
    // protected $primaryKey = 'uuid';
    // public $incrementing = false;



    protected $fillable = [
            'first_name',
            'last_name',
            'email',
            'password',
            'password_changed_at',
            'confirmation_code',
            'email_verified_at',
            'timezone',
            'confirmed',
            'online',
            'active',
            'last_login_at',
            'last_login_ip',
    ];
        protected $hidden = ['password', 'remember_token','email_verified_at'];
        protected $dates = ['last_login_at', 'deleted_at'];
        protected $appends = ['full_name'];
        protected $casts = [
            // 'id' => 'string',
            'active'    => 'boolean',
            'confirmed' => 'boolean',
            'online'    => 'boolean',
            'email_verified_at' => 'datetime',
        ];

        public function getFullNameAttribute()
        {
            return $this->last_name ? $this->first_name . ' ' . $this->last_name : $this->first_name;
        }


        public function getNameAttribute()
        {
            return $this->full_name;
        }
        public function profile()
        {
            return $this->hasOne(Profile::class, 'user_id')
                        ->with('gender','country','county','constituency','ward');
        }
        public function staff()
        {
            return $this->hasOne(Staff::class, 'user_id')
                        ->with('stafftype', 'institution', 'entries');
        }
        public function entry(){
            return $this->hasOneThrough(Entry::class, Participant::class)
                        ->with('survey', 'staff', 'answers');
        }

    //     public function mentorinstitution(){
    //         return $this->belongsToMany(Institution::class, Staff::class);
    //    }

        public function staffinstitution(){
            return $this->belongsToMany(Institution::class, Staff::class)
                        ->with('departments');
        }
        // public function institution2(){
        //     return $this->belongsToMany(Institution::class, Instadmin::class);
        // }
        public function lecturerinstitution(){
             return $this->belongsToMany(Institution::class, Lecturer::class)
                         ->with('departments');
        }

        public function instsuperadmin(){
            return $this->hasOne(Instsuperadmin::class);
        }
        public function instadmin(){
            return $this->hasOne(Instadmin::class);
        }
        public function principal(){
            return $this->hasOneThrough(Principal::class, Lecturer::class);
        }
        public function academicdeputy(){
            return $this->hasOneThrough(Academicdeputy::class, Lecturer::class);
        }
        public function admindeputy(){
            return $this->hasOneThrough(Admindeputy::class, Lecturer::class);
        }

        public function hod(){
            return $this->hasOneDeep(Hod::class, [Lecturer::class, Departmentlecturer::class]);
        }
        public function dhod(){
            return $this->hasOneDeep(Dhod::class, [Lecturer::class, Departmentlecturer::class]);
        }
        public function classmaster(){
            return $this->hasOneDeep(Classmaster::class, [Lecturer::class, Departmentlecturer::class]);
        }

        public function lecturer(){
            return $this->hasOne(Lecturer::class, 'user_id')
                        ->with('institution', 'principal','academicdeputy','admindeputy');
        }
        public function departmentlecturer(){
            return $this->hasOneThrough(Departmentlecturer::class, Lecturer::class);
        }
        public function lecturerdepartment(){
            return $this->hasOneDeep(Department::class, [Lecturer::class, 'departmentlecturers']);
        }
        public function staffdepartment(){
            return $this->hasOneDeep(Department::class, [Staff::class, 'departmentstaffs']);
        }
        // public function mentordepartment(){
        //     return $this->hasOneDeep(Department::class, [Staff::class, 'departmentstaffs']);
        // }
}
