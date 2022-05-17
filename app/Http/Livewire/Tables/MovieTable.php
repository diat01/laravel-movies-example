<?php

namespace App\Http\Livewire\Tables;

use App\Movie;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class MovieTable extends DataTableComponent
{
    protected $model = Movie::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            ImageColumn::make("Surat")
                ->location(
                    fn($row) => $row->getFirstMedia('posters')
                        ? $row->getFirstMedia('posters')->getUrl()
                        : null
                ),
            Column::make("Ady", "title")
                ->sortable()
                ->searchable(),
            Column::make("Çykan senesi", "release_date")
                ->sortable(),
            Column::make("Ortaça bahasy", "vote_average")
                ->sortable(),
            Column::make("Mazmuny", "overview")
                ->searchable(),
            Column::make("Amallar", "id")
                ->format(
                    fn($value) => view('admin.components.buttons.edit', [
                            'route' => route('admin.movies.edit', $value)
                        ])
                        . view('admin.components.buttons.delete', [
                            'route' => route('admin.movies.destroy', $value)
                        ])
                )
                ->html()
                ->excludeFromColumnSelect()
        ];
    }
}
