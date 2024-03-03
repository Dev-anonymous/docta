<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a menulabel class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="true">
                    <li><a href="{{ route('admin.home') }}">Accueil</a></li>
                    <li><a href="{{ route('admin.client') }}">Clients</a></li>
                    <li><a href="{{ route('admin.docteur') }}">Docteurs</a></li>
                    <li><a href="{{ route('admin.conseils') }}">Conseils</a></li>
                    <li><a href="{{ route('admin.contact') }}">Contact & Feedback</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div>
