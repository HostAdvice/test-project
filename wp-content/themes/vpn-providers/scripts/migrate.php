<?php

require_once dirname(__FILE__) . '/../../../../wp-config.php';
require_once dirname(__FILE__) . '/../../../../migrations/create_providers_table.php';
require_once dirname(__FILE__) . '/../../../../migrations/seed_providers.php';

// Run migrations
create_providers_table();

// Run seeds
seed_providers();

echo "Migrations and seeds completed successfully!\n";