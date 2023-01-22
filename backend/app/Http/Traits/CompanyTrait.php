<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait CompanyTrait
{
     /**
     * Create company email
     * 
     * @param string $company_name
     * @return string $company_email
     */
    public function createCompanyEmail($prefix=null, $company_name) : string {
        
        // Define prefix
        $prefix = ($prefix ?? 'admin');
        $prefix = strtolower(Str::slug($prefix, '-'))  . '@';

        $slug = strtolower(Str::slug($company_name, '-'));
        $suffix = '.com';
        
        return $prefix . $slug . $suffix;
    }
}