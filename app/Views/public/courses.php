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
<section class="bg-[#0B132B] text-white pt-16 pb-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-3">
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Our Courses</h1>
        <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto">
            Choose from a range of professionally designed courses to build your language, academic, and career skills.
        </p>
    </div>
    <!-- Curved Wave Shape Divider -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 sm:h-16 text-[var(--page-bg)] fill-current">
            <path d="M0,0 C150,90 350,-40 500,40 C650,120 900,20 1200,60 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- SEARCH BAR & CATEGORY FILTER PILLS (MATCHING REFERENCE IMAGE)       -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Input Bar -->
        <div class="max-w-xl mx-auto mb-10">
            <form action="<?= BASE_URL ?>/courses" method="GET" class="relative">
                <?php if (!empty($currentSubject)): ?>
                    <input type="hidden" name="subject_area" value="<?= (int) $currentSubject ?>">
                <?php endif; ?>
                <input type="text" name="q" value="<?= htmlspecialchars($currentSearch ?? '', ENT_QUOTES, 'UTF-8') ?>"
                       placeholder="Search for a course..."
                       class="w-full pl-12 pr-28 py-3.5 rounded-full border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#111A2E] text-slate-900 dark:text-white shadow-sm focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 text-sm">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 btn-gold text-xs py-2 px-5">
                    Search
                </button>
            </form>
        </div>

        <!-- Category Filter Pills -->
        <div class="flex items-center justify-center flex-wrap gap-2.5 mb-14">
            <a href="<?= BASE_URL ?>/courses<?= $currentSearch ? '?q=' . urlencode($currentSearch) : '' ?>"
               class="px-5 py-2.5 rounded-full text-xs font-bold transition-all <?= empty($currentSubject) ? 'bg-[#E5A93C] text-[#0B132B] shadow-md shadow-[#E5A93C]/25' : 'bg-white dark:bg-[#111A2E] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-[#E5A93C]' ?>">
                All Courses
            </a>
            <?php foreach ($subjectAreas as $sa): ?>
                <?php $isActive = (!empty($currentSubject) && (int) $currentSubject === (int) $sa['id']); ?>
                <a href="<?= BASE_URL ?>/courses?subject_area=<?= (int) $sa['id'] ?><?= $currentSearch ? '&q=' . urlencode($currentSearch) : '' ?>"
                   class="px-5 py-2.5 rounded-full text-xs font-bold transition-all <?= $isActive ? 'bg-[#E5A93C] text-[#0B132B] shadow-md shadow-[#E5A93C]/25' : 'bg-white dark:bg-[#111A2E] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-[#E5A93C]' ?>">
                    <?= htmlspecialchars($sa['name'], ENT_QUOTES, 'UTF-8') ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- COURSES GRID (MATCHING REFERENCE IMAGE)                     -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <?php if (empty($courses)): ?>
            <div class="text-center py-20 bg-white dark:bg-[#111A2E] rounded-3xl border border-slate-200 dark:border-slate-800 p-8 max-w-md mx-auto">
                <div class="text-4xl mb-3">🔍</div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">No courses found</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Try searching with different keywords or clearing the category filter.</p>
                <div class="mt-5">
                    <a href="<?= BASE_URL ?>/courses" class="btn-gold text-xs py-2 px-5">View All Courses</a>
                </div>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($courses as $c): ?>
                    <?php
                        $thumb = $c['course_thumbnail'] ?: '/assets/img/courses/english-global.jpg';
                        $fee = number_format((float) ($c['price'] ?? $c['monthly_fee'] ?? 0), 2);
                    ?>
                    <div class="elo-card overflow-hidden flex flex-col justify-between group">
                        <div>
                            <!-- Course Thumbnail -->
                            <div class="relative h-44 overflow-hidden bg-slate-800">
                                <img src="<?= BASE_URL . htmlspecialchars($thumb, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($c['class_name'], ENT_QUOTES, 'UTF-8') ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3 bg-[#0B132B]/85 backdrop-blur-sm text-[#E5A93C] border border-[#E5A93C]/30 text-[10px] font-bold uppercase px-2.5 py-1 rounded-full">
                                    <?= htmlspecialchars($c['subject_area_name'] ?? $c['subject'] ?? 'English', ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            </div>

                            <!-- Course Title & Meta -->
                            <div class="p-5">
                                <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-[#E5A93C] transition-colors leading-snug">
                                    <a href="<?= BASE_URL ?>/courses/<?= (int) $c['id'] ?>">
                                        <?= htmlspecialchars($c['class_name'], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </h3>

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

                        <!-- Price & Arrow Button -->
                        <div class="p-5 pt-0 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block uppercase font-semibold">Tuition Fee</span>
                                <span class="text-base font-extrabold text-slate-900 dark:text-white">LKR <?= $fee ?></span>
                            </div>
                            <a href="<?= BASE_URL ?>/courses/<?= (int) $c['id'] ?>" class="w-9 h-9 rounded-full bg-[#E5A93C]/15 text-[#E5A93C] hover:bg-[#E5A93C] hover:text-[#0B132B] flex items-center justify-center transition-colors text-sm font-bold" title="View Course Details">
                                &rarr;
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
