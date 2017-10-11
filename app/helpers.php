<?php

/**
 * Global helpers file with misc functions.
 */

if (!function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     *
     * @return \Creativeorange\Gravatar\Gravatar|\Illuminate\Foundation\Application|mixed
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (!function_exists('to_js')) {
    /**
     * Access the javascript helper.
     */
    function to_js($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('tojs');
        }

        if (is_array($key)) {
            return app('tojs')->put($key);
        }

        return app('tojs')->get($key, $default);
    }
}

if (!function_exists('meta')) {
    /**
     * Access the meta helper.
     */
    function meta()
    {
        return app('meta');
    }
}

if (!function_exists('meta_tag')) {
    /**
     * Access the meta tags helper.
     */
    function meta_tag($name = null, $content = null, $attributes = [])
    {
        return app('meta')->tag($name, $content, $attributes);
    }
}

if (!function_exists('meta_property')) {
    /**
     * Access the meta tags helper.
     */
    function meta_property($name = null, $content = null, $attributes = [])
    {
        return app('meta')->property($name, $content, $attributes);
    }
}

if (!function_exists('protection_context')) {
    /**
     * @return \NetLicensing\Context
     */
    function protection_context()
    {
        return app('netlicensing')->context();
    }
}

if (!function_exists('protection_context_basic_auth')) {
    /**
     * @return \NetLicensing\Context
     */
    function protection_context_basic_auth()
    {
        return app('netlicensing')->context(\NetLicensing\Context::BASIC_AUTHENTICATION);
    }
}

if (!function_exists('protection_context_api_key')) {
    /**
     * @return \NetLicensing\Context
     */
    function protection_context_api_key()
    {
        return app('netlicensing')->context(\NetLicensing\Context::APIKEY_IDENTIFICATION);
    }
}

if (!function_exists('protection_shop_token')) {

    /**
     * @param \App\Models\Auth\User\User $user
     * @param null $successUrl
     * @param null $cancelUrl
     * @param null $successUrlTitle
     * @param null $cancelUrlTitle
     * @return \App\Models\Protection\ProtectionShopToken
     */
    function protection_shop_token(\App\Models\Auth\User\User $user, $successUrl = null, $cancelUrl = null, $successUrlTitle = null, $cancelUrlTitle = null)
    {
        return app('netlicensing')->createShopToken($user, $successUrl, $cancelUrl, $successUrlTitle, $cancelUrlTitle);
    }
}

if (!function_exists('protection_validate')) {

    /**
     * @param \App\Models\Auth\User\User $user
     * @return \App\Models\Protection\ProtectionValidation
     */
    function protection_validate(\App\Models\Auth\User\User $user)
    {
        return app('netlicensing')->validate($user);
    }
}

if (!function_exists('activeMenu')) {

    function activeMenu(Array $routes, $output = 'active')
    {
        foreach ($routes as $route) {

            if (Request::is(Request::segment(1) . '/' . $route . '/*') || Request::is(Request::segment(1) . '/' . $route) || Request::is($route)) {
                return $output;
            }
        }
    }

}

if (!function_exists('blockMenu')) {

    function blockMenu(Array $routes, $output = 'display: block')
    {
        foreach ($routes as $route) {

            if (Request::is(Request::segment(1) . '/' . $route . '/*') || Request::is(Request::segment(1) . '/' . $route) || Request::is($route)) {
                return $output;
            }
        }
    }
}

if (!function_exists('currentMenu')) {

    function currentMenu(Array $routes, $output = 'current-page')
    {
        foreach ($routes as $route) {

            if (Request::is(Request::segment(1) . '/' . $route . '/*') || Request::is(Request::segment(1) . '/' . $route) || Request::is($route)) {
                return $output;
            }
        }
    }
}

if (!function_exists('parseMoney')) {

    function parseMoney($val)
    {
        return number_format($val, 2, ',', '.');
    }
}

if (!function_exists('formatMoney')) {

    function formatMoney($val)
    {
        return str_replace(',', '.', str_replace('.', '', $val));
    }
}

if (!function_exists('capitalizeName')) {

    function capitalizeName($val)
    {
        $exceptions = array("e", "da", "de", "do", "dos", "das", "com", "sem", "no", "na");

        $words = explode(' ', $val);

        $new_val = array();

        foreach ($words as $word) {
            if (!in_array($word, $exceptions)) {
                $word = ucfirst($word);
            }
            array_push($new_val, $word);
        }

        $val = join(' ', $new_val);

        return $val;
    }
}