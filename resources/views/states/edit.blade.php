@extends('layouts.app')

@section('content')

<h1>{{trans('strings.Edit')}}</h1>

{!! Form::open(array('route' => array('states.update', $state->id), 'method' => 'PATCH')) !!}

  {!! Form::label('Name', trans('strings.Name')) !!}
  {!! Form::text('name', $state->name, ['class' => 'form-control']) !!}

  {!! Form::label('Label', trans('strings.label')) !!}
  {!! Form::text('label', $state->label, ['class' => 'form-control']) !!}

  {{ Form::submit(trans('strings.Save'), array('class' => 'btn btn-success')) }}

{!! Form::close() !!}

@stop
