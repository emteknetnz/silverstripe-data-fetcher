<?php

namespace emteknetnz\DataFetcher\Misc;

class Consts
{
    public const METHOD_GET = 'get';

    public const METHOD_POST = 'post';

    public const MODULES = [
        'regular' => [
            'bringyourownideas' => [
                'silverstripe-maintenance',
                'silverstripe-composer-update-checker',
                'silverstripe-composer-security-checker',
            ],
            'silverstripe' => [
                'recipe-cms',
                'recipe-core',
                'recipe-plugin',
                'silverstripe-reports',
                'silverstripe-siteconfig',
                'silverstripe-versioned',
                'silverstripe-versioned-admin',
                'silverstripe-userhelp-content', // not an installed module, though still relevant
                'cwp-agencyextensions',
                'cwp',
                'cwp-core',
                'cwp-installer',
                'cwp-pdfexport',
                'cwp-recipe-cms',
                'cwp-recipe-core',
                'cwp-recipe-search',
                'cwp-search',
                'cwp-starter-theme',
                'cwp-watea-theme',
                'silverstripe-akismet',
                'silverstripe-auditor',
                'silverstripe-blog',
                'comment-notifications',
                'silverstripe-admin',
                'silverstripe-asset-admin',
                'silverstripe-assets',
                'silverstripe-campaign-admin',
                'silverstripe-ckan-registry',
                'silverstripe-cms',
                'silverstripe-config',
                'silverstripe-errorpage',
                'silverstripe-framework',
                'silverstripe-graphql',
                'silverstripe-installer',
                'silverstripe-comments',
                'silverstripe-content-widget',
                'silverstripe-contentreview',
                'silverstripe-crontask',
                'silverstripe-documentconverter',
                'silverstripe-elemental',
                'silverstripe-elemental-bannerblock',
                'silverstripe-elemental-fileblock',
                'silverstripe-environmentcheck',
                'silverstripe-externallinks',
                'silverstripe-fulltextsearch',
                'silverstripe-gridfieldqueuedexport',
                'silverstripe-html5',
                'silverstripe-hybridsessions',
                'silverstripe-iframe',
                'silverstripe-ldap',
                'silverstripe-lumberjack',
                'silverstripe-mimevalidator',
                'silverstripe-postgresql',
                'silverstripe-realme',
                'silverstripe-session-manager',
                'recipe-authoring-tools',
                'recipe-blog',
                'recipe-collaboration',
                'recipe-content-blocks',
                'recipe-form-building',
                'recipe-reporting-tools',
                'recipe-services',
                'silverstripe-registry',
                'silverstripe-restfulserver',
                'silverstripe-securityreport',
                'silverstripe-segment-field',
                'silverstripe-selectupload',
                'silverstripe-sharedraftcontent',
                'silverstripe-sitewidecontent-report',
                'silverstripe-spamprotection',
                'silverstripe-spellcheck',
                'silverstripe-subsites',
                'silverstripe-tagfield',
                'silverstripe-taxonomy',
                'silverstripe-textextraction', // only a supported dependency, though ...
                'silverstripe-userforms',
                'silverstripe-widgets',
                'silverstripe-mfa',
                'silverstripe-totp-authenticator',
                'silverstripe-webauthn-authenticator',
                'silverstripe-login-forms',
                'silverstripe-security-extensions',
                'silverstripe-upgrader',
                'silverstripe-versionfeed', // not in commercially supported list, though is in cwp
                'sspak',
                'vendor-plugin',
            ],
            'silverstripe-themes' => [
                'silverstripe-simple',
            ],
            'symbiote' => [
                'silverstripe-advancedworkflow',
                'silverstripe-gridfieldextensions', // only a supported dependency, though ...
                'silverstripe-multivaluefield',
                'silverstripe-queuedjobs',
            ],
            'tractorcow' => [
                // 'classproxy', // supported dependency
                'silverstripe-fluent', // only a supported dependency, though in kitchen-sink
                // 'silverstripe-proxy-db', // supported dependency
            ]
        ],
        'ss3' => [
            'silverstripe' => [
                'cwp-recipe-basic',
                'cwp-recipe-blog',
                'silverstripe-activedirectory',
                'silverstripe-dms',
                'silverstripe-dms-cart',
                'silverstripe-secureassets',
                'silverstripe-staticpublishqueue',
                'silverstripe-translatable',
            ],
            'symbiote' => [
                'silverstripe-versionedfiles',
            ],
        ],
        'legacy' => [
            'silverstripe' => [
                'cwp-agencyextensions',
                'cwp-theme-default',
                'silverstripe-controllerpolicy',
                'silverstripe-elemental-blocks',
                'silverstripe-sqlite3',
            ]
        ],
        'tooling' => [
            'lekoala' => [
                'silverstripe-debugbar',
            ],
            'silverstripe' => [
                'cow',
                'eslint-config',
                'MinkFacebookWebDriver',
                'recipe-testing',
                'silverstripe-behat-extension',
                'silverstripe-serve',
                'silverstripe-travis-shared',
                'silverstripe-testsession',
                'webpack-config',
            ]
        ],
    ];
}