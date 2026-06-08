<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageContentSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        $order = 0;

        foreach ($this->sections() as $row) {
            DB::table('page_contents')->updateOrInsert(
                ['page' => $row['page'], 'section_key' => $row['key']],
                [
                    'label' => $row['label'],
                    'section_group' => $row['group'],
                    'type' => $row['type'],
                    'value' => $row['value'],
                    'sort_order' => $order++,
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }
    }

    private function sections(): array
    {
        return array_merge($this->home(), $this->about(), $this->contact());
    }

    private function home(): array
    {
        $p = 'home';
        return [
            ['page'=>$p,'key'=>'hero_eyebrow','label'=>'Hero eyebrow','group'=>'Hero','type'=>'text','value'=>'BANKING WITHOUT BORDERS'],
            ['page'=>$p,'key'=>'hero_heading','label'=>'Hero heading','group'=>'Hero','type'=>'text','value'=>'Move Money Across the World in Real Time'],
            ['page'=>$p,'key'=>'hero_subtext','label'=>'Hero subtext','group'=>'Hero','type'=>'textarea','value'=>'Mortil Holders brings modern, secure digital banking to everyone. Open an account in minutes, hold multiple currencies, and send money worldwide with transparent, low fees — all from one app.'],
            ['page'=>$p,'key'=>'hero_button','label'=>'Hero button label','group'=>'Hero','type'=>'text','value'=>'Open Online Banking'],
            ['page'=>$p,'key'=>'why_heading','label'=>'Why-us heading','group'=>'Why Us','type'=>'text','value'=>'We Reimagined Digital Banking'],
            ['page'=>$p,'key'=>'why_subtext','label'=>'Why-us text','group'=>'Why Us','type'=>'textarea','value'=>"For over a decade we've combined data, technology and thoughtful design to make banking simpler and more human. Today, millions trust Mortil Holders to manage, move and grow their money."],
            ['page'=>$p,'key'=>'feature_app_title','label'=>'Feature: app title','group'=>'Features','type'=>'text','value'=>'A Powerful Mobile & Online Experience'],
            ['page'=>$p,'key'=>'feature_app_body','label'=>'Feature: app body','group'=>'Features','type'=>'textarea','value'=>'Check balances, move funds, freeze cards and track every transaction in real time. Our mobile and web apps put complete control of your money in your hands, wherever you are.'],
            ['page'=>$p,'key'=>'feature_cards_title','label'=>'Feature: cards title','group'=>'Features','type'=>'text','value'=>'Set Up & Spend From Your Cards in a Minute'],
            ['page'=>$p,'key'=>'feature_cards_body','label'=>'Feature: cards body','group'=>'Features','type'=>'textarea','value'=>'Create virtual and physical cards instantly, set your own limits, and spend in the currency you choose — with total transparency and total speed.'],
            ['page'=>$p,'key'=>'feature_secure_title','label'=>'Feature: security title','group'=>'Features','type'=>'text','value'=>'Innovative, Secure and Truly Digital'],
            ['page'=>$p,'key'=>'feature_secure_body','label'=>'Feature: security body','group'=>'Features','type'=>'textarea','value'=>'Bank-grade encryption, two-factor authentication and round-the-clock monitoring keep your money and data safe, so you can focus on living rather than worrying.'],
            ['page'=>$p,'key'=>'tool_rates_title','label'=>'Tool: rates title','group'=>'Tools','type'=>'text','value'=>'Historical Currency Rates'],
            ['page'=>$p,'key'=>'tool_rates_body','label'=>'Tool: rates body','group'=>'Tools','type'=>'textarea','value'=>'Track how rates have moved over time and time your exchanges with confidence.'],
            ['page'=>$p,'key'=>'tool_travel_title','label'=>'Tool: travel title','group'=>'Tools','type'=>'text','value'=>'Travel Expense Calculator'],
            ['page'=>$p,'key'=>'tool_travel_body','label'=>'Tool: travel body','group'=>'Tools','type'=>'textarea','value'=>'Plan trips abroad with clear, upfront estimates of what your money is worth.'],
            ['page'=>$p,'key'=>'tool_alerts_title','label'=>'Tool: alerts title','group'=>'Tools','type'=>'text','value'=>'Currency Email Updates'],
            ['page'=>$p,'key'=>'tool_alerts_body','label'=>'Tool: alerts body','group'=>'Tools','type'=>'textarea','value'=>'Get the rates you care about delivered straight to your inbox.'],
            ['page'=>$p,'key'=>'platform_heading','label'=>'Platform heading','group'=>'Platform','type'=>'text','value'=>'Your One-Stop Digital Banking Platform'],
            ['page'=>$p,'key'=>'platform_body','label'=>'Platform body','group'=>'Platform','type'=>'textarea','value'=>'Exchange money across the world in real time with some of the lowest fees available, and hold and manage multiple currencies from a single, secure account.'],
            ['page'=>$p,'key'=>'stats_heading','label'=>'Stats heading','group'=>'Stats','type'=>'text','value'=>'Trusted by Millions Around the World'],
            ['page'=>$p,'key'=>'stats_value','label'=>'Stats figure','group'=>'Stats','type'=>'text','value'=>'18.5M+'],
            ['page'=>$p,'key'=>'stats_label','label'=>'Stats label','group'=>'Stats','type'=>'text','value'=>'Happy customers and growing'],
            ['page'=>$p,'key'=>'cta_heading','label'=>'CTA heading','group'=>'Call To Action','type'=>'text','value'=>'Ready to Bank Smarter?'],
            ['page'=>$p,'key'=>'cta_body','label'=>'CTA body','group'=>'Call To Action','type'=>'textarea','value'=>'Join Mortil Holders today and experience banking built for the way you live.'],
            ['page'=>$p,'key'=>'cta_button','label'=>'CTA button label','group'=>'Call To Action','type'=>'text','value'=>'Get Started'],
        ];
    }

    private function about(): array
    {
        $p = 'about';
        return [
            ['page'=>$p,'key'=>'header_title','label'=>'Header title','group'=>'Header','type'=>'text','value'=>'About Mortil Holders'],
            ['page'=>$p,'key'=>'header_subtext','label'=>'Header subtext','group'=>'Header','type'=>'textarea','value'=>"We're on a mission to make world-class banking simple, transparent and accessible to everyone."],
            ['page'=>$p,'key'=>'who_heading','label'=>'Who-we-are heading','group'=>'Who We Are','type'=>'text','value'=>'Used by 100K+ Businesses of Every Shape & Size'],
            ['page'=>$p,'key'=>'who_body','label'=>'Who-we-are body','group'=>'Who We Are','type'=>'textarea','value'=>'From freelancers to fast-growing companies, organisations rely on Mortil Holders to hold multiple currencies, pay teams and suppliers worldwide, and move money in real time.'],
            ['page'=>$p,'key'=>'story_heading','label'=>'Story heading','group'=>'Our Story','type'=>'text','value'=>'Digital Banking, Reinvented'],
            ['page'=>$p,'key'=>'story_body','label'=>'Story body','group'=>'Our Story','type'=>'textarea','value'=>'Mortil Holders was founded on a simple idea: banking should work for people, not the other way around. We replaced paperwork and hidden fees with a fast, secure, mobile-first platform you can trust.'],
            ['page'=>$p,'key'=>'feature_app_title','label'=>'Feature: app title','group'=>'Features','type'=>'text','value'=>'Powerful Mobile & Online App'],
            ['page'=>$p,'key'=>'feature_app_body','label'=>'Feature: app body','group'=>'Features','type'=>'textarea','value'=>'Everything you need to manage your money, on any device, around the clock.'],
            ['page'=>$p,'key'=>'feature_team_title','label'=>'Feature: teams title','group'=>'Features','type'=>'text','value'=>'Built for Multiple Users & Teams'],
            ['page'=>$p,'key'=>'feature_team_body','label'=>'Feature: teams body','group'=>'Features','type'=>'textarea','value'=>'Give your business controlled, role-based access so the right people manage the right money.'],
            ['page'=>$p,'key'=>'customers_heading','label'=>'Customers heading','group'=>'Customers','type'=>'text','value'=>'We Always Aim to Exceed Your Expectations'],
            ['page'=>$p,'key'=>'customers_body','label'=>'Customers body','group'=>'Customers','type'=>'textarea','value'=>'Our product and our people are built around your needs, with responsive support whenever you need it.'],
            ['page'=>$p,'key'=>'cta_heading','label'=>'CTA heading','group'=>'Call To Action','type'=>'text','value'=>'Have Questions? Download Our App'],
            ['page'=>$p,'key'=>'cta_body','label'=>'CTA body','group'=>'Call To Action','type'=>'textarea','value'=>'Get started with Mortil Holders in minutes and take your banking with you everywhere.'],
        ];
    }

    private function contact(): array
    {
        $p = 'contact';
        return [
            ['page'=>$p,'key'=>'header_title','label'=>'Header title','group'=>'Header','type'=>'text','value'=>'Contact Us'],
            ['page'=>$p,'key'=>'header_subtext','label'=>'Header subtext','group'=>'Header','type'=>'textarea','value'=>"We'd love to hear from you. Reach out and our team will get back to you as soon as possible."],
            ['page'=>$p,'key'=>'location_label','label'=>'Location label','group'=>'Details','type'=>'text','value'=>'Our Location'],
            ['page'=>$p,'key'=>'location_value','label'=>'Location value','group'=>'Details','type'=>'text','value'=>'London, United Kingdom'],
            ['page'=>$p,'key'=>'email_label','label'=>'Email label','group'=>'Details','type'=>'text','value'=>'Email Us'],
            ['page'=>$p,'key'=>'email_value','label'=>'Email value','group'=>'Details','type'=>'text','value'=>'info@mortilholders.online'],
            ['page'=>$p,'key'=>'phone_label','label'=>'Phone label','group'=>'Details','type'=>'text','value'=>'Call Us'],
            ['page'=>$p,'key'=>'phone_value','label'=>'Phone value','group'=>'Details','type'=>'text','value'=>'+44 20 0000 0000'],
        ];
    }
}
