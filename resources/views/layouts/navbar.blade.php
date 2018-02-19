<div class="navbar navbar-inverse" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li>
            <a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="fa fa-navicon"></i></a>
        </li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ route('get.home') }}"><i class="fa fa-tachometer"></i> Home</a>
            </li>
            <li>
                <a href="{{ route('get.miners') }}"><i class="fa fa-bitcoin"></i> Miners</a>
            </li>
            <li>
                <a href="{{ route('get.blocks') }}"><i class="fa fa-briefcase"></i> Blocks</a>
            </li>
            <li>
                <a href="{{ route('get.payments') }}"><i class="fa fa-paypal"></i> Payments</a>
            </li>
        </ul>
    </div>
</div>