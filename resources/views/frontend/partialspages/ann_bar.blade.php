@if(!empty($activeAnnouncement))
<div class="ann-bar" id="annBar">
    <div class="ann-inner">
        <span class="ann-dot"></span>
        <span class="ann-msg">{!! $activeAnnouncement->message !!}</span>
        @if($activeAnnouncement->cta_text && $activeAnnouncement->cta_url)
            <a href="{{ $activeAnnouncement->cta_url }}" class="ann-cta">{{ $activeAnnouncement->cta_text }}</a>
        @endif
        <button class="ann-close" id="annClose" title="Close"><i class="fas fa-times"></i></button>
    </div>
</div>
<style>
/* Mobile ann-bar: force single-line clip with ellipsis, hide CTA */
@media (max-width: 575px) {
    .ann-bar { overflow: hidden !important; }
    .ann-bar .ann-inner {
        flex-wrap: nowrap !important;
        padding: 0 36px 0 12px !important;
        gap: 8px !important;
    }
    .ann-bar .ann-msg {
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        font-size: 10.5px !important;
        max-width: calc(100vw - 70px) !important;
        min-width: 0 !important;
        flex: 1 1 auto !important;
    }
    .ann-bar .ann-cta { display: none !important; }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var annBar = document.getElementById('annBar');
    var annClose = document.getElementById('annClose');
    if (!annBar || !annClose) return;
    annClose.addEventListener('click', function (e) {
        e.preventDefault();
        annBar.classList.add('hidden');
    });
});
</script>
@endif
