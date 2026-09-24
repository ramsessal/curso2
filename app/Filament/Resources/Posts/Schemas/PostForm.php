<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required()
                    ->maxLength(255),
                Select::make('categoria_id')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre')
                    ->required(),
                Textarea::make('contenido')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('resumen')
                    ->maxLength(160)
                    ->columnSpanFull(),
                CheckboxList::make('etiquetas')
                    ->label('Etiquetas')
                    ->relationship('etiquetas', 'nombre')
                    ->columnSpanFull(),
                Toggle::make('publicado')
                    ->default(true),
            ]);
    }
}
