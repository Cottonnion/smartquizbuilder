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


// Phone-home removed: previously sent domain + license key to wickedcoolplugins.com/pluginupdater/autoupdateSQBNew.php
// $wcpDomainSQB = "https://wickedcoolplugins.com";

function getSQBUrlToDomainName($url) {
    $domain = preg_replace('/https?:\/\/(www\.)?/', '', $url);
    if ( strpos($domain, '/') !== false ) {
        $explode = explode('/', $domain);
        $domain  = $explode['0'];
    }
   return $domain;
}