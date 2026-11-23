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
<section class="bg-[#0B132B] text-white pt-16 pb-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-3">
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">About Us</h1>
        <div class="flex items-center justify-center gap-2 text-xs font-semibold text-slate-300">
            <a href="<?= BASE_URL ?>/" class="hover:text-[#E5A93C] transition-colors">Home</a>
            <span>&gt;</span>
            <span class="text-[#E5A93C]">About Us</span>
        </div>
    </div>
    <!-- Curved Wave Shape Divider -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none">
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

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- 4 PILLARS: VISION, MISSION, MAIN GOAL, SUPPORTING GOALS     -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
            <!-- Our Vision -->
            <div class="elo-card p-6 flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Our Vision</h3>
                        <div class="text-xs font-semibold text-[#E5A93C] mb-2">The future we seek to create</div>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            <?= htmlspecialchars($vision, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Our Mission -->
            <div class="elo-card p-6 flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Our Mission</h3>
                        <div class="text-xs font-semibold text-[#E5A93C] mb-2">The purpose that drives us</div>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            <?= htmlspecialchars($mission, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Main Goal -->
            <div class="elo-card p-6 flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Main Goal</h3>
                        <div class="text-xs font-semibold text-[#E5A93C] mb-2">Our primary focus</div>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            <?= htmlspecialchars($mainGoal, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Supporting Goals -->
            <div class="elo-card p-6 flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Supporting Goals</h3>
                        <div class="text-xs font-semibold text-[#E5A93C] mb-2">The steps that strengthen our goal</div>
                        <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-1.5 list-disc list-inside leading-snug">
                            <?php foreach ($supportingGoals as $goal): ?>
                                <li><?= htmlspecialchars($goal, ENT_QUOTES, 'UTF-8') ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- EDUCATIONAL APPROACH                                        -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <div class="bg-slate-100/80 dark:bg-[#070D1F]/60 rounded-3xl p-8 sm:p-12 border border-slate-200 dark:border-slate-800 mb-20 transition-colors">
            <div class="max-w-3xl mb-8">
                <div class="text-[#E5A93C] text-xs font-bold uppercase tracking-widest">METHODOLOGY</div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Our Educational Approach</h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">At ELOCENTRA, learning is participatory, interactive, and aligned with international CEFR standards.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-3">
                    <div class="text-[#E5A93C] font-bold text-base flex items-center gap-2">
                        <span>01.</span> Communicative Fluency
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Rather than rote grammar memorization, our instruction focuses on situational dialogue, speech craft, presentation delivery, and accent clarity.
                    </p>
                </div>
                <div class="space-y-3">
                    <div class="text-[#E5A93C] font-bold text-base flex items-center gap-2">
                        <span>02.</span> Multidisciplinary Edge
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Communication does not exist in a vacuum. We empower students with cognitive behavioral principles and commercial business accounting insights.
                    </p>
                </div>
                <div class="space-y-3">
                    <div class="text-[#E5A93C] font-bold text-base flex items-center gap-2">
                        <span>03.</span> Personalized Mentorship
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
