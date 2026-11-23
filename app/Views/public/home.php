<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Modern University-Style Homepage
 * Matching uploaded reference design
 */
$slogan = $settings['academy_slogan'] ?? 'Learn English. Speak Confidently. Succeed Globally.';
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
<!-- 1. HERO SECTION                                                     -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="relative bg-[#0B132B] text-white pt-12 pb-24 md:py-20 overflow-hidden">
    <!-- Atmospheric background glows -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#E5A93C]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-40 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(#ffffff08_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Hero Left Content -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Academy Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 text-[#E5A93C] text-xs font-semibold tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-[#E5A93C] animate-pulse"></span>
                    ELOCENTRA – English Academy (PVT) LTD
                </div>

                <!-- Main Slogan Heading -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.15]">
                    Learn English.<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-slate-300">Speak Confidently.</span><br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F59E0B] via-[#E5A93C] to-[#FCD34D]">Succeed Globally.</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-slate-300 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    A modern learning platform to build your language, communication, and professional skills for a global future.
                </p>

                <!-- CTA Buttons -->
                <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="<?= BASE_URL ?>/courses" class="btn-gold text-base py-3.5 px-8">
                        Explore Courses
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="<?= BASE_URL ?>/register" class="btn-outline-gold text-base py-3.5 px-8">
                        Join Now
                    </a>
                </div>
            </div>

            <!-- Hero Right Visual with Reference Elements -->
            <div class="lg:col-span-5 relative flex items-center justify-center">
                <!-- Circular Gold Decorative Ring -->
                <div class="absolute w-72 sm:w-96 h-72 sm:h-96 rounded-full border border-[#E5A93C]/30 animate-[spin_40s_linear_infinite] pointer-events-none"></div>
                <div class="absolute w-80 sm:w-[420px] h-80 sm:h-[420px] rounded-full border border-dashed border-[#E5A93C]/20 pointer-events-none"></div>

                <!-- Main Student Photo Container -->
                <div class="relative w-full max-w-sm sm:max-w-md rounded-3xl overflow-hidden shadow-2xl border-2 border-white/10 z-10 bg-slate-900 group">
                    <img src="<?= BASE_URL ?>/assets/img/brand/hero-student.jpg" alt="ELOCENTRA Student" class="w-full h-80 sm:h-96 object-cover object-top transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0B132B] via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Floating Pill 1: Flexible Learning -->
                <div class="absolute -top-4 -left-4 sm:left-2 bg-[#0B132B]/90 backdrop-blur-md border border-[#E5A93C]/40 py-2 px-4 rounded-xl shadow-xl flex items-center gap-2.5 z-20">
                    <span class="w-8 h-8 rounded-lg bg-[#E5A93C]/20 text-[#E5A93C] flex items-center justify-center text-sm">🎓</span>
                    <div>
                        <div class="text-xs font-bold text-white">Flexible Learning</div>
                        <div class="text-[10px] text-slate-400">Self-paced & Online</div>
                    </div>
                </div>

                <!-- Floating Pill 2: Expert Resource Persons -->
                <div class="absolute top-1/2 -right-4 sm:-right-6 -translate-y-1/2 bg-[#0B132B]/90 backdrop-blur-md border border-[#E5A93C]/40 py-2 px-4 rounded-xl shadow-xl flex items-center gap-2.5 z-20">
                    <span class="w-8 h-8 rounded-lg bg-[#E5A93C]/20 text-[#E5A93C] flex items-center justify-center text-sm">👥</span>
                    <div>
                        <div class="text-xs font-bold text-white">Expert Resource Persons</div>
                        <div class="text-[10px] text-slate-400">University Academics</div>
                    </div>
                </div>

                <!-- Floating Pill 3: Industry-Relevant Courses -->
                <div class="absolute -bottom-5 left-8 bg-[#0B132B]/90 backdrop-blur-md border border-[#E5A93C]/40 py-2 px-4 rounded-xl shadow-xl flex items-center gap-2.5 z-20">
                    <span class="w-8 h-8 rounded-lg bg-[#E5A93C]/20 text-[#E5A93C] flex items-center justify-center text-sm">💼</span>
                    <div>
                        <div class="text-xs font-bold text-white">Industry-Relevant Courses</div>
                        <div class="text-[10px] text-slate-400">Global Competence</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 2. FOUR PILLARS FEATURE BAND                                        -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="relative z-20 -mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-[#111A2E] rounded-2xl shadow-xl border border-slate-200 dark:border-slate-800 p-6 md:p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <!-- Pillar 1 -->
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/15 text-[#E5A93C] flex items-center justify-center text-2xl shrink-0">
                    📚
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Diverse Subject Areas</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Language, Psychology, Business & more</p>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/15 text-[#E5A93C] flex items-center justify-center text-2xl shrink-0">
                    👨‍🏫
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Expert Resource Persons</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Qualified & experienced educators</p>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/15 text-[#E5A93C] flex items-center justify-center text-2xl shrink-0">
                    🚀
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Practical Learning</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Real-world communication skills</p>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/15 text-[#E5A93C] flex items-center justify-center text-2xl shrink-0">
                    🌍
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Global Opportunities</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Build a future without borders</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 3. WHO WE ARE & VISION / MISSION / GOALS (FROM REFERENCE IMAGE)     -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header / Intro -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center mb-16">
            <div class="lg:col-span-5 relative">
                <div class="rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-xl">
                    <img src="<?= BASE_URL ?>/assets/img/brand/about-campus.jpg" alt="ELOCENTRA Academy" class="w-full h-80 object-cover">
                </div>
                <div class="absolute -bottom-6 -right-6 bg-[#0B132B] text-white p-5 rounded-2xl shadow-xl hidden sm:block border border-[#E5A93C]/30 max-w-xs">
                    <div class="text-[#E5A93C] text-sm font-bold uppercase tracking-wider">ELOCENTRA</div>
                    <div class="text-xs text-slate-300 mt-1">Dedicated to international academic excellence and career proficiency.</div>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-4">
                <div class="text-[#E5A93C] text-xs font-bold uppercase tracking-widest">WHO WE ARE</div>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    ELOCENTRA – English Academy (PVT) LTD
                </h2>
                <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed">
                    ELOCENTRA is a modern English Academy dedicated to developing language proficiency, communication confidence, and academic &amp; professional competence for learners who aspire to succeed globally.
                </p>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                    Through innovative curriculum design, highly qualified resource persons, interactive digital infrastructure, and multidisciplinary subject pathways, we ensure that every student gains the confidence to articulate ideas fluently in global professional environments.
                </p>
                <div class="pt-2">
                    <a href="<?= BASE_URL ?>/about" class="inline-flex items-center text-sm font-bold text-[#E5A93C] hover:underline">
                        Discover Our Full Story &amp; Approach &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- 4 Iconic Cards: Vision, Mission, Main Goal, Supporting Goals -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1: Our Vision -->
            <div class="elo-card p-6 flex flex-col justify-between relative group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/10 text-[#E5A93C] flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        👁️
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

            <!-- Card 2: Our Mission -->
            <div class="elo-card p-6 flex flex-col justify-between relative group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/10 text-[#E5A93C] flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        🎯
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

            <!-- Card 3: Main Goal -->
            <div class="elo-card p-6 flex flex-col justify-between relative group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/10 text-[#E5A93C] flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        🏆
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

            <!-- Card 4: Supporting Goals -->
            <div class="elo-card p-6 flex flex-col justify-between relative group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/10 text-[#E5A93C] flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        ⚡
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Supporting Goals</h3>
                        <div class="text-xs font-semibold text-[#E5A93C] mb-2">The steps that strengthen our goal</div>
                        <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-1.5 list-disc list-inside">
                            <?php foreach (array_slice($supportingGoals, 0, 3) as $goal): ?>
                                <li><?= htmlspecialchars($goal, ENT_QUOTES, 'UTF-8') ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 4. SUBJECT AREAS SECTION                                            -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-16 bg-slate-100/70 dark:bg-[#070D1F]/50 border-y border-slate-200 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <div class="text-[#E5A93C] text-xs font-bold uppercase tracking-widest">ACADEMIC DISCIPLINES</div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Explore Subject Areas</h2>
            <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">Comprehensive pathways from communication fluency to professional business mastery.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($subjectAreas as $sa): ?>
                <a href="<?= BASE_URL ?>/courses?subject_area=<?= (int) $sa['id'] ?>" class="elo-card p-6 block group text-left">
                    <div class="w-12 h-12 rounded-xl bg-[#0B132B] text-[#E5A93C] flex items-center justify-center text-xl mb-4 group-hover:bg-[#E5A93C] group-hover:text-[#0B132B] transition-colors">
                        📖
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-[#E5A93C] transition-colors">
                        <?= htmlspecialchars($sa['name'], ENT_QUOTES, 'UTF-8') ?>
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 line-clamp-2">
                        <?= htmlspecialchars($sa['description'] ?? 'Curated university-level curriculum.', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <div class="mt-4 flex items-center justify-between text-xs font-semibold text-[#E5A93C]">
                        <span><?= (int) ($sa['course_count'] ?? 0) ?> Courses</span>
                        <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- 5. FEATURED COURSES SECTION                                         -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <div class="text-[#E5A93C] text-xs font-bold uppercase tracking-widest">CURATED CURRICULUM</div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Available Courses</h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Professionally designed courses to build language proficiency, confidence, and career skills.</p>
            </div>
            <div>
                <a href="<?= BASE_URL ?>/courses" class="btn-outline-gold text-xs py-2.5 px-6">
                    View All Courses &rarr;
                </a>
            </div>
        </div>

        <!-- Courses Grid matching reference images -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($courses as $c): ?>
                <?php
                    $thumb = $c['course_thumbnail'] ?: '/assets/img/courses/english-global.jpg';
                    $fee = number_format((float) ($c['price'] ?? $c['monthly_fee'] ?? 0), 2);
                ?>
                <div class="elo-card overflow-hidden flex flex-col justify-between group">
                    <div>
                        <!-- Thumbnail -->
                        <div class="relative h-44 overflow-hidden bg-slate-800">
                            <img src="<?= BASE_URL . htmlspecialchars($thumb, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($c['class_name'], ENT_QUOTES, 'UTF-8') ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3 bg-[#0B132B]/85 backdrop-blur-sm text-[#E5A93C] border border-[#E5A93C]/30 text-[10px] font-bold uppercase px-2.5 py-1 rounded-full">
                                <?= htmlspecialchars($c['subject_area_name'] ?? $c['subject'] ?? 'English', ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5">
                            <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-[#E5A93C] transition-colors leading-snug">
                                <a href="<?= BASE_URL ?>/courses/<?= (int) $c['id'] ?>">
                                    <?= htmlspecialchars($c['class_name'], ENT_QUOTES, 'UTF-8') ?>
                                </a>
                            </h3>
                            
                            <!-- Meta: Duration & Mode -->
                            <div class="flex items-center gap-4 text-xs text-slate-500 dark:text-slate-400 mt-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-[#E5A93C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <?= htmlspecialchars($c['duration_weeks'] ?? '12 Weeks', ENT_QUOTES, 'UTF-8') ?>
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-[#E5A93C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <?= ucfirst(htmlspecialchars($c['delivery_mode'] ?? 'Online', ENT_QUOTES, 'UTF-8')) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer: Price & Arrow Button -->
                    <div class="p-5 pt-0 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block uppercase font-semibold">Course Fee</span>
                            <span class="text-base font-extrabold text-slate-900 dark:text-white">LKR <?= $fee ?></span>
                        </div>
                        <a href="<?= BASE_URL ?>/courses/<?= (int) $c['id'] ?>" class="w-9 h-9 rounded-full bg-[#E5A93C]/15 text-[#E5A93C] hover:bg-[#E5A93C] hover:text-[#0B132B] flex items-center justify-center transition-colors text-sm font-bold" title="View Course Details">
                            &rarr;
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
<section class="py-20 bg-slate-100/70 dark:bg-[#070D1F]/60 border-t border-slate-200 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="text-[#E5A93C] text-xs font-bold uppercase tracking-widest">ACADEMIC EXCELLENCE</div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Resource Persons &amp; Faculty</h2>
            <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">Learn from seasoned university professors, industry specialists, and international master trainers.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($resourcePersons as $rp): ?>
                <?php $photo = $rp['photo'] ?: '/assets/img/teachers/senaka.jpg'; ?>
                <div class="elo-card p-6 text-center group">
                    <!-- Photo -->
                    <div class="w-28 h-28 mx-auto rounded-full overflow-hidden border-2 border-[#E5A93C]/40 mb-4 shadow-lg bg-slate-800">
                        <img src="<?= BASE_URL . htmlspecialchars($photo, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($rp['name'], ENT_QUOTES, 'UTF-8') ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <!-- Details -->
                    <h3 class="text-base font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($rp['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <div class="text-xs text-[#E5A93C] font-semibold mt-1"><?= htmlspecialchars($rp['title'], ENT_QUOTES, 'UTF-8') ?></div>
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
<!-- 7. CALL TO ACTION BANNER                                            -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-16 bg-gradient-to-r from-[#0B132B] via-[#0D1B3E] to-[#0B132B] text-white text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 relative z-10 space-y-6">
        <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
            Ready to Speak Confidently and Succeed Globally?
        </h2>
        <p class="text-slate-300 text-sm sm:text-base max-w-xl mx-auto">
            Take the first step towards academic and professional advancement today. Join ELOCENTRA's world-class learning community.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="<?= BASE_URL ?>/register" class="btn-gold text-base py-3 px-8">
                Register as a Student
            </a>
            <a href="<?= BASE_URL ?>/contact" class="btn-outline-gold text-base py-3 px-8">
                Inquire With Us
            </a>
        </div>
    </div>
</section>
