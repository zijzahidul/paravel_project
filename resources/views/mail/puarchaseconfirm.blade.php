@component('mail::message')
# E-Commerce : Paravel

@component('mail::panel')
You Buy this product
@endcomponent


@component('mail::table')

|SL. No|Product Name|Product Price  
|-----|:------------:| --------:|
@foreach ($final_details_info as $single_data)
| ------ {{ $loop->index + 1 }}  ------ | --- {{ $single_data->product->product_name }} --- | --------------- {{ $single_data->product_price }} ---- 
@endforeach

@endcomponent

@component('mail::button', ['url' => 'www.faceboook.com'])
Zij
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
