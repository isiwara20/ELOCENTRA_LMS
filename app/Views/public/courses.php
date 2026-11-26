<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Courses Catalog Page
 * Matching uploaded reference design (Middle-Left panel)
 */
?>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- COURSES HEADER & HERO                                               -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="relative bg-[#060B18] text-white pt-16 pb-24 overflow-hidden select-none">
    <!-- Academic Digital Study Desk Background - Clear & Luminous in Night Mode -->
    <div class="hero-banner-bg absolute inset-0 w-full h-full bg-cover bg-center transform scale-100"
         style="background-image: url('<?= BASE_URL ?>/public/assets/img/slider/courses-banner.jpg');">
    </div>
    <div class="hero-banner-overlay absolute inset-0 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-3">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 border border-white/20 text-[#E5A93C] text-xs font-semibold tracking-wider uppercase backdrop-blur-md">
            <span class="w-1.5 h-1.5 rounded-full bg-[#E5A93C]"></span>
            Academic Curricula
        </div>
        <h1 class="hero-banner-title text-3xl sm:text-5xl font-extrabold tracking-tight" style="color: #FFFFFF !important; text-shadow: 0 2px 14px rgba(0,0,0,0.75);">Our Courses</h1>
        <p class="text-slate-200 text-sm sm:text-base max-w-2xl mx-auto">
            Choose from a range of professionally designed courses to build your language, academic, and career skills.
        </p>
    </div>
    <!-- Curved Wave Shape Divider -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none z-10">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 sm:h-16 text-[var(--page-bg)] fill-current transition-colors">
            <path d="M0,0 C150,90 350,-40 500,40 C650,120 900,20 1200,60 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- SEARCH BAR & CATEGORY FILTER PILLS (MATCHING REFERENCE IMAGE)       -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Input Bar with Auto-Suggestions -->
        <div class="max-w-xl mx-auto mb-10">
            <form action="<?= BASE_URL ?>/courses" method="GET" class="relative" id="courseCatalogSearchForm" autocomplete="off">
                <?php if (!empty($currentSubject)): ?>
                    <input type="hidden" name="subject_area" value="<?= (int) $currentSubject ?>">
                <?php endif; ?>
                <input type="text" name="q" id="courseSearchInput" value="<?= htmlspecialchars($currentSearch ?? '', ENT_QUOTES, 'UTF-8') ?>"
                       placeholder="Search courses by title, subject or code..."
                       autocomplete="off"
                       class="w-full pl-12 pr-28 py-3.5 rounded-full border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#111A2E] text-slate-900 dark:text-white shadow-sm focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 text-sm">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 btn-gold text-xs py-2 px-5">
                    Search
                </button>
                <!-- Live Auto-Suggestions Dropdown -->
                <div id="courseAutoSuggestions" class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-white dark:bg-[#0F172A] rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden divide-y divide-slate-100 dark:divide-slate-800/60 transition-all"></div>
            </form>
        </div>

        <!-- Category Filter Pills -->
        <div class="flex items-center justify-center flex-wrap gap-2.5 mb-14">
            <a href="<?= BASE_URL ?>/courses<?= $currentSearch ? '?q=' . urlencode($currentSearch) : '' ?>"
               class="px-5 py-2.5 rounded-full text-xs font-bold transition-all <?= empty($currentSubject) ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25 ring-2 ring-blue-600/30' : 'bg-white dark:bg-[#131D33] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400' ?>">
                All Courses
            </a>
            <?php foreach ($subjectAreas as $sa): ?>
                <?php $isActive = (!empty($currentSubject) && (int) $currentSubject === (int) $sa['id']); ?>
                <a href="<?= BASE_URL ?>/courses?subject_area=<?= (int) $sa['id'] ?><?= $currentSearch ? '&q=' . urlencode($currentSearch) : '' ?>"
                   class="px-5 py-2.5 rounded-full text-xs font-bold transition-all <?= $isActive ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25 ring-2 ring-blue-600/30' : 'bg-white dark:bg-[#131D33] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400' ?>">
                    <?= htmlspecialchars($sa['name'], ENT_QUOTES, 'UTF-8') ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- COURSES GRID (MATCHING REFERENCE IMAGE)                     -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <?php if (empty($courses)): ?>
            <div class="text-center py-20 bg-white dark:bg-[#131D33] rounded-3xl border border-slate-200 dark:border-slate-800 p-8 max-w-md mx-auto shadow-sm">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-4 border border-blue-500/20">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">No courses found</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Try searching with different keywords or clearing the category filter.</p>
                <div class="mt-5">
                    <a href="<?= BASE_URL ?>/courses" class="btn-gold text-xs py-2 px-5">View All Courses</a>
                </div>
            </div>
        <?php else: ?>
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
                    <div class="elo-card overflow-hidden flex flex-col justify-between group border border-slate-200 dark:border-slate-800 hover:border-blue-500/60 transition-all">
                        <div>
                            <!-- Course Thumbnail -->
                            <div class="relative h-44 overflow-hidden bg-slate-900">
                                <img src="<?= BASE_URL . htmlspecialchars($thumb, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($c['class_name'], ENT_QUOTES, 'UTF-8') ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3 <?= $bStyle ?> backdrop-blur-sm text-[10px] font-bold uppercase px-3 py-1 rounded-full shadow-md">
                                    <?= htmlspecialchars($c['subject_area_name'] ?? $c['subject'] ?? 'English', ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            </div>

                            <!-- Course Title & Meta -->
                            <div class="p-5">
                                <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors leading-snug">
                                    <a href="<?= BASE_URL ?>/courses/<?= (int) $c['id'] ?>">
                                        <?= htmlspecialchars($c['class_name'], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </h3>

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

                        <!-- Price & Arrow Button -->
                        <div class="p-5 pt-0 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-500 dark:text-slate-400 block uppercase font-semibold">Tuition Fee</span>
                                <span class="text-base font-extrabold text-blue-600 dark:text-blue-400">LKR <?= $fee ?></span>
                            </div>
                            <a href="<?= BASE_URL ?>/courses/<?= (int) $c['id'] ?>" class="w-9 h-9 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors shadow-sm" title="View Course Details">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
