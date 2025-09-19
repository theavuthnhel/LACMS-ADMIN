<?php

namespace App\Filament\Guest\Pages\Auth;

use App\Models\Commune;
use App\Models\District;
use App\Models\Education;
use App\Models\Province;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class GuestSignUp extends Page implements HasForms
{
    use InteractsWithForms, WithFileUploads;

    protected static string $layout = 'components.guest.layout.index';

    protected string $view = 'filament.guest.pages.auth.guest-sign-up';

    protected static ?string $slug = 'sign-up';

    public $avatar = null;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                        '2xl' => 1,
                    ])
                    ->extraAttributes([
                        'class' => '!m-0 !p-0'
                    ])
                    ->schema([
                        // page title
                        $this->pageTitle(),
                        // working info section
                        $this->workingInfo(),
                        // personal information
                        $this->personalInfo(),
                        // place of birth
                        $this->placeOfBirth(),
                        // address in id card
                        $this->addressInIDcard(),
                        // current address
                        $this->currentAddress(),
                        // family information
                        $this->familyInfo(),
                        // emergency info
                        $this->emergencyInfo(),
                        // password section
                        $this->passwordSection(),
                        // brother or relative info
                        $this->relativeInfo(),
                        // agreement
                        $this->agreement()


                    ]),
            ]);
    }

    protected function title($title = "", $className = '')
    {
        return new HtmlString(
            "<h2 class='text-xl font-semibold $className'>$title</h2>"
        );
    }

    protected function customLabel($label = '', $className = '')
    {
        return new HtmlString(
            "<p class='text-lg text-blue-700 font-semibold $className'>$label</p>"
        );
    }

    protected function pageTitle()
    {
        return TextEntry::make('title')
            ->label(new HtmlString(
                "<h2 class='text-2xl font-bold'>ការផ្តល់សៀវភៅការងារ និងបណ្ណសម្គាល់កម្មករនិយោជិតខ្មែរ</h2>"
            ))
            ->belowContent(new HtmlString(
                "<h5 class='text-xl font-bold'>សម្រាប់ កម្មករនិយោជិត</h5>"
            ));
    }

    protected function workingInfo()
    {
        return Section::make()
            ->extraAttributes(['class' => 'shadow-md rounded-md'])
            ->schema([
                $this->title('ព័ត៌មានកន្លែងធ្វើការ', 'w-full p-2 bg-green-700 text-white rounded-md'),
                // single ID
                Select::make('single_id')
                    ->searchable()
                    ->required()
                    ->label('លេខ Single ID/លេខចុះបញ្ជីពាណិជ្ជកម្ម របស់សហគ្រាស គ្រឹះស្ថាន ដែលកម្មករនិយោជិត/បុគ្គលិកចូលធ្វើការ')
                    ->placeholder('លេខ Single ID/លេខចុះបញ្ជីពាណិជ្ជកម្ម របស់សហគ្រាស គ្រឹះស្ថាន ដែលកម្មករនិយោជិត/បុគ្គលិកចូលធ្វើការ')
                    ->options([
                        1 => 'មុខរបរងាយៗ',
                        2 => 'កម្មករនិយោជិត',
                        3 => 'ប្រធានក្រុម',
                        4 => 'ប្រធានផ្នែក',
                        5 => 'នាយកប្រតិបត្តិ/Manager/CEO/Managing Director'
                    ]),
                $this->title('បញ្ជាក់៖ លោក/លោកស្រីពិតជាកម្មករនិយោជិត/បុគ្គលិករបស់សហគ្រាស គ្រឹះស្ថានដែលកំពុងស្នើសុំពិតប្រាកដមែន។', 'w-fit p-2 bg-red-700 text-white rounded-md'),

                Grid::make([
                    'default' => 2,
                    'sm' => 2,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                    ->gap(4)
                    ->schema([
                        DatePicker::make('dob')
                            ->label('កាលបរិច្ឆេទចូលធ្វើការងារ')
                            ->required(),
                        Select::make('role')
                            ->required()
                            ->searchable()
                            ->label('តួនាទីក្នុងសហគ្រាស')
                            ->placeholder('តួនាទីក្នុងសហគ្រាស')
                            ->options([
                                1 => 'មុខរបរងាយៗ',
                                2 => 'កម្មករនិយោជិត',
                                3 => 'ប្រធានក្រុម',
                                4 => 'ប្រធានផ្នែក',
                                5 => 'នាយកប្រតិបត្តិ/Manager/CEO/Managing Director'
                            ]),
                        TextInput::make('មុខងារក្នុងសហគ្រាស')
                            ->label('មុខងារក្នុងសហគ្រាស')
                            ->required(),
                        TextInput::make('ប្រាក់ឈ្នួលប្រចាំខែ')
                            ->label('ប្រាក់ឈ្នួលប្រចាំខែ')
                            ->numeric()
                            ->required(),
                        Select::make('កម្រិតវប្បធម៌')
                            ->required()
                            ->searchable()
                            ->label('កម្រិតវប្បធម៌')
                            ->placeholder('កម្រិតវប្បធម៌')
                            ->options(Education::where('type', 1)->pluck('name', 'id')->toArray()),
                        Select::make('សញ្ញាបត្រ')
                            ->required()
                            ->searchable()
                            ->label('សញ្ញាបត្រ')
                            ->placeholder('សញ្ញាបត្រ')
                            ->options(Education::where('type', 2)->pluck('name', 'id')->toArray()),
                        FileUpload::make('attachment')
                            ->columnSpan(2)
                            ->label('សូមភ្ជាប់វិញ្ញាបនបត្រមុខរបរ')
                            ->required(),
                    ])
            ]);
    }

    protected function personalInfo()
    {
        return Section::make()
            ->extraAttributes(['class' => 'shadow-md rounded-md'])
            ->schema([
                $this->title('ព័ត៌មានផ្ទាល់ខ្លួន', 'w-full p-2 bg-green-700 text-white rounded-md'),
                // single ID
                Grid::make([
                    'default' => 2,
                    'sm' => 2,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                    ->gap(4)
                    ->schema([
                        Checkbox::make('use_phone')
                            ->label('ប្រើលេខទូរស័ព្ទ')
                            ->reactive()
                            ->afterStateUpdated(fn($state, $set) => $state ? $set('use_email', false) : null),

                        Checkbox::make('use_email')
                            ->label('ប្រើអ៊ីមែល')
                            ->reactive()
                            ->afterStateUpdated(fn($state, $set) => $state ? $set('use_phone', false) : null),

                        TextInput::make('ឈ្មោះជាភាសាខ្មែរដូចក្នុងអត្តសញ្ញាណបណ្ណ')
                            ->label('ឈ្មោះជាភាសាខ្មែរដូចក្នុងអត្តសញ្ញាណបណ្ណ')
                            ->required(),
                        TextInput::make('ឈ្មោះជាអក្សរឡាតាំង')
                            ->label('ឈ្មោះជាអក្សរឡាតាំង')
                            ->required(),
                        Select::make('role')
                            ->required()
                            ->searchable()
                            ->label('ភេទ')
                            ->placeholder('ភេទ')
                            ->options(['Male' => 'ប្រុស', 'Female' => 'ស្រី']),
                        DatePicker::make('ថ្ងៃខែឆ្នាំកំណើត')
                            ->label('ថ្ងៃខែឆ្នាំកំណើត')
                            ->required(),

                        Grid::make([
                            'default' => 3,
                            'sm' => 3,
                            'md' => 3,
                            'lg' => 3,
                            'xl' => 3,
                            '2xl' => 3,
                        ])
                            ->columnSpan(2)
                            ->schema([
                                Select::make('ប្រភេទឯកសារស្នើសុំ')
                                    ->required()
                                    ->searchable()
                                    ->label('ប្រភេទឯកសារស្នើសុំ')
                                    ->placeholder('ប្រភេទឯកសារស្នើសុំ')
                                    ->options([1 => 'អត្តសញ្ញាណប័ណ្ណសញ្ជាតិខ្មែរ', '2' => 'សំបុត្របញ្ជាក់កំណើត']),
                                TextInput::make('លេខអត្តសញ្ញាណប័ណ្ណសញ្ជាតិខ្មែរ')
                                    ->label('លេខអត្តសញ្ញាណប័ណ្ណសញ្ជាតិខ្មែរ')
                                    ->required(),
                                TextInput::make('កាលបរិច្ឆេទផុតសុពលភាព')
                                    ->label('កាលបរិច្ឆេទផុតសុពលភាព')
                                    ->required(),
                            ]),
                        FileUpload::make('attachment')
                            ->columnSpan(2)
                            ->label('សូមភ្ជាប់វិញ្ញាបនបត្រមុខរបរ')
                            ->required(),
                    ])
            ]);
    }

    protected function placeOfBirth()
    {
        return Section::make()
            ->extraAttributes(['class' => 'shadow-md rounded-md'])
            ->schema([
                $this->title('ទីកន្លែងកំណើត', 'w-full p-2 bg-green-700 text-white rounded-md'),
                // single ID
                Grid::make([
                    'default' => 4,
                    'sm' => 4,
                    'md' => 4,
                    'lg' => 4,
                    'xl' => 4,
                    '2xl' => 4,
                ])
                    ->gap(4)
                    ->schema([

                        Select::make('province_id')
                            ->label('រាជធានី-ខេត្ត')
                            ->required()
                            ->searchable()
                            ->options(Province::pluck('pro_khname', 'pro_id')->toArray())
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                dd($state); // this will show the selected province_id
                            }),

                        Select::make('district_id')
                            ->label('ស្រុក-ខណ្ឌ')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $province = $get('province_id');
                                return $province ? District::where('province_id', $province)->pluck('dis_khname', 'dis_id')->toArray() : [];
                            })
                            ->reactive()
                            ->afterStateUpdated(fn($state, $set) => $set('commune_id', null)),

                        Select::make('commune_id')
                            ->label('ឃុំ-សង្កាត់')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $district = $get('district_id');
                                return $district ? Commune::where('district_id', $district)->pluck('com_khname', 'com_id')->toArray() : [];
                            }),
                        Select::make('village_id')
                            ->label('ភូមិ')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $district = $get('district_id');
                                return $district ? Commune::where('district_id', $district)->pluck('com_khname', 'com_id')->toArray() : [];
                            })

                    ])
            ]);
    }

    protected function addressInIDcard()
    {
        return Section::make()
            ->extraAttributes(['class' => 'shadow-md rounded-md'])
            ->schema([
                $this->title('អាសយដ្ឋាននៅក្នុងអត្តសញ្ញាណប័ណ្ណសញ្ជាតិខ្មែរ', 'w-full p-2 bg-green-700 text-white rounded-md'),
                // single ID
                Grid::make([
                    'default' => 4,
                    'sm' => 4,
                    'md' => 4,
                    'lg' => 4,
                    'xl' => 4,
                    '2xl' => 4,
                ])
                    ->gap(4)
                    ->schema([

                        Select::make('id_card_province_id')
                            ->label('រាជធានី-ខេត្ត')
                            ->required()
                            ->searchable()
                            ->options(Province::pluck('pro_khname', 'pro_id')->toArray())
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                dd($state); // this will show the selected province_id
                            }),

                        Select::make('id_card_district_id')
                            ->label('ស្រុក-ខណ្ឌ')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $province = $get('id_card_province_id');
                                return $province ? District::where('province_id', $province)->pluck('dis_khname', 'dis_id')->toArray() : [];
                            })
                            ->reactive()
                            ->afterStateUpdated(fn($state, $set) => $set('commune_id', null)),

                        Select::make('id_card_commune_id')
                            ->label('ឃុំ-សង្កាត់')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $district = $get('id_card_district_id');
                                return $district ? Commune::where('district_id', $district)->pluck('com_khname', 'com_id')->toArray() : [];
                            }),
                        Select::make('id_card_village_id')
                            ->label('ភូមិ')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $district = $get('id_card_village_id');
                                return $district ? Commune::where('district_id', $district)->pluck('com_khname', 'com_id')->toArray() : [];
                            }),

                        TextInput::make('ក្រុម')
                            ->label('ក្រុម')
                            ->required(),
                        TextInput::make('ផ្លូវ')
                            ->label('ផ្លូវ')
                            ->required(),
                        TextInput::make('ផ្ទះលេខ')
                            ->label('ផ្ទះលេខ')
                            ->required(),
                    ])
            ]);
    }

    protected function currentAddress()
    {
        return Section::make()
            ->extraAttributes(['class' => 'shadow-md rounded-md'])
            ->schema([
                $this->title('អាសយដ្ឋានស្នាក់នៅបច្ចុប្បន្ន', 'w-full p-2 bg-green-700 text-white rounded-md'),
                // single ID
                Grid::make([
                    'default' => 4,
                    'sm' => 4,
                    'md' => 4,
                    'lg' => 4,
                    'xl' => 4,
                    '2xl' => 4,
                ])
                    ->gap(4)
                    ->schema([

                        Select::make('current_province_id')
                            ->label('រាជធានី-ខេត្ត')
                            ->required()
                            ->searchable()
                            ->options(Province::pluck('pro_khname', 'pro_id')->toArray())
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                dd($state); // this will show the selected province_id
                            }),

                        Select::make('current_district_id')
                            ->label('ស្រុក-ខណ្ឌ')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $province = $get('current_province_id');
                                return $province ? District::where('province_id', $province)->pluck('dis_khname', 'dis_id')->toArray() : [];
                            })
                            ->reactive()
                            ->afterStateUpdated(fn($state, $set) => $set('commune_id', null)),

                        Select::make('current_commune_id')
                            ->label('ឃុំ-សង្កាត់')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $district = $get('current_district_id');
                                return $district ? Commune::where('district_id', $district)->pluck('com_khname', 'com_id')->toArray() : [];
                            }),
                        Select::make('current_village_id')
                            ->label('ភូមិ')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $district = $get('current_village_id');
                                return $district ? Commune::where('district_id', $district)->pluck('com_khname', 'com_id')->toArray() : [];
                            }),

                        TextInput::make('ក្រុម')
                            ->label('ក្រុម')
                            ->required(),
                        TextInput::make('ផ្លូវ')
                            ->label('ផ្លូវ')
                            ->required(),
                        TextInput::make('ផ្ទះលេខ')
                            ->label('ផ្ទះលេខ')
                            ->required(),
                    ])
            ]);
    }

    protected function familyInfo()
    {
        return Section::make()
            ->extraAttributes(['class' => 'shadow-md rounded-md'])
            ->schema([
                $this->title('ព័ត៌មានគ្រួសារ', 'w-full p-2 bg-green-700 text-white rounded-md'),
                // single ID
                Grid::make([
                    'default' => 3,
                    'sm' => 3,
                    'md' => 3,
                    'lg' => 3,
                    'xl' => 3,
                    '2xl' => 3,
                ])
                    ->gap(4)
                    ->schema([
                        Select::make('ស្ថានភាពគ្រួសារ')
                            ->label('ស្ថានភាពគ្រួសារ')
                            ->required()
                            ->searchable()
                            ->options([
                                1 => 'នៅលីវ',
                                2 => 'រៀបការ',
                                3 => 'លែងលះ',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                dd($state); // this will show the selected province_id
                            }),

                        TextInput::make('ឈ្មោះប្ដីឬប្រពន្ធ')
                            ->label('ឈ្មោះប្ដីឬប្រពន្ធ')
                            ->required(),
                        TextInput::make('លេខទូរស័ព្ទ')
                            ->label('លេខទូរស័ព្ទ')
                            ->required(),
                    ])
            ]);
    }

    protected function emergencyInfo()
    {
        return Section::make()
            ->extraAttributes(['class' => 'shadow-md rounded-md'])
            ->schema([
                $this->title('ព័ត៌មានករណីមានអាសន្ន', 'w-full p-2 bg-green-700 text-white rounded-md'),
                // single ID
                Grid::make([
                    'default' => 4,
                    'sm' => 4,
                    'md' => 4,
                    'lg' => 4,
                    'xl' => 4,
                    '2xl' => 4,
                ])
                    ->gap(4)
                    ->schema([
                        TextInput::make('ឈ្មោះទំនាក់ទំនងក្នុងករណីមានអាសន្ន')
                            ->label('ឈ្មោះទំនាក់ទំនងក្នុងករណីមានអាសន្ន')
                            ->required(),
                        TextInput::make('ត្រូវជា')
                            ->label('ត្រូវជា')
                            ->required(),
                        TextInput::make('លេខទំនាក់ទំនងក្នុងករណីមានអាសន្នខ្សែទី ១')
                            ->label('លេខទំនាក់ទំនងក្នុងករណីមានអាសន្នខ្សែទី ១')
                            ->required(),
                        TextInput::make('លេខទំនាក់ទំនងក្នុងករណីមានអាសន្នខ្សែទី ២')
                            ->label('លេខទំនាក់ទំនងក្នុងករណីមានអាសន្នខ្សែទី ២')
                            ->required(),
                    ])
            ]);
    }

    protected function passwordSection()
    {
        return Section::make()
            ->extraAttributes(['class' => 'shadow-md rounded-md'])
            ->schema([
                $this->title('ព័ត៌មានករណីមានអាសន្ន', 'w-full p-2 bg-green-700 text-white rounded-md'),
                // single ID
                Grid::make([
                    'default' => 4,
                    'sm' => 4,
                    'md' => 4,
                    'lg' => 4,
                    'xl' => 4,
                    '2xl' => 4,
                ])
                    ->gap(4)
                    ->schema([
                        TextInput::make('លេខទូរស័ព្ទដែលប្រើ Telegram')
                            ->label('លេខទូរស័ព្ទដែលប្រើ Telegram')
                            ->required(),
                        TextInput::make('password')
                            ->label('លេខសម្ងាត់')
                            ->password()               // hides input
                            ->required()
                            ->revealable()
                            ->minLength(8),

                        TextInput::make('password_confirmation')
                            ->label('បញ្ជាក់លេខសម្ងាត់')
                            ->password()
                            ->required()
                            ->revealable()
                            ->same('password'),
                        FileUpload::make('avatar')
                            ->avatar()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                            ]),
                    ])
            ]);
    }

    protected function relativeInfo()
    {
        return  Flex::make([
            Section::make($this->customLabel('តើមនុស្សជាទីស្រលាញ់មានឈ្មោះអ្វី? ថ្ងៃខែឆ្នាំកំណេីត?'))
                ->schema([
                    Flex::make([
                        TextInput::make('ឈ្មោះ')->required(),
                        DatePicker::make('lover_dob')->label('ថ្ងៃខែឆ្នាំកំណេីត')->required(),
                    ])
                ]),
            Section::make($this->customLabel('តើលោកអ្នកមានបងប្អូនចំនួនប៉ុន្មាននាក់? ប្រុសប៉ុន្មាន? ស្រីប៉ុន្មាន?'))
                ->schema([
                    Flex::make([
                        TextInput::make('total_relative')->label('ចំនួនបងប្អូនសរុប')->numeric()->required(),
                        TextInput::make('total_brother')->label('ប្រុស')->numeric()->required(),
                        TextInput::make('total_sister')->label('ស្រី')->numeric()->required(),
                    ])
                ]),
        ]);
    }

    protected function agreement()
    {
        return Section::make()
            ->extraAttributes((['class' => 'border-b mb-5']))
            ->schema([
                Checkbox::make('terms_of_service')
                    ->label('ខ្ញុំបាទ/នាងខ្ញុំ សូមធានាអះអាងថាព័ត៌មានដែលបានបញ្ចូលខាងលើគឺពិតជាព័ត៌មានត្រឹមត្រូវនិងពិតប្រាកដ។ ក្នុងករណី ខ្ញុំបាទ/នាងខ្ញុំ ផ្តល់ជូនព័ត៌មាននិងឯកសារមិនពិត នោះក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ នឹងបដិសេធលើពាក្យស្នើសុំចុះឈ្មោះនេះ ហើយខ្ញុំបាទ/នាងខ្ញុំ សូមទទួលខុសត្រូវចំពោះមុខច្បាប់។')
                    ->accepted(),
            ]);
    }
}
