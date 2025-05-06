@extends('panel.layouts.app')

@section('content')
<div class="print-container">
    <h2>جزییات رکورد</h2>

    <p><strong>ID:</strong> {{ $record->id }}</p>
    <p><strong>هدف شغلی:</strong> {{ $record->job_objective }}</p>
    <p><strong>توضیحات:</strong> {{ $record->description }}</p>
    <p><strong>گزارش روزانه:</strong> {{ $record->day_report }}</p>
    <p><strong>فایل گزارش:</strong>
        @if($record->report_file)
        <a href="{{ asset('storage/reports/' . $record->report_file) }}" target="_blank">دانلود فایل</a>
        @else
        فایل موجود نیست
        @endif
    </p>
    <p><strong>طرح ماهانه:</strong> {{ $record->monthly_plan }}</p>
    <p><strong>یادداشت جلسات:</strong> {{ $record->meeting_notes }}</p>
    <p><strong>لاگ مکاتبات:</strong> {{ $record->correspondence_log }}</p>
    <p><strong>اطلاعات تماس:</strong> {{ $record->contact_info }}</p>
    <p><strong>وظایف اضافی:</strong> {{ $record->additional_tasks }}</p>
    <p><strong>تاریخ ثبت:</strong> {{ $record->created_at }}</p>
</div>

@endsection
<style>
    .print-container {
        font-family: Arial, sans-serif;
        margin: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        background-color: #f9f9f9;
    }

    .print-container h2 {
        text-align: center;
    }

    .print-container p {
        font-size: 16px;
        line-height: 1.5;
    }

    .print-container strong {
        font-weight: bold;
    }
</style>