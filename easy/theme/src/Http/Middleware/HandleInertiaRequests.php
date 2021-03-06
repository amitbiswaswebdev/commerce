<?php

namespace Easy\Theme\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Easy\Theme\Contracts\TreeInterface;

/**
 * HandleInertiaRequests
 */
class HandleInertiaRequests extends Middleware
{
    protected $tree;
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    public function __construct(TreeInterface $treeInterface)
    {
        $this->tree = $treeInterface;
    }

    /**
     * Determine the current asset version.
     *
     * @param Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        $admin = $request->user('admin');
        return array_merge(parent::share($request), [
            'flash' => [
                'success' => function () use ($request) {
                    return $request->session()->get('success');
                },
                'error' => function () use ($request) {
                    return $request->session()->get('error');
                },
                'warning' => function () use ($request) {
                    return $request->session()->get('warning');
                }
            ],
            'auth' => [
                'user' => $admin,
            ],
            'menu' => ($admin) ? $this->tree->getTree(config('menu'), true) : []
        ]);
    }
}
