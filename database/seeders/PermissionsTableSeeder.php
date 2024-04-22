<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'user_management_access',
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            'rank_create',
            'rank_edit',
            'rank_show',
            'rank_delete',
            'rank_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            'audit_log_show',
            'audit_log_access',
            'user_alert_create',
            'user_alert_show',
            'user_alert_delete',
            'user_alert_access',
            'police_department_access',
            'disciplinary_create',
            'disciplinary_edit',
            'disciplinary_show',
            'disciplinary_delete',
            'disciplinary_access',
            'sop_create',
            'sop_edit',
            'sop_show',
            'sop_delete',
            'sop_access',
            'certification_create',
            'certification_edit',
            'certification_show',
            'certification_delete',
            'certification_access',
            'comment_create',
            'comment_edit',
            'comment_show',
            'comment_delete',
            'comment_access',
            'fto_access',
            'course_create',
            'course_edit',
            'course_show',
            'course_delete',
            'course_access',
            'training_create',
            'training_edit',
            'training_show',
            'training_delete',
            'training_access',
            'sop_sign_off_create',
            'sop_sign_off_edit',
            'sop_sign_off_show',
            'sop_sign_off_delete',
            'sop_sign_off_access',
            'profile_password_edit',
        ];
        foreach ($permissions as $perm) {
            Permission::create(['title' => $perm]);
        }
    }
}
