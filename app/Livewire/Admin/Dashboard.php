<?php

namespace App\Livewire\Admin;

use App\Models\PortalSetting;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $paymentFilter = '';
    public ?int $selectedUserId = null;
    public ?int $updateStatus = null;
    public bool $updatePaid = false;
    public string $comments = '';

    // Theme Control States
    public string $activeTheme = 'sapphire';
    public string $adminTheme = 'frost-sapphire';
    public string $customCss = '';
    public bool $themeSaved = false;
    public bool $adminThemeSaved = false;

    public function mount(): void
    {
        $setting = PortalSetting::current();
        $this->activeTheme = $setting->active_theme;
        $this->adminTheme = $setting->admin_theme ?? 'frost-sapphire';
        $this->customCss = $setting->custom_css ?? '';
    }

    public function applyPrebuiltTheme(string $themeName): void
    {
        $this->activeTheme = $themeName;
        $this->saveStudentTheme();
    }

    public function applyAdminTheme(string $themeName): void
    {
        $this->adminTheme = $themeName;
        $this->saveAdminTheme();
    }

    public function saveStudentTheme(): void
    {
        $setting = PortalSetting::current();
        $setting->update([
            'active_theme' => $this->activeTheme,
            'custom_css'   => $this->customCss,
        ]);

        $this->themeSaved = true;
        $this->adminThemeSaved = false;
        $this->dispatch('portal-theme-updated', theme: $this->activeTheme);
    }

    public function saveAdminTheme(): void
    {
        $setting = PortalSetting::current();
        $setting->update([
            'admin_theme' => $this->adminTheme,
        ]);

        $this->adminThemeSaved = true;
        $this->themeSaved = false;
        $this->dispatch('admin-theme-updated', theme: $this->adminTheme);
    }

    public function saveThemeSettings(): void
    {
        $setting = PortalSetting::current();
        $setting->update([
            'active_theme' => $this->activeTheme,
            'admin_theme'  => $this->adminTheme,
            'custom_css'   => $this->customCss,
        ]);

        $this->themeSaved = true;
        $this->adminThemeSaved = true;
        $this->dispatch('portal-theme-updated', theme: $this->activeTheme);
        $this->dispatch('admin-theme-updated', theme: $this->adminTheme);
    }

    public function selectUser(int $userId): void
    {
        $this->selectedUserId = $userId;
        $user = User::find($userId);
        if ($user) {
            $this->updateStatus = $user->status;
            $this->updatePaid = (bool) $user->is_paid;
            $this->comments = $user->comments ?? '';
        }
    }

    public function saveUserStatus(): void
    {
        if ($this->selectedUserId) {
            $user = User::find($this->selectedUserId);
            if ($user) {
                $user->update([
                    'status' => $this->updateStatus,
                    'is_paid' => $this->updatePaid,
                    'comments' => $this->comments,
                ]);
            }
        }
    }

    public function togglePayment(int $userId): void
    {
        $user = User::find($userId);
        if ($user) {
            $user->update(['is_paid' => ! $user->is_paid]);
        }
    }

    public function render()
    {
        $query = User::query()->whereNotNull('submitted_at');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%')
                  ->orWhere('cnic_passport', 'like', '%'.$this->search.'%')
                  ->orWhere('mobile_number', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->statusFilter !== '') {
            $query->where('status', (int) $this->statusFilter);
        }

        if ($this->paymentFilter !== '') {
            $query->where('is_paid', $this->paymentFilter === '1');
        }

        $selectedUser = $this->selectedUserId ? User::with([
            'personalDetails',
            'qualifications',
            'admissionTest',
            'program',
            'seatCategories',
            'mphillPhdSubjects',
            'userCnic',
            'userColorPhoto',
            'userDomicileCertificatePhoto',
            'userChallanImage'
        ])->find($this->selectedUserId) : null;

        return view('livewire.admin.dashboard', [
            'applicants' => $query->latest()->paginate(10),
            'selectedUser' => $selectedUser,
        ]);
    }
}
