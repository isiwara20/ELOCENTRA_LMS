<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Dedicated About Us Page
 * Matching uploaded reference design
 */
$vision = $settings['academy_vision'] ?? 'To be the premier English academy empowering students with fluent communication, critical thinking, and global competence.';
$mission = $settings['academy_mission'] ?? 'To provide transformative, accessible, and high-standard English language and multidisciplinary education that enables learners to excel academically, professionally, and internationally.';
$mainGoal = $settings['academy_main_goal'] ?? 'Equip every learner with fluent English communication, confidence, and real-world skills to thrive in global academic and career environments.';
$supportingGoals = json_decode($settings['academy_supporting_goals'] ?? '[]', true) ?: [
    'Provide comprehensive, practical language curriculum from foundational to advanced levels.',
    'Foster interactive learning environments guided by experienced educators.',
    'Integrate multidisciplinary knowledge including psychology and business communication.',
    'Deliver accessible, modern online and blended learning opportunities.'
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
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 sm:h-16 text-[var(--page-bg)] fill-current">
            <path d="M0,0 C150,90 350,-40 500,40 C650,120 900,20 1200,60 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- WHO WE ARE SECTION (MATCHING TOP RIGHT REFERENCE IMAGE)            -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20">
            <!-- Left Academic Image -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-2xl">
                    <img src="<?= BASE_URL ?>/assets/img/brand/about-campus.jpg" alt="ELOCENTRA Academy" class="w-full h-96 object-cover">
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
                <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed font-medium">
                    ELOCENTRA is a modern English Academy dedicated to developing language proficiency, communication confidence, and academic &amp; professional competence for learners who aspire to succeed globally.
                </p>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                    Established with a vision for modern, accessible, and high-impact education, ELOCENTRA integrates comprehensive English training with multidisciplinary disciplines including psychology and business accounting. We provide students, corporate executives, and aspiring global scholars with the intellectual foundation and practical communication abilities required to thrive on an international stage.
                </p>
                
                <div class="pt-4 grid grid-cols-2 gap-4 border-t border-slate-200 dark:border-slate-800">
                    <div>
                        <div class="text-2xl font-extrabold text-[#E5A93C]">100%</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Interactive Practical Focus</div>
                    </div>
                    <div>
                        <div class="text-2xl font-extrabold text-[#E5A93C]">Global</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Standard Accreditation Curriculum</div>
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
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/10 text-[#E5A93C] flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        👁️
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Our Vision</h3>
                    <div class="text-xs font-semibold text-[#E5A93C]">The future we seek to create</div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?= htmlspecialchars($vision, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
            </div>

            <!-- Our Mission -->
            <div class="elo-card p-6 flex flex-col justify-between group">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/10 text-[#E5A93C] flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        🎯
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Our Mission</h3>
                    <div class="text-xs font-semibold text-[#E5A93C]">The purpose that drives us</div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?= htmlspecialchars($mission, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
            </div>

            <!-- Main Goal -->
            <div class="elo-card p-6 flex flex-col justify-between group">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/10 text-[#E5A93C] flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        🏆
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Main Goal</h3>
                    <div class="text-xs font-semibold text-[#E5A93C]">Our primary focus</div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?= htmlspecialchars($mainGoal, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
            </div>

            <!-- Supporting Goals -->
            <div class="elo-card p-6 flex flex-col justify-between group">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/10 text-[#E5A93C] flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        ⚡
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Supporting Goals</h3>
                    <div class="text-xs font-semibold text-[#E5A93C]">The steps that strengthen our goal</div>
                    <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-1.5 list-disc list-inside leading-relaxed">
                        <?php foreach ($supportingGoals as $goal): ?>
                            <li><?= htmlspecialchars($goal, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- EDUCATIONAL APPROACH                                        -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <div class="bg-slate-100/70 dark:bg-[#070D1F]/50 rounded-3xl p-8 sm:p-12 border border-slate-200 dark:border-slate-800 mb-20">
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
                        <img src="<?= BASE_URL . htmlspecialchars($rp['photo'] ?: '/assets/img/teachers/senaka.jpg', ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($rp['name'], ENT_QUOTES, 'UTF-8') ?>" class="w-20 h-20 mx-auto rounded-full object-cover border-2 border-[#E5A93C]/40 mb-3">
                        <h4 class="text-sm font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($rp['name'], ENT_QUOTES, 'UTF-8') ?></h4>
                        <p class="text-xs text-[#E5A93C] mt-0.5"><?= htmlspecialchars($rp['title'], ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1"><?= htmlspecialchars($rp['qualifications'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
