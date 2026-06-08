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
        return array_merge(
            $this->home(),
            $this->about(),
            $this->contact(),
            $this->business(),
            $this->personal(),
            $this->loans(),
            $this->cards()
        );
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
            ['page'=>$p,'key'=>'cta_button','label'=>'CTA button label','group'=>'Call To Action','type'=>'text','value'=>'Get Started'],        ];
    }

    private function about(): array
    {
        $p = 'about';
        return [
            ['page'=>$p,'key'=>'header_title','label'=>'Header title','group'=>'Header','type'=>'text','value'=>'About Mortil Holders'],
            ['page'=>$p,'key'=>'header_subtext','label'=>'Header subtext','group'=>'Header','type'=>'textarea','value'=>"We're on a mission to make world-class banking simple, transparent and accessible to everyone."],            ['page'=>$p,'key'=>'who_heading','label'=>'Who-we-are heading','group'=>'Who We Are','type'=>'text','value'=>'Used by 100K+ Businesses of Every Shape & Size'],
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
            ['page'=>$p,'key'=>'header_subtext','label'=>'Header subtext','group'=>'Header','type'=>'textarea','value'=>"We'd love to hear from you. Reach out and our team will get back to you as soon as possible."],            ['page'=>$p,'key'=>'location_label','label'=>'Location label','group'=>'Details','type'=>'text','value'=>'Our Location'],
            ['page'=>$p,'key'=>'location_value','label'=>'Location value','group'=>'Details','type'=>'text','value'=>'London, United Kingdom'],
            ['page'=>$p,'key'=>'email_label','label'=>'Email label','group'=>'Details','type'=>'text','value'=>'Email Us'],
            ['page'=>$p,'key'=>'email_value','label'=>'Email value','group'=>'Details','type'=>'text','value'=>'info@mortilholders.online'],
            ['page'=>$p,'key'=>'phone_label','label'=>'Phone label','group'=>'Details','type'=>'text','value'=>'Call Us'],
            ['page'=>$p,'key'=>'phone_value','label'=>'Phone value','group'=>'Details','type'=>'text','value'=>'+44 20 0000 0000'],
        ];
    }

    private function business(): array
    {
        $p = 'business';
        return [
            ['page'=>$p,'key'=>'intro_heading','label'=>'Intro heading','group'=>'Header','type'=>'text','value'=>'Smarter Banking for Every Business'],
            ['page'=>$p,'key'=>'intro_subtext','label'=>'Intro subtext','group'=>'Header','type'=>'textarea','value'=>'Unlock dedicated business accounts, competitive credit lines, and real-time cash-flow tools designed to help your company move faster and spend smarter.'],
            ['page'=>$p,'key'=>'overview_heading','label'=>'Overview heading','group'=>'Overview','type'=>'text','value'=>'Built for the Way Businesses Actually Work'],
            ['page'=>$p,'key'=>'overview_body','label'=>'Overview body','group'=>'Overview','type'=>'textarea','value'=>'From sole traders to scaling enterprises, Mortil Holders delivers a complete suite of banking services — current accounts, multi-currency wallets, instant transfers, and dedicated relationship managers — all in one secure platform.'],
            ['page'=>$p,'key'=>'app_heading','label'=>'App section heading','group'=>'App','type'=>'text','value'=>'Manage Your Business Finances on the Move'],
            ['page'=>$p,'key'=>'app_body','label'=>'App section body','group'=>'App','type'=>'textarea','value'=>'Our award-winning mobile and web platform keeps you in full control of payroll, supplier payments, and real-time reporting — whether you are in the boardroom or on the road.'],
            ['page'=>$p,'key'=>'app_stat','label'=>'App download stat','group'=>'App','type'=>'text','value'=>'Trusted by 500K+ businesses worldwide'],
        ];
    }

    private function personal(): array
    {
        $p = 'personal';
        return [
            ['page'=>$p,'key'=>'intro_heading','label'=>'Intro heading','group'=>'Header','type'=>'text','value'=>'Banking That Puts You First'],
            ['page'=>$p,'key'=>'intro_subtext','label'=>'Intro subtext','group'=>'Header','type'=>'textarea','value'=>'From everyday spending accounts to high-interest savings, Mortil Holders gives you flexible, transparent personal banking products that fit your life — not the other way around.'],
            ['page'=>$p,'key'=>'overview_heading','label'=>'Overview heading','group'=>'Overview','type'=>'text','value'=>'Everything You Need for Day-to-Day Banking'],
            ['page'=>$p,'key'=>'overview_body','label'=>'Overview body','group'=>'Overview','type'=>'textarea','value'=>'Open a personal current account in minutes, link a savings pot, and access fee-free foreign currency transactions. Mortil Holders makes it easy to stay on top of your finances with real-time notifications, spending insights, and instant card controls.'],
            ['page'=>$p,'key'=>'app_heading','label'=>'App section heading','group'=>'App','type'=>'text','value'=>'Your Finances, Wherever You Are'],
            ['page'=>$p,'key'=>'app_body','label'=>'App section body','group'=>'App','type'=>'textarea','value'=>'Bank on the go with our fully featured mobile app. Check balances, set savings goals, freeze your card, and send money instantly — all from the palm of your hand.'],
            ['page'=>$p,'key'=>'app_stat','label'=>'App download stat','group'=>'App','type'=>'text','value'=>'Over 9.2 million downloads worldwide'],
        ];
    }

    private function loans(): array
    {
        $p = 'loans';
        return [
            ['page'=>$p,'key'=>'intro_heading','label'=>'Intro heading','group'=>'Header','type'=>'text','value'=>'Flexible Loans for Every Stage of Life'],
            ['page'=>$p,'key'=>'intro_subtext','label'=>'Intro subtext','group'=>'Header','type'=>'textarea','value'=>'Whether you need funding for a new vehicle, a home purchase, a growing business, or unexpected medical costs, Mortil Holders offers straightforward loans with clear terms and competitive rates.'],
            ['page'=>$p,'key'=>'apply_heading','label'=>'Apply section heading','group'=>'Apply','type'=>'text','value'=>'Apply for a Loan Today'],
            ['page'=>$p,'key'=>'apply_body','label'=>'Apply section body','group'=>'Apply','type'=>'textarea','value'=>'Getting started is simple. Check your eligibility in seconds with no impact on your credit score, then choose the loan amount and repayment schedule that works for you. Funds are delivered quickly once approved.'],
            ['page'=>$p,'key'=>'app_heading','label'=>'App section heading','group'=>'App','type'=>'text','value'=>'Fast Financing for Your Next Chapter'],
            ['page'=>$p,'key'=>'app_body','label'=>'App section body','group'=>'App','type'=>'textarea','value'=>'Looking for vehicle financing, a home improvement loan, or working capital for your business? Find out if you qualify in minutes and lock in your terms before visiting any dealership or supplier.'],
            ['page'=>$p,'key'=>'app_stat','label'=>'Approved loans stat','group'=>'App','type'=>'text','value'=>'Over 700K+ loans approved'],
        ];
    }

    private function cards(): array
    {
        $p = 'cards';
        return [
            ['page'=>$p,'key'=>'intro_heading','label'=>'Intro heading','group'=>'Header','type'=>'text','value'=>'Cards Designed Around How You Spend'],
            ['page'=>$p,'key'=>'intro_subtext','label'=>'Intro subtext','group'=>'Header','type'=>'textarea','value'=>'Discover a range of Visa, Mastercard, Amex, and Discover credit cards with cashback rewards, zero foreign transaction fees, and instant digital issuance — all managed from a single dashboard.'],
            ['page'=>$p,'key'=>'apply_heading','label'=>'Apply section heading','group'=>'Apply','type'=>'text','value'=>'Apply for a Credit Card'],
            ['page'=>$p,'key'=>'apply_body','label'=>'Apply section body','group'=>'Apply','type'=>'textarea','value'=>'Check if you are pre-approved without affecting your credit score. Select the card tier that matches your lifestyle and get your virtual card number instantly upon approval — no waiting for the post.'],
            ['page'=>$p,'key'=>'app_heading','label'=>'App section heading','group'=>'App','type'=>'text','value'=>'Full Card Control at Your Fingertips'],
            ['page'=>$p,'key'=>'app_body','label'=>'App section body','group'=>'App','type'=>'textarea','value'=>'Misplaced your card? Lock it instantly from the app. Found it? Unlock with a single tap. Set spending limits, view real-time transactions, and manage multiple cards all from one secure place.'],
            ['page'=>$p,'key'=>'app_stat','label'=>'Card users stat','group'=>'App','type'=>'text','value'=>'Over 2 million credit card users'],
        ];
    }
}
