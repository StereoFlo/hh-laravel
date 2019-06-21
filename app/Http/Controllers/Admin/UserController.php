<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends AbstractController
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
     * @return View
     */
    public function getList(): View
    {
        $users = $this->user->getList();
        return view('admin.users.user_list', ['users' => $users]);
    }

    /**
     * @param int|null $id
     *
     * @return View
     */
    public function form(int $id = null): View
    {
        $user = null;
        if (isset($id)) {
            $user = $this->user->getById($id);
        }
        return view('admin.users.user_form', ['user' => $user]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $this->user->createOrUpdate($request->request->all());
        return redirect()->route('admin_user_list');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request): RedirectResponse
    {
        $this->user->createOrUpdate($request->request->all());
        return redirect()->route('admin_user_list');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function remove(int $id): RedirectResponse
    {
        $this->user->removeById($id);
        return redirect()->route('admin_user_list');
    }
}
