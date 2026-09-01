<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CompanySetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Make URL generation follow the incoming request when handling HTTP requests.
        // Guard against running in console (artisan, queue workers, scheduler, etc.).
        if (! $this->app->runningInConsole() && ! $this->app->environment('production')) {
            try {
                $request = request();

                if ($request) {
                    // Prefer forwarded headers when present (X-Forwarded-Proto, X-Forwarded-Host),
                    // since middleware/trusted proxies may not have run yet at boot time.
                    $xfp = $request->headers->get('x-forwarded-proto') ?: $request->server->get('HTTP_X_FORWARDED_PROTO');
                    $xfh = $request->headers->get('x-forwarded-host') ?: $request->server->get('HTTP_X_FORWARDED_HOST');

                    // x-forwarded-proto/host can contain comma-separated values; take the first.
                    if ($xfp) {
                        $scheme = preg_split('/\s*,\s*/', $xfp)[0];
                    } else {
                        $scheme = $request->getScheme(); // fallback
                    }

                    if ($xfh) {
                        $host = preg_split('/\s*,\s*/', $xfh)[0];
                    } else {
                        $host = $request->getHttpHost();
                    }

                    // Force the root URL to the scheme + host of the incoming request so
                    // asset() and url() helpers generate URLs that match the browser origin.
                    URL::forceRootUrl($scheme . '://' . $host);

                    // Ensure scheme respects the forwarded proto when behind proxies.
                    if (strtolower($scheme) === 'https') {
                        URL::forceScheme('https');
                    }
                }
            } catch (\Throwable $e) {
                // If request isn't available or something goes wrong, fall back silently.
            }
        }

        Gate::before(function ($user, $ability) {
            if (! $user) {
                return null;
            }

            if ($user->hasRole('Super Admin') || $user->user_type === 'admin' || $user->user_type === 'super-admin') {
                return true;
            }

            return null;
        });

        try {
            if (\DB::connection()->getDatabaseName()) {
                view()->share(
                    'categories',
                    Category::with('subcategories')
                        ->where('status', 'yes')
                        ->get()
                );
                
                // Share company settings
                $companySetting = CompanySetting::first();
                view()->share([
                    'favicon_icon' => $companySetting->favicon_icon ?? 'favicon.png',
                    'company_logo' => $companySetting->logo ?? 'logo.png',
                    'company_name' => $companySetting->company_name ?? 'United Auto',
                    'company_phone' => $companySetting->phone ?? '',
                    'company_email' => $companySetting->email ?? '',
                    'company_address' => $companySetting->address ?? '',
                    'company_city' => $companySetting->city ?? '',
                    'company_state' => $companySetting->state ?? '',
                    'company_pincode' => $companySetting->pincode ?? '',
                ]);
            }
        } catch (\Exception $e) {
            // Database not yet migrated, set defaults
            view()->share([
                'favicon_icon' => 'favicon.png',
                'company_logo' => 'logo.png',
                'company_name' => 'United Auto',
                'company_phone' => '',
                'company_email' => '',
                'company_address' => '',
                'company_city' => '',
                'company_state' => '',
                'company_pincode' => '',
            ]);
        }
    }
}
