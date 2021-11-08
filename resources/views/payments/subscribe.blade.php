@extends('base.auth_user_index')

@section('content')
    @php
        header("Access-Control-Allow-Origin: *");
    @endphp
    <div class="card card-outline card-warning col-md-5">
        <div class="card-header text-center">
            <h3 class="put-black"><a href="/" class="h3">Industrialising Africa<br><small><strong>Magazine</strong></small></a></h3>
            <h4 class="text-center">Subscription Payment checkout</h4>
        </div>

        <div class="card-body">

            <div class="payment- text-center">
                <h5>Click the button below</h5>
                <button class="awesome-checkout-button"></button>
                <script>
                    var app_ = @json($my_data);
                    app_['payerClientCode'] = "";
                    app_['successRedirectUrl'] = "{{ url('industrialising-africa/success') }}";
                    app_['failRedirectUrl'] = "{{ url('user/register') }}";
                    app_['pendingRedirectUrl'] = "{{ url('user/register') }}";

                </script>
                <script type="text/javascript">
                    const payload = app_;
                    console.log(payload);
                    const checkoutType = 'redirect'; // or 'modal'

                    // Render the checkout button
                    Tingg.renderPayButton({
                        className: 'awesome-checkout-button',
                        checkoutType
                    });

                    document
                        .querySelector('.awesome-checkout-button')
                        .addEventListener('click', function(){
                            //Call the encryption URL to encrypt the params and render checkout
                            function encrypt(){
                                return fetch(
                                    '{{ url('subscribe/encryption') }}',
                                    {
                                        method: 'POST',
                                        body: JSON.stringify(payload),
                                        mode: 'no-cors',
                                        headers: {
                                            "Content-Type": "application/json",
                                            'Access-Control-Allow-Origin':'*',
                                            'Accept': "Access-Control-Allow-Origin: *",
                                            "X-CSRF-Token":"{{ csrf_token() }}",
                                        },
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                        }
                                    }).then(response => response.json())//.then(text => console.log(text))
                            }
                            encrypt().then(response => {
                                    console.log(response);
                                    // Render the checkout page on click event
                                    Tingg.renderCheckout({
                                        checkoutType,
                                        merchantProperties: response,
                                    });
                                }
                            )
                                .catch(error => console.log(error));
                        });
                </script>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

@endsection
