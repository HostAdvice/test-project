<?php

class ProviderService {
    private $wpdb;
    private $table_name;

    public function __construct($wpdb) {
        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix . 'vpn_providers';
    }

    public function getAllProviders() {
        return $this->wpdb->get_results(
            "SELECT * FROM {$this->table_name}"
        );
    }

    public function getProviderBySlug($slug) {
        return $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table_name} WHERE slug = %s",
                $slug
            )
        );
    }
}