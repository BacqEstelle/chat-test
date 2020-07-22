@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @include('conversations.users',['users'=>$users])
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>
                <div class="card-body conversations">
                    @if ($messages->hasMorePages())
                        <div class="text-center">
                            <a href="{{ $messages->nextPageUrl() }}" class="btn btn-light">
                                Show old messages
                            </a>
                        </div>
                    @endif
                    @foreach ($messages as $message)
                        <div class="row">
                            <div class="col-md-10 {{ $message->from->id !== $user->id ? 'offset-md-2 text-right' : ''}}">
                                <p>
                                    <strong>{{ $message->from->id !== $user->id  ? 'Moi' : $message->from->name }}</strong><br>

                                    {!! nl2br(e($message->content)) !!}

                                </p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    @if ($messages->previousPageUrl())
                    <div class="text-center">
                        <a href="{{ $messages->previousPageUrl() }}" class="btn btn-light">
                            Show news messages
                        </a>
                    </div>
                @endif

                    <form action="" method="post">
                        @csrf
                        <div class="form-group ">
                            <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : ''}}" name="content" placeholder="Type your message here" rows="2"></textarea>

                            @if ($errors->has('content'))
                                <div class="invalid-feedback">{{ implode(',',$errors->get('content')) }}</div>

                            @endif
                            <button class="btn btn-primary my-3" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

