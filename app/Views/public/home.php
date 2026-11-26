<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Modern Academic LMS Homepage with Automated Rotating Banner Slider
 */
$slogan = $settings['academy_slogan'] ?? 'Learn English. Speak Confidently. Succeed Globally.';
$vision = $settings['academy_vision'] ?? 'To become a trusted and internationally recognised English academy that empowers learners to communicate confidently and succeed globally.';
$mission = $settings['academy_mission'] ?? 'To provide accessible, practical and high-quality English education through modern online teaching methods, qualified guidance and learner-centred programmes that develop speaking, listening, reading, writing, grammar and professional communication skills.';
$mainGoal = $settings['academy_main_goal'] ?? 'To help every learner overcome language barriers and use English confidently in education, employment, business, leadership and everyday life.';
$supportingGoals = json_decode($settings['academy_supporting_goals'] ?? '[]', true) ?: [
    'Provide affordable and accessible online English classes.',
    'Develop learners\' confidence in spoken and written English.',
    'Serve schoolchildren, university students, employees, professionals and businesspeople.',
    'Offer beginner, intermediate and advanced learning pathways.',
    'Provide English for interviews, employment, business, presentations and public speaking.',
    'Use technology to reach learners throughout Sri Lanka and overseas.',
    'Maintain high teaching standards and measurable learning outcomes.',
    'Build Elocentra into a respected international education brand.'
];

// Fallback banner slides if table is empty
$sliderBanners = !empty($banners) ? $banners : [
    [
        'id' => 1,
        'title' => 'Learn English. Speak Confidently. Succeed Globally.',
        'subtitle' => 'A modern learning platform to build your language, communication, and professional skills for an international future.',
        'image_url' => '/public/assets/img/slider/banner1.jpg',
        'position' => 'center center',
        'button_text' => 'Explore Courses',
        'button_link' => '/courses',
    ],
    [
        'id' => 2,
        'title' => 'Empower Your Global Career With Expert Mentors',
        'subtitle' => 'Master business presentations, speech craft, professional writing, and interview excellence guided by seasoned academics.',
        'image_url' => '/public/assets/img/slider/banner2.jpg',
        'position' => 'center center',
        'button_text' => 'Join Now',
        'button_link' => '/register',
    ],
    [
        'id' => 3,
        'title' => 'World-Class Online Learning With Modern Methods',
        'subtitle' => 'Interactive virtual classrooms, practical language simulations, and comprehensive curriculum from foundational to advanced levels.',
        'image_url' => '/public/assets/img/slider/banner3.jpg',
        'position' => 'center center',
        'button_text' => 'View Academic Disciplines',
        'button_link' => '/courses',
    ],
    [
        'id' => 4,
        'title' => 'Multidisciplinary Programs for Well-Rounded Leaders',
        'subtitle' => 'Expand your competence with foundational Psychology, Business Accounting, and corporate leadership communication.',
        'image_url' => '/public/assets/img/slider/banner4.jpg',
        'position' => 'center center',
        'button_text' => 'Register as a Student',
        'button_link' => '/register',
    ],
];

