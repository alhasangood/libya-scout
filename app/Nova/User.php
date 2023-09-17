<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['name'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('id')->sortable(),

            Text::make('Name')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Name'),

            Text::make('Email')
                ->creationRules('required', 'unique:users,email', 'email')
                ->updateRules(
                    'required',
                    'unique:users,email,{{resourceId}}',
                    'email'
                )
                ->placeholder('Email'),

            Password::make('Password')
                ->creationRules('required')
                ->updateRules('nullable')
                ->placeholder('Password')
                ->hideFromIndex()
                ->hideFromDetail(),

            Text::make('Phone Number')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Phone Number'),

            Select::make('Userable Type')
                ->rules('required', 'max:255', 'string')
                ->searchable()
                ->options([])
                ->displayUsingLabels()
                ->placeholder('Userable Type'),

            Select::make('يتبع ', 'userable id')
                ->rules('required', 'max:255')
                ->searchable()
                ->options([])
                ->displayUsingLabels()
                ->placeholder('Userable Id'),

            BelongsTo::make('Roll', 'roll'),

            HasMany::make('AllDonationDetales', 'allDonationDetales'),

            MorphOne::make('ScoutRegiment', 'scoutRegiment'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}