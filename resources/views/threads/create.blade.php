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
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Escriba el título">
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control" rows="3" id="body" name="body"></textarea>
                            </div>

                            <button type="submit" class="btn btn-default">Publish</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection