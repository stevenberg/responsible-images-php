<?php

$finder = PhpCsFixer\Finder::create()->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PHP80Migration' => true,
        '@PhpCsFixer' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'mb_str_functions' => true,
        'phpdoc_add_missing_param_annotation' => false,
        'php_unit_internal_class' => false,
        'php_unit_test_class_requires_covers' => false,
        'yoda_style' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
