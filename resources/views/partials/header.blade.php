<header class="header-area">
    <div class="emading-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container-fluid">
                <nav class="classy-navbar" id="emadingNav" style="display: flex; align-items: center;">
                    <a href="{{ url('/') }}" class="nav-brand" style="margin-right: 50px; display: flex; align-items: center;">
                        <i class="fas fa-newspaper" style="font-size: 2rem; color: #ff4757; margin-right: 15px;"></i>
                        <span style="font-size: 1.8rem; font-weight: 700; color: #2c3e50;">E-Mading</span>
                    </a>
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <div class="classy-menu" style="flex: 1;">
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <div class="classynav">
                            <ul style="font-size: 18px; font-weight: 600;">
                                <li><a href="{{ route('home') }}" style="padding: 0 25px;">Beranda</a></li>
                                @auth
                                <li><a href="{{ route('dashboard') }}" style="padding: 0 25px;">Dashboard</a></li>
                                <li><a href="{{ route('artikel.create') }}" style="padding: 0 25px;">Tulis Artikel</a></li>
                                @endauth
                                
                                <!-- Search Form -->
                                <li style="margin-left: auto; margin-right: 20px;">
                                    <form method="GET" action="{{ route('artikel.search') }}" style="display: flex; align-items: center;">
                                        <div class="search-container" style="position: relative;">
                                            <input type="text" 
                                                   name="q" 
                                                   placeholder="Cari artikel..." 
                                                   value="{{ request('q') }}"
                                                   style="padding: 8px 40px 8px 15px; 
                                                          border: 2px solid #ddd; 
                                                          border-radius: 25px; 
                                                          width: 250px; 
                                                          font-size: 14px;
                                                          transition: all 0.3s ease;">
                                            <button type="submit" 
                                                    style="position: absolute; 
                                                           right: 5px; 
                                                           top: 50%; 
                                                           transform: translateY(-50%); 
                                                           background: #ff4757; 
                                                           border: none; 
                                                           border-radius: 50%; 
                                                           width: 30px; 
                                                           height: 30px; 
                                                           color: white; 
                                                           cursor: pointer;
                                                           display: flex;
                                                           align-items: center;
                                                           justify-content: center;">
                                                <i class="fas fa-search" style="font-size: 12px;"></i>
                                            </button>
                                        </div>
                                    </form>
                                </li>
                                
                                @auth
                                <!-- Notification Bell -->
                                <li style="margin-right: 20px;">
                                    <div class="notification-container" style="position: relative;">
                                        <a href="{{ route('notifications.index') }}" 
                                           style="padding: 10px; 
                                                  color: #333; 
                                                  text-decoration: none;
                                                  position: relative;
                                                  display: flex;
                                                  align-items: center;">
                                            <i class="fas fa-bell" style="font-size: 18px;"></i>
                                            <span id="notification-badge" 
                                                  style="position: absolute; 
                                                         top: 0; 
                                                         right: 0; 
                                                         background: #ff4757; 
                                                         color: white; 
                                                         border-radius: 50%; 
                                                         width: 18px; 
                                                         height: 18px; 
                                                         font-size: 10px; 
                                                         display: none;
                                                         align-items: center;
                                                         justify-content: center;"></span>
                                        </a>
                                    </div>
                                </li>
                                
                                <li>
                                    <a href="#" style="padding: 0 25px;">{{ Auth::user()->nama }}</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('notifications.index') }}">Notifikasi</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" style="background: none; border: none; color: inherit; font: inherit; cursor: pointer; padding: 0;">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @else
                                <li><a href="{{ route('login') }}" style="padding: 0 25px;">Masuk</a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<style>
.search-container input:focus {
    border-color: #ff4757 !important;
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 71, 87, 0.1);
}

.search-container button:hover {
    background: #e63946 !important;
    transform: translateY(-50%) scale(1.1);
}

.notification-container a:hover {
    color: #ff4757 !important;
}

@media (max-width: 768px) {
    .search-container input {
        width: 200px;
    }
}

@media (max-width: 576px) {
    .search-container input {
        width: 150px;
        font-size: 12px;
    }
}
</style>

@auth
<script>
// Check for unread notifications
function updateNotificationBadge() {
    fetch('{{ route("notifications.unreadCount") }}')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('notification-badge');
            if (data.count > 0) {
                badge.textContent = data.count > 9 ? '9+' : data.count;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        });
}

// Update badge on page load
document.addEventListener('DOMContentLoaded', updateNotificationBadge);

// Update badge every 30 seconds
setInterval(updateNotificationBadge, 30000);
</script>
@endauth