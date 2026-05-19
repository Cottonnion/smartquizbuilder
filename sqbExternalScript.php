<?php
// Disabled: unauthenticated path traversal / RCE vector removed during security audit
http_response_code(403);
die;
