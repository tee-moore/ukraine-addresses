<?php

namespace UkraineAddresses\Base;

/**
 * Define the Ajax functionality.
 */
class Ajax
{
    public function addHook()
    {
        if (wp_doing_ajax()) {
            add_action('wp_ajax_geo_data', [$this, 'getGeoData']);
            add_action('wp_ajax_nopriv_geo_data', [$this, 'getGeoData']);
            add_filter('nocache_headers', 'addCache');
        }
    }


    function getGeoData()
    {
        check_ajax_referer('ua_ajax_nonce', 'nonce_code');

        $urlParams = ['per_page' => 2100, 'source' => 'wp'];
        $url = add_query_arg($urlParams, esc_url_raw($_REQUEST['url']));

        $requestArgs = [
            'sslverify' => false,
            'headers'   => [
                'Authorization' => 'Bearer ' . get_option('ua_secret_token'),
                'Content-type'  => 'application/json',
                'Accept'        => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET',
            ],
        ];

        $response = $this->makeRequest($url, $requestArgs);

        if (is_wp_error($response)) {
            $response = wp_strip_all_tags($response->get_error_message());
        }

        wp_send_json($response);
    }

    /**
     * @param $url
     * @param $requestArgs
     * @return mixed|\WP_Error
     */
    public function makeRequest($url, $requestArgs)
    {
        $response = wp_remote_get($url, $requestArgs);

        $responseCode = wp_remote_retrieve_response_code($response);
        $responseMessage = wp_remote_retrieve_response_message($response);
        $responseBody = json_decode(wp_remote_retrieve_body($response));

        if (200 != $responseCode && !empty($responseMessage))
            return new \WP_Error($responseCode, $responseMessage);
        elseif (200 != $responseCode)
            return new \WP_Error($responseCode, __('Unknown error', 'ua'));
        elseif (!$responseBody)
            return new \WP_Error('nodata', __('No data', 'ua'));
        else
            return $responseBody;
    }

    /**
     * @return array
     */
    function addCache()
    {
        if ($_REQUEST['action'] === 'geo_data') {
            $lifeTime = MINUTE_IN_SECONDS;

            $headers = [
                'Expires'       => gmdate('D, d M Y H:i:s', time() + $lifeTime) . ' GMT',
                'Cache-Control' => 'public',
            ];
        }

        return $headers;
    }
}