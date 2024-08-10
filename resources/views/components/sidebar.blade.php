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
            <li>
                <a menulabel class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-settings menu-icon"></i><span class="nav-text">Paramètres</span>
                </a>
                <ul aria-expanded="true">
                    <li><a href="{{ route('admin.facturation') }}">Facturation</a></li>
                    <li><a href="{{ route('admin.taux') }}">Taux</a></li>
                    <li><a href="{{ route('admin.zegocloud') }}">Zegocloud</a></li>
                    <li><a href="{{ route('admin.site') }}">Site</a></li>
                    <li><a href="{{ route('admin.app') }}">App Version</a></li>
                    <li><a href="{{ route('admin.log') }}">Logs</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
