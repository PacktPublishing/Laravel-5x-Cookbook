


@foreach($subscriptions as $subscription)

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Subscriptions: {{ \App\Plans::returnDisplayName($subscription['stripe_plan']) }}
                    <form action="{{ route('user.membership.swap') }}" method="POST" style="display: inline;"
                          onsubmit="if(confirm('Are you sure you want to change your level?')) { return true } else {return false };">
                        <input type="hidden" name="current" value="{{ $subscription['stripe_plan'] }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-xs btn-info"><i class="fa fa-thumbs-up"></i>
                            &nbsp;Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endforeach


