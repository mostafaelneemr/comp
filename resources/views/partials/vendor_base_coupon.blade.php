<div class="card-header mb-2">
    <h3 class="h6">{{ translate('Specific Vendor Base Coupon') }}</h3>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-from-label" for="coupon_code">{{ translate('Coupon code') }}</label>
    <div class="col-lg-9">
        <input type="text" placeholder="{{ translate('Coupon code') }}" id="coupon_code" name="coupon_code"
            class="form-control" required>
    </div>
</div>
<div class="product-choose-list">
    <div class="product-choose">
        <div class="form-group row">
            <label class="col-lg-3 col-from-label" for="name">{{ translate('Vendor') }}</label>
            <div class="col-lg-9">
                <select name="seller_id" class="form-control product_id aiz-selectpicker" data-live-search="true"
                    data-selected-text-format="count" required>
                    @foreach (\App\Seller::all() as $key => $seller)
                        <option value="{{ $seller->id }}">{{ $seller->user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="start_date">{{ translate('Date') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control aiz-date-range" name="date_range" placeholder="Select Date">
    </div>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-from-label">{{ translate('Discount') }}</label>
    <div class="col-lg-7">
        <input type="number" lang="en" min="0" step="0.01" placeholder="{{ translate('Discount') }}" name="discount"
            class="form-control" required>
    </div>
    <div class="col-lg-2">
        <select class="form-control aiz-selectpicker" name="discount_type">
            <option value="amount">{{ translate('Amount') }}</option>
            <option value="percent">{{ translate('Percent') }}</option>
        </select>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.aiz-date-range').daterangepicker();
        AIZ.plugins.bootstrapSelect('refresh');
    });

</script>
