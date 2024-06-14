<?php

namespace App\Http\Controllers\Client;

use App\Enums\Client\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\User\SignInRequest;
use App\Http\Requests\Client\User\SignUpRequest;
use App\Http\Requests\Client\User\UpdateUserRequest;
use App\Models\Client\User;
use App\Models\Client\Wallet;
use Composer\Util\Http\Response;
use Hashash\ProjectService\Helpers\FileClass;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(private User $users, private FileClass $fileClass)
    {

    }

    public function index(Request $request) {
        return ResponseHelper::select( $request->user()->createToken('my-store', ['admin'])->accessToken);
    }

    public function signUp(SignUpRequest $request) {
        $userData = $request->validated();
        if(!empty($userData['image'])) {
            $file = $userData['image'];
            $fileUri = $this->fileClass
                                    ->uploadFile(
                                        $file,
                                        time() . '.' . $file->extension(),
                                        'images/user/'
                                    );
            $userData['image'] = $fileUri;
        }
        $createUser = $this->users->createData($userData);
        if(empty($createUser))
            return ResponseHelper::creatingFail();
        $wallet = new Wallet();
        $user['wallet'] = $createUser->wallet()->save($wallet);
        $token = $this->users->tokenApi($createUser);
        $user = $this->users->findData(['id' => $createUser->id]);
        $user['token_api'] = $token;

        return ResponseHelper::create($user);
    }

    public function signIn(SignInRequest $request) {
        $userData = $request->validated();

        if(Auth::attempt($userData)){
            $user = Auth::user();
            $user['token_api'] = $this->users->tokenApi($user);
            if($user->user_type == UserType::company)
                $user['company'] = $user->company;
            return ResponseHelper::operationSuccess($user);
        }

        return ResponseHelper::operationFail();
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $data = $request->validated();
        if(!empty($data['image'])) {
            $file = $data['image'];
            $fileUri = $this->fileClass
                                    ->uploadFile(
                                        $file,
                                        time() . '.' . $file->extension(),
                                        'images/user/'
                                    );
            $data['image'] = $fileUri;
        }
        $updateUser = $this->users->updateData(['id' => $request->user()->id], $data);
        if(empty($updateUser))
            return ResponseHelper::operationFail();
        return ResponseHelper::update('Successful updated');
    }

    public function getUser(Request $request) {
        $user = $request->user();
        if($user->user_type == UserType::company) {
            $user->load(['company.companyBranches', 'company.companyType','companyProducts.mainImage']);
        }
        return ResponseHelper::select($user);
    }

    public function getAllUsers(Request $request) {
        $users = $this->users->getData(relations:['wallet']);
        return ResponseHelper::select($users);
    }

}
