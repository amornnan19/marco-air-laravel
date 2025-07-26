<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Mitsubishi Heavy Duty',
                'model' => 'DXK15YW-W1',
                'brand' => 'Mitsubishi',
                'btu' => '15,480 BTU',
                'price' => 11990,
                'description' => 'แอร์ Mitsubishi Heavy Duty ติดตั้ง ระบบ Inverter รุ่น DXK15YW-W1 [TP/220V] (Haru - Standard Inverter) (ขอดูคู่มือ: 24 ไฟ) บนเฟอร์15,480บีทียู เมอร์5 (R32) รุ่น2019-2024',
                'features' => [
                    'Real Inverter อินเวอร์เตอร์แท้จากประเทศญี่ปุ่น',
                    'Fan Speed (ระดับความเร็วพัดลม): 5 ระดับ',
                    'Jet Flow เทคโนโลยีการกระจายลมอากาศ',
                    'Hi Power สามารถทำงานต่อเนื่องในพลังสูง 15 นาที',
                    '24 ชม. ION สามารถสร้างประจุลบ 24 ชั่วโมง',
                    'Silicone Coating ป้องกันความชื้น',
                    'Epoxy Coating ป้องกันสารกรดจากอากาศ',
                    'Self Cleaning Operation ฟังก์ชันทำความสะอาดอัตโนมัติ'
                ],
                'specifications' => [
                    'ขนาดความเย็น' => '15,480 BTU/hr',
                    'ระบบ' => 'Inverter',
                    'สารทำความเย็น' => 'R32',
                    'แรงดันไฟฟ้า' => '220V',
                    'ระดับพัดลม' => '5 ระดับ',
                    'รับประกัน' => '5 ปี'
                ],
                'category' => 'แอร์บ้าน',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Tanin',
                'model' => 'T T 4455',
                'brand' => 'Tanin',
                'btu' => '12,000 BTU',
                'price' => 11990,
                'description' => 'แอร์ Tanin รุ่น T T 4455 ขนาด 12,000 BTU ระบบ Inverter ประหยัดไฟ',
                'features' => [
                    'ระบบ Inverter ประหยัดไฟ',
                    'ระบบกรองอากาศ',
                    'รีโมทคอนโทรล',
                    'ระบบฟอกอากาศ'
                ],
                'specifications' => [
                    'ขนาดความเย็น' => '12,000 BTU/hr',
                    'ระบบ' => 'Inverter',
                    'แรงดันไฟฟ้า' => '220V',
                    'รับประกัน' => '3 ปี'
                ],
                'category' => 'แอร์บ้าน',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Daikin Inverter',
                'model' => 'FTKC25UV2S',
                'brand' => 'Daikin',
                'btu' => '9,000 BTU',
                'price' => 13500,
                'description' => 'แอร์ Daikin Inverter ประหยัดไฟ เงียบ คุณภาพญี่ปุ่น',
                'features' => [
                    'เทคโนโลยี Inverter แท้',
                    'ระบบกรองอากาศ PM2.5',
                    'เงียบพิเศษ',
                    'ประหยัดไฟเบอร์ 5'
                ],
                'specifications' => [
                    'ขนาดความเย็น' => '9,000 BTU/hr',
                    'ระบบ' => 'Inverter',
                    'แรงดันไฟฟ้า' => '220V',
                    'ระดับเสียง' => '19 dB',
                    'รับประกัน' => '5 ปี'
                ],
                'category' => 'แอร์บ้าน',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'LG Dual Cool',
                'model' => 'PC12SQ',
                'brand' => 'LG',
                'btu' => '12,000 BTU',
                'price' => 12900,
                'description' => 'แอร์ LG Dual Cool ระบบ Dual Inverter เย็นเร็ว ประหยัดไฟ',
                'features' => [
                    'Dual Inverter Compressor',
                    'เย็นเร็วกว่า 40%',
                    'ประหยัดไฟมากกว่า 70%',
                    'ระบบกรองอากาศ 6 ขั้นตอน'
                ],
                'specifications' => [
                    'ขนาดความเย็น' => '12,000 BTU/hr',
                    'ระบบ' => 'Dual Inverter',
                    'แรงดันไฟฟ้า' => '220V',
                    'รับประกัน' => '10 ปี (คอมเพรสเซอร์)'
                ],
                'category' => 'แอร์บ้าน',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Samsung WindFree',
                'model' => 'AR12NVFXAWKNST',
                'brand' => 'Samsung',
                'btu' => '12,000 BTU',
                'price' => 14900,
                'description' => 'แอร์ Samsung WindFree เทคโนโลยีลมไร้การรู้สึก เย็นสบาย',
                'features' => [
                    'เทคโนโลยี WindFree',
                    'Digital Inverter 8-Pole',
                    'ระบบกรอง HD Filter',
                    'Wi-Fi Smart Control'
                ],
                'specifications' => [
                    'ขนาดความเย็น' => '12,000 BTU/hr',
                    'ระบบ' => 'Digital Inverter',
                    'แรงดันไฟฟ้า' => '220V',
                    'การเชื่อมต่อ' => 'Wi-Fi',
                    'รับประกัน' => '10 ปี'
                ],
                'category' => 'แอร์บ้าน',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Panasonic Inverter',
                'model' => 'CU/CS-PU12VKT',
                'brand' => 'Panasonic',
                'btu' => '12,000 BTU',
                'price' => 13200,
                'description' => 'แอร์ Panasonic Inverter ระบบ nanoe-G ฆ่าเชื้อโรค PM2.5',
                'features' => [
                    'เทคโนโลยี nanoe-G',
                    'ECONAVI Sensor',
                    'ระบบกรอง PM2.5',
                    'iAUTO-X ปรับอุณหภูมิอัตโนมัติ'
                ],
                'specifications' => [
                    'ขนาดความเย็น' => '12,000 BTU/hr',
                    'ระบบ' => 'Inverter',
                    'แรงดันไฟฟ้า' => '220V',
                    'เทคโนโลยี' => 'nanoe-G',
                    'รับประกัน' => '5 ปี'
                ],
                'category' => 'แอร์บ้าน',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'name' => 'Central Air G-Con',
                'model' => 'CFW-GCN12',
                'brand' => 'Central Air',
                'btu' => '12,000 BTU',
                'price' => 9990,
                'description' => 'แอร์ Central Air G-Con ราคาประหยัด คุณภาพดี',
                'features' => [
                    'ระบบ Inverter',
                    'รีโมทคอนโทรล',
                    'ระบบกรองอากาศ',
                    'การรับประกัน 3 ปี'
                ],
                'specifications' => [
                    'ขนาดความเย็น' => '12,000 BTU/hr',
                    'ระบบ' => 'Inverter',
                    'แรงดันไฟฟ้า' => '220V',
                    'รับประกัน' => '3 ปี'
                ],
                'category' => 'แอร์บ้าน',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 7,
            ],
            [
                'name' => 'Carrier X-Series',
                'model' => '42TVAB012',
                'brand' => 'Carrier',
                'btu' => '12,000 BTU',
                'price' => 15900,
                'description' => 'แอร์ Carrier X-Series เทคโนโลยีอเมริกัน ทนทาน',
                'features' => [
                    'X-Series Technology',
                    'Tropical Inverter',
                    'ระบบกรองอากาศขั้นสูง',
                    'ทนทานในสภาพอากาศร้อน'
                ],
                'specifications' => [
                    'ขนาดความเย็น' => '12,000 BTU/hr',
                    'ระบบ' => 'Tropical Inverter',
                    'แรงดันไฟฟ้า' => '220V',
                    'การทำงาน' => 'สำหรับอากาศร้อน',
                    'รับประกัน' => '5 ปี'
                ],
                'category' => 'แอร์บ้าน',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 8,
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
