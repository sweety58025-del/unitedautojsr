@php
    $breadcrumbTitle = trim($__env->yieldContent('breadcrumb')) ?: trim($__env->yieldContent('title'));
    $breadcrumbName = \Illuminate\Support\Str::before($breadcrumbTitle ?: 'United Auto', ' | ');
    $configuredAppUrl = rtrim((string) config('app.url'), '/');
    $breadcrumbBase = $configuredAppUrl && ! str_contains($configuredAppUrl, 'localhost')
        ? preg_replace('/^http:/i', 'https:', $configuredAppUrl)
        : 'https://unitedautojsr.in';
    $breadcrumbPath = request()->getPathInfo();
    $breadcrumbUrl = trim($__env->yieldContent('canonical')) ?: $breadcrumbBase . ($breadcrumbPath === '/' ? '' : '/' . ltrim($breadcrumbPath, '/'));
@endphp
<div class="wptb-page-heading" style="background-image: url('{{ asset('front/assets/img/background/page-header-bg.jpg') }}');">
    <div class="container">
        <div class="wptb-item--inner">
            <div class="wptb-item--title">{{ html_entity_decode($breadcrumbName, ENT_QUOTES, 'UTF-8') }}</div>
            <div class="wptb-breadcrumb-wrap">
                <ul class="wptb-breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>{{ html_entity_decode($breadcrumbName, ENT_QUOTES, 'UTF-8') }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => $breadcrumbName, 'item' => $breadcrumbUrl],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>