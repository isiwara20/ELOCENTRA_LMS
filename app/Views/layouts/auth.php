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

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
        --auth-bg: #070D1F;
        --auth-card: #111A2E;
        --auth-border: #1E293B;
        --auth-text: #F8FAFC;
        --auth-sub: #94A3B8;
        --auth-input-bg: #0B132B;
    }

    body {
        background-color: var(--auth-bg);
        color: var(--auth-text);
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        min-height: 100vh;
        margin: 0;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .auth-split-layout {
        min-height: 100vh;
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

    /* Left Banner matching reference image */
    .auth-banner-left {
        background: linear-gradient(160deg, #070D1F 0%, #0B132B 50%, #0F1A3A 100%);
        position: relative;
        overflow: hidden;
        display: none;
    }

    @media (min-width: 1024px) {
        .auth-banner-left {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3.5rem 3rem;
        }
    }

    /* Gold Buttons */
    .btn-gold {
        background: linear-gradient(135deg, #E5A93C 0%, #D49028 100%);
        color: #0B132B !important;
        font-weight: 700;
        border-radius: 9999px;
        padding: 0.65rem 1.5rem;
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
        color: #E5A93C !important;
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

    .btn-outline-gold:hover {
        background: rgba(229, 169, 60, 0.15);
        color: #F59E0B !important;
    }

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
    </style>
</head>
<body>

    <div class="auth-split-layout">
        
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- LEFT COLUMN: DECORATIVE BANNER MATCHING REFERENCE IMAGE       -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <div class="auth-banner-left text-white">
            <!-- Background Glow & Grid -->
            <div class="absolute -top-32 -left-32 w-80 h-80 bg-[#E5A93C]/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff0a_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

            <!-- Top Header & Brand -->
            <div class="relative z-10">
                <a href="<?= BASE_URL ?>/" class="inline-block">
                    <img src="<?= BASE_URL ?>/assets/img/brand/elocentra-logo-white.svg" alt="ELOCENTRA" class="h-12 w-auto">
                </a>
            </div>

            <!-- Middle Slogan & Core Messaging (Matching Reference Image) -->
            <div class="relative z-10 my-auto py-12 space-y-5">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 text-[#E5A93C] text-xs font-semibold tracking-wider uppercase">
                    ELOCENTRA ACADEMY
                </div>
                <h2 class="text-3xl xl:text-4xl font-extrabold tracking-tight leading-tight">
                    Learn English.<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F59E0B] via-[#E5A93C] to-[#FCD34D]">Speak Confidently.</span><br>
                    Succeed Globally.
                </h2>
                <p class="text-slate-300 text-sm leading-relaxed max-w-sm">
                    Access your student portal, active course modules, live lectures, assignments, and verified certificates.
                </p>
            </div>

            <!-- Bottom Glowing Graphic & Copyright (Matching Globe & Open Book) -->
            <div class="relative z-10 pt-6 border-t border-white/10 flex items-center justify-between text-xs text-slate-400">
                <div>
                    <span class="text-[#E5A93C] font-semibold">ELOCENTRA</span> &middot; English Academy (PVT) LTD
                </div>
                <div>
                    &copy; <?= date('Y') ?> All Rights Reserved
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- RIGHT COLUMN: FORM WORKFLOW & THEME SWITCH                     -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <div class="flex flex-col justify-between p-6 sm:p-12 relative overflow-y-auto">
            
            <!-- Top Controls: Back link + Theme Toggle (Matching Reference) -->
            <div class="flex items-center justify-between w-full max-w-md mx-auto mb-6">
                <a href="<?= BASE_URL ?>/" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-[#E5A93C] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Academy
                </a>

                <!-- Theme Toggle Button -->
                <button type="button" class="theme-toggle-btn" id="themeToggleAuth" aria-label="Toggle Theme" title="Toggle Light/Dark Theme">
                    <svg class="w-5 h-5 theme-moon" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg class="w-5 h-5 theme-sun hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>

            <!-- Main Form Card Container -->
            <div class="w-full max-w-md mx-auto my-auto py-4">
                
                <!-- Mobile Logo (shown only on mobile screens) -->
                <div class="text-center mb-8 lg:hidden">
                    <img src="<?= BASE_URL ?>/assets/img/brand/elocentra-logo.svg" alt="ELOCENTRA" class="h-10 w-auto mx-auto mb-2 dark:hidden">
                    <img src="<?= BASE_URL ?>/assets/img/brand/elocentra-logo-white.svg" alt="ELOCENTRA" class="h-10 w-auto mx-auto mb-2 hidden dark:block">
                    <p class="text-[11px] text-[#E5A93C] font-bold uppercase tracking-wider">Learn English. Speak Confidently. Succeed Globally.</p>
                </div>

                <!-- Flash Messages -->
                <?php include __DIR__ . '/../components/flash-messages.php'; ?>

                <!-- Form Content injected here -->
                <?= $content ?>

            </div>

            <!-- Footer Note -->
            <div class="w-full max-w-md mx-auto text-center mt-6 text-xs text-slate-400">
                ELOCENTRA – English Academy (PVT) LTD &middot; Secure Academic Portal
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
</body>
</html>
