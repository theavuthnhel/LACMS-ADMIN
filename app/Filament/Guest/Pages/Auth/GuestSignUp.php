<?php

namespace App\Filament\Guest\Pages\Auth;

use App\Models\Bio\Bio;
use App\Models\Bio\Commune;
use App\Models\Bio\District;
use App\Models\Bio\Education;
use App\Models\Bio\Province;
use App\Models\Bio\Village;
use App\Models\Bio\WorkingHistory;
use App\Models\Company\Company;
use Carbon\Carbon;
use Filament\Actions\Action;
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
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class GuestSignUp extends Page implements HasForms
{
    use InteractsWithForms, WithFileUploads;

    protected static string $layout = 'components.guest.layout.index';

    protected string $view = 'filament.guest.pages.auth.guest-sign-up';

    protected static ?string $slug = 'sign-up';

    public $avatar = null;
    public $client;   // null = create, model = update
    // working info
    public $single_id = null;
    public $date_working = null;
    public $position = null;
    public $salary = null;
    public $education = null;
    public $certificate = null;
    public $attachment;
    // personal info
    public $is_use_phone = true;
    public $is_use_email = false;
    public $kh_name = null;
    public $eng_name = null;
    public $role = null;
    public $user_dob = null;
    public $type_doc = null;
    public $attachment_job = null;
    public $id_card_number_kh = null;
    public $id_card_expire = null;
    public $given_date = null;
    public $birth_doc_number = null;
    // place of birth
    public $province_id = null;
    public $district_id = null;
    public $commune_id = null;
    public $village_id = null;
    // address in card id
    public $id_card_province_id = null;
    public $id_card_district_id = null;
    public $id_card_commune_id = null;
    public $id_card_village_id = null;
    public $group = null;
    public $street = null;
    public $home_no = null;
    // current address
    public $current_province_id = null;
    public $current_district_id = null;
    public $current_commune_id = null;
    public $current_village_id = null;
    public $current_group = null;
    public $current_street = null;
    public $current_home_no = null;
    // family info
    public $family_status = null;
    public $partner_name = null;
    public $partner_phone = null;
    // emergency info
    public $emergency_name = null;
    public $relation_to = null;
    public $emergency_phone_1 = null;
    public $emergency_phone_2 = null;
    // password section
    public $telegram = null;
    public $email = null;
    public $password = null;
    public $password_confirmation = null;
    public $user_profile = null;
    // relative info
    public $lover_name = null;
    public $lover_dob = null;
    public $total_relative = null;
    public $total_brother = null;
    public $total_sister = null;
    // terms of service
    public $terms_of_service = null;


    public function mount($clientId = null)
    {
        if ($clientId) {
            $this->client = Bio::find(Crypt::decrypt($clientId));
            if ($this->client) {
                $this->form->fill($this->client->toArray());
            }
        }
    }

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
                        'class' => '!m-0 !p-0 '
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
                        // emergency information
                        $this->emergencyInfo(),
                        // password section
                        $this->passwordSection(),
                        // brother or relative information
                        $this->relativeInfo(),
                        // agreement
                        $this->agreement(),
                        //action button
                        $this->actionButtons()

                    ]),
            ]);
    }

    protected function title($title = "", $className = '')
    {
        return new HtmlString(
            "<h2 style='background-color: #3c8dbc' class='text-xl font-semibold $className'>$title</h2>"
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
                "<h2 style='color: #3c8dbc;' class='text-2xl font-bold'>ការផ្តល់សៀវភៅការងារ និងបណ្ណសម្គាល់កម្មករនិយោជិតខ្មែរ</h2>"
            ))
            ->belowContent(new HtmlString(
                "<h5 style='color: #3c8dbc;' class='text-xl font-bold'>សម្រាប់ កម្មករនិយោជិត</h5>"
            ));
    }
    protected function sectionPage($title = ''): Section
    {
        return Section::make($title)
            ->extraAttributes(['style' => 'border: 1px solid #3c8dbc; border-radius: 8px; padding: 16px; background-color: #ffffff; ']);
    }

    protected function workingInfo()
    {
        return $this->sectionPage()
            ->schema([
                $this->title('ព័ត៌មានកន្លែងធ្វើការ', 'w-full p-2  text-white rounded-md'),
                // single ID
                Select::make('single_id')
                    ->label('លេខ Single ID/លេខចុះបញ្ជីពាណិជ្ជកម្ម')
                    ->placeholder('លេខ Single ID/លេខចុះបញ្ជីពាណិជ្ជកម្ម')
                    ->searchable()
                    ->required()
                    ->searchDebounce(1000)
                    ->getSearchResultsUsing(function (string $search) {
                        return Company::whereHas('user', function ($query) {
                            $query->where('is_company', 1)
                                ->where('active', 1);
                        })
                            ->whereNotNull('company_register_number')
                            ->where(function ($query) use ($search) {
                                $query->where('company_register_number', 'like', "%{$search}%")
                                    ->orWhere('company_name_khmer', 'like', "%{$search}%")
                                    ->orWhere('company_name_latin', 'like', "%{$search}%");
                            })
                            ->limit(50)
                            ->get()
                            ->mapWithKeys(fn($company) => [
                                $company->id => $company->company_register_number
                                    . ' - ' . $company->company_name_khmer
                                    . ' - ' . $company->company_name_latin
                            ])
                            ->toArray();
                    }),

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
                        DatePicker::make('date_working')
                            ->label('កាលបរិច្ឆេទចូលធ្វើការងារ')
                            ->maxDate(Carbon::now())
                            ->rule('required|before:' . Carbon::now()->format('Y-m-d'))
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
                        TextInput::make('position')
                            ->label('មុខងារក្នុងសហគ្រាស')
                            ->required(),
                        TextInput::make('salary')
                            ->label('ប្រាក់ឈ្នួលប្រចាំខែ')
                            ->numeric()
                            ->required(),
                        Select::make('education')
                            ->required()
                            ->searchable()
                            ->label('កម្រិតវប្បធម៌')
                            ->placeholder('កម្រិតវប្បធម៌')
                            ->options(Education::where('type', 1)->pluck('name', 'id')->toArray()),
                        Select::make('certificate')
                            ->required()
                            ->searchable()
                            ->label('សញ្ញាបត្រ')
                            ->placeholder('សញ្ញាបត្រ')
                            ->options(Education::where('type', 2)->pluck('name', 'id')->toArray()),
                        FileUpload::make('attachment')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->maxSize(5120)
                            ->columnSpan(2)
                            ->label('សូមភ្ជាប់វិញ្ញាបនបត្រមុខរបរ')
                            ->required(),
                    ])
            ]);
    }

    protected function personalInfo()
    {
        return $this->sectionPage()
            ->schema([
                $this->title('ព័ត៌មានផ្ទាល់ខ្លួន', 'w-full p-2  text-white rounded-md'),
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
                        Checkbox::make('is_use_phone')
                            ->label('ប្រើលេខទូរស័ព្ទ')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                $set('is_use_phone', true);
                                $set('is_use_email', false);
                            }),

                        Checkbox::make('is_use_email')
                            ->label('ប្រើអ៊ីមែល')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                $set('is_use_phone', false);
                                $set('is_use_email', true);
                            }),


                        TextInput::make('kh_name')
                            ->rule('required|regex:/^([\u1780-\u17FF]+[\u0020-\u002F]*)+$/')
                            ->label('ឈ្មោះជាភាសាខ្មែរដូចក្នុងអត្តសញ្ញាណបណ្ណ')
                            ->required(),
                        TextInput::make('eng_name')
                            ->rule('required|regex:/^([\u0030-\u007A]+[\u0020-\u002F]*)+$/')
                            ->label('ឈ្មោះជាអក្សរឡាតាំង')
                            ->required(),
                        Select::make('role')
                            ->required()
                            ->searchable()
                            ->label('ភេទ')
                            ->placeholder('ភេទ')
                            ->options(['Male' => 'ប្រុស', 'Female' => 'ស្រី']),
                        DatePicker::make('user_dob')
                            ->label('ថ្ងៃខែឆ្នាំកំណើត')
                            ->rule('required|before:' . Carbon::now()->subYears(15)->format('d-m-Y'))
                            ->maxDate(Carbon::now()->subYears(15))
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
                                Select::make('type_doc')
                                    ->required()
                                    ->searchable()
                                    ->reactive()
                                    ->label('ប្រភេទឯកសារស្នើសុំ')
                                    ->placeholder('ប្រភេទឯកសារស្នើសុំ')
                                    ->options(['1' => 'អត្តសញ្ញាណប័ណ្ណសញ្ជាតិខ្មែរ', '2' => 'សំបុត្របញ្ជាក់កំណើត']),
                                // Khmer ID fields
                                TextInput::make('id_card_number_kh')
                                    ->numeric()
                                    ->label('លេខអត្តសញ្ញាណប័ណ្ណសញ្ជាតិខ្មែរ')
                                    ->required($this->type_doc == 1)
                                    ->hidden($this->type_doc == 2),

                                TextInput::make('id_card_expire')
                                    ->label('កាលបរិច្ឆេទផុតសុពលភាព')
                                    ->rule('required|after:' . Carbon::now()->format('d-m-Y'))
                                    ->required($this->type_doc == 1)
                                    ->hidden($this->type_doc == 2),

                                // Birth certificate / other docs
                                TextInput::make('birth_doc_number')
                                    ->numeric()
                                    ->label('លេខសំបុត្របញ្ជាក់កំណើត/សៀវភៅគ្រួសារ/លិខិតឆ្លងដែន/លិខិតធ្វើដំណើរ/លិខិតបញ្ជាក់អត្តសញ្ញាណ')
                                    ->required($this->type_doc == 2)
                                    ->hidden($this->type_doc != 2),

                                TextInput::make('birth_doc_date')
                                    ->label('កាលបរិច្ឆេទផ្ដល់')
                                    ->required($this->type_doc == 2)
                                    ->hidden($this->type_doc != 2),
                            ]),
                        FileUpload::make('attachment_job')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->maxSize(5120)
                            ->columnSpan(2)
                            ->label('សូមភ្ជាប់វិញ្ញាបនបត្រមុខរបរ')
                            ->required(),
                    ])
            ]);
    }

    protected function placeOfBirth()
    {
        return $this->sectionPage()
            ->schema([
                $this->title('ទីកន្លែងកំណើត', 'w-full p-2  text-white rounded-md'),
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
                                $set('district_id', null);
                                $set('commune_id', null);
                                $set('village_id', null);
                            }),

                        Select::make('district_id')
                            ->label('ស្រុក-ខណ្ឌ')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $province = $get('province_id');
                                return $province
                                    ? District::where('province_id', $province)->pluck('dis_khname', 'dis_id')->toArray()
                                    : [];
                            })
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                $set('commune_id', null);
                                $set('village_id', null);
                            }),

                        Select::make('commune_id')
                            ->label('ឃុំ-សង្កាត់')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $district = $get('district_id');
                                return $district
                                    ? Commune::where('district_id', $district)->pluck('com_khname', 'com_id')->toArray()
                                    : [];
                            })
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                $set('village_id', null);
                            }),

                        Select::make('village_id')
                            ->label('ភូមិ')
                            ->required()
                            ->searchable()
                            ->options(function ($get) {
                                $commune = $get('commune_id');
                                return $commune
                                    ? Village::where('commune_id', $commune)->pluck('vil_khname', 'vil_id')->toArray()
                                    : [];
                            }),


                    ])
            ]);
    }

    protected function addressInIDcard()
    {
        return $this->sectionPage()
            ->schema([
                $this->title('អាសយដ្ឋាននៅក្នុងអត្តសញ្ញាណប័ណ្ណសញ្ជាតិខ្មែរ', 'w-full p-2  text-white rounded-md'),
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
                                $set('id_card_district_id', null);
                                $set('id_card_commune_id', null);
                                $set('id_card_village_id', null);
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
                                $commune_id = $get('id_card_commune_id');
                                return $commune_id ? Village::where('commune_id', $commune_id)->pluck('vil_khname', 'vil_id')->toArray() : [];
                            }),

                        TextInput::make('group')
                            ->label('ក្រុម')
                            ->required(),
                        TextInput::make('street')
                            ->label('ផ្លូវ')
                            ->required(),
                        TextInput::make('home_no')
                            ->label('ផ្ទះលេខ')
                            ->required(),
                    ])
            ]);
    }

    protected function currentAddress()
    {
        return $this->sectionPage()
            ->schema([
                $this->title('អាសយដ្ឋានស្នាក់នៅបច្ចុប្បន្ន', 'w-full p-2  text-white rounded-md'),
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

                        TextInput::make('current_group')
                            ->label('ក្រុម')
                            ->required(),
                        TextInput::make('current_street')
                            ->label('ផ្លូវ')
                            ->required(),
                        TextInput::make('current_home_no')
                            ->label('ផ្ទះលេខ')
                            ->required(),
                    ])
            ]);
    }

    protected function familyInfo()
    {
        return $this->sectionPage()
            ->schema([
                $this->title('ព័ត៌មានគ្រួសារ', 'w-full p-2  text-white rounded-md'),
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
                        Select::make('family_status')
                            ->label('ស្ថានភាពគ្រួសារ')
                            ->required()
                            ->searchable()
                            ->options([
                                1 => 'នៅលីវ',
                                2 => 'រៀបការ',
                                3 => 'លែងលះ',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {}),

                        TextInput::make('partner_name')
                            ->label('ឈ្មោះប្ដីឬប្រពន្ធ')
                            ->required(fn($get) => $get('family_status') == 2),
                        TextInput::make('partner_phone')
                            ->label('លេខទូរស័ព្ទ')
                            ->numeric()
                            ->required(fn($get) => $get('family_status') == 2),
                    ])
            ]);
    }

    protected function emergencyInfo()
    {
        return $this->sectionPage()
            ->schema([
                $this->title('ព័ត៌មានករណីមានអាសន្ន', 'w-full p-2  text-white rounded-md'),
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
                        TextInput::make('emergency_name')
                            ->label('ឈ្មោះទំនាក់ទំនងក្នុងករណីមានអាសន្ន')
                            ->required(),
                        TextInput::make('relation_to')
                            ->label('ត្រូវជា')
                            ->required(),
                        TextInput::make('emergency_phone_1')
                            ->rule('required|integer|different:emergency_phone_2')
                            ->label('លេខទំនាក់ទំនងក្នុងករណីមានអាសន្នខ្សែទី ១')
                            ->required(),
                        TextInput::make('emergency_phone_2')
                            ->rule('required|integer|different:emergency_phone_1')
                            ->label('លេខទំនាក់ទំនងក្នុងករណីមានអាសន្នខ្សែទី ២')
                            ->required(),
                    ])
            ]);
    }

    protected function passwordSection()
    {
        return $this->sectionPage()
            ->schema([
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
                                TextInput::make('telegram')
                                    ->numeric()
                                    ->label('លេខទូរស័ព្ទដែលប្រើ Telegram')
                                    ->visible(fn($get) => $get('is_use_phone'))
                                    ->required(fn($get) => $get('is_use_phone')),

                                TextInput::make('email')
                                    ->label('អ៊ីមែល')
                                    ->visible(fn($get) => $get('is_use_email'))
                                    ->required(fn($get) => $get('is_use_email')),

                                TextInput::make('password')
                                    ->label('លេខសម្ងាត់')
                                    ->rule('required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/')
                                    ->password()
                                    ->required()
                                    ->revealable()
                                    ->minLength(8),
                                Html::make('spacer')
                                    ->content('&nbsp;')
                                    ->extraAttributes(['class' => 'block h-6']),
                                TextEntry::make('psw_rule')
                                    // ->columnSpan(2)
                                    ->label(
                                        new HtmlString(
                                            "
                                                <p class='text-red-600 text-md'>លេខសម្ងាត់ត្រូវតែ៖</p>
                                                <div class='mt-1 space-y-1 text-gray-500 border-l-2 pl-2'>
                                                    <div>- មានចំនួនយ៉ាងតិច 8 តួ</div>
                                                    <div>- មានអក្សរធំ (A–Z) យ៉ាងតិច 1 តួ</div>
                                                    <div>- មានអក្សរតូច (a–z) យ៉ាងតិច 1 តួ</div>
                                                    <div>- មានលេខ (0–9) យ៉ាងតិច 1 តួ</div>
                                                    <div>- មានសញ្ញាពិសេស (#?!@$%^&*-) យ៉ាងតិច 1 តួ</div>
                                                </div>
                                            "
                                        )
                                    )
                            ])
                            ->columnSpan(2),

                        TextInput::make('password_confirmation')
                            ->label('បញ្ជាក់លេខសម្ងាត់')
                            ->password()
                            ->required()
                            ->revealable()
                            ->same('password'),

                        FileUpload::make('user_profile')
                            ->acceptedFileTypes(['image/*', 'pdf'])
                            ->maxSize(5120)
                            ->label('ភ្ជាប់រូបថត')
                            // ->dropzoneText('សូមភ្ជាប់ឯកសារជា *.JPG, *.JPEG, *.PDF ដែលមានទំហំក្រោម 5MB')
                            ->image()
                            ->required()
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
            $this->sectionPage($this->customLabel('តើមនុស្សជាទីស្រលាញ់មានឈ្មោះអ្វី? ថ្ងៃខែឆ្នាំកំណេីត?'))
                ->schema([
                    Flex::make([
                        TextInput::make('lover_name')
                            ->label('ឈ្មោះ')
                            ->required(),
                        DatePicker::make('lover_dob')
                            ->label('ថ្ងៃខែឆ្នាំកំណេីត')
                            ->rule('required|before:' . Carbon::now()->subYears(15)
                                ->format('Y-m-d'))
                            ->maxDate(Carbon::now()->subYears(15))
                            ->required(),
                    ])
                ]),
            $this->sectionPage($this->customLabel('តើលោកអ្នកមានបងប្អូនចំនួនប៉ុន្មាននាក់? ប្រុសប៉ុន្មាន? ស្រីប៉ុន្មាន?'))
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
        return $this->sectionPage()
            ->extraAttributes((['class' => 'border-b mb-5']))
            ->schema([
                Checkbox::make('terms_of_service')
                    ->label('ខ្ញុំបាទ/នាងខ្ញុំ សូមធានាអះអាងថាព័ត៌មានដែលបានបញ្ចូលខាងលើគឺពិតជាព័ត៌មានត្រឹមត្រូវនិងពិតប្រាកដ។ ក្នុងករណី ខ្ញុំបាទ/នាងខ្ញុំ ផ្តល់ជូនព័ត៌មាននិងឯកសារមិនពិត នោះក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ នឹងបដិសេធលើពាក្យស្នើសុំចុះឈ្មោះនេះ ហើយខ្ញុំបាទ/នាងខ្ញុំ សូមទទួលខុសត្រូវចំពោះមុខច្បាប់។')
                    ->accepted(),
            ]);
    }

    protected function actionButtons()
    {
        return  Section::make()
            ->footerActions([
                Action::make('Submit')
                    ->requiresConfirmation()
                    ->label('ចុះឈ្មោះ')
                    ->size('sm')
                    ->action(function ($data) {
                        dd($this->date_working);
                    }),
                Action::make('back')
                    ->color('gray')
                    ->label('ត្រលប់ក្រោយ')
                    ->size('sm')
                    ->action(function ($data) {
                        // $data contains form input
                        // handle submission here
                    })
            ])
            ->footerActionsAlignment(Alignment::End);
    }


    public function submit($data)
    {
        DB::beginTransaction();

        dd($data);
    }
}