$resourcePersons = !empty($resourcePersons) ? $resourcePersons : [];
?>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 1. HOMEPAGE BANNER ROTATING IMAGE SLIDER                            -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="relative bg-[#060B18] text-white overflow-hidden select-none" id="eloHeroSliderSection">
    <!-- Slider Slides Container -->
    <div class="relative w-full h-[620px] sm:h-[660px] lg:h-[720px] overflow-hidden" id="eloHeroSlider">
        <?php foreach ($sliderBanners as $idx => $slide): ?>
            <div class="elo-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out <?= $idx === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none' ?>"
                 data-slide-index="<?= $idx ?>">
                <!-- High-Definition Background Image with Crisp Clarity & Luminous in Night Mode -->
                <div class="elo-slide-bg absolute inset-0 w-full h-full bg-cover transform transition-transform duration-10000 scale-100 hover:scale-102"
                     style="background-image: url('<?= BASE_URL . htmlspecialchars($slide['image_url'], ENT_QUOTES, 'UTF-8') ?>?v=<?= @filemtime(BASE_PATH . '/' . ltrim($slide['image_url'], '/')) ?: 20261126 ?>'); background-position: <?= htmlspecialchars($slide['position'] ?? 'center center', ENT_QUOTES, 'UTF-8') ?>;">
                </div>

                <!-- Clean Directional Vignette: Soft dark wash on left text area, crystal clear & luminous in Night Mode -->
                <div class="elo-slide-overlay absolute inset-0 pointer-events-none"></div>
                <!-- Soft top & bottom fade for seamless navbar and indicator integration -->
                <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-[#060B18]/50 to-transparent pointer-events-none"></div>
                <div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-[#060B18]/65 to-transparent pointer-events-none"></div>

                <!-- Slide Content -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-20">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center w-full">
                        
                        <!-- Slide Left: Heading & Call to Actions (Protected with Elegant Subtle Backdrop) -->
                        <div class="lg:col-span-8 space-y-6 text-center lg:text-left pt-8 lg:pt-0">
                            <div class="inline-block p-4 sm:p-6 rounded-3xl bg-[#060B18]/30 backdrop-blur-[3px] border border-white/10 shadow-2xl space-y-5 max-w-2xl">
                                <!-- Academy Badge -->
                                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/25 text-[#E5A93C] text-xs font-semibold tracking-wider uppercase backdrop-blur-md shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-[#E5A93C] animate-pulse"></span>
                                    ELOCENTRA – English Academy (PVT) LTD
                                </div>

                                <!-- Main Slogan / Slide Title with High-Contrast Light & Dark Visibility Guarantee -->
                                <h1 class="elo-hero-title text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.12]" style="color: #FFFFFF !important;">
                                    <?php if ($idx === 0): ?>
                                        <span class="block text-white" style="color: #FFFFFF !important; text-shadow: 0 3px 16px rgba(0,0,0,0.9);">Learn English.</span>
                                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-slate-200" style="text-shadow: 0 3px 16px rgba(0,0,0,0.7);">Speak Confidently.</span>
                                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#FBBF24] via-[#F59E0B] to-[#FCD34D]" style="text-shadow: 0 3px 16px rgba(0,0,0,0.7);">Succeed Globally.</span>
                                    <?php else: ?>
                                        <span class="block text-white" style="color: #FFFFFF !important; text-shadow: 0 3px 16px rgba(0,0,0,0.9);"><?= htmlspecialchars($slide['title'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <?php endif; ?>
                                </h1>

                                <!-- Subtitle -->
                                <p class="text-slate-100 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal" style="text-shadow: 0 2px 10px rgba(0,0,0,0.85);">
                                    <?= htmlspecialchars($slide['subtitle'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                </p>

                                <!-- CTA Buttons -->
                                <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                                    <a href="<?= BASE_URL . htmlspecialchars($slide['button_link'] ?? '/courses', ENT_QUOTES, 'UTF-8') ?>" class="btn-gold text-sm sm:text-base py-3.5 px-7 shadow-lg">
                                        <span><?= htmlspecialchars($slide['button_text'] ?? 'Explore Courses', ENT_QUOTES, 'UTF-8') ?></span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                    <a href="<?= BASE_URL ?>/register" class="btn-outline-gold text-sm sm:text-base py-3.5 px-7 backdrop-blur-md">
                                        <span>Join Academy</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Slide Right: Highlights Feature Badges (Clear Frosted Glass - Unobstructed Photo View) -->
                        <div class="hidden lg:col-span-4 lg:flex flex-col gap-3.5 items-end">
                            <!-- Feature 1: Cyan / Sky -->
                            <div class="bg-[#060B18]/50 backdrop-blur-md border border-sky-400/40 py-3 px-5 rounded-2xl shadow-xl flex items-center gap-3.5 w-72 hover:bg-[#060B18]/75 hover:border-sky-400/70 transition-all">
                                <div class="w-10 h-10 rounded-xl bg-sky-500/25 text-sky-300 flex items-center justify-center shrink-0 border border-sky-400/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/></svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-white uppercase tracking-wide">Flexible Learning</div>
                                    <div class="text-[11px] text-sky-200">Self-Paced &amp; Interactive</div>
                                </div>
                            </div>

                            <!-- Feature 2: Gold / Amber -->
                            <div class="bg-[#060B18]/50 backdrop-blur-md border border-amber-400/40 py-3 px-5 rounded-2xl shadow-xl flex items-center gap-3.5 w-72 hover:bg-[#060B18]/75 hover:border-amber-400/70 transition-all">
                                <div class="w-10 h-10 rounded-xl bg-amber-500/25 text-amber-300 flex items-center justify-center shrink-0 border border-amber-400/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-white uppercase tracking-wide">Expert Faculty</div>
                                    <div class="text-[11px] text-amber-200">Senior University Lecturers</div>
                                </div>
                            </div>

                            <!-- Feature 3: Emerald -->
                            <div class="bg-[#060B18]/50 backdrop-blur-md border border-emerald-400/40 py-3 px-5 rounded-2xl shadow-xl flex items-center gap-3.5 w-72 hover:bg-[#060B18]/75 hover:border-emerald-400/70 transition-all">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500/25 text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-400/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-white uppercase tracking-wide">Global Curricula</div>
                                    <div class="text-[11px] text-emerald-200">Language &amp; Professionalism</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Slider Navigation Arrows -->
    <button type="button" id="sliderPrevBtn" aria-label="Previous Slide" 
            class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-[#0B132B]/60 hover:bg-[#E5A93C] text-white hover:text-[#0B132B] border border-white/20 hover:border-[#E5A93C] flex items-center justify-center transition-all duration-300 backdrop-blur-md">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" id="sliderNextBtn" aria-label="Next Slide" 
            class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-[#0B132B]/60 hover:bg-[#E5A93C] text-white hover:text-[#0B132B] border border-white/20 hover:border-[#E5A93C] flex items-center justify-center transition-all duration-300 backdrop-blur-md">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
    </button>

    <!-- Slider Indicators / Pagination Dots -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2" id="sliderIndicators">
        <?php foreach ($sliderBanners as $idx => $slide): ?>
            <button type="button" class="slider-dot h-2.5 rounded-full transition-all duration-300 <?= $idx === 0 ? 'w-8 bg-[#E5A93C]' : 'w-2.5 bg-white/40 hover:bg-white/70' ?>"
                    data-slide-to="<?= $idx ?>" aria-label="Slide <?= $idx + 1 ?>"></button>
        <?php endforeach; ?>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 2. FOUR PILLARS FEATURE BAND (COLORFUL & FRIENDLY SVG ICONS)        -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="relative z-30 -mt-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-[#131D33] rounded-2xl shadow-xl border border-slate-200 dark:border-slate-800 p-6 md:p-8 transition-colors">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <!-- Pillar 1: Sapphire Blue -->
            <div class="flex items-start gap-4 p-2 rounded-xl transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/40">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 border border-blue-500/20 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Diverse Subject Areas</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Language, Psychology, Business &amp; more</p>
                </div>
            </div>

            <!-- Pillar 2: Sunburst Gold / Amber -->
            <div class="flex items-start gap-4 p-2 rounded-xl transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/40">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 border border-amber-500/20 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Expert Resource Persons</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Qualified &amp; experienced educators</p>
                </div>
            </div>

            <!-- Pillar 3: Emerald Green -->
            <div class="flex items-start gap-4 p-2 rounded-xl transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/40">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 border border-emerald-500/20 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Practical Learning</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Real-world communication skills</p>
                </div>
            </div>

            <!-- Pillar 4: Amethyst Purple -->
            <div class="flex items-start gap-4 p-2 rounded-xl transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/40">
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0 border border-purple-500/20 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Global Opportunities</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Build a future without borders</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 3. WHO WE ARE & VISION / MISSION / GOALS (FROM REFERENCE IMAGE)     -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-20 lg:py-28 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header / Intro -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center mb-16">
            <div class="lg:col-span-5 relative">
                <div class="rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-xl bg-slate-900">
                    <img src="<?= BASE_URL ?>/public/assets/img/brand/home-who-we-are.jpg" alt="ELOCENTRA Academy" class="w-full h-80 sm:h-96 object-cover">
                </div>
                <div class="absolute -bottom-6 -right-4 sm:-right-6 bg-[#0A193B] text-white p-5 rounded-2xl shadow-xl hidden sm:block border border-amber-400/40 max-w-xs backdrop-blur-md">
                    <div class="text-[#F59E0B] text-xs font-bold uppercase tracking-wider">ELOCENTRA Academy</div>
                    <div class="text-xs text-slate-300 mt-1">"Learn English. Speak Confidently. Succeed Globally."</div>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 text-xs font-bold tracking-widest uppercase">WHO WE ARE</div>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    ELOCENTRA – English Academy (PVT) LTD
                </h2>
                <p class="text-slate-700 dark:text-slate-300 text-base leading-relaxed font-medium">
                    ELOCENTRA is a modern English Academy dedicated to developing language proficiency, communication confidence, and academic &amp; professional competence for learners who aspire to succeed globally.
                </p>
                <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                    Through innovative curriculum design, highly qualified resource persons, interactive digital infrastructure, and multidisciplinary subject pathways, we ensure that every student gains the confidence to articulate ideas fluently in education, employment, business, and leadership.
                </p>
                <div class="pt-2">
                    <a href="<?= BASE_URL ?>/about" class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-600 dark:text-blue-400 hover:text-amber-500 transition-colors">
                        <span>Discover Our Full Story &amp; Educational Approach</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Heading: Vision, Mission and Goals -->
        <div class="text-center max-w-3xl mx-auto mb-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 text-xs font-bold tracking-widest uppercase">FOUNDATIONAL COMMITMENTS</div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-2">Vision, Mission and Goals</h2>
            <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">The institutional philosophy, purpose, and commitments driving academic excellence at ELOCENTRA.</p>
        </div>

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- TOP ROW: 3 VERTICAL CARDS (VISION | MISSION | MAIN GOALS)   -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 items-stretch">
            
            <!-- 1. VISION (Vertical Portrait Card - Sapphire Blue Accent) -->
            <div class="elo-card p-6 rounded-2xl flex flex-col justify-between border-t-4 border-t-blue-600 hover:border-blue-500/60 transition-all duration-300 group shadow-md border-x border-b border-slate-200 dark:border-slate-800">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center border border-blue-500/20 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold tracking-wider uppercase bg-blue-500/15 text-blue-700 dark:text-blue-300 border border-blue-500/30">VISION</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1 font-heading">Vision</h3>
                    <div class="text-xs font-semibold text-blue-600 dark:text-blue-400 mb-3">The future we seek to create</div>
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-normal">
                        <?= htmlspecialchars($vision, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
                <div class="mt-6 pt-3 border-t border-slate-100 dark:border-slate-800/80 flex items-center gap-2 text-xs font-semibold text-blue-600 dark:text-blue-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                    <span>Global Impact &amp; Academic Trust</span>
                </div>
            </div>

            <!-- 2. MISSION (Vertical Portrait Card - Sunburst Gold Accent) -->
            <div class="elo-card p-6 rounded-2xl flex flex-col justify-between border-t-4 border-t-amber-500 hover:border-amber-500/60 transition-all duration-300 group shadow-md border-x border-b border-slate-200 dark:border-slate-800">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center border border-amber-500/20 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold tracking-wider uppercase bg-amber-500/15 text-amber-700 dark:text-amber-300 border border-amber-500/30">MISSION</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1 font-heading">Mission</h3>
                    <div class="text-xs font-semibold text-amber-600 dark:text-amber-400 mb-3">The purpose that drives us</div>
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-normal">
                        <?= htmlspecialchars($mission, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
                <div class="mt-6 pt-3 border-t border-slate-100 dark:border-slate-800/80 flex items-center gap-2 text-xs font-semibold text-amber-600 dark:text-amber-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    <span>Learner-Centred Practical Excellence</span>
                </div>
            </div>

            <!-- 3. MAIN GOALS (Vertical Portrait Card - Emerald Green Accent) -->
            <div class="elo-card p-6 rounded-2xl flex flex-col justify-between border-t-4 border-t-emerald-500 hover:border-emerald-500/60 transition-all duration-300 group shadow-md border-x border-b border-slate-200 dark:border-slate-800">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center border border-emerald-500/20 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold tracking-wider uppercase bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border border-emerald-500/30">MAIN GOALS</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1 font-heading">Main Goals</h3>
                    <div class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 mb-3">Our primary focus</div>
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-normal">
                        <?= htmlspecialchars($mainGoal, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
                <div class="mt-6 pt-3 border-t border-slate-100 dark:border-slate-800/80 flex items-center gap-2 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Overcoming Communication Barriers</span>
                </div>
            </div>

        </div>

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- BOTTOM ROW: 1 WIDE HORIZONTAL BOX (SUPPORTING GOALS)        -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <div class="elo-card p-6 sm:p-8 rounded-2xl border-t-4 border-t-purple-600 hover:border-purple-500/60 transition-all duration-300 shadow-md border-x border-b border-slate-200 dark:border-slate-800">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-slate-200 dark:border-slate-800 gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0 border border-purple-500/20 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/30 text-[10px] font-extrabold tracking-wider uppercase mb-1">STRATEGIC OBJECTIVES</div>
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white font-heading">Supporting Goals</h3>
                    </div>
                </div>
                <div class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 font-medium">
                    The actionable steps that strengthen our goal
                </div>
            </div>

            <!-- 8 Supporting Goals in Horizontal Grid: 4 cols desktop, 2 cols tablet, 1 col mobile -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                <?php 
                $goalColors = [
                    ['bg' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/25', 'hover' => 'hover:border-blue-500/50'],
                    ['bg' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/25', 'hover' => 'hover:border-amber-500/50'],
                    ['bg' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/25', 'hover' => 'hover:border-emerald-500/50'],
                    ['bg' => 'bg-purple-500/10 text-purple-600 dark:text-purple-400 border-purple-500/25', 'hover' => 'hover:border-purple-500/50'],
                ];
                ?>
                <?php foreach ($supportingGoals as $idx => $goal): ?>
                    <?php $cScheme = $goalColors[$idx % 4]; ?>
                    <div class="p-3.5 rounded-xl bg-slate-50/70 dark:bg-slate-900/60 border border-slate-200/80 dark:border-slate-800 flex items-start gap-3 <?= $cScheme['hover'] ?> transition-all group">
                        <div class="w-7 h-7 rounded-lg <?= $cScheme['bg'] ?> flex items-center justify-center shrink-0 mt-0.5 border font-bold text-xs group-hover:scale-105 transition-transform shadow-xs">
                            <?= $idx + 1 ?>
                        </div>
                        <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed font-medium">
                            <?= htmlspecialchars($goal, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 4. SUBJECT AREAS SECTION (COLORFUL CARDS)                           -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-16 bg-slate-50 dark:bg-[#0B132B]/50 border-y border-slate-200 dark:border-slate-800 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 text-xs font-bold tracking-widest uppercase">ACADEMIC DISCIPLINES</div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-2">Explore Subject Areas</h2>
            <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">Comprehensive pathways from communication fluency to professional business mastery.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php 
            $saColors = [
                ['icon' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/25', 'hover' => 'hover:border-blue-500/60'],
                ['icon' => 'bg-purple-500/10 text-purple-600 dark:text-purple-400 border-purple-500/25', 'hover' => 'hover:border-purple-500/60'],
                ['icon' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/25', 'hover' => 'hover:border-emerald-500/60'],
                ['icon' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/25', 'hover' => 'hover:border-amber-500/60'],
            ];
            ?>
            <?php foreach ($subjectAreas as $idx => $sa): ?>
                <?php $scheme = $saColors[$idx % 4]; ?>
                <a href="<?= BASE_URL ?>/courses?subject_area=<?= (int) $sa['id'] ?>" class="elo-card p-6 block group text-left border border-slate-200 dark:border-slate-800 <?= $scheme['hover'] ?>">
                    <div class="w-12 h-12 rounded-xl <?= $scheme['icon'] ?> flex items-center justify-center shrink-0 mb-4 group-hover:scale-105 transition-transform border shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        <?= htmlspecialchars($sa['name'], ENT_QUOTES, 'UTF-8') ?>
                    </h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 line-clamp-2">
                        <?= htmlspecialchars($sa['description'] ?? 'Curated university-level curriculum.', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <div class="mt-4 flex items-center justify-between text-xs font-semibold text-blue-600 dark:text-blue-400 group-hover:text-amber-500 transition-colors">
                        <span><?= (int) ($sa['course_count'] ?? 0) ?> Courses</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 5. FEATURED COURSES SECTION (COLORFUL CARDS)                        -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-20 lg:py-28 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 text-xs font-bold tracking-widest uppercase">CURATED CURRICULUM</div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-2">Available Courses</h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Professionally designed courses to build language proficiency, confidence, and career skills.</p>
            </div>
            <div>
                <a href="<?= BASE_URL ?>/courses" class="btn-outline-gold text-xs py-2.5 px-6">
                    <span>View All Courses</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php 
            $badgeColors = [
                'bg-blue-600 text-white shadow-blue-500/30',
                'bg-purple-600 text-white shadow-purple-500/30',
                'bg-emerald-600 text-white shadow-emerald-500/30',
                'bg-amber-500 text-slate-950 font-extrabold shadow-amber-500/30',
            ];
            ?>
            <?php foreach ($courses as $idx => $c): ?>
                <?php
                    $thumb = $c['course_thumbnail'] ?: '/assets/img/courses/english-global.jpg';
                    $fee = number_format((float) ($c['price'] ?? $c['monthly_fee'] ?? 0), 2);
                    $bStyle = $badgeColors[$idx % 4];
                ?>
                <div class="elo-card overflow-hidden flex flex-col justify-between group border border-slate-200 dark:border-slate-800 hover:border-blue-500/60">
                    <div>
                        <!-- Thumbnail -->
                        <div class="relative h-44 overflow-hidden bg-slate-900">
                            <img src="<?= BASE_URL . htmlspecialchars($thumb, ENT_QUOTES, 'UTF-8') ?>" 
                                 alt="<?= htmlspecialchars($c['class_name'], ENT_QUOTES, 'UTF-8') ?>" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3 <?= $bStyle ?> backdrop-blur-sm text-[10px] font-bold uppercase px-3 py-1 rounded-full shadow-md">
                                <?= htmlspecialchars($c['subject_area_name'] ?? $c['subject'] ?? 'English', ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5">
                            <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors leading-snug">
                                <a href="<?= BASE_URL ?>/courses/<?= (int) $c['id'] ?>">
                                    <?= htmlspecialchars($c['class_name'], ENT_QUOTES, 'UTF-8') ?>
                                </a>
                            </h3>
                            
                            <!-- Meta: Duration & Mode -->
                            <div class="flex items-center gap-4 text-xs text-slate-600 dark:text-slate-400 mt-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                                <span class="flex items-center gap-1.5 font-medium">
                                    <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <?= htmlspecialchars($c['duration_weeks'] ?? '12 Weeks', ENT_QUOTES, 'UTF-8') ?>
                                </span>
                                <span class="flex items-center gap-1.5 font-medium">
                                    <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <?= ucfirst(htmlspecialchars($c['delivery_mode'] ?? 'Online', ENT_QUOTES, 'UTF-8')) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer: Price & Action -->
                    <div class="p-5 pt-0 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-500 dark:text-slate-400 block uppercase font-semibold">Course Fee</span>
                            <span class="text-base font-extrabold text-blue-600 dark:text-blue-400">LKR <?= $fee ?></span>
                        </div>
                        <a href="<?= BASE_URL ?>/courses/<?= (int) $c['id'] ?>" 
                           class="w-9 h-9 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all shadow-sm" title="View Course Details">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 6. RESOURCE PERSONS / TEACHERS SECTION                              -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-20 bg-slate-50 dark:bg-[#0B132B]/50 border-t border-slate-200 dark:border-slate-800 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 text-xs font-bold tracking-widest uppercase">ACADEMIC EXCELLENCE</div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-2">Resource Persons &amp; Faculty</h2>
            <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">Learn from seasoned university professors, industry specialists, and international master trainers.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($resourcePersons as $rp): ?>
                <?php $photo = $rp['photo'] ?: '/assets/img/teachers/senaka.jpg'; ?>
                <div class="elo-card p-6 text-center group border border-slate-200 dark:border-slate-800 hover:border-amber-400/60">
                    <!-- Photo -->
                    <div class="w-28 h-28 mx-auto rounded-full overflow-hidden border-2 border-amber-400/50 mb-4 shadow-lg bg-slate-800 group-hover:border-amber-400 transition-colors">
                        <img src="<?= BASE_URL . htmlspecialchars($photo, ENT_QUOTES, 'UTF-8') ?>" 
                             alt="<?= htmlspecialchars($rp['name'], ENT_QUOTES, 'UTF-8') ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <!-- Details -->
                    <h3 class="text-base font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($rp['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <div class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-500/15 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                        <?= htmlspecialchars($rp['title'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-2 italic"><?= htmlspecialchars($rp['qualifications'], ENT_QUOTES, 'UTF-8') ?></div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 mt-3 line-clamp-3 leading-relaxed">
                        <?= htmlspecialchars($rp['bio'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 7. CALL TO ACTION BANNER (DEEP ROYAL SAPPHIRE & GOLD GLOW)         -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-16 bg-gradient-to-r from-[#07132B] via-[#0C2253] to-[#153472] text-white text-center relative overflow-hidden border-t border-blue-900/40">
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 relative z-10 space-y-6">
        <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight" style="color:#ffffff !important;">
            Ready to Speak Confidently and Succeed Globally?
        </h2>
        <p class="text-slate-200 text-sm sm:text-base max-w-xl mx-auto">
            Take the first step towards academic and professional advancement today. Join ELOCENTRA's world-class learning community.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="<?= BASE_URL ?>/register" class="btn-gold text-base py-3 px-8 shadow-lg shadow-amber-500/25">
                <span>Register as a Student</span>
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <a href="<?= BASE_URL ?>/contact" class="btn-outline-gold text-base py-3 px-8 text-white border-white/40 hover:border-amber-400 hover:text-amber-400">
                <span>Inquire With Us</span>
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- AUTOMATED BANNER SLIDER SCRIPT                                      -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<script>
(function() {
    var slides = document.querySelectorAll('.elo-slide');
    var dots = document.querySelectorAll('.slider-dot');
    var prevBtn = document.getElementById('sliderPrevBtn');
    var nextBtn = document.getElementById('sliderNextBtn');
    var sliderContainer = document.getElementById('eloHeroSliderSection');
    
    if (!slides.length) return;

    var currentIndex = 0;
    var totalSlides = slides.length;
    var autoPlayInterval = null;
    var slideDuration = 3500; // 3.5 seconds per slide (prompt and smooth)

    function showSlide(index) {
        // Normalize index
        if (index >= totalSlides) index = 0;
        if (index < 0) index = totalSlides - 1;
        currentIndex = index;

        // Update slides visibility
        slides.forEach(function(slide, idx) {
            if (idx === currentIndex) {
                slide.classList.remove('opacity-0', 'pointer-events-none');
                slide.classList.add('opacity-100', 'z-10');
            } else {
                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        // Update pagination dots
        dots.forEach(function(dot, idx) {
            if (idx === currentIndex) {
                dot.classList.remove('w-2.5', 'bg-white/40');
                dot.classList.add('w-8', 'bg-[#E5A93C]');
            } else {
                dot.classList.remove('w-8', 'bg-[#E5A93C]');
                dot.classList.add('w-2.5', 'bg-white/40');
            }
        });
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    function prevSlide() {
        showSlide(currentIndex - 1);
    }

    function startAutoPlay() {
        stopAutoPlay();
        autoPlayInterval = setInterval(nextSlide, slideDuration);
    }

    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }

    // Attach Event Listeners
    if (nextBtn) nextBtn.addEventListener('click', function() {
        nextSlide();
        startAutoPlay();
    });

    if (prevBtn) prevBtn.addEventListener('click', function() {
        prevSlide();
        startAutoPlay();
    });

    dots.forEach(function(dot) {
        dot.addEventListener('click', function() {
            var targetIdx = parseInt(dot.getAttribute('data-slide-to'), 10);
            if (!isNaN(targetIdx)) {
                showSlide(targetIdx);
                startAutoPlay();
            }
        });
    });

    // Pause on hover
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', stopAutoPlay);
        sliderContainer.addEventListener('mouseleave', startAutoPlay);
    }

    // Start automated rotation
    startAutoPlay();
})();
</script>
