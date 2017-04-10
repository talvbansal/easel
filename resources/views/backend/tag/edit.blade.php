@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Edit Tag</title>
@stop

@section('content')
    <section id="main">

        @include('easel::backend.partials.sidebar-navigation')

        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        @include('easel::shared.breadcrumbs', ['links' => [
                            'Home' => url('/admin'),
                            'Tags' => url('/admin/tag') ,
                            'Edit Tag' =>'' ,
                        ]])

                        @include('easel::shared.errors')

                        @include('easel::shared.success')

                        <h2>
                            Edit <em>{{ $data['title'] }}</em>
                            <small>
                                Last edited on {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['updated_at'])->format('M d, Y') }} at {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['updated_at'])->format('g:i A') }}
                            </small>
                        </h2>

                    </div>
                    <div class="card-body card-padding">
                        <form class="keyboard-save" role="form" method="POST" id="tagUpdate" action="/admin/tag/{{ $data['id'] }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $data['id'] }}">

                            @include('easel::backend.tag.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text">
                                    <i class="zmdi zmdi-floppy"></i> Save
                                </button>&nbsp;
                                <button type="button" class="btn btn-danger btn-icon-text" data-toggle="modal" data-target="#modal-delete">
                                    <i class="zmdi zmdi-delete"></i> Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>

    @include('easel::backend.tag.partials.modals.delete')
@stop

@section('unique-js')
    {!! JsValidator::formRequest('Easel\Http\Requests\TagUpdateRequest', '#tagUpdate') !!}
    @include('easel::backend.tag.partials.script')

    @if(Session::get('_update-tag'))
        @include('easel::backend.shared.notifications.notify', ['section' => '_update-tag'])
        {{ \Session::forget('_update-tag') }}
    @endif
@stop
