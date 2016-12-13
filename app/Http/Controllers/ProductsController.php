<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Requests;

use App\Product;
use App\Region;
use App\City;
use App\Store;
use App\Repair;
use App\Category;
use App\Provider;
use App\State;
use App\Order;
use App\User;
use App\Sale;

use Carbon\Carbon;
use Auth;
use File;
use DB;


class ProductsController extends Controller
{

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    if (Auth::id() == 1)
    {
      $products = Product::where('state_id', 300)->paginate(10);
      return view('products.indexCard', compact('products'));
    } else {
      $products = Product::paginate(10);
      return view('products.indexList', compact('products'));
    }
  }

  /**
  * Process datatables ajax request.
  *
  * @return \Illuminate\Http\JsonResponse
  */
  public function search(Request $request)
  {
    $products = Product::search($request->search)->paginate(10);

    if ($products->count() > 0) {
      Flash($products->count() . ' Registers Found', 'success');
    } else {
      Flash('No Registers Found', 'danger');
    }

    if (Auth::id() == 1)
    {
      return view('products.indexCard', compact('products'));
    } else {
      return view('products.indexList', compact('products'));
    }
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $categories = Category::pluck('name', 'id');
    $providers = User::where('role_id', 2)->pluck('username', 'id');
    $stores = Store::pluck('name', 'id');
    $cities = City::pluck('name', 'id');
    $regions = Region::pluck('name', 'id');

    return view('products.create', compact(
      'categories', 'providers',
      'stores', 'cities', 'regions'
    ));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $product = Product::findOrFail($id);

    $categories = Category::pluck('name', 'id');
    $providers = User::where('role_id', 2)->pluck('username', 'id');
    $stores = Store::pluck('name', 'id');
    $cities = City::pluck('name', 'id');
    $regions = Region::pluck('name', 'id');
    $states = State::pluck('name', 'id');

    return view('products.edit', compact(
      'product', 'categories', 'providers',
      'stores', 'cities', 'regions', 'states'
    ));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), $this->rules());

    if ($validator->fails()) {
      Flash('Validation Fail!', 'danger');
      return redirect('products.create')
      ->withErrors($validator)
      ->withInput();
    } else {
      $file = Input::file('photo');
      if ($file)
      {
        $filePath = public_path() . '/img/products/';
        $fileName = $file->getClientOriginalName();
        File::exists($filePath) or File::makeDirectory($filePath);
        $image = Image::make($file->getRealPath());
        $image->save($filePath . $fileName);
        $request->photo = '/img/products/' . $fileName;
      }
      $request->photo = '/img/products/ipad.jpeg';
      $product = Product::create($request->all());
      $product->state_active();
      $product->saveOrFail();

      Flash('Create Product Complete!', 'success');
      return redirect('products');
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $product = Product::findOrFail($id);
    $repairs = Repair::where('state_id', 401)->get();

    $products = Product::all()->take(4);
    return view('products.show', compact('product', 'repairs'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function damage($id)
  {
    $product = Product::findOrFail($id);
    $product->update(['state_id' => 304]);

    Flash('Item Update to Damage!', 'success');

    return redirect('products/' . $id);
  }



  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $product = Product::find($id);

    $validator = Validator::make($request->all(), $this->rules());

    if ($validator->fails()) {
      Flash('Validation Fail!', 'danger');
      return redirect('products/' . $product->id . '/edit')
      ->withErrors($validator)
      ->withInput();
    } else {
      $input = $request->all();
      $product->fill($input)->saveOrFail();

      Flash('Update Complete!', 'success');
      return redirect('products');
    }
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    Product::findOrFail($id)->delete();
    return redirect('products');
    Flash('Delete Successful!', 'success');
  }

  public function rules()
  {
    return [
      'name'    => 'required|max:255',
      'serial'  => 'required|max:255',
      'year'    => 'required|numeric',
      'price'   => 'required|numeric',
      'warranty'=> 'required|numeric',
      'date'    => 'required|date',
      'photo' => 'image',
      'category_id' => 'required|numeric',
      'provider_id' => 'required|numeric',
      'city_id' => 'required|numeric',
      'region_id' => 'required|numeric',
      'store_id' => 'required|numeric',
    ];
  }

}
