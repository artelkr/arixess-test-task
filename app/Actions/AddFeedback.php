<?php

namespace App\Actions;

use App\Exceptions\FeedbackSaveException;
use App\Models\Feedback;
use App\Models\User;
use App\Notifications\FeedbackArrivedNotification;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

final class AddFeedback
{
    /**
     * NOTE: обычно лучше использовать DTO, так как они позволяют явно указать и проверить типы
     * [свойства объекта], но не хочеться их тут вводить. Поэтому полагаемся на Psalm, который
     * заставит всё проверить и используем массивы для передачи и описания данных.
     *
     * @param array{ subject:string, message:string, file: \Illuminate\Http\UploadedFile|null } $data
     *
     * @throws FeedbackSaveException
     */
    public function exec(array $data)
    {
        /* По-хорошему тут тоже нужно основательно проверить валидность данных, тем-более, если
         * используется массив. */

        /** @var \App\Models\User */
        $user = Auth::guard('web')->user();

        $file = $this->saveFile($data['file']);

        try {
            $feedback = $user->feedback()->create([
                'subject' => $data['subject'],
                'message' => $data['message'],
                'file_path' => $file,
            ]);

            $feedback->saveOrFail();
            $feedback = $feedback->refresh();

            $this->notify($feedback);

            return $feedback;
        } catch (Exception $e) {
            /* Удалить файл, если что-то пошло не так при сохранении заявки. */
            if ($file !== null) Storage::delete($file);

            throw new FeedbackSaveException('Feedback cannot be added!');
        }
    }

    private function saveFile(?UploadedFile $file): ?string
    {
        if ($file === null) return null;

        $status = $file->store('uploads', ['disk' => 'public']);

        if ($status === false) {
            throw new FeedbackSaveException('File cannot be saved!');
        }

        return $status;
    }

    private function notify(Feedback $feedback): void
    {
        $managers = User::managers()->get();

        Notification::send($managers, new FeedbackArrivedNotification($feedback));
    }
}
