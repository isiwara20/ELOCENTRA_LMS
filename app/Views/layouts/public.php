<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'ELOCENTRA – English Academy (PVT) LTD', ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'ELOCENTRA – English Academy (PVT) LTD. Learn English. Speak Confidently. Succeed Globally.', ENT_QUOTES, 'UTF-8') ?>">
    <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/favicon.svg">
    <link rel="shortcut icon" href="<?= BASE_URL ?>/favicon.ico">
    <?= csrfMeta() ?>

    <!-- Inline Theme Initializer to prevent flash of wrong theme -->
    <script>
    (function () {
        try {
            var theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        } catch (e) {}
    })();
    </script>

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via local or CDN for rapid utility classes) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        darkMode: ['class', '[data-theme="dark"]'],
        theme: {
            extend: {
                colors: {
                    elocentra: {
                        navy: '#0B132B',
                        dark: '#070D1F',
                        gold: '#E5A93C',
                        amber: '#F59E0B',
                        goldhover: '#D49028',
                        slate: '#1E293B',
                        lightbg: '#F8FAFC'
                    }
                },
                fontFamily: {
                    sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    display: ['Plus Jakarta Sans', 'sans-serif']
                }
            }
        }
    }
    </script>

    <!-- Design System CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= @filemtime(BASE_PATH . '/public/assets/css/style.css') ?: 1 ?>">

    <style>
    :root, [data-theme="light"] {
        --brand-navy: #0B132B;
        --brand-gold: #E5A93C;
        --brand-gold-hover: #D49028;
        --brand-gold-light: rgba(229, 169, 60, 0.15);
        --hero-bg: #0B132B;
        --page-bg: #F8FAFC;
        --card-bg: #FFFFFF;
        --card-border: #E2E8F0;
        --text-main: #0F172A;
        --text-sub: #475569;
        --nav-text: #FFFFFF;
    }

    [data-theme="dark"] {
        --brand-navy: #0B132B;
        --brand-gold: #F59E0B;
        --brand-gold-hover: #E5A93C;
        --brand-gold-light: rgba(245, 158, 11, 0.2);
        --hero-bg: #070D1F;
        --page-bg: #0A0F1D;
        --card-bg: #111A2E;
        --card-border: #1E293B;
        --text-main: #F8FAFC;
        --text-sub: #94A3B8;
        --nav-text: #FFFFFF;
    }

    body {
        background-color: var(--page-bg);
        color: var(--text-main);
        font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, sans-serif;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin: 0;
        padding: 0;
    }

    /* ELOCENTRA Global Academic Navbar */
    .elo-navbar {
        background-color: #0B132B;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        position: sticky;
        top: 0;
        z-index: 50;
        transition: all 0.3s ease;
    }

    [data-theme="dark"] .elo-navbar {
        background-color: #070D1F;
        border-bottom-color: rgba(229, 169, 60, 0.15);
    }

    .elo-navbar.scrolled {
        background-color: rgba(11, 19, 43, 0.95);
        backdrop-filter: blur(12px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
    }

    .nav-link-elo {
        color: rgba(255, 255, 255, 0.85);
        font-weight: 500;
        font-size: 0.9375rem;
        padding: 0.5rem 0.875rem;
        border-radius: 9999px;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .nav-link-elo:hover {
        color: #E5A93C;
        background-color: rgba(255, 255, 255, 0.06);
    }

    .nav-link-elo.active {
        color: #E5A93C;
        font-weight: 600;
    }

    /* Gold Buttons */
    .btn-gold {
        background: linear-gradient(135deg, #E5A93C 0%, #D49028 100%);
        color: #0B132B !important;
        font-weight: 700;
        border-radius: 9999px;
        padding: 0.55rem 1.35rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(229, 169, 60, 0.35);
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(229, 169, 60, 0.45);
        background: linear-gradient(135deg, #F59E0B 0%, #E5A93C 100%);
        color: #070D1F !important;
    }

    .btn-outline-gold {
        border: 1.5px solid #E5A93C;
        color: #FFFFFF !important;
        font-weight: 600;
        border-radius: 9999px;
        padding: 0.55rem 1.35rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: transparent;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .btn-outline-gold:hover {
        background: rgba(229, 169, 60, 0.15);
        color: #E5A93C !important;
        transform: translateY(-2px);
    }

    /* Theme Toggle */
    .theme-toggle-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #E5A93C;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .theme-toggle-btn:hover {
        background: rgba(229, 169, 60, 0.2);
        transform: rotate(15deg);
    }

    /* Academic Cards */
    .elo-card {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .elo-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        border-color: #E5A93C;
    }

    [data-theme="dark"] .elo-card:hover {
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.4);
        border-color: #F59E0B;
    }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Header / Navbar -->
    <header class="elo-navbar" id="elocentraNav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <a href="<?= BASE_URL ?>/" class="flex items-center gap-3 group">
                    <img src="<?= BASE_URL ?>/assets/img/brand/elocentra-logo-white.svg" alt="ELOCENTRA – English Academy (PVT) LTD" class="h-12 w-auto transition-transform group-hover:scale-[1.02]">
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="<?= BASE_URL ?>/" class="nav-link-elo <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Home</a>
                    <a href="<?= BASE_URL ?>/about" class="nav-link-elo <?= ($activePage ?? '') === 'about' ? 'active' : '' ?>">About Us</a>
                    <a href="<?= BASE_URL ?>/courses" class="nav-link-elo <?= ($activePage ?? '') === 'courses' ? 'active' : '' ?>">Courses</a>
                    <a href="<?= BASE_URL ?>/contact" class="nav-link-elo <?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>">Contact Us</a>
                </nav>

                <!-- Desktop Action Buttons -->
                <div class="hidden md:flex items-center space-x-3">
                    <?php if (function_exists('session_get') && session_get('user_id')): ?>
                        <?php 
                            $userType = session_get('user_type');
                            $dashUrl = ($userType === 'student') ? BASE_URL . '/my/home' : BASE_URL . '/dashboard';
                        ?>
                        <a href="<?= $dashUrl ?>" class="btn-outline-gold text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </a>
                        <a href="<?= BASE_URL ?>/logout" class="nav-link-elo text-xs">Logout</a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>/login" class="nav-link-elo text-sm font-semibold">Login</a>
                        <a href="<?= BASE_URL ?>/register" class="btn-gold text-sm font-bold">Register</a>
                    <?php endif; ?>

                    <!-- Theme Toggle Switch -->
                    <button type="button" class="theme-toggle-btn" id="themeSwitchBtn" aria-label="Toggle Theme" title="Switch Theme">
                        <svg class="w-5 h-5 theme-moon" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg class="w-5 h-5 theme-sun hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>

                <!-- Mobile Menu Toggle Button -->
                <div class="flex items-center md:hidden gap-2">
                    <button type="button" class="theme-toggle-btn" id="mobileThemeSwitchBtn" aria-label="Toggle Theme">
                        <svg class="w-5 h-5 theme-moon" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg class="w-5 h-5 theme-sun hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
                    </button>
                    <button type="button" class="text-white p-2 rounded-lg hover:bg-white/10" id="mobileMenuBtn" aria-label="Toggle mobile menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div class="md:hidden hidden pb-6 pt-2 border-t border-white/10" id="mobileNavMenu">
                <div class="flex flex-col space-y-2">
                    <a href="<?= BASE_URL ?>/" class="nav-link-elo <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Home</a>
                    <a href="<?= BASE_URL ?>/about" class="nav-link-elo <?= ($activePage ?? '') === 'about' ? 'active' : '' ?>">About Us</a>
                    <a href="<?= BASE_URL ?>/courses" class="nav-link-elo <?= ($activePage ?? '') === 'courses' ? 'active' : '' ?>">Courses</a>
                    <a href="<?= BASE_URL ?>/contact" class="nav-link-elo <?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>">Contact Us</a>
                    <div class="pt-4 flex flex-col gap-2">
                        <?php if (function_exists('session_get') && session_get('user_id')): ?>
                            <a href="<?= $dashUrl ?? BASE_URL . '/dashboard' ?>" class="btn-gold w-full text-center">Dashboard</a>
                            <a href="<?= BASE_URL ?>/logout" class="btn-outline-gold w-full text-center">Logout</a>
                        <?php else: ?>
                            <a href="<?= BASE_URL ?>/login" class="btn-outline-gold w-full text-center">Login</a>
                            <a href="<?= BASE_URL ?>/register" class="btn-gold w-full text-center">Register</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Flash Notifications -->
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <?php include __DIR__ . '/../components/flash-messages.php'; ?>
            </div>
        <?php endif; ?>

        <?= $content ?>
    </main>

    <!-- Academic Footer -->
    <footer class="bg-[#070D1F] text-slate-300 border-t border-slate-800 relative overflow-hidden">
        <!-- Subtle Top Gold Accent Line -->
        <div class="h-1 w-full bg-gradient-to-r from-transparent via-[#E5A93C] to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Column 1: Academy Info -->
                <div class="space-y-4">
                    <img src="<?= BASE_URL ?>/assets/img/brand/elocentra-logo-white.svg" alt="ELOCENTRA" class="h-10 w-auto">
                    <p class="text-xs uppercase tracking-widest text-[#E5A93C] font-semibold">
                        Learn English. Speak Confidently. Succeed Globally.
                    </p>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        ELOCENTRA – English Academy (PVT) LTD is a premier academic institution committed to equipping students and professionals with world-class language proficiency, communication confidence, and career competence.
                    </p>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-5 border-l-2 border-[#E5A93C] pl-3">Navigation</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="<?= BASE_URL ?>/" class="text-slate-400 hover:text-[#E5A93C] transition-colors">Home</a></li>
                        <li><a href="<?= BASE_URL ?>/about" class="text-slate-400 hover:text-[#E5A93C] transition-colors">About Us</a></li>
                        <li><a href="<?= BASE_URL ?>/courses" class="text-slate-400 hover:text-[#E5A93C] transition-colors">Available Courses</a></li>
                        <li><a href="<?= BASE_URL ?>/contact" class="text-slate-400 hover:text-[#E5A93C] transition-colors">Contact Academy</a></li>
                        <li><a href="<?= BASE_URL ?>/register" class="text-slate-400 hover:text-[#E5A93C] transition-colors">Student Registration</a></li>
                        <li><a href="<?= BASE_URL ?>/login" class="text-slate-400 hover:text-[#E5A93C] transition-colors">Portal Login</a></li>
                    </ul>
                </div>

                <!-- Column 3: Subject Areas -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-5 border-l-2 border-[#E5A93C] pl-3">Subject Areas</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="<?= BASE_URL ?>/courses?subject_area=1" class="hover:text-[#E5A93C] transition-colors">English & Communication</a></li>
                        <li><a href="<?= BASE_URL ?>/courses?subject_area=2" class="hover:text-[#E5A93C] transition-colors">Psychology & Behavior</a></li>
                        <li><a href="<?= BASE_URL ?>/courses?subject_area=3" class="hover:text-[#E5A93C] transition-colors">Business Accounting</a></li>
                        <li><a href="<?= BASE_URL ?>/courses?subject_area=4" class="hover:text-[#E5A93C] transition-colors">Professional Development</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact & Campus -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-5 border-l-2 border-[#E5A93C] pl-3">Academy Campus</h4>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-[#E5A93C] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>No. 123, Education Lane, Colombo, Sri Lanka</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-[#E5A93C] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>+94 77 123 4567</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-[#E5A93C] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>info@elocentra.academy</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-[#E5A93C] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Mon - Fri: 9.00 AM - 5.00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="border-t border-slate-800/80 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; <?= date('Y') ?> ELOCENTRA – English Academy (PVT) LTD. All Rights Reserved.</p>
                <p class="text-slate-400 font-medium">"Learn English. Speak Confidently. Succeed Globally."</p>
            </div>
        </div>
    </footer>

    <!-- Universal Scripts & Theme Switcher Logic -->
    <script>
    (function() {
        // Theme Toggle Functionality
        function updateThemeIcons(theme) {
            var moons = document.querySelectorAll('.theme-moon');
            var suns = document.querySelectorAll('.theme-sun');
            if (theme === 'dark') {
                moons.forEach(function(m) { m.classList.add('hidden'); });
                suns.forEach(function(s) { s.classList.remove('hidden'); });
            } else {
                moons.forEach(function(m) { m.classList.remove('hidden'); });
                suns.forEach(function(s) { s.classList.add('hidden'); });
            }
        }

        function toggleTheme() {
            var currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            var nextTheme = (currentTheme === 'dark') ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', nextTheme);
            try {
                localStorage.setItem('theme', nextTheme);
            } catch (e) {}
            updateThemeIcons(nextTheme);
        }

        var btnDesktop = document.getElementById('themeSwitchBtn');
        var btnMobile = document.getElementById('mobileThemeSwitchBtn');
        if (btnDesktop) btnDesktop.addEventListener('click', toggleTheme);
        if (btnMobile) btnMobile.addEventListener('click', toggleTheme);

        var currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
        updateThemeIcons(currentTheme);

        // Mobile Nav Toggle
        var menuBtn = document.getElementById('mobileMenuBtn');
        var navMenu = document.getElementById('mobileNavMenu');
        if (menuBtn && navMenu) {
            menuBtn.addEventListener('click', function() {
                navMenu.classList.toggle('hidden');
            });
        }

        // Navbar Scroll Blur Effect
        window.addEventListener('scroll', function() {
            var nav = document.getElementById('elocentraNav');
            if (nav) {
                if (window.scrollY > 20) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            }
        });
    })();
    </script>
</body>
</html>
