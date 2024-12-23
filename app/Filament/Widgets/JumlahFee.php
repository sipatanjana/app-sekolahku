<?php

namespace App\Filament\Widgets;

use App\Models\Courses;
use App\Models\UserCourses;
use Filament\Widgets\ChartWidget;

class JumlahFee extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $model_course = Courses::distinct('mentor')->get();
        foreach ($model_course as $key => $value) {
            $count = UserCourses::join('courses', 'courses.id', '=', 'user_courses.id_course')->where('courses.mentor', $value->mentor)->count();
            if ($count > 0) {
                $label[$key] = $value->mentor;
                $data[$key] = $count * 2000000;
            }
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Grafik Total Fee',
                    'data' => $data,
                ],
            ],
            'labels' => $label,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
