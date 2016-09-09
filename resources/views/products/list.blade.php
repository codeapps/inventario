<td>{{ $product->id }}</td>
<td><img src="{{ $product->photo }}" alt="" style="weight:50px; height:50px;"/></td>
<td>{{ $product->name }}</td>
<td>{{ $product->category->name or 'Blank' }}</td>
<td>{{ $product->provider->name or 'Blank' }}</td>
<td>{{ $product->store->name or 'Blank' }}</td>
<td>{{ $product->stock or 'Blank' }}</td>
<td>{{ $product->serial or 'Blank' }}</td>
<td>{{ $product->year or 'Blank' }}</td>
<td>{{ $product->created_at->year or 'Blank' }}</td>
<td>{{ $product->price or 'Blank' }}</td>
<td>{{ $product->warranty or 'Blank' }} Months</td>
<td>
  @foreach($product->state as $state)
    <h5>{{ $state->name }}</h5>
    <h5>{{ $state->pivot->quantity }}</h5>
  @endforeach
</td>

<td>
  <a href="{{ route('products.show', $product->id) }}" id="Create" class="btn btn-primary">Show</a>
</td>
<td>
  <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Update</a>
</td>
<td>
  {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'DELETE']) !!}
  <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o fa-lg" type="submit"></i></button>
  {!! Form::close() !!}
</td>
