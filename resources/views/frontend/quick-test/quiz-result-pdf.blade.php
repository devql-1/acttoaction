<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
/* ═══ RESET ═══════════════════════════════════════════ */
@page  { margin: 0; size: A4 portrait; }
*      { margin: 0; padding: 0; box-sizing: border-box; }
body   { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; color: #1a1a2e; background: #fff; }

/* ═══ TOP HEADER BAR ══════════════════════════════════ */
.topbar { background: #07112b; padding: 16px 36px; }
.topbar table { width: 100%; }
.logo  { font-size: 18px; font-weight: 700; color: #60a5fa; letter-spacing: 1px; }
.logo-sub { font-size: 8px; color: rgba(255,255,255,.4); text-transform: uppercase;
            letter-spacing: 1.5px; margin-top: 2px; }
.rpt-badge { display: inline-block; border: 1px solid rgba(96,165,250,.4);
             color: #93c5fd; font-size: 7.5px; font-weight: 700; letter-spacing: 1px;
             text-transform: uppercase; padding: 4px 12px; border-radius: 20px; }
.rpt-date  { font-size: 8px; color: rgba(255,255,255,.3); margin-top: 4px; text-align: right; }

/* ═══ HERO SECTION ════════════════════════════════════ */
.hero { background: #07112b; padding: 30px 36px 36px; border-top: 1px solid rgba(255,255,255,.06); }
.hero table { width: 100%; }

/* LEFT — headline */
.hero-eyebrow { font-size: 8.5px; font-weight: 700; letter-spacing: 1.5px;
                text-transform: uppercase; color: #93c5fd; margin-bottom: 10px; }
.hero-eyebrow-dot { display: inline-block; width: 6px; height: 6px; border-radius: 50%;
                    background: #34d399; margin-right: 6px; }
.hero-title { font-size: 32px; font-weight: 900; color: #fff; line-height: 1.1; margin-bottom: 10px; }
.hero-title span { /* accent name */ }
.hero-tagline { font-size: 13px; color: rgba(255,255,255,.62); line-height: 1.6;
                margin-bottom: 18px; max-width: 340px; }

.hero-badge { display: table; background: rgba(255,255,255,.07); border: 1.5px solid rgba(255,255,255,.16);
              border-radius: 14px; padding: 12px 18px; margin-bottom: 10px; }
.hero-badge table { border-collapse: collapse; }
.hero-badge-icon { width: 40px; text-align: center; }
.hero-badge-label { font-size: 9px; font-weight: 700; color: rgba(255,255,255,.4);
                    text-transform: uppercase; letter-spacing: .8px; margin-bottom: 2px; }
.hero-badge-name  { font-size: 15px; font-weight: 800; color: #fff; }

.range-strip { display: table; background: rgba(52,211,153,.12); border: 1px solid rgba(52,211,153,.3);
               border-radius: 8px; padding: 6px 14px; margin-top: 8px; }
.range-strip-txt { font-size: 10px; font-weight: 600; color: #6ee7b7; }
.range-green { color: #34d399; font-weight: 700; }

/* RIGHT — score ring */
.score-ring { width: 165px; height: 165px; border-radius: 83px; border: 14px solid;
              display: table; margin: 0 auto; }
.score-ring-in { display: table-cell; vertical-align: middle; text-align: center; }
.ring-pct  { font-size: 38px; font-weight: 900; color: #fff; line-height: 1; }
.ring-lbl  { font-size: 9px; color: rgba(255,255,255,.4); text-transform: uppercase;
             letter-spacing: .7px; margin-top: 4px; }
.ring-cap  { text-align: center; color: rgba(255,255,255,.35); font-size: 9px;
             margin-top: 12px; line-height: 1.5; }

/* ═══ CONTENT AREA ════════════════════════════════════ */
.content { padding: 26px 36px; background: #f5f8ff; }

/* ═══ TYPE SPOTLIGHT ══════════════════════════════════ */
.ts { background: #fff; border-radius: 14px; border: 1.5px solid #e0eaff;
      margin-bottom: 18px; }
.ts-body   { padding: 22px 26px; }
.ts-body table { width: 100%; }
.ts-source { display: inline-block; font-size: 9px; font-weight: 700; text-transform: uppercase;
             letter-spacing: .8px; padding: 3px 10px; border-radius: 20px;
             margin-bottom: 8px; }
.ts-name   { font-size: 22px; font-weight: 900; color: #07112b; margin-bottom: 4px; }
.ts-stag   { font-size: 13px; font-weight: 600; margin-bottom: 12px; }
.ts-desc   { font-size: 12px; color: #4b5563; line-height: 1.75; margin-bottom: 14px; }
.ts-tag    { display: inline-block; font-size: 10px; font-weight: 600; padding: 4px 12px;
             border-radius: 20px; border: 1.5px solid; margin: 2px 2px 2px 0; }

.range-band { display: table; background: #f8faff; border: 1px solid #dbeafe;
              border-radius: 8px; padding: 6px 14px; margin-top: 12px; }
.range-band-txt { font-size: 11px; color: #1d4ed8; font-weight: 600; }

/* ═══ STATS GRID ══════════════════════════════════════ */
.stats-tbl { width: 100%; margin-bottom: 16px; }
.sbox { background: #fff; border: 1.5px solid #e4ecf8; border-radius: 14px;
        padding: 18px 12px; text-align: center; }
.sbox-val { font-size: 26px; font-weight: 900; line-height: 1; }
.sbox-lbl { font-size: 9px; color: #9ca3af; text-transform: uppercase;
            letter-spacing: .5px; margin-top: 6px; }

/* ═══ COURSE PILL ═════════════════════════════════════ */
.course { border-radius: 14px; padding: 18px 22px; margin-bottom: 20px;
          background: #07112b; }
.course table { width: 100%; }
.course-ico { width: 46px; height: 46px; background: rgba(255,255,255,.1);
              border-radius: 11px; display: table; }
.course-ico-in { display: table-cell; vertical-align: middle; text-align: center;
                 font-size: 10px; font-weight: 900; color: rgba(255,255,255,.7);
                 letter-spacing: 0; }
.course-h6  { font-size: 9px; font-weight: 700; color: rgba(255,255,255,.45);
              text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
.course-p   { font-size: 15px; font-weight: 800; color: #fff; }

/* ═══ CATEGORY SCORES ═════════════════════════════════ */
.sec-head { font-size: 13px; font-weight: 900; color: #07112b; margin-bottom: 12px;
            padding-bottom: 8px; border-bottom: 2px solid #e0eaff; }
.cat-tbl  { width: 100%; border-collapse: collapse; }
.cat-tbl td { vertical-align: middle; padding: 5px 0; }
.cat-dot  { width: 10px; height: 10px; border-radius: 50%; }
.cat-name { font-size: 11.5px; font-weight: 700; color: #1a1a2e; }
.cat-bar-bg { height: 8px; background: #eef1f7; border-radius: 4px; }
.cat-bar-fill { height: 8px; border-radius: 4px; }

/* ═══ PAGE BREAK ══════════════════════════════════════ */
.pb { page-break-after: always; }

/* ═══ PAGE 2 MINI HEADER ══════════════════════════════ */
.mhdr { background: #07112b; padding: 11px 36px; }
.mhdr table { width: 100%; }
.mhdr-l { color: rgba(255,255,255,.7); font-size: 10.5px; font-weight: 700; }
.mhdr-r { font-size: 8.5px; color: rgba(255,255,255,.35); text-align: right; }

/* ═══ Q&A BREAKDOWN ═══════════════════════════════════ */
.qa-wrap { padding: 22px 36px; }
.qa-block { margin-bottom: 16px; border-radius: 10px; overflow: hidden; border: 1px solid #e4ecf8; }
.qa-hdr   { padding: 10px 14px; }
.qa-hdr table { width: 100%; }
.qa-hdr-name  { font-size: 12px; font-weight: 800; color: #fff; }
.qa-hdr-score { font-size: 11px; font-weight: 700; color: rgba(255,255,255,.85); text-align: right; }
.qa-tbl { width: 100%; border-collapse: collapse; }
.qa-tbl .qa-th { background: #f8faff; }
.qa-tbl th { font-size: 8.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px;
             color: #9ca3af; padding: 6px 12px; border-bottom: 1px solid #e4ecf8; }
.qa-tbl th.r { text-align: right; }
.qa-tbl td   { font-size: 11px; padding: 8px 12px; vertical-align: top;
               border-bottom: 1px solid #f0f4fb; color: #374151; line-height: 1.55; }
.qa-tbl tr:last-child td { border-bottom: none; }
.qa-num { font-size: 9.5px; font-weight: 700; color: #b0b8cc; white-space: nowrap; width: 30px; }
.qa-ans { text-align: right; white-space: nowrap; width: 90px; }
.abadge { display: inline-block; font-size: 9.5px; font-weight: 700;
          padding: 2px 9px; border-radius: 6px; }

/* ═══ FOOTER ══════════════════════════════════════════ */
.ftr { background: #07112b; color: rgba(255,255,255,.32); font-size: 8.5px;
       text-align: center; padding: 11px 36px; margin-top: 20px; }
</style>
</head>
<body>

{{-- ══════════════════════════════════════════
     TOP HEADER BAR
══════════════════════════════════════════ --}}
<div class="topbar">
    <table>
        <tr>
            <td style="vertical-align:middle;">
                <div class="logo">ACT TO ACTION</div>
                <div class="logo-sub">Performing Arts Academy</div>
            </td>
            <td style="vertical-align:middle;">
                <div class="rpt-badge" style="float:right;">TALENT ASSESSMENT REPORT</div>
                <div class="rpt-date">Generated: {{ date('d M Y') }}</div>
            </td>
        </tr>
    </table>
</div>

{{-- ══════════════════════════════════════════
     HERO — mirrors the website hero section
     LEFT: title + badge     RIGHT: score ring
══════════════════════════════════════════ --}}
<div class="hero">
    <table>
        <tr>
            {{-- LEFT TEXT --}}
            <td style="vertical-align:middle; width:58%; padding-right:20px;">

                <div class="hero-eyebrow">
                    <span class="hero-eyebrow-dot"></span>Your Result is Ready
                </div>

                <div class="hero-title">
                    You&#8217;re<br>
                    <span style="color:{{ $displayColor }};">{{ $displayLabel }}</span>!
                </div>

                <div class="hero-tagline">{{ $displayTagline }}</div>

                {{-- Dominant Talent Type badge --}}
                <div class="hero-badge">
                    <table>
                        <tr>
                            <td class="hero-badge-icon" style="vertical-align:middle;padding-right:12px;">
                                <div style="width:36px;height:36px;border-radius:50%;background:{{ $displayColor }};
                                            display:table;">
                                    <div style="display:table-cell;vertical-align:middle;text-align:center;
                                                font-size:12px;font-weight:900;color:#fff;">
                                        {{ strtoupper(substr($displayLabel, 0, 1)) }}
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align:middle;">
                                <div class="hero-badge-label">Dominant Talent Type</div>
                                <div class="hero-badge-name">{{ $displayLabel }}</div>
                            </td>
                        </tr>
                    </table>
                </div>

                @if ($hasRange && $rangeMin !== null && $rangeMax !== null)
                <div class="range-strip">
                    <span class="range-strip-txt">
                        Personalised result &middot; Score
                        <span class="range-green">{{ $overallPct }}%</span>
                        matched band
                        <span class="range-green">{{ $rangeMin }}%&ndash;{{ $rangeMax }}%</span>
                    </span>
                </div>
                @endif

            </td>

            {{-- RIGHT SCORE RING --}}
            <td style="vertical-align:middle; width:42%; text-align:center;">
                <div class="score-ring" style="border-color:{{ $displayColor }};">
                    <div class="score-ring-in">
                        <div class="ring-pct">{{ $overallPct }}%</div>
                        <div class="ring-lbl">Overall Score</div>
                    </div>
                </div>
                <div class="ring-cap">
                    {{ $test->categories->flatMap->questions->count() }} questions &middot;
                    {{ $test->categories->count() }} sections
                </div>
            </td>
        </tr>
    </table>
</div>

{{-- ══════════════════════════════════════════
     CONTENT — white/light bg (mirrors sections
     below the hero on the website)
══════════════════════════════════════════ --}}
<div class="content">

    {{-- ── TYPE SPOTLIGHT CARD ── --}}
    <div class="ts" style="border-top: 5px solid {{ $displayColor }};">
        <div class="ts-body">
            @if ($hasRange)
                <div class="ts-source"
                     style="background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;">
                    Personalised Range &middot; Admin Configured
                </div>
            @else
                <div class="ts-source"
                     style="background:#eff6ff;border:1px solid #bfdbfe;color:#1d4ed8;">
                    Talent Type Profile
                </div>
            @endif

            <div class="ts-name">{{ $displayLabel }}</div>
            <div class="ts-stag" style="color:{{ $displayColor }};">{{ $displayTagline }}</div>
            <div class="ts-desc">{{ $displayDesc }}</div>

            @if ($displayTags)
            <div>
                @foreach((array)$displayTags as $tag)
                    <span class="ts-tag"
                          style="color:{{ $displayColor }};border-color:{{ $displayColor }}44;background:{{ $displayColor }}0e;">{{ $tag }}</span>
                @endforeach
            </div>
            @endif

            @if ($hasRange && $rangeMin !== null && $rangeMax !== null)
            <div class="range-band" style="margin-top:12px;">
                <span class="range-band-txt">
                    Your score: <strong>{{ $overallPct }}%</strong>
                    &nbsp;&middot;&nbsp; Matched band:
                    <strong>{{ $rangeMin }}%&ndash;{{ $rangeMax }}%</strong>
                </span>
            </div>
            @endif
        </div>
    </div>

    {{-- ── STATS GRID ── --}}
    <table class="stats-tbl">
        <tr>
            <td style="width:33.33%;padding-right:8px;">
                <div class="sbox">
                    <div class="sbox-val" style="color:{{ $displayColor }};">{{ $overallPct }}%</div>
                    <div class="sbox-lbl">Overall Score</div>
                </div>
            </td>
            <td style="width:33.33%;padding:0 4px;">
                <div class="sbox">
                    <div class="sbox-val" style="color:#175cdd;">{{ $test->categories->flatMap->questions->count() }}</div>
                    <div class="sbox-lbl">Questions Answered</div>
                </div>
            </td>
            <td style="width:33.33%;padding-left:8px;">
                <div class="sbox">
                    <div class="sbox-val" style="color:#175cdd;">{{ $test->categories->count() }}</div>
                    <div class="sbox-lbl">Sections Completed</div>
                </div>
            </td>
        </tr>
    </table>

    {{-- ── RECOMMENDED COURSE ── --}}
    @if ($displayCourse)
    <div class="course">
        <table>
            <tr>
                <td style="width:52px;vertical-align:middle;">
                    <div class="course-ico">
                        <div class="course-ico-in">&#9654;</div>
                    </div>
                </td>
                <td style="vertical-align:middle;padding-left:14px;">
                    <div class="course-h6">
                        {{ $hasRange ? 'Admin-Recommended Course' : 'Suggested Course for Your Type' }}
                    </div>
                    <div class="course-p">{{ $displayCourse }}</div>
                </td>
            </tr>
        </table>
    </div>
    @endif

    {{-- ── CATEGORY SCORES ── --}}
    <div class="sec-head">Category Scores</div>
    <table class="cat-tbl">
        @foreach($chartData as $cat)
        @php $cc = $cat['color'] ?? '#175cdd'; @endphp
        <tr>
            <td style="width:14px;padding-right:8px;">
                <div class="cat-dot" style="background:{{ $cc }};"></div>
            </td>
            <td style="width:36%;padding-right:14px;" class="cat-name">{{ $cat['name'] }}</td>
            <td style="padding-right:12px;">
                <div class="cat-bar-bg">
                    <div class="cat-bar-fill" style="width:{{ $cat['score'] }}%;background:{{ $cc }};"></div>
                </div>
            </td>
            <td style="width:46px;text-align:right;white-space:nowrap;">
                <strong style="font-size:13px;font-weight:800;color:{{ $cc }};">{{ $cat['score'] }}%</strong>
            </td>
        </tr>
        @endforeach
    </table>

</div>{{-- /content --}}

{{-- ══════════════════════════════════════════
     PAGE 2 — QUESTION BREAKDOWN
══════════════════════════════════════════ --}}
<div class="pb"></div>

<div class="mhdr">
    <table>
        <tr>
            <td class="mhdr-l">ACT TO ACTION &mdash; Talent Report</td>
            <td class="mhdr-r">{{ $displayLabel }} &middot; {{ $overallPct }}% Overall Score</td>
        </tr>
    </table>
</div>

<div class="qa-wrap">

{{-- ═══════════════════════════════════════════════════════
     PERFORMANCE CHART  (pure inline SVG — no JavaScript)
     DomPDF renders SVG natively; all 4 chart types covered
═══════════════════════════════════════════════════════ --}}
@php
$catArr   = $chartData->toArray();
$nCats    = max(1, count($catArr));
$gType    = $graphType ?? 'none';

/* Arc-path helper for donut chart (defined once) */
if (!function_exists('pdfArcPath')) {
    function pdfArcPath($cx, $cy, $r, $ri, $startDeg, $sweepDeg) {
        if (abs($sweepDeg) < 0.5)  return '';
        if ($sweepDeg >= 360)      $sweepDeg = 359.99;
        $s    = $startDeg           * M_PI / 180;
        $e    = ($startDeg + $sweepDeg) * M_PI / 180;
        $lg   = $sweepDeg > 180 ? 1 : 0;
        $x1   = round($cx + $r  * cos($s), 2);  $y1  = round($cy + $r  * sin($s), 2);
        $x2   = round($cx + $r  * cos($e), 2);  $y2  = round($cy + $r  * sin($e), 2);
        $ix1  = round($cx + $ri * cos($s), 2);  $iy1 = round($cy + $ri * sin($s), 2);
        $ix2  = round($cx + $ri * cos($e), 2);  $iy2 = round($cy + $ri * sin($e), 2);
        return "M {$x1} {$y1} A {$r} {$r} 0 {$lg} 1 {$x2} {$y2} L {$ix2} {$iy2} A {$ri} {$ri} 0 {$lg} 0 {$ix1} {$iy1} Z";
    }
}
@endphp

@if(in_array($gType, ['bar','line','pie','radar']))
<div class="sec-head" style="margin-bottom:14px;">Performance Chart</div>
<div style="background:#fff;border-radius:12px;border:1.5px solid #e0eaff;padding:18px 14px;margin-bottom:24px;">

{{-- ────────────────────────────────────────
     BAR CHART  (horizontal)
──────────────────────────────────────── --}}
@if($gType === 'bar')
@php $bSvgH = $nCats * 42 + 14; @endphp
<svg viewBox="0 0 490 {{ $bSvgH }}" style="width:100%;display:block;">
    @foreach($catArr as $i => $cat)
    @php
        $y  = $i * 42 + 4;
        $bw = max(0, min(290, round(($cat['score'] / 100) * 290)));
        $cc = $cat['color'] ?? '#175cdd';
    @endphp
    <circle cx="7"  cy="{{ $y+13 }}" r="5" fill="{{ $cc }}"/>
    <text x="17" y="{{ $y+17 }}" font-size="11" font-weight="bold" fill="#1a1a2e">{{ $cat['name'] }}</text>
    <rect x="155" y="{{ $y+5 }}" width="290" height="16" rx="8" fill="#eef1f7"/>
    @if($cat['score'] > 0)
    <rect x="155" y="{{ $y+5 }}" width="{{ $bw }}" height="16" rx="8" fill="{{ $cc }}"/>
    @endif
    <text x="455" y="{{ $y+17 }}" font-size="11" font-weight="bold" fill="{{ $cc }}" text-anchor="end">{{ $cat['score'] }}%</text>
    @endforeach
</svg>

{{-- ────────────────────────────────────────
     LINE CHART  (area + points)
──────────────────────────────────────── --}}
@elseif($gType === 'line')
@php
$pL = 44; $pR = 470; $pT = 18; $pB = 178; $pW = $pR-$pL; $pH = $pB-$pT;
$xStep = $nCats > 1 ? $pW / ($nCats - 1) : 0;
$pts = [];
foreach ($catArr as $i => $cat) {
    $px = $nCats > 1 ? $pL + $i * $xStep : $pL + $pW/2;
    $py = $pB - ($cat['score'] / 100) * $pH;
    $pts[] = ['px' => round($px,1), 'py' => round($py,1), 'cat' => $cat];
}
$lineStr = implode(' ', array_map(fn($p) => $p['px'].','.$p['py'], $pts));
$areaStr = $lineStr.' '.round($pR,1).','.round($pB,1).' '.round($pL,1).','.round($pB,1);
@endphp
<svg viewBox="0 0 490 225" style="width:100%;display:block;">
    @foreach([0,25,50,75,100] as $pct)
    @php $gy = round($pB - ($pct/100)*$pH, 1); @endphp
    <line x1="{{ $pL }}" y1="{{ $gy }}" x2="{{ $pR }}" y2="{{ $gy }}" stroke="#eef1f7" stroke-width="1"/>
    <text x="{{ $pL-4 }}" y="{{ $gy+4 }}" font-size="9" fill="#9ca3af" text-anchor="end">{{ $pct }}%</text>
    @endforeach
    <line x1="{{ $pL }}" y1="{{ $pT }}" x2="{{ $pL }}" y2="{{ $pB }}" stroke="#e4ecf8" stroke-width="1"/>
    <polygon points="{{ $areaStr }}" fill="#175cdd" fill-opacity="0.08"/>
    <polyline points="{{ $lineStr }}" fill="none" stroke="#175cdd" stroke-width="2.5" stroke-linejoin="round"/>
    @foreach($pts as $p)
    @php $cc = $p['cat']['color'] ?? '#175cdd'; $nm = mb_substr($p['cat']['name'],0,11); @endphp
    <circle cx="{{ $p['px'] }}" cy="{{ $p['py'] }}" r="6" fill="{{ $cc }}" stroke="#fff" stroke-width="2"/>
    <text x="{{ $p['px'] }}" y="{{ $p['py']-11 }}" font-size="10" font-weight="bold" text-anchor="middle" fill="{{ $cc }}">{{ $p['cat']['score'] }}%</text>
    <text x="{{ $p['px'] }}" y="213" font-size="9" font-weight="bold" text-anchor="middle" fill="#3c4049">{{ $nm }}</text>
    @endforeach
</svg>

{{-- ────────────────────────────────────────
     PIE / DONUT CHART
──────────────────────────────────────── --}}
@elseif($gType === 'pie')
@php
$cx = 125; $cy = 125; $r = 100; $ri = 58;
$total  = array_sum(array_column($catArr,'score')) ?: 1;
$sd     = -90.0;
$slices = [];
foreach ($catArr as $cat) {
    $sw = ($cat['score'] / $total) * 360;
    if ($sw >= 0.5) { $slices[] = ['cat'=>$cat,'start'=>$sd,'sweep'=>$sw]; $sd += $sw; }
}
$legRows = count($catArr);
$pieSvgH = max(270, $legRows * 34 + 20);
@endphp
<svg viewBox="0 0 490 {{ $pieSvgH }}" style="width:100%;display:block;">
    @foreach($slices as $sl)
    @php $cc = $sl['cat']['color'] ?? '#175cdd'; $d = pdfArcPath($cx,$cy,$r,$ri,$sl['start'],$sl['sweep']); @endphp
    @if($d)<path d="{{ $d }}" fill="{{ $cc }}" stroke="#fff" stroke-width="2"/>@endif
    @endforeach
    {{-- centre text --}}
    <text x="{{ $cx }}" y="{{ $cy-6 }}"  font-size="22" font-weight="bold" text-anchor="middle" fill="#07112b">{{ $overallPct }}%</text>
    <text x="{{ $cx }}" y="{{ $cy+14 }}" font-size="8"  text-anchor="middle" fill="#9ca3af">OVERALL</text>
    {{-- legend --}}
    @foreach($catArr as $i => $cat)
    @php $cc = $cat['color'] ?? '#175cdd'; $ly = 22 + $i * 34; @endphp
    <rect x="264" y="{{ $ly }}" width="10" height="10" rx="5" fill="{{ $cc }}"/>
    <text x="280" y="{{ $ly+9 }}" font-size="11" font-weight="bold" fill="#1a1a2e">{{ $cat['name'] }}</text>
    <text x="480" y="{{ $ly+9 }}" font-size="11" font-weight="bold" fill="{{ $cc }}" text-anchor="end">{{ $cat['score'] }}%</text>
    @endforeach
</svg>

{{-- ────────────────────────────────────────
     RADAR / SPIDER CHART
──────────────────────────────────────── --}}
@elseif($gType === 'radar')
@php
$cx = 185; $cy = 160; $maxR = 125;
$axes = []; $dataPts = [];
for ($i = 0; $i < $nCats; $i++) {
    $adeg  = ($i / $nCats) * 360 - 90;
    $arad  = $adeg * M_PI / 180;
    $pr    = ($catArr[$i]['score'] / 100) * $maxR;
    $norm  = fmod($adeg + 360, 360);
    $anch  = ($norm > 10 && $norm < 170) ? 'start' : (($norm > 190 && $norm < 350) ? 'end' : 'middle');
    $axes[] = [
        'ex'   => round($cx + $maxR * cos($arad), 2),
        'ey'   => round($cy + $maxR * sin($arad), 2),
        'lx'   => round($cx + ($maxR+22) * cos($arad), 2),
        'ly'   => round($cy + ($maxR+22) * sin($arad), 2),
        'pdx'  => round($cx + $pr * cos($arad), 2),
        'pdy'  => round($cy + $pr * sin($arad), 2),
        'cc'   => $catArr[$i]['color'] ?? '#175cdd',
        'name' => $catArr[$i]['name'],
        'anch' => $anch,
    ];
    $dataPts[] = round($cx+$pr*cos($arad),2).','.round($cy+$pr*sin($arad),2);
}
$dataPoly = implode(' ', $dataPts);

$gridPolys = [];
foreach ([0.25, 0.5, 0.75, 1.0] as $lv) {
    $gps = [];
    for ($i = 0; $i < $nCats; $i++) {
        $ar  = (($i/$nCats)*360-90)*M_PI/180;
        $gps[] = round($cx+$lv*$maxR*cos($ar),1).','.round($cy+$lv*$maxR*sin($ar),1);
    }
    $gridPolys[] = implode(' ', $gps);
}
@endphp
<svg viewBox="0 0 490 320" style="width:100%;display:block;">
    {{-- grid --}}
    @foreach($gridPolys as $gp)
    <polygon points="{{ $gp }}" fill="none" stroke="#e4ecf8" stroke-width="1"/>
    @endforeach
    {{-- axis lines --}}
    @foreach($axes as $ax)
    <line x1="{{ $cx }}" y1="{{ $cy }}" x2="{{ $ax['ex'] }}" y2="{{ $ax['ey'] }}" stroke="#e4ecf8" stroke-width="1"/>
    @endforeach
    {{-- data fill + border --}}
    <polygon points="{{ $dataPoly }}" fill="#175cdd" fill-opacity="0.15" stroke="#175cdd" stroke-width="2.5"/>
    {{-- data point dots + labels --}}
    @foreach($axes as $ax)
    <circle cx="{{ $ax['pdx'] }}" cy="{{ $ax['pdy'] }}" r="5" fill="{{ $ax['cc'] }}" stroke="#fff" stroke-width="2"/>
    <text x="{{ $ax['lx'] }}" y="{{ $ax['ly']+4 }}" font-size="10" font-weight="bold" text-anchor="{{ $ax['anch'] }}" fill="#3c4049">{{ $ax['name'] }}</text>
    @endforeach
    {{-- score legend (right column) --}}
    @foreach($catArr as $i => $cat)
    @php $cc = $cat['color'] ?? '#175cdd'; $ly = 28 + $i * 30; @endphp
    <circle cx="358" cy="{{ $ly+5 }}" r="5" fill="{{ $cc }}"/>
    <text x="369" y="{{ $ly+9 }}" font-size="11" font-weight="bold" fill="#1a1a2e">{{ $cat['name'] }}</text>
    <text x="482" y="{{ $ly+9 }}" font-size="11" font-weight="bold" fill="{{ $cc }}" text-anchor="end">{{ $cat['score'] }}%</text>
    @endforeach
</svg>
@endif

</div>{{-- /chart card --}}
@endif
{{-- ═══ end performance chart ═══ --}}

    <div class="sec-head" style="margin-bottom:18px;">Question-by-Question Breakdown</div>

    @php
        $qIdx      = 0;
        $ansLabels = ['', 'Never', 'Rarely', 'Sometimes', 'Often', 'Always'];
        $bgMap     = ['', '#fee2e2', '#fef3c7', '#fef9c3', '#dcfce7', '#bbf7d0'];
        $colMap    = ['', '#b91c1c', '#b45309', '#ca8a04', '#15803d', '#166534'];
    @endphp

    @foreach ($test->categories as $si => $cat)
        @php
            $cc      = $cat->color ?? ($chartData[$si]['color'] ?? '#175cdd');
            $catName = $cat->category_name ?? ($cat->name ?? 'Section ' . ($si + 1));
            $cScore  = $chartData[$si]['score'] ?? 0;
        @endphp
        <div class="qa-block">
            <div class="qa-hdr" style="background:{{ $cc }};">
                <table><tr>
                    <td class="qa-hdr-name">{{ $catName }}</td>
                    <td class="qa-hdr-score">{{ $cScore }}%</td>
                </tr></table>
            </div>
            <table class="qa-tbl">
                <tr class="qa-th">
                    <th style="width:28px;">#</th>
                    <th>Question</th>
                    <th class="r" style="width:90px;">Answer</th>
                </tr>
                @foreach ($cat->questions as $qi => $question)
                    @php $ans = $answers[$qIdx] ?? 3; $qIdx++; @endphp
                    <tr style="background:{{ $qi % 2 === 0 ? '#fff' : '#f9fbff' }};">
                        <td class="qa-num">Q{{ $qi + 1 }}</td>
                        <td>{{ $question->question_text }}</td>
                        <td class="qa-ans">
                            <span class="abadge"
                                  style="background:{{ $bgMap[$ans] ?? '#fef9c3' }};color:{{ $colMap[$ans] ?? '#ca8a04' }};">
                                {{ $ansLabels[$ans] ?? 'Sometimes' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endforeach

</div>

<div class="ftr">
    Act to Action Performing Arts Academy &nbsp;&middot;&nbsp; acttoaction.com
    &nbsp;&middot;&nbsp; This report is personalised and confidential
    &nbsp;&middot;&nbsp; Generated {{ date('d M Y') }}
</div>

</body>
</html>
