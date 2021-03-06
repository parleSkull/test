<?php

namespace App\Http\Controllers\Frontend\Auth\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\API\RegisterRequest;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Http\Resources\Frontend\Auth\UserResource;
use Illuminate\Http\Request;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function register(Request $request)
    {
        $data = $request->all();
//        // sometimes last_name will be empty if it's institution
//        $data['last_name'] = $request->get('last_name', "");
//        $data = $request->validated();

        $user = $this->userRepository->create($data);

        // If the user must confirm their email or their account requires approval,
        // create the account but don't log them in.
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            event(new UserRegistered($user));

            $description = config('access.users.requires_approval') ?
                __('exceptions.frontend.auth.confirmation.created_pending') :
                __('exceptions.frontend.auth.confirmation.created_confirm');

            return res(200, $description);

        } else {
            auth()->login($user);

            $token = $user->generateAccessToken();

            event(new UserRegistered($user));

            return (new UserResource(array_add($user, 'access_token', [
                'type' => 'Bearer',
                'value' => $token->accessToken,
                'expires_in' => 60 * 60
            ])))->response()->setStatusCode(200);
        }
    }
}
