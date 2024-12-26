<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternshipResource\Pages;
use App\Filament\Resources\InternshipResource\RelationManagers;
use App\Models\Internship;
use App\Models\User;
use App\Models\Office;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InternshipResource extends Resource
{
    protected static ?string $model = Internship::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?string $modelLabel = 'PKL';

    protected static ?string $pluralModelLabel = 'Data PKL';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->label('Siswa')
                ->options(
                    User::role('siswa')
                        ->pluck('name', 'id')
                )
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, callable $set) {
                    $schedule = Schedule::where('user_id', $state)->first();
                    if ($schedule) {
                        $office = Office::find($schedule->office_id);
                        if ($office) {
                            $set('office_id', $office->id);
                        }
                    }
                }),
                
            Forms\Components\Select::make('guru_pembimbing_id')
                ->label('Guru Pembimbing')
                ->options(
                    User::role('guru pembimbing')
                        ->pluck('name', 'id')
                )
                ->searchable()
                ->required(),
                
            Forms\Components\Select::make('office_id')
                ->label('Tempat PKL')
                ->options(Office::pluck('name', 'id'))
                ->searchable()
                ->required(),

            Forms\Components\Section::make('Informasi Perusahaan')
                ->schema([
                    Forms\Components\TextInput::make('company_leader')
                        ->label('Nama Pimpinan')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('company_type')
                        ->label('Jenis Perusahaan')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('company_phone')
                        ->label('Nomor Telepon Perusahaan')
                        ->tel()
                        ->required()
                        ->maxLength(20),

                    Forms\Components\Textarea::make('company_description')
                        ->label('Deskripsi Perusahaan')
                        ->rows(3)
                        ->maxLength(1000),
                ]),

            Forms\Components\Section::make('Informasi PKL')
                ->schema([
                    Forms\Components\DatePicker::make('start_date')
                        ->label('Tanggal Mulai')
                        ->required(),
                    
                    Forms\Components\DatePicker::make('end_date')
                        ->label('Tanggal Selesai')
                        ->required()
                        ->after('start_date'),
                    
                    Forms\Components\TextInput::make('position')
                        ->label('Posisi/Jabatan')
                        ->required()
                        ->maxLength(255),
                    
                    Forms\Components\TextInput::make('phone')
                        ->label('Nomor HP Siswa')
                        ->tel()
                        ->required()
                        ->maxLength(20),
                    
                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi Pekerjaan')
                        ->rows(3)
                        ->maxLength(1000),
                    
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'active' => 'Active',
                            'completed' => 'Completed',
                            'rejected' => 'Rejected',
                        ])
                        ->required()
                        ->default('pending'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record): string => $record->user->email ?? '-'),
                
                Tables\Columns\TextColumn::make('office.name')
                    ->label('Perusahaan')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('company_leader')
                    ->label('Pimpinan')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('company_phone')
                    ->label('No. Telp')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('position')
                    ->label('Posisi')
                    ->searchable(),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'rejected',
                        'warning' => 'pending',
                        'success' => 'active',
                        'info' => 'completed',
                    ])
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInternships::route('/'),
            'create' => Pages\CreateInternship::route('/create'),
            'edit' => Pages\EditInternship::route('/{record}/edit'),
        ];
    }
}