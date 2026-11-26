<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?= htmlspecialchars(($pageTitle ?? 'Portal') . ' | ELOCENTRA – English Academy (PVT) LTD', ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/favicon.svg">
    <link rel="shortcut icon" href="<?= BASE_URL ?>/favicon.ico">
    <?= csrfMeta() ?>

    <!-- Inline Theme Initializer -->
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
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
                    }
                },
                fontFamily: {
                    sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                }
            }
        }
    }
    </script>

    <!-- Base Design System -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= @filemtime(BASE_PATH . '/public/assets/css/style.css') ?: 1 ?>">

    <style>
    :root, [data-theme="light"] {
        --auth-bg: #F8FAFC;
        --auth-card: #FFFFFF;
        --auth-border: #E2E8F0;
        --auth-text: #0F172A;
        --auth-sub: #64748B;
        --auth-input-bg: #FFFFFF;
    }

    [data-theme="dark"] {
        --auth-bg: #0B1120;
        --auth-card: #131D33;
        --auth-border: #1E293B;
        --auth-text: #F8FAFC;
        --auth-sub: #94A3B8;
        --auth-input-bg: #0E1629;
    }

    html {
        background-color: #050A17 !important;
        overflow-x: hidden;
        -webkit-text-size-adjust: 100%;
    }

    body {
        background-color: var(--auth-bg);
        color: var(--auth-text);
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        min-height: 100vh;
        min-height: 100dvh;
        overflow-x: hidden;
        margin: 0;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .auth-split-layout {
        min-height: 100vh;
        min-height: 100dvh;
        display: grid;
        grid-template-columns: 1fr;
    }

    @media (min-width: 1024px) {
        .auth-split-layout {
            grid-template-columns: 45% 55%;
        }
    }

    @media (min-width: 1280px) {
        .auth-split-layout {
            grid-template-columns: 42% 58%;
        }
    }

    /* Left Banner with Dynamic Background Artwork & Glassmorphism */
    .auth-banner-left {
        background-color: #070D1F;
        position: relative;
        overflow: hidden;
        display: none;
    }

    @media (min-width: 1024px) {
        .auth-banner-left {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem 2.25rem;
        }
    }

    .auth-banner-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-repeat: no-repeat;
        transition: transform 12s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .auth-banner-left:hover .auth-banner-bg {
        transform: scale(1.03);
    }

    .auth-banner-veil {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, 
            rgba(6, 11, 24, 0.45) 0%, 
            rgba(6, 11, 24, 0.05) 25%, 
            rgba(6, 11, 24, 0.15) 60%, 
            rgba(6, 11, 24, 0.90) 100%
        );
        pointer-events: none;
    }

    /* Gold Buttons */
    .btn-gold {
        background: linear-gradient(135deg, #F59E0B 0%, #EAB308 50%, #D97706 100%);
        color: #0F172A !important;
        font-weight: 700;
        border-radius: 9999px;
        padding: 0.65rem 1.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(245, 158, 11, 0.35);
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.45);
        background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 50%, #D97706 100%);
        color: #070D1F !important;
    }

    .btn-outline-gold {
        border: 1.5px solid #F59E0B;
        color: #B45309 !important;
        font-weight: 600;
        border-radius: 9999px;
        padding: 0.65rem 1.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: transparent;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    [data-theme="dark"] .btn-outline-gold {
        color: #FBBF24 !important;
        border-color: #F59E0B;
    }

    .btn-outline-gold:hover {
        background: rgba(245, 158, 11, 0.15);
        color: #D97706 !important;
    }

    .theme-toggle-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #D97706;
        background: #F1F5F9;
        border: 1px solid #CBD5E1;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    [data-theme="dark"] .theme-toggle-btn {
        color: #FBBF24;
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.12);
    }

    .theme-toggle-btn:hover {
        background: rgba(245, 158, 11, 0.2);
        transform: rotate(15deg);
    }
    /* Auth Titles Guarantee */
    .auth-hero-title,
    .auth-banner-left h1,
    .auth-banner-left h2,
    .auth-banner-left h3 {
        color: #FFFFFF !important;
    }
    </style>
