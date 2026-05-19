<?php 

if (!class_exists('SQB_Utils')) {

    class SQB_Utils {









                                                                                          private static $config = null;


















                                                                                                                   public static function load_config(array $overrides = []) : array {
            
            

                                                                                                                       if (self::$config !== null) {
                                                                                          return self::$config;
            }
            
            
            
                                                                                                                       // Default config values (editable)
                                                                                                                       $cfg = [
                                                                                                                           'feature_enabled' => true,
                                                                                                                           'max_items' => 250,
                                                                                                                           'cache_ttl' => 3600, // seconds (unused here; placeholder)
                                                                                                                           'module_version' => '1.0.0',
            ];
            
            
            
                                                                                                                       // Merge overrides for testing/dev
                                                                                                                       self::$config = array_merge($cfg, $overrides);
            
            
            
                        return self::$config;
        }



















                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   public static function is_production() : bool {
            
            
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       if (defined('WP_DEBUG') && WP_DEBUG) {
                                                                                                                           return false;
            }
            
            
            return true;
        }


























                                                                                                                   public static function log_debug(string $msg) : void {
            
            
                                                                                                                                                                                                                                  if (!defined('WP_DEBUG') || !WP_DEBUG) {
                                                                                                                           return; // no-op in production
            }
            
            
                                                                                                                       error_log('[SQB-UTIL] ' . $msg);
        }









    }

}


$wcpDomainSQB = "https://wickedcoolplugins.com";
$api_url_sqb = $wcpDomainSQB."/pluginupdater/autoupdateSQBNew.php";
$plugin_slug_sqb = "smartquizbuilder";
$sqbVersion = SQB_VERSION;
$domain = getSQBUrlToDomainName(site_url()); 
$licenseKey = get_option('wcp_licenseKey', true);
$productNick = 'SQB';

$request_args = array(
        'slug' => $plugin_slug_sqb,     
        'version' => $sqbVersion,
        'domain' => trim($domain),
        'lk' => trim($licenseKey),
        'pn' => trim($productNick),
    );

$api_url_with_params = add_query_arg(
    $request_args,
    $api_url_sqb
);

if (class_exists('Puc_v4_Factory') && method_exists('Puc_v4_Factory', 'buildUpdateChecker')) {
    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
      $api_url_with_params,
      SQB_PLUGIN_FILE, //Full path to the main plugin file or functions.php.
      $plugin_slug_sqb
    );
}


function getSQBUrlToDomainName($url) {
    $domain = preg_replace('/https?:\/\/(www\.)?/', '', $url);
    if ( strpos($domain, '/') !== false ) {
        $explode = explode('/', $domain);
        $domain  = $explode['0'];
    }
   return $domain;
}