<div class="pricing-tables">

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="plan">

                <div class="head">
                    <h2>Non Subscription Purchase</h2>

                </div>

                <ul class="item-list">
                    <li>2 min segment</li>
                    <li>We talk from experience</li>
                    <li>Happens at the start of the show or before Deep Dive of Show</li>
                </ul>

                <div class="price">
                    <h3><span class="symbol">$</span>225</h3>
                    <h4>per show</h4>
                </div>

                <form action="/sponsor/quantity" method="POST">
                    <script
                            src="https://checkout.stripe.com/checkout.js"
                            class="stripe-button"
                            data-key="{{ $public_key }}"
                            data-amount="22500"
                            data-name="Buying in Quantity"
                            data-description="1 Show x Quantity ($225.00) each"
                            data-image="/128x128.png">
                    </script>
                </form>

            </div>
        </div>

    </div> <!-- row-->

</div> <!-- pricing-tables -->
