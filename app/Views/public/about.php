<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Dedicated About Us Page
 * Exact Vision, Mission, Main Goal, Supporting Goals from reference image
 */
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
?>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- HERO BANNER (NAVY CURVED WAVE AS IN REFERENCE IMAGE)                -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="relative bg-[#060B18] text-white pt-20 pb-28 overflow-hidden select-none">
    <!-- Modern University Grand Corridor Background - Clear & Luminous in Night Mode -->
    <div class="hero-banner-bg absolute inset-0 w-full h-full bg-cover bg-center transform scale-100"
         style="background-image: url('<?= BASE_URL ?>/public/assets/img/brand/about-hero-banner.jpg');">
    </div>
    <div class="hero-banner-overlay absolute inset-0 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-3">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 border border-white/20 text-[#E5A93C] text-xs font-semibold tracking-wider uppercase backdrop-blur-md">
            <span class="w-1.5 h-1.5 rounded-full bg-[#E5A93C]"></span>
            ELOCENTRA Academy
        </div>
        <h1 class="hero-banner-title text-3xl sm:text-5xl font-extrabold tracking-tight" style="color: #FFFFFF !important; text-shadow: 0 2px 14px rgba(0,0,0,0.75);">About Us</h1>
        <div class="flex items-center justify-center gap-2 text-xs font-semibold text-slate-300">
            <a href="<?= BASE_URL ?>/" class="hover:text-[#E5A93C] transition-colors">Home</a>
            <span class="text-slate-500">&gt;</span>
            <span class="text-[#E5A93C]">About Us</span>
        </div>
    </div>
    <!-- Curved Wave Shape Divider -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none z-10">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 sm:h-16 text-[var(--page-bg)] fill-current transition-colors">
            <path d="M0,0 C150,90 350,-40 500,40 C650,120 900,20 1200,60 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- WHO WE ARE SECTION (MATCHING TOP RIGHT REFERENCE IMAGE)            -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-24 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20">
            <!-- Left Academic Image -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-2xl bg-slate-900">
                    <img src="<?= BASE_URL ?>/public/assets/img/brand/about-campus.jpg" alt="ELOCENTRA Academy" class="w-full h-96 object-cover">
                </div>
                <!-- Slogan Pill Overlay -->
                <div class="absolute -bottom-5 -right-4 bg-[#0B132B] border border-[#E5A93C]/40 text-white py-3 px-5 rounded-2xl shadow-xl max-w-xs">
                    <div class="text-[11px] font-bold text-[#E5A93C] uppercase tracking-wider">ELOCENTRA Academy</div>
                    <div class="text-xs text-slate-300 mt-0.5">"Learn English. Speak Confidently. Succeed Globally."</div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="lg:col-span-7 space-y-4">
                <div class="text-[#E5A93C] text-xs font-bold uppercase tracking-widest">WHO WE ARE</div>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    ELOCENTRA – English Academy (PVT) LTD
                </h2>
                <p class="text-slate-700 dark:text-slate-300 text-base leading-relaxed font-medium">
                    ELOCENTRA is a modern English Academy dedicated to developing language proficiency, communication confidence, and academic &amp; professional competence for learners who aspire to succeed globally.
                </p>
                <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                    Established with a mission for modern, accessible, and high-impact education, ELOCENTRA integrates comprehensive English training with multidisciplinary disciplines including psychology and business accounting. We provide students, corporate executives, and aspiring global scholars with the intellectual foundation and practical communication abilities required to overcome language barriers and use English confidently in education, employment, business, leadership and everyday life.
                </p>
                
                <div class="pt-4 grid grid-cols-2 gap-4 border-t border-slate-200 dark:border-slate-800">
                    <div>
                        <div class="text-2xl font-extrabold text-[#E5A93C]">100%</div>
                        <div class="text-xs text-slate-600 dark:text-slate-400">Interactive Practical Focus</div>
                    </div>
                    <div>
                        <div class="text-2xl font-extrabold text-[#E5A93C]">Global</div>
                        <div class="text-xs text-slate-600 dark:text-slate-400">International Education Standards</div>
                    </div>
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
        <div class="elo-card p-6 sm:p-8 rounded-2xl border-t-4 border-t-purple-600 hover:border-purple-500/60 transition-all duration-300 shadow-md border-x border-b border-slate-200 dark:border-slate-800 mb-20">
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

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- EDUCATIONAL APPROACH (COLORFUL PILLARS)                     -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <div class="bg-slate-50 dark:bg-[#0B132B]/50 rounded-3xl p-8 sm:p-12 border border-slate-200 dark:border-slate-800 mb-20 transition-colors">
            <div class="max-w-3xl mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 text-xs font-bold tracking-widest uppercase">METHODOLOGY</div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-2">Our Educational Approach</h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">At ELOCENTRA, learning is participatory, interactive, and aligned with international CEFR standards.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 rounded-2xl bg-white dark:bg-[#131D33] border border-blue-500/20 shadow-sm space-y-3">
                    <div class="text-blue-600 dark:text-blue-400 font-bold text-base flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center text-xs">01</span> Communicative Fluency
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Rather than rote grammar memorization, our instruction focuses on situational dialogue, speech craft, presentation delivery, and accent clarity.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-[#131D33] border border-purple-500/20 shadow-sm space-y-3">
                    <div class="text-purple-600 dark:text-purple-400 font-bold text-base flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-purple-500/10 flex items-center justify-center text-xs">02</span> Multidisciplinary Edge
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Communication does not exist in a vacuum. We empower students with cognitive behavioral principles and commercial business accounting insights.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-[#131D33] border border-emerald-500/20 shadow-sm space-y-3">
                    <div class="text-emerald-600 dark:text-emerald-400 font-bold text-base flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-emerald-500/10 flex items-center justify-center text-xs">03</span> Personalized Mentorship
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Direct engagement with university lecturers and seasoned coaches who give individual feedback to overcome hesitation and build authentic confidence.
                    </p>
                </div>
            </div>
        </div>

        <!-- Faculty Showcase Preview -->
        <?php if (!empty($resourcePersons)): ?>
            <div class="text-center max-w-2xl mx-auto mb-12">
                <div class="text-[#E5A93C] text-xs font-bold uppercase tracking-widest">OUR DISTINGUISHED EDUCATORS</div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Meet Our Resource Persons</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach (array_slice($resourcePersons, 0, 4) as $rp): ?>
                    <div class="elo-card p-5 text-center">
                        <img src="<?= BASE_URL . htmlspecialchars($rp['photo'] ?: '/assets/img/teachers/senaka.jpg', ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($rp['name'], ENT_QUOTES, 'UTF-8') ?>" class="w-20 h-20 mx-auto rounded-full object-cover border-2 border-[#E5A93C]/40 mb-3 shadow">
                        <h4 class="text-sm font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($rp['name'], ENT_QUOTES, 'UTF-8') ?></h4>
                        <p class="text-xs text-[#E5A93C] font-semibold mt-0.5"><?= htmlspecialchars($rp['title'], ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="text-[11px] text-slate-600 dark:text-slate-400 mt-1 italic"><?= htmlspecialchars($rp['qualifications'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
