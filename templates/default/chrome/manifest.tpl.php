<?php

    header("Content-type: application/json");

    $icons = \Idno\Core\Idno::site()->getSiteIcons();
    
    $manifest = [
        'name' => \Idno\Core\Idno::site()->config()->getTitle(),
        'short_name' => \Idno\Core\Idno::site()->config()->getTitle(),
        'icons' => [
            
        ],
        'start_url' => \Idno\Core\Idno::site()->config()->getDisplayURL() . 'session/login',
        'display' => 'standalone'
    ];
            
    // Crufty, but slightly more extendable icons
    foreach (['36', '48', '72', '96', '144', '192'] as $size) {
        
        $namebits = explode('.', $icons['defaults']['default_'.$size]);
        
        $entry = [
            'src' => $icons['defaults']['default_'.$size],
            'sizes' => $size.'x'.$size, // Assume square for now.
            'type' => 'image/' . end($namebits)
        ];
        
        
        $manifest['icons'][] = $entry;
    }
    
    echo json_encode($manifest, JSON_PRETTY_PRINT);