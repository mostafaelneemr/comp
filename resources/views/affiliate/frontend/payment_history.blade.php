@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{ translate('Affiliate') }}
                                </h2>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <div class="dashboard-widget text-center green-widget mt-4 c-pointer">
                                <a href="javascript:;" class="d-block">
                                    <i class="fa fa-dollar"></i>
                                    <span
                                        class="d-block title">{{ single_price(Auth::user()->affiliate_user->balance) }}</span>
                                    <span class="d-block sub-title">{{ translate('Affiliate Balance') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="dashboard-widget text-center yellow-widget mt-4 c-pointer"
                                onclick="show_affiliate_withdraw_modal()">
                                <a class="d-block">
                                    <i class="fa fa-plus"></i>

                                    <span class="d-block title">{{ translate('Affiliate Withdraw Request') }}</span>
                                    <span><br></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Affiliate payment history') }}</h5>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ translate('Date') }}</th>
                                        <th>{{ translate('Amount') }}</th>
                                        <th>{{ translate('Payment Method') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($affiliate_payments as $key => $affiliate_payment)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ date('d-m-Y', strtotime($affiliate_payment->created_at)) }}</td>
                                            <td>{{ single_price($affiliate_payment->amount) }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $affiliate_payment->payment_method)) }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="aiz-pagination">
                                {{ $affiliate_payments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="modal fade" id="affiliate_withdraw_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Affiliate Withdraw Request') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <form class="" action="{{ route('affiliate.withdraw_request.store') }}" method="post">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="row">
                            <div class="col-md-3">
                                <label>{{ translate('Amount') }} <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control mb-3" name="amount" min="1"
                                    max="{{ Auth::user()->affiliate_user->balance }}"
                                    placeholder="{{ translate('Amount') }}" required>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit"
                                class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ translate('Confirm') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function copyToClipboard(btn) {
            // var el_code = document.getElementById('referral_code');
            var el_url = document.getElementById('referral_code_url');
            // var c_b = document.getElementById('ref-cp-btn');
            var c_u_b = document.getElementById('ref-cpurl-btn');

            // if(btn == 'code'){
            //     if(el_code != null && c_b != null){
            //         el_code.select();
            //         document.execCommand('copy');
            //         c_b .innerHTML  = c_b.dataset.attrcpy;
            //     }
            // }

            if (btn == 'url') {
                if (el_url != null && c_u_b != null) {
                    el_url.select();
                    document.execCommand('copy');
                    c_u_b.innerHTML = c_u_b.dataset.attrcpy;
                }
            }
        }

        function show_affiliate_withdraw_modal() {
            $('#affiliate_withdraw_modal').modal('show');
        }

    </script>
@endsection
