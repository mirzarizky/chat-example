@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Conversations</h4>
                </div>
                <div class="card-body">
                    @if(count($conversations) > 0)
                        <ul>
                        @foreach($conversations as $conv)
                            <li><a href="{{ route('conv.index', ['id' => $conv->id]) }}" class="">Conversation {{ $conv->id }}</a></li>
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
