@extends('layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class=" align-items-center">
            <h1 class="h3">{{ translate('Inhouse Product sale report') }}</h1>
        </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('in_house_sale_report.index') }}" method="GET">
                    <div class="form-group row offset-lg-2">
                        <label class="col-md-3 col-form-label">{{ translate('Sort by Category') }} :</label>
                        <div class="col-md-5">
                            <select id="demo-ease" class="aiz-selectpicker" name="category_id" required>
                                @foreach ($categories as $key => $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="cil-md-2">
                            <button class="btn btn-light" type="submit">{{ translate('Filter') }}</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Product Name') }}</th>
                            <th>{{ translate('Num of Sale') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $product->{'name_' . locale()} }}</td>
                                <td>{{ $product->num_of_sale }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
