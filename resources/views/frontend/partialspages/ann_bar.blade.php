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
