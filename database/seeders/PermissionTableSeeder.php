<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'Basic Setting Tab','Dashboard Per VP', 'Violation Date Statics',
            'Dashboard Egy Violations', 'Dashboard Uae Violations','Cards', 'Violations Contriputions',
            'Countries List', 'Countries Create', 'Countries Edit', 'Countries Show', 'Countries Destroy',
            'Locations List','Locations Create', 'Locations Edit', 'Locations Show', 'Locations Destroy',
            'VPS List', 'VPS Create', 'VPS Edit', 'VPS Show', 'VPS Destroy',
            'Areas List', 'Areas Create', 'Areas Edit', 'Areas Show', 'Areas Destroy',
            'Violation Classifications List', 'Violation Classifications Create', 'Violation Classifications Edit', 'Violation Classifications Show', 'Violation Classifications Destroy',
            'Workers Types List', 'Workers Types Create', 'Workers Types Edit', 'Workers Types Show', 'Workers Types Destroy',
            'Workers Titles List', 'Workers Titles Create', 'Workers Titles Edit', 'Workers Titles Show', 'Workers Titles Destroy',
            'Fixed Companies List', 'Fixed Companies Create', 'Fixed Companies Edit', 'Fixed Companies Show', 'Fixed Companies Destroy',
            'Service Companies List', 'Service Companies Create', 'Service Companies Edit', 'Service Companies Show', 'Service Companies Destroy',
            'Workers List', 'Workers Create', 'Workers Edit', 'Workers Show', 'Workers Destroy',
            'Unfixed Workers List', 'Unfixed Workers Create', 'Unfixed Workers Edit', 'Unfixed Workers Show', 'Unfixed Workers Destroy',
            'Roles List', 'Roles Create', 'Roles Edit', 'Roles Show', 'Roles Destroy',
            'Groups List', 'Groups Create', 'Groups Edit', 'Groups Show', 'Groups Destroy',
            'Users List', 'Users Create', 'Users Edit', 'Users Show', 'Users Destroy',
            'Violations Tab',
            'Uae Violations List', 'Uae Violations Create', 'Uae Violations Edit', 'Uae Violations Show', 'Uae Violations Destroy','Export All Uae Violations', 'Export Date Results Uae Violations',
            'Egy Violations List', 'Egy Violations Create', 'Egy Violations Edit', 'Egy Violations Show', 'Egy Violations Destroy', 'Export All Egy Violations', 'Export Date Results Egy Violations',
            'Permits Tab',
            'Vehicles Permits - Section',
            'Request Vehicles Permits', 'Vehicles Permits Edit', 'Vehicles Permits Show', 'Vehicles Permits Destroy',
            'Request Private Permits', 'Private Permits Edit', 'Private Permits Show', 'Private Permits Destroy',
            'CLM - Section',
            'Request Unfixed Permits', 'Unfixed Permits Edit', 'Unfixed Permits Show', 'Unfixed Permits Destroy',
            'Group - Pending Permits', 'Manage Group Permits - Vehicles', 'Manage Group Permits - Private', 'Manage Group Permits - Unfixed',
            'Safety - Section','Safety - Pending Permits', 'Manage Safety Permits - Vehicles', 'Manage Safety Permits - Private', 'Manage Safety Permits - Unfixed',
            'Security - Section', 'Security - Pending Permits', 'Manage Security Permits - Vehicles', 'Manage Security Permits - Private', 'Manage Security Permits - Unfixed',
            'Permits Management - Section',
            'Own Permits List', 'Manage Own Permits - Vehicles','Manage Own Permits - Private','Manage Own Permits - Unfixed',
            'Records Tab', 'Records List', 'Records Create',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
