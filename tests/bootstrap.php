<?php

// ce fichier sert à réaliser les actions nécessaires à l'éxécution des tests -> il définit l'environnement de notre test
// il est exécuté AVANT notre premier test
// => par exemple charger l'environnement de WordPress

/**
 * Tells WordPress to load the WordPress theme and output it.
 * Here don't use themes => (ici ce chargement de WordPress ne sert qu'au test)
 * @var bool
 */
define( 'WP_USE_THEMES', false );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/../wp/wp-blog-header.php';