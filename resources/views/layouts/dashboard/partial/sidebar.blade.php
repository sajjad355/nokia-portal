@role(['supadmin', 'admin', 'subadmin','insurance'])
<style>
    .sidebar .user-info {
        padding: 45px 15px 12px 15px !important;
        height: 135px !important;
        background-color: #124191;
    }
</style>
@endrole
@role('salescenter')
<style>
    .sidebar .user-info {
        background-color: #124191;
    }
</style>
@endrole

@role(['servicepoint', 'callcenter'])
<style>
    .sidebar .user-info {
        background-color: #124191;
    }
</style>
@endrole

<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <!-- <div class="image">
            <img src="{{asset('assets/dashboard/images/user.png')}}" width="48" height="48" alt="User" />
        </div> -->
        @role(['supadmin', 'admin', 'subadmin','insurance'])
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}
            </div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Sign Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @endrole
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            @role(['salescenter', 'servicepoint', 'callcenter'])
            <li>
                <div class="user-info-for-sales-service">
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}
                        </div>
                        <div class="email">{{Auth::user()->email}}</div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Sign Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            @endrole
            @role('salescenter')
            <li class="{{ Request::segment(2) === 'create' ? 'active' : null }}">
                <a href="{{ route('sales.create') }}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            @endrole
            @role(['servicepoint', 'callcenter'])
            <li class="{{ Request::segment(1) === 'servicepoint' ? 'active' : null }}">
                <a href="{{ route('servicepoint.index') }}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            @endrole
            @role(['admin', 'insurance', 'subadmin'])
            <li>
                <a href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            @endrole
            @role('supadmin')
            <li class="{{ Request::segment(1) === 'sales' ? 'active' : null }}">
                <a href="{{ route('sales.index') }}">
                    <i class="material-icons">phone_iphone</i>
                    <span>Sales Center</span>
                </a>
            </li>
            @endrole
            @role('supadmin')
            <li class="{{ Request::segment(1) === 'servicepoint' ? 'active' : null }}">
                <a href="{{ route('servicepoint.index') }}">
                    <i class="material-icons">phone_iphone</i>
                    <span>Service Point</span>
                </a>
            </li>
            @endrole
            @role('subadmin')
               <!--  <li class="{{ Request::segment(1) === 'servicepoint' ? 'active' : null }}">
                <a href="{{ route('servicepoint.index') }}">
                    <i class="material-icons">phone_iphone</i>
                    <span>Service Point</span>
                </a>
            </li>-->
            @endrole
            @role('supadmin')
            {{-- <li>
                <a href="{{ route('import.index') }}">
            <i class="material-icons">input</i>
            <span>Import Code</span>
            </a>
            </li> --}}
            @endrole
            @role(['supadmin','admin','subadmin'])
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Report</span>
                </a>
                <ul class="ml-menu">
                    <!-- <li class="{{ Request::segment(1) === 'head_office' ? 'active' : null }}">
                        <a href="{{ route('head') }}">Dashboard</a>
                    </li> -->
                    <!-- <li class="{{ Request::segment(1) === 'total_sale' ? 'active' : null }}">
                        <a href="{{ route('total') }}">Total sale report</a>
                    </li> -->
                    <!-- <li class="{{ Request::segment(1) === 'store_wise' ? 'active' : null }}">
                        <a href="{{ route('store') }}">Store wise report</a>
                    </li> -->
                    <li class="{{ Request::segment(1) === 'date_wise' ? 'active' : null }}">
                        <a href="{{ route('date') }}">Date wise report</a>
                    </li>
                                      <li class="{{ Request::segment(1) === 'date_wise_log' ? 'active' : null }}">
                        <a href="{{ route('logdate') }}">Date wise Log</a>
                    </li>
                    <li class="{{ Request::segment(1) === 'imei_wise' ? 'active' : null }}">
                        <a href="{{ route('imei') }}">IMEI wise report</a>
                    </li>
                    @role('supadmin')
                    <li class="{{ Request::segment(1) === 'imei_wise_delete' ? 'active' : null }}">
                        <a href="{{ route('imeidelete') }}">IMEI Delete & Show</a>
                    </li>
                    @endrole
                    <li class="{{ Request::segment(1) === 'date_wise_claim_search' ? 'active' : null }}">
                        <a href="{{ route('date_wise_claim_search') }}">Service report</a>
                    </li>
                    <!-- <li class="{{ Request::segment(1) === 'ins_sales_report' ? 'active' : null }}">
                        <a href="{{ route('ins_sales') }}">Sales report</a>
                    </li> -->
                    <li class="{{ Request::segment(1) === 'ins_service_report' ? 'active' : null }}">
                        <a href="{{ route('ins_service') }}">Service/Claim report</a>
                    </li>
                </ul>
            </li>
            @endrole
            @role('insurance')
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Report</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(1) === 'ins_sales_report' ? 'active' : null }}">
                        <a href="{{ route('ins_sales') }}">Sales report</a>
                    </li>
                    <li class="{{ Request::segment(1) === 'ins_service_report' ? 'active' : null }}">
                        <a href="{{ route('ins_service') }}">Service/Claim report</a>
                    </li>
                    <li class="{{ Request::segment(1) === 'date_wise_claim_search' ? 'active' : null }}">
                        <a href="{{ route('date_wise_claim_search') }}">Date Wise Service report</a>
                    </li>
                </ul>
            </li>
            @endrole
            @role('salescenter')
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Report</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(1) === 'sales' ? 'active' : null }}">
                        <a href="{{ route('sales.index') }}">Sales</a>
                    </li>
                </ul>
            </li>
            @endrole
            @role('servicepoint')
            <li class="{{ Request::segment(1) === 'sales' ? 'active' : null }}">
                <a href="{{ route('sales.create') }}">
                    <i class="material-icons">phone_iphone</i>
                    <span>Sales</span>
                </a>
            </li>
            @endrole
            @role('callcenter')
            <li class="{{ Request::segment(1) === 'sales' ? 'active' : null }}">
                <a href="{{ route('sales.index') }}">
                    <i class="material-icons">phone_iphone</i>
                    <span>Verify Sales</span>
                </a>
            </li>
            @endrole
            @role(['servicepoint', 'callcenter'])
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Report</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(1) === 'date_wise_claim_search' ? 'active' : null }}">
                        <a href="{{ route('date_wise_claim_search') }}">Service report</a>
                    </li>
                </ul>
            </li>
            @endrole
            @role(['admin','insurance','salescenter','servicepoint', 'callcenter'])
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(1) === 'reset_password' ? 'active' : null }}">
                        <a href="{{ route('change_password.index') }}">Change Password</a>
                    </li>
                </ul>
            </li>
            @endrole
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2020 Powered by <a href="https://bd.cppgroup.com/" target="_blank" title="CPP Group Bangladesh">CPP BANGLADESH</a>
        </div>
    </div>
    <!-- #Footer -->

</aside>