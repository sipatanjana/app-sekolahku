<?php

namespace App\Filament\Widgets;

use App\Models\Courses;
use App\Models\UserCourses;
use Filament\Widgets\ChartWidget;

class JumlahPeserta extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $model_course = Courses::distinct('course')->get();
        foreach ($model_course as $key => $value) {
            $count = UserCourses::join('courses', 'courses.id', '=', 'user_courses.id_course')->where('courses.course', $value->course)->count();
            if ($count > 0) {
                $label[$key] = $value->course;
                $data[$key] = $count;
            }
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Grafik Total Peserta',
                    'data' => $data,
                ],
            ],
            'labels' => $label,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
