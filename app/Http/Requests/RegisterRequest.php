<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                   'over_name' => 'required|string|max:10',
        'under_name' => 'required|string|max:10',
        'over_name_kana' => ['required', 'string', 'max:30', 'regex:/^[ァ-ヶー]+$/u'],
        'under_name_kana' => ['required', 'string', 'max:30', 'regex:/^[ァ-ヶー]+$/u'],
        'mail_address' => 'required|email|max:100|unique:users,mail_address',
        'sex' => 'required|in:1,2,3',
        'old_year' => 'required|integer|min:2000|max:' . date('Y'),
        'old_month' => 'required|numeric|between:1,12',
        'old_day' => 'required|integer|between:1,31',
        'role' => 'required|in:1,2,3,4',
	'password' => 'required|min:8|max:30|confirmed',
	'password_confirmation' => 'required',
        ];
    }
    public function messages()
{
	return [
		'over_name.required' => '姓は必須です。',
		'over_name.max' => '姓は10文字以内で入力してください。',
		'under_name.required' => '名は必須です。',
		'under_name.max' => '名は10文字以内で入力してください。',
		'over_name_kana.required' => 'セイは必須です。',
		'over_name_kana.regex' => 'セイはカタカナで入力してください。',
		'over_name_kana.max' => 'セイは10文字以内で入力してください。',
		'under_name_kana.required' => 'メイは必須です。',
		'under_name_kana.regex' => 'メイはカタカナで入力してください。',
		'under_name_kana.max' => 'メイは10文字以内で入力してください。',
		'mail_address.required' => 'メールアドレスは必須です。',
		'mail_address.email' => 'メールアドレスの形式で入力してください。',
		'mail_address.unique' => 'このメールアドレスはすでに登録されています。',
		'sex.required' => '性別は必須です。',
		'old_year.required' => '生年月日の年は必須です。',
		'old_month.required' => '生年月日の月は必須です。',
		'old_day.required' => '生年月日の日は必須です。',
		'role.required' => '役職は必須です。',
		'password.required' => 'パスワードは必須です。',
		'password.min' => 'パスワードは8文字以上で入力してください。',
		'password.confirmed' => '確認用パスワードと一致していません。',
		'password_confirmation.required' => '確認用パスワードは必須です。',
    ];
}
public function withValidator($validator)
{
    $validator->after(function ($validator) {
        $year = $this->old_year;
        $month = $this->old_month;
        $day = $this->old_day;

        if (
            is_numeric($year) &&
            is_numeric($month) &&
            is_numeric($day) &&
            !checkdate((int) $month, (int) $day, (int) $year)
        ) {
            $validator->errors()->add('old_day', '正しい日付を入力してください。');
	}
	if (
    is_numeric($year) &&
    is_numeric($month) &&
    is_numeric($day) &&
    checkdate((int) $month, (int) $day, (int) $year)
) {
    $birthday = sprintf('%04d-%02d-%02d', $year, $month, $day);

    if ($birthday > date('Y-m-d')) {
        $validator->errors()->add('old_day', '未来の日付は入力できません。');
    }
}
    });
}
}
