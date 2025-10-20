@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form action="/confirm" class="form" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-name" type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                        <input class="form__input--text-name" type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('last_name')
                {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                @error('first_name')
                {{ $message }}
                @enderror
            </div>
            </div>
        <div class="form__group">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <label>
                        <input class="form__input--text-gender" type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>
                        男性
                    </label>
                    <label>
                        <input class="form__input--text-gender" type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>
                        女性
                    </label>
                    <label>
                        <input class="form__input--text-gender" type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>
                        その他
                    </label>
                </div>
            </div>
            <div class="form__error">
                @error('gender')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-email" type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-tel" type="tel" name="first_tel" placeholder="080" value="{{ old('first_tel') }}">
                        <span>-</span>
                        <input class="form__input--text-tel" type="tel" name="second_tel" placeholder="1234" value="{{ old('second_tel') }}">
                        <span>-</span>
                        <input class="form__input--text-tel" type="tel" name="third_tel" placeholder="5678" value="{{ old('third_tel') }}">
                    </div>
                </div>
            </div>
            <div class="form__error">
                @if($errors->has('first_tel') || $errors->has('second_tel') || $errors->has('third_tel'))
                {{ $errors->first('first_tel') }}
                @endif
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-address" type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-building" type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__item">
                        <select class="form__item-select" name="category_id">
                            <option value="" {{ old('category_id') ? '' : 'selected' }} disabled>選択してください</option>
                            @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('category_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__textarea">
                        <textarea name="detail" placeholder="お問い合わせ内容をご記入ください" value="{{ old('detail') }}"></textarea>
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('detail')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection