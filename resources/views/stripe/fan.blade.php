<div class="plan">

    <div class="head">
        <h2>Fan!</h2>

    </div>

    <ul class="item-list">
        <li>Keep the site alive!</li>
        <li>&nbsp;</li>
        <li>&nbsp;</li>
    </ul>

    <div class="price">
        <h3><span class="symbol">$</span>1</h3>
        <h4>per month</h4>
    </div>

    <form action="/subscribe/comicsfan" method="POST">
        <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ $public_key }}"
                data-amount="100"
                data-name="Fan"
                data-description="Fan ($1.00)"
                data-image="/128x128.png">
        </script>
    </form>

</div>