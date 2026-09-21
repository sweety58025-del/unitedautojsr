<div class="wptb-page-heading" style="background-image: url('{{ asset('front/assets/img/background/page-header-bg.jpg') }}');">
    <div class="container">
        <div class="wptb-item--inner">
            <div class="wptb-item--title">@yield('title', 'United Auto')</div>
            <div class="wptb-breadcrumb-wrap">
                <ul class="wptb-breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>@yield('title', 'United Auto')</span></li>
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
        ['@type' => 'ListItem', 'position' => 2, 'name' => trim($__env->yieldContent('title')) ?: 'United Auto', 'item' => url()->current()],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>