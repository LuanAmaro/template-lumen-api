<?php

namespace App\Modules\Users\Http\Controllers;

use App\Bootstrap\Http\Controllers\Controller;
use App\Modules\Users\Repositories\UserRepository;
use Illuminate\Http\Request;
use Exception;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        try {
            $users = $this->userRepository->fetchAll(
                $request->get('search')
            );

            return response()->json([
                "success" => true,
                "data" => $users
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $userId)
    {
        try {
            $user = $this->userRepository->get($userId);

            return response()->json([
            "success" => true,
            "data" => $user
        ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $user = $this->userRepository->create($data);

            return response()->json([
            "success" => true,
            "data" => $user
        ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, int $userId)
    {
        $data = $request->all();

        try {
            $user = $this->userRepository->get($userId);
            $this->userRepository->update($user, $data);

            return response()->json([
                "success" => true,
                "data" => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $userId)
    {
        try {
            $user = $this->userRepository->get($userId);
            $this->userRepository->destroy($user);

            return response()->json([], 201);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
