<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        return view('admin.users.user_list', ['users' => $users]);
    }

    public function store()
    {

    }

    public function update(int $id)
    {

    }

    public function remove(int $id)
    {

    }
}
