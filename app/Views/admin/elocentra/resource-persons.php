<?php
/**
 * ELOCENTRA – Resource Persons & Teachers Management
 */
?>

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Resource Persons &amp; Faculty</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Manage academy lecturers, professors, and trainers. All active faculty members automatically appear in the Resource Persons section on the homepage.</p>
        </div>
        <div>
            <button type="button" onclick="openCreateTeacherModal()" class="btn-gold text-xs py-2.5 px-5 font-bold">
                + Add Resource Person
            </button>
        </div>
    </div>

    <!-- Resource Persons Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($teachers as $t): ?>
            <?php $photo = $t['photo'] ?: '/assets/img/teachers/senaka.jpg'; ?>
            <div class="bg-white dark:bg-[#111A2E] rounded-2xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-start gap-4">
                        <img src="<?= BASE_URL . htmlspecialchars($photo, ENT_QUOTES, 'UTF-8') ?>" class="w-16 h-16 rounded-full object-cover border-2 border-[#E5A93C]/40 shrink-0">
                        <div class="min-w-0 flex-1">
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white truncate"><?= htmlspecialchars($t['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p class="text-xs font-semibold text-[#E5A93C] mt-0.5"><?= htmlspecialchars($t['title'], ENT_QUOTES, 'UTF-8') ?></p>
                            <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold uppercase mt-1 <?= $t['status'] === 'active' ? 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300' : 'bg-slate-200 text-slate-600' ?>">
                                <?= $t['status'] ?>
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 space-y-2 text-xs">
                        <div>
                            <span class="text-slate-400 text-[10px] uppercase font-bold block">Qualifications</span>
                            <span class="text-slate-700 dark:text-slate-300"><?= htmlspecialchars($t['qualifications'], ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <?php if (!empty($t['bio'])): ?>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Bio</span>
                                <p class="text-slate-600 dark:text-slate-400 line-clamp-2"><?= htmlspecialchars($t['bio'], ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="flex items-center justify-between text-slate-400 text-[11px] pt-1">
                            <span>📧 <?= htmlspecialchars($t['email'] ?: 'No email', ENT_QUOTES, 'UTF-8') ?></span>
                            <span>📱 <?= htmlspecialchars($t['phone'] ?: '—', ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <span class="text-[10px] text-slate-400">Order: <?= (int) $t['sort_order'] ?></span>
                    <div class="space-x-2 text-xs">
                        <button type="button" onclick='openEditTeacherModal(<?= json_encode($t) ?>)' class="text-blue-600 hover:underline font-bold">Edit</button>
                        <form action="<?= BASE_URL ?>/admin/resource-persons/<?= (int) $t['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Remove this faculty member?');">
                            <?= csrfField() ?>
                            <button type="submit" class="text-red-500 hover:underline font-bold">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Create / Edit Teacher Modal -->
<div id="teacherModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#111A2E] rounded-3xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl p-6 sm:p-8 max-h-[90vh] overflow-y-auto">
        <h3 id="teacherModalTitle" class="text-lg font-bold text-slate-900 dark:text-white mb-4">Add Resource Person</h3>
        
        <form id="teacherForm" action="<?= BASE_URL ?>/admin/resource-persons" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?= csrfField() ?>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Full Name *</label>
                    <input type="text" id="tch_name" name="name" required placeholder="e.g. Prof. Senaka Rajapakse"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Title / Designation *</label>
                    <input type="text" id="tch_title" name="title" required placeholder="e.g. Senior Lecturer in English"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Academic Qualifications *</label>
                <input type="text" id="tch_qual" name="qualifications" required placeholder="e.g. MA in Linguistics (UK), Cambridge CELTA"
                       class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Subject Area</label>
                <select id="tch_sa" name="subject_area_id"
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                    <option value="">-- General / Multi-disciplinary --</option>
                    <?php foreach ($subjectAreas as $sa): ?>
                        <option value="<?= (int) $sa['id'] ?>"><?= htmlspecialchars($sa['name'], ENT_QUOTES, 'UTF-8') ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Email Address</label>
                    <input type="email" id="tch_email" name="email" placeholder="e.g. senaka@elocentra.academy"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">WhatsApp / Phone</label>
                    <input type="text" id="tch_phone" name="phone" placeholder="+94 77 123 4567"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Biography / Profile Summary</label>
                <textarea id="tch_bio" name="bio" rows="3" placeholder="Brief professional overview of experience and teaching methodology..."
                          class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white resize-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Profile Photo</label>
                <input type="file" name="photo" accept="image/*"
                       class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                    <input type="number" id="tch_order" name="sort_order" value="0"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Status</label>
                    <select id="tch_status" name="status"
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        <option value="active">Active (Visible on Homepage)</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeTeacherModal()" class="px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 text-xs font-semibold">Cancel</button>
                <button type="submit" class="btn-gold text-xs py-2.5 px-6 font-bold">Save Resource Person</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateTeacherModal() {
    document.getElementById('teacherModalTitle').innerText = 'Add Resource Person';
    document.getElementById('teacherForm').action = '<?= BASE_URL ?>/admin/resource-persons';
    document.getElementById('tch_name').value = '';
    document.getElementById('tch_title').value = '';
    document.getElementById('tch_qual').value = '';
    document.getElementById('tch_sa').value = '';
    document.getElementById('tch_email').value = '';
    document.getElementById('tch_phone').value = '';
    document.getElementById('tch_bio').value = '';
    document.getElementById('tch_order').value = '0';
    document.getElementById('tch_status').value = 'active';
    document.getElementById('teacherModal').classList.remove('hidden');
}

function openEditTeacherModal(tch) {
    document.getElementById('teacherModalTitle').innerText = 'Edit Resource Person: ' + tch.name;
    document.getElementById('teacherForm').action = '<?= BASE_URL ?>/admin/resource-persons/' + tch.id + '/update';
    document.getElementById('tch_name').value = tch.name || '';
    document.getElementById('tch_title').value = tch.title || '';
    document.getElementById('tch_qual').value = tch.qualifications || '';
    document.getElementById('tch_sa').value = tch.subject_area_id || '';
    document.getElementById('tch_email').value = tch.email || '';
    document.getElementById('tch_phone').value = tch.phone || '';
    document.getElementById('tch_bio').value = tch.bio || '';
    document.getElementById('tch_order').value = tch.sort_order || 0;
    document.getElementById('tch_status').value = tch.status || 'active';
    document.getElementById('teacherModal').classList.remove('hidden');
}

function closeTeacherModal() {
    document.getElementById('teacherModal').classList.add('hidden');
}
</script>
