@extends('layouts.app')

@section('content')

  <h1>{{trans('strings.edit')}}</h1>

  {!! Form::open(array('route' => array('repairs.update', $repair->id), 'method' => 'PATCH')) !!}

  {!! Form::label('name', trans('strings.name')) !!}

  {!! Form::text('name', $repair->name, ['class' => 'form-control']) !!}

  {!! Form::label('Description', trans('strings.description') ) !!}

  {!! Form::textarea('description', $repair->description, ['class' => 'form-control']) !!}

  <button class="btn btn-warning" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
  {!! Form::close() !!}

  {!! Form::open(['route' => ['repairs.complete', $repair->id], 'method' => 'POST']) !!}
    <button class="btn btn-success" type="submit">{{ trans('strings.complete') }}</button>
  {!! Form::close() !!}

  {!! Form::open(['route' => ['repairs.returned', $repair->id], 'method' => 'POST']) !!}
    <button class="btn btn-success" type="submit">{{ trans('strings.returned') }}</button>
  {!! Form::close() !!}

  {!! Form::open(['route' => ['repairs.canceled', $repair->id], 'method' => 'POST']) !!}
    <button class="btn btn-success" type="submit">{{ trans('strings.cancel') }}</button>
  {!! Form::close() !!}

  <br>

  <h1>{{trans('strings.product_repair')}}</h1>

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th></th>
        <th>{{trans('strings.product')}}</th>
        <th>{{trans('strings.category')}}</th>
        <th>{{trans('strings.provider')}}</th>
        <th>{{trans('strings.store')}}</th>
        <th>{{trans('strings.serial')}}</th>
        <th>{{trans('strings.warranty')}}</th>
      </tr>
    </thead>

    @foreach($repair->product as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td><img src="{{ $product->photo }}" alt="" style="weight:50px; height:50px;"/></td>
        <td><a href="/products/{{ $product->id }}">{{ $product->name }}</a></td>
        <td>{{ $product->category->name or 'Blank' }}</td>
        <td>{{ $product->provider->name or 'Blank' }}</td>
        <td>{{ $product->store->name or 'Blank' }}</td>
        <td>{{ $product->serial or 'Blank' }}</td>
        <td>{{ $product->warranty or 'Blank' }} Months</td>

        <td>
          {!! Form::open(['route' => ['repairs.remove', $repair->id, $product->id], 'method' => 'DELETE']) !!}
          <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o fa-lg" type="submit"></i></button>
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach

@stop
