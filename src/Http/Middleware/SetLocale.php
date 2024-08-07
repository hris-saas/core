<?php

namespace HRis\Core\Http\Middleware;

use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($locale = $this->parseLocale($request)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }

    /**
     * @param  \Illuminate\Http\Request $request
     *
     * @return string|null
     */
    protected function parseLocale($request)
    {
        $locales = config('hris-saas.supported_locales');


        $locale = $request->server('HTTP_ACCEPT_LANGUAGE');

        $locale = substr($locale, 0, strpos($locale, ',') ?: strlen($locale));

        if (in_array($locale, $locales)) {
            return $locale;
        }
    }
}
