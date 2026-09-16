<?php

namespace App\Filament\Admin\Resources\Posts\Pages;

use App\Filament\Admin\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

// app/Filament/Resources/Posts/Pages/CreatePost.php
class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();   // el store() de la sesión 3, aquí

        return $data;
    }
}
