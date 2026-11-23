<?php
/**
 * ELOCENTRA – Courses Management (replaces legacy Classes)
 */
?>

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Courses Management</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Manage university-standard courses, assign subject areas &amp; faculty, set pricing and duration.</p>
        </div>
        <div>
            <button type="button" onclick="openCreateCourseModal()" class="btn-gold text-xs py-2.5 px-5 font-bold">
                + Add New Course
            </button>
        </div>
    </div>

    <!-- Courses Table -->
    <div class="bg-white dark:bg-[#111A2E] rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/60 border-b border-slate-200 dark:border-slate-800 text-slate-500 uppercase font-bold text-[11px]">
                        <th class="py-3 px-4">Course</th>
                        <th class="py-3 px-4">Subject Area</th>
                        <th class="py-3 px-4">Resource Person</th>
                        <th class="py-3 px-4 text-center">Duration</th>
                        <th class="py-3 px-4 text-center">Mode</th>
                        <th class="py-3 px-4 text-center">Level</th>
                        <th class="py-3 px-4 text-right">Fee (LKR)</th>
                        <th class="py-3 px-4 text-center">Enrolled</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    <?php if (empty($courses)): ?>
                        <tr><td colspan="10" class="text-center py-8 text-slate-400">No courses available.</td></tr>
                    <?php else: ?>
                        <?php foreach ($courses as $c): ?>
                            <?php $fee = number_format((float) ($c['price'] ?? $c['monthly_fee'] ?? 0), 2); ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($c['class_name'], ENT_QUOTES, 'UTF-8') ?></div>
                                    <div class="text-[10px] text-slate-400 font-mono"><?= htmlspecialchars($c['course_code'] ?? '—', ENT_QUOTES, 'UTF-8') ?></div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-0.5 rounded-full bg-[#E5A93C]/15 text-[#E5A93C] font-semibold text-[10px]">
                                        <?= htmlspecialchars($c['subject_area_name'] ?? $c['subject'] ?? 'General', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 font-medium text-slate-800 dark:text-slate-200">
                                    <?= htmlspecialchars($c['teacher_name'] ?? 'Not assigned', ENT_QUOTES, 'UTF-8') ?>
                                </td>
                                <td class="py-3 px-4 text-center"><?= htmlspecialchars($c['duration_weeks'] ?? '12 Weeks', ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="py-3 px-4 text-center capitalize"><?= htmlspecialchars($c['delivery_mode'] ?? 'online', ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="py-3 px-4 text-center font-semibold text-slate-600 dark:text-slate-400"><?= htmlspecialchars($c['course_level'] ?? 'Intermediate', ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="py-3 px-4 text-right font-bold text-slate-900 dark:text-white">LKR <?= $fee ?></td>
                                <td class="py-3 px-4 text-center">
                                    <span class="px-2 py-0.5 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 font-bold">
                                        <?= (int) ($c['student_count'] ?? 0) ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase <?= $c['status'] === 'active' ? 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300' : 'bg-slate-200 text-slate-600' ?>">
                                        <?= $c['status'] ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right space-x-2">
                                    <a href="<?= BASE_URL ?>/courses/<?= (int) $c['id'] ?>" target="_blank" class="text-[#E5A93C] hover:underline font-semibold">View</a>
                                    <button type="button" onclick='openEditCourseModal(<?= json_encode($c) ?>)' class="text-blue-600 hover:underline font-semibold">Edit</button>
                                    <form action="<?= BASE_URL ?>/admin/courses/<?= (int) $c['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Inactivate this course?');">
                                        <?= csrfField() ?>
                                        <button type="submit" class="text-red-500 hover:underline font-semibold">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create / Edit Course Modal -->
<div id="courseModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#111A2E] rounded-3xl max-w-xl w-full border border-slate-200 dark:border-slate-800 shadow-2xl p-6 sm:p-8 max-h-[90vh] overflow-y-auto">
        <h3 id="courseModalTitle" class="text-lg font-bold text-slate-900 dark:text-white mb-4">Add Course</h3>
        
        <form id="courseForm" action="<?= BASE_URL ?>/admin/courses" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?= csrfField() ?>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Course Title *</label>
                    <input type="text" id="crs_name" name="class_name" required placeholder="e.g. English for Global Communication"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Course Code</label>
                    <input type="text" id="crs_code" name="course_code" placeholder="ENG-101"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Subject Area</label>
                    <select id="crs_said" name="subject_area_id"
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        <option value="">-- General / Multi-disciplinary --</option>
                        <?php foreach ($subjectAreas as $sa): ?>
                            <option value="<?= (int) $sa['id'] ?>"><?= htmlspecialchars($sa['name'], ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Resource Person / Teacher</label>
                    <select id="crs_tid" name="teacher_id"
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        <option value="">-- Not Assigned / TBD --</option>
                        <?php foreach ($teachers as $tch): ?>
                            <option value="<?= (int) $tch['id'] ?>"><?= htmlspecialchars($tch['name'], ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars($tch['title'], ENT_QUOTES, 'UTF-8') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Duration</label>
                    <input type="text" id="crs_duration" name="duration_weeks" value="12 Weeks" placeholder="12 Weeks"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Delivery Mode</label>
                    <select id="crs_mode" name="delivery_mode"
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        <option value="online">Online</option>
                        <option value="physical">Physical</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Course Level</label>
                    <select id="crs_level" name="course_level"
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Total Fee (LKR) *</label>
                    <input type="number" step="0.01" id="crs_price" name="price" required placeholder="25000.00"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-bold">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Thumbnail Image</label>
                    <input type="file" name="course_thumbnail" accept="image/*"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Course Description &amp; Objectives</label>
                <textarea id="crs_desc" name="description" rows="3" placeholder="Overview of syllabus, modules, target audience, and learning outcomes..."
                          class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white resize-none"></textarea>
            </div>

            <div class="flex items-center gap-6 text-xs">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="crs_cert" name="has_certificate" value="1" checked class="w-4 h-4 rounded text-[#E5A93C]">
                    <span>Certificate Upon Completion</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="crs_feat" name="is_featured" value="1" checked class="w-4 h-4 rounded text-[#E5A93C]">
                    <span>Feature on Homepage</span>
                </label>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Status</label>
                <select id="crs_status" name="status"
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                    <option value="active">Active (Available for Enrollment)</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeCourseModal()" class="px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 text-xs font-semibold">Cancel</button>
                <button type="submit" class="btn-gold text-xs py-2.5 px-6 font-bold">Save Course</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateCourseModal() {
    document.getElementById('courseModalTitle').innerText = 'Add New Course';
    document.getElementById('courseForm').action = '<?= BASE_URL ?>/admin/courses';
    document.getElementById('crs_name').value = '';
    document.getElementById('crs_code').value = '';
    document.getElementById('crs_said').value = '';
    document.getElementById('crs_tid').value = '';
    document.getElementById('crs_duration').value = '12 Weeks';
    document.getElementById('crs_mode').value = 'online';
    document.getElementById('crs_level').value = 'Intermediate';
    document.getElementById('crs_price').value = '25000.00';
    document.getElementById('crs_desc').value = '';
    document.getElementById('crs_cert').checked = true;
    document.getElementById('crs_feat').checked = true;
    document.getElementById('crs_status').value = 'active';
    document.getElementById('courseModal').classList.remove('hidden');
}

function openEditCourseModal(c) {
    document.getElementById('courseModalTitle').innerText = 'Edit Course: ' + c.class_name;
    document.getElementById('courseForm').action = '<?= BASE_URL ?>/admin/courses/' + c.id + '/update';
    document.getElementById('crs_name').value = c.class_name || '';
    document.getElementById('crs_code').value = c.course_code || '';
    document.getElementById('crs_said').value = c.subject_area_id || '';
    document.getElementById('crs_tid').value = c.teacher_id || '';
    document.getElementById('crs_duration').value = c.duration_weeks || '12 Weeks';
    document.getElementById('crs_mode').value = c.delivery_mode || 'online';
    document.getElementById('crs_level').value = c.course_level || 'Intermediate';
    document.getElementById('crs_price').value = c.price || c.monthly_fee || 0;
    document.getElementById('crs_desc').value = c.description || '';
    document.getElementById('crs_cert').checked = (c.has_certificate == 1);
    document.getElementById('crs_feat').checked = (c.is_featured == 1);
    document.getElementById('crs_status').value = c.status || 'active';
    document.getElementById('courseModal').classList.remove('hidden');
}

function closeCourseModal() {
    document.getElementById('courseModal').classList.add('hidden');
}
</script>
