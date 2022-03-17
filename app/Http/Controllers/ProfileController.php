<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function store(Request $request)
    {
        return $this->profileService->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->profileService->update($request, $id);
    }
}
