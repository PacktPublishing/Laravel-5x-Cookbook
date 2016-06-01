<div class="plan">

    <div class="head">
        <h2>Level 1</h2>

    </div>

    <ul class="item-list">
        <li>Keep the site going</li>
        <li>Get our Newsletter</li>
        <li>&nbsp;</li>
    </ul>

    <div class="price">
        <h3><span class="symbol">$</span>5</h3>
        <h4>per month</h4>
    </div>

    <form action="/subscribe/comicslevel1" method="POST">
        <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ $public_key }}"
                data-amount="500"
                data-name="Comics Level 1"
                data-description="Comics Level 1 ($5.00)"
                data-image="/128x128.png">
        </script>
    </form>

</div>