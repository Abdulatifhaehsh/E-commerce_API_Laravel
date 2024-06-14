<?php

namespace App\Http\Controllers;

use App\Models\Client\Company;
use App\Models\Client\User;
use App\Models\Payment\Payment;
use App\Models\Product\Product;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function __construct(private User $users, private Company $companies, private Payment $payments, private Product $products)
    {

    }

    public function statistics(Request $request) {
        $statistics = [
            'user_count' => User::count(),
            'payment_count' => Payment::count(),
            'company_count' => Company::count(),
            'product_count' => Product::count(),
            'product_statistics' => Product::select(DB::raw('count(id) as count') , DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year','month')
            ->get(),
            'payment_statistics' => Payment::select(DB::raw('count(id) as count') , DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year','month')
            ->get(),
        ];

        return ResponseHelper::select($statistics);
    }
}
