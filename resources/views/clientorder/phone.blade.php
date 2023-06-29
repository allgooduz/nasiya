@extends('layouts.merchantapp')
@section('content')
    <div class="content">
        <div class="sidebar_opener">
            <h2>Заявки</h2>
            <div class="for_sidebar">
                <p>Sidebar</p>
            </div>
        </div>
        <div id="form__section">
            <h2>Telefon orqali login</h2>
            <form action="{{ route('clientorder.show') }}" id="anchor">
                <input type="number" placeholder="Telefon raqam">
                <button class="_next_btn">Keyingi</button>
            </form>
        </div>
    </div>
@endsection
