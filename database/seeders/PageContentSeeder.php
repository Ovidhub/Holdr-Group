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
            ['home', 'hero_tagline',     'Hero tagline',             'text',     'Private & Commercial Digital Banking'],
            ['home', 'hero_heading',     'Hero heading',             'text',     'Borderless Wealth & Treasury Built for Modern Ambition'],
            ['home', 'hero_subtext',     'Hero subtext',             'textarea', 'Mortil Holders pairs institutional-grade security with instant multi-currency settlement. Hold, convert, and deploy capital across 100+ jurisdictions with zero hidden spreads and round-the-clock private client support.'],
            ['home', 'hero_cta_label',   'Hero CTA button label',    'text',     'Open an Account'],
            ['home', 'cta_heading',      'Bottom CTA heading',       'text',     'Elevate the Way You Hold and Move Capital'],
            ['home', 'cta_subtext',      'Bottom CTA subtext',       'textarea', 'Open your Mortil Holders personal or corporate account in minutes and unlock instant global clearing, high-yield liquidity vaults, and bespoke credit lines.'],
            ['home', 'cta_btn1_label',   'CTA primary button',       'text',     'Open Private Account'],
            ['home', 'cta_btn2_label',   'CTA secondary button',     'text',     'Speak with an Advisor'],

            // HOME — Why Choose Us (3 feature cards)
            ['home', 'feature1_title', 'Feature 1 title', 'text',     'Transparent Interbank Pricing'],
            ['home', 'feature1_body',  'Feature 1 body',  'textarea', 'Execute domestic and international transfers at real-time interbank rates with upfront fee disclosure and zero surprise markups.'],
            ['home', 'feature2_title', 'Feature 2 title', 'text',     'Instant Settlement Rails'],
            ['home', 'feature2_body',  'Feature 2 body',  'textarea', 'Clear funds in seconds across SEPA, SWIFT, ACH, and Faster Payments with automated smart-routing and real-time tracking.'],
            ['home', 'feature3_title', 'Feature 3 title', 'text',     'Dedicated Relationship Desk'],
            ['home', 'feature3_body',  'Feature 3 body',  'textarea', 'Every account is backed by 24/7 specialist support and treasury advisors ready to assist with high-value transactions and compliance.'],

            // HOME — Smart Digital Banking (2 feature items)
            ['home', 'smart_tagline',       'Smart Banking tagline', 'text',     'INTELLIGENT TREASURY'],
            ['home', 'smart_heading',       'Smart Banking heading', 'text',     'Precision Financial Control From a Single Unified Ledger'],
            ['home', 'smart_body',          'Smart Banking body',    'textarea', 'Consolidate your everyday liquidity, cross-border settlements, and credit facilities inside an intuitive platform engineered for speed and clarity.'],
            ['home', 'smart_feat1_title',   'Smart feature 1 title', 'text',     'Global Multi-Currency Clearing'],
            ['home', 'smart_feat1_body',    'Smart feature 1 body',  'textarea', 'Hold, exchange, and disburse funds in over 50 currencies with local account details and instant cross-border settlement.'],
            ['home', 'smart_feat2_title',   'Smart feature 2 title', 'text',     'Automated Liquidity & Spend Controls'],
            ['home', 'smart_feat2_body',    'Smart feature 2 body',  'textarea', 'Configure granular approval workflows, dynamic card limits, and automated sweeps that put idle balances to work.'],

            // HOME — Banking Security (2 feature items)
            ['home', 'sec_tagline',     'Security tagline',         'text',     'FORTRESS INFRASTRUCTURE'],
            ['home', 'sec_heading',     'Security heading',         'text',     'Uncompromising Protection for Every Asset You Hold'],
            ['home', 'sec_body',        'Security body',            'textarea', 'Your capital is safeguarded by hardware-backed encryption, biometric authentication, real-time behavioral fraud telemetry, and segregated tier-one safeguarding.'],
            ['home', 'sec_feat1_title', 'Security feature 1 title', 'text',     'End-to-End Cryptographic Custody'],
            ['home', 'sec_feat1_body',  'Security feature 1 body',  'textarea', 'Every sign-in and wire instruction is verified through multi-factor hardware keys, TLS 1.3 encryption, and continuous anomaly monitoring.'],
            ['home', 'sec_feat2_title', 'Security feature 2 title', 'text',     'Instant Card & Vault Lockdown'],
            ['home', 'sec_feat2_body',  'Security feature 2 body',  'textarea', 'Freeze physical or virtual cards, restrict merchant categories, or lock outbound wires in a single tap from web or mobile.'],

            // HOME — App section
            ['home', 'app_tagline', 'App section tagline', 'text',     'MOBILE COMMAND CENTER'],
            ['home', 'app_heading', 'App section heading', 'text',     'Your Entire Private Bank in the Palm of Your Hand'],
            ['home', 'app_body',    'App section body',    'textarea', 'Approve wires, issue virtual cards on the fly, monitor foreign exchange exposure, and draw down credit lines from anywhere in the world.'],
            ['home', 'app_stat',    'App downloads stat',  'text',     'Trusted by over 9.2 million account holders across 100+ countries'],

            // HOME — Testimonials header
            ['home', 'test_tagline', 'Testimonials tagline', 'text', 'CLIENT PERSPECTIVES'],
            ['home', 'test_heading', 'Testimonials heading', 'text', 'Why Global Leaders & Private Clients Bank With Mortil Holders'],

            // HOME — Counters (4 numbers)
            ['home', 'counter1_num', 'Counter 1 number (Happy Customers)',   'text', '1450'],
            ['home', 'counter2_num', 'Counter 2 number (Years in Banking)',  'text', '28'],
            ['home', 'counter3_num', 'Counter 3 number (Branches)',          'text', '2650'],
            ['home', 'counter4_num', 'Counter 4 number (Countries)',         'text', '104'],

            // ABOUT
            ['about', 'header_title',    'Page header title',        'text',     'About Mortil Holders'],
            ['about', 'story_tagline',   'Story section tagline',    'text',     'THE MORTIL HOLDERS STANDARD'],
            ['about', 'story_heading',   'Story section heading',    'text',     'Engineering the Future of Private & Commercial Banking'],
            ['about', 'story_body',      'Story section body',       'textarea', 'Mortil Holders was founded on a clear conviction: private individuals and ambitious enterprises deserve banking infrastructure that moves as fast as the modern global economy. By combining tier-one capital stewardship with real-time settlement rails, we deliver frictionless accounts, transparent foreign exchange, and tailored credit facilities across more than 100 countries.'],
            ['about', 'bullet_1',        'Highlight bullet 1',       'text',     'Instant multi-currency accounts with local IBAN and routing credentials across major financial hubs.'],
            ['about', 'bullet_2',        'Highlight bullet 2',       'text',     '24/7 dedicated relationship managers and specialist treasury support whenever your operations demand it.'],
            ['about', 'bullet_3',        'Highlight bullet 3',       'text',     'Direct interbank pricing with zero concealed spreads, monthly surprises, or legacy wire delays.'],
            ['about', 'cta_heading',     'Bottom CTA heading',       'text',     'Experience Private Digital Banking Without Boundaries'],
            ['about', 'cta_body',        'Bottom CTA body',          'textarea', 'Manage personal wealth, corporate treasury, credit lines, and global card programs from one unified platform built for reliability and speed.'],

            // CONTACT
            ['contact', 'header_title',   'Page header title',       'text',     'Contact Us'],
            ['contact', 'header_subtext', 'Page header subtext',     'textarea', 'Connect with our private client desk or corporate treasury specialists. Our global support team is available 24/7 to assist you.'],
            ['contact', 'location_label', 'Location card label',     'text',     'Global Headquarters'],
            ['contact', 'location_value', 'Location address',        'textarea', '301 East Water Street, Charlottesville, VA 22904, United States'],
            ['contact', 'email_label',    'Email card label',        'text',     'Client Advisory Desk'],
            ['contact', 'email_value',    'Email address',           'text',     'info@mortilholders.online'],
            ['contact', 'phone_label',    'Phone card label',        'text',     'Direct Private Line'],
            ['contact', 'phone_value',    'Phone number',            'text',     '+1 (800) 555-0199'],

            // BUSINESS
            ['business', 'intro_heading',   'Intro section heading',  'text',     'Enterprise Treasury & Commercial Banking Built for Scale'],
            ['business', 'overview_heading','Overview block heading', 'text',     'Institutional Financial Infrastructure for Modern Enterprises'],
            ['business', 'overview_body',   'Overview block body',    'textarea', 'From high-growth ventures to established multinational groups, Mortil Holders provides the multi-currency accounts, automated payables, trade finance, and treasury controls required to operate globally with confidence.'],
            ['business', 'app_heading',     'App section heading',    'text',     'Command Your Corporate Treasury From Anywhere'],
            ['business', 'app_body',        'App section body',       'textarea', 'Approve batch payroll runs, issue virtual corporate cards with real-time spend caps, and hedge foreign currency exposure directly from our mobile and web suite.'],
            ['business', 'app_stat',        'App downloads stat',     'text',     'Trusted by 550K+ corporate and commercial entities worldwide'],

            // PERSONAL
            ['personal', 'intro_heading',   'Intro section heading',  'text',     'Private & Personal Banking Tailored Around Your Life'],
            ['personal', 'overview_heading','Overview block heading', 'text',     'Effortless Everyday Banking Meets Private Wealth Stewardship'],
            ['personal', 'overview_body',   'Overview block body',    'textarea', 'Whether you are managing daily household finances, saving for milestone acquisitions, or sending funds to family abroad, Mortil Holders gives you instant liquidity, fee-free global spending, and bank-grade protection.'],
            ['personal', 'app_heading',     'App section heading',    'text',     'Total Clarity Over Your Personal Wealth, 24/7'],
            ['personal', 'app_body',        'App section body',       'textarea', 'Track real-time balances, automate high-yield savings vaults, split expenses, and send instant domestic or cross-border transfers from one refined app.'],
            ['personal', 'app_stat',        'App downloads stat',     'text',     'Over 9.2 million personal banking clients worldwide'],

            // LOANS
            ['loans', 'intro_heading', 'Intro section heading', 'text',     'Bespoke Credit Facilities & Flexible Lending Solutions'],
            ['loans', 'apply_heading', 'Apply block heading',   'text',     'Structured Financing With Rapid Decisions'],
            ['loans', 'apply_body',    'Apply block body',      'textarea', 'Access competitive fixed and variable credit facilities for residential property, automotive acquisitions, commercial expansion, and personal liquidity—with transparent amortization and zero prepayment penalties.'],
            ['loans', 'app_heading',   'App section heading',   'text',     'Fast, Transparent Capital for Your Next Milestone'],
            ['loans', 'app_body',      'App section body',      'textarea', 'Submit your credit application in minutes, review clear repayment schedules upfront, and receive direct disbursement into your Mortil Holders account upon approval.'],
            ['loans', 'app_stat',      'App stat line',         'text',     'Over 750K+ personal and commercial credit facilities funded'],

            // CARDS
            ['cards', 'intro_heading', 'Intro section heading', 'text',     'Precision-Engineered Credit & Multi-Currency Debit Cards'],
            ['cards', 'apply_heading', 'Apply block heading',   'text',     'Request Your Mortil Holders Card'],
            ['cards', 'apply_body',    'Apply block body',      'textarea', 'Accepted at over 80 million merchants worldwide across Visa, Mastercard, American Express, and Discover networks—featuring instant virtual issuance, zero foreign transaction fees, and elevated cashback rewards.'],
            ['cards', 'app_heading',   'App section heading',   'text',     'Granular Card Governance at Your Fingertips'],
            ['cards', 'app_body',      'App section body',      'textarea', 'Generate single-use virtual cards, set real-time merchant and geographic spend limits, view instant transaction telemetry, and freeze or unfreeze cards with a single tap.'],
            ['cards', 'app_stat',      'App stat line',         'text',     'Over 2.4 million active Mortil Holders cardholders globally'],
        ];

        foreach ($rows as [$page, $key, $label, $type, $value]) {
            PageContent::updateOrCreate(
                ['page' => $page, 'section_key' => $key],
                ['label' => $label, 'type' => $type, 'value' => $value]
            );
        }
    }
}
