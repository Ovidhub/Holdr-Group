<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            // HOME
            ['home', 'hero_tagline',     'Hero tagline',             'text',     'SWISS-INSPIRED PRIVATE & COMMERCIAL CUSTODY'],
            ['home', 'hero_heading',     'Hero heading',             'text',     'Sovereign Wealth Architecture & Global Treasury'],
            ['home', 'hero_subtext',     'Hero subtext',             'textarea', 'Orvatio Holders unites discretionary private banking discipline with real-time multi-currency clearing. Safeguard, convert, and deploy institutional or family-office capital across 108 jurisdictions with zero undisclosed spreads.'],
            ['home', 'hero_cta_label',   'Hero CTA button label',    'text',     'Establish Private Account'],
            ['home', 'cta_heading',      'Bottom CTA heading',       'text',     'Command Your Global Liquidity With Sovereign Precision'],
            ['home', 'cta_subtext',      'Bottom CTA subtext',       'textarea', 'Onboard your personal portfolio, family office, or corporate treasury with Orvatio Holders and unlock direct SWIFT/SEPA/Fedwire clearing, Lombard credit lines, and bespoke metal card programs.'],
            ['home', 'cta_btn1_label',   'CTA primary button',       'text',     'Open Sovereign Account'],
            ['home', 'cta_btn2_label',   'CTA secondary button',     'text',     'Consult Private Wealth Desk'],

            // HOME — Why Choose Us (3 feature cards)
            ['home', 'feature1_title', 'Feature 1 title', 'text',     'Institutional Interbank FX Desk'],
            ['home', 'feature1_body',  'Feature 1 body',  'textarea', 'Access direct tier-one interbank liquidity across 55+ sovereign currencies with locked spot execution and transparent basis-point pricing.'],
            ['home', 'feature2_title', 'Feature 2 title', 'text',     'Sub-Second Sovereign Clearing'],
            ['home', 'feature2_body',  'Feature 2 body',  'textarea', 'Settle high-value international wires across SWIFT gpi, SEPA Instant, CHAPS, and Fedwire with real-time cryptographic settlement receipts.'],
            ['home', 'feature3_title', 'Feature 3 title', 'text',     'Dedicated Private Bankers'],
            ['home', 'feature3_body',  'Feature 3 body',  'textarea', 'Every Orvatio Holders mandate is supported by senior wealth partners available 24/7 for structured credit, cross-border acquisitions, and treasury governance.'],

            // HOME — Smart Digital Banking (2 feature items)
            ['home', 'smart_tagline',       'Smart Banking tagline', 'text',     'UNIFIED TREASURY ARCHITECTURE'],
            ['home', 'smart_heading',       'Smart Banking heading', 'text',     'Orchestrate Multi-Jurisdictional Capital From One Ledger'],
            ['home', 'smart_body',          'Smart Banking body',    'textarea', 'Eliminate fragmented correspondent banking relationships. Orvatio Holders delivers dedicated local IBANs, automated liquidity sweeps, and bespoke credit underwriting inside one fortified command center.'],
            ['home', 'smart_feat1_title',   'Smart feature 1 title', 'text',     'Named Multi-Currency Custody Accounts'],
            ['home', 'smart_feat1_body',    'Smart feature 1 body',  'textarea', 'Receive, hold, and disburse USD, EUR, GBP, CHF, SGD, and 50+ currencies in your own entity name with local clearing credentials.'],
            ['home', 'smart_feat2_title',   'Smart feature 2 title', 'text',     'Programmable Governance & Yield Sweeps'],
            ['home', 'smart_feat2_body',    'Smart feature 2 body',  'textarea', 'Enforce multi-signatory board approvals, dynamic executive card policies, and automated overnight allocation into sovereign treasury vaults.'],

            // HOME — Banking Security (2 feature items)
            ['home', 'sec_tagline',     'Security tagline',         'text',     'SWISS-GRADE SAFEGUARDING'],
            ['home', 'sec_heading',     'Security heading',         'text',     'Fortified Segregated Custody & Cryptographic Governance'],
            ['home', 'sec_body',        'Security body',            'textarea', 'Client assets at Orvatio Holders are held in bankruptcy-remote, 100% segregated tier-one custodial accounts protected by hardware security modules (HSM) and biometric zero-trust authorization.'],
            ['home', 'sec_feat1_title', 'Security feature 1 title', 'text',     'Hardware-Enforced Multi-Signature Vaults'],
            ['home', 'sec_feat1_body',  'Security feature 1 body',  'textarea', 'Every high-value disbursement is protected by FIDO2 hardware keys, behavioral telemetry, and cryptographic transaction signing.'],
            ['home', 'sec_feat2_title', 'Security feature 2 title', 'text',     'Real-Time Corridor & Card Controls'],
            ['home', 'sec_feat2_body',  'Security feature 2 body',  'textarea', 'Instantly lock geographic corridors, set per-merchant velocity caps, or freeze physical and virtual metal cards from your mobile vault.'],

            // HOME — App section
            ['home', 'app_tagline', 'App section tagline', 'text',     'ORVATIO MOBILE VAULT'],
            ['home', 'app_heading', 'App section heading', 'text',     'Discretionary Private Banking Wherever You Travel'],
            ['home', 'app_body',    'App section body',    'textarea', 'Authorize cross-border wires, monitor real-time FX exposure, provision instant virtual cards, and message your private banker directly from iOS or Android.'],
            ['home', 'app_stat',    'App downloads stat',  'text',     'Entrusted with over $48.6B+ in annual cleared volume across 108 countries'],

            // HOME — Testimonials header
            ['home', 'test_tagline', 'Testimonials tagline', 'text', 'CLIENT MANDATES'],
            ['home', 'test_heading', 'Testimonials heading', 'text', 'Trusted by Principals, Family Offices & Global CFOs'],

            // HOME — Counters (4 numbers)
            ['home', 'counter1_num', 'Counter 1 number (Happy Customers)',   'text', '1850'],
            ['home', 'counter2_num', 'Counter 2 number (Years in Banking)',  'text', '34'],
            ['home', 'counter3_num', 'Counter 3 number (Branches)',          'text', '3120'],
            ['home', 'counter4_num', 'Counter 4 number (Countries)',         'text', '108'],

            // ABOUT
            ['about', 'header_title',    'Page header title',        'text',     'About Orvatio Holders'],
            ['about', 'story_tagline',   'Story section tagline',    'text',     'THE ORVATIO CHARTER'],
            ['about', 'story_heading',   'Story section heading',    'text',     'Redefining Sovereign Private & Commercial Banking'],
            ['about', 'story_body',      'Story section body',       'textarea', 'Orvatio Holders was established to bridge the divide between traditional Swiss private banking stewardship and instantaneous global settlement architecture. Serving private principals, family offices, and multinational enterprises across 108 countries, we provide segregated multi-currency custody, institutional FX execution, and bespoke credit facilities without legacy friction.'],
            ['about', 'bullet_1',        'Highlight bullet 1',       'text',     'Dedicated named IBANs and local clearing accounts across Zurich, London, New York, Singapore, and Frankfurt.'],
            ['about', 'bullet_2',        'Highlight bullet 2',       'text',     '24/7 private wealth partners and corporate treasury specialists assigned to every client relationship.'],
            ['about', 'bullet_3',        'Highlight bullet 3',       'text',     '100% transparent interbank FX execution and rapid Lombard & commercial credit underwriting.'],
            ['about', 'cta_heading',     'Bottom CTA heading',       'text',     'Experience Sovereign Banking Without Borders'],
            ['about', 'cta_body',        'Bottom CTA body',          'textarea', 'Unify your private wealth, corporate treasury, credit lines, and global metal card programs inside one institution engineered for permanence and speed.'],

            // CONTACT
            ['contact', 'header_title',   'Page header title',       'text',     'Private Advisory & Support'],
            ['contact', 'header_subtext', 'Page header subtext',     'textarea', 'Speak directly with our private wealth partners or corporate treasury desk. Our global specialists are available 24/7/365.'],
            ['contact', 'location_label', 'Location card label',     'text',     'Global Headquarters'],
            ['contact', 'location_value', 'Location address',        'textarea', 'Bahnhofstrasse 42, 8001 Zürich, Switzerland & 200 Park Avenue, New York, NY 10166'],
            ['contact', 'email_label',    'Email card label',        'text',     'Private Advisory Desk'],
            ['contact', 'email_value',    'Email address',           'text',     'info@orvatioholders.online'],
            ['contact', 'phone_label',    'Phone card label',        'text',     '24/7 Sovereign Concierge'],
            ['contact', 'phone_value',    'Phone number',            'text',     '+41 44 580 29 10'],

            // BUSINESS
            ['business', 'intro_heading',   'Intro section heading',  'text',     'Institutional Corporate Treasury & Cross-Border Clearing'],
            ['business', 'overview_heading','Overview block heading', 'text',     'Engineered for Multinational Enterprises & Family Offices'],
            ['business', 'overview_body',   'Overview block body',    'textarea', 'From global holding structures to high-velocity operating companies, Orvatio Holders delivers multi-currency accounts, automated supplier settlements, revolving credit lines, and board-grade governance controls.'],
            ['business', 'app_heading',     'App section heading',    'text',     'Direct Your Global Treasury From Any Time Zone'],
            ['business', 'app_body',        'App section body',       'textarea', 'Approve multi-million-dollar wire batches, issue departmental virtual cards with granular spend caps, and lock forward FX rates from our web and mobile suite.'],
            ['business', 'app_stat',        'App downloads stat',     'text',     'Powering 640K+ corporate treasuries and institutional entities worldwide'],

            // PERSONAL
            ['personal', 'intro_heading',   'Intro section heading',  'text',     'Bespoke Private Banking Built Around Your Legacy'],
            ['personal', 'overview_heading','Overview block heading', 'text',     'Discreet Wealth Custody Meets Instant Global Liquidity'],
            ['personal', 'overview_body',   'Overview block body',    'textarea', 'Whether acquiring international real estate, managing multi-generational family capital, or travelling across continents, Orvatio Holders provides effortless multi-currency liquidity and sovereign protection.'],
            ['personal', 'app_heading',     'App section heading',    'text',     'Complete Visibility Over Your Global Net Worth, 24/7'],
            ['personal', 'app_body',        'App section body',       'textarea', 'Monitor segregated currency vaults, earn institutional yields on cash reserves, and execute instant international transfers with zero hidden fees.'],
            ['personal', 'app_stat',        'App downloads stat',     'text',     'Trusted by over 1.85 million private banking clients worldwide'],

            // LOANS
            ['loans', 'intro_heading', 'Intro section heading', 'text',     'Lombard Credit, Real Estate & Corporate Lending Facilities'],
            ['loans', 'apply_heading', 'Apply block heading',   'text',     'Tailored Liquidity Without Liquidating Core Holdings'],
            ['loans', 'apply_body',    'Apply block body',      'textarea', 'Access competitive fixed and floating credit facilities for residential and commercial real estate, aviation and marine finance, corporate expansion, and portfolio-backed liquidity—with rapid underwriting and zero prepayment penalties.'],
            ['loans', 'app_heading',   'App section heading',   'text',     'Structured Capital Disbursed on Your Schedule'],
            ['loans', 'app_body',      'App section body',      'textarea', 'Submit your credit mandate online in minutes, review transparent amortization terms upfront, and receive direct settlement into your Orvatio Holders custody account.'],
            ['loans', 'app_stat',      'App stat line',         'text',     'Over $14.2B+ in private and commercial credit facilities underwritten'],

            // CARDS
            ['cards', 'intro_heading', 'Intro section heading', 'text',     'Orvatio Sovereign Metal & Virtual Multi-Currency Cards'],
            ['cards', 'apply_heading', 'Apply block heading',   'text',     'Commission Your Orvatio Holders Metal Card'],
            ['cards', 'apply_body',    'Apply block body',      'textarea', 'Precision-milled from brushed emerald steel and 24k champagne gold accenting—accepted at 90M+ merchants worldwide with zero foreign exchange markups, private aviation & lounge privileges, and instant virtual card provisioning.'],
            ['cards', 'app_heading',   'App section heading',   'text',     'Total Card Command & Real-Time Spend Telemetry'],
            ['cards', 'app_body',      'App section body',      'textarea', 'Provision single-use virtual cards for online acquisitions, customize daily ATM and merchant limits, and lock or unlock cards globally with one tap.'],
            ['cards', 'app_stat',      'App stat line',         'text',     'Over 2.9 million active Orvatio Holders metal and virtual cards in circulation'],
        ];

        foreach ($rows as [$page, $key, $label, $type, $value]) {
            PageContent::updateOrCreate(
                ['page' => $page, 'section_key' => $key],
                ['label' => $label, 'type' => $type, 'value' => $value]
            );
        }
    }
}
