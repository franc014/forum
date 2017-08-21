@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a new thread</div>

                    <div class="panel-body">

                        <form method="POST" action="/threads">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="channel">Choose a Channel</label>
                                <select name="channel_id" class="form-control" required>
                                    <option value>Choose one</option>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}" {{old('channel_id')==$channel->id ? 'selected':'' }}>{{$channel->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" required
                                       placeholder="Escriba el título" value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control" rows="3" id="body" name="body" required>{{old('body')}}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Publish</button>
                            </div>
                            @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
