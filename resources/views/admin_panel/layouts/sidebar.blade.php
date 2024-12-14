<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('user.list') }}"><i class="fa fa-users"></i> Users <span
                        class="fa fa-chevron-down"></span></a>
            </li>


            <li><a><i class="fas fa-th-large"></i> Categories <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('category.index') }}">List</a></li>
                </ul>
            </li>

            <li><a><i class="fas fa-stream"></i> Sub Categories <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('subcategory.index') }}">List</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-product-hunt "></i> Products <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('product.create') }}">Create</a></li>
                    <li><a href="{{ route('product.list') }}">List</a></li>
                </ul>
            </li>
            <li><a><i class="fas fa-gift "></i> Speacial Offers <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('offer.create') }}">Create</a></li>
                    <li><a href="{{ route('offer.list') }}">List</a></li>
                </ul>
            </li>
        </ul>
    </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
