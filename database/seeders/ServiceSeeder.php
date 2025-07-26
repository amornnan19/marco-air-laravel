<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'บริการล้างแอร์',
                'slug' => 'air-cleaning',
                'description' => 'บริการล้างแอร์มาตรฐาน ด้วยทีมช่างมืออาชีพ',
                'hero_image' => null,
                'icon_color' => 'blue',
                'packages' => [
                    [
                        'name' => 'ล้างแอร์ติดผนัง ขนาด 1 เครื่อง',
                        'description' => 'ราคาเพียง 650 บาทต่อเครื่อง',
                        'price' => 650,
                        'unit' => 'เครื่อง',
                    ],
                    [
                        'name' => 'ล้างแอร์ติดผนัง ขนาด 2 เครื่อง',
                        'description' => 'ราคาเพียง 550 บาทต่อเครื่อง',
                        'price' => 550,
                        'unit' => 'เครื่อง',
                    ],
                    [
                        'name' => 'ล้างแอร์ติดผนัง ขนาด 3 เครื่อง',
                        'description' => 'ราคาเพียง 500 บาทต่อเครื่อง',
                        'price' => 500,
                        'unit' => 'เครื่อง',
                    ],
                    [
                        'name' => 'ล้างแอร์ติดผนัง ขนาด 4 เครื่อง',
                        'description' => 'ราคาเพียง 450 บาทต่อเครื่อง',
                        'price' => 450,
                        'unit' => 'เครื่อง',
                    ],
                ],
                'details' => [
                    'ทุก BTU ขึ้นมาราคาเพียง ไม่มีขั้นต่ำเพิ่ม',
                    'ใส่โซ่แอลกอลลาสารละลายดำดส่องชิ้น',
                    'ระยะเวลาบริการ: ไม่เกิน 2 ชม. ต่อเครื่อง',
                    'พื้นที่ให้บริการ: ทั่วประเทศ',
                    'อันประจะ: 30 วัน อากาศสั่อนนิรันความเสียหายจากการล้าง',
                ],
                'contact_phone' => '02-888-8888',
                'price_display' => 650,
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'name' => 'บริการซ่อมแอร์',
                'slug' => 'air-repair',
                'description' => 'บริการซ่อมแอร์ทุกยี่ห้อ ด้วยช่างผู้เชี่ยวชาญ',
                'hero_image' => null,
                'icon_color' => 'green',
                'packages' => [
                    [
                        'name' => 'ตรวจเช็คระบบแอร์',
                        'description' => 'ตรวจสอบระบบและวินิจฉัยปัญหา',
                        'price' => 300,
                        'unit' => 'ครั้ง',
                    ],
                    [
                        'name' => 'ซ่อมแซมทั่วไป',
                        'description' => 'ซ่อมปัญหาระบบไฟฟ้า อิเล็กทรอนิกส์',
                        'price' => 800,
                        'unit' => 'ครั้ง',
                    ],
                    [
                        'name' => 'เปลี่ยนอะไหล่',
                        'description' => 'ราคาตามอะไหล่ที่ใช้จริง + ค่าแรง',
                        'price' => 500,
                        'unit' => 'ขั้นต่ำ',
                    ],
                ],
                'details' => [
                    'รับประกันงานซ่อม 90 วัน',
                    'ใช้อะไหล่แท้ 100%',
                    'ช่างมืออาชีพ มีใบรับรอง',
                    'บริการ 24 ชั่วโมง (กรณีฉุกเฉิน)',
                    'ประเมินราคาฟรี',
                ],
                'contact_phone' => '02-888-8888',
                'price_display' => 300,
                'is_active' => true,
                'sort_order' => 20,
            ],
            [
                'name' => 'บริการติดตั้งแอร์ย้ายแอร์',
                'slug' => 'air-installation',
                'description' => 'บริการติดตั้งและย้ายแอร์ทุกยี่ห้อ ทุกขนาด',
                'hero_image' => null,
                'icon_color' => 'orange',
                'packages' => [
                    [
                        'name' => 'ติดตั้งแอร์ใหม่',
                        'description' => 'ติดตั้งแอร์ใหม่พร้อมอุปกรณ์มาตรฐาน',
                        'price' => 1500,
                        'unit' => 'เครื่อง',
                    ],
                    [
                        'name' => 'ย้ายแอร์ (ในบ้านเดียวกัน)',
                        'description' => 'ย้ายตำแหน่งแอร์ภายในบ้านเดียวกัน',
                        'price' => 1200,
                        'unit' => 'เครื่อง',
                    ],
                    [
                        'name' => 'ย้ายแอร์ (ต่างที่)',
                        'description' => 'ย้ายแอร์ไปยังที่ใหม่',
                        'price' => 2000,
                        'unit' => 'เครื่อง',
                    ],
                ],
                'details' => [
                    'รับประกันงานติดตั้ง 1 ปี',
                    'ใช้อุปกรณ์ติดตั้งคุณภาพสูง',
                    'ช่างผู้เชี่ยวชาญ มีประสบการณ์',
                    'ตรวจสอบการทำงานก่อนส่งมอบ',
                    'รวมวัสดุพื้นฐานในราคา',
                ],
                'contact_phone' => '02-888-8888',
                'price_display' => 1500,
                'is_active' => true,
                'sort_order' => 30,
            ],
        ];

        foreach ($services as $serviceData) {
            \App\Models\Service::create($serviceData);
        }
    }
}
