<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promotion;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = [
            [
                'title' => 'โปรโมชั่นพิเศษ!',
                'content' => 'โปรโมชั่นพิเศษ! ซื่อมแอร์ HITACHI รุ่นใหม่ระบายความร้อนลดลงสูงสุด 35%* และรักษาค่าย่อน 0%* นาน 10เดือน พิเศษมากว่านั้น ลูกค้าภัยร่อนการรักษาอีก 5% \n\nรับเลย 3 พ.ค. – 4 ก.ค. 2567 ที่ M.A.R.C.o ทุกสาขาก็โลก',
                'image_path' => null,
                'link_url' => '#',
                'button_text' => 'ดูสินค้า',
                'is_active' => true,
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->addDays(30),
                'sort_order' => 1,
                'background_color' => 'from-orange-400 to-orange-500'
            ],
            [
                'title' => 'แอร์ไส่เซร์วิส',
                'content' => 'บริการหน้านิยม\n\nบ่านและมีดิการรับประกันผลงาน พร้อมทีมช่างมืออาชีพ บริการซ่อมแซม ติดตั้ง และบำรุงรักษาแอร์ทุกยี่ห้อ\n\nรับบริการตลอด 24 ชั่วโมง',
                'image_path' => null,
                'link_url' => '#',
                'button_text' => 'สั่งเลย',
                'is_active' => true,
                'start_date' => Carbon::now()->subDays(3),
                'end_date' => Carbon::now()->addDays(60),
                'sort_order' => 2,
                'background_color' => 'from-red-400 to-red-500'
            ],
            [
                'title' => 'ล้างแอร์ประหยัด 50%',
                'content' => 'โปรโมชั่นล้างแอร์ ราคาพิเศษ ลดสูงสุด 50% สำหรับลูกค้าใหม่\n\nบริการโดยช่างมืออาชีพ พร้อมรับประกันผลงาน\n\nจองเลยวันนี้!',
                'image_path' => null,
                'link_url' => '#',
                'button_text' => 'จองคิว',
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(45),
                'sort_order' => 3,
                'background_color' => 'from-blue-400 to-blue-500'
            ]
        ];

        foreach ($promotions as $promotion) {
            Promotion::create($promotion);
        }
    }
}
