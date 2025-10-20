@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('nav')
<div class="header-nav__item">
    <form action="/logout" class="header-nav__form" method="post">
        @csrf
        <button class="header-nav__button">logout</button>
    </form>
</div>
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <form action="/admin/search" class="search-form" method="get">
        @csrf
        <div class="search-form__item">
            <input type="text" class="search-form__item-input" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください ">
            <select class="search-form__item-gender" name="gender">
                <option value="">性別</option>
                <option value="">全て</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
            <select class="search-form__item-category" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                @endforeach
            </select>
            <input type="date" class="search-form__item-date" name="date" value="{{ request('date') }}">
            <span class="placeholder-text"></span>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
            <button class="search-form__button-reset" type="reset">リセット</button>
        </div>
    </form>
    <div class="nav-content">
        <form action="{{ route('contacts.export') }}" class="export-form" method="get">
        <button type="submit" class="export-form__button">エクスポート</button>
        </form>
        {{ $contacts->links('vendor.pagination.default') }}
    </div>
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header">お問い合わせの種類</th>
                <th class="contact-table__header"></th>
            </tr>
            @foreach($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">
                    {{ $contact['full_name'] }}
                </td>
                <td class="contact-table__item">
                    {{ $contact->gender_label }}
                </td>
                <td class="contact-table__item">
                    {{$contact['email']}}
                </td>
                <td class="contact-table__item">
                    {{ $contact['category_name'] }}
                </td>
                <td class="contact-table__item">
                    <button class="modal-open-button"
                    data-id="{{ $contact->id }}"
                    data-lastname="{{ $contact->last_name }}"
                    data-firstname="{{ $contact->first_name }}"
                    data-gender="{{ $contact->gender_label }}"
                    data-email="{{ $contact->email }}"
                    data-tel="{{ $contact->tel }}"
                    data-address="{{ $contact->address }}"
                    data-building="{{ $contact->building }}"
                    data-category="{{ $contact->category_name }}"
                    data-detail="{{ $contact->detail }}">
                    詳細
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="modal" class="modal hidden">
        <div class="modal__content">
            <span class="modal__close" id="closeModal">&times;</span>
            <table class="modal-table">
                <tr><th>お名前</th><td id="modal-name"></td></tr>
                <tr><th>性別</th><td id="modal-gender"></td></tr>
                <tr><th>メール</th><td id="modal-email"></td></tr>
                <tr><th>電話</th><td id="modal-tel"></td></tr>
                <tr><th>住所</th><td id="modal-address"></td></tr>
                <tr><th>建物名</th><td id="modal-building"></td></tr>
                <tr><th>お問い合わせの種類</th><td id="modal-category"></td></tr>
                <tr><th>お問い合わせ内容</th><td id="modal-detail"></td></tr>
            </table>
            <form id="delete-form" action="/admin/delete" method="post">
                @method('DELETE')
                @csrf
                <div class="delete-form__button">
                    <input type="hidden" name="id" value="{{ $contact['id'] }}">
                    <button class="data-delete__button" type="submit">削除</button>
            </form>
        </div>
    </div>
</div>
<script>
    const modal = document.getElementById('modal');
    const closeBtn = document.getElementById('closeModal');
    const openButtons = document.querySelectorAll('.modal-open-button');
    const deleteForm = document.getElementById('delete-form');

    openButtons.forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('modal-name').textContent =
                button.dataset.lastname + ' ' + button.dataset.firstname;
            document.getElementById('modal-gender').textContent = button.dataset.gender;
            document.getElementById('modal-email').textContent = button.dataset.email;
            document.getElementById('modal-tel').textContent = button.dataset.tel;
            document.getElementById('modal-address').textContent = button.dataset.address;
            document.getElementById('modal-building').textContent = button.dataset.building;
            document.getElementById('modal-category').textContent = button.dataset.category;
            document.getElementById('modal-detail').textContent = button.dataset.detail;

            const id = button.dataset.id;
            deleteForm.action = `/contacts/${id}`;

            modal.style.display = 'flex';
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>
@endsection