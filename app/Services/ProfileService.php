<?php

namespace App\Services;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;

class ProfileService
{
    public function store($data)
    {
        $validate = $this->validator($data->all());
        if ($validate->status() == 422) {
            return $validate;
        }
        if ($data->hasFile('avatar'))
        {
            $path = $this->storePicture($data);
        }
        return Profile::create([
            'user_id' => $data->user_id,
            'address' => $data->address,
            'phone_number' => $data->phone_number,
            'birthday_date' => $data->birthday_date,
            'avatar' => $path
        ]);
    }

    public function update($data, $id)
    {
        $validate = $this->validator($data->all());
        if ($validate->status() == 422) {
            return $validate;
        }
        if ($data->hasFile('avatar'))
        {
            $path = $this->storePicture($data);
        }
        $profile = Profile::where('id', $id)->first();
        return $profile->update([
            'user_id' => $data->user_id,
            'address' => $data->address,
            'phone_number' => $data->phone_number,
            'birthday_date' => $data->birthday_date,
            'avatar' => $path
        ]);
    }

    protected function validator($data)
    {
        $validator = Validator::make($data, [
           'address' => 'required|max:256',
           'phone_number' => 'required|min:6|max:12',
           'birthday_date' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return response('', 200);
    }

    protected function storePicture($data)
    {
        $images = $data->avatar;
        $imageName = time() . '.' . $images->getClientOriginalExtension();
        return $images->storeAs('public/avatars', $imageName);
    }
}
