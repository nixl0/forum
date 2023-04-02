<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Создать новое событие в таблице "events".
     *
     * @param array $data Данные для нового события
     * @return Event Созданное событие
     */
    public static function createEvent($data)
    {
        return self::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'location' => $data['location']
        ]);
    }

    /**
     * Обновить существующее событие в таблице "events".
     *
     * @param int $id ID события, которое нужно обновить
     * @param array $data Данные для события
     * @return Event Обновлённое событие
     * @throws ModelNotFoundException Если события с указанным ID не существует
     */
    public static function updateEvent($id, $data)
    {
        $event = self::findOrFail($id);
        $event->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'location' => $data['location']
        ]);
        return $event;
    }

    /**
     * Удалить событие в таблице "events".
     *
     * @param int $id ID события, которое нужно удалить
     * @return bool True если событие было успешно удалено, false иначе
     * @throws ModelNotFoundException Если события с указанным ID не существует
     */
    public static function deleteEvent($id)
    {
        $event = self::findOrFail($id);
        $event->delete();
        return true;
    }

    /**
     * Получить список предстоящих событий из таблицы "events".
     *
     * @return Collection Коллекция предстоящих событий
     */
    public static function getUpcomingEvents()
    {
        return self::where('start_date', '>=', now())->get();
    }
}
