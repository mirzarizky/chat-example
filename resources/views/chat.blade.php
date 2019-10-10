@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Conversations </h4>
                    </div>
                    <div class="card-body">
                        <chat-conversations id="{{ $conversation->id }}"></chat-conversations>
                    </div>
                    <div class="card-footer">
                        <chat-form id="{{ $conversation->id }}"></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
