@extends('panel.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    .card {
        border-radius: 6px;
        border: none;
        margin-bottom: 6px;
        height: 110px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        transition: all 0.2s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%);
    }

    .card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-bottom: none;
        padding: 4px 6px;
        font-weight: 600;
        font-size: 0.65rem;
        text-align: center;
        color: #fff;
    }

    .card-body {
        padding: 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .card-body i {
        font-size: 1.2rem;
        margin-bottom: 2px;
    }

    .card-body p {
        margin: 0;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .card-body .btn-backup {
        padding: 2px 8px;
        font-size: 0.7rem;
        margin-top: 4px;
    }

    .col-stat {
        padding: 3px;
        flex: 0 0 20%;
        max-width: 20%;
    }

    .card-header.bg-primary {
        background-color: #3f51b5;
    }

    .card-header.bg-info {
        background-color: #00acc1;
    }

    .card-header.bg-warning {
        background-color: #ff7043;
    }

    .card-header.bg-success {
        background-color: #43a047;
    }

    .card-header.bg-secondary {
        background-color: #78909c;
    }

    .card-header.bg-danger {
        background-color: #e53935;
    }

    @media (max-width: 1200px) {
        .col-stat {
            flex: 0 0 25%;
            max-width: 25%;
        }
    }

    @media (max-width: 992px) {
        .col-stat {
            flex: 0 0 33.333%;
            max-width: 33.333%;
        }
    }

    @media (max-width: 768px) {
        .col-stat {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 576px) {
        .col-stat {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .card {
            height: 80px;
        }
    }

    .container-fluid {
        padding: 5px 3px;
    }

    .row {
        margin: 0 -2px;
    }

    .last-backup-info {
        font-size: 0.6rem;
        color: #666;
        margin-top: 2px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        @php
        $cards = [
        ['label' => __('messages.user'), 'value' => $totalUsers, 'color' => 'primary', 'icon' => 'fa-users'],
        ['label' => __('messages.role'), 'value' => $totalRoles, 'color' => 'primary', 'icon' => 'fa-user-tag'],
        ['label' => __('messages.job_placement'), 'value' => $directorates['CoordinationAndStudentAffairs'], 'color' => 'info', 'icon' => 'fa-user-graduate'],
        ['label' => __('messages.cultural_sports'), 'value' => $directorates['CulturalSocialAndSportsServices'], 'color' => 'info', 'icon' => 'fa-futbol'],
        ['label' => __('messages.graduate_affairs'), 'value' => $directorates['GraduateCoordinationAndInterSectorRelations'], 'color' => 'info', 'icon' => 'fa-people-arrows'],
        ['label' => __('messages.sportsaffairs'), 'value' => $specialists['AffairsAndSports'], 'color' => 'warning', 'icon' => 'fa-dumbbell'],
        ['label' => __('messages.university_relations'), 'value' => $specialists['CoordinationUniversityRelations'], 'color' => 'warning', 'icon' => 'fa-building-columns'],
        ['label' => __('messages.culturalservices'), 'value' => $specialists['CulturalServices'], 'color' => 'warning', 'icon' => 'fa-theater-masks'],
        ['label' => __('messages.graduaterelations'), 'value' => $specialists['GraduateRelations'], 'color' => 'warning', 'icon' => 'fa-user-tie'],
        ['label' => __('messages.practical_social_law'), 'value' => $specialists['PracticalWorkSocialSciences'], 'color' => 'warning', 'icon' => 'fa-users-gear'],
        ['label' => __('messages.skilldevelopment'), 'value' => $specialists['SkillDevelopment'], 'color' => 'warning', 'icon' => 'fa-lightbulb'],
        ['label' => __('messages.mental_health'), 'value' => $specialists['MentalHealth'], 'color' => 'warning', 'icon' => 'fa-brain'],
        ['label' => __('messages.employment'), 'value' => $specialists['Employment'], 'color' => 'warning', 'icon' => 'fa-briefcase'],
        ['label' => __('messages.database_management'), 'value' => $generalManagement['DatabaseManagement'], 'color' => 'success', 'icon' => 'fa-database'],
        ['label' => __('messages.executive_management'), 'value' => $generalManagement['ExecutiveManagement'], 'color' => 'success', 'icon' => 'fa-user-shield'],
        ['label' => __('messages.counseling_services'), 'value' => $generalManagement['CounselingServices'], 'color' => 'success', 'icon' => 'fa-hand-holding-heart'],
        ['label' => __('messages.medical_practice_advisor'), 'value' => $academicMentors, 'color' => 'secondary', 'icon' => 'fa-chalkboard-teacher'],
        ['label' => __('messages.sectoral_relations'), 'value' => $sectoralRelations, 'color' => 'secondary', 'icon' => 'fa-sitemap'],
        // Backup card
        [
        'label' => __('messages.system_backup'),
        'value' => '',
        'color' => 'danger',
        'icon' => 'fa-database',
        'action' => 'backup',
        'last_backup' => $lastBackupDate ?? null
        ],
        ];
        @endphp

        @foreach($cards as $card)
        <div class="col-stat">
            <div class="card">
                <div class="card-header bg-{{ $card['color'] }}">
                    {{ $card['label'] }}
                </div>
                <div class="card-body">
                    <i class="fas {{ $card['icon'] }} text-{{ $card['color'] }}"></i>
                    @if(isset($card['action']) && $card['action'] === 'backup')
                    <form action="{{ route('backup.all') }}" method="GET" class="text-center">
                        <button type="submit" class="btn btn-sm btn-danger btn-backup">
                            <i class="fas fa-download"></i> {{ __('messages.backup_now') }}
                        </button>
                    </form>
                    @if(isset($card['last_backup']))
                    <div class="last-backup-info">
                        {{ __('messages.last_backup') }}: {{ $card['last_backup'] }}
                    </div>
                    @endif
                    @else
                    <p>{{ $card['value'] }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection