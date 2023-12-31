@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0 d-inline-block">
                                        {{ translate('Products')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                            <li><a href="{{ route('customer_products.index') }}">{{ translate('Products')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center green-widget text-white mt-4 c-pointer">
                                    <i class="la la-dropbox"></i>
                                    <span class="d-block title heading-3 strong-400">{{ max(0, Auth::user()->remaining_uploads) }}</span>
                                    <span class="d-block sub-title">{{  translate('Remaining Uploads') }}</span>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <a class="dashboard-widget text-center plus-widget mt-4 d-block" href="{{ route('customer_products.create')}}">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{  translate('Add New Product') }}</span>
                                </a>
                            </div>
                            <div class="col-md-4">
                                @php
                                    $customer_package = \App\CustomerPackage::find(Auth::user()->customer_package_id);
                                @endphp
                                <a href="{{ route('customer_packages_list_show') }}" class="dashboard-widget text-center red-widget text-white mt-4 d-block">
                                    @if($customer_package != null)
                                    <img src="{{ uploaded_asset($customer_package->{'logo_'.locale()}) }}" height="44" class="img-fit mw-100 mx-auto mb-1">
                                    <span class="d-block sub-title mb-2">{{ translate('Current Package')}}: {{ $customer_package->{'name_'.locale()} }}</span>
                                    @else
                                        <i class="la la-frown-o mb-1"></i>
                                        <div class="d-block sub-title mb-2">{{ translate('No Package Found')}}</div>
                                    @endif
                                    <div class="btn btn-styled btn-white btn-outline py-1">{{ translate('Upgrade Package')}}</div>
                                </a>
                            </div>
                        </div>

                        <!-- Order history table -->
                        <div class="card no-border mt-4">
                            <div>
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ translate('Name')}}</th>
                                            <th>{{ translate('Price')}}</th>
                                            <th>{{ translate('Available Status')}}</th>
                                            <th>{{ translate('Admin Status')}}</th>
                                            <th>{{ translate('Options')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $key => $product)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td><a href="{{ route('customer.product', $product->{'slug_'.locale()}) }}">{{ $product->{'name_'.locale()} }}</a></td>
                                            <td>{{ single_price($product->unit_price) }}</td>
                                            <td><label class="switch">
                                                <input onchange="update_status(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->status == 1) echo "checked";?> >
                                                <span class="slider round"></span></label>
                                            </td>
                                            <td>
                                                @if ($product->published == '1')
                                                    <span class="ml-2" style="color:green"><strong>{{ translate('PUBLISHED')}}</strong></span>
                                                @else
                                                    <span class="ml-2" style="color:red"><strong>{{ translate('PENDING')}}</strong></span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                        <a href="{{route('customer_products.edit',encrypt($product->id))}}" class="dropdown-item">{{ translate('Edit')}}</a>
                                                        <button onclick="confirm_modal('{{route('customer_products.destroy', $product->id)}}')" class="dropdown-item">{{ translate('Delete')}}</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $products->links() }}
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('script')
    <script type="text/javascript">

        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('customer_products.update.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showFrontendAlert('success', 'Status has been updated successfully');
                }
                else{
                    showFrontendAlert('danger', 'Something went wrong');
                }
            });
        }

    </script>
@endsection
