<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Infrastructure\Util;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function getList(Request $request): View
    {
        $users = $this->user->getList($request->get('offset', 0), $request->get('limit', 10));
        return \view('admin.users.user_list', ['users' => $users]);
    }

    /**
     * @param Request $request
     *
     * @return Factory|RedirectResponse|View
     */
    public function store(Request $request)
    {
        if (empty($request->request->all())) {
            return \view('admin.users.user_form');
        }
        $this->user->createNew($request->request->all());
        return redirect()->route('admin_user_list');
    }

    public function update(int $id)
    {

    }

    public function remove(int $id)
    {

    }
}
