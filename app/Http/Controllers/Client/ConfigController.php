<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Country;
use App\Models\Product\CompanyType;
use App\Models\Product\Size;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function getConfig(Request $request)
    {
        $data['countries'] = Country::with('cities.areas')
                                    ->get();
        $data['company_types'] = CompanyType::with('productTypes')
                                            ->get();
        $data['sizes'] = Size::get();
        return ResponseHelper::select($data);
    }
}
