<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Branch\CreateBranchRequest;
use App\Http\Requests\Client\Branch\DeleteBranchRequest;
use App\Models\Client\CompanyBranch;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct(private CompanyBranch $companyBranches)
    {

    }

    public function create(CreateBranchRequest $request){
        $branchData = $request->validated();
        $user = $request->user();
        $branch = $user->company->companyBranches()->create($branchData);
        if(empty($branch))
            return ResponseHelper::operationFail();
        return ResponseHelper::create('successful');
    }

    public function delete(DeleteBranchRequest $request){
        $branchId = $request->get('branch_id');
        $deleteBranch = $this->companyBranches->softDeleteData(['id'=> $branchId]);
        if(empty($deleteBranch))
            return ResponseHelper::operationFail();
        return ResponseHelper::delete();

    }

}
