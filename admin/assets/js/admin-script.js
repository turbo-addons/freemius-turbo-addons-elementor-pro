/**
 * Turbo Addons Pro — Admin Dashboard Script
 * Mirrors the free plugin's admin-script.js but targets taep- prefixed elements.
 */

jQuery(document).ready(function ($) {

    // ---- Tab switching ----
    $('.taep-tab-link').on('click', function (e) {
        e.preventDefault();

        $('.taep-tab-link').removeClass('active');
        $('.taep-tab-content').removeClass('active');

        $(this).addClass('active');
        $('#' + $(this).data('tab')).addClass('active');

        // Keep all hidden current_tab inputs in sync
        $('input[name="current_tab"]').val($(this).data('tab'));
    });

    // Restore active tab on page load (after form save)
    var savedTab = $('input[name="current_tab"]').first().val();
    if (savedTab && savedTab !== '') {
        $('.taep-tab-link').removeClass('active');
        $('.taep-tab-content').removeClass('active');
        $('.taep-tab-link[data-tab="' + savedTab + '"]').addClass('active');
        $('#' + savedTab).addClass('active');
    }

    // ---- Alert dismiss ----
    $('.taep-alert-dismiss-button').on('click', function () {
        $(this).closest('.taep-alert-updated-div').fadeOut();
    });

    // ---- Admin menu icon class ----
    $('#adminmenu .toplevel_page_turbo_addons_pro .wp-menu-image img').addClass('taep-turbo-addon-pro-admin-dashboard-icon');

});


// ---- Widget category scroll-filter tabs (Free + Pro share same logic) ----
document.addEventListener('DOMContentLoaded', function () {

    // Helper: init a filter tab group
    function initFilterTabs(tabListSelector, tabContentSelector, offset) {
        var tabs        = document.querySelectorAll(tabListSelector);
        var tabContents = document.querySelectorAll(tabContentSelector);

        if (!tabs.length) return;

        // Show all sections by default (scroll-based navigation)
        tabContents.forEach(function (content) {
            content.style.display = 'block';
        });

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var targetId      = tab.getAttribute('data-tab');
                var targetContent = document.getElementById(targetId);

                tabs.forEach(function (t) { t.classList.remove('active'); });
                tab.classList.add('active');

                if (targetContent) {
                    var scrollOffset = targetContent.getBoundingClientRect().top + window.scrollY - (offset || 140);
                    window.scrollTo({ top: scrollOffset, behavior: 'smooth' });
                }
            });
        });
    }

    // Free widgets tab
    initFilterTabs(
        '.taep-widget-tabs-list .taep-widget-filter-tab-item',
        '.taep-widget-tabs-content .taep-widget-tab-content',
        140
    );

});


// ---- Select All — Free widgets ----
document.addEventListener('DOMContentLoaded', function () {
    var selectAll        = document.getElementById('taep-select-all-free-widgets');
    var widgetCheckboxes = document.querySelectorAll('.taep-widget-checkbox');

    if (!selectAll || !widgetCheckboxes.length) return;

    function updateSelectAll() {
        selectAll.checked = Array.from(widgetCheckboxes).every(function (cb) { return cb.checked; });
    }

    function toggleAll(state) {
        widgetCheckboxes.forEach(function (cb) { cb.checked = state; });
    }

    updateSelectAll();

    selectAll.addEventListener('change', function () { toggleAll(selectAll.checked); });
    widgetCheckboxes.forEach(function (cb) { cb.addEventListener('change', updateSelectAll); });
});


// ---- Select All — Pro widgets ----
document.addEventListener('DOMContentLoaded', function () {
    var selectAll        = document.getElementById('taep-select-all-pro-widgets');
    var widgetCheckboxes = document.querySelectorAll('.taep-pro-widget-checkbox');

    if (!selectAll || !widgetCheckboxes.length) return;

    function updateSelectAll() {
        selectAll.checked = Array.from(widgetCheckboxes).every(function (cb) { return cb.checked; });
    }

    function toggleAll(state) {
        widgetCheckboxes.forEach(function (cb) { cb.checked = state; });
    }

    updateSelectAll();

    selectAll.addEventListener('change', function () { toggleAll(selectAll.checked); });
    widgetCheckboxes.forEach(function (cb) { cb.addEventListener('change', updateSelectAll); });
});


// ---- Select All — Extensions ----
document.addEventListener('DOMContentLoaded', function () {
    var selectAll  = document.getElementById('taep-select-all-extensions');
    var extBoxes   = document.querySelectorAll('.taep-extension-checkbox');

    if (!selectAll || !extBoxes.length) return;

    function updateSelectAll() {
        selectAll.checked = Array.from(extBoxes).every(function (cb) { return cb.checked; });
    }

    function toggleAll(state) {
        extBoxes.forEach(function (cb) { cb.checked = state; });
    }

    updateSelectAll();

    selectAll.addEventListener('change', function () { toggleAll(selectAll.checked); });
    extBoxes.forEach(function (cb) { cb.addEventListener('change', updateSelectAll); });
});
