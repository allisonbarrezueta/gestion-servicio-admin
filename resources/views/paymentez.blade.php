<!DOCTYPE html>
<html>
    <head>
        <title>Gestión Servicios - Checkout</title>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no"
        />
        <script src="https://cdn.paymentez.com/ccapi/sdk/payment_checkout_stable.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous"
        ></script>
        <style>
            .payment-checkout-modal {
                background: white !important;
                padding-top: 0;
            }
            .payment-checkout-modal__close {
                display: none;
            }
        </style>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="p-8">
        <div id="response"></div>
        <script>
            let emitCloseEvent = true;
            const paymentCheckout = new PaymentCheckout.modal({
                client_app_code: 'PMTZ-CAFE-CLIENT',       
                client_app_key: 'xVbpg7Q8XWMQfx7dDyoZ8b1gOHhOn3',
                locale: 'es', //es, pt, en
                env_mode: 'stg',
                onOpen: function () {
                    emitCloseEvent = true;
                    window.ReactNativeWebView.postMessage(JSON.stringify({
                        type: "MODAL_OPEN"
                    }));
                },
                onClose: function () {
                    if(emitCloseEvent) {
                        window.ReactNativeWebView.postMessage(JSON.stringify({
                            type: "MODAL_CLOSE"
                        }));
                    }
                },
                onResponse: function (response) {
                    emitCloseEvent = false;
                    window.ReactNativeWebView.postMessage(JSON.stringify({
                        type: "MODAL_RESPONSE",
                        payload: response
                    }));
                },
            });
        </script>

        <script>
            $(document).ready(function () {
                const user = JSON.parse(window.user);

                function uuid(){
                    var dt = new Date().getTime();
                    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                        var r = (dt + Math.random()*16)%16 | 0;
                        dt = Math.floor(dt/16);
                        return (c=='x' ? r :(r&0x3|0x8)).toString(16);
                    });
                    return uuid;
                }

                const order_reference = uuid();

                modalData = {
                    user_id: `${user.id}`,
                    user_email: user.email,
                    //user_phone: "",
                    order_description: "Orden Gestion Servicios",
                    order_amount: parseFloat(window.total),
                    order_vat: 0,
                    order_reference,
                    order_tax_percentage: 0,
                    order_taxable_amount: 0,
                };

                window.modalData = modalData;
                paymentCheckout.open(modalData);
            });
        </script>
    </body>
</html>
