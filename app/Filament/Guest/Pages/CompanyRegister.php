<?php

namespace App\Filament\Guest\Pages;

use App\Models\Bio\Bio;
use App\Models\Bio\Province;
use App\Models\Company\Company;
use App\Models\User\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Support\Enums\Alignment;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Icons\Heroicon;

class CompanyRegister extends Page
{
    protected static ?string $navigationLabel = null;
    protected static ?string $navigationParentItem = null;


    protected static string $layout = 'components.guest.layout.index';

    protected string $view = 'filament.guest.pages.company-register';

    public function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('ការចុះឈ្មោះរបស់រោងចក្រ សហគ្រាស')
                ->heading(
                        new HtmlString('
                            <div style="font-weight: bold; font-size: 22px; font-family: \'Moul\'; color: blue">
                                ការចុះឈ្មោះរបស់រោងចក្រ សហគ្រាស
                            </div>
                        ')
                )
                ->extraAttributes(['style' => 'font-family: Khmer Sangam MN; font-weight: bold;'])
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('business_activity')
                                ->label(
                                    new HtmlString('
                                                <div style="font-weight: bold; font-size: 16px; font-family: \'Moul\'; color: red">
                                                    សូមជ្រើសរើសសកម្មភាពសេដ្ឋកិច្ចរបស់សហគ្រាស
                                                </div>
                                            ')
                                    )
                                ->searchable()
                                ->options(function(){
                                    return Bio::getBusinessActivity();
                                }),
                        
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('single_id')
                                ->label(
                                    new HtmlString('
                                                <div style="font-weight: bold; font-size: 16px; font-family: \'Moul\'; color: red">
                                                    ប្រសិនជាមាន លេខ <span style="font-family: \'Khmer Sangam MN\'">Single ID</span> តាមថ្នាលបច្ចេកវិទ្យាព័ត៌មាន
                                                </div>
                                            ')
                                ),
                            TextInput::make('nssf_number')
                                ->label(
                                    new HtmlString('
                                                <div style="font-weight: bold; font-size: 16px; font-family: \'Moul\'; color: red">
                                                    លេខអត្តសញ្ញាណសហគ្រាសនៃ ប.ស.ស.
                                                </div>
                                            ')
                                ),
                            TextEntry::make('text')
                                        ->label(
                                            new HtmlString('
                                                    <div></div>  
                                        ')
                                    ),
                            TextEntry::make('text')
                                ->label(
                                    new HtmlString('
                                        <div style="margin: -20px 0px 0px 5px">
                                            <span style="color: #ff9800; font-weight: bold">ករណីមិនមានលេខអត្តសញ្ញាណសហគ្រាសនៃ ប.ស.ស.</span> 
                                            <a style="color: #3d5afe" href="https://enterprise.nssf.gov.kh"> សូមចុចទីនេះ </a>
                                        </div>  
                                    ')
                                ),
                        ]),
                    Grid::make(2)
                        ->schema([
                            CheckboxList::make('checkboxlist')
                                    ->hiddenLabel()
                                    ->extraAlpineAttributes(['class' => 'mt-10'])
                                    ->columns(2)
                                    ->options([
                                        'is_head_office' => 'ជាការិយាល័យកណ្ដាល',
                                        'is_branch' => 'ជាសាខាសហគ្រាស',
                                    ]),
                            TextInput::make('branch_approved_number')
                                ->hidden(fn ($get) => !in_array('is_branch', $get('checkboxlist')))
                                ->label('លេខលិខិតបង្កើតសាខា'),
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('company_name_khmer')
                                ->label('នាមករណ៍សហគ្រាស ជាភាសាខ្មែរ'),
                            TextInput::make('company_name_latin')
                                ->label('នាមករណ៍សហគ្រាស ជាភាសាអង់គ្លេស'),
                        ]),
                    Grid::make(4)
                        ->schema([
                            Select::make('article_of_company')
                                ->label('ទ្រង់ទ្រាយសហគ្រាស')
                                ->searchable()
                                ->options(function(){
                                    return Company::getArticleOfCompanyKhEn();
                                }),
                            Select::make('type_of_company')
                                ->label('ប្រភេទសហគ្រាស')
                                ->searchable()
                                ->options(function(){
                                    return Company::getTypeOfCompany();
                                }),
                            TextInput::make('total_staff')
                                ->label('ចំនួនកម្មករនិយោជិតដែលនឹងត្រូវប្រើប្រាស់នៅពេលដំណើរការ'),
                            TextInput::make('total_staff_female')
                                ->label('ចំនួនកម្មករនិយោជិតស្រីដែលនឹងត្រូវប្រើប្រាស់នៅពេលដំណើរការ'),
                        ]),
                    Grid::make(2)
                        ->schema([
                            FileUpload::make('certificate_of_incorporation_dropzone')
                                ->label('សូមភ្ជាប់វិញ្ញាបនបត្រក្រសួងពាណិជ្ជកម្ម / វិញ្ញាបនបត្រដែលចេញដោយអាជ្ញាធរមានសមត្ថកិច្ច')
                                ->placeholder(
                                    new HtmlString('
                                                <div style="color: red">
                                                    &#128206; សូមភ្ជាប់ឯកសារជា *.JPG, *.JPEG, *.PDF ដែលមានទំហំក្រោម 5MB
                                                </div>
                                            ')
                                    )
                                ->nullable(),
                            FileUpload::make('patent_tax_dropzone')
                                ->label('សូមភ្ជាប់សម្រង់ក្រុមហ៊ុន (ក្រសួងពាណិជ្ជកម្ម) / ប័ណ្ណពន្ធប៉ាតង់')
                                ->placeholder(
                                    new HtmlString('
                                                <div style="color: red">
                                                    &#128206; សូមភ្ជាប់ឯកសារជា *.JPG, *.JPEG, *.PDF ដែលមានទំហំក្រោម 5MB
                                                </div>
                                            ')
                                    )
                                ->nullable(),
                        ]),
                    Grid::make(4)
                        ->schema([
                            TextInput::make('company_register_number')
                                ->label('លេខចុះបញ្ជីពាណិជ្ជកម្ម'),
                            TextInput::make('registration_date')
                                ->label('កាលបរិច្ឆេទចុះបញ្ជី'),
                            TextInput::make('company_tin')
                                ->label('លេខអត្តសញ្ញាណកម្មសារពើពន្ធ (TIN)'),
                            TextInput::make('first_business_act')
                                ->label('សកម្មភាពអាជីវកម្មចម្បង'),
                        ]),
                    
                    Section::make('អាសយដ្ឋានសហគ្រាស (ដូចក្នុងបណ្ណពន្ធប៉ាតង់ឆ្នាំចុងក្រោយ)')
                        ->heading(
                            new HtmlString('
                                <div style="background-color: #0288d1; font-weight: bold; font-size: 18px; color: white; padding: 10px; padding-left: 20px; border-radius: 50px">
                                    អាសយដ្ឋានសហគ្រាស (ដូចក្នុងបណ្ណពន្ធប៉ាតង់ឆ្នាំចុងក្រោយ)
                                </div>
                            ')
                        )
                        ->extraAlpineAttributes([
                                'class' => 'bg-white dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] rounded-[0.4rem] border dark:border-[#3E3E3A] border-[#e3e3e0]',
                            ])
                        ->schema([
                            Grid::make(4)
                                ->schema([
                                    Select::make('patent_province')
                                        ->label('រាជធានី-ខេត្ត')
                                        ->searchable()
                                        ->options(function(){
                                            return Province::pluck('pro_khname', 'pro_id')->toArray();
                                        }),
                                    Select::make('business_district')
                                        ->label('ក្រុង-ស្រុក-ខណ្ឌ')
                                        ->searchable()
                                        ->options([
                                            'draft' => 'Draft',
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ]),
                                    Select::make('business_commune')
                                        ->label('ឃុំ-សង្កាត់')
                                        ->searchable()
                                        ->options([
                                            'draft' => 'Draft',
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ]),
                                    Select::make('business_village')
                                        ->label('ភូមិ')
                                        ->searchable()
                                        ->options([
                                            'draft' => 'Draft',
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ]),
                                    TextInput::make('business_group')
                                        ->label('ក្រុម'),
                                    TextInput::make('business_street')
                                        ->label('ផ្លូវ'),
                                    TextInput::make('business_house_no')
                                        ->label('ផ្ទះលេខ'),
                                    Select::make('special_economy_zone')
                                        ->searchable()
                                        ->label('ឈ្មោះសួនឧស្សាហកម្ម / តំបន់សេដ្ឋកិច្ចពិសេស')
                                        ->options([
                                            'draft' => 'Draft',
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ]),
                                
                                ]),
                        ]),
                    Section::make('អាសយដ្ឋានអាជីវកម្ម')
                        ->heading(
                            new HtmlString('
                                <div style="background-color: #0288d1; font-weight: bold; font-size: 18px; color: white; padding: 10px; padding-left: 20px; border-radius: 50px">
                                    អាសយដ្ឋានអាជីវកម្ម
                                </div>
                            ')
                        )
                        ->extraAlpineAttributes([
                                'class' => 'bg-white dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] rounded-[0.4rem] border dark:border-[#3E3E3A] border-[#e3e3e0]',
                            ])
                        ->schema([
                            Grid::make(4)
                                ->schema([
                                    Select::make('business_province')
                                        ->label('រាជធានី-ខេត្ត')
                                        ->searchable()
                                        ->options([
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ]),
                                    Select::make('business_district')
                                        ->label('ក្រុង-ស្រុក-ខណ្ឌ')
                                        ->searchable()
                                        ->options([
                                            'draft' => 'Draft',
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ]),
                                    Select::make('business_commune')
                                        ->label('ឃុំ-សង្កាត់')
                                        ->searchable()
                                        ->options([
                                            'draft' => 'Draft',
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ]),
                                    Select::make('business_village')
                                        ->label('ភូមិ')
                                        ->searchable()
                                        ->options([
                                            'draft' => 'Draft',
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ]),
                                    TextInput::make('business_group')
                                        ->label('ក្រុម'),
                                    TextInput::make('business_street')
                                        ->label('ផ្លូវ'),
                                    TextInput::make('business_house_no')
                                        ->label('ផ្ទះលេខ'),
                                    Select::make('special_economy_zone')
                                        ->searchable()
                                        ->label('ឈ្មោះសួនឧស្សាហកម្ម / តំបន់សេដ្ឋកិច្ចពិសេស')
                                        ->options([
                                            'draft' => 'Draft',
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ]),
                                
                                ]),
                        ])
                        ->footerActions([
                            Action::make('submit')
                                ->label('សូមជ្រើសរើសទីតាំងរោងចក្រ សហគ្រាសលើផែនទី Google Map មុននឹងប្រើប្រាស់ប្រព័ន្ធ')
                                ->extraAttributes(
                                    [
                                        'style' => 'background-color: #43a047; font-size: 16px; color: white; padding: 8px 25px; border-radius: 50px',
                                    ]
                                )
                                ->schema([
                                    TextInput::make('latitude'),
                                    TextInput::make('longitude'),

                                ])
                                ->modalWidth('lg')
                                ->modalSubmitActionLabel('ជ្រើសរើស')
                                ->modalCancelActionLabel('ចាកចេញ'),
                        ]),
                    Grid::make(2)
                        ->schema([
                            Section::make('Test')
                                ->heading(
                                    new HtmlString('
                                        <div style="background-color: #0288d1; font-weight: bold; font-size: 18px; color: white; padding: 10px; padding-left: 20px; border-radius: 50px">
                                            ព័ត៌មានម្ចាស់សហគ្រាស
                                        </div>
                                    ')
                                )
                                ->extraAlpineAttributes([
                                        'class' => 'bg-white dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] rounded-[0.4rem] border dark:border-[#3E3E3A] border-[#e3e3e0]',
                                    ])
                                ->schema([
                                    CheckboxList::make('ព័ត៌មានម្ចាស់សហគ្រាស')
                                        ->hiddenLabel()
                                        ->columns(2)
                                        ->options([
                                            'is_owner_name' => ' ប្រើជាឈ្មោះម្ចាស់',
                                            'is_company_name' => 'ប្រើជាឈ្មោះសហគ្រាស',
                                        ]),
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('owner_khmername')
                                                ->label('ឈ្មោះជាភាសាខ្មែរ'),
                                            TextInput::make('owner_name')
                                                ->label('ឈ្មោះជាអក្សរឡាតាំង'),
                                            Select::make('owner_gender')
                                                ->hidden(fn ($get) => in_array('is_company_name', $get('ព័ត៌មានម្ចាស់សហគ្រាស')))
                                                ->label('ភេទ')
                                                ->searchable()
                                                ->options([
                                                    'male' => 'Male',
                                                    'female' => 'Female',
                                                ]),
                                            Select::make('owner_nationality')
                                                ->hidden(fn ($get) => in_array('is_company_name', $get('ព័ត៌មានម្ចាស់សហគ្រាស')))
                                                ->label('សញ្ជាតិ')
                                                ->searchable()
                                                ->options([
                                                    '33' => 'ខ្មែរ',
                                                    '2' => 'អាល់បានី',
                                                ]),
                                            ]),
                                    TextInput::make('owner_id_number')
                                        ->hidden(fn ($get) => in_array('is_company_name', $get('ព័ត៌មានម្ចាស់សហគ្រាស')))
                                        ->label('លេខអត្តសញ្ញាណប័ណ្ណ/លិខិតឆ្លងដែនម្ចាស់សហគ្រាស'),
                                    FileUpload::make('owner_id_card_dropzone')
                                            ->label('សូមភ្ជាប់លក្ខន្តិកៈរបស់សហគ្រាស ')
                                            ->imageCropAspectRatio('3:3')
                                            ->placeholder(
                                                new HtmlString('
                                                            <div style="color: red">
                                                                &#128206; សូមភ្ជាប់ឯកសារជា *.JPG, *.JPEG, *.PDF ដែលមានទំហំក្រោម 5MB
                                                            </div>
                                                        ')
                                                )
                                            ->image()
                                            ->nullable(),
                                ]),
                            Section::make('Test')
                                ->heading(
                                    new HtmlString('
                                        <div style="background-color: #0288d1; font-weight: bold; font-size: 18px; color: white; padding: 10px; padding-left: 20px; border-radius: 50px">
                                            ព័ត៌មាននាយកសហគ្រាស
                                        </div>
                                    ')
                                )
                                ->extraAlpineAttributes([
                                        'class' => 'bg-white dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] rounded-[0.4rem] border dark:border-[#3E3E3A] border-[#e3e3e0]',
                                    ])
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('director_khmername')
                                                ->label('ឈ្មោះជាភាសាខ្មែរ'),
                                            TextInput::make('director_name')
                                                ->label('ឈ្មោះជាអក្សរឡាតាំង'),
                                            Select::make('director_gender')
                                                ->label('ភេទ')
                                                ->searchable()
                                                ->options([
                                                    'male' => 'Male',
                                                    'female' => 'Female',
                                                ]),
                                            Select::make('director_nationality')
                                                ->label('សញ្ជាតិ')
                                                ->searchable()
                                                ->options([
                                                    '33' => 'ខ្មែរ',
                                                    '2' => 'អាល់បានី',
                                                ]),
                                            ]),
                                    TextInput::make('director_id_number')
                                        ->label('លេខអត្តសញ្ញាណប័ណ្ណ/លិខិតឆ្លងដែននាយកសហគ្រាស'),
                                    FileUpload::make('director_id_card_dropzone')
                                            ->label('សូមភ្ជាប់អត្តសញ្ញាណប័ណ្ណ/លិខិតឆ្លងដែននាយកសហគ្រាស ')
                                            ->imageCropAspectRatio('3:3')
                                            ->placeholder(
                                                new HtmlString('
                                                            <div style="color: red">
                                                                &#128206; សូមភ្ជាប់ឯកសារជា *.JPG, *.JPEG, *.PDF ដែលមានទំហំក្រោម 5MB
                                                            </div>
                                                        ')
                                                )
                                            ->image()
                                            ->nullable(),
                                ]),
                            
                        ]),
                    Section::make()
                        ->extraAlpineAttributes([
                            'class' => 'bg-white dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] rounded-[0.4rem] border dark:border-[#3E3E3A] border-[#e3e3e0]',
                        ])
                        ->schema([
                            Grid::make(4)
                                ->schema([
                                    TextInput::make('phone_number')
                                        ->label('លេខទូរស័ព្ទដែលប្រើ Telegram'),
                                    TextInput::make('email')
                                        ->email()
                                        ->label('អុីមែល'),
                                    TextInput::make('password')
                                        ->password() 
                                        ->revealable()
                                        ->label('លេខសម្ងាត់'),
                                    TextInput::make('confirm_password')
                                        ->password() 
                                        ->revealable()
                                        ->label('បញ្ជាក់លេខសម្ងាត់'),
                                ]),
                            Grid::make(2)
                                ->schema([
                                    TextEntry::make('លេខសម្ងាត់ត្រូវតែ៖')
                                        ->label(
                                            new HtmlString('
                                                    <div></div>  
                                        ')
                                    ),
                                    TextEntry::make('លេខសម្ងាត់ត្រូវតែ៖')
                                        ->label(
                                            new HtmlString('
                                                    <p style="color: red">លេខសម្ងាត់ត្រូវតែ៖</p>
                                                    <ul style="list-style-type:none; border-left: 3px solid #e0e0e0; padding: 10px 50px 10px 10px;">
                                                        <li>- មានចំនួនយ៉ាងតិច 8 តួ</li>
                                                        <li>- មានតួអក្សរធំយ៉ាងតិចចំនួនមួយតួ ចន្លោះពី A ដល់ Z</li>
                                                        <li>- មានតួអក្សរតូចយ៉ាងតិចចំនួនមួយតួ ចន្លោះពី a ដល់ z</li>
                                                        <li>- មានលេខយ៉ាងតិចចំនួនមួយ</li>
                                                        <li>- មានសញ្ញាពិសេសយ៉ាងតិចចំនួនមួយ ដែលមានដូចជា (#?!@$%^&*-)</li>
                                                    </ul>
                                            ')
                                        ),
                                ]),
                        ]),
                        
                    Checkbox::make('confirmation')
                        ->label('ខ្ញុំបាទ/នាងខ្ញុំ សូមធានាអះអាងថាព័ត៌មានដែលបានបញ្ចូលខាងលើគឺពិតជាព័ត៌មានត្រឹមត្រូវនិងពិតប្រាកដ។ ក្នុងករណី ខ្ញុំបាទ/នាងខ្ញុំ ផ្តល់ជូនព័ត៌មាននិងឯកសារមិនពិត នោះក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ នឹងបដិសេធលើពាក្យស្នើសុំចុះឈ្មោះនេះ ហើយខ្ញុំបាទ/នាងខ្ញុំ សូមទទួលខុសត្រូវចំពោះមុខច្បាប់។'),
                ])
                ->footerActionsAlignment(Alignment::End)
                ->footerActions([
                    Action::make('submit')
                        ->label('ចុះឈ្មោះ')
                        ->color('primary')
                        ->extraAttributes(
                            [
                                'style' => 'background-color: #0288d1; font-size: 16px; color: white; padding: 5px 25px; border-radius: 50px',
                            ]
                        )
                        ,
                    Action::make('back')
                        ->label('ត្រឡប់ក្រោយ')
                        ->extraAttributes(
                            [
                                'style' => 'background-color: #bdbdbd; font-size: 16px; color: black; padding: 5px 15px; border-radius: 50px',
                            ]
                        ),
                ])
        ]);
    }
}
