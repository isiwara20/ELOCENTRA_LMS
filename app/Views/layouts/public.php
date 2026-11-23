<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'ELOCENTRA – English Academy (PVT) LTD', ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'ELOCENTRA – English Academy (PVT) LTD. Learn English. Speak Confidently. Succeed Globally.', ENT_QUOTES, 'UTF-8') ?>">
    <link rel="shortcut icon" href="<?= BASE_URL ?>/public/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/public/assets/img/brand/elocentra-icon.png">
    <?= csrfMeta() ?>

    <!-- Inline Theme Initializer to prevent theme flash -->
    <script>
    (function () {
        try {
            var theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        } catch (e) {}
    })();
    </script>

    <!-- Google Fonts: Outfit (Headings) + Plus Jakarta Sans & Inter (UI/Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        darkMode: ['class', '[data-theme="dark"]'],
        theme: {
            extend: {
                colors: {
                    elocentra: {
                        navy: '#0B132B',
                        dark: '#060B18',
                        gold: '#E5A93C',
                        amber: '#F59E0B',
                        goldhover: '#D49028',
                        slate: '#1E293B',
                        lightbg: '#F8FAFC'
                    }
                },
                fontFamily: {
                    sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    heading: ['Outfit', 'sans-serif']
                }
            }
        }
    }
    </script>

    <!-- Design System CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= @filemtime(BASE_PATH . '/public/assets/css/style.css') ?: 2 ?>">

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
        --topbar-bg: #070D1F;
        --topbar-border: rgba(255, 255, 255, 0.08);
        --header-bg: rgba(11, 19, 43, 0.95);
        --header-scrolled: rgba(11, 19, 43, 0.88);
        --footer-bg: #070D1F;
        --footer-border: #1E293B;
    }

    [data-theme="dark"] {
        --brand-navy: #0B132B;
        --brand-gold: #F59E0B;
        --brand-gold-hover: #E5A93C;
        --brand-gold-light: rgba(245, 158, 11, 0.2);
        --hero-bg: #040814;
        --page-bg: #060B18;
        --card-bg: #0E1629;
        --card-border: #1E293B;
        --text-main: #F8FAFC;
        --text-sub: #94A3B8;
        --nav-text: #FFFFFF;
        --topbar-bg: #03060E;
        --topbar-border: rgba(229, 169, 60, 0.15);
        --header-bg: rgba(6, 11, 24, 0.95);
        --header-scrolled: rgba(6, 11, 24, 0.85);
        --footer-bg: #040711;
        --footer-border: #151F33;
    }

    body {
        background-color: var(--page-bg);
        color: var(--text-main);
        font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, sans-serif;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin: 0;
        padding: 0;
    }

    h1, h2, h3, h4, h5, h6, .font-heading {
        font-family: 'Outfit', sans-serif;
    }

    /* Top Academy Contact & Slogan Bar */
    .elo-topbar {
        background-color: var(--topbar-bg);
        border-bottom: 1px solid var(--topbar-border);
        color: #94A3B8;
        font-size: 0.775rem;
        transition: all 0.3s ease;
    }

    /* ELOCENTRA Dynamic Header with Transparent on Scroll Effect */
    .elo-navbar {
        background-color: var(--header-bg);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        position: sticky;
        top: 0;
        z-index: 50;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: background-color 0.35s ease, backdrop-filter 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
    }

    /* Smooth glassmorphic transparency transition on scroll */
    .elo-navbar.scrolled {
        background-color: var(--header-scrolled) !important;
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border-bottom-color: rgba(229, 169, 60, 0.28) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    }

    .nav-link-elo {
        color: rgba(255, 255, 255, 0.85);
        font-weight: 500;
        font-size: 0.9375rem;
        padding: 0.5rem 0.95rem;
        border-radius: 9999px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .nav-link-elo:hover {
        color: #E5A93C;
        background-color: rgba(255, 255, 255, 0.08);
    }

    .nav-link-elo.active {
        color: #E5A93C;
        font-weight: 700;
        background-color: rgba(229, 169, 60, 0.12);
        box-shadow: inset 0 0 0 1px rgba(229, 169, 60, 0.3);
    }

    /* Buttons */
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
        box-shadow: 0 6px 20px rgba(229, 169, 60, 0.5);
        background: linear-gradient(135deg, #F59E0B 0%, #E5A93C 100%);
        color: #070D1F !important;
    }

    .btn-outline-gold {
        border: 1.5px solid #E5A93C;
        color: #FFFFFF !important;
        font-weight: 600;
        border-radius: 9999px;
        padding: 0.5rem 1.25rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: transparent;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .btn-outline-gold:hover {
        background: rgba(229, 169, 60, 0.18);
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
        border: 1px solid rgba(255, 255, 255, 0.15);
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .theme-toggle-btn:hover {
        background: rgba(229, 169, 60, 0.22);
        transform: rotate(20deg);
        border-color: #E5A93C;
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
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.09);
        border-color: #E5A93C;
    }

    [data-theme="dark"] .elo-card:hover {
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.5);
        border-color: #F59E0B;
    }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Top Academy Information Bar -->
    <aside class="elo-topbar py-2 px-4 sm:px-6 lg:px-8 relative z-50">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <!-- Left: Contact Details (Strictly No Physical Address) -->
            <div class="flex items-center flex-wrap gap-4 text-xs">
                <a href="mailto:eloengaca@gmail.com" class="flex items-center gap-1.5 hover:text-[#E5A93C] transition-colors">
                    <svg class="w-3.5 h-3.5 text-[#E5A93C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>eloengaca@gmail.com</span>
                </a>
                <span class="hidden sm:inline text-slate-700">|</span>
                <a href="tel:0777354892" class="flex items-center gap-1.5 hover:text-[#E5A93C] transition-colors">
                    <svg class="w-3.5 h-3.5 text-[#E5A93C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>077 7354892</span>
                </a>
                <span class="text-slate-700">/</span>
                <a href="tel:0772278069" class="hover:text-[#E5A93C] transition-colors">077 2278069</a>
            </div>

            <!-- Right: Relocated Official Slogan Badge -->
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-amber-400/10 border border-amber-400/25 text-[#E5A93C] font-semibold text-[11px] tracking-wide">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    Learn English. Speak Confidently. Succeed Globally.
                </span>
            </div>
        </div>
    </aside>

    <!-- Main Header / Navbar (Transparent on Scroll) -->
    <header class="elo-navbar" id="elocentraNav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-4">
                <!-- Brand / Logo -->
                <a href="<?= BASE_URL ?>/" class="flex items-center gap-3 shrink-0 group">
                    <img src="<?= BASE_URL ?>/public/assets/img/brand/elocentra-logo-transparent.png" 
                         alt="ELOCENTRA – English Academy (PVT) LTD" 
                         class="h-12 sm:h-14 w-auto object-contain transition-transform group-hover:scale-105 filter drop-shadow">
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="<?= BASE_URL ?>/" class="nav-link-elo <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">
                        <svg class="w-4 h-4 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Home</span>
                    </a>
                    <a href="<?= BASE_URL ?>/about" class="nav-link-elo <?= ($activePage ?? '') === 'about' ? 'active' : '' ?>">
                        <svg class="w-4 h-4 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>About Us</span>
                    </a>
                    <a href="<?= BASE_URL ?>/courses" class="nav-link-elo <?= ($activePage ?? '') === 'courses' ? 'active' : '' ?>">
                        <svg class="w-4 h-4 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <span>Courses</span>
                    </a>
                    <a href="<?= BASE_URL ?>/contact" class="nav-link-elo <?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>">
                        <svg class="w-4 h-4 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Contact Us</span>
                    </a>
                </nav>

                <!-- Modern Header Course Search Bar -->
                <form action="<?= BASE_URL ?>/courses" method="GET" class="relative hidden md:block w-48 xl:w-60">
                    <input type="text" name="search" placeholder="Search courses..." 
                           value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                           class="w-full pl-9 pr-4 py-2 text-xs rounded-full bg-white/10 text-white placeholder-slate-300 border border-white/20 focus:outline-none focus:border-[#E5A93C] focus:bg-white/15 focus:ring-2 focus:ring-[#E5A93C]/30 transition-all">
                    <svg class="w-4 h-4 text-slate-300 absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </form>

                <!-- Action Buttons & Theme Switcher -->
                <div class="hidden sm:flex items-center space-x-2.5">
                    <?php if (function_exists('session_get') && session_get('user_id')): ?>
                        <?php 
                            $userType = session_get('user_type');
                            $dashUrl = ($userType === 'student') ? BASE_URL . '/my/home' : BASE_URL . '/dashboard';
                        ?>
                        <a href="<?= $dashUrl ?>" class="btn-outline-gold text-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            <span>Dashboard</span>
                        </a>
                        <a href="<?= BASE_URL ?>/logout" class="nav-link-elo text-xs">Logout</a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>/login" class="nav-link-elo text-sm font-semibold">Login</a>
                        <a href="<?= BASE_URL ?>/register" class="btn-gold text-sm font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            <span>Register</span>
                        </a>
                    <?php endif; ?>

                    <!-- Theme Toggle Switch -->
                    <button type="button" class="theme-toggle-btn" id="themeSwitchBtn" aria-label="Toggle Theme" title="Switch Theme">
                        <svg class="w-4 h-4 theme-moon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg class="w-4 h-4 theme-sun hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                </div>

                <!-- Mobile Menu & Theme Buttons -->
                <div class="flex items-center sm:hidden gap-2">
                    <button type="button" class="theme-toggle-btn" id="mobileThemeSwitchBtn" aria-label="Toggle Theme">
                        <svg class="w-4 h-4 theme-moon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg class="w-4 h-4 theme-sun hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                    <button type="button" class="text-white p-2 rounded-xl hover:bg-white/10" id="mobileMenuBtn" aria-label="Toggle mobile menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div class="lg:hidden hidden pb-6 pt-3 border-t border-white/10" id="mobileNavMenu">
                <form action="<?= BASE_URL ?>/courses" method="GET" class="relative mb-3">
                    <input type="text" name="search" placeholder="Search courses..." 
                           class="w-full pl-9 pr-4 py-2 text-xs rounded-full bg-white/10 text-white placeholder-slate-300 border border-white/20 focus:outline-none focus:border-[#E5A93C]">
                    <svg class="w-4 h-4 text-slate-300 absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </form>

                <div class="flex flex-col space-y-1.5">
                    <a href="<?= BASE_URL ?>/" class="nav-link-elo <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Home</a>
                    <a href="<?= BASE_URL ?>/about" class="nav-link-elo <?= ($activePage ?? '') === 'about' ? 'active' : '' ?>">About Us</a>
                    <a href="<?= BASE_URL ?>/courses" class="nav-link-elo <?= ($activePage ?? '') === 'courses' ? 'active' : '' ?>">Courses</a>
                    <a href="<?= BASE_URL ?>/contact" class="nav-link-elo <?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>">Contact Us</a>
                    <div class="pt-3 flex flex-col gap-2">
                        <?php if (function_exists('session_get') && session_get('user_id')): ?>
                            <a href="<?= $dashUrl ?? BASE_URL . '/dashboard' ?>" class="btn-gold w-full text-center">Dashboard</a>
                            <a href="<?= BASE_URL ?>/logout" class="btn-outline-gold w-full text-center">Logout</a>
                        <?php else: ?>
                            <a href="<?= BASE_URL ?>/login" class="btn-outline-gold w-full text-center">Login</a>
                            <a href="<?= BASE_URL ?>/register" class="btn-gold w-full text-center">Register as Student</a>
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

    <!-- Information Bar Located Above the Footer -->
    <section class="py-10 bg-slate-100 dark:bg-[#070D1F] border-t border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Highlight 1 -->
                <div class="flex items-start gap-4 p-4 rounded-xl bg-white dark:bg-[#0E1629] border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Accredited Curricula</h4>
                        <p class="text-[12px] text-slate-600 dark:text-slate-400 mt-1 leading-snug">Internationally benchmarked English, Psychology, and Business communication programmes.</p>
                    </div>
                </div>

                <!-- Highlight 2 -->
                <div class="flex items-start gap-4 p-4 rounded-xl bg-white dark:bg-[#0E1629] border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Expert Lecturers</h4>
                        <p class="text-[12px] text-slate-600 dark:text-slate-400 mt-1 leading-snug">Guided by senior university lecturers, corporate consultants, and TESOL-certified educators.</p>
                    </div>
                </div>

                <!-- Highlight 3 -->
                <div class="flex items-start gap-4 p-4 rounded-xl bg-white dark:bg-[#0E1629] border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">DirectPay & Bank Transfer</h4>
                        <p class="text-[12px] text-slate-600 dark:text-slate-400 mt-1 leading-snug">Instant online enrollment via DirectPay (Visa, Mastercard, LankaQR) or bank deposit.</p>
                    </div>
                </div>

                <!-- Highlight 4 -->
                <div class="flex items-start gap-4 p-4 rounded-xl bg-white dark:bg-[#0E1629] border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Dedicated Student Care</h4>
                        <p class="text-[12px] text-slate-600 dark:text-slate-400 mt-1 leading-snug">Direct WhatsApp & telephone assistance: <strong>077 7354892</strong> / <strong>077 2278069</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Academic Footer (Slogan Removed, Strictly No Physical Address) -->
    <footer class="bg-[#050A17] text-slate-300 border-t border-slate-800/80 relative overflow-hidden">
        <!-- Subtle Gold Gradient Accent -->
        <div class="h-1 w-full bg-gradient-to-r from-transparent via-[#E5A93C] to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Column 1: Brand & Overview -->
                <div class="space-y-4">
                    <img src="<?= BASE_URL ?>/public/assets/img/brand/elocentra-logo-transparent.png" 
                         alt="ELOCENTRA" 
                         class="h-12 w-auto object-contain filter drop-shadow">
                    <p class="text-sm text-slate-400 leading-relaxed pt-2">
                        ELOCENTRA – English Academy (PVT) LTD is a premier academic institution committed to equipping students, professionals, and corporate leaders with international language proficiency, communication confidence, and career excellence.
                    </p>
                    <div class="pt-2 flex items-center gap-3 text-slate-400">
                        <span class="inline-flex items-center gap-1.5 text-xs text-[#E5A93C]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Registered Academy (PVT) LTD
                        </span>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-5 border-l-2 border-[#E5A93C] pl-3">Navigation</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="<?= BASE_URL ?>/" class="text-slate-400 hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Home</a></li>
                        <li><a href="<?= BASE_URL ?>/about" class="text-slate-400 hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>About Us</a></li>
                        <li><a href="<?= BASE_URL ?>/courses" class="text-slate-400 hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Available Courses</a></li>
                        <li><a href="<?= BASE_URL ?>/contact" class="text-slate-400 hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Contact Academy</a></li>
                        <li><a href="<?= BASE_URL ?>/register" class="text-slate-400 hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Student Registration</a></li>
                        <li><a href="<?= BASE_URL ?>/login" class="text-slate-400 hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Portal Login</a></li>
                    </ul>
                </div>

                <!-- Column 3: Subject Areas -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-5 border-l-2 border-[#E5A93C] pl-3">Subject Areas</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="<?= BASE_URL ?>/courses?subject_area=1" class="hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>English & Communication</a></li>
                        <li><a href="<?= BASE_URL ?>/courses?subject_area=2" class="hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Psychology & Behavior</a></li>
                        <li><a href="<?= BASE_URL ?>/courses?subject_area=3" class="hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Business Accounting</a></li>
                        <li><a href="<?= BASE_URL ?>/courses" class="hover:text-[#E5A93C] transition-colors flex items-center gap-2"><svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Professional Studies</a></li>
                    </ul>
                </div>

                <!-- Column 4: Official Contact (No physical address!) -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-5 border-l-2 border-[#E5A93C] pl-3">Get in Touch</h4>
                    <ul class="space-y-3.5 text-sm text-slate-400">
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <span class="text-xs text-slate-500 block">Email Inquiries</span>
                                <a href="mailto:eloengaca@gmail.com" class="text-slate-300 hover:text-[#E5A93C] transition-colors font-medium">eloengaca@gmail.com</a>
                            </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <span class="text-xs text-slate-500 block">Hotline & WhatsApp</span>
                                <div class="text-slate-300 space-x-1 font-medium">
                                    <a href="tel:0777354892" class="hover:text-[#E5A93C] transition-colors">077 7354892</a>
                                    <span class="text-slate-600">/</span>
                                    <a href="tel:0772278069" class="hover:text-[#E5A93C] transition-colors">077 2278069</a>
                                </div>
                            </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <span class="text-xs text-slate-500 block">Online Academic Operations</span>
                                <span class="text-slate-300 font-medium">Monday - Saturday (8.30 AM - 6.00 PM)</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="border-t border-slate-800/80 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; <?= date('Y') ?> ELOCENTRA – English Academy (PVT) LTD. All Rights Reserved.</p>
                <div class="flex items-center gap-4 text-slate-400">
                    <a href="<?= BASE_URL ?>/about" class="hover:text-[#E5A93C] transition-colors">About</a>
                    <span>•</span>
                    <a href="<?= BASE_URL ?>/courses" class="hover:text-[#E5A93C] transition-colors">Courses</a>
                    <span>•</span>
                    <a href="<?= BASE_URL ?>/contact" class="hover:text-[#E5A93C] transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ELOCENTRA Academic Chatbot Widget -->
    <?php include __DIR__ . '/../components/chatbot.php'; ?>

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

        // Header Scrolling Dynamic Transparency Effect
        var nav = document.getElementById('elocentraNav');
        function handleScroll() {
            if (nav) {
                if (window.scrollY > 25) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            }
        }
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    })();
    </script>
</body>
</html>