</head>
<body>
    <!-- Top Progress Bar (Loading State) -->
    <div id="eloPageLoader"></div>

    <div class="auth-split-layout">
        
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- LEFT COLUMN: DYNAMIC HIGH-RES ARTWORK & UNCOMMON FEATURE CARD  -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <?php
        // Detect current authentication page type
        $activeAuthPage = $authPage ?? null;
        if (!$activeAuthPage) {
            $uri = $_SERVER['REQUEST_URI'] ?? '';
            if (str_contains($uri, 'register')) {
                $activeAuthPage = 'register';
            } elseif (str_contains($uri, 'forgot') || str_contains($uri, 'reset') || str_contains($uri, 'password')) {
                $activeAuthPage = 'forgot';
            } else {
                $activeAuthPage = 'login';
            }
        }

        if ($activeAuthPage === 'register') {
            // 2. REGISTRATION PAGE
            $bannerImgUrl = BASE_URL . '/public/assets/img/brand/auth-register-banner.jpg';
            $bannerPosition = 'center top';
            $topBadgeText = 'Admissions Open 2026/27';
            $topBadgeColor = 'text-sky-300 border-sky-400/30';
            $pulseColor = 'bg-sky-400';
            $pillText = 'New Student Enrollment';
            $pillStyle = 'bg-sky-500/20 text-sky-300 border border-sky-400/30';
            $headline = 'Start Your Journey with <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-300">World-Class English</span>';
            $subtext = 'Create your student profile in 2 minutes for full academic access and accredited diplomas.';
            $cardWrapperClass = 'relative z-10 mt-4 sm:mt-6 ml-auto max-w-[340px] xl:max-w-[360px]'; // Top-Right (Positioned as marked)
            $featureChips = [
                [
                    'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
                    'iconBg' => 'bg-gradient-to-br from-blue-500 to-indigo-600',
                    'title' => '2-Min Enrollment',
                ],
                [
                    'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                    'iconBg' => 'bg-gradient-to-br from-amber-500 to-yellow-600',
                    'title' => 'Verified Diplomas',
                ],
            ];
            $footerSecurityText = 'Official Academic Enrollment';
            $footerSecurityIcon = '<svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>';
        } elseif ($activeAuthPage === 'forgot') {
            // 3. FORGOT PASSWORD / PASSWORD RECOVERY PAGE
            $bannerImgUrl = BASE_URL . '/public/assets/img/brand/auth-forgot-banner.jpg';
            $bannerPosition = 'center center';
            $topBadgeText = 'Security Recovery Gateway';
            $topBadgeColor = 'text-amber-300 border-amber-400/30';
            $pulseColor = 'bg-amber-400';
            $pillText = 'Account Security & Recovery';
            $pillStyle = 'bg-amber-500/20 text-amber-300 border border-amber-400/30';
            $headline = 'Fast & Secure <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F59E0B] via-[#FBBF24] to-[#FCD34D]">Account Recovery</span>';
            $subtext = 'Reset your password in under a minute with encrypted one-time OTP verification.';
            $cardWrapperClass = 'relative z-10 mt-5 sm:mt-7 ml-auto max-w-[340px] xl:max-w-[360px]'; // Top-Right (Positioned as marked)
            $featureChips = [
                [
                    'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>',
                    'iconBg' => 'bg-gradient-to-br from-amber-500 to-orange-600',
                    'title' => 'Instant OTP Code',
                ],
                [
                    'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                    'iconBg' => 'bg-gradient-to-br from-emerald-500 to-teal-600',
                    'title' => '256-Bit Protection',
                ],
            ];
            $footerSecurityText = '256-Bit Encrypted Recovery';
            $footerSecurityIcon = '<svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>';
        } else {
            // 1. LOGIN PAGE (DEFAULT)
            $bannerImgUrl = BASE_URL . '/public/assets/img/brand/auth-login-banner.jpg';
            $bannerPosition = 'center center';
            $topBadgeText = 'Portal Access &middot; Online';
            $topBadgeColor = 'text-amber-300 border-amber-400/30';
            $pulseColor = 'bg-emerald-400';
            $pillText = 'Student & Staff Portal';
            $pillStyle = 'bg-amber-500/20 text-[#E5A93C] border border-amber-400/30';
            $headline = 'Welcome Back to Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FBBF24] via-[#F59E0B] to-[#FCD34D]">Learning Hub</span>';
            $subtext = 'Log in to access your virtual classes, lesson materials, assignments, and exam results.';
            $cardWrapperClass = 'relative z-10 mt-auto self-start max-w-[330px] xl:max-w-[350px] mb-1'; // Bottom-Left (Positioned as marked)
            $featureChips = [
                [
                    'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>',
                    'iconBg' => 'bg-gradient-to-br from-amber-500 to-orange-600',
                    'title' => 'Virtual Classrooms',
                ],
                [
                    'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                    'iconBg' => 'bg-gradient-to-br from-emerald-500 to-teal-600',
                    'title' => 'Expert Mentorship',
                ],
            ];
            $footerSecurityText = '256-Bit SSL Secured Portal';
            $footerSecurityIcon = '<svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>';
        }
        ?>

        <div class="auth-banner-left text-white">
            <!-- Background Image with Soft Ken-Burns Hover & Dynamic Cache Busting -->
            <div class="auth-banner-bg" 
                 style="background-image: url('<?= $bannerImgUrl ?>?v=<?= @filemtime(BASE_PATH . '/' . ltrim(parse_url($bannerImgUrl, PHP_URL_PATH), '/')) ?: 20261127 ?>'); background-position: <?= $bannerPosition ?>;">
            </div>

            <!-- Subtle Luminous Vignette (Completely Unobstructed Artwork) -->
            <div class="auth-banner-veil"></div>

            <!-- Top Header & Brand (Single Official Logo with Portal Status Pill) -->
            <div class="relative z-10 flex items-center justify-between w-full">
                <a href="<?= BASE_URL ?>/" class="inline-block group" title="Return to ELOCENTRA Academy">
                    <img src="<?= BASE_URL ?>/public/assets/img/brand/elocentra-logo-transparent.png" 
                         alt="ELOCENTRA" 
                         class="h-10 xl:h-11 w-auto object-contain filter drop-shadow hover:scale-105 transition-transform duration-300">
                </a>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/40 border text-xs font-semibold backdrop-blur-md <?= $topBadgeColor ?>">
                    <span class="w-2 h-2 rounded-full <?= $pulseColor ?> animate-pulse"></span>
                    <span><?= $topBadgeText ?></span>
                </div>
            </div>

            <!-- Sleek, Smaller & Unobstructing Feature Card (Positioned precisely as marked in reference images) -->
            <div class="<?= $cardWrapperClass ?>">
                <div class="rounded-2xl p-3.5 sm:p-4 bg-[#060B18]/70 backdrop-blur-md border border-white/15 shadow-xl space-y-2">
                    <!-- Page Category Tag -->
                    <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[9px] font-bold tracking-wider uppercase backdrop-blur-md <?= $pillStyle ?>">
                        <span class="w-1.5 h-1.5 rounded-full <?= $pulseColor ?> animate-pulse"></span>
                        <?= $pillText ?>
                    </div>

                    <!-- Headline with Radiant Gradient Highlights -->
                    <h2 class="text-sm sm:text-base font-bold tracking-tight leading-snug text-white font-heading">
                        <?= $headline ?>
                    </h2>

                    <!-- Short & Sweet Narrative Context -->
                    <p class="text-[11px] text-slate-200/90 leading-relaxed font-normal">
                        <?= $subtext ?>
                    </p>

                    <!-- Sleek Micro Feature Chips -->
                    <div class="grid grid-cols-2 gap-1.5 pt-0.5">
                        <?php foreach ($featureChips as $chip): ?>
                            <div class="flex items-center gap-1.5 p-1.5 rounded-lg bg-white/[0.06] hover:bg-white/[0.12] border border-white/10 transition-colors">
                                <div class="w-5 h-5 rounded-md flex items-center justify-center shrink-0 <?= $chip['iconBg'] ?> text-white text-[9px] shadow-sm">
                                    <?= $chip['icon'] ?>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-[10px] font-bold text-white truncate"><?= $chip['title'] ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- RIGHT COLUMN: FORM WORKFLOW & THEME SWITCH                     -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <div class="flex flex-col justify-center p-4 sm:p-8 relative overflow-y-auto min-h-full">
            
            <!-- Top Controls: Back link + Theme Toggle (Matching Reference) -->
            <div class="flex items-center justify-between w-full max-w-md mx-auto mb-4 sm:mb-6">
                <a href="<?= BASE_URL ?>/" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-[#E5A93C] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Academy
                </a>

                <!-- Theme Toggle Button -->
                <button type="button" class="theme-toggle-btn" id="themeToggleAuth" aria-label="Toggle Theme" title="Toggle Light/Dark Theme">
                    <svg class="w-4 h-4 theme-moon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg class="w-4 h-4 theme-sun hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </button>
            </div>

            <!-- Main Form Card Container -->
            <div class="w-full max-w-md mx-auto py-1">
                
                <!-- Mobile Visual Header Card (Modern & Uncommon UI) -->
                <div class="lg:hidden mb-4">
                    <!-- Brand Top Bar on Mobile -->
                    <div class="flex items-center justify-between mb-3">
                        <a href="<?= BASE_URL ?>/" class="inline-block" title="ELOCENTRA Academy">
                            <img src="<?= BASE_URL ?>/public/assets/img/brand/elocentra-logo-transparent.png" 
                                 alt="ELOCENTRA" 
                                 class="h-9 w-auto object-contain filter drop-shadow">
                        </a>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-black/40 border text-[10px] font-semibold backdrop-blur-md <?= $topBadgeColor ?>">
                            <span class="w-1.5 h-1.5 rounded-full <?= $pulseColor ?> animate-pulse"></span>
                            <span><?= $topBadgeText ?></span>
                        </div>
                    </div>

                    <!-- Sleek Visual Landscape Hero Card with Dynamic Banner Image -->
                    <div class="relative h-36 sm:h-44 rounded-2xl overflow-hidden shadow-lg border border-slate-200 dark:border-slate-800 bg-[#070D1F]">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 hover:scale-105" 
                             style="background-image: url('<?= $bannerImgUrl ?>?v=<?= @filemtime(BASE_PATH . '/' . ltrim(parse_url($bannerImgUrl, PHP_URL_PATH), '/')) ?: 20261127 ?>'); background-position: <?= $bannerPosition ?>;">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-[#070D1F] via-[#070D1F]/45 to-transparent"></div>
                        <div class="absolute bottom-2.5 left-3.5 right-3.5 z-10">
                            <span class="inline-block px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider mb-1 backdrop-blur-md <?= $pillStyle ?>">
                                <?= $pillText ?>
                            </span>
                            <h2 class="text-sm font-extrabold text-white leading-tight font-heading drop-shadow">
                                <?= strip_tags($headline) ?>
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- Unified Modern Elevated Form Card -->
                <div class="bg-white dark:bg-[#131D33] rounded-2xl sm:rounded-3xl p-5 sm:p-7 border border-slate-200/90 dark:border-slate-800/90 shadow-xl shadow-slate-900/5 dark:shadow-black/40 backdrop-blur-sm">
                    <!-- Flash Messages -->
                    <?php include __DIR__ . '/../components/flash-messages.php'; ?>

                    <!-- Form Content injected here -->
                    <?= $content ?>
                </div>

            </div>

        </div>

    </div>

    <!-- Theme Switch Script -->
    <script>
    (function() {
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

        var btn = document.getElementById('themeToggleAuth');
        if (btn) btn.addEventListener('click', toggleTheme);

        var currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
        updateThemeIcons(currentTheme);
    })();
    </script>

    <!-- ELOCENTRA Unified Validation & Loading System -->
    <script src="<?= BASE_URL ?>/public/assets/js/elocentra-validation.js?v=<?= @filemtime(BASE_PATH . '/public/assets/js/elocentra-validation.js') ?: 2 ?>"></script>
</body>
</html>
