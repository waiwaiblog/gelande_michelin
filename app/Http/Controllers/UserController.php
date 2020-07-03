<?php

namespace App\Http\Controllers;

use App\EmailReset;
use App\Http\Requests\UserRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function edit(Request $request)
    {
        $authUser = Auth::user();

        return view('user.edit', compact('authUser'));
    }

    public function update(UserRequest $request)
    {

        $authUser = Auth::user();

        $authUser->user_name = $request->input('user_name');

        $uploadFile = $request->file('image');
        if (!empty($uploadFile)) {
            $thumbnailName = $request->file('image')->hashName();
            $request->file('image')->storeAs('public/profile_images', $thumbnailName);

            $authUser->image = $thumbnailName;
        }

        $authUser->save();

        return redirect('user/edit')->with('flash_message', '変更しました');

    }


    public function sendChangeEmailLink(Request $request)
    {
        $new_email = $request->new_email;

        // トークン生成
        $token = hash_hmac(
            'sha256',
            Str::random(40) . $new_email,
            config('app.key')
        );

        // トークンをDBに保存
        DB::beginTransaction();
        try {
            $param = [];
            $param['user_id'] = Auth::id();
            $param['new_email'] = $new_email;
            $param['token'] = $token;
            $email_reset = EmailReset::create($param);

            $email_reset->sendEmailResetNotification($token);

            DB::commit();

            return redirect()->route('user.edit')->with('flash_message', '確認メールを送信しました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('user.edit')->with('flash_message', 'メール更新に失敗しました。');
        }
    }


    public function sendChangeEmailReset(Request $request, $token)
    {
        //
        $email_resets = DB::table('email_resets')
            ->where('token', $token)
            ->first();

        if ($email_resets && !$this->tokenExpired($email_resets->created_at)) {//時間以内

            $user = User::find($email_resets->user_id);
            $user->email = $email_resets->new_email;
            $user->save();

            DB::table('email_resets')
                ->where('token', $token)
                ->delete();

            return redirect()->route('user.edit')->with('flash_message', 'メールアドレスを更新しました');
        } else {//時間が過ぎていた場合
            // レコードが存在していた場合削除
            if ($email_resets) {
                DB::table('email_resets')
                    ->where('token', $token)
                    ->delete();
            }
            return redirect()->route('user.edit')->with('flash_message', 'メールアドレスを更新に失敗しました');
        }
    }

    protected function tokenExpired($createdAt) {

        $expires = 60 * 60;
        return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
    }




    public function changePassword(Request $request) {
        //現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->route('user.edit')->withInput()->withErrors(array('current-password' => '現在のパスワードが間違っています'));
        }

        //現在のパスワードと古いパスワードが正しいかを調べる
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->route('user.edit')->withInput()->withErrors(array('new-password' => '新しいパスワードが現在のパスワードと同じです'));
        }

        //パスワードのバリデーション。新しいパスワードは8文字以上、new-password_confirmationフィールドの値と一致しているかどうか。
        $validated_date = $request->validate([
           'current-password' => 'required',
           'new-password' => 'required|string|min:8|confirmed',
        ]);

        //パスワードを変更
        $user = Auth::user();
    //        $user->password = bcrypt($request->get('new-password'));
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return redirect()->route('user.edit')->with('flash_message', 'パスワードを変更しました');
    }
}
