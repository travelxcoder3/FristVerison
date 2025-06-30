<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Agency;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AddAgency extends Component
{
    // بيانات الوكالة
    public $agency_name;
    public $agency_email;
    public $agency_phone;
    public $agency_address;
    public $license_number;
    public $commercial_record;
    public $tax_number;
    public $license_expiry_date;
    public $description;

    // بيانات أدمن الوكالة
    public $admin_name;
    public $admin_email;
    public $admin_password;

    public $successMessage;

    protected function rules()
    {
        return [
            'agency_name' => 'required|string|max:255',
            'agency_email' => 'required|email|unique:agencies,email',
            'agency_phone' => 'required|string|max:30',
            'agency_address' => 'required|string|max:255',
            'license_number' => 'required|string|unique:agencies,license_number',
            'commercial_record' => 'required|string|unique:agencies,commercial_record',
            'tax_number' => 'required|string|unique:agencies,tax_number',
            'license_expiry_date' => 'required|date',
            'description' => 'nullable|string',
            'admin_name' => 'required|string|max:255',
            'admin_email' => ['required','email','unique:users,email'],
            'admin_password' => 'required|string|min:6',
        ];
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $agency = Agency::create([
                'name' => $this->agency_name,
                'email' => $this->agency_email,
                'phone' => $this->agency_phone,
                'address' => $this->agency_address,
                'license_number' => $this->license_number,
                'commercial_record' => $this->commercial_record,
                'tax_number' => $this->tax_number,
                'license_expiry_date' => $this->license_expiry_date,
                'description' => $this->description,
                'status' => 'active',
            ]);

            $role = Role::where('name', 'agency_admin')->first();

            $admin = User::create([
                'name' => $this->admin_name,
                'email' => $this->admin_email,
                'password' => Hash::make($this->admin_password),
                'user_type' => 'agency_admin',
                'agency_id' => $agency->id,
                'role_id' => $role ? $role->id : null,
                'is_active' => true,
                'email_verified_at' => now(),
            ]);

            DB::commit();
            $this->reset(['agency_name','agency_email','agency_phone','agency_address','license_number','commercial_record','tax_number','license_expiry_date','description','admin_name','admin_email','admin_password']);
            $this->successMessage = 'تمت إضافة الوكالة بنجاح مع تعيين أدمن خاص بها.';
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'حدث خطأ أثناء إضافة الوكالة: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.add-agency')
            ->layout('layouts.admin')
            ->title('إضافة وكالة جديدة - نظام إدارة وكالات السفر');
    }
}
