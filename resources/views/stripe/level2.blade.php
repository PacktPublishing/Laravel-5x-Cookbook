<div class="plan">

    <div class="head">
        <h2>Level 2</h2>

    </div>

    <ul class="item-list">
        <li>Get access to extra features</li>
        <li>Get our Notified of Sales</li>
        <li>Keep the Site going</li>
    </ul>

    <div class="price">
        <h3><span class="symbol">$</span>10</h3>
        <h4>per month</h4>
    </div>

    <form action="/subscribe/comicslevel2" method="POST">
        <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ $public_key }}"
                data-amount="1000"
                data-name="Comics Level 2"
                data-description="Comics Level 2 (10.00)"
                data-image="/128x128.png">
        </script>
    </form>

</div>
