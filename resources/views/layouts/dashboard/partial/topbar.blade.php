<style>
    .navbar-right {
        color: #124191;
        font-size: 20px;
        padding: 4px 30px 4px 0px;
    }
</style>

<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ route('home') }}"><img style="height: 25px; width: 100px;" src="{{asset('assets/eerna-logo.png')}}"></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                @role('supadmin')
                <li class="{{ Request::segment(1) === 'users' ? 'active' : null }}">
                    <a href="{{ route('users.index') }}">
                        <span>Users</span>
                    </a>
                </li>
                <li class="{{ Request::segment(1) === 'outlet' ? 'active' : null }}">
                    <a href="{{ route('outlet.index') }}">
                        <span>Store</span>
                    </a>
                </li>
             <!-- <li class="{{ Request::segment(1) === 'txtimport' ? 'active' : null }}">
                    <a href="{{ route('txtimport.index') }}">
                        <span>Import Code</span>
                    </a>
                </li>  -->
                <li class="{{ Request::segment(1) === 'import_imei' ? 'active' : null }}">
                    <a href="{{ route('import_imei.index') }}">
                        <span>Import IMEI</span>
                    </a>
                </li>
                <li class="{{ Request::segment(1) === 'imeichange' ? 'active' : null }}">
                    <a href="{{ route('imeichange.index') }}">
                        <span>IMEI Change</span>
                    </a>
                </li>
                <li class="{{ Request::segment(1) === 'extractfile' ? 'active' : null }}">
                    <a href="{{ route('file_extraction') }}">
                        <span>Data Extraction</span>
                    </a>
                </li>
               <!-- <li class="{{ Request::segment(1) === 'tiers' ? 'active' : null }}">
                    <a href="{{ route('tiers.index') }}">
                        <span>Tiers</span>
                    </a>
                </li>  -->
                <li class="{{ Request::segment(1) === 'service' ? 'active' : null }}">
                    <a href="{{ route('service.index') }}">
                        <span>Service</span>
                    </a>
                </li>
                <li class="{{ Request::segment(1) === 'phone_brands' ? 'active' : null }}">
                    <a href="{{ route('phone_brands.index') }}">
                        <span>Phone Brands</span>
                    </a>
                </li>
                <li class="{{ Request::segment(1) === 'phone_models' ? 'active' : null }}">
                    <a href="{{ route('phone_models.index') }}">
                        <span>Phone Models</span>
                    </a>
                </li>
                <li class="{{ Request::segment(1) === 'fsecure' ? 'active' : null }}">
                    <a href="{{ route('fsecure.index') }}">
                        <span>F-Secure Codes</span>
                    </a>
                </li>
                <!-- <li class="{{ Request::segment(1) === 'bongoTvCodes' ? 'active' : null }}">
                    <a href="{{ route('bongoTvCodes.index') }}">
                        <span>Import Bongo TV Codes</span>
                    </a>
                </li> -->
                <!-- Settings -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <span>Settings</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">SETTINGS</li>
                        <li class="body">
                            <a href="{{ route('change_password.index') }}">
                                <div class="menu-info">
                                    <span>Change Password</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Settings -->
                @endrole
            </ul>
            <!-- <ul class="nav navbar-nav navbar-right">
                <li>Nokia phone insurance and<br>extended warranty plans</li>
            </ul> -->
        </div>
    </div>
</nav>