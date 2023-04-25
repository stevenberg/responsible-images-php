<?php

$finder = PhpCsFixer\Finder::create()->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PHP82Migration' => true,
        '@PhpCsFixer' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'mb_str_functions' => true,
        'ordered_imports' => [
            'imports_order' => [
                'const',
                'class',
                'function',
            ],
        ],
        'phpdoc_add_missing_param_annotation' => false,
        'php_unit_internal_class' => false,
        'php_unit_test_class_requires_covers' => false,
        'yoda_style' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
