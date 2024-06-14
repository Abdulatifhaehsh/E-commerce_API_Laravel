<?php

namespace App\Http\Controllers\Client;

use App\Enums\Client\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Company\CreateRequest;
use App\Http\Requests\Client\Company\GetCompanyRequest;
use App\Http\Requests\Client\Company\UpdateRequest;
use App\Models\Client\Company;
use App\Models\Client\User;
use Hashash\ProjectService\Helpers\FileClass;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(private Company $companies, private FileClass $fileClass)
    {

    }


    public function create(CreateRequest $request)
    {
        $companyData = $request->validated();
        $companyBrancheData = $companyData['branches'];
        unset($companyData['branches']);

        $logo = $companyData[Company::logo];
        $companyData[Company::logo] = $this->fileClass
                            ->uploadFile(
                                $logo,
                                time() . '1.' . $logo->extension(),
                                'images/client/'
                            );

        $facadeUrl = $companyData[Company::facadeUrl];
        $companyData[Company::facadeUrl] = $this->fileClass
                            ->uploadFile(
                                $facadeUrl,
                                time() . '2.' . $facadeUrl->extension(),
                                'images/client/'
                            );

        $user = $request->user();
        $user[User::userType] = UserType::company;
        $user->save();
        $user['token_api'] = (new User())->tokenApi($user);
        $company = new Company($companyData);
        $user['company'] = $user->company()->save($company);
        $user['company']['company_branches'] = $user->company->companyBranches()->createMany($companyBrancheData);
        $user->load('wallet');
        return ResponseHelper::create($user);
    }

    public function update(UpdateRequest $request)
    {
        $companyData = $request->validated();

        if(!empty($companyData[Company::logo])) {
            $logo = $companyData[Company::logo];
            $companyData[Company::logo] = $this->fileClass
                                ->uploadFile(
                                    $logo,
                                    time() . '1.' . $logo->extension(),
                                    'images/client/'
                                );
        }

        if(!empty($companyData[Company::facadeUrl])) {
            $facadeUrl = $companyData[Company::facadeUrl];
            $companyData[Company::facadeUrl] = $this->fileClass
                                ->uploadFile(
                                    $facadeUrl,
                                    time() . '2.' . $facadeUrl->extension(),
                                    'images/client/'
                                );
        }

        $user = $request->user();
        $updateCompany = $this->companies->updateData(['id' => $user->company->id], $companyData);
        if(empty($updateCompany))
            return ResponseHelper::updatingFail();
        $user['token_api'] = $request->bearerToken();
        $user->load(['company.companyBranches', 'wallet']);
        return ResponseHelper::update($user);
    }

    public function getCompany(GetCompanyRequest $request) {
        $companyId = $request->get('company_id');
        $company = $this->companies->findData(['id' => $companyId], relations: ['companyBranches.area', 'companyType', 'companyProducts.mainImage', 'user.wallet']);

        return ResponseHelper::select($company);
    }

    public function getAllCompanies(Request $request)
    {
        $companies = $this->companies->getData(relations: ['companyBranches', 'user.wallet', 'companyType']);
        return ResponseHelper::select($companies);
    }
}
