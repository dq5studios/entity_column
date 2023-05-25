<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude("cache/")
;

$config = new PhpCsFixer\Config();
return $config->setRules([
        "@PHP74Migration" => true,
        "@PHP74Migration:risky" => true,
        "@Symfony" => true,
        "@Symfony:risky" => true,
        "global_namespace_import" => ["import_classes" => true, "import_constants" => true, "import_functions" => true],
        "ordered_imports" => ["imports_order" => ["class", "function", "const"]],
        "single_quote" => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
