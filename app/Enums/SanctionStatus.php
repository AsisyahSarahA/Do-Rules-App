<?php
namespace App\Enums;

enum SanctionStatus: string
{
    case PENDING = 'pending';
    case PROGRESS = 'progress';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Tertunda',
            self::PROGRESS => 'Proses',
            self::COMPLETED => 'Selesai',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PENDING => 'bg-gray-100 text-gray-700 border-gray-300',
            self::PROGRESS => 'bg-blue-50 text-blue-700 border-blue-200',
            self::COMPLETED => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        };
    }
}
