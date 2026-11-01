<?php

// Public navigation. `enabled => false` items are hidden until the open decisions (D-10, D-11) are settled.
return [
    'menu' => [
        ['label' => 'Home', 'route' => 'home', 'enabled' => true],
        ['label' => 'About Us', 'route' => 'about', 'enabled' => true],
        ['label' => 'Products', 'route' => 'products.index', 'enabled' => true], // dropdown of categories in Phase 5/6
        ['label' => 'Export Markets', 'route' => 'export-markets', 'enabled' => true],
        ['label' => 'Certification', 'route' => 'certification', 'enabled' => true],
        ['label' => 'How We Export', 'route' => 'how-we-export', 'enabled' => true],
        ['label' => 'Contact', 'route' => 'contact', 'enabled' => true],
        // Present in design, not yet in scope:
        ['label' => 'Quality & Packaging', 'route' => null, 'enabled' => false],
        ['label' => 'Blog', 'route' => null, 'enabled' => false],
    ],
];
