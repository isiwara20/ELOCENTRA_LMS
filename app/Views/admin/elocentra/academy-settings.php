<?php
/**
 * Academy Information & Settings Management
 * ELOCENTRA – English Academy (PVT) LTD
 */

$supportingGoals = [];
if (!empty($settings['academy_supporting_goals'])) {
    $decoded = json_decode($settings['academy_supporting_goals'], true);
    if (is_array($decoded)) {
        $supportingGoals = $decoded;
    }
}
if (empty($supportingGoals)) {
    $supportingGoals = [
        'Interactive & communicative student-centered learning methodologies.',
        'Expert guidance from certified language trainers & corporate specialists.',
        'Real-world speaking drills, interview prep & public speaking masterclasses.',
        'Global certification recognized for academic & professional advancement.'
    ];
}
?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Academy Information & Institutional Profile
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Dynamically update ELOCENTRA branding, slogan, vision, mission, institutional goals, and contact channels.
            </p>
        </div>
        <div>
            <a href="<?= BASE_URL ?>/" target="_blank" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 text-xs font-semibold flex items-center gap-1.5 transition-colors">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Preview Homepage
            </a>
        </div>
    </div>

    <form action="<?= BASE_URL ?>/admin/academy-settings" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <!-- 1. Identity & Slogan -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2 border-b border-slate-200 dark:border-slate-700 pb-3">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                1. Institutional Identity & Slogan
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Academy Name <span class="text-rose-500">*</span></label>
                    <input type="text" name="academy_name" required value="<?= htmlspecialchars($settings['academy_name'] ?? 'ELOCENTRA – English Academy (PVT) LTD') ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500 font-semibold">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Official Slogan <span class="text-rose-500">*</span></label>
                    <input type="text" name="academy_slogan" required value="<?= htmlspecialchars($settings['academy_slogan'] ?? 'Learn English. Speak Confidently. Succeed Globally.') ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500 font-medium">
                    <p class="text-[11px] text-slate-400 mt-1">Displayed in the hero banner, navbar badge, and authentication pages.</p>
                </div>
            </div>
        </div>

        <!-- 2. Vision, Mission & Goals -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2 border-b border-slate-200 dark:border-slate-700 pb-3">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                2. Vision, Mission & Institutional Goals
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Our Vision</label>
                    <textarea name="academy_vision" rows="3" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500"><?= htmlspecialchars($settings['academy_vision'] ?? 'The future we seek to create: To be the premier English language and professional competence academy.') ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Our Mission</label>
                    <textarea name="academy_mission" rows="3" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500"><?= htmlspecialchars($settings['academy_mission'] ?? 'The purpose that drives us: Empowering learners to communicate with confidence and academic fluency.') ?></textarea>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Main Goal</label>
                <textarea name="academy_main_goal" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500"><?= htmlspecialchars($settings['academy_main_goal'] ?? 'Our primary focus: Build fluent, job-ready English speakers with global competence.') ?></textarea>
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300">Supporting Goals</label>
                    <button type="button" onclick="addGoalField()" class="text-xs text-amber-600 dark:text-amber-400 font-semibold hover:underline flex items-center gap-1">
                        + Add Another Goal
                    </button>
                </div>
                <div id="supporting_goals_container" class="space-y-2">
                    <?php foreach ($supportingGoals as $idx => $goal): ?>
                        <div class="flex items-center gap-2">
                            <span class="w-6 text-center text-xs text-slate-400 font-mono"><?= $idx + 1 ?>.</span>
                            <input type="text" name="supporting_goals[]" value="<?= htmlspecialchars($goal) ?>" class="flex-1 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
                            <button type="button" onclick="this.parentElement.remove()" class="p-2 text-rose-500 hover:text-rose-700 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/40">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- 3. Academy Contact & Operating Hours -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2 border-b border-slate-200 dark:border-slate-700 pb-3">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                3. Contact Information & Campus Address
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Official Email Address</label>
                    <input type="email" name="academy_email" value="<?= htmlspecialchars($settings['academy_email'] ?? 'info@elocentra.academy') ?>" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Official Hotline / Phone</label>
                    <input type="text" name="academy_phone" value="<?= htmlspecialchars($settings['academy_phone'] ?? '+94 77 123 4567') ?>" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">WhatsApp Inquiry Line</label>
                    <input type="text" name="academy_whatsapp" value="<?= htmlspecialchars($settings['academy_whatsapp'] ?? '+94 77 123 4567') ?>" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Campus Physical Address</label>
                    <input type="text" name="academy_address" value="<?= htmlspecialchars($settings['academy_address'] ?? 'No. 123, Education Lane, Colombo, Sri Lanka') ?>" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Office Hours</label>
                    <input type="text" name="academy_office_hours" value="<?= htmlspecialchars($settings['academy_office_hours'] ?? 'Mon - Fri: 9.00 AM - 5.00 PM') ?>" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-semibold text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Update Academy Settings
            </button>
        </div>
    </form>
</div>

<script>
function addGoalField() {
    const container = document.getElementById('supporting_goals_container');
    const count = container.children.length + 1;
    const div = document.createElement('div');
    div.className = 'flex items-center gap-2';
    div.innerHTML = `
        <span class="w-6 text-center text-xs text-slate-400 font-mono">${count}.</span>
        <input type="text" name="supporting_goals[]" placeholder="Enter supporting goal..." class="flex-1 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
        <button type="button" onclick="this.parentElement.remove()" class="p-2 text-rose-500 hover:text-rose-700 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/40">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>
    `;
    container.appendChild(div);
}
</script>
