<?php
/**
 * Homepage Banner Slider Management View
 * ELOCENTRA – English Academy (PVT) LTD
 */
?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2" stroke-width="2"/>
                    <line x1="8" y1="21" x2="16" y2="21" stroke-width="2"/>
                    <line x1="12" y1="17" x2="12" y2="21" stroke-width="2"/>
                </svg>
                Homepage Banner Image Slider
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Manage the images, titles, subtitles, and call-to-actions displayed in the rotating homepage banner.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= BASE_URL ?>/" target="_blank" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 text-xs font-semibold flex items-center gap-1.5 transition-colors">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Preview Live Slider
            </a>
            <button onclick="openAddBannerModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-semibold text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Banner Slide
            </button>
        </div>
    </div>

    <!-- Alert / Info Notice -->
    <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-950/30 dark:to-orange-950/30 border border-amber-200 dark:border-amber-800/60 rounded-xl p-4 text-sm text-amber-900 dark:text-amber-200 flex items-start gap-3">
        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="font-semibold mb-0.5">Automated Rotating Slider</p>
            <p class="text-xs text-amber-800/80 dark:text-amber-300/80">
                Active slides rotate automatically every 5.5 seconds on the homepage. Recommended image resolution is <strong>1400 × 700 px</strong> (or 16:9 ratio). High contrast overlays ensure text readability across light and dark modes.
            </p>
        </div>
    </div>

    <!-- Banners Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php if (!empty($banners)): ?>
            <?php foreach ($banners as $idx => $b): ?>
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div>
                        <!-- Slide Preview Banner -->
                        <div class="relative h-48 bg-slate-900 overflow-hidden">
                            <img src="<?= BASE_URL . $b['image_path'] ?>" alt="<?= htmlspecialchars($b['title']) ?>" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/40 to-transparent"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 flex items-center gap-2">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-black/60 backdrop-blur-md text-amber-400 border border-amber-400/30">
                                    Slide <?= $idx + 1 ?>
                                </span>
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold <?= $b['status'] === 'active' ? 'bg-emerald-500/80 text-white' : 'bg-slate-600/80 text-slate-200' ?>">
                                    <?= ucfirst($b['status']) ?>
                                </span>
                            </div>

                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <span class="text-[10px] uppercase font-bold text-amber-400 block tracking-wider mb-0.5">
                                    <?= htmlspecialchars($b['badge_text'] ?: 'ELOCENTRA') ?>
                                </span>
                                <h3 class="text-base font-bold line-clamp-1 text-white">
                                    <?= htmlspecialchars($b['title']) ?>
                                </h3>
                            </div>
                        </div>

                        <!-- Slide Details -->
                        <div class="p-5 space-y-3">
                            <p class="text-xs text-slate-600 dark:text-slate-300 line-clamp-2">
                                <?= htmlspecialchars($b['subtitle'] ?: 'No subtitle provided.') ?>
                            </p>

                            <div class="grid grid-cols-2 gap-2 text-xs bg-slate-50 dark:bg-slate-900/60 p-3 rounded-xl border border-slate-100 dark:border-slate-800 font-mono">
                                <div>
                                    <span class="text-slate-400 block text-[10px] font-sans">Primary Button</span>
                                    <span class="text-slate-800 dark:text-slate-200 font-semibold truncate block"><?= htmlspecialchars($b['cta_text']) ?></span>
                                    <span class="text-[10px] text-slate-400 truncate block"><?= htmlspecialchars($b['cta_url']) ?></span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block text-[10px] font-sans">Secondary Button</span>
                                    <span class="text-slate-800 dark:text-slate-200 font-semibold truncate block"><?= htmlspecialchars($b['secondary_cta_text']) ?></span>
                                    <span class="text-[10px] text-slate-400 truncate block"><?= htmlspecialchars($b['secondary_cta_url']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="p-4 bg-slate-50 dark:bg-slate-900/40 border-t border-slate-100 dark:border-slate-700/60 flex items-center justify-between">
                        <span class="text-xs text-slate-400">Order: <strong class="text-slate-700 dark:text-slate-300 font-mono"><?= (int) $b['sort_order'] ?></strong></span>
                        <div class="flex items-center gap-2">
                            <button onclick='openEditBannerModal(<?= json_encode($b) ?>)' class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                Edit Slide
                            </button>
                            <form action="<?= BASE_URL ?>/admin/banners/<?= $b['id'] ?>/delete" method="POST" onsubmit="return confirm('Delete this banner slide?');" class="inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-12 text-center">
                <p class="text-slate-500 dark:text-slate-400 mb-4">No banner slides configured yet.</p>
                <button onclick="openAddBannerModal()" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-semibold text-sm">
                    Add First Banner Slide
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add / Edit Banner Modal -->
<div id="bannerModal" class="fixed inset-0 z-50 hidden bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-2xl w-full max-w-xl max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between sticky top-0 bg-white dark:bg-slate-800 z-10">
            <h3 id="modalTitle" class="font-bold text-slate-900 dark:text-white text-base">Add Banner Slide</h3>
            <button onclick="closeBannerModal()" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="bannerForm" action="<?= BASE_URL ?>/admin/banners" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            <?= csrf_field() ?>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Badge Text (Top Pill)</label>
                <input type="text" id="badge_text" name="badge_text" placeholder="e.g. ELOCENTRA – English Academy (PVT) LTD" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Main Heading / Title <span class="text-rose-500">*</span></label>
                <input type="text" id="title" name="title" required placeholder="e.g. Learn English. Speak Confidently. Succeed Globally." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Subtitle / Descriptive Text</label>
                <textarea id="subtitle" name="subtitle" rows="2" placeholder="Descriptive narrative explaining the highlight..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Banner Image (JPG / PNG)</label>
                <input type="file" name="banner_image" accept="image/*" class="w-full px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-slate-950 hover:file:bg-amber-600">
                <p class="text-[11px] text-slate-400 mt-1">Recommended size: 1400x700px. Leave empty when editing to keep current image.</p>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Primary Button Label</label>
                    <input type="text" id="cta_text" name="cta_text" value="Explore Courses" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Primary Button Link</label>
                    <input type="text" id="cta_url" name="cta_url" value="/courses" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-mono">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Secondary Button Label</label>
                    <input type="text" id="secondary_cta_text" name="secondary_cta_text" value="Join Now" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Secondary Button Link</label>
                    <input type="text" id="secondary_cta_url" name="secondary_cta_url" value="/register" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-mono">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="1" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-mono">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Status</label>
                    <select id="status" name="status" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-3">
                <button type="button" onclick="closeBannerModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-700">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 text-sm font-semibold shadow-md">Save Slide</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddBannerModal() {
    document.getElementById('modalTitle').innerText = 'Add Banner Slide';
    const form = document.getElementById('bannerForm');
    form.action = '<?= BASE_URL ?>/admin/banners';
    form.reset();
    document.getElementById('status').value = 'active';
    document.getElementById('bannerModal').classList.remove('hidden');
}

function openEditBannerModal(b) {
    document.getElementById('modalTitle').innerText = 'Edit Banner Slide';
    const form = document.getElementById('bannerForm');
    form.action = '<?= BASE_URL ?>/admin/banners/' + b.id + '/update';
    document.getElementById('badge_text').value = b.badge_text || '';
    document.getElementById('title').value = b.title || '';
    document.getElementById('subtitle').value = b.subtitle || '';
    document.getElementById('cta_text').value = b.cta_text || 'Explore Courses';
    document.getElementById('cta_url').value = b.cta_url || '/courses';
    document.getElementById('secondary_cta_text').value = b.secondary_cta_text || 'Join Now';
    document.getElementById('secondary_cta_url').value = b.secondary_cta_url || '/register';
    document.getElementById('sort_order').value = b.sort_order || 0;
    document.getElementById('status').value = b.status || 'active';
    document.getElementById('bannerModal').classList.remove('hidden');
}

function closeBannerModal() {
    document.getElementById('bannerModal').classList.add('hidden');
}
</script>
