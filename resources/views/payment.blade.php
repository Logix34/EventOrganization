<!DOCTYPE html>
<html lang="en">
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
        .submit-button {
            margin-top: 10px;
        }
    </style>
</head>
<body class="hold-transition login-page ">
<div class="container">
    <div class="card_body">
        <div class='row'>
            <div class='col-md-4'></div>
            <div class='col-md-4 position-relative'>
                <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
                <form accept-charset="UTF-8"
                      action="{{url('send_payment')}}"
                      class="require-validation"
                      data-cc-on-file="false"
                      data-stripe-publishable-key="pk_test_51Ll4lUE35F1zOmXF46aXN7biknrjFe4lxByzAzjHCnUvZpcxqlb8vmthWNLaILK6sa2QLwGxsuRSkeE96XCQhyeP00O9QnYiZY"
                      id="payment-form" method="post">
                    @csrf
                    <div class='form-row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name on Card</label>
                            <input class='form-control' size='4' name="name" type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label>
                            <input autocomplete='off' class='form-control card-number' name="card_number" size='20' type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-6 form-group cvc required'>
                            <label class='control-label'>CVC</label>
                            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' name="cvc" size='4' type='password'>
                        </div>
                        <div class='col-xs-6 form-group expiration required'>
                            <label class='control-label'>Expiration Month</label>
                            <input class='form-control card-expiry-month' placeholder='MM' size='2' name="expire_month"  type='text'>
                        </div>
                        <div class='col-xs-6 form-group expiration required'>
                            <label class='control-label'>Expiration Year</label>
                            <input class='form-control card-expiry-year' placeholder='YYYY' name="expire_year" size='4' type='text'>
                        </div>
                        <div class='col-xs-6 form-group amount required'>
                            <label class='control-label'>Amount</label>
                            <input class='form-control card-expiry-year' placeholder='$253' value="$254" name="amount" size='' type='text' disabled>
                        </div>
                        <div class='col-xs-12 form-group amount required'>
                            <label class='control-label'>Quantity</label>
                            <input class='form-control card-expiry-year' placeholder='1'  name="quantity" size='' type='number' >
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12 form-group'>
                            <button class='form-control btn btn-success submit-button' type='submit'>Complete Payment</button>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>
                                Please correct the errors and try again.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class='col-md-4'></div>
        </div>
    </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(e.target).closest('form'),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid         = true;

                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault(); // cancel on first error
                    }
                });
            });
        });

        $(function() {
            var $form = $("#payment-form");

            $form.on('submit', function(e) {
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripe_token' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        })
    </script>
</body>
</html>
