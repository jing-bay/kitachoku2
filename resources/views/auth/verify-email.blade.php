@extends ('layouts.default')

@section ('content')
<div class="register">
    <div class="register__content">
        <div class="register__inner">
            まだ会員登録メールでの認証がお済みでないようです。
            メールをご確認の上、認証を完了させてください。
        </div>
    </div>
    <div class="verify__btn">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <button type="submit" class="verify__send">
                    {{ __('もう一度メールを送る') }}
                </button>
            </div>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div>
                <button type="submit" class="verify__logout">
                    {{ __('ログアウト') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
