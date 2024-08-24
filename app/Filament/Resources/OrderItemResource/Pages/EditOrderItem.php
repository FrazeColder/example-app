<?php

namespace App\Filament\Resources\OrderItemResource\Pages;

use App\Filament\Resources\OrderItemResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditOrderItem extends EditRecord
{
    protected static string $resource = OrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    // Override the mount method
    public function mount($record): void
    {
        parent::mount($record);

        // Mark notifications as read when editing a record
        //$this->markNotificationsAsRead();
    }

    protected function markNotificationsAsRead(): void
    {
        $user = Auth::user();

        if($user->isAdmin()) {
            // TODO: Mark notifications as read when editing a record
        }
    }

    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    {
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
